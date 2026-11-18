@extends('layouts.app')

@section('title', $product->meta_title ?: $product->name)

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/sass/detail/detail.css') }}" />
@endpush

@php
    // gallery: default image first
    $images = $product->images->sortByDesc(fn($i) => (int) $i->is_default)->values();

    $category = $product->category;
    $sub = $product->subcategory;

    $sizeChart    = $category?->size_chart;
    $hasSizeChart = preg_replace('/\s+|&nbsp;/u', '', strip_tags((string) $sizeChart, '<img><table>')) !== '';

    $factIcons = [
        'metal-material' => 'fa-gem',
        'colour-finish'  => 'fa-wand-magic-sparkles',
        'style'          => 'fa-hands-praying',
        'size-height'    => 'fa-ruler-vertical',
    ];

    $hasDiscount = $product->mrp > $product->price;
    $inStock     = $product->stock > 0;
    
    $tiers   = $product->price_type === 'range' ? $product->priceTiers : collect();
$isRange = $tiers->isNotEmpty();
$tiersJs = $tiers->map(fn ($t) => ['from' => $t->min_qty, 'to' => $t->max_qty, 'price' => (float) $t->price])->values();

    $shareUrl   = urlencode(url()->current());
    $shareTitle = urlencode($product->name . ' | ' . config('app.name'));
    $shareImg   = urlencode($product->display_image);

  $specs = collect($product->specifications ?? [])
        ->filter(fn ($r) => filled($r['label'] ?? null) && filled($r['value'] ?? null));

    $accordions = [
        ['Material & Craft',     $product->material_craft],
        ['Size & Dimensions',    $product->size_dimensions],
        ['Care Instructions',    $product->care_instructions],
        ['Shipping & Delivery',  $product->shipping_delivery],
        ['Returns & Exchange',   $product->returns_exchange],
    ];
  
    $total = (int) $product->reviews_count;
    $avg   = (float) $product->avg_rating;
    $tabCounts = [1 => $total, 2 => count($reviewTabs[2]), 3 => (int) ($ratingBreakdown[5] ?? 0)];

    $arrowPrev = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M15 5l-7 7 7 7" /></svg>';
    $arrowNext = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M9 5l7 7-7 7" /></svg>';
@endphp

@section('content')
    <main>
        <!-- ============ A : GALLERY + INFO ============ -->
        <section class="detail-secA">
            <div class="container">

                <ul class="crumb">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><i class="fa-solid fa-chevron-right"></i></li>
                    <li><a href="{{ route('products') }}">Shop All Products</a></li>
                    @if ($category)
                        <li><i class="fa-solid fa-chevron-right"></i></li>
                        <li><a href="{{ route('category.show', $category->slug) }}">{{ $category->name }}</a></li>
                    @endif
                    @if ($category && $sub)
                        <li><i class="fa-solid fa-chevron-right"></i></li>
                        <li><a href="{{ route('category.show', [$category->slug, 'sub' => $sub->slug]) }}">{{ $sub->name }}</a>
                        </li>
                    @endif
                    <li><i class="fa-solid fa-chevron-right"></i></li>
                    <li class="current">{{ $product->name }}</li>
                </ul>

                <div class="detail-layout">

<!-- GALLERY -->
<div class="detail-gallery">
    <div class="gallery-main">
        <button type="button" class="gallery-wish wish-btn" aria-label="Add to wishlist"
            data-id="{{ $product->id }}">
            <i class="fa-regular fa-heart"></i>
        </button>

        <div class="swiper detailMain">
            <div class="swiper-wrapper">
                @forelse ($images as $img)
                    <div class="swiper-slide">
                        <a href="{{ asset('storage/' . $img->image) }}" class="gallery-img glightbox"
                            data-gallery="product">
                            <img src="{{ asset('storage/' . $img->image) }}" alt="{{ $product->name }}"
                                @if ($loop->first) fetchpriority="high" @else loading="lazy" @endif />
                        </a>
                    </div>
                @empty
                    <div class="swiper-slide">
                        <span class="gallery-img">
                            <img src="{{ $product->display_image }}" alt="{{ $product->name }}" />
                        </span>
                    </div>
                @endforelse
            </div>
        </div>

        <span class="gallery-counter">01 / {{ str_pad(max(1, $images->count()), 2, '0', STR_PAD_LEFT) }}</span>

        <div class="g-nav" @if ($images->count() <= 1) style="display:none" @endif>
            <button type="button" class="g-prev" aria-label="Previous image"><i
                    class="fa-solid fa-chevron-left"></i></button>
            <button type="button" class="g-next" aria-label="Next image"><i
                    class="fa-solid fa-chevron-right"></i></button>
        </div>
    </div>

    <div class="thumb-list" @if ($images->count() <= 1) style="display:none" @endif>
        @foreach ($images as $img)
            <button type="button" @class(['active' => $loop->first])
                aria-label="View image {{ $loop->iteration }}">
                <img src="{{ asset('storage/' . ($img->thumb ?? $img->image)) }}" alt="" loading="lazy" />
            </button>
        @endforeach
    </div>
