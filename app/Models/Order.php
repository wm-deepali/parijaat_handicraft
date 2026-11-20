<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // placeOrder() writes many columns (billing_*, gst, razorpay_*, courier...),
    // and the Region snapshot is applied with forceFill, so nothing is listed here.
    protected $guarded = [];

    protected $casts = [
        'subtotal'                 => 'decimal:2',
        'discount'                 => 'decimal:2',
        'tax_amount'               => 'decimal:2',
        'shipping_charge'          => 'decimal:2',
        'grand_total'              => 'decimal:2',
        'cgst_amount'              => 'decimal:2',
        'sgst_amount'              => 'decimal:2',
        'igst_amount'              => 'decimal:2',

        // Region::snapshot() columns
        'exchange_rate'            => 'float',
        'price_adjustment_percent' => 'float',
        'price_adjustment_amount'  => 'float',
        'total_default'            => 'float',
        'total_customer'           => 'float',
        'inr_rate'                 => 'float',
        'total_inr'                => 'float',

        'paid_at'                  => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function address()
    {
        return $this->belongsTo(CustomerAddress::class, 'address_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function courier()
    {
        return $this->belongsTo(Courier::class);
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }

    public function statusHistory()
    {
        return $this->hasMany(OrderStatusHistory::class)->latest();   // keep your existing order
    }

    public function ndrs()
    {
        return $this->hasMany(Ndr::class);
    }

    public function payments()
    {
        return $this->hasMany(OrderPayment::class);
    }

    public function latestPayment()
    {
        return $this->hasOne(OrderPayment::class)->latestOfMany();
    }

    public function refundTransactions()
    {
        return $this->hasMany(RefundTransaction::class);
    }

    /* ── NEW: country and currency of the order ── */

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_code', 'iso2');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_code', 'code');
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    /** True when the order was placed from outside India. */
    public function getIsInternationalAttribute(): bool
    {
        return $this->country_code && strtoupper($this->country_code) !== 'IN';
    }

    /** "$120.00" / "AED 440.70", or null for old orders with no snapshot. */
    public function getCustomerTotalLabelAttribute(): ?string
    {
        if (!$this->currency_code || $this->total_customer === null) {
            return null;
        }

        $symbol = $this->currency?->symbol ?: $this->currency_code;
        $space  = ctype_alpha(str_replace(' ', '', $symbol)) ? ' ' : '';

        return $symbol . $space . number_format((float) $this->total_customer, (int) ($this->currency?->decimals ?? 2));
    }
}