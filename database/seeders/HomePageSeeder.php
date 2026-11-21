<?php

namespace Database\Seeders;

use App\Models\HomeBanner;
use App\Models\HomeCard;
use App\Models\HomeSection;
use App\Models\HomeStory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class HomePageSeeder extends Seeder
{
    public function run(): void
    {
        $this->banners();
        $this->story();
        $this->sections();
        $this->craftCards();
        $this->whyCards();
        $this->marketplaceCards();
        $this->reelCards();
        $this->offerCards();
        $this->promiseCards();
    }

    /** Copy a file from /public into the public disk. Returns the stored path or null. */
    private function copyAsset(string $source, string $target): ?string
    {
        $from = public_path($source);

        if (!File::exists($from)) {
            $this->command?->warn("Missing image, skipped: {$source}");

            return null;
        }

        Storage::disk('public')->put($target, File::get($from));

        return $target;
    }

    /* ------------------------------------------------------------ hero banners */
    private function banners(): void
    {
        $rows = [
            [
                'eyebrow' => 'Timeless Home Collection',
                'title' => 'Give Your Home a Touch of Artistry.',
                'description' => 'Explore distinctive decorative pieces, handcrafted accents and timeless creations that add warmth and character to every space.',
                'button_text' => 'Shop Home Decor',
                'button_link' => '/products',
                'src' => 'assets/images/home/herobanner.png',
                'image' => 'home-banners/herobanner.png',
                'image_alt' => 'Handcrafted brass decor and traditional accessories',
            ],
            [
                'eyebrow' => 'Celebrate with Tradition',
                'title' => 'Bring Home the Beauty of Tradition.',
                'description' => 'From traditional diyas to elegant pooja essentials, discover handcrafted pieces that make every celebration more meaningful.',
                'button_text' => 'Shop Pooja Collection',
                'button_link' => '/products',
                'src' => 'assets/images/home/herobanner2.png',
                'image' => 'home-banners/herobanner2.png',
                'image_alt' => 'Brass diya, pooja thali and traditional accessories',
            ],
        ];

        foreach ($rows as $i => $r) {
            $image = $this->copyAsset($r['src'], $r['image']);

            if (!$image) {
                continue; // image is required for a banner
            }

            HomeBanner::updateOrCreate(
                ['title' => $r['title']],
                [
                    'eyebrow' => $r['eyebrow'],
                    'description' => $r['description'],
                    'button_text' => $r['button_text'],
                    'button_link' => $r['button_link'],
                    'image' => $image,
                    'image_alt' => $r['image_alt'],
                    'sort_order' => $i + 1,
                    'status' => 1,
                ]
            );
        }
    }

    /* ------------------------------------------------------------ brand story (secC) */
    private function story(): void
    {
        // the small tilted detail photo was an external Unsplash URL, so it is left empty:
        // upload your own from Admin > Home Page > Brand Story
        $main = $this->copyAsset('assets/images/home/cat3.png', 'home-story/main.png');

        HomeStory::updateOrCreate(['id' => 1], [
            'eyebrow' => 'Our Heritage, Your Home',
            'title' => 'Crafted with Passion. Inspired by Tradition.',
            'description' => 'Every handcrafted creation tells a story of skill, patience and artistic expression. At Parijaat Handicraft, we bring together traditional inspiration and distinctive decorative pieces to make everyday spaces feel special.',
            'main_image' => $main,
            'main_image_alt' => 'Artisan shaping handcrafted pieces in a workshop',
            'detail_image' => null,
            'detail_image_alt' => 'Close-up of handcrafted brass detail',
            'badge_text' => 'Handcrafted in India',
            'pillars' => [
                ['icon' => 'fa-solid fa-hammer', 'title' => 'Fine Craft', 'text' => 'Shaped with care and fine detail.'],
                ['icon' => 'fa-solid fa-hourglass-half', 'title' => 'Timeless Design', 'text' => 'Tradition made for modern homes.'],
                ['icon' => 'fa-solid fa-wand-magic-sparkles', 'title' => 'Unique Pieces', 'text' => 'Pieces that make homes special.'],
            ],
            'primary_btn_text' => 'Discover Our Story',
            'primary_btn_link' => '/about',
            'secondary_btn_text' => 'Explore Collection',
            'secondary_btn_link' => '/products',
            'status' => 1,
        ]);
    }

    /* ------------------------------------------------------------ single blocks / headings */
    private function sections(): void
    {
        $feature = $this->copyAsset('assets/images/home/cat1.png', 'home-sections/sacred-spaces.png');
        $partner = $this->copyAsset('assets/images/home/cat1.png', 'home-sections/partner.png');
        $news = $this->copyAsset('assets/images/home/contact.png', 'home-sections/newsletter.png');

        $rows = [
            'craft' => [
                'eyebrow' => 'CURATED FOR EVERY SPACE',
                'title' => 'Discover Your Kind of Craft.',
                'description' => 'From sacred corners to beautifully styled interiors, explore collections that make every space more personal.',
                'btn1_text' => 'Explore Collections',
                'btn1_link' => '/products',
                'btn2_text' => 'Shop All Decor',
                'btn2_link' => '/products',
            ],
            'craft_feature' => [
                'eyebrow' => 'Pooja Essentials',
                'title' => 'Sacred Spaces',
                'description' => 'Brass idols, diyas and pooja thalis crafted to bring peace and devotion to every corner of your home.',
                'image' => $feature,
                'image_alt' => 'Sacred Spaces',
                'btn1_text' => 'Shop Pooja Essentials',
                'btn1_link' => '/products',
            ],
            'why' => [
                'eyebrow' => 'WHY CHOOSE PARIJAAT HANDICRAFT',
                'title' => 'The Parijaat Difference.',
                'description' => 'A thoughtful approach to craftsmanship, collection and customer experience.',
            ],
            'affiliate' => [
                'eyebrow' => 'BECOME A PARTNER',
                'title' => 'Share the Craft. Grow Together.',
                'description' => 'Love beautiful handcrafted products? Partner with Parijaat Handicraft and introduce the beauty of Indian craftsmanship to a wider audience.',
                'image' => $partner,
                'image_alt' => 'Handcrafted brass idol by Parijaat Handicraft',
                'btn1_text' => 'Apply for Partnership',
                'btn2_text' => 'How It Works',
                'btn2_link' => '#',
                'lines' => ['Promote Unique Handcrafted Products', 'Access Partnership Opportunities', 'Grow With Our Brand'],
            ],
            'recent' => [
                'eyebrow' => 'RECENTLY VIEWED',
                'title' => 'Pick Up Where You Left Off.',
                'description' => "Take another look at the handcrafted pieces you've recently explored.",
            ],
            'marketplace' => [
                'eyebrow' => 'ALSO AVAILABLE ON',
                'title' => 'Find Us on Your Favourite Marketplace.',
                'description' => 'Shop Parijaat Handicraft on our own store or on trusted global marketplaces, wherever you prefer to buy.',
            ],
            'reviews' => [
                'eyebrow' => 'KIND WORDS FROM OUR CUSTOMERS',
                'title' => 'Loved for the Details.',
                'description' => 'See what customers appreciate about their Parijaat Handicraft purchases.',
            ],
            'reels' => [
                'eyebrow' => 'WATCH & DISCOVER',
                'title' => 'See Our Craft in Motion.',
                'description' => 'Short reels from our workshop, from the first hammer strike to the final polish.',
                'btn1_text' => 'Follow Us on Instagram',
                'btn1_link' => '',
            ],
            'offers' => [
                'eyebrow' => 'OFFERS & DEALS',
                'title' => 'Festive Offers, Handpicked for You.',
                'description' => 'Special savings on handcrafted pieces for every celebration and every home.',
            ],
            'newsletter' => [
                'title' => 'Join our family',
                'description' => 'Promotions, new products and offers. Directly to your inbox.',
                'image' => $news,
                'image_alt' => 'Handcrafted brass decor',
            ],
        ];

        foreach ($rows as $key => $data) {
            HomeSection::updateOrCreate(['key' => $key], $data + ['status' => 1]);
        }
    }

    /* ------------------------------------------------------------ secF cards */
    private function craftCards(): void
    {
        $rows = [
            ['Timeless Interiors', 'Brass home decor that adds warmth and character.', 'cat1.png'],
            ['Artful Living', 'Decorative sculptures with distinctive artistry.', 'cat2.png'],
            ['The Art of Dining', 'Copper & brass tableware for elegant tables.', 'cat3.png'],
            ['Lamps & Diyas', 'Handcrafted brass lamps for every festival.', 'cat4.png'],
            ['Bells & Chimes', 'Soulful brass bells and wind chimes.', 'cat6.png'],
            ['Antique Locks', 'Vintage brass locks with old-world charm.', 'cat5.png'],
        ];

        foreach ($rows as $i => [$title, $text, $file]) {
            $image = $this->copyAsset("assets/images/home/{$file}", "home-cards/craft-{$file}");

            if (!$image) {
                continue;
            }

            HomeCard::updateOrCreate(
                ['section' => 'craft', 'title' => $title],
                ['text' => $text, 'image' => $image, 'link' => '/products', 'sort_order' => $i + 1, 'status' => 1]
            );
        }
    }

    /* ------------------------------------------------------------ secH items */
    private function whyCards(): void
    {
        $rows = [
            ['Distinctive Craftsmanship', 'Carefully selected handcrafted designs.', 'fa-solid fa-gem'],
            ['Thoughtful Collections', 'Pieces for different spaces and occasions.', 'fa-solid fa-table-cells-large'],
            ['Secure Shopping', 'A safe and reliable checkout experience.', 'fa-solid fa-shield-halved'],
            ['Worldwide Reach', 'Shopping designed for customers in India and abroad.', 'fa-solid fa-globe'],
        ];

        foreach ($rows as $i => [$title, $text, $icon]) {
            HomeCard::updateOrCreate(
                ['section' => 'why', 'title' => $title],
                ['text' => $text, 'icon' => $icon, 'sort_order' => $i + 1, 'status' => 1]
            );
        }
    }

    /* ------------------------------------------------------------ secP marketplaces */
    private function marketplaceCards(): void
    {
        // store links are the client's: fill them in from Admin > Home Page > Marketplaces
        $rows = [
            ['Amazon', 'Shop our handcrafted range on Amazon.', 'amazon.png'],
            ['Alibaba', 'Bulk and wholesale orders for global buyers.', 'alibaba.png'],
            ['eBay', 'Find our decor and collectible pieces on eBay.', 'ebay.png'],
        ];

        foreach ($rows as $i => [$title, $text, $file]) {
            $image = $this->copyAsset("assets/icon/{$file}", "home-cards/{$file}");

            if (!$image) {
                continue;
            }

            HomeCard::updateOrCreate(
                ['section' => 'marketplace', 'title' => $title],
                ['text' => $text, 'image' => $image, 'link' => null, 'sort_order' => $i + 1, 'status' => 1]
            );
        }
    }

    /* ------------------------------------------------------------ secN reels */
    private function reelCards(): void
    {
        $video = 'https://youtube.com/embed/HyJfGib_Ds4'; // placeholder from the static template

        $rows = [
            ['Brass Idol Finishing', 'Hand polished by our artisans', 'cat1.png'],
            ['Pooja Thali Setup', 'Styling your daily aarti', 'cat2.png'],
            ['Copper Hammering', 'Every dent is made by hand', 'cat3.png'],
            ['Lighting the Diya', null, 'cat4.png'],
            ['Antique Lock Detail', 'Old world craft, up close', 'cat5.png'],
            ['Bells & Chimes', 'Hear the sound of brass', 'cat6.png'],
        ];

        foreach ($rows as $i => [$title, $text, $file]) {
            $image = $this->copyAsset("assets/images/home/{$file}", "home-cards/reel-{$file}");

            if (!$image) {
                continue;
            }

            HomeCard::updateOrCreate(
                ['section' => 'reel', 'title' => $title],
                ['text' => $text, 'image' => $image, 'link' => $video, 'sort_order' => $i + 1, 'status' => 1]
            );
        }
    }

    /* ------------------------------------------------------------ secE offer cards */
    private function offerCards(): void
    {
        // first row = big feature card. Edit links/badges from Admin > Home Page > Offers & Deals
        $rows = [
            ['Diwali Offers', 'Light up your celebrations with handcrafted brass decor at festive prices.', 'diwali_7_11zon.png', '40%', 'OFF', 'EXPLORE DIWALI EDIT'],
            ['Janmashtami Offers', null, 'jam_6_11zon.png', '40%', 'OFF', null],
            ['Free Shipping', null, 'free_5_11zon.png', 'FREE', 'SHIPPING', null],
            ['Best Selling', null, 'bressbell_1_11zon.png', '40%', 'OFF', null],
            ['Door Lock', null, 'door_3_11zon.png', '40%', 'OFF', null],
            ['Brass Bell', null, 'pro30.jpg', '40%', 'OFF', null],
            ['Dinner Set', null, 'dinner_2_11zon.png', '40%', 'OFF', null],
        ];

        foreach ($rows as $i => [$title, $text, $file, $big, $small, $btn]) {
            $image = $this->copyAsset("assets/images/home/{$file}", "home-cards/offer-{$file}");

            if (!$image) {
                continue;
            }

            HomeCard::updateOrCreate(
                ['section' => 'offer', 'title' => $title],
                [
                    'text' => $text,
                    'image' => $image,
                    'link' => '/products',
                    'badge_big' => $big,
                    'badge_small' => $small,
                    'btn_text' => $btn,
                    'sort_order' => $i + 1,
                    'status' => 1,
                ]
            );
        }
    }

    /* ------------------------------------------------------------ footer promise */
    private function promiseCards(): void
    {
        $rows = [
            ['Worldwide Shipping', 'Every order is carefully packed and safely delivered across India and to customers worldwide.', 'fa-solid fa-truck-fast'],
            ['Authentic Craftsmanship', 'Each piece is handcrafted with fine detailing, made to last for generations.', 'fa-regular fa-gem'],
            ['Your Happiness, Guaranteed', 'Easy returns, secure payments and friendly support on every purchase.', 'fa-regular fa-heart'],
        ];

        foreach ($rows as $i => [$title, $text, $icon]) {
            HomeCard::updateOrCreate(
                ['section' => 'promise', 'title' => $title],
                ['text' => $text, 'icon' => $icon, 'sort_order' => $i + 1, 'status' => 1]
            );
        }
    }

}