</div>


                    <!-- INFO -->
                    <div class="detail-info">

                        <div class="info-top">
                            @if ($category)
                                <span class="eyebrow">{{ $sub?->name ?: $category->name }}</span>
                            @endif
                            <span class="info-pill" id="stockPill"><i class="fa-solid fa-circle"></i> {{ $inStock ? 'In Stock' : 'Out of Stock' }}</span>
                        </div>

                        <h1>{{ $product->name }}</h1>

                        <div class="info-rate">
                            @if ($product->reviews_count > 0)
                                <span class="rate-pill"><i class="fa-solid fa-star"></i>
                                    {{ number_format($product->avg_rating, 1) }}</span>
                                <a href="#reviews" class="rate-count">
                                    {{ $product->reviews_count }}
                                    {{ \Illuminate\Support\Str::plural('Review', $product->reviews_count) }}
                                </a>
                            @endif
                           @if ($product->sku)
    <span class="info-sku">SKU: <span id="skuText">{{ $product->sku }}</span></span>
@endif
                        </div>

       @if ($isRange)
    <div class="info-price-range">
        <div class="range-grid">
            @foreach ($tiers as $t)
                <div class="range-tier" data-from="{{ $t->min_qty }}">
                    <small>{{ $t->max_qty ? $t->min_qty . ' - ' . $t->max_qty : $t->min_qty . '+' }} Pieces</small>
                    <div class="range-price">
                        <b>@money($t->price)</b>
                        @if ($product->mrp > $t->price)<del>@money($product->mrp)</del>@endif
                    </div>
                </div>
            @endforeach
        </div>
        <p class="price-tax" id="priceTax">Price per piece. Inclusive of all taxes. Bulk price applies automatically.</p>
    </div>
@else
    <div class="info-price">
        <span class="price-now" id="priceNow">@money($product->price)</span>
        <span class="price-old" id="priceOld" @unless ($hasDiscount) style="display:none" @endunless>@money($product->mrp)</span>
        <span class="price-off" id="priceOff" @unless ($hasDiscount) style="display:none" @endunless>{{ $product->discount_percent }}% OFF</span>
        <p class="price-tax" id="priceTax">
            Inclusive of all taxes.@if ($hasDiscount) You save @money($product->mrp - $product->price).@endif
        </p>
    </div>
@endif


                        @if (filled($product->short_description))
    <p class="info-desc">{{ strip_tags($product->short_description) }}</p>
@endif


                       @if ($facts->isNotEmpty())
    <ul class="info-facts">
        @foreach ($facts as $g)
            <li>
                <i class="fa-solid {{ $factIcons[$g['slug']] ?? 'fa-circle-check' }}"></i>
                <div><small>{{ $g['name'] }}</small><b>{{ $g['values']->pluck('value')->implode(', ') }}</b></div>
            </li>
        @endforeach
    </ul>
@endif


@foreach ($options as $g)
    <div class="opt-group">
        <div class="opt-head">
            <span>{{ $g['name'] }}</span>
            <b class="opt-value">{{ $g['values']->first()->value }}</b>
        </div>

        @if ($g['type'] === 'color_swatch')
            <div class="opt-swatches">
                @foreach ($g['values'] as $v)
                    <label class="opt-swatch" title="{{ $v->value }}">
                        <input type="radio" name="attr[{{ $g['slug'] }}]" value="{{ $v->id }}"
                            data-attr="{{ $g['id'] }}" data-name="{{ $v->value }}" @checked($loop->first) />
                        <span style="--c: {{ $v->hex_code ?: '#cccccc' }}"></span><em>{{ $v->value }}</em>
                    </label>
                @endforeach
            </div>
        @else
            <div class="opt-sizes">
                @foreach ($g['values'] as $v)
                    <label class="opt-size">
                        <input type="radio" name="attr[{{ $g['slug'] }}]" value="{{ $v->id }}"
                            data-attr="{{ $g['id'] }}" data-name="{{ $v->value }}" @checked($loop->first) />
                        <span>{{ $v->value }}</span>
                    </label>
                @endforeach
            </div>
        @endif
    </div>
@endforeach


            @if ($hasSizeChart)
    <div class="opt-group">
        <div class="opt-head">
            <button type="button" class="size-guide" data-model=".size-pop">
                <i class="fa-solid fa-ruler"></i> Size Guide
            </button>
        </div>
    </div>
@endif

                        @foreach ($product->addons as $addon)
    <div class="opt-group">
        <label class="opt-switch">
            <input type="checkbox" name="addons[]" value="{{ $addon->id }}" data-price="{{ $addon->price }}" />
            <span class="os-text">{{ $addon->detail }}
                @if (filled($addon->description))
                    <small>{{ $addon->description }}</small>
                @endif
            </span>
            <strong>+ @money($addon->price)</strong>
            <span class="os-track"></span>
        </label>
    </div>
@endforeach

                      <p class="info-stock" id="stockLine">
    <i class="fa-solid fa-circle"></i>
    <b id="stockLabel">{{ $inStock ? 'Ready to ship' : 'Out of stock' }}</b>
@if($inStock && filled($product->delivery_time))
    <em class="stock-dispatch">Dispatch in {{ $product->delivery_time }}</em>
@endif
    <em id="stockNote">@if ($inStock && $product->stock <= 10)Only {{ $product->stock }} {{ \Illuminate\Support\Str::plural('piece', $product->stock) }} left @endif</em>
