@extends('layouts.app')

@section('title', 'Shop All Products')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/sass/product-listing/product-listing.css') }}" />
@endpush

@section('content')
    @php
        $trust = [
            ['fa-hammer', 'Thoughtfully Crafted', 'Handcrafted pieces selected with care for detail and finish.'],
            ['fa-landmark', 'Inspired by Indian Heritage', 'Designs that carry traditional character into modern homes.'],
            ['fa-shield-halved', 'Secure Shopping', 'A safe and reliable checkout experience.'],
            ['fa-headset', 'Customer Care', 'Helpful support whenever you need assistance.'],
        ];

        $cur  = $products->currentPage();
        $last = $products->lastPage();
    @endphp

    <main>
        {{-- 01 + 02 : BREADCRUMB + COLLECTION HEADER --}}
        <section class="listing-banner">
            <div class="container">
                <ul class="crumb">
                    <li><a href="{{ route('home') }}">Home</a></li>
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
                        <p class="banner-count">Showing <b>{{ $products->total() }}</b> Products</p>
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
                            @forelse ($categories as $category)
                                <div class="swiper-slide">
                                    <a href="{{ route('category.show', $category->slug) }}" class="cat-tile">
                                        <figure>
                                            <img src="{{ $category->image ? asset('storage/' . $category->image) : asset('assets/images/home/cat1.png') }}"
                                                alt="{{ $category->name }}" loading="lazy" />
                                        </figure>
                                        <div class="cat-info">
                                            <span class="cat-name">{{ $category->name }}</span>
                                            <small>{{ str_pad($category->products_count, 2, '0', STR_PAD_LEFT) }}
                                                items</small>
                                        </div>
                                    </a>
                                </div>
                            @empty
                                <p class="text-center w-100">No categories available.</p>
                            @endforelse
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
                        All Products &middot;
                        @if ($products->total())
                            Showing <b>{{ $products->firstItem() }}–{{ $products->lastItem() }}</b> of
                            <b>{{ $products->total() }}</b> Products
                        @else
                            <b>0</b> Products
                        @endif
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
                                {{-- belongs to the filter form so all filters are kept when sorting --}}
                                <select id="listingSort" name="sort" form="filterPanel"
                                    onchange="this.form.submit()">
                                    @foreach (\App\Models\Product::SORT_OPTIONS as $val => $label)
                                        <option value="{{ $val }}" @selected($sort === $val)>{{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="listing-layout">
                    <label for="filterToggle" class="filter-overlay" aria-hidden="true"></label>

                    {{-- FILTER --}}
                    <form class="listing-filter" id="filterPanel" action="{{ route('products') }}" method="get"
                        aria-label="Product filters">
                        <div class="f-head">
                            <div class="f-ttl">
                                <span class="f-icon"><i class="fa-solid fa-sliders"></i></span>
                                <h4>Filter Products</h4>
                            </div>
                            <a href="{{ route('products') }}" class="f-clear">Clear All</a>
                            <label for="filterToggle" class="f-close" aria-label="Close filters"><i
                                    class="fa-solid fa-xmark"></i></label>
                        </div>

                        <div class="f-scroll">
                            @foreach ($filters as $f)
                                @php
                                    $selected = isset($f['key']) ? (array) request($f['key'], []) : [];
                                    $isOpen = $f['open'] || !empty(array_filter($selected));
                                @endphp
                                <details class="f-group" @if ($isOpen) open @endif>
                                    <summary>{{ $f['title'] }}</summary>

                                    @if ($f['type'] === 'check')
                                        <div class="f-body f-list">
                                            @foreach ($f['items'] as $val => $label)
                                                <label class="f-check"><input type="checkbox"
                                                        name="{{ $f['field'] }}[]" value="{{ $val }}"
                                                        @checked(in_array($val, $selected)) /><span
                                                        class="f-box"></span><span
                                                        class="f-text">{{ $label }}</span></label>
                                            @endforeach
                                        </div>
                                    @elseif ($f['type'] === 'chip')
                                        <div class="f-body f-chips">
                                            @foreach ($f['items'] as $val => $label)
                                                <label class="f-chip"><input type="checkbox"
                                                        name="{{ $f['field'] }}[]" value="{{ $val }}"
                                                        @checked(in_array($val, $selected)) /><span>{{ $label }}</span></label>
                                            @endforeach
                                        </div>
                                    @elseif ($f['type'] === 'swatch')
                                        <div class="f-body f-swatches">
                                            @foreach ($f['items'] as $val => [$title, $color])
                                                <label class="f-swatch" title="{{ $title }}"><input
                                                        type="checkbox" name="{{ $f['field'] }}[]"
                                                        value="{{ $val }}"
                                                        @checked(in_array($val, $selected)) /><span
                                                        style="--c: {{ $color }}"></span></label>
                                            @endforeach
                                        </div>
                                    @elseif ($f['type'] === 'price')
                                        <div class="f-body">
                                            <div class="price-range" data-min="0" data-max="{{ $priceCeil }}">
                                                <div class="range-track"><span class="range-fill"></span></div>
                                                <input type="range" class="range-min" min="0"
                                                    max="{{ $priceCeil }}" step="100" value="{{ $priceMin }}"
                                                    aria-label="Minimum price" />
                                                <input type="range" class="range-max" min="0"
                                                    max="{{ $priceCeil }}" step="100" value="{{ $priceMax }}"
                                                    aria-label="Maximum price" />
                                            </div>
                                            <div class="price-inputs">
                                                <label><span>Min</span><b>₹</b><input type="number"
                                                        name="price_min" class="in-min" value="{{ $priceMin }}"
                                                        min="0" max="{{ $priceCeil }}" step="100" /></label>
                                                <i class="price-dash"></i>
                                                <label><span>Max</span><b>₹</b><input type="number"
                                                        name="price_max" class="in-max" value="{{ $priceMax }}"
                                                        min="0" max="{{ $priceCeil }}" step="100" /></label>
                                            </div>
                                        </div>
                                    @elseif ($f['type'] === 'rating')
                                        <div class="f-body f-list">
                                            @foreach ([4, 3, 2] as $r)
                                                <label class="f-check">
                                                    <input type="radio" name="rating" value="{{ $r }}"
                                                        @checked((int) request('rating') === $r) /><span
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
                            <a href="{{ route('products') }}" class="btn btn-outline-black">Clear All</a>
                            <button type="submit" class="btn btn-primary">Apply Filters</button>
                        </div>
                    </form>

                    {{-- PRODUCTS --}}
                    <div class="listing-content">
                        <div class="listing-grid" id="listingGrid">
                            @forelse ($products as $item)
                                @include('partials.product-card', ['p' => $item])
                            @empty
                                <p class="text-center w-100">No products match your filters.</p>
                            @endforelse
                        </div>

                        {{-- PAGINATION --}}
                        @if ($products->hasPages())
                            <nav class="listing-pagination" aria-label="Product pages">
                                @if ($products->onFirstPage())
                                    <a href="javascript:void(0)" class="pg-nav is-disabled" aria-disabled="true"><i
                                            class="fa-solid fa-arrow-left-long"></i> Previous</a>
                                @else
                                    <a href="{{ $products->previousPageUrl() }}" class="pg-nav"><i
                                            class="fa-solid fa-arrow-left-long"></i> Previous</a>
                                @endif

                                <ul>
                                    @if ($cur > 3)
                                        <li><a href="{{ $products->url(1) }}">1</a></li>
                                        @if ($cur > 4)
                                            <li class="dots">…</li>
                                        @endif
                                    @endif

                                    @foreach ($products->getUrlRange(max(1, $cur - 2), min($last, $cur + 2)) as $page => $url)
                                        <li>
                                            <a href="{{ $url }}" @class(['active' => $page === $cur])
                                                @if ($page === $cur) aria-current="page" @endif>{{ $page }}</a>
                                        </li>
                                    @endforeach

                                    @if ($cur < $last - 2)
                                        @if ($cur < $last - 3)
                                            <li class="dots">…</li>
                                        @endif
                                        <li><a href="{{ $products->url($last) }}">{{ $last }}</a></li>
                                    @endif
                                </ul>

                                @if ($products->hasMorePages())
                                    <a href="{{ $products->nextPageUrl() }}" class="pg-nav">Next <i
                                            class="fa-solid fa-arrow-right-long"></i></a>
                                @else
                                    <a href="javascript:void(0)" class="pg-nav is-disabled"
                                        aria-disabled="true">Next <i class="fa-solid fa-arrow-right-long"></i></a>
                                @endif
                            </nav>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        {{-- YOU MAY ALSO LOVE --}}
        @if ($related->isNotEmpty())
            <section class="home-secJ">
                <div class="container">
                    <div class="heading">
                        <small class="eyebrow">HANDPICKED FOR YOU</small>
                        <h3>You May Also Love.</h3>
                        <p>Discover more beautiful handcrafted treasures, thoughtfully selected to inspire your next
                            find.</p>
                    </div>

                    <div class="swiper-wrap">
                        <div class="swiper fourSlider" data-mob="2" data-sm="3" data-lg="4" data-xl="5">
                            <div class="swiper-wrapper">
                                @foreach ($related as $item)
                                    <div class="swiper-slide">
                                        @include('partials.product-card', ['p' => $item])
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
        @endif

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
        @if ($recent->isNotEmpty())
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
                                @foreach ($recent as $item)
                                    <div class="swiper-slide">
                                        @include('partials.product-card', ['p' => $item])
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
        @endif
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

            var filterForm = document.getElementById("filterPanel");
if (filterForm) {
    filterForm.addEventListener("change", function() {
        filterForm.submit();
    });
}

        })();
    </script>
@endpush