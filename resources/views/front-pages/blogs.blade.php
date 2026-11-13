{{-- resources/views/front-pages/blogs.blade.php --}}
@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/sass/blogs/blogs.css') }}" />
@endpush

@section('content')
    @php
        // Static data for now – swap with DB/controller data later.
        // tab: tab id the post belongs to (besides "All"), all: show in the "All" tab
        $posts = collect([
            ['img' => 'assets/images/home/pro30.jpg', 'alt' => 'Cleaning brass at home', 'date' => '2026-11-10', 'cat' => 'Care Guide', 'read' => 5, 'tab' => 2, 'all' => true,
                'title' => 'How to Clean and Polish Brass at Home Without Damaging It',
                'excerpt' => 'Simple, gentle methods to bring back the glow of your brass pieces and keep them looking new for years.'],
            ['img' => 'assets/images/home/dinner_2_11zon.png', 'alt' => 'Copper drinkware', 'date' => '2026-11-04', 'cat' => 'Copper', 'read' => 4, 'tab' => null, 'all' => true,
                'title' => 'The Timeless Tradition of Copper Drinkware',
                'excerpt' => 'Why hammered copper goblets, jugs and bottles continue to find a place on modern Indian tables.'],
            ['img' => 'assets/images/home/free_5_11zon.png', 'alt' => 'Housewarming gifts', 'date' => '2026-10-30', 'cat' => 'Gifting', 'read' => 5, 'tab' => 3, 'all' => true,
                'title' => 'Housewarming Gift Ideas: Handcrafted Brass Pieces That Last',
                'excerpt' => 'Thoughtful, meaningful gifts that bring warmth and tradition into a new home.'],
            ['img' => 'assets/images/home/bressbell_1_11zon.png', 'alt' => 'Brass wind chime', 'date' => '2026-10-28', 'cat' => 'Home Decor', 'read' => 4, 'tab' => 6, 'all' => true,
                'title' => 'Choosing a Brass Wind Chime: Sound, Size and Placement',
                'excerpt' => 'A quick guide to picking a wind chime with a soothing tone and hanging it in the right spot.'],
            ['img' => 'assets/images/home/jam_6_11zon.png', 'alt' => 'Festive brass decor', 'date' => '2026-10-22', 'cat' => 'Festive', 'read' => 5, 'tab' => 4, 'all' => true,
                'title' => 'Festive Decor Ideas With Brass Diyas and Lamps',
                'excerpt' => 'Simple ways to light up your home this festive season with handcrafted brass lamps.'],
            ['img' => 'assets/images/home/door_3_11zon.png', 'alt' => 'Antique brass lock', 'date' => '2026-10-17', 'cat' => 'Home Decor', 'read' => 4, 'tab' => 6, 'all' => true,
                'title' => 'The Charm of Antique Brass Locks in Modern Interiors',
                'excerpt' => 'How vintage locks and keys can become striking, story-rich accents in contemporary homes.'],
            ['img' => 'assets/images/home/cat4.png', 'alt' => 'Handcrafted brass diya', 'date' => '2026-10-12', 'cat' => 'Craft & Heritage', 'read' => 6, 'tab' => 5, 'all' => false,
                'title' => 'From Metal to Masterpiece: How Brass Is Handcrafted',
                'excerpt' => 'A look at the skill and patience that go into shaping, finishing and detailing each brass piece.'],
        ]);

        $tabs = [1 => 'All', 2 => 'Care Guides', 3 => 'Gifting', 4 => 'Festive', 5 => 'Craft & Heritage', 6 => 'Home Decor'];

        $trending = [
            ['assets/images/home/pro30.jpg', 'Brass cleaning guide', 'Care Guide · 10 Nov 2026', 'How to Clean and Polish Brass at Home Without Damaging It'],
            ['assets/images/home/dinner_2_11zon.png', 'Copper drinkware', 'Copper · 04 Nov 2026', 'The Timeless Tradition of Copper Drinkware'],
            ['assets/images/home/bressbell_1_11zon.png', 'Brass wind chime', 'Home Decor · 28 Oct 2026', 'Choosing a Brass Wind Chime: Sound, Size and Placement'],
        ];
    @endphp

    <main>
        {{-- ================= BANNER ================= --}}
        <section class="comman-banner">
            <figure class="banner-media">
                <img src="{{ asset('assets/images/home/blog.png') }}" alt="" loading="eager" />
            </figure>

            <div class="banner-top">
                <div class="container">
                    <ul class="banner-crumb">
                        <li><a href="index.html">Home</a></li>
                        <li><i class="fa-solid fa-chevron-right"></i></li>
                        <li class="current">Blogs</li>
                    </ul>
                </div>
            </div>

            <div class="container">
                <div class="banner-content">
                    <h1>The Parijaat Journal</h1>
                    <p>Stories, Styling &amp; Craft Inspiration.</p>
                </div>
            </div>
        </section>

        {{-- ================= SEC A : FEATURED + TRENDING ================= --}}
        <section class="blog-secA">
            <div class="container">
                <div class="heading">
                    <small class="eyebrow">FEATURED STORY</small>
                    <h3>Fresh From the Journal.</h3>
                    <p>Care guides, gifting ideas and the stories behind every handcrafted piece.</p>
                </div>

                <div class="bf-grid">
                    <a href="blog-detail.html" class="bf-main">
                        <figure class="bf-img">
                            <img src="{{ asset('assets/images/home/diwali_7_11zon.png') }}"
                                alt="Setting up a pooja corner at home" loading="lazy" />
                        </figure>
                        <span class="bf-tag">Featured</span>

                        <div class="bf-info">
                            <div class="bf-meta">
                                <span class="bf-cat">Pooja Guide</span>
                                <time datetime="2026-11-08"><i class="fa-regular fa-calendar"></i> 08 Nov 2026</time>
                                <span><i class="fa-regular fa-clock"></i> 6 min read</span>
                            </div>
                            <h4>How to Set Up a Beautiful Pooja Corner at Home</h4>
                            <p>
                                From brass diyas and thalis to placement and lighting, a simple guide to creating a
                                calm, devotional space in any home.
                            </p>
                            <span class="bf-cta">Read Article <i class="fa-solid fa-arrow-right"></i></span>
                        </div>
                    </a>

                    <div class="bf-side">
                        <span class="bf-label">TRENDING NOW</span>

                        <ul class="bf-list">
                            @foreach ($trending as [$tImg, $tAlt, $tSmall, $tTitle])
                                <li>
                                    <a href="blog-detail.html" class="bf-item">
                                        <figure>
                                            <img src="{{ asset($tImg) }}" alt="{{ $tAlt }}" loading="lazy" />
                                        </figure>
                                        <div>
                                            <small>{{ $tSmall }}</small>
                                            <h5>{{ $tTitle }}</h5>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        {{-- ================= SEC B : ARTICLE GRID (TABS) ================= --}}
        <section class="blog-secB">
            <div class="container">
                <div class="heading">
                    <small class="eyebrow">MORE TO READ</small>
                    <h3>Latest Articles.</h3>
                </div>

                <ul class="tab-nav">
                    @foreach ($tabs as $id => $label)
                        <li data-tab="{{ $id }}" @class(['active' => $loop->first])>{{ $label }}</li>
                    @endforeach
                </ul>

                <div class="tab-nav-content">
                    @foreach ($tabs as $id => $label)
                        @php $list = $id === 1 ? $posts->where('all', true) : $posts->where('tab', $id); @endphp
                        <div @class(['tabs', 'active' => $loop->first]) data-tab="{{ $id }}">
                            <div class="blog-grid">
                                @foreach ($list as $post)
                                    @include('partials.blog-card', ['post' => $post])
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                <ul class="blog-pager">
                    <li><a href="javascript:void(0);" class="pg-arrow" aria-label="Previous page"><i
                                class="fa-solid fa-chevron-left"></i></a></li>
                    <li><a href="javascript:void(0);" class="active">1</a></li>
                    <li><a href="javascript:void(0);">2</a></li>
                    <li><a href="javascript:void(0);">3</a></li>
                    <li><a href="javascript:void(0);" class="pg-arrow" aria-label="Next page"><i
                                class="fa-solid fa-chevron-right"></i></a></li>
                </ul>
            </div>
        </section>

        {{-- ================= SEC C : GRADIENT CTA ================= --}}
        <section class="blog-secC">
            <div class="container">
                @include('partials.blog-cta')
            </div>
        </section>
    </main>
@endsection