</p>

                        <div class="info-actions">
                            <div class="act-top">
                                <div class="qty-box">
                                    <button type="button" class="qty-minus" aria-label="Decrease quantity">
                                        <i class="fa-solid fa-minus"></i>
                                    </button>
                                    <input type="text" class="qty-input" value="1" aria-label="Quantity" />
                                    <button type="button" class="qty-plus" aria-label="Increase quantity">
                                        <i class="fa-solid fa-plus"></i>
                                    </button>
                                </div>
                                <button type="button" class="wish-link">
                                    <i class="fa-regular fa-heart"></i> Add to Wishlist
                                </button>
                            </div>
                            <div class="act-btns">
                                <button type="button" class="btn btn-outline-black js-add-cart" data-id="{{ $product->id }}"
    data-name="{{ $product->name }}" data-toast-title="Added to Cart"
    data-toast-text="{{ $product->name }} has been added to your cart." data-toast-type="success"
    data-selection="{}">
    Add to Cart
</button>
<a href="{{ route('checkout') }}" class="btn btn-primary js-buy-now">Buy Now</a>
                            </div>
                        </div>

                        <ul class="info-perks">
                            <li>
                                <i class="fa-solid fa-hammer"></i>
                                <div><b>Handcrafted</b>
                                    <p>Finished by hand</p>
                                </div>
                            </li>
                            <li>
                                <i class="fa-solid fa-earth-asia"></i>
                                <div><b>Worldwide</b>
                                    <p>India and abroad</p>
                                </div>
                            </li>
                            <li>
                                <i class="fa-solid fa-arrow-right-arrow-left"></i>
                                <div><b>Easy Returns</b>
                                    <p>7-day window</p>
                                </div>
                            </li>
                            <li>
                                <i class="fa-solid fa-shield-halved"></i>
                                <div><b>Secure Pay</b>
                                    <p>Trusted checkout</p>
                                </div>
                            </li>
                        </ul>

                        <div class="info-delivery">
                            <div class="del-head">
                                <i class="fa-solid fa-location-dot"></i><b>Check Delivery</b>
                            </div>
                            <form class="pin-form" action="{{ route('pincode.check') }}" method="get">
    <input type="text" name="pincode" inputmode="numeric" maxlength="6"
        placeholder="Enter your pincode" aria-label="Pincode" />
    <button type="submit">Check</button>
</form>
<p class="pin-result">
    <i class="fa-solid fa-circle-info"></i><span>Ordering from outside India? Delivery time and charges are shown at checkout.</span>
</p>
                            <ul class="del-points">
                                @if ($freeShipFrom > 0)
                                <li><i class="fa-solid fa-truck-fast"></i> Free shipping on orders above @money($freeShipFrom)</li>
                                @endif
                                <li><i class="fa-solid fa-earth-asia"></i> Worldwide shipping with tracking</li>
                                <li><i class="fa-solid fa-box-open"></i> Packed to protect metal and finish</li>
                            </ul>
                        </div>

                        <div class="info-offers">
                            <div class="offers-head">
                                <h5>Offers &amp; Coupons</h5>
                            </div>
                            @foreach ($coupons as [$icon, $title, $desc, $code])
                                <div class="offer-row">
                                    <span class="offer-ico"><i class="fa-solid {{ $icon }}"></i></span>
                                    <div class="offer-text">
                                        <b>{{ $title }}</b>
                                        <p>{{ $desc }}</p>
                                    </div>
                                    <button type="button" class="coupon-copy" data-copy="{{ $code }}"
                                        aria-label="Copy coupon code">
                                        <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor"
                                            stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="9" y="9" width="11" height="11" rx="2" />
                                            <path d="M5 15V6a2 2 0 012-2h9" />
                                        </svg><span>{{ $code }}</span>
                                    </button>
                                </div>
                            @endforeach

                        </div>

                        <div class="info-help">
                            <div class="help-text">
                                <b>Need help choosing?</b>
                                <p>Ask our team about size, finish or gifting.</p>
                            </div>
                           @php
    $waNumber = preg_replace('/\D+/', '', (string) ($general->whatsapp ?? ''));
    $callNumber = preg_replace('/[^\d+]/', '', (string) ($general->phone ?? ''));
    $waText = urlencode('Hi, I need help with: ' . $product->name . ' - ' . url()->current());
@endphp

@if ($waNumber || $callNumber)
    <div class="help-links">
        @if ($waNumber)
            <a href="https://wa.me/{{ $waNumber }}?text={{ $waText }}" target="_blank" rel="noopener noreferrer"
                class="help-link"><i class="fa-brands fa-whatsapp"></i> WhatsApp</a>
        @endif
        @if ($callNumber)
            <a href="tel:{{ $callNumber }}" class="help-link"><i class="fa-solid fa-phone"></i> Call Us</a>
        @endif
    </div>
@endif
                        </div>

<div class="accordion-wrapper">

    {{-- Product Details (specifications rows) --}}
    @if ($specs->isNotEmpty())
        <div class="accordion-item active">
            <button type="button" class="accordion-header">
                <h4>Product Details</h4>
                <span class="accordion-icon">+</span>
            </button>
            <div class="accordion-content">
                <div class="acc-inner">
                    <ul class="spec-list">
                        @foreach ($specs as $r)
                            <li><span>{{ $r['label'] }}</span><b>{{ $r['value'] }}</b></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    {{-- Textarea accordions: shown whole, only if filled --}}
    @foreach ($accordions as [$title, $content])
        @php
            $isSize = $title === 'Size & Dimensions';
            $show   = \App\Models\Product::hasText($content) || ($isSize && $hasSizeChart);
        @endphp

        @if ($show)
            <div class="accordion-item">
                <button type="button" class="accordion-header">
                    <h4>{{ $title }}</h4>
                    <span class="accordion-icon">+</span>
                </button>
                <div class="accordion-content">
                    <div class="acc-inner">
                        @if (\App\Models\Product::hasText($content))
                            <div class="acc-rich">{!! \App\Models\Product::rich($content) !!}</div>
                        @endif

                        @if ($isSize && $hasSizeChart)
                            <button type="button" class="policy-link" data-model=".size-pop">
                                Open Size Guide <i class="fa-solid fa-arrow-right-long"></i>
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    @endforeach
</div>

