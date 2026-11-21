<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeSection extends Model
{
    protected $fillable = [
        'key', 'eyebrow', 'title', 'description', 'image', 'image_alt',
        'btn1_text', 'btn1_link', 'btn2_text', 'btn2_link', 'lines', 'status',
    ];

    protected $casts = [
        'lines' => 'array',
        'status' => 'boolean',
    ];

    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? asset('storage/' . ltrim($this->image, '/')) : null;
    }
}