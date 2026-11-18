<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $primaryKey = 'code';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['code', 'symbol', 'decimals', 'usd_rate', 'rate_is_manual', 'rates_updated_at'];

    protected $casts = ['rate_is_manual' => 'boolean', 'rates_updated_at' => 'datetime'];
}