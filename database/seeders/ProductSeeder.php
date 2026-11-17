<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // parent => [ sub => [ [name, mrp, price], ... ] ]
        $catalog = [
            'Brass Diyas & Lamps' => [
                'Oil Lamps'     => [['Handmade Brass Oil Lamp', 249, 199], ['Brass Traditional Oil Lamp', 299, 249], ['Brass Table Oil Lamp', 199, 169]],
                'Peacock Diyas' => [['Brass Peacock Diya', 359, 299], ['Brass Peacock Aarti Lamp', 419, 349], ['Brass Mini Peacock Diya', 179, 149]],
                'Kuber & Lotus' => [['Brass Lotus Kuber Diya', 210, 179], ['Brass Kuber Diya Set of 2', 349, 299], ['Brass Lotus Floating Diya', 159, 129]],
                'Diya Stands'   => [['Brass Elephant Diya Stand', 299, 249], ['Brass Tall Diya Stand', 399, 329], ['Brass Tree Diya Stand', 459, 389]],
                'Hanging Lamps' => [['Brass Hanging Diya Lamp', 339, 279], ['Brass Chain Hanging Lamp', 399, 339], ['Brass Bell Hanging Lamp', 289, 239]],
                'Aarti Diyas'   => [['Brass Five-Wick Aarti Diya', 165, 139], ['Brass Akhand Jyot Diya', 129, 109], ['Brass Kamakshi Deepam', 235, 199]],
            ],
            'Brass Idols & Statues' => [
                'Ganesh'              => [['Brass Ganesh Idol', 899, 749], ['Brass Sitting Ganesha Statue', 1299, 1049]],
                'Lakshmi'             => [['Brass Lakshmi Idol', 1199, 999], ['Brass Lakshmi Ganesh Set', 1799, 1499]],
                'Animals & Figurines' => [['Brass Decorative Rabbit Figurine', 469, 399], ['Brass Elephant Pair', 799, 679]],
            ],
            'Pooja Essentials' => [
                'Incense Burners'  => [['Brass Aladdin Incense Burner', 179, 149], ['Brass Dhoop Dani', 249, 209]],
                'Pooja Thali Sets' => [['Brass Pooja Thali Set', 899, 749], ['Brass Aarti Thali Set', 699, 579]],
                'Kalash & Lota'    => [['Brass Pooja Kalash', 549, 459], ['Brass Achamani Lota', 299, 249]],
            ],
            'Copper Drinkware' => [
                'Water Bottles'   => [['Copper Water Bottle', 155, 129], ['Hammered Copper Bottle', 299, 249]],
                'Jugs & Tumblers' => [['Copper Jug with Tumblers', 419, 349], ['Copper Jug Set of 4', 599, 499]],
                'Goblets'         => [['Hammered Copper Goblet', 119, 99], ['Copper Goblet Set of 2', 229, 189]],
            ],
            'Antique Locks & Keys' => [
                'Door Locks'      => [['Antique Brass Lock', 119, 99], ['Brass Padlock with Key', 249, 209]],
                'Decorative Keys' => [['Antique Brass Key Set', 199, 169]],
            ],
            'Bells & Wind Chimes' => [
                'Temple Bells' => [['Brass Temple Bell', 199, 159], ['Brass Hanging Door Bell', 349, 289]],
                'Wind Chimes'  => [['Brass Wind Chime', 275, 229], ['Brass Bell Wind Chime', 399, 329]],
            ],
        ];

        $n = 1;

        foreach ($catalog as $parentName => $subs) {
            $parent = Category::whereNull('parent_id')->where('slug', Str::slug($parentName))->first();
            if (!$parent) {
                continue; // run CategorySeeder first
            }

            foreach ($subs as $subName => $items) {
                $sub = Category::where('parent_id', $parent->id)
                    ->where('slug', Str::slug($parentName . ' ' . $subName))
                    ->first();

                foreach ($items as [$name, $mrp, $price]) {
                    $sku = 'PJ-' . str_pad($n++, 4, '0', STR_PAD_LEFT);

                    Product::updateOrCreate(
                        ['sku' => $sku],
                        [
                            'category_id'       => $parent->id,
                            'subcategory_id'    => $sub?->id,
                            'name'              => $name,
                            'slug'              => Str::slug($name) . '-' . strtolower($sku),
                            'short_description' => 'Handcrafted ' . strtolower($name) . ', finished by Indian artisans.',
                            'material_craft'   => str_contains($name, 'Copper') ? 'Copper' : 'Brass',
                            'mrp'               => $mrp,
                            'discount_type'     => 'percentage', // adjust to your enum/values
                            'discount'          => round((($mrp - $price) / $mrp) * 100),
                            'price'             => $price,
                            'stock'             => rand(5, 50),
                            'min_qty'           => 1,
                            'delivery_time'     => '5-7 days', // adjust if this column is numeric
                            'status'            => 1,
                            'meta_title'        => $name . ' | Parijat Handicraft',
                        ]
                    );
                }
            }
        }
    }
}