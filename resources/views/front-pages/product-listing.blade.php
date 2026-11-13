{{-- resources/views/product-listing.blade.php --}}
@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/sass/product-listing/product-listing.css') }}" />
@endpush

@section('content')
    @php
        // Static data for now – swap with DB/controller data later.
        $products = [
            ['sku' => 'SKU-P1',  'name' => 'Handmade Brass Oil Lamp',         'img' => 'assets/images/home/cat4.png', 'badge' => 'Bestseller',    'now' => '$199', 'old' => '$249', 'off' => 20],
            ['sku' => 'SKU-P2',  'name' => 'Brass Aladdin Incense Burner',    'img' => 'assets/images/home/cat2.png', 'badge' => null,            'now' => '$149', 'old' => '$179', 'off' => 17],
            ['sku' => 'SKU-P3',  'name' => 'Brass Decorative Rabbit Figurine', 'img' => 'assets/images/home/cat1.png', 'badge' => 'Limited Stock', 'now' => '$399', 'old' => '$469', 'off' => 15],
            ['sku' => 'SKU-P4',  'name' => 'Hammered Copper Goblet',          'img' => 'assets/images/home/cat3.png', 'badge' => null,            'now' => '$99',  'old' => '$119', 'off' => 17],
            ['sku' => 'SKU-P5',  'name' => 'Brass Lotus Kuber Diya',          'img' => 'assets/images/home/cat4.png', 'badge' => 'Bestseller',    'now' => '$179', 'old' => '$210', 'off' => 15],
            ['sku' => 'SKU-P6',  'name' => 'Brass Elephant Diya Stand',       'img' => 'assets/images/home/cat1.png', 'badge' => null,            'now' => '$249', 'old' => '$299', 'off' => 17],
            ['sku' => 'SKU-P7',  'name' => 'Brass Peacock Diya',              'img' => 'assets/images/home/cat4.png', 'badge' => 'New',           'now' => '$299', 'old' => '$359', 'off' => 17],
            ['sku' => 'SKU-P8',  'name' => 'Antique Brass Lock',              'img' => 'assets/images/home/cat5.png', 'badge' => 'New',           'now' => '$99',  'old' => '$119', 'off' => 17],
            ['sku' => 'SKU-P9',  'name' => 'Brass Wind Chime',                'img' => 'assets/images/home/cat6.png', 'badge' => null,            'now' => '$229', 'old' => '$275', 'off' => 17],
            ['sku' => 'SKU-P10', 'name' => 'Copper Water Bottle',             'img' => 'assets/images/home/cat3.png', 'badge' => 'Bestseller',    'now' => '$129', 'old' => '$155', 'off' => 17],
            ['sku' => 'SKU-P11', 'name' => 'Copper Jug with Tumblers',        'img' => 'assets/images/home/cat3.png', 'badge' => 'Limited Stock', 'now' => '$349', 'old' => '$419', 'off' => 17],
            ['sku' => 'SKU-P12', 'name' => 'Brass Temple Bell',               'img' => 'assets/images/home/cat6.png', 'badge' => 'New',           'now' => '$159', 'old' => '$199', 'off' => 20],
        ];

        // products shown in the two carousels (P1–P5 + P9)
        $carouselProducts = collect($products)->only([0, 1, 2, 3, 4, 8]);

        $categories = [
            ['Brass Idols & Statues', 'cat1.png', '12 items'],
            ['Pooja Essentials',      'cat2.png', '16 items'],
            ['Copper Drinkware',      'cat3.png', '18 items'],
            ['Brass Diyas & Lamps',   'cat4.png', '24 items'],
            ['Antique Locks & Keys',  'cat5.png', '08 items'],
            ['Bells & Wind Chimes',   'cat6.png', '26 items'],
            ['Pooja Thali Sets',      'cat2.png', '14 items'],
        ];

        $swatches = [
            ['polished-gold', 'Polished Gold', '#d9a93a'],
            ['antique-brass', 'Antique Brass', '#a8782a'],
            ['copper', 'Copper Tone', '#b8704a'],
            ['oxidised-black', 'Oxidised Black', '#2a2522'],
            ['silver', 'Silver Tone', '#c9c9c9'],
            ['multicolour', 'Multicolour', 'conic-gradient(#d9a93a, #b3202f, #1f6b4f, #1c2a4a, #d9a93a)'],
        ];

        // type: check | chip | price | swatch | rating
        $filters = [
            ['title' => 'Categories', 'type' => 'check', 'name' => 'category', 'open' => true, 'items' => [
                'brass-idols' => 'Brass Idols & Statues', 'pooja-essentials' => 'Pooja Essentials',
                'copper-drinkware' => 'Copper Drinkware', 'diyas-lamps' => 'Brass Diyas & Lamps',
                'locks-keys' => 'Antique Locks & Keys', 'bells-chimes' => 'Bells & Wind Chimes']],
            ['title' => 'Price Range', 'type' => 'price', 'open' => true],
            ['title' => 'Metal / Material', 'type' => 'chip', 'name' => 'material', 'open' => true, 'items' => [
                'brass' => 'Brass', 'copper' => 'Copper', 'bronze' => 'Bronze', 'iron' => 'Iron',
                'aluminium' => 'Aluminium', 'wood' => 'Wood', 'mixed-metal' => 'Mixed Metal']],
            ['title' => 'Colour / Finish', 'type' => 'swatch', 'open' => true],
            ['title' => 'Size (Height)', 'type' => 'chip', 'name' => 'size', 'open' => true, 'items' => [
                'small' => 'Up to 4 in', 'medium' => '4 – 8 in', 'large' => '8 – 12 in', 'xlarge' => '12 in & Above']],
            ['title' => 'Weight', 'type' => 'chip', 'name' => 'weight', 'open' => false, 'items' => [
                'under-250' => 'Under 250 g', '250-500' => '250 – 500 g', '500-1000' => '500 g – 1 kg', 'above-1000' => 'Above 1 kg']],
            ['title' => 'Occasion', 'type' => 'chip', 'name' => 'occasion', 'open' => false, 'items' => [
                'diwali' => 'Diwali', 'daily-pooja' => 'Daily Pooja', 'housewarming' => 'Housewarming',
                'wedding' => 'Wedding', 'festive' => 'Festive', 'gifting' => 'Gifting']],
            ['title' => 'Room / Use', 'type' => 'chip', 'name' => 'room', 'open' => false, 'items' => [
                'pooja-room' => 'Pooja Room', 'living-room' => 'Living Room', 'kitchen-dining' => 'Kitchen & Dining',
                'entrance' => 'Entrance', 'garden' => 'Garden & Outdoor']],
            ['title' => 'Deity / Theme', 'type' => 'chip', 'name' => 'theme', 'open' => false, 'items' => [
                'ganesh' => 'Ganesh', 'lakshmi' => 'Lakshmi', 'krishna' => 'Krishna', 'shiva' => 'Shiva',
                'hanuman' => 'Hanuman', 'buddha' => 'Buddha', 'animals' => 'Animals']],
            ['title' => 'Style', 'type' => 'check', 'name' => 'style', 'open' => false, 'items' => [
                'antique' => 'Antique', 'traditional' => 'Traditional', 'contemporary' => 'Contemporary', 'hand-engraved' => 'Hand Engraved']],
            ['title' => 'Set Type', 'type' => 'check', 'name' => 'set', 'open' => false, 'items' => [
                'single' => 'Single Piece', 'set-2' => 'Set of 2', 'set-3-plus' => 'Set of 3 or More', 'gift-set' => 'Gift Set']],
            ['title' => 'Availability', 'type' => 'check', 'name' => 'availability', 'open' => false, 'items' => [
                'in-stock' => 'In Stock', 'out-of-stock' => 'Out of Stock']],
            ['title' => 'Customer Rating', 'type' => 'rating', 'open' => false],
            ['title' => 'Offers & Collections', 'type' => 'check', 'name' => 'offers', 'open' => false, 'items' => [
                'discounted' => 'Discounted Products', 'special' => 'Special Offers', 'new' => 'New Arrivals', 'best' => 'Best Sellers']],
        ];

        $trust = [
            ['fa-hammer', 'Thoughtfully Crafted', 'Handcrafted pieces selected with care for detail and finish.'],
            ['fa-landmark', 'Inspired by Indian Heritage', 'Designs that carry traditional character into modern homes.'],
            ['fa-shield-halved', 'Secure Shopping', 'A safe and reliable checkout experience.'],
            ['fa-headset', 'Customer Care', 'Helpful support whenever you need assistance.'],
        ];
    @endphp

    <main>
        {{-- 01 + 02 : BREADCRUMB + COLLECTION HEADER --}}
        <section class="listing-banner">
            <div class="container">
                <ul class="crumb">
                    <li><a href="index.html">Home</a></li>
                    <li><i class="fa-solid fa-chevron-right"></i></li>
                    <li class="current">Shop All Products</li>
                </ul>

                <div class="banner-grid">
                    <div class="banner-content">
                        <small class="eyebrow">The Complete Collection</small>
                        <h1 class="banner-title">Discover Our Handcrafted Treasures.</h1>
                        <p class="banner-desc">
                            Explore an exceptional collection of Indian handicrafts, timeless brass creations and
                            thoughtfully designed decorative pieces.
                        </p>
                        <p class="banner-count">Showing <b>48</b> Products</p>
                    </div>

                    <figure class="banner-visual">
                        <img src="{{ asset('assets/images/home/cat2.png') }}"
                            alt="Handcrafted brass decor and traditional accessories" />
                    </figure>
                </div>
            </div>
        </section>

        {{-- 03 : SHOP BY CATEGORY --}}
        <section class="listing-cats">
            <div class="container">
                <div class="heading">
                    <h3>Explore by Category</h3>
                    <p>Find the perfect handcrafted pieces for your home, rituals and everyday moments.</p>
                </div>

                <div class="swiper-wrap">
                    <div class="swiper fourSlider" data-mob="1.4" data-sm="2.4" data-lg="4" data-xl="6">
                        <div class="swiper-wrapper">
                            @foreach ($categories as [$catName, $catImg, $catCount])
                                <div class="swiper-slide">
                                    <a href="product-listing.html" class="cat-tile">
                                        <figure>
                                            <img src="{{ asset('assets/images/home/' . $catImg) }}"
                                                alt="{{ $catName }}" loading="lazy" />
                                        </figure>
                                        <div class="cat-info">
                                            <span class="cat-name">{{ $catName }}</span><small>{{ $catCount }}</small>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="swiper-group">
                        <button type="button" class="btn-prev" aria-label="Previous">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M15 5l-7 7 7 7" />
                            </svg>
                        </button>
                        <button type="button" class="btn-next" aria-label="Next">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </section>

        {{-- 04 + 05 + 06 : LISTING (sticky filter left, grid right) --}}
        <section class="listing-main" id="listingMain">
            <div class="container">
                <input type="checkbox" id="filterToggle" class="filter-toggle" hidden />

                {{-- toolbar --}}
                <div class="listing-toolbar">
                    <p class="listing-count">
                        All Products &middot; Showing <b>1–12</b> of <b>48</b> Products
                    </p>

                    <div class="listing-tools">
                        <label for="filterToggle" class="tool-btn"><i class="fa-solid fa-sliders"></i> Filter</label>

                        <div class="view-switch" aria-label="Grid view">
                            <button type="button" class="view-btn" data-cols="3" aria-label="3 columns">
                                <i class="fa-solid fa-table-cells-large"></i>
                            </button>
                            <button type="button" class="view-btn active" data-cols="4" aria-label="4 columns">
                                <i class="fa-solid fa-table-cells"></i>
                            </button>
                        </div>

                        <div class="listing-sort">
                            <label for="listingSort">Sort By</label>
                            <div class="sort-box">
                                <select id="listingSort" name="sort">
                                    <option value="featured">Featured</option>
                                    <option value="newest">Newest Arrivals</option>
                                    <option value="low">Price: Low to High</option>
                                    <option value="high">Price: High to Low</option>
                                    <option value="sold">Best Selling</option>
                                    <option value="rating">Top Rated</option>
                                </select>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="listing-layout">
                    <label for="filterToggle" class="filter-overlay" aria-hidden="true"></label>

                    {{-- FILTER --}}
                    <form class="listing-filter" id="filterPanel" action="#" method="get"
                        aria-label="Product filters">
                        <div class="f-head">
                            <div class="f-ttl">
                                <span class="f-icon"><i class="fa-solid fa-sliders"></i></span>
                                <h4>Filter Products</h4>
                            </div>
                            <button type="reset" class="f-clear">Clear All</button>
                            <label for="filterToggle" class="f-close" aria-label="Close filters"><i
                                    class="fa-solid fa-xmark"></i></label>
                        </div>

                        <div class="f-scroll">
                            @foreach ($filters as $f)
                                <details class="f-group" @if ($f['open']) open @endif>
                                    <summary>{{ $f['title'] }}</summary>

                                    @if ($f['type'] === 'check')
                                        <div class="f-body f-list">
                                            @foreach ($f['items'] as $val => $label)
                                                <label class="f-check"><input type="checkbox"
                                                        name="{{ $f['name'] }}" value="{{ $val }}" /><span
                                                        class="f-box"></span><span
                                                        class="f-text">{{ $label }}</span></label>
                                            @endforeach
                                        </div>
                                    @elseif ($f['type'] === 'chip')
                                        <div class="f-body f-chips">
                                            @foreach ($f['items'] as $val => $label)
                                                <label class="f-chip"><input type="checkbox"
                                                        name="{{ $f['name'] }}" value="{{ $val }}" /><span>{{ $label }}</span></label>
                                            @endforeach
                                        </div>
                                    @elseif ($f['type'] === 'price')
                                        <div class="f-body">
                                            <div class="price-range" data-min="0" data-max="10000">
                                                <div class="range-track"><span class="range-fill"></span></div>
                                                <input type="range" class="range-min" min="0" max="10000"
                                                    step="100" value="0" aria-label="Minimum price" />
                                                <input type="range" class="range-max" min="0" max="10000"
                                                    step="100" value="10000" aria-label="Maximum price" />
                                            </div>
                                            <div class="price-inputs">
                                                <label><span>Min</span><b>₹</b><input type="number"
                                                        name="price_min" class="in-min" value="0" min="0"
                                                        max="10000" step="100" /></label>
                                                <i class="price-dash"></i>
                                                <label><span>Max</span><b>₹</b><input type="number"
                                                        name="price_max" class="in-max" value="10000" min="0"
                                                        max="10000" step="100" /></label>
                                            </div>
                                        </div>
                                    @elseif ($f['type'] === 'swatch')
                                        <div class="f-body f-swatches">
                                            @foreach ($swatches as [$val, $title, $color])
                                                <label class="f-swatch" title="{{ $title }}"><input
                                                        type="checkbox" name="finish"
                                                        value="{{ $val }}" /><span
                                                        style="--c: {{ $color }}"></span></label>
                                            @endforeach
                                        </div>
                                    @elseif ($f['type'] === 'rating')
                                        <div class="f-body f-list">
                                            @foreach ([4, 3, 2] as $r)
                                                <label class="f-check">
                                                    <input type="radio" name="rating" value="{{ $r }}" /><span
                                                        class="f-box is-radio"></span>
                                                    <span class="f-text f-stars">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <i
                                                                class="{{ $i <= $r ? 'fa-solid' : 'fa-regular' }} fa-star"></i>
                                                        @endfor
                                                        <em>{{ $r }}★ &amp; Above</em>
                                                    </span>
                                                </label>
                                            @endforeach
                                        </div>
                                    @endif
                                </details>
                            @endforeach
                        </div>

                        <div class="f-foot">
                            <button type="reset" class="btn btn-outline-black">Clear All</button>
                            <button type="submit" class="btn btn-primary">Apply Filters</button>
                        </div>
                    </form>

                    {{-- PRODUCTS --}}
                    <div class="listing-content">
                        <div class="listing-grid" id="listingGrid">
                            @foreach ($products as $p)
                                @include('partials.product-card', ['p' => $p])
                            @endforeach
                        </div>

                        {{-- PAGINATION --}}
                        <nav class="listing-pagination" aria-label="Product pages">
                            <a href="javascript:void(0)" class="pg-nav is-disabled" aria-disabled="true"><i
                                    class="fa-solid fa-arrow-left-long"></i> Previous</a>
                            <ul>
                                <li><a href="javascript:void(0)" class="active" aria-current="page">1</a></li>
                                <li><a href="javascript:void(0)">2</a></li>
                                <li><a href="javascript:void(0)">3</a></li>
                                <li><a href="javascript:void(0)">4</a></li>
                                <li class="dots">…</li>
                            </ul>
                            <a href="javascript:void(0)" class="pg-nav">Next <i
                                    class="fa-solid fa-arrow-right-long"></i></a>
                        </nav>
                    </div>
                </div>
            </div>
        </section>

        {{-- YOU MAY ALSO LOVE --}}
        <section class="home-secJ">
            <div class="container">
                <div class="heading">
                    <small class="eyebrow">HANDPICKED FOR YOU</small>
                    <h3>You May Also Love.</h3>
                    <p>Discover more beautiful handcrafted treasures, thoughtfully selected to inspire your next find.</p>
                </div>

                <div class="swiper-wrap">
                    <div class="swiper fourSlider" data-mob="2" data-sm="3" data-lg="4" data-xl="5">
                        <div class="swiper-wrapper">
                            @foreach ($carouselProducts as $p)
                                <div class="swiper-slide">
                                    @include('partials.product-card', ['p' => $p])
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

        {{-- TRUST --}}
        <section class="listing-trust">
            <div class="container">
                <div class="heading">
                    <h3>A Shopping Experience Rooted in Tradition.</h3>
                </div>

                <div class="trust-grid">
                    @foreach ($trust as [$icon, $title, $text])
                        <div class="trust-item">
                            <span class="trust-icon"><i class="fa-solid {{ $icon }}"></i></span>
                            <h4>{{ $title }}</h4>
                            <p>{{ $text }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- RECENTLY VIEWED --}}
        <section class="home-secJ">
            <div class="container">
                <div class="heading">
                    <small class="eyebrow">RECENTLY VIEWED</small>
                    <h3>Pick Up Where You Left Off.</h3>
                    <p>Revisit the handcrafted pieces that caught your eye.</p>
                </div>

                <div class="swiper-wrap">
                    <div class="swiper fourSlider" data-mob="2" data-sm="3" data-lg="4" data-xl="5">
                        <div class="swiper-wrapper">
                            @foreach ($carouselProducts as $p)
                                <div class="swiper-slide">
                                    @include('partials.product-card', ['p' => $p])
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
    </main>
