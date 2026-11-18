<?php

namespace App\Models;

use App\Support\Region;
use App\Services\ShippingCalculator;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [

        'customer_id',
        'session_id',

        'total_amount',

        'coupon_id',
        'coupon_code',

        'subtotal',
        'discount',
        'tax_amount',
        'tax_rate',
        'shipping_charge',

        'gst_type',

        'cgst_rate',
        'sgst_rate',
        'igst_rate',

        'cgst_amount',
        'sgst_amount',
        'igst_amount',

        'grand_total',
    ];

    public function items()
    {
        return $this->hasMany(
            CartItem::class
        );
    }

    public function customer()
    {
        return $this->belongsTo(
            Customer::class
        );
    }

    public function coupon()
    {
        return $this->belongsTo(
            Coupon::class
        );
    }

    /** Admin ne price/tier badla ho to cart ki lines naye price par aa jayein */
    public function refreshPrices(): void
    {
        $this->load('items.product.priceTiers', 'items.priceVariant', 'items.addons');

        foreach ($this->items as $item) {
            $p = $item->product;
            if (!$p)
                continue;

            $unit = $p->unitPriceFor((int) $item->quantity, (float) ($item->priceVariant->price ?? $p->price));
            $total = $item->quantity * ($unit + $item->addons->sum('price'));

            if (abs($unit - (float) $item->price) > 0.0001 || abs($total - (float) $item->total) > 0.0001) {
                $item->update(['price' => $unit, 'total' => $total]);
            }
        }
    }

    public function recalculateTotals()
    {
        $setting = InvoiceSetting::first();
        $country = app(Region::class)->current();
        $mode = $country->tax_handling ?? 'india_gst';          // india_gst | export | destination_vat
        $inclusive = ($setting->tax_type ?? 'inclusive') !== 'exclusive';

        $items = $this->items()->with('product')->get();
        $subtotal = round((float) $items->sum('total'), 2);
        $discount = min(round((float) ($this->discount ?? 0), 2), $subtotal);
        $taxable = max($subtotal - $discount, 0);

        // ── har line ka rate aur tax type ──
        $taxType = null;
        $rateFor = fn($item) => 0.0;

        if ($mode === 'india_gst') {
            if (($setting->business_type ?? 'registered') === 'registered') {
                $classRates = TaxClass::pluck('gst_rate', 'id');
                $defaultRate = (float) (TaxClass::default()?->gst_rate ?? 0);
                $rateFor = fn($item) => (float) ($classRates[$item->product?->tax_class_id] ?? $defaultRate);

                $addr = $this->customer_id
                    ? CustomerAddress::where('customer_id', $this->customer_id)->where('is_default', 1)->first()
                    : null;

                // address nahi (guest) ho to pehle jaisa: same state maano
                $sameState = !$addr || (int) $addr->state_id === (int) ($setting->company_state ?? 0);
                $taxType = $sameState ? 'cgst_sgst' : 'igst';
            }
        } elseif ($mode === 'destination_vat') {
            $vat = (float) ($country->vat_rate ?? 0);
            $rateFor = fn($item) => $vat;
            $taxType = 'vat';
        } else {                                                     // export: GST zero-rated
            $taxType = 'export';
        }

        // ── tax line-by-line (coupon discount lines me barabar hissa ho kar) ──
        $tax = 0.0;
        $rates = [];

        foreach ($items as $item) {
            $rate = $rateFor($item);
            $rates[] = round($rate, 2);

            $lineTaxable = $subtotal > 0 ? $item->total - ($discount * $item->total / $subtotal) : 0;
            $tax += $inclusive ? $lineTaxable * $rate / (100 + $rate) : $lineTaxable * $rate / 100;
        }

        $tax = round($tax, 2);
        $uniqueRates = array_values(array_unique($rates));
        $effRate = count($uniqueRates) === 1 ? $uniqueRates[0] : 0;

        $grandTotal = $inclusive ? $taxable : $taxable + $tax;
        $displaySubtotal = $inclusive ? $subtotal - $tax : $subtotal;

        $isGst = $taxType === 'cgst_sgst';

        // ── shipping: payable ke upar, tax nahi lagta ──
        $shippingCharge = 0;
        if ($subtotal > 0) {
            $shipping = ShippingCalculator::forCart($this, (float) $taxable);
            $shippingCharge = $shipping['known'] ? $shipping['charge'] : 0;
        }

        $this->update([
            'subtotal' => round($displaySubtotal, 2),
            'discount' => round($discount, 2),

            'gst_type' => $taxType,                       // cgst_sgst | igst | vat | export | null
            'tax_rate' => $effRate,

            'cgst_rate' => $isGst ? $effRate / 2 : 0,
            'sgst_rate' => $isGst ? $effRate / 2 : 0,
            'igst_rate' => $taxType === 'igst' ? $effRate : 0,

            'cgst_amount' => $isGst ? round($tax / 2, 2) : 0,
            'sgst_amount' => $isGst ? round($tax / 2, 2) : 0,
            'igst_amount' => $taxType === 'igst' ? $tax : 0,

            'tax_amount' => $tax,
            'shipping_charge' => round($shippingCharge, 2),

            'grand_total' => round($grandTotal + $shippingCharge, 2),
            'total_amount' => round($grandTotal, 2),       // shipping se pehle
        ]);
    }

}