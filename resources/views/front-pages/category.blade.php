@extends('layouts.app')

@section('title', $category->meta_title ?: $category->name)

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/sass/listing/listing.css') }}" />
@endpush

@php
    $arrowPrev = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M15 5l-7 7 7 7" /></svg>';
    $arrowNext = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M9 5l7 7-7 7" /></svg>';
    $title = $activeSub?->name ?? $category->name;
    $cEyebrow = $activeSub?->collection_eyebrow ?: $category->collection_eyebrow;
    $cTitle   = $activeSub?->collection_title   ?: $category->collection_title;
    $cText    = $activeSub?->collection_text    ?: $category->collection_text;
@endphp

@section('content')
    <main>
        {{-- BANNER --}}
        <section class="product-banner">
            <div class="container">
                <ul class="crumb">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><i class="fa-solid fa-chevron-right"></i></li>
                    <li><a href="{{ route('products') }}">Shop All Products</a></li>
                    <li><i class="fa-solid fa-chevron-right"></i></li>
                    @if ($activeSub)
                        <li><a href="{{ route('category.show', $category->slug) }}">{{ $category->name }}</a></li>
                        <li><i class="fa-solid fa-chevron-right"></i></li>
                        <li class="current">{{ $activeSub->name }}</li>
                    @else
                        <li class="current">{{ $category->name }}</li>
                    @endif
                </ul>

                <div class="banner-grid">
                    <div class="banner-content">
                        <small class="eyebrow">{{ $category->name }}</small>
                        <h1 class="banner-title">{{ $activeSub?->sub_title ?: ($category->sub_title ?: $title) }}</h1>
                        @php $desc = $activeSub?->description ?: $category->description; @endphp
                            @if (!empty($desc))
                                <p class="banner-desc">{{ $desc }}</p>
                            @endif
                        <p class="banner-count">Showing <b>{{ $products->total() }}</b> Products</p>
                    </div>

                    <figure class="banner-visual">
                        <img src="{{ $category->image ? asset('storage/' . $category->image) : asset('assets/images/home/cat4.png') }}"
                            alt="{{ $category->name }}" />
                    </figure>
                </div>
            </div>
        </section>

        {{-- TABS (sub categories) + GRID --}}
        <section class="product-secB">
            <div class="container">
                <ul class="tab-nav">
                    <li @class(['active' => !$activeSub])>
                        <a href="{{ route('category.show', $category->slug) }}">All {{ $category->name }}</a>
                    </li>
                    @foreach ($tabs as $tab)
                        <li @class(['active' => $activeSub?->id === $tab->id])>
                            <a href="{{ route('category.show', [$category->slug, 'sub' => $tab->slug]) }}">{{ $tab->name }}</a>
                        </li>
                    @endforeach
                </ul>

                <div class="tab-nav-content">
                    <div class="tabs active">

@if ($cTitle || $cText)
    <div class="prod-head">
        <div class="heading">
            <small class="eyebrow">{{ $cEyebrow ?: $category->name }}</small>
            @if ($cTitle)
                <h3>{{ $cTitle }}</h3>
            @endif
            @if ($cText)
                <p>{{ $cText }}</p>
            @endif
        </div>
    </div>
