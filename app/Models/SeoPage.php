<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SeoPage extends Model
{
    protected $fillable = [
        'page_key',
        'page_name',
        'page_group',
        'slug',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'canonical_url',
        'robots',
        'og_title',
        'og_description',
        'og_image',
        'og_type',
        'twitter_card',
        'twitter_title',
        'twitter_description',
        'twitter_image',
        'schema_markup',
        'scripts',
        'body_scripts',
        'in_sitemap',
        'sitemap_priority',
        'sitemap_changefreq',
        'is_active',
    ];

    protected $casts = [
        'in_sitemap'       => 'boolean',
        'is_active'        => 'boolean',
        'sitemap_priority' => 'float',
    ];

    protected static function booted(): void
    {
        // Admin edits show up on the site immediately
        static::saved(function (self $m) {
            Cache::forget(self::cacheKey($m->page_key));

            // page_key was edited: clear the old key as well
            if ($m->wasChanged('page_key')) {
                Cache::forget(self::cacheKey((string) $m->getOriginal('page_key')));
            }
        });

        static::deleted(fn (self $m) => Cache::forget(self::cacheKey($m->page_key)));
    }

    public static function cacheKey(string $key): string
    {
        return 'seo_page.' . $key;
    }

    /* ───────────── Scopes ───────────── */

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeInSitemap($query)
    {
        return $query->active()->where('in_sitemap', true);
    }

    public function scopeGrouped($query)
    {
        return $query->orderBy('page_group')->orderBy('page_name');
    }

    /* ───────────── Lookup ───────────── */

    /**
     * Cached lookup by page_key (= Laravel route name, e.g. "home", "product.show").
     * A miss is cached as false, so routes without a row (admin pages etc.)
     * don't hit the database on every request.
     */
    public static function forKey(string $key): ?self
    {
        $row = Cache::remember(
            self::cacheKey($key),
            3600,
            fn () => static::active()->where('page_key', $key)->first() ?? false
        );

        return $row ?: null;
    }

    /* ───────────── Accessors ───────────── */

    /** Robots value is noindex (used to show a badge in the admin list). */
    public function getIsNoindexAttribute(): bool
    {
        return str_contains(strtolower((string) $this->robots), 'noindex');
    }

    /** Dynamic template rows (category.show, product.show...) have {placeholders} in the slug. */
    public function getIsTemplateAttribute(): bool
    {
        return str_contains((string) $this->slug, '{');
    }
}