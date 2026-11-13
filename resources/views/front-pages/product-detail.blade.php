@extends('layouts.app')

@section('title', 'Product Detail')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/sass/detail/detail.css') }}" />
@endpush

@php
    // TEMP static data: replace with controller data ($product, $reviews, $related, $recent)
    $p = fn($sku, $name, $img, $now, $old, $off, $badge = null) => compact('sku', 'name', 'img', 'now', 'old', 'off', 'badge');

    $gallery = [
        ['assets/images/home/cat4.png', 'Handmade Brass Oil Lamp front view'],
        ['assets/images/home/cat1.png', 'Brass decor styled view'],
        ['assets/images/home/cat2.png', 'Lamp with pooja essentials'],
        ['assets/images/home/cat5.png', 'Brass detailing close up'],
        ['assets/images/home/cat6.png', 'Lamp in a pooja corner'],
    ];

    $colors = [
        ['polished-gold', 'Polished Gold', 'Gold', '#d9a93a'],
        ['antique-brass', 'Antique Brass', 'Antique', '#a8782a'],
        ['copper', 'Copper Tone', 'Copper', '#b8704a'],
        ['oxidised-black', 'Oxidised Black', 'Black', '#2a2522'],
        ['silver', 'Silver Tone', 'Silver', '#c9c9c9'],
    ];

    $sizes = [4, 6, 8, 10, 12];

    $coupons = [
        ['fa-tag', 'Welcome Offer', 'Extra 10% off on your first order.', 'PARIJAAT10'],
        ['fa-truck-fast', 'Free Shipping', 'On orders above $149.', 'FREESHIP'],
    ];

    $reviews = [
        [
            'initials' => 'AS', 'name' => 'Anjali S.', 'stars' => 5,
            'title' => 'The detailing is even better in person',
            'text' => 'The lamp feels solid and the finish is lovely. It sits perfectly in our pooja corner and the flame burns steady.',
            'meta' => ['Height: 6 in', 'Finish: Gold', 'As described'],
            'photos' => ['assets/images/home/cat4.png', 'assets/images/home/cat1.png'],
            'date' => 'October 2026', 'helpful' => 12,
        ],
        [
            'initials' => 'RM', 'name' => 'Rohit M.', 'stars' => 5,
            'title' => 'Packed with great care',
            'text' => 'Arrived on time and well protected. The colour matches the photos and it looks great on our festive table.',
            'meta' => ['Height: 8 in', 'Finish: Antique', 'As described'],
            'photos' => ['assets/images/home/cat2.png'],
            'date' => 'October 2026', 'helpful' => 8,
        ],
        [
            'initials' => 'SK', 'name' => 'Sarah K. (USA)', 'stars' => 4,
            'title' => 'Beautiful, a little smaller than I pictured',
            'text' => 'Lovely craftsmanship. Check the height before ordering. Shipping to the US took a few days longer than expected.',
            'meta' => ['Height: 4 in', 'Finish: Copper', 'Smaller than expected'],
            'photos' => [],
            'date' => 'September 2026', 'helpful' => 5,
        ],
        [
            'initials' => 'NK', 'name' => 'Neha K.', 'stars' => 5,
            'title' => 'A gift that was truly loved',
            'text' => 'Bought this as a housewarming gift with the gift packaging. It looked premium and felt like a real heirloom piece.',
            'meta' => ['Height: 6 in', 'Finish: Gold'],
            'photos' => ['assets/images/home/cat5.png', 'assets/images/home/cat6.png'],
            'date' => 'September 2026', 'helpful' => 9,
        ],
    ];

    $reviewTabs = [
        1 => $reviews,
        2 => array_values(array_filter($reviews, fn($r) => !empty($r['photos']))),
        3 => array_values(array_filter($reviews, fn($r) => $r['stars'] === 5)),
    ];

    $related = [
        $p('SKU-P5', 'Brass Lotus Kuber Diya', 'assets/images/home/cat4.png', '$179', '$210', 15, 'Bestseller'),
        $p('SKU-P6', 'Brass Elephant Diya Stand', 'assets/images/home/cat1.png', '$249', '$299', 17),
        $p('SKU-P2', 'Brass Aladdin Incense Burner', 'assets/images/home/cat2.png', '$149', '$179', 17),
        $p('SKU-P7', 'Brass Peacock Diya', 'assets/images/home/cat4.png', '$299', '$359', 17, 'New'),
        $p('SKU-P12', 'Brass Temple Bell', 'assets/images/home/cat6.png', '$159', '$199', 20, 'New'),
        $p('SKU-P2', 'Brass Aladdin Incense Burner', 'assets/images/home/cat2.png', '$149', '$179', 17),
    ];

    $bottle = $p('SKU-P10', 'Copper Water Bottle', 'assets/images/home/cat3.png', '$129', '$155', 17, 'Bestseller');
    $recent = [
        $p('SKU-P4', 'Hammered Copper Goblet', 'assets/images/home/cat3.png', '$99', '$119', 17),
        $bottle,
        $p('SKU-P3', 'Brass Decorative Rabbit Figurine', 'assets/images/home/cat1.png', '$399', '$469', 15, 'Limited Stock'),
        $p('SKU-P9', 'Brass Wind Chime', 'assets/images/home/cat6.png', '$229', '$275', 17),
        $bottle,
        $p('SKU-P8', 'Antique Brass Lock', 'assets/images/home/cat5.png', '$99', '$119', 17, 'New'),
    ];

    $arrowPrev = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M15 5l-7 7 7 7" /></svg>';
    $arrowNext = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M9 5l7 7-7 7" /></svg>';
