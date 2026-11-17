<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Collection;
use App\Models\GiftingOccasion;
use App\Models\Product;
use Illuminate\Database\Seeder;

/**
 * Links seeded products (SKU PJ-xxxx) with attribute values, collections and occasions
 * so every /products filter can be tested.
 * Run after: CategorySeeder, ProductSeeder, AttributeSeeder, CollectionOccasionSeeder
 */
class ProductMappingSeeder extends Seeder
{
    public function run(): void
    {
        $attrIds = Attribute::pluck('id', 'slug');          // slug => id
        $values  = AttributeValue::all()->groupBy('attribute_id')->map(fn ($g) => $g->pluck('id', 'slug'));

        $val = fn (string $attrSlug, string $valueSlug) => $values[$attrIds[$attrSlug] ?? 0][$valueSlug] ?? null;

        $collections = Collection::pluck('id', 'slug');
        $occasions   = GiftingOccasion::pluck('id', 'slug');

        $finishes = ['polished-gold', 'antique-brass', 'oxidised-black', 'silver-tone'];
        $sizes    = ['up-to-4-in', '4-8-in', '8-12-in', '12-in-and-above'];
        $styles   = ['traditional', 'antique', 'contemporary', 'hand-engraved'];

        Product::where('sku', 'like', 'PJ-%')->orderBy('id')->get()->each(function ($p, $i) use (
            $attrIds, $val, $collections, $occasions, $finishes, $sizes, $styles
        ) {
            $isCopper = str_contains($p->name, 'Copper');

            // ---- attributes ----
            $pairs = [
                ['metal-material', $isCopper ? 'copper' : ($i % 9 === 0 ? 'mixed-metal' : 'brass')],
                ['colour-finish',  $isCopper ? 'copper-tone' : $finishes[$i % 4]],
                ['size-height',    $sizes[($i + 1) % 4]],
                ['style',          $styles[intdiv($i, 2) % 4]],
            ];

            foreach ($pairs as [$attrSlug, $valueSlug]) {
                $valueId = $val($attrSlug, $valueSlug);
                if (!$valueId || !isset($attrIds[$attrSlug])) {
                    continue;
                }

                $p->attributeValues()->updateOrCreate([
                    'attribute_id'       => $attrIds[$attrSlug],
                    'attribute_value_id' => $valueId,
                ]);
            }

            // ---- collections ----
            $c = [];
            if ($i % 4 === 0) $c[] = $collections['best-sellers']   ?? null;
            if ($i % 3 === 0) $c[] = $collections['new-arrivals']   ?? null;
            if ($i % 5 === 0 || preg_match('/Diya|Lamp|Deepam/i', $p->name)) $c[] = $collections['festive-special'] ?? null;
            $p->collections()->syncWithoutDetaching(array_filter($c));

            // ---- occasions ----
            $o = [];
            if (preg_match('/Diya|Lamp|Deepam/i', $p->name)) {
                $o[] = $occasions['diwali']      ?? null;
                $o[] = $occasions['daily-pooja'] ?? null;
            } elseif (preg_match('/Ganesh|Lakshmi|Pooja|Kalash|Thali|Incense|Dhoop/i', $p->name)) {
                $o[] = $occasions['daily-pooja']  ?? null;
                $o[] = $occasions['housewarming'] ?? null;
            } else {
                $o[] = $occasions['gifting'] ?? null;
            }
            if ($i % 6 === 0) $o[] = $occasions['wedding'] ?? null;
            $p->occasions()->syncWithoutDetaching(array_filter($o));
        });
    }
}