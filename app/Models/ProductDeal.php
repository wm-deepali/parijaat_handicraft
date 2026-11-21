<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDeal extends Model
{
    protected $fillable = ['product_id', 'title', 'text', 'coupon_code', 'starts_at', 'ends_at', 'status'];

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
        'status' => 'boolean',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /** active, already started, not yet ended */
    public function scopeLive($q)
    {
        return $q->where('status', 1)
            ->where('ends_at', '>', now())
            ->where(fn($w) => $w->whereNull('starts_at')->orWhere('starts_at', '<=', now()));
    }

    /** the deal that ends first comes first */
    public function scopeSoonest($q)
    {
        return $q->orderBy('ends_at')->orderBy('id');
    }

    public function getStateAttribute(): string
    {
        if (!$this->status) {
            return 'inactive';
        }
        if ($this->ends_at->isPast()) {
            return 'expired';
        }
        if ($this->starts_at && $this->starts_at->isFuture()) {
            return 'scheduled';
        }

        return 'live';
    }
}