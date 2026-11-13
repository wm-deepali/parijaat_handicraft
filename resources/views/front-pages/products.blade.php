@extends('layouts.app')

@section('title', 'Products')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/sass/listing/listing.css') }}" />
@endpush

@php
    // TEMP static data: replace with controller data ($products, $recent, $related)
    $p = fn($sku, $name, $img, $now, $old, $off, $badge = null) => compact('sku', 'name', 'img', 'now', 'old', 'off', 'badge');

    $lotus = $p('SKU-P5', 'Brass Lotus Kuber Diya', 'assets/images/home/cat4.png', '$179', '$210', 15, 'Bestseller');
    $elephant = $p('SKU-P6', 'Brass Elephant Diya Stand', 'assets/images/home/cat4.png', '$249', '$299', 17);
    $peacock = $p('SKU-P7', 'Brass Peacock Diya', 'assets/images/home/cat4.png', '$299', '$359', 17, 'New');
    $oil = $p('SKU-P1', 'Handmade Brass Oil Lamp', 'assets/images/home/cat4.png', '$199', '$249', 20, 'Bestseller');
    $goblet = $p('SKU-P4', 'Hammered Copper Goblet', 'assets/images/home/cat3.png', '$99', '$119', 17);
    $chime = $p('SKU-P9', 'Brass Wind Chime', 'assets/images/home/cat6.png', '$229', '$275', 17);

    $products = [
        $oil,
        $lotus,
        $elephant,
        $lotus,
        $elephant,
        $peacock,
        $p('SKU-P13', 'Brass Akhand Jyot Diya', 'assets/images/home/cat4.png', '$109', '$129', 16),
        $p('SKU-P14', 'Brass Hanging Diya Lamp', 'assets/images/home/cat4.png', '$279', '$339', 18, 'Limited Stock'),
        $p('SKU-P15', 'Brass Five-Wick Aarti Diya', 'assets/images/home/cat4.png', '$139', '$165', 16),
        $p('SKU-P16', 'Brass Kamakshi Deepam', 'assets/images/home/cat4.png', '$199', '$235', 15, 'New'),
    ];

    $recent = [
        array_merge($oil, ['badge' => null]),
        array_merge($lotus, ['badge' => null]),
        array_merge($lotus, ['badge' => null]),
        array_merge($lotus, ['badge' => null]),
        array_merge($elephant, ['badge' => null]),
        $peacock,
    ];

    $related = [
        $p('SKU-P2', 'Brass Aladdin Incense Burner', 'assets/images/home/cat2.png', '$149', '$179', 17),
        $goblet,
        $chime,
        $p('SKU-P3', 'Brass Decorative Rabbit Figurine', 'assets/images/home/cat1.png', '$399', '$469', 15, 'Limited Stock'),
        $goblet,
        $chime,
    ];

    $tabs = [
        1 => 'All Lamps',
        2 => 'Oil Lamps',
        3 => 'Peacock Diyas',
        4 => 'Kuber & Lotus',
        5 => 'Diya Stands',
        6 => 'Hanging Lamps',
        7 => 'Aarti Diyas',
    ];

    $arrowPrev = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M15 5l-7 7 7 7" /></svg>';
    $arrowNext = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M9 5l7 7-7 7" /></svg>';
@endphp

