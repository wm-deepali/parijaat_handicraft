<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeStory extends Model
{
    protected $fillable = [
        'eyebrow', 'title', 'description',
        'main_image', 'main_image_alt', 'detail_image', 'detail_image_alt', 'badge_text',
        'pillars',
        'primary_btn_text', 'primary_btn_link', 'secondary_btn_text', 'secondary_btn_link',
        'status',
    ];

    protected $casts = [
        'pillars' => 'array',
        'status' => 'boolean',
    ];

    public function getMainImageUrlAttribute(): ?string
    {
        return $this->main_image ? asset('storage/' . ltrim($this->main_image, '/')) : null;
    }

    public function getDetailImageUrlAttribute(): ?string
    {
        return $this->detail_image ? asset('storage/' . ltrim($this->detail_image, '/')) : null;
    }
}