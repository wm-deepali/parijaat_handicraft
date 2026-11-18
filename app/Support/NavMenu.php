<?php

namespace App\Support;

use App\Models\Attribute;
use App\Models\Category;
use App\Models\GiftingOccasion;
use Illuminate\Support\Facades\Cache;

/**
 * Data for the header mega menus ("Shop All" + "Shop by Collection").
 * Plain arrays only (safe to cache). Cache key: nav_menu
 *
 * "Shop by Price" is NOT cached: its labels and values depend on the visitor's currency.
 */
class NavMenu
{
    public const CACHE_KEY = 'nav_menu';

    /** Price shortcut cut points, in the DEFAULT currency. */
    private const PRICE_CUTS = [999, 2999, 5999];

    public static function forget(): void
    {
        Cache::forget(self::CACHE_KEY);
    }

    public static function build(): array
    {
        try {
            $menu = Cache::remember(self::CACHE_KEY, now()->addMinutes(10), fn () => self::query());
        } catch (\Throwable $e) {
            report($e);

            $menu = ['shop' => [], 'footer' => [], 'collection' => ['occasions' => [], 'prices' => [], 'collections' => [], 'attributes' => []]];
        }

        // prices depend on the visitor's currency, so they are computed per request
        $menu['collection']['prices'] = self::prices();

        return $menu;
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

        return [
            'shop'       => $shop,
            'footer'     => $footer,
            'collection' => [
                'occasions'   => $occasions,
                'prices'      => [],            // filled per request in build()
                'collections' => $collections,
                'attributes'  => $attributes,
            ],
        ];
    }

    /**
     * Price shortcuts in the visitor's currency: [label, min, max] (null = open ended).
     * min/max are whole numbers in the visitor's currency, which is what the listing filter expects.
     */
    private static function prices(): array
    {
        try {
            $region = app(Region::class);
            $cuts = self::PRICE_CUTS;

            if (abs($region->factor() - 1) < 1e-9) {
                // default currency, no extra %: same numbers as the defaults (999 / 1,000 – 2,999 ...)
                $starts = array_map(fn ($c) => $c + 1, $cuts);
            } else {
                $prev = 0;
                $converted = [];
                foreach ($cuts as $c) {
                    $n = max(self::nice($region->convert($c)), $prev + 1);   // always increasing
                    $converted[] = $n;
                    $prev = $n;
                }
                $cuts = $starts = $converted;
            }

            $sym = $region->symbol();
            $gap = $region->symbolNeedsSpace() ? ' ' : '';
            $fmt = fn (int $n) => $sym . $gap . number_format($n);

            return [
                ['Under ' . $fmt($cuts[0]), null, $cuts[0]],
                [$fmt($starts[0]) . ' – ' . $fmt($cuts[1]), $starts[0], $cuts[1]],
                [$fmt($starts[1]) . ' – ' . $fmt($cuts[2]), $starts[1], $cuts[2]],
                [$fmt($starts[2]) . ' & Above', $starts[2], null],
            ];
        } catch (\Throwable $e) {
            report($e);

            return [];   // menu column just hides itself
        }
    }

    /** Round a converted amount to a clean number: 11.9 -> 12, 71.4 -> 72, 1234 -> 1240. */
    private static function nice(float $v): int
    {
        if ($v < 10) {
            return max(1, (int) round($v));
        }

        $step = max(1, 10 ** floor(log10($v)) / 5);

        return (int) (round($v / $step) * $step);
    }
}