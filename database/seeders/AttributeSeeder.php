<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Category;
use App\Models\CategoryAttribute;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AttributeSeeder extends Seeder
{
    public function run(): void
    {
        // name => [type, values]   (value = label or [label, hex])
        $attributes = [
            'Metal / Material' => ['button', [
                'Brass', 'Copper', 'Bronze', 'Mixed Metal',
            ]],
            'Colour / Finish' => ['color_swatch', [
                ['Polished Gold', '#d9a93a'],
                ['Antique Brass', '#a8782a'],
                ['Copper Tone', '#b8704a'],
                ['Oxidised Black', '#2a2522'],
                ['Silver Tone', '#c9c9c9'],
            ]],
            'Size (Height)' => ['button', [
                'Up to 4 in', '4 – 8 in', '8 – 12 in', '12 in & Above',
            ]],
            'Style' => ['button', [
                'Antique', 'Traditional', 'Contemporary', 'Hand Engraved',
            ]],
        ];

        $order = 1;
        $parents = Category::whereNull('parent_id')->get();

        foreach ($attributes as $name => [$type, $values]) {
            $attribute = Attribute::updateOrCreate(
                ['slug' => Str::slug($name)],
                [
                    'name'           => $name,
                    'type'           => $type,   // adjust if your column uses other values
                    'has_values'     => 1,
                    'status'         => 1,
                    'show_in_navbar' => 0,
                ]
            );

            foreach ($values as $i => $v) {
                [$label, $hex] = is_array($v) ? $v : [$v, null];

                AttributeValue::updateOrCreate(
                    ['attribute_id' => $attribute->id, 'slug' => Str::slug($label)],
                    [
                        'value'      => $label,
                        'hex_code'   => $hex,
                        'sort_order' => $i + 1,
                        'status'     => 1,
                    ]
                );
            }

            // map attribute to every parent category (shown in /products filter)
            foreach ($parents as $parent) {
                CategoryAttribute::updateOrCreate(
                    ['category_id' => $parent->id, 'attribute_id' => $attribute->id],
                    [
                        'is_selectable'    => 0,
                        'used_for_variant' => 0,
                        'price_dependent'  => 0,
                        'image_dependent'  => 0,
                        'stock_dependent'  => 0,
                        'sku_dependent'    => 0,
                        'show_in_filter'   => 1,
                        'show_on_listing'  => 0,
                        'sort_order'       => $order,
                        'status'           => 1,
                    ]
                );
            }

            $order++;
        }
    }
}