<!-- SHARE -->
<div class="info-share">
    <span class="share-label">Share This:</span>
    <ul class="share-list">
        <li>
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}"
                target="_blank" rel="noopener noreferrer" class="js-share" aria-label="Share on Facebook">
                <i class="fa-brands fa-facebook-f"></i></a>
        </li>
        <li>
            <a href="https://twitter.com/intent/tweet?url={{ $shareUrl }}&text={{ $shareTitle }}"
                target="_blank" rel="noopener noreferrer" class="js-share" aria-label="Share on X">
                <i class="fa-brands fa-x-twitter"></i></a>
        </li>
        <li>
            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ $shareUrl }}"
                target="_blank" rel="noopener noreferrer" class="js-share" aria-label="Share on LinkedIn">
                <i class="fa-brands fa-linkedin-in"></i></a>
        </li>
        <li>
            <a href="https://pinterest.com/pin/create/button/?url={{ $shareUrl }}&media={{ $shareImg }}&description={{ $shareTitle }}"
                target="_blank" rel="noopener noreferrer" class="js-share" aria-label="Share on Pinterest">
                <i class="fa-brands fa-pinterest-p"></i></a>
        </li>
        <li>
            <a href="https://wa.me/?text={{ $shareTitle }}%20{{ $shareUrl }}"
                target="_blank" rel="noopener noreferrer" aria-label="Share on WhatsApp">
                <i class="fa-brands fa-whatsapp"></i></a>
        </li>
        <li>
            <a href="javascript:void(0)" class="js-copy-link" data-url="{{ url()->current() }}" aria-label="Copy link">
                <i class="fa-solid fa-link"></i></a>
        </li>
    </ul>
</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============ B : CRAFT STORY ============ -->
        <section class="detail-secB">
            <div class="container">
                <div class="craft-grid">
                    <div class="craft-visual">
                        <figure class="craft-photo">
                            <img src="{{ asset('assets/images/home/cat4.png') }}" alt="Handcrafted brass lamp"
                                loading="lazy" />
                            <figcaption class="craft-cap">Handcrafted in India</figcaption>
                        </figure>
                        <div class="craft-badge">
                            <small>Artisan Made</small><b>Every piece is unique</b>
                        </div>
                    </div>

                    <div class="craft-content">
                        <div class="heading">
                            <small class="eyebrow">Behind This Piece</small>
                            <h3>Made by Hand, Piece by Piece.</h3>
                            <p>
                                Every Parijaat brass piece is shaped, finished and checked by
                                hand before it reaches your home.
                            </p>
                        </div>
                        <ol class="craft-steps">
                            <li>
                                <span class="step-no">01</span>
                                <div><b>Cast and Shaped</b>
                                    <p>Molten brass is poured and the form is shaped by the artisan.</p>
                                </div>
                            </li>
                            <li>
                                <span class="step-no">02</span>
                                <div><b>Detailed by Hand</b>
                                    <p>Lines, curves and engraving are refined on every piece.</p>
                                </div>
                            </li>
                            <li>
                                <span class="step-no">03</span>
                                <div><b>Polished and Checked</b>
                                    <p>The surface is polished and each lamp is inspected before packing.</p>
                                </div>
                            </li>
                        </ol>
                        <ul class="craft-stats">
                            <li><b>Hand</b><small>Finished piece by piece</small></li>
                            <li><b>Solid</b><small>Brass construction</small></li>
                            <li><b>India</b><small>Made by artisans</small></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

