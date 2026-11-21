<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class DynamicPage extends Model
{
    protected $fillable = [
        'slug',
        'heading',
        'short_description',
        'content',
        'meta_title',
        'meta_description',
        'status',
    ];

    protected $casts = ['status' => 'boolean'];

    public function scopeActive($q)
    {
        return $q->where('status', 1);
    }

    public function getUrlAttribute(): string
    {
        return route('page.show', $this->slug);
    }

    /** Makes a unique slug from the typed slug, or from the page name */
    public static function makeSlug(?string $typed, string $name, ?int $ignoreId = null): string
    {
        $base = Str::slug($typed ?: $name) ?: 'page';
        $slug = $base;
        $i = 2;

        while (
            static::where('slug', $slug)
                ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }

    /**
     * Replaces placeholders in the content with values from Settings,
     * so the email, phone and address stay in sync with the admin.
     *
     * [[site_name]] [[email]] [[phone]] [[phone_link]] [[address]] [[hours]]
     * A list item whose placeholder has no value is removed.
     */
    public function renderedContent(?Setting $s): string
    {
        $phone = trim((string) $s?->phone);

        $values = [
            '[[site_name]]' => trim((string) ($s?->site_name ?: config('app.name'))),
            '[[email]]' => trim((string) ($s?->support_email ?: $s?->admin_email)),
            '[[phone]]' => $phone,
            '[[phone_link]]' => preg_replace('/[^\d+]/', '', $phone),
            '[[address]]' => trim((string) $s?->business_address),
            '[[hours]]' => trim((string) $s?->business_hours),
        ];

        $html = (string) $this->content;

        foreach ($values as $key => $value) {
            if ($value === '') {
                $html = preg_replace(
                    '/<li\b[^>]*>(?:(?!<\/li>).)*?' . preg_quote($key, '/') . '.*?<\/li>/is',
                    '',
                    $html
                );
            }
        }

        return strtr($html, array_map('e', $values));
    }
}