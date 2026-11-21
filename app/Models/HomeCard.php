<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeCard extends Model
{
    protected $fillable = ['section', 'title', 'text', 'badge_big', 'badge_small', 'btn_text', 'icon', 'image', 'link', 'sort_order', 'status'];

    protected $casts = ['status' => 'boolean', 'sort_order' => 'integer'];

    public function scopeActive($q)
    {
        return $q->where('status', 1);
    }

    public function scopeSection($q, string $section)
    {
        return $q->where('section', $section);
    }

    public function scopeOrdered($q)
    {
        return $q->orderBy('sort_order')->orderBy('id');
    }

    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? asset('storage/' . ltrim($this->image, '/')) : null;
    }

    public function getVideoUrlAttribute(): ?string
    {
        $u = trim((string) $this->link);

        if ($u === '') {
            return null;
        }

        if (preg_match('~(?:youtu\.be/|youtube\.com/(?:watch\?v=|shorts/|embed/))([\w-]{11})~', $u, $m)) {
            return 'https://www.youtube.com/embed/' . $m[1];
        }

        return $u;
    }

}