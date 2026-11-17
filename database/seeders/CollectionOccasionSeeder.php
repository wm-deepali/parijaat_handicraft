<?php

namespace Database\Seeders;

use App\Models\Collection;
use App\Models\GiftingOccasion;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CollectionOccasionSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['Best Sellers', 'New Arrivals', 'Festive Special'] as $i => $name) {
            Collection::updateOrCreate(
                ['slug' => Str::slug($name)],
                [
                    'name'           => $name,
                    'meta_title'     => $name . ' | Parijat Handicraft',
                    'code'           => strtoupper(Str::slug($name, '_')),
                    'status'         => 1,
                    'sort_order'     => $i + 1,
                    'show_in_navbar' => 0,
                ]
            );
        }

        foreach (['Diwali', 'Daily Pooja', 'Housewarming', 'Wedding', 'Gifting'] as $title) {
            GiftingOccasion::updateOrCreate(
                ['slug' => Str::slug($title)],
                [
                    'title'             => $title,
                    'sub_title'         => $title . ' picks',
                    'short_description' => 'Handcrafted pieces for ' . strtolower($title) . '.',
                    'meta_title'        => $title . ' | Parijat Handicraft',
                    'status'            => 1,
                ]
            );
        }
    }
}