<!-- ============ C : REVIEWS ============ -->
<section class="detail-secC" id="reviews">
    <div class="container">
        <div class="heading">
            <small class="eyebrow">Customer Reviews</small>
            <h3>What Our Customers Say.</h3>
            <p>Honest words from people who bring Parijaat home.</p>
        </div>

        <div class="review-summary">
            <div class="rs-score">
                @if ($total > 0)
                    <b>{{ number_format($avg, 1) }}</b><span>/ 5</span>
                    <div class="rs-stars">
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="{{ $i <= round($avg) ? 'fa-solid' : 'fa-regular' }} fa-star"></i>
                        @endfor
                    </div>
                    <p>Based on {{ $total }} {{ \Illuminate\Support\Str::plural('review', $total) }}</p>
                @else
                    <b>—</b>
                    <p>No reviews yet</p>
                @endif
            </div>

            <ul class="rs-bars">
                @foreach ([5, 4, 3, 2, 1] as $star)
                    @php
                        $count = (int) ($ratingBreakdown[$star] ?? 0);
                        $pct   = $total ? round($count / $total * 100) : 0;
                    @endphp
                    <li>
                        <span>{{ $star }} <i class="fa-solid fa-star"></i></span>
                        <div class="bar"><i style="width: {{ $pct }}%"></i></div>
                        <em>{{ $count }}</em>
                    </li>
                @endforeach
            </ul>

            <div class="rs-fit">
                <h5>Bought this?</h5>
                <p>Share your experience with other customers.</p>
                <button type="button" class="btn btn-primary" data-model=".review-pop">Write a Review</button>
            </div>
        </div>

        @if ($reviewPhotos->isNotEmpty())
            <div class="review-photos">
                <h5>Customer Photos <span>({{ $reviewPhotos->count() }})</span></h5>
                <div class="rp-grid">
                    @foreach ($reviewPhotos->take(6) as $n => $ph)
                        @php $last = $loop->last && $reviewPhotos->count() > 6; @endphp
                        <a href="{{ asset($ph) }}" @class(['rp-item', 'glightbox', 'more' => $last])
                            data-gallery="customer-photos">
                            <img src="{{ asset($ph) }}" alt="Customer photo {{ $n + 1 }}" loading="lazy" />
                            @if ($last)<span>+{{ $reviewPhotos->count() - 6 }}</span>@endif
                        </a>
                    @endforeach
                    @foreach ($reviewPhotos->slice(6) as $ph)
                        <a href="{{ asset($ph) }}" class="glightbox" data-gallery="customer-photos" hidden></a>
                    @endforeach
                </div>
            </div>
        @endif

        @if ($total > 0)
            <div class="review-bar">
                <ul class="tab-nav">
                    <li class="active" data-tab="1">All ({{ $tabCounts[1] }})</li>
                    <li data-tab="2">With Photos ({{ $tabCounts[2] }})</li>
                    <li data-tab="3">5 Star ({{ $tabCounts[3] }})</li>
                </ul>
            </div>

            <div class="tab-nav-content">
                @foreach ($reviewTabs as $tabNo => $tabReviews)
                    <div @class(['tabs', 'active' => $tabNo === 1]) data-tab="{{ $tabNo }}">
                        @if (count($tabReviews))
                            <div class="swiper-wrap">
                                <div class="swiper fourSlider" data-mob="1.1" data-sm="2.2" data-lg="3" data-xl="3">
                                    <div class="swiper-wrapper">
                                        @foreach ($tabReviews as $r)
                                            <div class="swiper-slide">
                                                @include('partials.review-card', ['r' => $r, 'g' => "rv-$tabNo-$loop->index"])
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="swiper-group">
                                    <button type="button" class="btn-prev" aria-label="Previous">{!! $arrowPrev !!}</button>
                                    <button type="button" class="btn-next" aria-label="Next">{!! $arrowNext !!}</button>
                                </div>
                            </div>
                        @else
                            <p class="review-empty">No reviews in this filter yet.</p>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

<!-- ============ D : YOU MAY ALSO LOVE ============ -->
@if ($related->isNotEmpty())
<section class="detail-secD">
    <div class="container">
        <div class="heading">
            <small class="eyebrow">Handpicked for You</small>
            <h3>Complete the Look.</h3>
            <p>More handcrafted pieces from the same collection.</p>
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

<!-- ============ E : STILL ON YOUR MIND ============ -->
@if ($recent->isNotEmpty())
<section class="detail-secE">
    <div class="container">
        <div class="heading">
            <small class="eyebrow">Recently Viewed</small>
            <h3>Still on Your Mind?</h3>
            <p>Pick up where you left off.</p>
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

<!-- ============ STICKY BUY BAR ============ -->
<div class="detail-sticky" aria-hidden="true">
    <div class="ds-product">
        <img src="{{ $product->display_image }}" alt="{{ $product->name }}" loading="lazy" />
        <div class="ds-text">
            <b>{{ $product->name }}</b>
            <span>
                <strong class="ds-price">@money($product->price)</strong>
                <em class="ds-off" @unless ($hasDiscount) style="display:none" @endunless>{{ $product->discount_percent }}% OFF</em>
            </span>
        </div>
    </div>
    <div class="ds-actions">
        <div class="qty-box">
            <button type="button" class="qty-minus" aria-label="Decrease quantity"><i class="fa-solid fa-minus"></i></button>
            <input type="text" class="qty-input" value="1" aria-label="Quantity" />
            <button type="button" class="qty-plus" aria-label="Increase quantity"><i class="fa-solid fa-plus"></i></button>
        </div>
        <button type="button" class="btn btn-outline-black js-add-cart" data-id="{{ $product->id }}"
            data-name="{{ $product->name }}" data-toast-title="Added to Cart"
            data-toast-text="{{ $product->name }} has been added to your cart." data-toast-type="success"
            data-selection="{}">Add to Cart</button>
       <a href="{{ route('checkout') }}" class="btn btn-primary js-buy-now">Buy Now</a>
    </div>
