<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $tree = [

            'Brass Idols & Statues' => [
                'description'        => 'Handcrafted brass idols and statues of gods, goddesses and sacred figures, finished by Indian artisans for pooja rooms, gifting and home decor.',
                'collection_eyebrow' => 'The Parijat Collection',
                'collection_title'   => 'Sacred Figures, Shaped by Hand.',
                'collection_text'    => 'From Ganesh and Lakshmi to decorative figurines, find the piece that brings devotion and character to your home.',
                'art_eyebrow'        => 'A TRADITION IN BRASS',
                'art_title'          => 'The Art of the Brass Idol',
                'art_text'           => 'Brass idols have been cast and finished by Indian artisans for generations. Each piece carries fine detailing and the quiet presence of a craft passed from hand to hand.',
                'art_caption'        => 'The Parijat Edit',
                'art_points'         => [
                    ['title' => 'Solid Brass Casting',   'text' => 'Weighty, durable pieces that develop a rich glow over time.'],
                    ['title' => 'Hand Finished Detail',  'text' => 'Faces, ornaments and fine lines are finished by hand, so no two pieces are exactly alike.'],
                    ['title' => 'Packed for Safe Shipping', 'text' => 'Wrapped with care so your idol arrives ready to be placed.'],
                ],
                'children' => [
                    'Ganesh'              => 'Brass Ganesh idols in sitting, dancing and blessing poses, made to welcome prosperity and new beginnings into your home.',
                    'Lakshmi'             => 'Detailed brass Lakshmi statues for pooja rooms and festive gifting, crafted to bring grace and abundance to your space.',
                    'Animals & Figurines' => 'Brass animal figurines and decorative statues, from elephants to horses, made to add character to shelves and entryways.',
                ],
            ],

            'Pooja Essentials' => [
                'description'        => 'Everything for daily worship and festive rituals, from incense burners to pooja thalis, crafted in brass and copper for lasting use.',
                'collection_eyebrow' => 'The Parijat Collection',
                'collection_title'   => 'Everything for Your Daily Pooja.',
                'collection_text'    => 'Thalis, kalash, incense burners and more, made to keep your rituals complete and your pooja room beautiful.',
                'art_eyebrow'        => 'MADE FOR RITUAL',
                'art_title'          => 'The Art of Pooja Essentials',
                'art_text'           => 'Pooja is part of every morning and every festival. Our brass and copper essentials are shaped by Indian artisans to be used daily and passed down.',
                'art_caption'        => 'The Parijat Edit',
                'art_points'         => [
                    ['title' => 'Pure Brass and Copper', 'text' => 'Traditional metals chosen for their durability and their place in Indian worship.'],
                    ['title' => 'Made for Daily Use',    'text' => 'Comfortable, sturdy designs that hold up to everyday rituals.'],
                    ['title' => 'Gift Ready',            'text' => 'Complete sets that make thoughtful housewarming and festive gifts.'],
                ],
                'children' => [
                    'Incense Burners'  => 'Brass incense and dhoop burners, designed for steady burning and made to suit daily pooja and quiet evenings.',
                    'Pooja Thali Sets' => 'Complete brass pooja thali sets with the essentials for aarti, festivals and housewarming gifts.',
                    'Kalash & Lota'    => 'Traditional brass kalash and lota pieces for rituals, ceremonies and auspicious occasions.',
                ],
            ],

            'Copper Drinkware' => [
                'description'        => 'Pure copper bottles, jugs and tumblers in hammered and plain finishes, made for everyday use and traditional wellness.',
                'collection_eyebrow' => 'The Parijat Collection',
                'collection_title'   => 'Copper for Everyday Sips.',
                'collection_text'    => 'Bottles, jugs, tumblers and goblets with a hand-finished look, made for your table and your daily routine.',
                'art_eyebrow'        => 'A TRADITION IN COPPER',
                'art_title'          => 'The Art of Copper Drinkware',
                'art_text'           => 'Drinking from copper is an old Indian habit. Our pieces are shaped and hammered by hand, so every bottle and goblet has its own character.',
                'art_caption'        => 'The Parijat Edit',
                'art_points'         => [
                    ['title' => 'Pure Copper Build',   'text' => 'Made from quality copper for lasting everyday use.'],
                    ['title' => 'Hammered by Hand',    'text' => 'The hammered finish is done by hand, so each piece is slightly different.'],
                    ['title' => 'Easy to Gift',        'text' => 'Sets and single pieces that work well for weddings and festivals.'],
                ],
                'children' => [
                    'Water Bottles'   => 'Copper water bottles in practical sizes, made for daily use at home, at work and on the go.',
                    'Jugs & Tumblers' => 'Copper jugs and tumbler sets for the table, with hand-finished surfaces and a classic look.',
                    'Goblets'         => 'Hammered copper goblets with a hand-finished look, made for the dining table and for gifting.',
                ],
            ],

            'Brass Diyas & Lamps' => [
                'description'        => 'Handcrafted brass diyas, oil lamps and aarti lamps, made for daily pooja, festive evenings and warm, welcoming homes.',
                'collection_eyebrow' => 'The Parijat Collection',
                'collection_title'   => 'Lamps Made to Be Lit and Loved.',
                'collection_text'    => 'From everyday oil lamps to festive peacock diyas, find the piece that brings light to your home.',
                'art_eyebrow'        => 'A TRADITION IN BRASS',
                'art_title'          => 'The Art of the Brass Diya',
                'art_text'           => 'A brass diya is part of every evening aarti and every festival. Shaped and finished by Indian artisans, each piece carries the warmth of a craft handed down through generations.',
                'art_caption'        => 'The Parijat Edit',
                'art_points'         => [
                    ['title' => 'Solid Brass Build',        'text' => 'Weighty, long-lasting pieces that polish up beautifully with time.'],
                    ['title' => 'Hand Finished Detail',     'text' => 'Every curve and motif is finished by hand, so no two pieces are exactly alike.'],
                    ['title' => 'Packed for Safe Shipping', 'text' => 'Wrapped with care so your lamp arrives ready to light.'],
                ],
                'children' => [
                    'Oil Lamps'     => 'Classic brass oil lamps for daily pooja and festive lighting, finished by hand for a warm glow.',
                    'Peacock Diyas' => 'Brass diyas with peacock motifs, made for festive evenings, gifting and pooja rooms.',
                    'Kuber & Lotus' => 'Kuber and lotus-shaped brass diyas, made for Diwali, Dhanteras and auspicious occasions.',
                    'Diya Stands'   => 'Brass diya stands in traditional designs, made to hold your lamps with grace.',
                    'Hanging Lamps' => 'Brass hanging lamps for temples, entryways and festive decor, crafted with fine detailing.',
                    'Aarti Diyas'   => 'Brass aarti diyas with comfortable handles, made for daily aarti and festival worship.',
                ],
            ],

            'Antique Locks & Keys' => [
                'description'        => 'Antique-style brass locks and keys, made for collectors, decorators and anyone who loves traditional craftsmanship.',
                'collection_eyebrow' => 'The Parijat Collection',
                'collection_title'   => 'Heritage You Can Hold.',
                'collection_text'    => 'Antique-style locks and decorative keys that bring old-world character to doors, cabinets and walls.',
                'art_eyebrow'        => 'OLD-WORLD CRAFT',
                'art_title'          => 'The Art of the Antique Lock',
                'art_text'           => 'Traditional locks and keys were once made entirely by hand. We bring that look back in solid brass, for decor, collecting and everyday use.',
                'art_caption'        => 'The Parijat Edit',
                'art_points'         => [
                    ['title' => 'Antique Finish',        'text' => 'An aged, heritage look that suits traditional and modern spaces alike.'],
                    ['title' => 'Solid Brass',           'text' => 'Heavy, durable pieces built to last.'],
                    ['title' => 'Great for Decor',       'text' => 'Works as a display piece, a wall accent or a gift for collectors.'],
                ],
                'children' => [
                    'Door Locks'      => 'Antique-style brass door locks with a heritage look, made for doors, cabinets and decor.',
                    'Decorative Keys' => 'Decorative brass keys in traditional shapes, made for display, gifting and wall decor.',
                ],
            ],

            'Bells & Wind Chimes' => [
                'description'        => 'Brass temple bells and wind chimes with a clear, soothing sound, made for pooja rooms, balconies and gardens.',
                'collection_eyebrow' => 'The Parijat Collection',
                'collection_title'   => 'Sounds That Calm the Home.',
                'collection_text'    => 'Temple bells for aarti and wind chimes for the breeze, tuned for a clear and gentle ring.',
                'art_eyebrow'        => 'A TRADITION IN BRASS',
                'art_title'          => 'The Art of the Brass Bell',
                'art_text'           => 'The sound of a bell marks every aarti. Our brass bells and chimes are cast and finished by Indian artisans for a clear tone that carries.',
                'art_caption'        => 'The Parijat Edit',
                'art_points'         => [
                    ['title' => 'Clear, Lasting Tone', 'text' => 'Cast in brass for a bright and soothing ring.'],
                    ['title' => 'Hand Finished',       'text' => 'Each bell and chime is finished by hand with careful detailing.'],
                    ['title' => 'Packed with Care',    'text' => 'Wrapped securely so every piece arrives intact.'],
                ],
                'children' => [
                    'Temple Bells' => 'Brass temple bells with a clear tone, made for daily aarti, pooja rooms and entrances.',
                    'Wind Chimes'  => 'Brass wind chimes that ring softly in the breeze, made for balconies, gardens and gifting.',
                ],
            ],
        ];

        $order = 1;

        foreach ($tree as $parentName => $data) {
            $parent = Category::updateOrCreate(
                ['slug' => Str::slug($parentName)],
                [
                    'name'               => $parentName,
                    'parent_id'          => null,
                    'sub_title'          => null,
                    'description'        => $data['description'] ?? null,

                    'collection_eyebrow' => $data['collection_eyebrow'] ?? null,
                    'collection_title'   => $data['collection_title'] ?? null,
                    'collection_text'    => $data['collection_text'] ?? null,

                    'art_eyebrow'        => $data['art_eyebrow'] ?? null,
                    'art_title'          => $data['art_title'] ?? null,
                    'art_text'           => $data['art_text'] ?? null,
                    'art_points'         => $data['art_points'] ?? null,
                    'art_caption'        => $data['art_caption'] ?? null,

                    'meta_title'         => $parentName . ' | Parijat Handicraft',
                    'meta_description'   => 'Shop handcrafted ' . strtolower($parentName) . ' from Parijat Handicraft.',
                    'sort_order'         => $order++,
                    'status'             => 1,
                    'is_popular'         => 1,
                    'is_featured'        => 1,
                    'show_in_navbar'     => 1,
                ]
            );

            $i = 0;
            foreach ($data['children'] as $childName => $childDescription) {
                Category::updateOrCreate(
                    ['slug' => Str::slug($parentName . ' ' . $childName)],
                    [
                        'name'           => $childName,
                        'parent_id'      => $parent->id,
                        'description'    => $childDescription,
                        'meta_title'     => $childName . ' | Parijat Handicraft',
                        'sort_order'     => ++$i,
                        'status'         => 1,
                        'is_popular'     => 0,
                        'is_featured'    => 0,
                        'show_in_navbar' => 0,
                    ]
                );
            }
        }
    }
}