@section('content')
    <main>
        <section class="product-banner">
            <div class="container">
                <ul class="crumb">
                    <li><a href="index.html">Home</a></li>
                    <li><i class="fa-solid fa-chevron-right"></i></li>
                    <li><a href="product-listing.html">Shop All Products</a></li>
                    <li><i class="fa-solid fa-chevron-right"></i></li>
                    <li class="current">Brass Diyas &amp; Lamps</li>
                </ul>

                <div class="banner-grid">
                    <div class="banner-content">
                        <small class="eyebrow">Brass Diyas &amp; Lamps</small>
                        <h1 class="banner-title">Light That Carries Tradition.</h1>
                        <p class="banner-desc">
                            Handcrafted brass diyas, oil lamps and aarti lamps, made for
                            daily pooja, festive evenings and warm, welcoming homes.
                        </p>
                        <p class="banner-count">Showing <b>24</b> Products</p>
                    </div>

                    <figure class="banner-visual">
                        <img src="{{ asset('assets/images/home/cat4.png') }}"
                            alt="Handcrafted brass diyas and lamps" />
                    </figure>
                </div>
            </div>
        </section>

        <section class="product-secB">
            <div class="container">
                <ul class="tab-nav">
                    @foreach ($tabs as $i => $label)
                        <li data-tab="{{ $i }}" @class(['active' => $loop->first])>{{ $label }}</li>
                    @endforeach
                </ul>

                <div class="tab-nav-content">
                    <!-- ========== TAB 1 : All Lamps ========== -->
                    <div class="tabs active" data-tab="1">
                        <div class="prod-head">
                            <div class="heading">
                                <small class="eyebrow">The Parijat Collection</small>
                                <h3>Lamps Made to Be Lit and Loved.</h3>
                                <p>
                                    From everyday oil lamps to festive peacock diyas, find the
                                    piece that brings light to your home.
                                </p>
                            </div>
                        </div>

                        <div class="prod-toolbar">
                            <p class="prod-count"><b>24</b> Products</p>
                            <div class="prod-tools">
                                <button type="button" class="tool-btn filter-btn" data-model=".filter-pop">
                                    <i class="fa-solid fa-sliders"></i> Filter
                                </button>
                                <div class="prod-sort">
                                    <label for="prodSort1">Sort By</label>
                                    <div class="sort-box">
                                        <select id="prodSort1">
                                            <option value="featured">Featured</option>
                                            <option value="newest">Newest Arrivals</option>
                                            <option value="sold">Best Selling</option>
                                            <option value="low">Price: Low to High</option>
                                            <option value="high">Price: High to Low</option>
                                            <option value="rating">Top Rated</option>
                                        </select>
                                        <i class="fa-solid fa-chevron-down"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="prod-grid">
                            @foreach ($products as $item)
                                @include('partials.product-card', ['p' => $item])
                            @endforeach
                        </div>

                        <div class="load-more">
                            <button type="button" class="btn btn-outline-black">
                                Load More Products
                            </button>
                            <p>Showing {{ count($products) }} of 24 products</p>
                        </div>
                    </div>

                    <!-- TAB 2 to 7 : same markup as Tab 1 (heading + toolbar + grid + load more) -->
                    @for ($i = 2; $i <= 7; $i++)
                        <div class="tabs" data-tab="{{ $i }}"></div>
                    @endfor
                </div>
            </div>
        </section>

        <section class="product-secD">
            <div class="container">
                <div class="sec-head">
                    <div class="heading">
                        <small class="eyebrow">RECENTLY VIEWED</small>
                        <h3>Pick Up Where You Left Off.</h3>
                        <p>Revisit the handcrafted pieces that caught your eye.</p>
                    </div>
                </div>

                <div class="swiper-wrap">
                    <div class="swiper fourSlider" data-mob="2" data-sm="2" data-lg="4" data-xl="5">
                        <div class="swiper-wrapper">
                            @foreach ($recent as $item)
                                <div class="swiper-slide">
                                    @include('partials.product-card', ['p' => $item])
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="swiper-group">
                        <button type="button" class="btn-prev" aria-label="Previous">{!! $arrowPrev !!}</button>
                        <button type="button" class="btn-next" aria-label="Next">{!! $arrowNext !!}</button>
                    </div>
                </div>
            </div>
        </section>

        <section class="product-secC">
            <div class="container">
                <div class="art-grid">
                    <div class="art-content">
                        <div class="heading">
                            <small class="eyebrow">A TRADITION IN BRASS</small>
                            <h3>The Art of the Brass Diya</h3>
                        </div>
                        <p>
                            A brass diya is part of every evening aarti and every festival.
                            Shaped and finished by Indian artisans, each piece carries the
                            warmth of a craft handed down through generations.
                        </p>
                        <ul class="art-points">
                            <li>
                                <b>Solid Brass Build</b>
                                <span>Weighty, long-lasting pieces that polish up beautifully
                                    with time.</span>
                            </li>
                            <li>
                                <b>Hand Finished Detail</b>
                                <span>Every curve and motif is finished by hand, so no two pieces
                                    are exactly alike.</span>
                            </li>
                            <li>
                                <b>Packed for Safe Shipping</b>
                                <span>Wrapped with care so your lamp arrives ready to light.</span>
                            </li>
                        </ul>
                        <div class="btn-group">
                            <a href="javascript:void(0)" class="btn btn-primary">Explore the Collection</a>
                            <a href="our-story.html" class="btn btn-outline-black">Our Story</a>
                        </div>
                    </div>

                    <div class="art-visual">
                        <figure class="art-photo">
                            <img src="{{ asset('assets/images/home/cat4.png') }}" alt="The art of the brass diya"
                                loading="lazy" />
                            <figcaption class="art-cap">The Parijat Edit</figcaption>
                        </figure>
                    </div>
                </div>
            </div>
        </section>

        <section class="product-secE">
            <div class="container">
                <div class="sec-head">
                    <div class="heading">
                        <small class="eyebrow">HANDPICKED FOR YOU</small>
                        <h3>You May Also Love.</h3>
                        <p>
                            Discover more handcrafted pieces to complete your pooja room and
                            home.
                        </p>
                    </div>
                </div>

                <div class="swiper-wrap">
                    <div class="swiper fourSlider" data-mob="2" data-sm="2" data-lg="4" data-xl="5">
                        <div class="swiper-wrapper">
                            @foreach ($related as $item)
                                <div class="swiper-slide">
                                    @include('partials.product-card', ['p' => $item])
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="swiper-group">
                        <button type="button" class="btn-prev" aria-label="Previous">{!! $arrowPrev !!}</button>
                        <button type="button" class="btn-next" aria-label="Next">{!! $arrowNext !!}</button>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- ================= Page Model : Filter ================= -->
    <div class="model filter-pop">
        <button type="button" class="close" aria-label="Close filters">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                <path d="M5 5l14 14M19 5L5 19" />
            </svg>
        </button>

        <div class="model-body">
            <div class="title">
                <h4>Filters</h4>
            </div>

            <div class="f-groups">
                <details class="f-group" open>
                    <summary>Category <i class="fa-solid fa-chevron-down"></i></summary>
                    <ul class="f-list">
                        <li><label><input type="checkbox" name="category" value="idols" /> Brass Idols &amp;
                                Statues</label></li>
                        <li><label><input type="checkbox" name="category" value="pooja" /> Pooja Essentials</label>
                        </li>
                        <li><label><input type="checkbox" name="category" value="copper" /> Copper Drinkware</label>
                        </li>
                        <li><label><input type="checkbox" name="category" value="diyas" /> Brass Diyas &amp;
                                Lamps</label></li>
                        <li><label><input type="checkbox" name="category" value="locks" /> Antique Locks &amp;
                                Keys</label></li>
                        <li><label><input type="checkbox" name="category" value="bells" /> Bells &amp; Wind
                                Chimes</label></li>
                    </ul>
                </details>

                <details class="f-group">
                    <summary>Material <i class="fa-solid fa-chevron-down"></i></summary>
                    <ul class="f-list">
                        <li><label><input type="checkbox" name="material" value="brass" /> Brass</label></li>
                        <li><label><input type="checkbox" name="material" value="copper" /> Copper</label></li>
                        <li><label><input type="checkbox" name="material" value="mixed" /> Brass &amp; Copper</label>
                        </li>
                    </ul>
                </details>

                <details class="f-group">
                    <summary>Price Range <i class="fa-solid fa-chevron-down"></i></summary>
                    <ul class="f-list">
                        <li><label><input type="checkbox" name="price" value="0-999" /> Under Rs. 999</label></li>
                        <li><label><input type="checkbox" name="price" value="1000-1999" /> Rs. 1,000 - Rs.
                                1,999</label></li>
                        <li><label><input type="checkbox" name="price" value="2000-3999" /> Rs. 2,000 - Rs.
                                3,999</label></li>
                        <li><label><input type="checkbox" name="price" value="4000+" /> Rs. 4,000 and Above</label>
                        </li>
                    </ul>
                </details>

                <details class="f-group">
                    <summary>Occasion <i class="fa-solid fa-chevron-down"></i></summary>
                    <ul class="f-list">
                        <li><label><input type="checkbox" name="occasion" value="diwali" /> Diwali &amp;
                                Festive</label></li>
                        <li><label><input type="checkbox" name="occasion" value="housewarming" />
                                Housewarming</label></li>
                        <li><label><input type="checkbox" name="occasion" value="wedding" /> Wedding Gifts</label>
                        </li>
                        <li><label><input type="checkbox" name="occasion" value="pooja" /> Pooja &amp;
                                Religious</label></li>
                    </ul>
                </details>

                <details class="f-group">
                    <summary>Availability <i class="fa-solid fa-chevron-down"></i></summary>
                    <ul class="f-list">
                        <li><label><input type="checkbox" name="stock" value="in-stock" /> In Stock</label></li>
                        <li><label><input type="checkbox" name="stock" value="on-sale" /> On Sale</label></li>
                        <li><label><input type="checkbox" name="stock" value="new" /> New Arrivals</label></li>
                    </ul>
                </details>
            </div>

            <div class="f-foot">
                <button type="reset" class="btn btn-outline-black">Clear All</button>
                <button type="button" class="btn btn-primary">Apply Filters</button>
            </div>
        </div>
    </div>
@endsection