</div>

    </main>

    <!-- ================= Page Models ================= -->
    @if ($hasSizeChart)
        <div class="model size-pop">
            <button type="button" class="close" aria-label="Close size guide">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                    <path d="M5 5l14 14M19 5L5 19" />
                </svg>
            </button>
            <div class="model-body">
                <div class="title">
                    <h4>Size &amp; Dimension Guide</h4>
                    <p>{{ $category->name }}</p>
                </div>
                {!! $sizeChart !!}
            </div>
        </div>
    @endif

    <div class="model review-pop">
    <button type="button" class="close" aria-label="Close review">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
            <path d="M5 5l14 14M19 5L5 19" />
        </svg>
    </button>
    <div class="model-body">
        <div class="title">
            <h4>Write a Review</h4>
            <p>{{ $product->name }}</p>
        </div>

        @if ($reviewState === 'guest')
            <div class="rf-note">
                <p>Please log in to share your experience with this product.</p>
                <a href="{{ route('login') }}" class="btn btn-primary">Log in</a>
            </div>
        @elseif ($reviewState === 'none')
            <div class="rf-note">
                <p>Only customers who have received this product can review it.</p>
            </div>
        @else
            <form class="form review-form" action="{{ route('product.review.store', $product->id) }}"
                method="post" enctype="multipart/form-data" novalidate>
                @csrf
                <div class="rf-rate">
                    <span>Your Rating</span>
                    <div class="rate-input">
                        @foreach ([5, 4, 3, 2, 1] as $n)
                            <input type="radio" name="rating" id="rate{{ $n }}" value="{{ $n }}" />
                            <label for="rate{{ $n }}" aria-label="{{ $n }} {{ $n === 1 ? 'star' : 'stars' }}"><i
                                    class="fa-solid fa-star"></i></label>
                        @endforeach
                    </div>
                </div>
                <div class="form-group">
                    <input type="text" id="rvTitle" name="title" maxlength="120" placeholder=" " />
                    <label for="rvTitle">Review Title <em>(optional)</em></label>
                </div>
                <div class="form-group">
                    <textarea id="rvText" name="review" maxlength="2000" placeholder=" " required></textarea>
                    <label for="rvText">Your Review</label>
                </div>
                <div class="rf-upload">
                    <label class="upload-box" for="rvPhotos">
                        <i class="fa-regular fa-image"></i>
                        <b>Choose Photos <em>(optional)</em></b>
                        <span>Up to 5 photos · JPG or PNG · max 5MB each</span>
                        <input type="file" id="rvPhotos" name="photos[]" accept="image/*" multiple />
                    </label>
                    <div class="upload-preview"></div>
                </div>
                <p class="rf-msg" role="alert" style="display:none"></p>
                <div class="rf-submit">
                    <button type="submit" class="btn btn-primary">Submit Review</button>
                    <p>Your name is taken from your account. Reviews appear after approval.</p>
                </div>
            </form>
        @endif
    </div>
</div>

@endsection

@php
    $jsBase = [
        'price' => (float) $product->price,
        'mrp'   => (float) $product->mrp,
        'stock' => (int) $product->stock,
        'sku'   => $product->sku,
        'minQty' => $product->minOrderQty(),
    ];
@endphp

