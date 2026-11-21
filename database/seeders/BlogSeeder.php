<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->posts() as $p) {
            $image = $this->copyAsset($p['src'], 'blogs/' . basename($p['src']));

            Blog::updateOrCreate(
                ['slug' => $p['slug']],
                [
                    'title' => $p['title'],
                    'category' => $p['category'],
                    'author' => 'Parijaat Team',
                    'tags' => $p['tags'],
                    'published_at' => $p['date'],
                    'image' => $image,
                    'short_description' => $p['excerpt'],
                    'content' => $p['content'],
                    'meta_title' => $p['title'],
                    'meta_description' => $p['excerpt'],
                    'views' => $p['views'],
                    'show_home' => $p['show_home'] ?? 0,
                    'is_featured' => $p['featured'] ?? 0,
                    'status' => 1,
                ]
            );
        }
    }

    /** Copy a file from /public into the public disk. Returns the stored path or null (blog falls back to its default image). */
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

    private function posts(): array
    {
        return [
            // ---- featured (big card on /blogs) ----
            [
                'slug' => 'how-to-set-up-a-beautiful-pooja-corner-at-home',
                'title' => 'How to Set Up a Beautiful Pooja Corner at Home',
                'category' => 'Pooja Guide',
                'tags' => 'Pooja, Brass Diya, Home Decor',
                'date' => '2026-11-08',
                'src' => 'assets/images/home/diwali_7_11zon.png',
                'excerpt' => 'From brass diyas and thalis to placement and lighting, a simple guide to creating a calm, devotional space in any home.',
                'views' => 320,
                'featured' => 1,
                'show_home' => 1,
                'content' => <<<'HTML'
<p>A pooja corner does not need much space. It needs a clean spot, a few well-chosen pieces and a little light. Here is a simple way to set one up.</p>

<h2>1. Choose the right spot</h2>
<p>Pick a quiet, clean corner that gets natural light. Keep it away from bathrooms and storage areas, and give the idols enough space around them.</p>

<h2>2. Pick your essentials</h2>
<p>Start small and add pieces over time:</p>
<ul>
    <li><strong>Idols:</strong> brass idols stay beautiful for generations.</li>
    <li><strong>Diyas and lamps:</strong> a pair of brass diyas adds a warm glow.</li>
    <li><strong>Pooja thali:</strong> keeps incense, kumkum and flowers together.</li>
    <li><strong>Bell:</strong> a small brass bell completes the daily aarti.</li>
</ul>

<h2>3. Light it softly</h2>
<p>Warm, soft light works best. A diya or a small lamp is often enough, and it keeps the space calm.</p>
HTML,
            ],

            // ---- the article shown on the static detail page ----
            [
                'slug' => 'how-to-clean-and-polish-brass-at-home-without-damaging-it',
                'title' => 'How to Clean and Polish Brass at Home Without Damaging It',
                'category' => 'Care Guide',
                'tags' => 'Brass Care, Home Decor, Handicrafts',
                'date' => '2026-11-10',
                'src' => 'assets/images/home/pro30.jpg',
                'excerpt' => 'Simple, gentle methods to bring back the glow of your brass pieces and keep them looking new for years.',
                'views' => 280,
                'show_home' => 1,
                'content' => <<<'HTML'
<p>Brass is made to be lived with. Over time it naturally darkens, but a little regular care keeps it glowing. Here is a <strong>simple routine</strong> you can follow at home without harming the finish.</p>

<h2>1. Know your finish first</h2>
<p>Some brass pieces are lacquered for a permanent shine, while others are left raw so they can age gracefully. Check which type you own before you clean it.</p>

<h2>2. Start with gentle cleaning</h2>
<p>For regular dust and light marks, mild methods work best. Avoid anything harsh or abrasive, especially on detailed or engraved work.</p>
<ul>
    <li><strong>Soft cloth:</strong> wipe away dust weekly with a dry, clean cotton cloth.</li>
    <li><strong>Mild soap and warm water:</strong> ideal for lacquered pieces. Dry thoroughly afterwards.</li>
    <li><strong>Lemon and salt:</strong> a traditional method for raw, unlacquered brass only.</li>
</ul>

<h2>3. Polish step by step</h2>
<p>When raw brass loses its shine, a gentle polish brings it back. Follow these steps:</p>
<ol>
    <li>Wipe the piece clean and let it dry completely.</li>
    <li>Apply a small amount of polish with a soft cloth.</li>
    <li>Rub gently in small circles, following the detailing.</li>
    <li>Rinse with warm water and dry right away.</li>
    <li>Buff with a dry cloth until the glow returns.</li>
</ol>

<blockquote>Good brass is never really finished. It simply gets better with the care you give it.</blockquote>

<h3>Keep it shining for longer</h3>
<p>Store brass in a dry place and keep it away from damp corners.</p>
HTML,
            ],

            [
                'slug' => 'the-timeless-tradition-of-copper-drinkware',
                'title' => 'The Timeless Tradition of Copper Drinkware',
                'category' => 'Copper',
                'tags' => 'Copper, Drinkware, Tradition',
                'date' => '2026-11-04',
                'src' => 'assets/images/home/dinner_2_11zon.png',
                'excerpt' => 'Why hammered copper goblets, jugs and bottles continue to find a place on modern Indian tables.',
                'views' => 240,
                'show_home' => 1,
                'content' => <<<'HTML'
<p>Copper vessels have been part of Indian kitchens for centuries. Today they are back on modern tables, loved for their warm colour and handcrafted look.</p>

<h2>1. Why copper endures</h2>
<p>Hammered copper catches light beautifully, and every piece carries the marks of the artisan who made it. No two goblets or jugs look exactly alike.</p>

<h2>2. Using copper every day</h2>
<p>Use copper drinkware for water and keep acidic drinks out of it. Wash with mild soap and dry well so it keeps its colour.</p>
HTML,
            ],

            [
                'slug' => 'housewarming-gift-ideas-handcrafted-brass-pieces-that-last',
                'title' => 'Housewarming Gift Ideas: Handcrafted Brass Pieces That Last',
                'category' => 'Gifting',
                'tags' => 'Gifting, Housewarming, Brass',
                'date' => '2026-10-30',
                'src' => 'assets/images/home/free_5_11zon.png',
                'excerpt' => 'Thoughtful, meaningful gifts that bring warmth and tradition into a new home.',
                'views' => 150,
                'content' => <<<'HTML'
<p>A new home deserves a gift that lasts. Handcrafted brass pieces are meaningful, useful and beautiful for years.</p>

<h2>1. Gifts for the pooja corner</h2>
<p>A brass diya, a small idol or a pooja thali is a thoughtful way to bless a new home.</p>

<h2>2. Gifts for everyday living</h2>
<p>Brass bowls, trays and bells bring tradition into daily life, and they only look better with time.</p>
HTML,
            ],

            [
                'slug' => 'choosing-a-brass-wind-chime-sound-size-and-placement',
                'title' => 'Choosing a Brass Wind Chime: Sound, Size and Placement',
                'category' => 'Home Decor',
                'tags' => 'Wind Chime, Brass, Home Decor',
                'date' => '2026-10-28',
                'src' => 'assets/images/home/bressbell_1_11zon.png',
                'excerpt' => 'A quick guide to picking a wind chime with a soothing tone and hanging it in the right spot.',
                'views' => 200,
                'content' => <<<'HTML'
<p>A good wind chime adds a gentle sound to your home. The right size and the right spot make all the difference.</p>

<h2>1. Listen for the tone</h2>
<p>Longer tubes give deeper, slower notes. Shorter ones sound lighter and brighter. Pick the tone you find calming.</p>

<h2>2. Hang it well</h2>
<p>Choose a spot with a light breeze, such as a balcony or a window. Avoid places with strong wind, which can make the sound harsh.</p>
HTML,
            ],

            [
                'slug' => 'festive-decor-ideas-with-brass-diyas-and-lamps',
                'title' => 'Festive Decor Ideas With Brass Diyas and Lamps',
                'category' => 'Festive',
                'tags' => 'Festive, Diwali, Brass Diya',
                'date' => '2026-10-22',
                'src' => 'assets/images/home/jam_6_11zon.png',
                'excerpt' => 'Simple ways to light up your home this festive season with handcrafted brass lamps.',
                'views' => 120,
                'content' => <<<'HTML'
<p>Festivals feel special when the home glows. Brass diyas and lamps are a simple way to bring that light in.</p>

<h2>1. Light the entrance</h2>
<p>Place a pair of brass diyas by the door to welcome guests.</p>

<h2>2. Layer the glow</h2>
<p>Mix tall lamps with small diyas at different heights for a soft, layered look.</p>
HTML,
            ],

            [
                'slug' => 'the-charm-of-antique-brass-locks-in-modern-interiors',
                'title' => 'The Charm of Antique Brass Locks in Modern Interiors',
                'category' => 'Home Decor',
                'tags' => 'Antique Locks, Brass, Interiors',
                'date' => '2026-10-17',
                'src' => 'assets/images/home/door_3_11zon.png',
                'excerpt' => 'How vintage locks and keys can become striking, story-rich accents in contemporary homes.',
                'views' => 180,
                'content' => <<<'HTML'
<p>Antique brass locks carry the look of another era. In a modern home they become small pieces of art.</p>

<h2>1. Display them as accents</h2>
<p>Hang a lock and key on a wall or place one on a shelf as a conversation piece.</p>

<h2>2. Let them age</h2>
<p>The patina on old brass is part of its charm, so a gentle dusting is usually all it needs.</p>
HTML,
            ],

            [
                'slug' => 'from-metal-to-masterpiece-how-brass-is-handcrafted',
                'title' => 'From Metal to Masterpiece: How Brass Is Handcrafted',
                'category' => 'Craft & Heritage',
                'tags' => 'Craft, Heritage, Brass',
                'date' => '2026-10-12',
                'src' => 'assets/images/home/cat4.png',
                'excerpt' => 'A look at the skill and patience that go into shaping, finishing and detailing each brass piece.',
                'views' => 90,
                'content' => <<<'HTML'
<p>Every brass piece begins as raw metal and ends as something an artisan has shaped by hand.</p>

<h2>1. Shaping the metal</h2>
<p>The metal is heated, cast or hammered into form. This is where the piece gets its basic shape.</p>

<h2>2. Finishing and detailing</h2>
<p>Artisans then polish and add fine detail by hand. This patient work is what makes each piece one of a kind.</p>
HTML,
            ],
        ];
    }
}