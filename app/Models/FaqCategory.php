<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaqCategory extends Model
{
    protected $fillable = ['name', 'icon', 'sort_order', 'status'];

    public function faqs()
    {
        return $this->hasMany(Faq::class);
    }

    public function scopeActive($q)
    {
        return $q->where('status', 1);
    }

    /** Accepts "fa-bag-shopping" or "fa-solid fa-bag-shopping" */
    public function getIconClassAttribute(): ?string
    {
        $i = trim((string) $this->icon);

        if ($i === '') {
            return null;
        }

        return preg_match('/\bfa-(solid|regular|brands)\b/', $i) ? $i : 'fa-solid ' . $i;
    }
}