@endsection

@push('scripts')
    <script>
        (function() {
            var range = document.querySelector(".price-range");
            if (range) {
                var form = range.closest("form");
                var minR = range.querySelector(".range-min");
                var maxR = range.querySelector(".range-max");
                var fill = range.querySelector(".range-fill");
                var minI = form.querySelector(".in-min");
                var maxI = form.querySelector(".in-max");
                var MIN = parseInt(range.dataset.min, 10);
                var MAX = parseInt(range.dataset.max, 10);
                var GAP = 500;

                function paint() {
                    var a = parseInt(minR.value, 10);
                    var b = parseInt(maxR.value, 10);
                    fill.style.left = ((a - MIN) / (MAX - MIN)) * 100 + "%";
                    fill.style.right = 100 - ((b - MIN) / (MAX - MIN)) * 100 + "%";
                    minR.style.zIndex = a > MAX - (MAX - MIN) * 0.1 ? 3 : 2;
                    maxR.style.zIndex = 2;
                }

                function fromRange(e) {
                    var a = parseInt(minR.value, 10);
                    var b = parseInt(maxR.value, 10);
                    if (b - a < GAP) {
                        if (e.target === minR) {
                            a = b - GAP;
                            minR.value = a;
                        } else {
                            b = a + GAP;
                            maxR.value = b;
                        }
                    }
                    minI.value = a;
                    maxI.value = b;
                    paint();
                }

                function fromInput() {
                    var a = parseInt(minI.value, 10);
                    var b = parseInt(maxI.value, 10);
                    if (isNaN(a)) a = MIN;
                    if (isNaN(b)) b = MAX;
                    a = Math.max(MIN, Math.min(a, MAX - GAP));
                    b = Math.min(MAX, Math.max(b, a + GAP));
                    minI.value = a;
                    maxI.value = b;
                    minR.value = a;
                    maxR.value = b;
                    paint();
                }

                minR.addEventListener("input", fromRange);
                maxR.addEventListener("input", fromRange);
                minI.addEventListener("change", fromInput);
                maxI.addEventListener("change", fromInput);
                form.addEventListener("reset", function() {
                    setTimeout(function() {
                        minR.value = MIN;
                        maxR.value = MAX;
                        minI.value = MIN;
                        maxI.value = MAX;
                        paint();
                    }, 0);
                });
                paint();
            }

            var grid = document.getElementById("listingGrid");
            var btns = document.querySelectorAll(".view-switch .view-btn");
            if (grid && btns.length) {
                btns.forEach(function(btn) {
                    btn.addEventListener("click", function() {
                        btns.forEach(function(b) {
                            b.classList.remove("active");
                        });
                        btn.classList.add("active");
                        grid.classList.toggle("is-3", btn.dataset.cols === "3");
                    });
                });
            }
        })();
    </script>
@endpush