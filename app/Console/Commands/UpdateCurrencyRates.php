<?php

namespace App\Console\Commands;

use App\Models\Currency;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class UpdateCurrencyRates extends Command
{
    protected $signature = 'rates:update';
    protected $description = 'Fetch daily exchange rates (1 USD = ?) for all currencies';

    public function handle(): int
    {
        try {
            $res = Http::timeout(15)->get('https://open.er-api.com/v6/latest/USD');
        } catch (\Throwable $e) {
            $this->error('Rate API not reachable: ' . $e->getMessage());
            return self::FAILURE;
        }

        if (!$res->successful() || $res->json('result') !== 'success') {
            $this->error('Rate API returned an error.');
            return self::FAILURE;
        }

        $rates = $res->json('rates', []);

        // admin ne manually dale hue rates ko chhedta nahi
        Currency::where('rate_is_manual', false)->get()->each(function (Currency $c) use ($rates) {
            if (isset($rates[$c->code])) {
                $c->update(['usd_rate' => $rates[$c->code], 'rates_updated_at' => now()]);
            }
        });

        $this->info('Rates updated.');
        return self::SUCCESS;
    }
}