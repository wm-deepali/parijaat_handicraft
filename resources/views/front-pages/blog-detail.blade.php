{{-- resources/views/front-pages/blog-detail.blade.php --}}
@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/sass/blog-detail/blog-detail.css') }}" />
@endpush

@section('content')
    @php
        // Static data for now – swap with DB/controller data later.
        $related = [
            ['img' => 'assets/images/home/dinner_2_11zon.png', 'alt' => 'Copper drinkware', 'date' => '2026-11-04', 'cat' => 'Copper', 'read' => 4,
                'title' => 'The Timeless Tradition of Copper Drinkware',
                'excerpt' => 'Why hammered copper goblets, jugs and bottles continue to find a place on modern Indian tables.'],
            ['img' => 'assets/images/home/free_5_11zon.png', 'alt' => 'Housewarming gifts', 'date' => '2026-10-30', 'cat' => 'Gifting', 'read' => 5,
                'title' => 'Housewarming Gift Ideas: Handcrafted Brass Pieces That Last',
                'excerpt' => 'Thoughtful, meaningful gifts that bring warmth and tradition into a new home.'],
            ['img' => 'assets/images/home/bressbell_1_11zon.png', 'alt' => 'Brass wind chime', 'date' => '2026-10-28', 'cat' => 'Home Decor', 'read' => 4,
                'title' => 'Choosing a Brass Wind Chime: Sound, Size and Placement',
                'excerpt' => 'A quick guide to picking a wind chime with a soothing tone and hanging it in the right spot.'],
            ['img' => 'assets/images/home/jam_6_11zon.png', 'alt' => 'Festive brass decor', 'date' => '2026-10-22', 'cat' => 'Festive', 'read' => 5,
                'title' => 'Festive Decor Ideas With Brass Diyas and Lamps',
                'excerpt' => 'Simple ways to light up your home this festive season with handcrafted brass lamps.'],
            ['img' => 'assets/images/home/door_3_11zon.png', 'alt' => 'Antique brass lock', 'date' => '2026-10-17', 'cat' => 'Home Decor', 'read' => 4,
                'title' => 'The Charm of Antique Brass Locks in Modern Interiors',
                'excerpt' => 'How vintage locks and keys can become striking, story-rich accents in contemporary homes.'],
            ['img' => 'assets/images/home/cat4.png', 'alt' => 'Handcrafted brass diya', 'date' => '2026-10-12', 'cat' => 'Craft & Heritage', 'read' => 6,
                'title' => 'From Metal to Masterpiece: How Brass Is Handcrafted',
                'excerpt' => 'A look at the skill and patience that go into shaping, finishing and detailing each brass piece.'],
        ];

        $popular = [
            ['assets/images/home/dinner_2_11zon.png', 'Copper drinkware', '04 Nov 2026', 'The Timeless Tradition of Copper Drinkware'],
            ['assets/images/home/jam_6_11zon.png', 'Festive decor', '22 Oct 2026', 'Festive Decor Ideas With Brass Diyas and Lamps'],
            ['assets/images/home/door_3_11zon.png', 'Antique locks', '17 Oct 2026', 'The Charm of Antique Brass Locks in Modern Interiors'],
        ];

        $toc = ['s1' => 'Know your finish first', 's2' => 'Start with gentle cleaning', 's3' => 'Polish step by step'];
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
                        <li><a href="blogs.html">Blogs</a></li>
                        <li><i class="fa-solid fa-chevron-right"></i></li>
                        <li class="current">Clean and Polish Brass at Home</li>
                    </ul>
                </div>
            </div>

            <div class="container">
                <div class="banner-content">
                    <h1>How to Clean and Polish Brass at Home Without Damaging It</h1>
                    <p>Care Guide &nbsp;·&nbsp; 10 Nov 2026 &nbsp;·&nbsp; 5 min read</p>
                </div>
            </div>
        </section>

        {{-- ================= SEC A : ARTICLE + SIDEBAR ================= --}}
        <section class="blogd-secA">
            <div class="container">
                <div class="bd-grid">
                    <article class="bd-article">
                        <figure class="bd-cover">
                            <img src="{{ asset('assets/images/home/pro30.jpg') }}"
                                alt="Cleaning and polishing brass at home" />
                        </figure>

                        <div class="bd-byline">
                            <span><i class="fa-regular fa-user"></i> By Parijaat Team</span>
                            <time datetime="2026-11-10"><i class="fa-regular fa-calendar"></i> 10 Nov 2026</time>
                            <span><i class="fa-regular fa-clock"></i> 5 min read</span>
                            <span class="bd-pill">Care Guide</span>
                        </div>

                        {{-- CMS CONTENT AREA (later: {!! $blog->content !!}) --}}
                        <div class="blogd-content">
                            <p>
                                Brass is made to be lived with. Over time it naturally darkens, but a little regular
                                care keeps it glowing. Here is a <strong>simple routine</strong> you can follow at home
                                without harming the finish.
                            </p>

                            <h2 id="s1">1. Know your finish first</h2>
                            <p>
                                Some brass pieces are lacquered for a permanent shine, while others are left raw so they
                                can age gracefully. Check which type you own before you clean it. Our
                                <a href="product-listing.html">brass collection</a> lists the finish on every product
                                page.
                            </p>

                            <h2 id="s2">2. Start with gentle cleaning</h2>
                            <p>
                                For regular dust and light marks, mild methods work best. Avoid anything harsh or
                                abrasive, especially on detailed or engraved work.
                            </p>
                            <ul>
                                <li><strong>Soft cloth:</strong> wipe away dust weekly with a dry, clean cotton cloth.</li>
                                <li><strong>Mild soap and warm water:</strong> ideal for lacquered pieces. Dry thoroughly
                                    afterwards.</li>
                                <li><strong>Lemon and salt:</strong> a traditional method for raw, unlacquered brass only.
                                </li>
                            </ul>

                            <h2 id="s3">3. Polish step by step</h2>
                            <p>When raw brass loses its shine, a gentle polish brings it back. Follow these steps:</p>
                            <ol>
                                <li>Wipe the piece clean and let it dry completely.</li>
                                <li>Apply a small amount of polish with a soft cloth.</li>
                                <li>Rub gently in small circles, following the detailing.</li>
                                <li>Rinse with warm water and dry right away.</li>
                                <li>Buff with a dry cloth until the glow returns.</li>
                            </ol>

                            <blockquote>
                                Good brass is never really finished. It simply gets better with the care you give it.
                            </blockquote>

                            <h3>Keep it shining for longer</h3>
                            <p>
                                Store brass in a dry place and keep it away from damp corners. Not sure how to care for a
                                specific piece? Reach us through the <a href="contact.html">contact page</a> and our team
                                will be happy to help.
                            </p>
                        </div>

                        <div class="blogd-foot">
                            <ul class="blogd-tags" aria-label="Tags">
                                <li><a href="javascript:void(0);">Brass Care</a></li>
                                <li><a href="javascript:void(0);">Home Decor</a></li>
                                <li><a href="javascript:void(0);">Handicrafts</a></li>
                            </ul>

                            <div class="blogd-share">
                                <span>Share:</span>
                                <a href="javascript:void(0);" aria-label="Share on Facebook"><i
                                        class="fa-brands fa-facebook-f"></i></a>
                                <a href="javascript:void(0);" aria-label="Share on X"><i
                                        class="fa-brands fa-x-twitter"></i></a>
                                <a href="javascript:void(0);" aria-label="Share on WhatsApp"><i
                                        class="fa-brands fa-whatsapp"></i></a>
                                <button type="button" class="copyLink" aria-label="Copy link"><i
                                        class="fa-solid fa-link"></i></button>
                            </div>
                        </div>

                        <div class="blogd-author">
                            <span class="blogd-avatar"><i class="fa-regular fa-user"></i></span>
                            <div>
                                <small>Written by</small>
                                <h4>Parijaat Editorial Team</h4>
                                <p>
                                    We write simple care, styling and gifting guides to help you enjoy handcrafted pieces
                                    for years to come.
                                </p>
                            </div>
                        </div>
                    </article>

                    <aside class="bd-side">
                        <div class="bd-box">
                            <h5><i class="fa-solid fa-list-ul"></i> In This Article</h5>
                            <ol class="bd-toc">
                                @foreach ($toc as $anchor => $label)
                                    <li><a href="#{{ $anchor }}">{{ $label }}</a></li>
                                @endforeach
                            </ol>
                        </div>

                        <div class="bd-box">
                            <h5><i class="fa-solid fa-fire"></i> Popular Posts</h5>
                            <ul class="bd-pop">
                                @foreach ($popular as [$pImg, $pAlt, $pDate, $pTitle])
                                    <li>
                                        <a href="blog-detail.html">
                                            <figure>
                                                <img src="{{ asset($pImg) }}" alt="{{ $pAlt }}" loading="lazy" />
                                            </figure>
                                            <div>
                                                <small>{{ $pDate }}</small>
                                                <h6>{{ $pTitle }}</h6>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="bd-quote">
                            <i class="fa-solid fa-boxes-stacked bd-quote-mark" aria-hidden="true"></i>
                            <small>WHOLESALE &amp; BULK</small>
                            <h5>Looking for Handicrafts in Bulk?</h5>
                            <p>Share your requirements and we will reply with pricing and availability.</p>
                            <button type="button" class="btn btn-white" data-model=".enquiry-pop">
                                Request a Bulk Quote <i class="fa-solid fa-arrow-right"></i>
                            </button>
                        </div>
                    </aside>
                </div>
            </div>
        </section>

        {{-- ================= SEC B : RELATED (fourSlider) ================= --}}
        <section class="blogd-secB">
            <div class="container">
                <div class="heading">
                    <small class="eyebrow">KEEP READING</small>
                    <h3>Related Articles.</h3>
                </div>

                <div class="swiper-wrap">
                    <div class="swiper fourSlider" data-mob="1.15" data-sm="2.1" data-lg="3" data-xl="4">
                        <div class="swiper-wrapper">
                            @foreach ($related as $post)
                                <div class="swiper-slide">
                                    @include('partials.blog-card', ['post' => $post])
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="swiper-group">
                        <button type="button" class="btn-prev" aria-label="Previous"><i
                                class="fa-solid fa-chevron-left"></i></button>
                        <button type="button" class="btn-next" aria-label="Next"><i
                                class="fa-solid fa-chevron-right"></i></button>
                    </div>
                </div>
            </div>
        </section>

        {{-- ================= SEC C : GRADIENT CTA ================= --}}
        <section class="blogd-secC">
            <div class="container">
                @include('partials.blog-cta')
            </div>
        </section>
    </main>
@endsection