<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaxClass extends Model
{
    protected $fillable = ['name', 'gst_rate', 'is_default'];

    protected $casts = ['is_default' => 'boolean'];

    public static function default(): ?self
    {
        return static::where('is_default', true)->first();
    }

    public function categories() { return $this->hasMany(Category::class); }
    public function products()   { return $this->hasMany(Product::class); }
}