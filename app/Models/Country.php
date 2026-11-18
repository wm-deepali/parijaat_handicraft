<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'name', 'iso2', 'currency_code', 'is_enabled', 'is_default',
        'price_adjustment', 'tax_handling', 'vat_rate',
    ];

    protected $casts = ['is_enabled' => 'boolean', 'is_default' => 'boolean'];

    public function currency() { return $this->belongsTo(Currency::class, 'currency_code', 'code'); }
    public function states()   { return $this->hasMany(State::class); }

    public function scopeEnabled($q) { return $q->where('is_enabled', 1); }

    public static function default(): ?self
    {
        return static::with('currency')->where('is_default', 1)->first();
    }
}