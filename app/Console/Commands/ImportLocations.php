<?php

namespace App\Console\Commands;

use App\Models\City;
use App\Models\Country;
use App\Models\Currency;
use App\Models\State;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportLocations extends Command
{
    protected $signature = 'locations:import
        {file=countries+states+cities.json : file inside storage/app}
        {--country= : only these ISO2 codes, e.g. IN,AE,US (default: ALL countries)}
        {--only-countries : create countries + currencies only, skip states and cities}';

    protected $description = 'Import countries, currencies, states and cities from the dr5hn JSON (safe to re-run)';

    // ek jaisi dikhne wali currencies ko alag pehchaan dene ke liye
    private array $symbolOverride = [
        'AUD' => 'A$',
        'CAD' => 'C$',
        'NZD' => 'NZ$',
        'SGD' => 'S$',
        'HKD' => 'HK$',
        'MXN' => 'MX$',
        'AED' => 'AED',
        'INR' => '₹',
        'USD' => '$',
        'EUR' => '€',
        'GBP' => '£',
    ];
    private array $zeroDecimals = ['JPY', 'KRW', 'VND', 'CLP', 'ISK', 'UGX', 'PYG', 'RWF', 'XAF', 'XOF', 'KMF', 'GNF', 'DJF', 'BIF', 'VUV'];
    private array $threeDecimals = ['KWD', 'BHD', 'OMR', 'JOD', 'TND', 'LYD'];

    public function handle(): int
    {
        ini_set('memory_limit', '-1');

        $path = storage_path('app/' . $this->argument('file'));
        if (!is_file($path)) {
            $this->error("File not found: $path");
            return self::FAILURE;
        }

        $only = $this->option('country')
            ? array_filter(array_map(fn($c) => strtoupper(trim($c)), explode(',', $this->option('country'))))
            : [];
        $skipPlaces = $this->option('only-countries');

        $hasDefault = Country::where('is_default', 1)->exists();
        $stats = ['countries' => 0, 'states' => 0, 'cities' => 0, 'skipped' => []];

        foreach ($this->countries($path) as $row) {
            $iso = strtoupper($row['iso2'] ?? '');
            if (!$iso || ($only && !in_array($iso, $only)))
                continue;

            $country = $this->ensureCountry($iso, $row, $hasDefault);
            if (!$country) {
                $stats['skipped'][] = ($row['name'] ?? $iso) . ' (no currency)';
                continue;
            }
            $stats['countries']++;
            if ($country->is_default)
                $hasDefault = true;

            if ($skipPlaces)
                continue;

            [$s, $c] = DB::transaction(function () use ($country, $row) {
                // purane India states (country_id khali) pehle India se jod do, warna duplicate banenge
                if ($country->iso2 === 'IN') {
                    State::whereNull('country_id')->update(['country_id' => $country->id]);
                }
                return $this->importPlaces($country->id, $row);
            });

            $stats['states'] += $s;
            $stats['cities'] += $c;
            $this->line(sprintf('  %-3s %-30s %4d states, %6d new cities', $iso, $country->name, $s, $c));
        }

        $this->info("Done. {$stats['countries']} countries, {$stats['states']} states, {$stats['cities']} new cities.");
        if ($stats['skipped']) {
            $this->warn('Skipped: ' . implode(', ', $stats['skipped']));
        }
        return self::SUCCESS;
    }

    /** Country + uski currency banata hai. Admin ki settings dobara chalane par overwrite nahi hoti. */
    private function ensureCountry(string $iso, array $row, bool $hasDefault): ?Country
    {
        $cur = strtoupper(trim($row['currency'] ?? ''));
        if ($cur === '')
            return null;

        Currency::firstOrCreate(['code' => $cur], [
            'symbol' => $this->symbolOverride[$cur] ?? (trim($row['currency_symbol'] ?? '') ?: $cur),
            'decimals' => in_array($cur, $this->zeroDecimals) ? 0 : (in_array($cur, $this->threeDecimals) ? 3 : 2),
            'usd_rate' => $cur === 'USD' ? 1 : null,
        ]);

        // pehli baar: India enabled + default (aapka system abhi INR me chal raha hai)
        $makeDefault = $iso === 'IN' && !$hasDefault;

        return Country::firstOrCreate(['iso2' => $iso], [
            'name' => trim($row['name'] ?? $iso),
            'currency_code' => $cur,
            'is_enabled' => $makeDefault,
            'is_default' => $makeDefault,
            'tax_handling' => $iso === 'IN' ? 'india_gst' : 'export',
        ]);
    }

    /** States + cities. Dobara chalane par duplicate nahi banata. */
    private function importPlaces(int $countryId, array $row): array
    {
        $sCount = $cCount = 0;

        foreach ($row['states'] ?? [] as $st) {
            $stateName = trim($st['name'] ?? '');
            if ($stateName === '')
                continue;

            $state = State::firstOrCreate(['country_id' => $countryId, 'name' => $stateName]);
            $sCount++;

            $seen = array_flip(
                City::where('state_id', $state->id)->pluck('name')
                    ->map(fn($n) => mb_strtolower($n))->all()
            );

            $rows = [];
            foreach ($st['cities'] ?? [] as $ct) {
                $cityName = trim($ct['name'] ?? '');
                $key = mb_strtolower($cityName);
                if ($cityName === '' || isset($seen[$key]))
                    continue;

                $seen[$key] = true;
                $rows[] = ['state_id' => $state->id, 'name' => $cityName];
            }

            foreach (array_chunk($rows, 1000) as $chunk) {
                City::insert($chunk);
            }
            $cCount += count($rows);
        }

        return [$sCount, $cCount];
    }

    /** Badi file ko ek country ek baar me stream karta hai; single-country file bhi chalti hai. */
    private function countries(string $path): \Generator
    {
        $data = json_decode(file_get_contents($path), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \RuntimeException('Invalid JSON: ' . json_last_error_msg());
        }

        if (isset($data['iso2'])) {          // ek hi country ki file
            yield $data;
            return;
        }

        foreach ($data as $i => $country) {
            yield $country;
            unset($data[$i]);                // ek country ho jaye to memory free kar do
        }
    }
}