@push('scripts')
    <script>
        $(function () {
            var pad = function (n) { return ("0" + n).slice(-2); };

            var REGION = @json($regionJs);
            var BASE = @json($jsBase);
            var VARIANTS = @json($variantData);
            var PRODUCT_NAME = @json($product->name);
            var PRODUCT_ID = {{ $product->id }};

            // original gallery (must be captured BEFORE new Swiper)
            var origSlides = $(".detailMain .swiper-wrapper").html();
            var origThumbs = $(".thumb-list").html();
            var origCount = $(".detailMain .swiper-slide").length;
            var galleryVariantId = null;

            var main;
            if (document.querySelector(".detailMain")) {
                main = new Swiper(".detailMain", {
                    speed: 600,
                    navigation: { nextEl: ".g-next", prevEl: ".g-prev" },
                    pagination: {
                        el: ".gallery-counter",
                        type: "fraction",
                        formatFractionCurrent: pad,
                        formatFractionTotal: pad,
                    },
                });

                main.on("slideChange", function () {
                    $(".thumb-list button").removeClass("active").eq(main.activeIndex).addClass("active");
                });
            }

            $(document).on("click", ".thumb-list button", function () {
                if (main) main.slideTo($(this).index());
            });

            var lightbox = GLightbox({ selector: ".glightbox", touchNavigation: true, loop: true });

            function refreshGallery(count) {
                if (!main) return;
                main.update();
                main.slideTo(0, 0);
                main.pagination.render();
                main.pagination.update();
                $(".g-nav, .thumb-list").toggle(count > 1);
                lightbox.reload();
            }

            function setGallery(variant) {
                var id = variant ? variant.id : null;
                if (id === galleryVariantId) return;
                galleryVariantId = id;
                if (!main) return;

                if (!variant || !variant.images.length) {
                    main.removeAllSlides();
                    main.appendSlide(origSlides);
                    $(".thumb-list").html(origThumbs);
                    refreshGallery(origCount);
                    return;
                }

                var slides = "", thumbs = "";
                variant.images.forEach(function (im, i) {
                    slides += '<div class="swiper-slide"><a href="' + im.full + '" class="gallery-img glightbox" data-gallery="product">' +
                        '<img src="' + im.full + '" alt="' + $("<i>").text(PRODUCT_NAME).html() + '" /></a></div>';
                    thumbs += '<button type="button"' + (i === 0 ? ' class="active"' : '') + '><img src="' + im.thumb + '" alt="" /></button>';
                });
                main.removeAllSlides();
                main.appendSlide(slides);
                $(".thumb-list").html(thumbs);
                refreshGallery(variant.images.length);
            }

            function selection() {
                var s = {};
                $("input[data-attr]:checked").each(function () {
                    s[$(this).data("attr")] = parseInt($(this).val(), 10);
                });
                return s;
            }

            function hasType(type) {
                return VARIANTS.some(function (v) { return v.type === type; });
            }

            var MAX_QTY = 10;
var TIERS = @json($tiersJs);
var MIN_QTY = Math.max(BASE.minQty || 1, TIERS.length ? TIERS[0].from : 1);

function tierFor(qty) {
    if (!TIERS.length) return null;
    var hit = null;
    TIERS.forEach(function (t) { if (qty >= t.from && (t.to === null || qty <= t.to)) hit = t; });
    return hit || (qty < TIERS[0].from ? TIERS[0] : TIERS[TIERS.length - 1]);
}

function match(type, sel) {
    var chosen = Object.keys(sel).map(function (k) { return sel[k]; });
    var found = null;
    VARIANTS.forEach(function (v) {
        if (v.type !== type) return;
        var vals = Object.keys(v.attrs).map(function (k) { return parseInt(v.attrs[k], 10); });
        if (!vals.length) return;
        var ok = vals.every(function (id) { return chosen.indexOf(id) !== -1; });
        if (ok && (!found || vals.length > Object.keys(found.attrs).length)) found = v;
    });
    return found;
}


            function conv(n) {
    var d = REGION.decimals, p = Math.pow(10, d);
    return Math.round(n * REGION.factor * p) / p;
}
function fmt(v) {
    var s = v.toLocaleString("en-US", {
        minimumFractionDigits: REGION.decimals,
        maximumFractionDigits: REGION.decimals
    });
    return REGION.symbol + (REGION.space ? " " : "") + s;
}
function money(n) { return fmt(conv(n)); }

           function cartPayload() {
    var sel = selection();
    var pv = match("price", sel), sv = match("stock", sel), kv = match("sku", sel), iv = match("image", sel);
    return {
        product_id: PRODUCT_ID,
        quantity: parseInt($(".qty-input").first().val(), 10) || MIN_QTY,
        selected_values: Object.keys(sel).map(function (k) { return sel[k]; }),
        price_variant_id: pv ? pv.id : null,
        image_variant_id: iv ? iv.id : null,
        stock_variant_id: sv ? sv.id : null,
        sku_variant_id: kv ? kv.id : null,
        addon_ids: $('input[name="addons[]"]:checked').map(function () { return parseInt(this.value, 10); }).get()
    };
}
            window.getCartPayload = cartPayload;

           function apply() {
    var sel = selection();
    var pv = match("price", sel), sv = match("stock", sel), kv = match("sku", sel), iv = match("image", sel);

    var stock = sv ? sv.stock : BASE.stock;
    var avail = sv ? sv.available : true;
    if (hasType("stock") && !sv) { stock = 0; avail = false; }
    var blocked = [pv, kv, iv].some(function (v) { return v && v.available === false; });
    var out = blocked || !avail || stock <= 0;

    var cap = TIERS.length ? (TIERS[TIERS.length - 1].to || 9999) : 10;
    MAX_QTY = out ? 1 : Math.max(1, Math.min(cap, stock));

    var qty = parseInt($(".qty-input").first().val(), 10) || MIN_QTY;
    if (qty > MAX_QTY) qty = MAX_QTY;
    if (qty < MIN_QTY) qty = MIN_QTY;
    $(".qty-input").val(qty);

    // range tier price wins over the variant price (all values here are in the DEFAULT currency)
    var tier  = tierFor(qty);
    var price = tier ? tier.price : (pv ? pv.price : BASE.price);
    var mrp   = tier ? BASE.mrp : (pv ? (pv.mrp || pv.price) : BASE.mrp);

    // convert each piece on its own and round it, exactly like PHP's @money does,
    // so the page shows the same amounts as the cards, the add-on labels and the cart
    var addonC = 0;
    $('input[name="addons[]"]:checked').each(function () {
        addonC += conv(parseFloat($(this).data("price")) || 0);
    });

    var cUnit    = conv(price) + addonC;
    var cUnitMrp = conv(Math.max(mrp, price)) + addonC;
    var total    = cUnit * qty;
    var totalMrp = cUnitMrp * qty;
    var off = mrp > price ? Math.round((mrp - price) / mrp * 100) : 0;

    $("#priceNow").text(fmt(total));
    $("#priceOld").text(fmt(totalMrp)).toggle(off > 0);
    $("#priceOff").text(off + "% OFF").toggle(off > 0);
    $(".ds-price").text(fmt(total));
    $(".ds-off").text(off + "% OFF").toggle(off > 0);

    if (TIERS.length) {
        $(".range-tier").each(function () {
            $(this).toggleClass("active", !!tier && +$(this).data("from") === tier.from);
        });
        $("#priceTax").text("Inclusive of all taxes. " + fmt(cUnit) + " per piece × " + qty + " = " + fmt(total));
    } else {
        $("#priceTax").text(
            "Inclusive of all taxes." +
            (off > 0 ? " You save " + fmt(totalMrp - total) + "." : "") +
            (qty > 1 ? " (" + fmt(cUnit) + " each)" : "")
        );
    }

    var sku = kv && kv.sku ? kv.sku : (pv && pv.sku ? pv.sku : BASE.sku);
    if (sku) $("#skuText").text(sku);

    $("#stockLabel").text(out ? "Out of stock" : "Ready to ship");
    $(".stock-dispatch").toggle(!out);
    $("#stockNote").text(!out && stock <= 10 ? "Only " + stock + (stock === 1 ? " piece" : " pieces") + " left" : "");
    $("#stockPill").html('<i class="fa-solid fa-circle"></i> ' + (out ? "Out of Stock" : "In Stock"));

    var $cartBtns = $(".info-actions .js-add-cart, .detail-sticky .js-add-cart");
    var $buyBtns  = $(".info-actions .js-buy-now, .detail-sticky .js-buy-now");

    $cartBtns.prop("disabled", out);
    $buyBtns.toggleClass("disabled", out)
        .css({ "pointer-events": out ? "none" : "", "opacity": out ? ".5" : "" });
    setGallery(iv);
    $cartBtns.attr("data-selection", JSON.stringify(cartPayload()));

}

var QTY = ".detail-secA, .detail-sticky";
$(document).on("click", ".detail-secA .qty-plus, .detail-secA .qty-minus, .detail-sticky .qty-plus, .detail-sticky .qty-minus", function () {
    var v = parseInt($(this).siblings(".qty-input").val(), 10) || MIN_QTY;
    v = $(this).hasClass("qty-plus") ? Math.min(MAX_QTY, v + 1) : Math.max(MIN_QTY, v - 1);
    $(".qty-input").val(v);
    apply();
});
$(document).on("change", ".detail-secA .qty-input, .detail-sticky .qty-input", function () {
    var v = parseInt($(this).val(), 10) || MIN_QTY;
    $(".qty-input").val(Math.min(MAX_QTY, Math.max(MIN_QTY, v)));
    apply();
});


            $(document).on("change", "input[data-attr]", function () {
                $(this).closest(".opt-group").find(".opt-value").text($(this).data("name"));
                apply();
            });
            $(document).on("change", 'input[name="addons[]"]', apply);

    
            var bar = document.querySelector(".detail-sticky");
            var target = document.querySelector(".info-actions");
            if (bar && target) {
                new IntersectionObserver(function (e) {
                    bar.classList.toggle("show", !e[0].isIntersecting && e[0].boundingClientRect.top < 0);
                }).observe(target);
            }

            $(document).on("submit", ".pin-form", function (e) {
    e.preventDefault();
    var $f = $(this), pin = $.trim($f.find('[name="pincode"]').val());
    var $res = $(".pin-result"), $txt = $res.find("span");

    function show(ok, msg) {
        $res.removeClass("ok err").addClass(ok ? "ok" : "err");
        $txt.text(msg);
    }

    if (!/^\d{6}$/.test(pin)) { show(false, "Enter a valid 6-digit pincode."); return; }

    $f.find("button").prop("disabled", true);
    $.getJSON($f.attr("action"), { pincode: pin })
        .done(function (r) {
            if (!r.status) { show(false, r.message); return; }
            var place = [r.district, r.state].filter(Boolean).join(", ");
            var msg = "Delivery available" + (place ? " to " + place : "");
            if (r.eta) msg += ". Estimated " + r.eta + (r.eta_date ? " (by " + r.eta_date + ")" : "");
            show(true, msg + ".");
        })
        .fail(function (xhr) {
            var err = xhr.responseJSON && xhr.responseJSON.errors && xhr.responseJSON.errors.pincode;
            show(false, err ? err[0] : "Could not check right now. Please try again.");
        })
        .always(function () { $f.find("button").prop("disabled", false); });
});

$(document).on("click", ".js-share", function (e) {
    e.preventDefault();
    window.open(this.href, "share", "width=600,height=500,noopener");
});

$(document).on("click", ".js-copy-link", function () {
    var url = $(this).data("url"), $i = $(this).find("i");
    var done = function () {
        $i.removeClass("fa-link").addClass("fa-check");
        setTimeout(function () { $i.removeClass("fa-check").addClass("fa-link"); }, 1500);
    };
    if (navigator.clipboard) {
        navigator.clipboard.writeText(url).then(done);
    } else {
        var t = $("<input>").val(url).appendTo("body").select();
        document.execCommand("copy"); t.remove(); done();
    }
});

$(document).on("submit", ".review-form", function (e) {
    e.preventDefault();
    var $f = $(this), $msg = $f.find(".rf-msg"), $btn = $f.find('[type="submit"]');

    function say(ok, text) {
        $msg.removeClass("ok err").addClass(ok ? "ok" : "err").text(text).show();
    }

    if (!$f.find('[name="rating"]:checked').length) { say(false, "Please select a star rating."); return; }
    if ($.trim($f.find('[name="review"]').val()).length < 10) { say(false, "Please write at least 10 characters."); return; }
    if (($f.find('[name="photos[]"]')[0].files || []).length > 5) { say(false, "You can upload up to 5 photos."); return; }

    $btn.prop("disabled", true);
    $.ajax({
        url: $f.attr("action"),
        method: "POST",
        data: new FormData(this),
        processData: false,
        contentType: false,
        headers: { Accept: "application/json" }
    })
    .done(function (r) {
        say(true, r.message);
        $f[0].reset();
        $f.find(".upload-preview").empty();
        setTimeout(function () { $(".review-pop .close").trigger("click"); }, 2200);
    })
    .fail(function (xhr) {
        var j = xhr.responseJSON || {}, first;
        if (j.errors) first = Object.values(j.errors)[0][0];
        say(false, first || j.message || "Could not submit your review. Please try again.");
        $btn.prop("disabled", false);
    });
});

            apply();
        });
    </script>
@endpush