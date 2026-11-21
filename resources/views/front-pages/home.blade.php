@extends('layouts.app')

@section('content')

    <main>

        @if($banners->isNotEmpty())
            <section class="home-banner">
                <div class="swiper singleSlider">
                    <div class="swiper-wrapper">
                        @foreach($banners as $banner)
                            <div class="swiper-slide">
                                <div class="slide-content">
                                    <div class="content-inner">
                                        @if($banner->eyebrow)
                                            <span class="hero-eyebrow">{{ $banner->eyebrow }}</span>
                                        @endif
                                        <h1 class="hero-title">{{ $banner->title }}</h1>
                                        @if($banner->description)
                                            <p class="hero-desc">{{ $banner->description }}</p>
                                        @endif
                                        @if($banner->button_text)
                                            <div class="hero-btns">
                                                <a href="{{ $banner->button_link ?: 'javascript:void(0)' }}"
                                                    class="hero-btn">{{ $banner->button_text }}</a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <figure class="slide-img">
                                    <img src="{{ $banner->image_url }}" alt="{{ $banner->image_alt ?: $banner->title }}"
                                        @if(!$loop->first) loading="lazy" @endif />
                                </figure>
                            </div>
                        @endforeach
                    </div>

                    <!-- arrows: visible only on hover -->
                    <button type="button" class="singleSlider-prev" aria-label="Previous slide">
                        <i class="fa-solid fa-chevron-left"></i>
                    </button>
                    <button type="button" class="singleSlider-next" aria-label="Next slide">
                        <i class="fa-solid fa-chevron-right"></i>
                    </button>
                </div>
            </section>
        @endif

        @if($categories->isNotEmpty())
            <section class="home-secA">
                <div class="container">
                    <div class="heading">
                        <h3>Shop by Category</h3>
                        <p>
                            Discover timeless handcrafted brass and copper treasures, made to
                            bring elegance and charm to your home.
                        </p>
                    </div>

                    <div class="swiper-wrap">
                        <div class="swiper fourSlider" data-mob="2" data-sm="3" data-lg="4" data-xl="5">
                            <div class="swiper-wrapper">
                                @foreach($categories as $cat)
                                    <div class="swiper-slide">
                                        <a href="{{ url('category/' . $cat->slug) }}" class="cat_card">
                                            <figure>
                                                <picture>
                                                    <img src="{{ $cat->image ? asset('storage/' . ltrim($cat->image, '/')) : asset('assets/images/home/cat4.png') }}"
                                                        alt="{{ $cat->name }}" loading="lazy" />
                                                </picture>
                                            </figure>
                                            <h2>{{ $cat->name }}</h2>
                                            <span>{{ sprintf('%02d', $cat->products_count) }}
                                                {{ $cat->products_count === 1 ? 'item' : 'items' }}</span>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="swiper-group">
                            <button type="button" class="btn-prev" aria-label="Previous">
                                <i class="fa-solid fa-chevron-left"></i>
                            </button>
                            <button type="button" class="btn-next" aria-label="Next">
                                <i class="fa-solid fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        @if(count($bestTabs))
            <section class="home-secB">
                <div class="container">
                    <div class="heading">
                        <small class="eyebrow">Best Sellers</small>
                        <h3>Our Most-Loved Creations</h3>
                        <p>
                            Handpicked favourites that bring together exceptional
                            craftsmanship and timeless appeal.
                        </p>
                    </div>

                    <ul class="tab-nav">
                        @foreach($bestTabs as $tab)
                            <li data-tab="{{ $loop->iteration }}" @class(['active' => $loop->first])>{{ $tab['label'] }}</li>
                        @endforeach
                    </ul>

                    <div class="tab-nav-content">
                        @foreach($bestTabs as $tab)
                            <div @class(['tabs', 'active' => $loop->first]) data-tab="{{ $loop->iteration }}">
                                <div class="swiper-wrap">
                                    <div class="swiper fourSlider" data-mob="2" data-sm="3" data-lg="4" data-xl="5">
                                        <div class="swiper-wrapper">
                                            @foreach($tab['items'] as $p)
                                                <div class="swiper-slide">
                                                    @include('partials.product-card', ['p' => $p])
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="swiper-group">
                                        <button type="button" class="btn-prev" aria-label="Previous">
                                            <i class="fa-solid fa-chevron-left"></i>
                                        </button>
                                        <button type="button" class="btn-next" aria-label="Next">
                                            <i class="fa-solid fa-chevron-right"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        @if($deal && $dealCard)
            <section class="home-secM">
                <div class="container">
                    <div class="sale-card">
                        <!-- PRODUCT IMAGE (blends into the gradient) -->
                        <figure class="sale-photo">
                            <img src="{{ $dealCard['img'] }}" alt="{{ $dealCard['name'] }}" loading="lazy" />
                        </figure>

                        <!-- LEFT : TEXT -->
                        <div class="sale-text">
                            <h3>{{ $deal->title ?: $dealCard['name'] }}</h3>
                            <p>{{ $deal->text ?: 'Grab it before the deal ends.' }}</p>
                        </div>

                        <!-- CENTER : COUNTDOWN (to the soonest-ending deal) -->
                        <ul class="sale-timer" data-end="{{ $deal->ends_at->toIso8601String() }}">
                            <li><b class="num" data-unit="days">00</b><span class="lbl">DAYS</span></li>
                            <li><b class="num" data-unit="hours">00</b><span class="lbl">HOUR</span></li>
                            <li><b class="num" data-unit="mins">00</b><span class="lbl">MINS</span></li>
                            <li><b class="num" data-unit="secs">00</b><span class="lbl">SECS</span></li>
                        </ul>

                        <!-- RIGHT : CODE + BUTTON -->
                        <div class="sale-action">
                            @if($deal->coupon_code)
                                <button type="button" class="sale-code" data-code="{{ $deal->coupon_code }}"
                                    aria-label="Copy coupon code">
                                    <i class="fa-regular fa-copy"></i>
                                    <span>Use Code: {{ $deal->coupon_code }}</span>
                                </button>
                            @endif
                            <a href="{{ $dealCard['url'] }}" class="btn btn-white">Shop Deal</a>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        @if($spotCategory && $spotProducts->isNotEmpty())
            @php
                $spotUrl = url('category/' . $spotCategory->slug);
                $spotDesc = \Illuminate\Support\Str::limit(trim(strip_tags((string) $spotCategory->description)), 150);
            @endphp
            <section class="home-secG">
                <div class="container">
                    <div class="spot-grid">
                        <!-- LEFT : SPOT MEDIA (overlay card) -->
                        <a href="{{ $spotUrl }}" class="spot-media">
                            <figure class="spot-photo">
                                <picture>
                                    <img src="{{ $spotCategory->image ? asset('storage/' . ltrim($spotCategory->image, '/')) : asset('assets/images/home/cat1.png') }}"
                                        alt="{{ $spotCategory->name }}" loading="lazy" />
                                </picture>
                            </figure>
                            <span class="spot-tag">Featured Collection</span>
                            <div class="spot-info">
                                @if($spotCategory->sub_title)
                                    <small>{{ $spotCategory->sub_title }}</small>
                                @endif
                                <h4>{{ $spotCategory->name }}</h4>
                                @if($spotDesc)
                                    <p>{{ $spotDesc }}</p>
                                @endif
                                <span class="spot-cta">Shop {{ $spotCategory->name }} <i
                                        class="fa-solid fa-arrow-right"></i></span>
                            </div>
                        </a>

                        <!-- RIGHT : CONTENT + SLIDER -->
                        <div class="spot-content">
                            <div class="heading left">
                                <small class="eyebrow">{{ $spotCategory->art_eyebrow ?: 'A CLOSER LOOK' }}</small>
                                <h3>{{ $spotCategory->art_title ?: 'More Than Decor. A Piece of Art.' }}</h3>
                                <p>
                                    {{ $spotCategory->art_text ?: 'Discover the details, craftsmanship and character behind one of our featured creations.' }}
                                </p>
                            </div>

                            <div class="spot-collection">
                                <small>{{ $spotCategory->collection_eyebrow ?: 'Featured Collection' }}</small>
                                <h4>{{ $spotCategory->collection_title ?: $spotCategory->name }}</h4>
                                @if($spotCategory->collection_text ?: $spotDesc)
                                    <p>{{ $spotCategory->collection_text ?: $spotDesc }}</p>
                                @endif
                            </div>

                            <!-- SLIDER -->
                            <div class="swiper-wrap spot-slider">
                                <div class="spot-strip">
                                    <span>PIECES IN THIS COLLECTION</span>
                                </div>

                                <div class="swiper fourSlider" data-mob="3" data-sm="3" data-lg="4" data-xl="5">
                                    <div class="swiper-wrapper">
                                        @foreach($spotProducts as $p)
                                            <div class="swiper-slide">
                                                <a href="{{ $p['url'] }}" class="spot-card">
                                                    <figure>
                                                        <picture>
                                                            <img src="{{ $p['img'] }}" alt="{{ $p['name'] }}" loading="lazy" />
                                                        </picture>
                                                    </figure>
                                                    <h5>{{ $p['name'] }}</h5>
                                                    <span>{{ $p['now'] }}</span>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="swiper-group">
                                    <button type="button" class="btn-prev" aria-label="Previous">
                                        <i class="fa-solid fa-chevron-left"></i>
                                    </button>
                                    <button type="button" class="btn-next" aria-label="Next">
                                        <i class="fa-solid fa-chevron-right"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="spot-btns">
                                <a href="{{ $spotUrl }}" class="btn btn-primary">Explore {{ $spotCategory->name }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        @if($story)
            @php
                $badge = strtoupper($story->badge_text ?: 'Handcrafted in India');
            @endphp
            <section class="home-secC">
                <div class="container">
                    <div class="story-grid">
                        <!-- LEFT : arch image + tilted detail photo + rotating badge -->
                        <div class="story-media">
                            @if($story->main_image_url)
                                <figure class="story-main">
                                    <img src="{{ $story->main_image_url }}" alt="{{ $story->main_image_alt ?: $story->title }}"
                                        loading="lazy" />
                                </figure>
                            @endif

                            @if($story->detail_image_url)
                                <figure class="story-detail">
                                    <img src="{{ $story->detail_image_url }}" alt="{{ $story->detail_image_alt ?: $story->title }}"
                                        loading="lazy" />
                                </figure>
                            @endif

                            <div class="story-badge" aria-hidden="true">
                                <svg viewBox="0 0 120 120">
                                    <defs>
                                        <path id="badgeCircle" d="M60,60 m-46,0 a46,46 0 1,1 92,0 a46,46 0 1,1 -92,0" />
                                    </defs>
                                    <text>
                                        <textPath href="#badgeCircle" textLength="286">
                                            {{ $badge }} • {{ $badge }} •
                                        </textPath>
                                    </text>
                                </svg>
                                <i class="fa-solid fa-gem"></i>
                            </div>
                        </div>

                        <!-- RIGHT : content -->
                        <div class="story-content">
                            <div class="heading left">
                                @if($story->eyebrow)
                                    <small class="eyebrow">{{ $story->eyebrow }}</small>
                                @endif
                                <h3>{{ $story->title }}</h3>
                                @if($story->description)
                                    <p>{{ $story->description }}</p>
                                @endif
                            </div>

                            @if(!empty($story->pillars))
                                <ul class="story-pillars">
                                    @foreach($story->pillars as $pl)
                                        <li>
                                            <div class="pillar-icon">
                                                <i class="{{ $pl['icon'] ?: 'fa-solid fa-gem' }}"></i>
                                            </div>
                                            <h4>{{ $pl['title'] }}</h4>
                                            @if(!empty($pl['text']))
                                                <p>{{ $pl['text'] }}</p>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            @endif

                            @if($story->primary_btn_text || $story->secondary_btn_text)
                                <div class="story-btns">
                                    @if($story->primary_btn_text)
                                        <a href="{{ $story->primary_btn_link ?: 'javascript:void(0)' }}"
                                            class="btn btn-primary">{{ $story->primary_btn_text }}</a>
                                    @endif
                                    @if($story->secondary_btn_text)
                                        <a href="{{ $story->secondary_btn_link ?: 'javascript:void(0)' }}"
                                            class="btn btn-outline-black">{{ $story->secondary_btn_text }}</a>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </section>
        @endif

        @if(count($newTabs))
            <section class="home-secD">
                <div class="container">
                    <div class="heading">
                        <small class="eyebrow">Just Arrived</small>
                        <h3>Fresh Finds, Timeless Craftsmanship.</h3>
                        <p>
                            Discover the latest additions to our handcrafted collection,
                            selected to bring something special to your home.
                        </p>
                    </div>

                    <ul class="tab-nav">
                        @foreach($newTabs as $tab)
                            <li data-tab="{{ $loop->iteration }}" @class(['active' => $loop->first])>{{ $tab['label'] }}</li>
                        @endforeach
                    </ul>

                    <div class="tab-nav-content">
                        @foreach($newTabs as $tab)
                            <div @class(['tabs', 'active' => $loop->first]) data-tab="{{ $loop->iteration }}">
                                <div class="swiper-wrap">
                                    <div class="swiper fourSlider" data-mob="2" data-sm="3" data-lg="4" data-xl="5">
                                        <div class="swiper-wrapper">
                                            @foreach($tab['items'] as $p)
                                                <div class="swiper-slide">
                                                    @include('partials.product-card', ['p' => $p])
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="swiper-group">
                                        <button type="button" class="btn-prev" aria-label="Previous">
                                            <i class="fa-solid fa-chevron-left"></i>
                                        </button>
                                        <button type="button" class="btn-next" aria-label="Next">
                                            <i class="fa-solid fa-chevron-right"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        @php $off = $sections['offers'] ?? null; @endphp
        @if($offerFeature || $homeCoupons->isNotEmpty())
            <section class="home-secE">
                <div class="container">

                    @if($off)
                        <div class="heading">
                            @if($off->eyebrow)
                                <small class="eyebrow">{{ $off->eyebrow }}</small>
                            @endif
                            <h3>{{ $off->title }}</h3>
                            @if($off->description)
                                <p>{{ $off->description }}</p>
                            @endif
                        </div>
                    @endif

                    @if($offerFeature)
                        <div class="offer-cards">
                            <!-- FEATURE (big) : first active card -->
                            <article class="offer-card offer-feature">
                                <figure class="offer-img">
                                    <picture>
                                        <img src="{{ $offerFeature->image_url }}" alt="{{ $offerFeature->title }}" loading="lazy" />
                                    </picture>
                                </figure>
                                @if($offerFeature->badge_big)
                                    <div class="offer-badge">
                                        <strong>{{ $offerFeature->badge_big }}</strong>
                                        @if($offerFeature->badge_small)
                                            <small>{{ $offerFeature->badge_small }}</small>
                                        @endif
                                    </div>
                                @endif
                                <div class="offer-info">
                                    <h4>{{ $offerFeature->title }}</h4>
                                    @if($offerFeature->text)
                                        <p>{{ $offerFeature->text }}</p>
                                    @endif
                                    @if($offerFeature->btn_text)
                                        <a href="{{ $offerFeature->link ?: 'javascript:void(0)' }}" class="btn btn-white">
                                            {{ $offerFeature->btn_text }} <i class="fa-solid fa-arrow-right"></i>
                                        </a>
                                    @endif
                                </div>
                            </article>

                            <!-- SLIDER : remaining cards -->
                            @if($offerSlides->isNotEmpty())
                                <div class="swiper-wrap offer-slider">
                                    <div class="swiper offerSlider">
                                        <div class="swiper-wrapper">
                                            @foreach($offerSlides as $o)
                                                <div class="swiper-slide">
                                                    <a href="{{ $o->link ?: 'javascript:void(0)' }}" class="offer-card">
                                                        <figure class="offer-img">
                                                            <picture>
                                                                <img src="{{ $o->image_url }}" alt="{{ $o->title }}" loading="lazy" />
                                                            </picture>
                                                        </figure>
                                                        @if($o->badge_big)
                                                            <div class="offer-badge">
                                                                <strong>{{ $o->badge_big }}</strong>
                                                                @if($o->badge_small)
                                                                    <small>{{ $o->badge_small }}</small>
                                                                @endif
                                                            </div>
                                                        @endif
                                                        <div class="offer-info">
                                                            <h4>{{ $o->title }}</h4>
                                                            <div class="offer-link">
                                                                <em>Shop Now</em>
                                                                <i class="fa-solid fa-arrow-right"></i>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="swiper-group">
                                        <button type="button" class="btn-prev" aria-label="Previous">
                                            <i class="fa-solid fa-chevron-left"></i>
                                        </button>
                                        <button type="button" class="btn-next" aria-label="Next">
                                            <i class="fa-solid fa-chevron-right"></i>
                                        </button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif

                    <!-- COUPONS : real, available coupons -->
                    @if($homeCoupons->isNotEmpty())
                        <div class="coupon-strip">
                            <div class="strip-head"><span>COUPONS &amp; DEALS</span></div>
                            <div class="coupon-list">
                                @foreach($homeCoupons as $cp)
                                    <div class="coupon-tile">
                                        <div class="coupon-text">
                                            <strong>{{ $cp['code'] }}</strong>
                                            <p>{{ $cp['text'] }}</p>
                                        </div>
                                        <button type="button" class="copy-btn" data-code="{{ $cp['code'] }}">
                                            COPY CODE
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                            <p class="coupon-note">
                                *Terms &amp; conditions apply. Offers valid for a limited time.
                            </p>
                        </div>
                    @endif

                </div>
            </section>
        @endif


        @php $craft = $sections['craft'] ?? null;
        $feat = $sections['craft_feature'] ?? null; @endphp
        @if($craft)
            <section class="home-secF">
                <div class="container">
                    <div class="craft-grid">
                        <!-- LEFT : HEADING + BUTTONS + CHIPS -->
                        <div class="craft-head">
                            <div class="heading left">
                                @if($craft->eyebrow)
                                    <small class="eyebrow">{{ $craft->eyebrow }}</small>
                                @endif
                                <h3>{{ $craft->title }}</h3>
                                @if($craft->description)
                                    <p>{{ $craft->description }}</p>
                                @endif
                            </div>

                            @if($craft->btn1_text || $craft->btn2_text)
                                <div class="craft-btns">
                                    @if($craft->btn1_text)
                                        <a href="{{ $craft->btn1_link ?: 'javascript:void(0)' }}"
                                            class="btn btn-primary">{{ $craft->btn1_text }}</a>
                                    @endif
                                    @if($craft->btn2_text)
                                        <a href="{{ $craft->btn2_link ?: 'javascript:void(0)' }}"
                                            class="btn btn-outline-black">{{ $craft->btn2_text }}</a>
                                    @endif
                                </div>
                            @endif

                            @if($craftChips->isNotEmpty())
                                <ul class="craft-tags">
                                    @foreach($craftChips as $chip)
                                        <li><a href="{{ url('category/' . $chip->slug) }}">{{ $chip->name }}</a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>

                        <!-- RIGHT : WIDE FEATURE -->
                        @if($feat && $feat->image_url)
                            <a href="{{ $feat->btn1_link ?: 'javascript:void(0)' }}" class="craft-feature">
                                <figure class="craft-feature-img">
                                    <picture><img src="{{ $feat->image_url }}" alt="{{ $feat->image_alt ?: $feat->title }}"
                                            loading="lazy" /></picture>
                                </figure>
                                <span class="craft-tag">Featured Collection</span>
                                <div class="craft-feature-info">
                                    @if($feat->eyebrow)
                                        <small>{{ $feat->eyebrow }}</small>
                                    @endif
                                    <h4>{{ $feat->title }}</h4>
                                    @if($feat->description)
                                        <p>{{ $feat->description }}</p>
                                    @endif
                                    @if($feat->btn1_text)
                                        <span class="craft-cta">{{ $feat->btn1_text }} <i class="fa-solid fa-arrow-right"></i></span>
                                    @endif
                                </div>
                            </a>
                        @endif

                        <!-- BOTTOM : SWIPER -->
                        @if($craftCards->isNotEmpty())
                            <div class="swiper-wrap craft-slider">
                                <div class="craft-strip"><span>MORE COLLECTIONS</span></div>

                                <div class="swiper fourSlider" data-mob="2" data-sm="3" data-lg="4" data-xl="5">
                                    <div class="swiper-wrapper">
                                        @foreach($craftCards as $card)
                                            <div class="swiper-slide">
                                                <a href="{{ $card->link ?: 'javascript:void(0)' }}" class="craft-card">
                                                    <figure class="craft-img">
                                                        <picture><img src="{{ $card->image_url }}" alt="{{ $card->title }}"
                                                                loading="lazy" /></picture>
                                                    </figure>
                                                    <span class="craft-no">{{ sprintf('%02d', $loop->iteration) }}</span>
                                                    <div class="craft-body">
                                                        <div class="craft-text">
                                                            <h4>{{ $card->title }}</h4>
                                                            @if($card->text)
                                                                <p>{{ $card->text }}</p>
                                                            @endif
                                                        </div>
                                                        <i class="fa-solid fa-arrow-right"></i>
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="swiper-group">
                                    <button type="button" class="btn-prev" aria-label="Previous">
                                        <i class="fa-solid fa-chevron-left"></i>
                                    </button>
                                    <button type="button" class="btn-next" aria-label="Next">
                                        <i class="fa-solid fa-chevron-right"></i>
                                    </button>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </section>
        @endif

        @php $why = $sections['why'] ?? null; @endphp
        @if($why && $whyCards->isNotEmpty())
            <section class="home-secH">
                <div class="container">
                    <div class="heading">
                        @if($why->eyebrow)
                            <small class="eyebrow">{{ $why->eyebrow }}</small>
                        @endif
                        <h3>{{ $why->title }}</h3>
                        @if($why->description)
                            <p>{{ $why->description }}</p>
                        @endif
                    </div>

                    <div class="swiper-wrap why-slider">
                        <div class="swiper fourSlider" data-mob="1.3" data-sm="2.2" data-lg="4" data-xl="4">
                            <div class="swiper-wrapper">
                                @foreach($whyCards as $item)
                                    <div class="swiper-slide">
                                        <div class="why-item">
                                            <span class="why-icon" aria-hidden="true">
                                                <i class="{{ $item->icon ?: 'fa-solid fa-gem' }}"></i>
                                            </span>
                                            <h4>{{ $item->title }}</h4>
                                            @if($item->text)
                                                <p>{{ $item->text }}</p>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="swiper-group">
                            <button type="button" class="btn-prev" aria-label="Previous">
                                <i class="fa-solid fa-chevron-left"></i>
                            </button>
                            <button type="button" class="btn-next" aria-label="Next">
                                <i class="fa-solid fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        @php $aff = $sections['affiliate'] ?? null; @endphp
        @if($aff)
            <section class="home-secV">
                <div class="container">
                    <div class="aff-card">
                        <!-- IMAGE -->
                        @if($aff->image_url)
                            <figure class="aff-media">
                                <img src="{{ $aff->image_url }}" alt="{{ $aff->image_alt ?: $aff->title }}" loading="lazy" />
                            </figure>
                        @endif

                        <!-- CONTENT -->
                        <div class="aff-content">
                            @if($aff->eyebrow)
                                <small class="eyebrow">{{ $aff->eyebrow }}</small>
                            @endif
                            <h3>{{ $aff->title }}</h3>
                            @if($aff->description)
                                <p>{{ $aff->description }}</p>
                            @endif
                            <div class="aff-btns">
                                <!-- DEV NOTE: If the affiliate system goes live, change the label to "Become an Affiliate". -->
                                @if($aff->btn1_text)
                                    <button type="button" class="btn btn-primary" data-model=".become-pop">
                                        {{ $aff->btn1_text }} <i class="fa-solid fa-arrow-right"></i>
                                    </button>
                                @endif
                                @if($aff->btn2_text)
                                    <a href="{{ $aff->btn2_link ?: 'javascript:void(0)' }}"
                                        class="btn btn-outline-black">{{ $aff->btn2_text }}</a>
                                @endif
                            </div>
                            <!-- DEV NOTE: Do NOT show commission %, referral tracking or payment terms until the client confirms the program is operational. -->
                        </div>

                        <!-- WHY PARTNER -->
                        @if(!empty($aff->lines))
                            @php $affIcons = ['fa-gem', 'fa-handshake', 'fa-seedling']; @endphp
                            <div class="aff-why">
                                <span class="aff-label">Why Partner With Us?</span>
                                <ul class="aff-points">
                                    @foreach($aff->lines as $point)
                                        <li>
                                            <span class="aff-ic"><i
                                                    class="fa-solid {{ $affIcons[$loop->index] ?? 'fa-gem' }}"></i></span>
                                            <b>{{ $point }}</b>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </section>
        @endif

        <section class="home-secQ">
            <div class="container">
                <div class="heading">
                    <small class="eyebrow">AFFILIATE PICKS</small>
                    <h3>Share Our Best Picks. Grow Together.</h3>
                    <p>
                        Choose products at special partner prices, get your own link and share
                        it on WhatsApp, Instagram or your website.
                    </p>
                </div>

                <!-- HOW IT WORKS -->
                <ul class="affp-steps">
                    <li>
                        <span class="affp-num">1</span>
                        <div>
                            <b>Pick Products</b>
                            <small>Choose from partner-price products.</small>
                        </div>
                    </li>
                    <li>
                        <span class="affp-num">2</span>
                        <div>
                            <b>Get Your Link</b>
                            <small>Copy your unique product link.</small>
                        </div>
                    </li>
                    <li>
                        <span class="affp-num">3</span>
                        <div>
                            <b>Share Anywhere</b>
                            <small>Send it to customers and friends.</small>
                        </div>
                    </li>
                </ul>

                <!-- PRODUCT SLIDER : 2 ROWS, 4 PER VIEW -->
                <div class="swiper-wrapper">
                    @foreach($affiliateLinks as $link)
                        <div class="swiper-slide">
                            <article class="affp-tile">
                                <figure>
                                    <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer nofollow sponsored">
                                        @if($link->image_url)
                                            <img src="{{ $link->image_url }}" alt="{{ $link->title ?: $link->host }}"
                                                loading="lazy" />
                                        @endif
                                    </a>
                                </figure>
                                <div class="affp-text">
                                    <h5><a href="{{ $link->url }}" target="_blank"
                                            rel="noopener noreferrer nofollow sponsored">{{ $link->title ?: $link->host }}</a>
                                    </h5>
                                    @if($link->price)
                                        <span class="affp-label">Partner Price</span>
                                        <div class="affp-price">
                                            <b>${{ rtrim(rtrim(number_format($link->price, 2), '0'), '.') }}</b>
                                            @if($link->mrp && $link->mrp > $link->price)
                                                <del>${{ rtrim(rtrim(number_format($link->mrp, 2), '0'), '.') }}</del>
                                            @endif
                                            @if($link->discount_percent)
                                                <em>{{ $link->discount_percent }}% OFF</em>
                                            @endif
                                        </div>
                                    @elseif($link->description)
                                        <span class="affp-label">{{ \Illuminate\Support\Str::limit($link->description, 70) }}</span>
                                    @endif
                                </div>
                                <button type="button" class="affp-btn affp-copy" data-link="{{ $link->url }}"
                                    aria-label="Copy affiliate link" title="Copy link">
                                    <i class="fa-solid fa-link"></i>
                                </button>
                            </article>
                        </div>
                    @endforeach
                </div>

                <div class="affp-cta">
                    <button type="button" class="btn btn-primary" data-model=".become-pop">
                        Become a Partner <i class="fa-solid fa-arrow-right"></i>
                    </button>
                    <p class="affp-note">
                        *Partner prices and links are available after partner approval.
                    </p>
                </div>
                <!-- DEV NOTE: PARTNER_ID in every data-link is a placeholder. Backend should replace it with the logged-in partner's unique ID. Do NOT show commission % until the client confirms. -->
            </div>
        </section>

        @php $rec = $sections['recent'] ?? null; @endphp
        @if($rec && $recent->isNotEmpty())
            <section class="home-secJ">
                <div class="container">
                    <div class="heading">
                        @if($rec->eyebrow)
                            <small class="eyebrow">{{ $rec->eyebrow }}</small>
                        @endif
                        <h3>{{ $rec->title }}</h3>
                        @if($rec->description)
                            <p>{{ $rec->description }}</p>
                        @endif
                    </div>

                    <div class="swiper-wrap">
                        <div class="swiper fourSlider" data-mob="2" data-sm="3" data-lg="4" data-xl="5">
                            <div class="swiper-wrapper">
                                @foreach($recent as $p)
                                    <div class="swiper-slide">
                                        @include('partials.product-card', ['p' => $p])
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="swiper-group">
                            <button type="button" class="btn-prev" aria-label="Previous">
                                <i class="fa-solid fa-chevron-left"></i>
                            </button>
                            <button type="button" class="btn-next" aria-label="Next">
                                <i class="fa-solid fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        @php $mkt = $sections['marketplace'] ?? null; @endphp
        @if($mkt)
            <section class="home-secP">
                <div class="container">
                    <div class="heading">
                        @if($mkt->eyebrow)
                            <small class="eyebrow">{{ $mkt->eyebrow }}</small>
                        @endif
                        <h3>{{ $mkt->title }}</h3>
                        @if($mkt->description)
                            <p>{{ $mkt->description }}</p>
                        @endif
                    </div>

                    <div class="swiper-wrap">
                        <div class="swiper fourSlider" data-mob="1.4" data-sm="2.2" data-lg="4" data-xl="4">
                            <div class="swiper-wrapper">
                                <!-- OFFICIAL STORE (current site, highlighted, first) -->
                                <div class="swiper-slide">
                                    <a href="{{ route('products') }}" class="mp-card mp-official"
                                        aria-label="Continue shopping on Parijaat Handicraft">
                                        <figure class="mp-logo">
                                            <img src="{{ asset('assets/images/logo.png') }}" alt="Parijaat Handicraft"
                                                width="160" height="60" loading="lazy" />
                                        </figure>
                                        <small class="mp-here">You're Shopping Here</small>
                                        <h4>Parijaat Handicraft</h4>
                                        <p>Our official store with exclusive coupons and festive offers.</p>
                                        <span class="mp-link">Continue Shopping <i class="fa-solid fa-arrow-right"></i></span>
                                    </a>
                                </div>

                                @foreach($marketCards as $mp)
                                    <div class="swiper-slide">
                                        <a href="{{ $mp->link ?: 'javascript:void(0)' }}" class="mp-card" @if($mp->link)
                                        target="_blank" rel="noopener noreferrer" @endif
                                            aria-label="Visit our {{ $mp->title }} store">
                                            <figure class="mp-logo">
                                                <img src="{{ $mp->image_url }}" alt="{{ $mp->title }}" width="160" height="60"
                                                    loading="lazy" />
                                            </figure>
                                            <h4>{{ $mp->title }}</h4>
                                            @if($mp->text)
                                                <p>{{ $mp->text }}</p>
                                            @endif
                                            <span class="mp-link">Visit Store <i class="fa-solid fa-arrow-right"></i></span>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="swiper-group">
                            <button type="button" class="btn-prev" aria-label="Previous">
                                <i class="fa-solid fa-chevron-left"></i>
                            </button>
                            <button type="button" class="btn-next" aria-label="Next">
                                <i class="fa-solid fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        @php $rev = $sections['reviews'] ?? null; @endphp
        @if($rev && $homeReviews->isNotEmpty())
            <section class="home-secK">
                <div class="container">
                    <div class="heading">
                        @if($rev->eyebrow)
                            <small class="eyebrow">{{ $rev->eyebrow }}</small>
                        @endif
                        <h3>{{ $rev->title }}</h3>
                        @if($rev->description)
                            <p>{{ $rev->description }}</p>
                        @endif
                    </div>

                    <div class="swiper-wrap">
                        <div class="swiper fourSlider" data-mob="1.15" data-sm="2" data-lg="3" data-xl="3">
                            <div class="swiper-wrapper">
                                @foreach($homeReviews as $r)
                                    <div class="swiper-slide">
                                        <article class="review-card">
                                            <div class="review-head">
                                                <span class="review-quote"><i class="fa-solid fa-quote-left"></i></span>
                                                <div class="review-meta">
                                                    <div class="review-stars" role="img"
                                                        aria-label="{{ $r['stars'] }} out of 5 stars">
                                                        @for($i = 1; $i <= 5; $i++)
                                                            <i class="{{ $i <= $r['stars'] ? 'fa-solid' : 'fa-regular' }} fa-star"></i>
                                                        @endfor
                                                    </div>
                                                    @if($r['verified'])
                                                        <span class="review-verified"><i class="fa-solid fa-circle-check"></i> Verified
                                                            Purchase</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <p class="review-text">{{ $r['text'] }}</p>
                                            <div class="review-user">
                                                <span class="review-avatar">{{ $r['initial'] }}</span>
                                                <div class="review-info">
                                                    <h5>{{ $r['name'] }}</h5>
                                                    @if($r['product'])
                                                        <span>{{ $r['product'] }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="swiper-group">
                            <button type="button" class="btn-prev" aria-label="Previous">
                                <i class="fa-solid fa-chevron-left"></i>
                            </button>
                            <button type="button" class="btn-next" aria-label="Next">
                                <i class="fa-solid fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        @php $reels = $sections['reels'] ?? null; @endphp
        @if($reels && $reelCards->isNotEmpty())
            <section class="home-secN">
                <div class="container">
                    <div class="heading">
                        @if($reels->eyebrow)
                            <small class="eyebrow">{{ $reels->eyebrow }}</small>
                        @endif
                        <h3>{{ $reels->title }}</h3>
                        @if($reels->description)
                            <p>{{ $reels->description }}</p>
                        @endif
                    </div>

                    <div class="swiper-wrap">
                        <div class="swiper fourSlider" data-mob="2" data-sm="3" data-lg="3" data-xl="4">
                            <div class="swiper-wrapper">
                                @foreach($reelCards as $reel)
                                    <div class="swiper-slide">
                                        <article class="reel-card">
                                            <img src="{{ $reel->image_url }}" alt="{{ $reel->title }}" loading="lazy" />
                                            <span class="reel-tag"><i class="fa-brands fa-instagram"></i></span>
                                            <div class="content-wrap">
                                                <div class="reel-text">
                                                    <h4>{{ $reel->title }}</h4>
                                                    @if($reel->text)
                                                        <p>{{ $reel->text }}</p>
                                                    @endif
                                                </div>
                                                @if($reel->video_url)
                                                    <button type="button" class="play-btn" data-video="{{ $reel->video_url }}"
                                                        aria-label="Play video: {{ $reel->title }}"></button>
                                                @endif
                                            </div>
                                        </article>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="swiper-group">
                            <button type="button" class="btn-prev" aria-label="Previous">
                                <i class="fa-solid fa-chevron-left"></i>
                            </button>
                            <button type="button" class="btn-next" aria-label="Next">
                                <i class="fa-solid fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>

                    @if($reels->btn1_text)
                        <div class="sec-cta">
                            <a href="{{ $reels->btn1_link ?: 'javascript:void(0)' }}" class="btn btn-outline-black"
                                @if($reels->btn1_link) target="_blank" rel="noopener noreferrer" @endif>
                                {{ $reels->btn1_text }}
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </a>
                        </div>
                    @endif
                </div>
            </section>
        @endif

    </main>

@endsection

@if($deal && $dealCard)
    @push('scripts')
        <script>
            // when this deal ends, reload once so the server picks the next soonest deal
            (function () {
                var wait = new Date("{{ $deal->ends_at->toIso8601String() }}").getTime() - Date.now() + 1500;
                if (wait > 0 && wait < 2147483647) {
                    setTimeout(function () { location.reload(); }, wait);
                }
            })();
        </script>
    @endpush
@endif