@endphp

@section('content')
    <main>
        <!-- ============ A : GALLERY + INFO ============ -->
        <section class="detail-secA">
            <div class="container">
                <ul class="crumb">
                    <li><a href="index.html">Home</a></li>
                    <li><i class="fa-solid fa-chevron-right"></i></li>
                    <li><a href="product-listing.html">Shop All Products</a></li>
                    <li><i class="fa-solid fa-chevron-right"></i></li>
                    <li><a href="product-listing.html">Brass Diyas &amp; Lamps</a></li>
                    <li><i class="fa-solid fa-chevron-right"></i></li>
                    <li class="current">Handmade Brass Oil Lamp</li>
                </ul>

                <div class="detail-layout">
                    <!-- GALLERY -->
                    <div class="detail-gallery">
                        <div class="gallery-main">
                            <span class="gallery-tag">Bestseller</span>
                            <button type="button" class="gallery-wish wish-btn" aria-label="Add to wishlist">
                                <i class="fa-regular fa-heart"></i>
                            </button>

                            <div class="swiper detailMain">
                                <div class="swiper-wrapper">
                                    @foreach ($gallery as [$img, $alt])
                                        <div class="swiper-slide">
                                            <a href="{{ asset($img) }}" class="gallery-img glightbox"
                                                data-gallery="product">
                                                <img src="{{ asset($img) }}" alt="{{ $alt }}"
                                                    @if ($loop->first) fetchpriority="high" @else loading="lazy" @endif />
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <span class="gallery-counter">01 / {{ str_pad(count($gallery), 2, '0', STR_PAD_LEFT) }}</span>
                            <div class="g-nav">
                                <button type="button" class="g-prev" aria-label="Previous image">
                                    <i class="fa-solid fa-chevron-left"></i>
                                </button>
                                <button type="button" class="g-next" aria-label="Next image">
                                    <i class="fa-solid fa-chevron-right"></i>
                                </button>
                            </div>
                        </div>

                        <div class="thumb-list">
                            @foreach ($gallery as [$img, $alt])
                                <button type="button" @class(['active' => $loop->first]) aria-label="View image {{ $loop->iteration }}">
                                    <img src="{{ asset($img) }}" alt="" loading="lazy" />
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <!-- INFO -->
                    <div class="detail-info">
                        <div class="info-top">
                            <span class="eyebrow">Brass Diyas &amp; Lamps</span>
                            <span class="info-pill"><i class="fa-solid fa-circle"></i> In Stock</span>
                        </div>
                        <h1>Handmade Brass Oil Lamp</h1>

                        <div class="info-rate">
                            <span class="rate-pill"><i class="fa-solid fa-star"></i> 4.8</span>
                            <a href="#reviews" class="rate-count">124 Reviews</a>
                            <span class="info-sku">SKU: PH-DIYA-0101</span>
                        </div>

                        {{-- PRICE TYPE 1 : SINGLE PRICE (default).
                             BACKEND: product price_type == 'single' -> show this block, remove the range block. --}}
                        <div class="info-price">
                            <span class="price-now">$199</span>
                            <span class="price-old">$249</span>
                            <span class="price-off">20% OFF</span>
                            <p class="price-tax">Inclusive of all taxes. You save $50.</p>
                        </div>

                        {{-- PRICE TYPE 2 : QUANTITY RANGE PRICE (hidden for now).
                             BACKEND: price_type == 'range' -> remove .info-price above and drop the inline display:none.
                             Repeat .range-tier for every range the admin adds. --}}
                        <div class="info-price-range" style="display: none">
                            <div class="range-grid">
                                <div class="range-tier">
                                    <small>2 - 5 Pieces</small>
                                    <div class="range-price"><b>$199</b><del>$249</del></div>
                                </div>
                                <div class="range-tier">
                                    <small>6 - 11 Pieces</small>
                                    <div class="range-price"><b>$179</b><del>$249</del></div>
                                </div>
                                <div class="range-tier">
                                    <small>12+ Pieces</small>
                                    <div class="range-price"><b>$159</b><del>$249</del></div>
                                </div>
                            </div>
                            <p class="price-tax">
                                Price per piece. Inclusive of all taxes. Bulk price applies
                                automatically in your cart.
                            </p>
                        </div>

                        <p class="info-desc">
                            A traditional brass oil lamp, shaped and finished by hand to
                            hold a steady, warm flame. Made for daily pooja, festive
                            evenings and gifting, and handsome enough to stay on display all
                            year.
                        </p>

                        <ul class="info-facts">
                            <li>
                                <i class="fa-solid fa-gem"></i>
                                <div><small>Material</small><b>Solid Brass</b></div>
                            </li>
                            <li>
                                <i class="fa-solid fa-wand-magic-sparkles"></i>
                                <div><small>Finish</small><b>Hand Polished</b></div>
                            </li>
                            <li>
                                <i class="fa-solid fa-hands-praying"></i>
                                <div><small>Best For</small><b>Pooja, Festive, Decor</b></div>
                            </li>
                            <li>
                                <i class="fa-solid fa-location-dot"></i>
                                <div><small>Origin</small><b>Handmade in India</b></div>
                            </li>
                        </ul>

                        <div class="opt-group">
                            <div class="opt-head">
                                <span>Finish</span><b class="opt-value" id="colorName">Polished Gold</b>
                            </div>
                            <div class="opt-swatches">
                                @foreach ($colors as [$val, $name, $short, $hex])
                                    <label class="opt-swatch" title="{{ $name }}">
                                        <input type="radio" name="color" value="{{ $val }}"
                                            data-name="{{ $name }}" @checked($loop->first) />
                                        <span style="--c: {{ $hex }}"></span><em>{{ $short }}</em>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="opt-group">
                            <div class="opt-head">
                                <span>Height</span><b class="opt-value" id="sizeName">6 in</b>
                                <button type="button" class="size-guide" data-model=".size-pop">
                                    <i class="fa-solid fa-ruler"></i> Size Guide
                                </button>
                            </div>
                            <div class="opt-sizes">
                                @foreach ($sizes as $s)
                                    <label class="opt-size">
                                        <input type="radio" name="size" value="{{ $s }}"
                                            @checked($s === 6) @disabled($s === 12) />
                                        <span>{{ $s }} in</span>
                                    </label>
                                @endforeach
                            </div>
                            <p class="opt-note">
                                <i class="fa-solid fa-circle-info"></i> Height is measured in
                                inches. Handmade pieces can vary by a few millimetres.
                            </p>
                        </div>

                        <div class="opt-group">
                            <label class="opt-switch">
                                <input type="checkbox" name="gift_pack" value="yes" />
                                <span class="os-text">Gift Packaging<small>Boxed with a message card</small></span>
                                <strong>+ $9</strong>
                                <span class="os-track"></span>
                            </label>
                        </div>

                        <p class="info-stock">
                            <i class="fa-solid fa-circle"></i><b>Ready to ship</b><em>Only 6 pieces left in Polished
                                Gold</em>
                        </p>

                        <div class="info-actions">
                            <div class="act-top">
                                <div class="qty-box">
                                    <button type="button" class="qty-minus" aria-label="Decrease quantity">
                                        <i class="fa-solid fa-minus"></i>
                                    </button>
                                    <input type="text" class="qty-input" value="1" readonly aria-label="Quantity" />
                                    <button type="button" class="qty-plus" aria-label="Increase quantity">
                                        <i class="fa-solid fa-plus"></i>
                                    </button>
                                </div>
                                <button type="button" class="wish-link">
                                    <i class="fa-regular fa-heart"></i> Add to Wishlist
                                </button>
                            </div>
                            <div class="act-btns">
                                <button type="button" data-id="SKU-P1" data-name="Handmade Brass Oil Lamp"
                                    data-toast-title="Added to Cart"
                                    data-toast-text="Handmade Brass Oil Lamp has been added to your cart."
                                    data-toast-type="success" class="btn btn-outline-black">
                                    Add to Cart
                                </button>
                                <a href="cart.html" class="btn btn-primary">Buy Now</a>
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
                            <form class="pin-form" action="#" method="post">
                                @csrf
                                <input type="text" name="pincode" inputmode="numeric" maxlength="6"
                                    placeholder="Enter your pincode" aria-label="Pincode" />
                                <button type="submit">Check</button>
                            </form>
                            <p class="pin-result">
                                <i class="fa-solid fa-circle-info"></i><span>Ordering from outside India? Delivery time
                                    and charges are shown at checkout.</span>
                            </p>
                            <ul class="del-points">
                                <li><i class="fa-solid fa-truck-fast"></i> Free shipping on orders above $149</li>
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
                                        <svg viewBox="0 0 24 24" width="13" height="13" fill="none"
                                            stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                                            stroke-linejoin="round">
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
                            <div class="help-links">
                                <a href="javascript:void(0)" class="help-link"><i class="fa-brands fa-whatsapp"></i>
                                    WhatsApp</a>
                                <a href="javascript:void(0)" class="help-link"><i class="fa-solid fa-phone"></i> Call
                                    Us</a>
                            </div>
                        </div>

                        <div class="accordion-wrapper">
                            <div class="accordion-item active">
                                <button type="button" class="accordion-header">
                                    <h4>Product Details</h4>
                                    <span class="accordion-icon">+</span>
                                </button>
                                <div class="accordion-content">
                                    <div class="acc-inner">
                                        <ul class="spec-list">
                                            <li><span>Material</span><b>Solid Brass</b></li>
                                            <li><span>Finish</span><b>Hand polished</b></li>
                                            <li><span>Height</span><b>6 in (15 cm)</b></li>
                                            <li><span>Weight</span><b>Approx. 450 g</b></li>
                                            <li><span>Type</span><b>Oil lamp with wick holder</b></li>
                                            <li><span>Fuel</span><b>Ghee, sesame oil or lamp oil</b></li>
                                            <li><span>Occasion</span><b>Daily pooja, Diwali, housewarming, gifting</b>
                                            </li>
                                            <li><span>In the Box</span><b>1 lamp, 2 cotton wicks</b></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <button type="button" class="accordion-header">
                                    <h4>Material &amp; Craft</h4>
                                    <span class="accordion-icon">+</span>
                                </button>
                                <div class="accordion-content">
                                    <div class="acc-inner">
                                        <p>
                                            Brass is cast, shaped and finished by hand, so small
                                            differences in tone and detailing are part of its
                                            character. Over time brass develops a soft patina, and a
                                            light polish brings the shine back.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <button type="button" class="accordion-header">
                                    <h4>Size &amp; Dimensions</h4>
                                    <span class="accordion-icon">+</span>
                                </button>
                                <div class="accordion-content">
                                    <div class="acc-inner">
                                        <ul class="info-points">
                                            <li>Height 6 in, base width approx. 4 in.</li>
                                            <li>Taller heights suit a temple or entrance. Smaller ones suit a shelf or a
                                                gift.</li>
                                            <li>Handmade pieces can differ slightly in size and weight.</li>
                                        </ul>
                                        <button type="button" class="policy-link" data-model=".size-pop">
                                            Open Size Guide <i class="fa-solid fa-arrow-right-long"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <button type="button" class="accordion-header">
                                    <h4>Care Instructions</h4>
                                    <span class="accordion-icon">+</span>
                                </button>
                                <div class="accordion-content">
                                    <div class="acc-inner">
                                        <ul class="info-points">
                                            <li>Let the lamp cool, then wipe with a soft dry cloth.</li>
                                            <li>Clean with lemon and salt or a mild brass polish, rinse and dry well.</li>
                                            <li>Avoid harsh chemicals and abrasive scrubbers.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <button type="button" class="accordion-header">
                                    <h4>Shipping &amp; Delivery</h4>
                                    <span class="accordion-icon">+</span>
                                </button>
                                <div class="accordion-content">
                                    <div class="acc-inner">
                                        <ul class="info-points">
                                            <li>Orders are dispatched within 2–4 working days.</li>
                                            <li>India delivery usually takes 3–7 working days.</li>
                                            <li>International delivery time and charges are shown at checkout.</li>
                                            <li>Import duties or taxes, if any, are set by your country and paid by the
                                                buyer.</li>
                                            <li>A tracking link is shared by email and SMS.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <button type="button" class="accordion-header">
                                    <h4>Returns &amp; Exchange</h4>
                                    <span class="accordion-icon">+</span>
                                </button>
                                <div class="accordion-content">
                                    <div class="acc-inner">
                                        <p>
                                            Unused items in original packaging can be returned or
                                            exchanged within 7 days of delivery. If your piece
                                            arrives damaged, contact us first with a photo and we
                                            will make it right.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- SHARE -->
                        <div class="info-share">
                            <span class="share-label">Share This:</span>
                            <ul class="share-list">
                                <li><a href="javascript:void(0)" aria-label="Share on Facebook"><i
                                            class="fa-brands fa-facebook-f"></i></a></li>
                                <li><a href="javascript:void(0)" aria-label="Share on X"><i
                                            class="fa-brands fa-x-twitter"></i></a></li>
                                <li><a href="javascript:void(0)" aria-label="Share on LinkedIn"><i
                                            class="fa-brands fa-linkedin-in"></i></a></li>
                                <li><a href="javascript:void(0)" aria-label="Share on Pinterest"><i
                                            class="fa-brands fa-pinterest-p"></i></a></li>
                                <li><a href="javascript:void(0)" aria-label="Share on WhatsApp"><i
                                            class="fa-brands fa-whatsapp"></i></a></li>
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
                        <b>4.8</b><span>/ 5</span>
                        <div class="rs-stars">
                            @for ($i = 0; $i < 5; $i++)
                                <i class="fa-solid fa-star"></i>
                            @endfor
                        </div>
                        <p>Based on 124 reviews</p>
                    </div>
                    <ul class="rs-bars">
                        @foreach ([5 => [82, 102], 4 => [12, 15], 3 => [4, 5], 2 => [1, 1], 1 => [1, 1]] as $star => [$pct, $count])
                            <li>
                                <span>{{ $star }} <i class="fa-solid fa-star"></i></span>
                                <div class="bar"><i style="width: {{ $pct }}%"></i></div>
                                <em>{{ $count }}</em>
                            </li>
                        @endforeach
                    </ul>
                    <div class="rs-fit">
                        <h5>How is the quality?</h5>
                        <div class="fit-meter">
                            <i style="width: 78%"></i><i style="width: 14%"></i><i style="width: 8%"></i>
                        </div>
                        <ul class="fit-legend">
                            <li><span></span>As described <em>78%</em></li>
                            <li><span></span>Better than expected <em>14%</em></li>
                            <li><span></span>Smaller than expected <em>8%</em></li>
                        </ul>
                        <button type="button" class="btn btn-primary" data-model=".review-pop">
                            Write a Review
                        </button>
                    </div>
                </div>

                <div class="review-photos">
                    <h5>Customer Photos <span>(38)</span></h5>
                    <div class="rp-grid">
                        @foreach (['cat4', 'cat1', 'cat2', 'cat5', 'cat6'] as $n => $c)
                            <a href="{{ asset("assets/images/home/$c.png") }}" class="rp-item glightbox"
                                data-gallery="customer-photos">
                                <img src="{{ asset("assets/images/home/$c.png") }}" alt="Customer photo {{ $n + 1 }}"
                                    loading="lazy" />
                            </a>
                        @endforeach
                        <a href="{{ asset('assets/images/home/cat3.png') }}" class="rp-item more glightbox"
                            data-gallery="customer-photos">
                            <img src="{{ asset('assets/images/home/cat3.png') }}" alt="More customer photos"
                                loading="lazy" /><span>+33</span>
                        </a>
                    </div>
                </div>

                <div class="review-bar">
                    <ul class="tab-nav">
                        <li class="active" data-tab="1">All (124)</li>
                        <li data-tab="2">With Photos (38)</li>
                        <li data-tab="3">5 Star (102)</li>
                    </ul>
                    <div class="review-sort">
                        <select aria-label="Sort reviews">
                            <option>Most Recent</option>
                            <option>Most Helpful</option>
                            <option>Highest Rating</option>
                            <option>Lowest Rating</option>
                        </select>
                    </div>
                </div>

                <div class="tab-nav-content">
                    @foreach ($reviewTabs as $tabNo => $tabReviews)
                        <div @class(['tabs', 'active' => $tabNo === 1]) data-tab="{{ $tabNo }}">
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
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- ============ D : YOU MAY ALSO LOVE ============ -->
        <section class="detail-secD">
            <div class="container">
                <div class="heading">
                    <small class="eyebrow">Handpicked for You</small>
                    <h3>Complete the Look.</h3>
                    <p>More handcrafted pieces that pair beautifully with your lamp.</p>
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

        <!-- ============ E : STILL ON YOUR MIND ============ -->
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

        <!-- ============ STICKY BUY BAR ============ -->
        <div class="detail-sticky" aria-hidden="true">
            <div class="ds-product">
                <img src="{{ asset('assets/images/home/cat4.png') }}" alt="Handmade Brass Oil Lamp" loading="lazy" />
                <div class="ds-text">
                    <b>Handmade Brass Oil Lamp</b><span><strong>$199</strong><em>20% OFF</em></span>
                </div>
            </div>
            <div class="ds-actions">
                <div class="qty-box">
                    <button type="button" class="qty-minus" aria-label="Decrease quantity">
                        <i class="fa-solid fa-minus"></i>
                    </button>
                    <input type="text" class="qty-input" value="1" readonly aria-label="Quantity" />
                    <button type="button" class="qty-plus" aria-label="Increase quantity">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </div>
                <button type="button" data-id="SKU-P1" data-name="Handmade Brass Oil Lamp"
                    data-toast-title="Added to Cart"
                    data-toast-text="Handmade Brass Oil Lamp has been added to your cart." data-toast-type="success"
                    class="btn btn-outline-black">
                    Add to Cart
                </button>
                <a href="cart.html" class="btn btn-primary">Buy Now</a>
            </div>
        </div>
    </main>

    <!-- ================= Page Models ================= -->
    <div class="model size-pop">
        <button type="button" class="close" aria-label="Close size guide">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                <path d="M5 5l14 14M19 5L5 19" />
            </svg>
        </button>
        <div class="model-body">
            <div class="title">
                <h4>Size &amp; Dimension Guide</h4>
                <p>
                    Approximate dimensions in inches. Exact size is shown on each
                    product page.
                </p>
            </div>
            <div class="size-table-wrap">
                <table class="size-table">
                    <thead>
                        <tr>
                            <th>Size</th>
                            <th>Height</th>
                            <th>Width</th>
                            <th>Weight</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Small</td>
                            <td>3 - 5"</td>
                            <td>2 - 4"</td>
                            <td>0.2 - 0.5 kg</td>
                        </tr>
                        <tr>
                            <td>Medium</td>
                            <td>6 - 9"</td>
                            <td>4 - 6"</td>
                            <td>0.5 - 1.5 kg</td>
                        </tr>
                        <tr>
                            <td>Large</td>
                            <td>10 - 14"</td>
                            <td>6 - 9"</td>
                            <td>1.5 - 4 kg</td>
                        </tr>
                        <tr>
                            <td>X-Large</td>
                            <td>15 - 24"</td>
                            <td>9 - 14"</td>
                            <td>4 kg +</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <ul class="size-tips">
                <li><b>Height:</b> measured from the base to the top of the piece.</li>
                <li><b>Width:</b> measured at the widest part of the product.</li>
                <li><b>Weight:</b> approximate, as each piece is handcrafted.</li>
                <li>Handmade pieces can vary by up to 0.5 inch from the listed size.</li>
                <li>1 inch = 2.54 cm.</li>
            </ul>
        </div>
    </div>

    <div class="model review-pop">
        <button type="button" class="close" aria-label="Close review">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                <path d="M5 5l14 14M19 5L5 19" />
            </svg>
        </button>
        <div class="model-body">
            <div class="title">
                <h4>Write a Review</h4>
                <p>Handmade Brass Oil Lamp</p>
            </div>
            <form class="form review-form" action="#" method="post" enctype="multipart/form-data">
                @csrf
                <div class="rf-rate">
                    <span>Your Rating</span>
                    <div class="rate-input">
                        @foreach ([5, 4, 3, 2, 1] as $n)
                            <input type="radio" name="rating" id="rate{{ $n }}" value="{{ $n }}" />
                            <label for="rate{{ $n }}"
                                aria-label="{{ $n }} {{ $n === 1 ? 'star' : 'stars' }}"><i
                                    class="fa-solid fa-star"></i></label>
                        @endforeach
                    </div>
                </div>
                <div class="form-group">
                    <input type="text" id="rvTitle" name="title" placeholder=" " required />
                    <label for="rvTitle">Review Title</label>
                </div>
                <div class="form-group">
                    <textarea id="rvText" name="review" placeholder=" " required></textarea>
                    <label for="rvText">Your Review</label>
                </div>
                <div class="rf-row">
                    <div class="form-group">
                        <input type="text" id="rvName" name="name" placeholder=" " required />
                        <label for="rvName">Your Name</label>
                    </div>
                    <div class="form-group">
                        <input type="email" id="rvEmail" name="email" placeholder=" " required />
                        <label for="rvEmail">Email Address</label>
                    </div>
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
                <div class="rf-submit">
                    <button type="submit" class="btn btn-primary">Submit Review</button>
                    <p>Your email will not be published. Reviews appear after approval.</p>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            var pad = function(n) {
                return ("0" + n).slice(-2);
            };

            var main = new Swiper(".detailMain", {
                speed: 600,
                navigation: {
                    nextEl: ".g-next",
                    prevEl: ".g-prev"
                },
                pagination: {
                    el: ".gallery-counter",
                    type: "fraction",
                    formatFractionCurrent: pad,
                    formatFractionTotal: pad,
                },
            });

            main.on("slideChange", function() {
                $(".thumb-list button")
                    .removeClass("active")
                    .eq(main.activeIndex)
                    .addClass("active");
            });

            $(".thumb-list button").on("click", function() {
                main.slideTo($(this).index());
            });

            $(".opt-swatch input").on("change", function() {
                $("#colorName").text($(this).data("name"));
            });

            $(".opt-size input").on("change", function() {
                $("#sizeName").text($(this).next().text());
            });

            $(document).on("click", ".qty-plus, .qty-minus", function() {
                var v = parseInt($(this).siblings(".qty-input").val(), 10) || 1;
                v = $(this).hasClass("qty-plus") ?
                    Math.min(10, v + 1) :
                    Math.max(1, v - 1);
                $(".qty-input").val(v);
            });

            var bar = document.querySelector(".detail-sticky");
            var target = document.querySelector(".info-actions");
            if (bar && target) {
                new IntersectionObserver(function(e) {
                    bar.classList.toggle(
                        "show",
                        !e[0].isIntersecting && e[0].boundingClientRect.top < 0,
                    );
                }).observe(target);
            }

            GLightbox({
                selector: ".glightbox",
                touchNavigation: true,
                loop: true,
            });
        });
    </script>
@endpush