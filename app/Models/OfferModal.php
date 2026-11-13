<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfferModal extends Model
{
    protected $fillable = [
        'sub_title',
        'title',
        'short_content',
        'coupon_text',
        'coupon_sub_text',
        'coupon_code',
        'terms',
        'image',
        'button_text',
        'button_link',
        'is_active',
    ];

    protected $casts = [
        'terms' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Single-row settings: the one offer modal record (unsaved instance if none yet).
     */
    public static function current(): self
    {
        return static::first() ?? new static(['is_active' => false]);
    }

    /**
     * Modal shown on the site only if active and it has something to show.
     */
    public function isVisible(): bool
    {
        return $this->exists && $this->is_active && filled($this->title);
    }

    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }

    public function getTermsListAttribute(): array
    {
        return array_values(array_filter((array) $this->terms, fn($t) => filled($t)));
    }
}