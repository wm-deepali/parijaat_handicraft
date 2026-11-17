<?php

namespace App\Support;

use App\Models\Attribute;
use App\Models\Category;
use App\Models\GiftingOccasion;
use Illuminate\Support\Facades\Cache;

/**
 * Data for the header mega menus ("Shop All" + "Shop by Collection").
 * Plain arrays only (safe to cache). Cache key: nav_menu
 */
class NavMenu
{
    public const CACHE_KEY = 'nav_menu';

    public static function forget(): void
    {
        Cache::forget(self::CACHE_KEY);
    }

    public static function build(): array
    {
        try {
            return Cache::remember(self::CACHE_KEY, now()->addMinutes(10), fn () => self::query());
        } catch (\Throwable $e) {
            report($e);

            return ['shop' => [], 'footer' => [], 'collection' => ['occasions' => [], 'prices' => [], 'collections' => [], 'attributes' => []]];
        }
    }

    private static function query(): array
    {
        // ---------- SHOP ALL: parent categories with children ----------
        $shop = Category::active()->parents()
            ->where('show_in_navbar', 1)
            ->with(['children' => fn ($q) => $q->active()->orderBy('sort_order')])
            ->orderBy('sort_order')
            ->limit(5)
            ->get()
            ->map(fn ($c) => [
                'name'     => $c->name,
                'slug'     => $c->slug,
                'children' => $c->children->take(6)->map(fn ($s) => ['name' => $s->name, 'slug' => $s->slug])->values()->all(),
            ])
            ->all();

        // ---------- FOOTER: "Shop Categories" (active parents) ----------
        $footer = Category::active()->parents()
            ->orderBy('sort_order')->orderBy('name')
            ->limit(6)->get(['name', 'slug'])
            ->map(fn ($c) => ['name' => $c->name, 'slug' => $c->slug])->all();

        // ---------- SHOP BY COLLECTION ----------
        $occasions = GiftingOccasion::where('status', 1)
            ->orderBy('title')->limit(6)->get(['title', 'slug'])
            ->map(fn ($o) => ['name' => $o->title, 'slug' => $o->slug])->all();

        $collections = \App\Models\Collection::where('status', 1)
            ->orderBy('sort_order')->limit(6)->get(['name', 'slug'])
            ->map(fn ($c) => ['name' => $c->name, 'slug' => $c->slug])->all();

        // attributes flagged "show_in_navbar" (e.g. Material, Finish) – max 2 columns
        $attributes = Attribute::where('status', 1)->where('show_in_navbar', 1)
            ->with(['values' => fn ($q) => $q->where('status', 1)->orderBy('sort_order')])
            ->orderBy('id')->limit(2)->get()
            ->map(fn ($a) => [
                'name'   => $a->name,
                'slug'   => $a->slug,
                'values' => $a->values->take(6)->map(fn ($v) => ['name' => $v->value, 'slug' => $v->slug])->values()->all(),
            ])
            ->filter(fn ($a) => !empty($a['values']))->values()->all();

        // price shortcuts: label, min, max (null = open ended)
        $prices = [
            ['Under ₹999',        null, 999],
            ['₹1,000 – ₹2,999',   1000, 2999],
            ['₹3,000 – ₹5,999',   3000, 5999],
            ['₹6,000 & Above',    6000, null],
        ];

        return [
            'shop'       => $shop,
            'footer'     => $footer,
            'collection' => [
                'occasions'   => $occasions,
                'prices'      => $prices,
                'collections' => $collections,
                'attributes'  => $attributes,
            ],
        ];
    }
}