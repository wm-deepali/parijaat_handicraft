<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::with('currency')
            ->orderByDesc('is_default')->orderByDesc('is_enabled')->orderBy('name')->get();

        $currencies = Currency::whereIn('code', $countries->where('is_enabled', true)->pluck('currency_code')->unique())
            ->orderBy('code')->get();

        return view('admin.countries.index', [
            'countries' => $countries,
            'currencies' => $currencies,
            'default' => $countries->firstWhere('is_default', true),
            'productCount' => Product::count(),
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'default_country' => 'required|exists:countries,id',
            'countries' => 'required|array',
            'countries.*.is_enabled' => 'nullable|boolean',
            'countries.*.price_adjustment' => 'nullable|numeric|min:0|max:500',
            'countries.*.tax_handling' => 'nullable|in:india_gst,export,destination_vat',
            'countries.*.vat_rate' => 'nullable|numeric|min:0|max:100',
            'countries.*.shipping_charge' => 'nullable|numeric|min:0',
            'currencies' => 'nullable|array',
            'currencies.*.symbol' => 'nullable|string|max:8',
            'currencies.*.usd_rate' => 'nullable|numeric|gt:0',
        ]);

        $defaultId = (int) $data['default_country'];
        $existing = Country::whereIn('id', array_keys($data['countries']))->get()->keyBy('id');

        // Jo fields submit nahi hui (hidden/disabled row), unke liye DB ki value use karo
        $rows = [];
        foreach ($data['countries'] as $id => $row) {
            $db = $existing[$id] ?? null;
            if (!$db) {
                continue;
            }

            $row['tax_handling'] = $row['tax_handling'] ?? $db->tax_handling ?? ((int) $id === $defaultId ? 'india_gst' : null);
            if (!array_key_exists('price_adjustment', $row)) {
                $row['price_adjustment'] = $db->price_adjustment;
            }
            if (!array_key_exists('vat_rate', $row)) {
                $row['vat_rate'] = $db->vat_rate;
            }

            if (!$row['tax_handling']) {
                return back()->withInput()->withErrors(["Tax Handling is required for {$db->name}."]);
            }

            if ($row['tax_handling'] === 'destination_vat' && (float) ($row['vat_rate'] ?? 0) <= 0) {
                return back()->withInput()->withErrors(["VAT % is required for {$db->name} when Tax Handling is 'Charge VAT'."]);
            }

            $rows[$id] = $row;
        }

        DB::transaction(function () use ($data, $rows, $defaultId) {
            foreach ($rows as $id => $row) {
                $isDefault = (int) $id === $defaultId;

                $update = [
                    'is_enabled' => $isDefault || !empty($row['is_enabled']),   // default hamesha enabled
                    'is_default' => $isDefault,
                    'price_adjustment' => $row['price_adjustment'] ?? 0,
                    'tax_handling' => $row['tax_handling'],
                    'vat_rate' => $row['tax_handling'] === 'destination_vat' ? ($row['vat_rate'] ?? 0) : 0,
                ];

                // default country ki row me ye input hota hi nahi (wo Shipping Settings use karta hai)
                if (array_key_exists('shipping_charge', $row)) {
                    $update['shipping_charge'] = filled($row['shipping_charge']) ? $row['shipping_charge'] : null;
                }

                Country::whereKey($id)->update($update);
            }

            foreach ($data['currencies'] ?? [] as $code => $row) {
                if (!$cur = Currency::find($code))
                    continue;

                if (filled($row['symbol'] ?? null))
                    $cur->symbol = $row['symbol'];

                $rate = $row['usd_rate'] ?? null;
                if ($rate === null || $rate === '') {
                    $cur->rate_is_manual = false;                     // khali = phir se auto
                } elseif (round((float) $rate, 6) !== round((float) $cur->usd_rate, 6)) {
                    $cur->usd_rate = $rate;
                    $cur->rate_is_manual = true;
                    $cur->rates_updated_at = now();
                }
                $cur->save();
            }
        });

        $warnings = [];

        $missing = Country::enabled()->with('currency')->get()
            ->filter(fn($c) => !$c->currency?->usd_rate)->pluck('name');
        if ($missing->isNotEmpty()) {
            $warnings[] = 'Exchange rate missing for: ' . $missing->implode(', ') . '. Click "Update rates now" or enter it manually.';
        }

        $noShip = Country::enabled()->where('is_default', false)->whereNull('shipping_charge')->pluck('name');
        if ($noShip->isNotEmpty()) {
            $warnings[] = 'Shipping charge not set for: ' . $noShip->implode(', ') . '. Customers there cannot place orders until it is set.';
        }

        return back()->with('success', 'Country settings saved.')
            ->with('warning', $warnings ? implode(' ', $warnings) : null);
    }

    public function refreshRates()
    {
        Artisan::call('rates:update');

        return back()->with('success', trim(Artisan::output()) ?: 'Rates updated.');
    }
}