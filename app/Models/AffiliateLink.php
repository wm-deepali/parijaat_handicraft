<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class AffiliateLink extends Model
{
    protected $fillable = ['url', 'title', 'description', 'image', 'price', 'mrp', 'status', 'sort_order'];

    protected $casts = [
        'price' => 'decimal:2',
        'mrp' => 'decimal:2',
        'status' => 'boolean',
        'sort_order' => 'integer',
    ];

    /** 18 (for "18% OFF"), null if not applicable */
    public function getDiscountPercentAttribute(): ?int
    {
        if ($this->price && $this->mrp && $this->mrp > $this->price) {
            return (int) round((($this->mrp - $this->price) / $this->mrp) * 100);
        }
        return null;
    }

    public function scopeActive($q)
    {
        return $q->where('status', 1);
    }

    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image)
            return null;
        return Str::startsWith($this->image, ['http://', 'https://']) ? $this->image : asset('storage/' . $this->image);
    }

    public function getHostAttribute(): string
    {
        return preg_replace('/^www\./', '', parse_url($this->url, PHP_URL_HOST) ?: '');
    }
}