@endif

                        <div class="prod-toolbar">
                            <p class="prod-count"><b>{{ $products->total() }}</b> Products</p>
                            <div class="prod-tools">
                                <button type="button" class="tool-btn filter-btn" data-model=".filter-pop">
                                    <i class="fa-solid fa-sliders"></i> Filter
                                </button>
                                <div class="prod-sort">
                                    <label for="prodSort1">Sort By</label>
                                    <div class="sort-box">
                                        <select id="prodSort1" onchange="location.href=this.value">
                                            @foreach (\App\Models\Product::SORT_OPTIONS as $val => $label)
                                                <option
                                                    value="{{ request()->fullUrlWithQuery(['sort' => $val, 'page' => null]) }}"
                                                    @selected($sort === $val)>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                        <i class="fa-solid fa-chevron-down"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="prod-grid">
                            @forelse ($products as $item)
                                @include('partials.product-card', ['p' => $item])
                            @empty
                                <p class="text-center w-100">No products found in this collection yet.</p>
                            @endforelse
                        </div>

                        @if ($products->hasPages())
                            <div class="load-more">
                                @if ($products->hasMorePages())
                                    <a href="{{ $products->nextPageUrl() }}" class="btn btn-outline-black">Load More
                                        Products</a>
                                @endif
                                <p>Showing {{ $products->firstItem() }}–{{ $products->lastItem() }} of {{ $products->total() }} products</p></div>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        {{-- RECENTLY VIEWED --}}
        @if ($recent->isNotEmpty())
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
        @endif

       {{-- ART OF --}}
        @if ($category->art_title || $category->art_text)
    <section class="product-secC">
        <div class="container">
            <div class="art-grid">
                <div class="art-content">
                    <div class="heading">
                        @if ($category->art_eyebrow)
                            <small class="eyebrow">{{ $category->art_eyebrow }}</small>
                        @endif
                        @if ($category->art_title)
                            <h3>{{ $category->art_title }}</h3>
                        @endif
                    </div>

                    @if ($category->art_text)
                        <p>{{ $category->art_text }}</p>
                    @endif

                    @if (!empty($category->art_points))
                        <ul class="art-points">
                            @foreach ($category->art_points as $pt)
                                <li>
                                    @if (!empty($pt['title']))
                                        <b>{{ $pt['title'] }}</b>
                                    @endif
                                    @if (!empty($pt['text']))
                                        <span>{{ $pt['text'] }}</span>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    <div class="btn-group">
                        <a href="{{ route('category.show', $category->slug) }}" class="btn btn-primary">Explore the Collection</a>
                        <a href="{{ route('about') }}" class="btn btn-outline-black">Our Story</a>
                    </div>
                </div>

                    <div class="art-visual">
                        <figure class="art-photo">
                            <img src="{{ $category->art_image ? asset('storage/' . $category->art_image) : asset('assets/images/home/cat4.png') }}"
                                alt="{{ $category->art_title ?: $category->name }}" loading="lazy" />
                            @if ($category->art_caption)
                                <figcaption class="art-cap">{{ $category->art_caption }}</figcaption>
                            @endif
                        </figure>
                    </div>
            </div>
        </div>
    </section>
        @endif

        {{-- YOU MAY ALSO LOVE --}}
        @if ($related->isNotEmpty())
            <section class="product-secE">
                <div class="container">
                    <div class="sec-head">
                        <div class="heading">
                            <small class="eyebrow">HANDPICKED FOR YOU</small>
                            <h3>You May Also Love.</h3>
                            <p>Discover more handcrafted pieces for your home.</p>
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
        @endif
    </main>


      {{-- FILTER POPUP (same UI as the listing page, scoped to this category) --}}
      <div class="model filter-pop">
        <button type="button" class="close" aria-label="Close filters">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                <path d="M5 5l14 14M19 5L5 19" />
            </svg>
        </button>

        <form method="get" action="{{ route('category.show', $category->slug) }}" class="model-body" id="catFilterForm">
            @if ($activeSub)
                <input type="hidden" name="sub" value="{{ $activeSub->slug }}">
            @endif
            <input type="hidden" name="sort" value="{{ $sort }}">

            <div class="title">
                <h4>Filters</h4>
            </div>

            <div class="f-groups">
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
                                    <label class="f-check"><input type="checkbox" name="{{ $f['field'] }}[]"
                                            value="{{ $val }}" @checked(in_array($val, $selected)) /><span
                                            class="f-box"></span><span class="f-text">{{ $label }}</span></label>
                                @endforeach
                            </div>
                        @elseif ($f['type'] === 'chip')
                            <div class="f-body f-chips">
                                @foreach ($f['items'] as $val => $label)
                                    <label class="f-chip"><input type="checkbox" name="{{ $f['field'] }}[]"
                                            value="{{ $val }}"
                                            @checked(in_array($val, $selected)) /><span>{{ $label }}</span></label>
                                @endforeach
                            </div>
                        @elseif ($f['type'] === 'swatch')
                            <div class="f-body f-swatches">
                                @foreach ($f['items'] as $val => [$title, $color])
                                    <label class="f-swatch" title="{{ $title }}"><input type="checkbox"
                                            name="{{ $f['field'] }}[]" value="{{ $val }}"
                                            @checked(in_array($val, $selected)) /><span
                                            style="--c: {{ $color }}"></span></label>
                                @endforeach
                            </div>
                        @elseif ($f['type'] === 'price')
                            @include('partials.price-filter')
                        @elseif ($f['type'] === 'rating')
                            <div class="f-body f-list">
                                @foreach ([4, 3, 2] as $r)
                                    <label class="f-check">
                                        <input type="radio" name="rating" value="{{ $r }}"
                                            @checked((int) request('rating') === $r) /><span
                                            class="f-box is-radio"></span>
                                        <span class="f-text f-stars">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i class="{{ $i <= $r ? 'fa-solid' : 'fa-regular' }} fa-star"></i>
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
                <a href="{{ route('category.show', array_filter(['slug' => $category->slug, 'sub' => $activeSub?->slug])) }}"
                    class="btn btn-outline-black">Clear All</a>
                <button type="submit" class="btn btn-primary">Apply Filters</button>
            </div>
        </form>
    </div>

@endsection
