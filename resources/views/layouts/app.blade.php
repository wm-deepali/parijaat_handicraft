<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Home | Parijaat Handicraft</title>
    <!-- ================= Google Fonts ================= -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="" />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&amp;display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/glightbox/3.3.0/css/glightbox.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@23.0.10/build/css/intlTelInput.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- ================= Vendor CSS ================= -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />
    <!-- ================= Project CSS ================= -->
    <link rel="stylesheet" href="{{ asset('assets/font/font.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/sass/header/header.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/sass/footer/footer.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/sass/home/home.css')}}" />
    <!-- ================= Animation / Popup CSS ================= -->
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/css/fancybox.css')}}" />

    @include('layouts.tracking-head')
    @stack('styles')
</head>

<body>

    @include('layouts.tracking-body-top')
    @php
        $authCustomer = auth('customer')->user();
        $wishOn = (bool) ($general->wishlist ?? true);
        $wishCount = $wishOn ? count(\App\Models\Wishlist::currentProductIds()) : 0;
    @endphp

    @if (!empty($seo?->body_scripts))
        {!! $seo->body_scripts !!}
    @endif

    <div class="toaster" id="toaster"></div>

    <header>
        <div class="top_header">
            <div class="container-fluid">
                <div class="top-grid">
                    <div class="top-left">
                        <ul class="social">
                            <li>
                                <a href="javascript:void(0)" aria-label="Facebook"><i
                                        class="fa-brands fa-facebook-f fi"></i></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" aria-label="Instagram"><i
                                        class="fa-brands fa-instagram fi"></i></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" aria-label="YouTube"><i
                                        class="fa-brands fa-youtube fi"></i></a>
                            </li>
                            <li>
                                <a href="https://wa.me/910000000000" target="_blank" rel="noopener"
                                    aria-label="WhatsApp"><i class="fa-brands fa-whatsapp fi"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="announce">
                        <button type="button" class="announcement-prev" aria-label="Previous announcement">
                            <i class="fa-solid fa-chevron-left fi"></i>
                        </button>
                        <div class="swiper announcement-swiper">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <p>Celebrating Indian Craftsmanship</p>
                                </div>
                                <div class="swiper-slide">
                                    <p>Thoughtfully Made, Beautifully Delivered Worldwide</p>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="announcement-next" aria-label="Next announcement">
                            <i class="fa-solid fa-chevron-right fi"></i>
                        </button>
                    </div>
                    <ul class="top-right">
                        <li><a href="{{ route('dashboard') }}#tab-2">Track Your Order</a></li>
                        <li class="hide-lg">
                            <a href="{{ route('contact') }}">Help &amp; Support</a>
                        </li>
                        <li><a href="tel:+910000000000">+91 00000 00000</a></li>
                        @if (($regionOptions ?? collect())->count() > 1)
                            <li class="currency">
                                <form action="{{ route('region.set') }}" method="post">
                                    @csrf
                                    <select name="country" class="currency-select" aria-label="Country and currency"
                                        onchange="this.form.submit()">
                                        @foreach ($regionOptions as $rc)
                                            <option value="{{ $rc->iso2 }}" @selected($regionCurrent && $regionCurrent->id === $rc->id)>
                                                {{ $rc->name }}
                                                ({{ $rc->currency_code }}{{ $rc->currency?->symbol && $rc->currency->symbol !== $rc->currency_code ? ' ' . $rc->currency->symbol : '' }})
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                                <i class="fa-solid fa-chevron-down fi currency-arrow"></i>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>

        <div class="main-bar">
            <div class="container-fluid">
                <div class="main-wrapper">
                    <div class="colA">
                        <a href="{{ route('home') }}" class="logo">
                            <img src="{{ asset('assets/images/logo.png')}}" alt="Parijaat Handicraft"
                                title="Parijaat Handicraft" width="180" height="54" />
                        </a>
                    </div>

                    <div class="search-wrap">
                        <button type="button" class="action-link search-btn" aria-label="Search">
                            <svg class="ic" viewBox="0 0 24 24" aria-hidden="true">
                                <circle cx="11" cy="11" r="7" />
                                <path d="m20 20-3.5-3.5" />
                            </svg>
                        </button>
                        <div class="search-drop formField">
                            <form class="search-form" action="{{ route('products') }}" method="get"
                                data-suggest="{{ route('search.suggest') }}">
                                <input type="text" name="q" class="searchInput" placeholder="Search products..."
                                    autocomplete="off"
                                    value="{{ request()->routeIs('products') ? request('q') : '' }}" />
                                <button type="submit" aria-label="Search">
                                    <svg class="ic" viewBox="0 0 24 24" aria-hidden="true">
                                        <circle cx="11" cy="11" r="7" />
                                        <path d="m20 20-3.5-3.5" />
                                    </svg>
                                </button>
                            </form>

                            <div class="search-results">
                                <p class="sg-title">Products</p>
                                <ul class="res-list"></ul>
                                <p class="res-empty">No products found. Try "brass", "diya" or "copper".</p>
                                <div class="res-all">
                                    <a href="{{ route('products') }}">View All Results</a>
                                </div>
                            </div>

                            <div class="search-default">
                                <p class="sg-title">Popular Searches</p>
                                <ul class="sg-list">
                                    @foreach (array_slice($navMenu['footer'] ?? [], 0, 5) as $cat)
                                        <li><a href="{{ route('category.show', $cat['slug']) }}">{{ $cat['name'] }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="colC">
                        <div class="acc-wrap">
                            <button type="button" class="action-link account-btn" aria-label="My Account"
                                aria-haspopup="true" aria-expanded="false">
                                <svg class="ic" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M20 21v-1a5 5 0 0 0-5-5H9a5 5 0 0 0-5 5v1" />
                                    <circle cx="12" cy="7" r="4" />
                                </svg>
                            </button>
                            <div class="acc-drop">
                                @if ($authCustomer)
                                    <div class="acc-user">
                                        <div class="acc-head">
                                            <span
                                                class="acc-avatar">{{ strtoupper(mb_substr($authCustomer->name, 0, 1)) }}</span>
                                            <div class="acc-meta">
                                                <b>{{ $authCustomer->name }}</b><span>{{ $authCustomer->email }}</span>
                                            </div>
                                        </div>
                                        <ul class="acc-list">
                                            <li><a href="{{ route('dashboard') }}#tab-2"><i
                                                        class="fa-solid fa-truck-fast"></i>Track Order</a></li>
                                            <li><a href="{{ route('dashboard') }}#tab-3"><i
                                                        class="fa-solid fa-box-open"></i>My Orders</a></li>
                                            @if ($wishOn)
                                                <li><a href="{{ route('dashboard') }}#tab-4"><i
                                                            class="fa-regular fa-heart"></i>My Wishlist</a></li>
                                            @endif
                                            <li><a href="{{ route('dashboard') }}#tab-5"><i
                                                        class="fa-regular fa-user"></i>My Profile</a></li>
                                        </ul>
                                        <div class="acc-foot">
                                            <a href="javascript:void(0)" class="acc-out"
                                                onclick="document.getElementById('logoutForm').submit()">
                                                <i class="fa-solid fa-right-from-bracket"></i>Sign Out</a>
                                            <form id="logoutForm" action="{{ route('user.logout') }}" method="post"
                                                style="display:none">@csrf</form>
                                        </div>
                                    </div>
                                @else
                                    <div class="acc-guest">
                                        <h5>Welcome!</h5>
                                        <p>Login to track orders, save your wishlist and check out faster.</p>
                                        <button type="button" class="btn btn-primary" data-model=".login-pop">Login</button>
                                        <button type="button" class="btn btn-outline-primary" data-model=".login-pop"
                                            data-tab-go="register">Create Account</button>
                                    </div>
                                @endif
                            </div>
                        </div>

                        @if ($wishOn)
                            <a href="{{ $authCustomer ? route('dashboard') . '#tab-4' : 'javascript:void(0)' }}" @unless ($authCustomer) data-model=".login-pop" @endunless class="action-link wish-link"
                                aria-label="Wishlist">
                                <span class="ico">
                                    <svg class="ic" viewBox="0 0 24 24" aria-hidden="true">
                                        <path
                                            d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7z" />
                                    </svg>
                                    <span class="count wish-count" data-wish-count>{{ $wishCount }}</span>
                                </span>
                            </a>
                        @endif

                        <button type="button" class="action-link cart-link" data-model=".cart-pop" aria-label="My Cart">
                            <span class="ico">
                                <svg class="ic" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z" />
                                    <path d="M3 6h18" />
                                    <path d="M16 10a4 4 0 0 1-8 0" />
                                </svg>
                                <span class="count cart-count">{{ $miniCart?->items->sum('quantity') ?? 0 }}</span>
                            </span>
                        </button>

                        <button type="button" data-model=".enquiry-pop" class="btn btn-primary bulk-btn">
                            <svg class="ic" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M21 8 12 3 3 8v8l9 5 9-5z" />
                                <path d="m3 8 9 5 9-5" />
                                <path d="M12 13v8" />
                            </svg>
                            Bulk Enquiry
                        </button>

                        <button type="button" class="ham-btn" aria-label="Menu" data-model=".ham-pop">
                            <svg class="ic" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M4 7h16M4 12h16M4 17h16" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="menu-bar">
            <div class="container-fluid">
                <nav class="colB" aria-label="Main navigation">
                    <ul class="menu-list">
                        <li class="active"><a href="{{ route('home') }}">Home</a></li>

                        @if (!empty($navMenu['shop']))
                            <li class="hasMega">
                                <a href="{{ route('products') }}">Shop All <i
                                        class="fa-solid fa-chevron-down fi chev"></i></a>
                                <div class="mega-menu">
                                    <div class="mega-cols">
                                        @foreach ($navMenu['shop'] as $cat)
                                            <div class="mega-col">
                                                <h4><a href="{{ route('category.show', $cat['slug']) }}">{{ $cat['name'] }}</a>
                                                </h4>
                                                @if (!empty($cat['children']))
                                                    <ul>
                                                        @foreach ($cat['children'] as $sub)
                                                            <li>
                                                                <a
                                                                    href="{{ route('category.show', [$cat['slug'], 'sub' => $sub['slug']]) }}">{{ $sub['name'] }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="mega-strip">
                                        <div class="strip-text">
                                            <b>The Beauty of Handcrafted Living</b>
                                            <span>Explore timeless creations inspired by India's rich artistic
                                                heritage.</span>
                                        </div>
                                        <a href="{{ route('products') }}" class="strip-btn">Explore Collection
                                            <i class="fa-solid fa-arrow-right fi"></i></a>
                                    </div>
                                </div>
                            </li>
                        @endif

                        @php $c = $navMenu['collection'] ?? []; @endphp
                        @if (!empty($c['occasions']) || !empty($c['collections']) || !empty($c['attributes']))
                            <li class="hasMega">
                                <a href="{{ route('products') }}">Shop by Collection <i
                                        class="fa-solid fa-chevron-down fi chev"></i></a>
                                <div class="mega-menu">
                                    <div class="mega-cols">

                                        @if (!empty($c['occasions']))
                                            <div class="mega-col">
                                                <h4><a href="{{ route('products') }}">Shop by Occasion</a></h4>
                                                <ul>
                                                    @foreach ($c['occasions'] as $o)
                                                        <li><a
                                                                href="{{ route('products', ['occasion' => [$o['slug']]]) }}">{{ $o['name'] }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        @if (!empty($c['prices']))
                                            <div class="mega-col">
                                                <h4><a href="{{ route('products') }}">Shop by Price</a></h4>
                                                <ul>
                                                    @foreach ($c['prices'] as [$label, $min, $max])
                                                        <li>
                                                            <a
                                                                href="{{ route('products', array_filter(['price_min' => $min, 'price_max' => $max], fn($v) => $v !== null)) }}">{{ $label }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        @if (!empty($c['collections']))
                                            <div class="mega-col">
                                                <h4><a href="{{ route('products') }}">Shop by Collection</a></h4>
                                                <ul>
                                                    @foreach ($c['collections'] as $col)
                                                        <li><a
                                                                href="{{ route('products', ['collection' => [$col['slug']]]) }}">{{ $col['name'] }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        @foreach ($c['attributes'] ?? [] as $attr)
                                            <div class="mega-col">
                                                <h4><a href="{{ route('products') }}">Shop by {{ $attr['name'] }}</a></h4>
                                                <ul>
                                                    @foreach ($attr['values'] as $v)
                                                        <li>
                                                            <a
                                                                href="{{ route('products', ['attr' => [$attr['slug'] => [$v['slug']]]]) }}">{{ $v['name'] }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="mega-strip">
                                        <div class="strip-text">
                                            <b>Curated for Every Moment</b>
                                            <span>Find the perfect handcrafted piece by occasion, budget or material.</span>
                                        </div>
                                        <a href="{{ route('products') }}" class="strip-btn">View All Collections
                                            <i class="fa-solid fa-arrow-right fi"></i></a>
                                    </div>
                                </div>
                            </li>
                        @endif

                        <li><a href="about.html#craft">Our Craft</a></li>
                        <li><a href="{{ route('about') }}">About Us</a></li>
                        <li><a href="{{ route('certifications') }}">Certifications</a></li>
                        <li><a href="{{ route('contact') }}">Contact Us</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    @yield('content')

    <footer>
        <div class="foot-promise">
            <div class="container">
                <ul class="promise-list">
                    <li>
                        <i class="fa-solid fa-truck-fast"></i>
                        <h6>Worldwide Shipping</h6>
                        <p>
                            Every order is carefully packed and safely delivered across
                            India and to customers worldwide.
                        </p>
                    </li>
                    <li>
                        <i class="fa-regular fa-gem"></i>
                        <h6>Authentic Craftsmanship</h6>
                        <p>
                            Each piece is handcrafted with fine detailing, made to last for
                            generations.
                        </p>
                    </li>
                    <li>
                        <i class="fa-regular fa-heart"></i>
                        <h6>Your Happiness, Guaranteed</h6>
                        <p>
                            Easy returns, secure payments and friendly support on every
                            purchase.
                        </p>
                    </li>
                </ul>
            </div>
        </div>

        <div class="foot-news">
            <figure class="news-bg">
                <picture><img src="{{ asset('assets/images/home/contact.png')}}" alt="Handcrafted brass decor"
                        loading="lazy" />
                </picture>
            </figure>
            <div class="container">
                <div class="news-box">
                    <h3>Join our family</h3>
                    <p class="news-lead">
                        Promotions, new products and offers. Directly to your inbox.
                    </p>
                    <form class="form news-form" action="#" method="post">
                        <div class="form-group">
                            <input type="email" id="footNewsEmail" name="email" placeholder=" " required />
                            <label for="footNewsEmail">Your email address</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Subscribe</button>
                    </form>
                    <p class="news-note">
                        Your personal data will be used to support your experience
                        throughout this website, as described in our
                        <a href="privacy-policy.html">Privacy Policy</a>.
                    </p>
                </div>
            </div>
        </div>

        <div class="foot-main">
            <div class="container">
                <div class="foot-links">
                    <div class="foot-col foot-about">
                        <h5>About us</h5>
                        <p>
                            Discover the beauty of Indian craftsmanship with Parijaat
                            Handicraft. Thoughtfully curated decor, traditional accessories
                            and handcrafted treasures for everyday living.
                        </p>
                        <a href="{{ route('about') }}" class="learn-more">Learn more</a>
                        <ul class="foot-contact">
                            <li>
                                <i class="fa-solid fa-location-dot"></i><span>Business address, City, State,
                                    India</span>
                            </li>
                            <li>
                                <i class="fa-solid fa-phone"></i><a href="tel:+910000000000">+91 00000 00000</a>
                            </li>
                            <li>
                                <i class="fa-regular fa-envelope"></i><a
                                    href="mailto:info@parijaathandicraft.com">info@parijaathandicraft.com</a>
                            </li>
                        </ul>
                        <ul class="foot-social">
                            <li>
                                <a href="#" target="_blank" rel="noopener" aria-label="Facebook"><i
                                        class="fa-brands fa-facebook-f"></i></a>
                            </li>
                            <li>
                                <a href="#" target="_blank" rel="noopener" aria-label="Instagram"><i
                                        class="fa-brands fa-instagram"></i></a>
                            </li>
                            <li>
                                <a href="#" target="_blank" rel="noopener" aria-label="YouTube"><i
                                        class="fa-brands fa-youtube"></i></a>
                            </li>
                            <li>
                                <a href="#" target="_blank" rel="noopener" aria-label="Pinterest"><i
                                        class="fa-brands fa-pinterest-p"></i></a>
                            </li>
                        </ul>
                    </div>

                    <div class="foot-col">
                        <h5>Our Company</h5>
                        <ul>
                            <li><a href="{{ route('about') }}">About Us</a></li>
                            <li><a href="about.html#craft">Our Craft</a></li>
                            <li><a href="{{ route('certifications') }}">Certifications</a></li>
                            <li><a href="{{ route('blogs') }}">Blogs</a></li>
                            <li><a href="{{ route('contact') }}">Contact Us</a></li>
                            <li><a href="{{ route('faqs') }}">FAQs</a></li>
                        </ul>
                    </div>

                    <div class="foot-col">
                        <h5>Quick Links</h5>
                        <ul>
                            <li><a href="privacy-policy.html">Privacy Policy</a></li>
                            <li>
                                <a href="terms-conditions.html">Terms &amp; Conditions</a>
                            </li>
                            <li><a href="shipping-policy.html">Shipping Policy</a></li>
                            <li>
                                <a href="returns-exchange.html">Returns &amp; Exchange</a>
                            </li>
                            <li>
                                <a href="refund-cancellation-policy.html">Refund &amp; Cancellation</a>
                            </li>
                            <li><a href="{{ route('dashboard') }}#tab-2">Track Order</a></li>
                            <li><a href="{{ route('dashboard') }}#tab-4">Wishlist</a></li>
                        </ul>
                    </div>

                    <div class="foot-col">
                        <h5>Shop Categories</h5>
                        <ul>
                            @foreach ($navMenu['footer'] ?? [] as $cat)
                                <li><a href="{{ route('category.show', $cat['slug']) }}">{{ $cat['name'] }}</a></li>
                            @endforeach
                            <li><a href="{{ route('products') }}">All Categories</a></li>
                        </ul>
                    </div>

                    <div class="foot-col">
                        <h5>Follow Us</h5>
                        <ul>
                            <li><a href="#" target="_blank" rel="noopener">Facebook</a></li>
                            <li>
                                <a href="#" target="_blank" rel="noopener">Instagram</a>
                            </li>
                            <li><a href="#" target="_blank" rel="noopener">YouTube</a></li>
                            <li>
                                <a href="#" target="_blank" rel="noopener">Pinterest</a>
                            </li>
                            <li>
                                <a href="https://wa.me/910000000000" target="_blank" rel="noopener">WhatsApp</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="foot-bar">
                <div class="container">
                    <div class="bar-grid">
                        <p class="bar-copy">
                            &copy; 2026 Parijaat Handicraft. All Rights Reserved. Design
                            &amp; Developed by
                            <a href="javascript:void(0)" target="_blank" rel="noopener">Web Mingo</a>
                        </p>
                        <ul class="bar-pay" aria-label="Accepted payments">
                            <li><span class="pay-upi">UPI</span></li>
                            <li><i class="fa-brands fa-cc-visa"></i></li>
                            <li><i class="fa-brands fa-cc-mastercard"></i></li>
                            <li><i class="fa-brands fa-google-pay"></i></li>
                            <li><i class="fa-brands fa-cc-paypal"></i></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <nav class="float-menu" aria-label="Quick navigation">
            <a href="{{ route('home') }}" class="float-link active"><i
                    class="fa-solid fa-house"></i><span>Home</span></a>
            <button type="button" class="float-link" data-model=".ham-pop" aria-label="Menu">
                <i class="fa-solid fa-bars"></i><span>Menu</span>
            </button>
            @if ($wishOn)
                <a href="{{ $authCustomer ? route('dashboard') . '#tab-4' : 'javascript:void(0)' }}" @unless ($authCustomer)
                data-model=".login-pop" @endunless class="float-link">
                    <i class="fa-regular fa-heart"></i><span>Wishlist</span><b class="f-count"
                        data-wish-count>{{ $wishCount }}</b></a>
            @endif
            <a href="{{ route('cart') }}" class="float-link"><i class="fa-solid fa-bag-shopping"></i><span>Cart</span><b
                    class="f-count">{{ $miniCart?->items->sum('quantity') ?? 0 }}</b></a>
            <a href="{{ $authCustomer ? route('dashboard') . '#tab-1' : 'javascript:void(0)' }}" @unless ($authCustomer)
            data-model=".login-pop" @endunless class="float-link">
                <i class="fa-regular fa-user"></i><span>Account</span></a>
        </nav>
    </footer>

    <!-- ================= Models ================= -->
    <div class="model enquiry-pop">
        <button class="close" type="button">
            <p>Close</p>
            <svg width="20" height="20" viewBox="0 0 26 26" fill="none">
                <path d="M0.5 0.5L25.5 25.5M0.5 25.5L25.5 0.5" stroke="black" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </button>
        <div class="model-body">
            <div class="pop-title">
                <h3>Get Your Bulk Quote</h3>
                <p>
                    Tell us what you need. We'll reply with pricing and availability
                    within 1–2 business days.
                </p>
            </div>
            <form class="form eq-form" id="enquiryForm" action="#" method="post" enctype="multipart/form-data"
                novalidate>
                <div class="eq-group">
                    <span class="eq-label">Your Details</span>
                    <div class="eq-row">
                        <div class="form-group">
                            <input type="text" id="enqName" name="full_name" placeholder=" " autocomplete="name" />
                            <label for="enqName">Full Name *</label>
                        </div>
                        <div class="form-group">
                            <input type="text" id="enqCompany" name="company" placeholder=" "
                                autocomplete="organization" />
                            <label for="enqCompany">Company Name *</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="email" id="enqEmail" name="email" placeholder=" " autocomplete="email" />
                        <label for="enqEmail">Business Email *</label>
                    </div>
                    <div class="form-group phone-group">
                        <input type="tel" id="enqPhone" name="phone" class="js-phone" placeholder="Phone Number "
                            inputmode="tel" autocomplete="tel" />
                        <input type="hidden" name="phone_full" />
                        <input type="hidden" name="country_code" />
                        <input type="hidden" name="dial_code" />
                    </div>
                </div>
                <div class="eq-group">
                    <span class="eq-label">Your Requirement</span>
                    <div class="eq-row">
                        <div class="form-group">
                            <select id="enqCategory" name="category" required>
                                <option value="" hidden></option>
                                <option>Home Decor</option>
                                <option>Pooja Essentials</option>
                                <option>Kitchen &amp; Dining</option>
                                <option>Metal Handicrafts</option>
                                <option>Gifts &amp; Collections</option>
                                <option>Mixed Order</option>
                            </select>
                            <label for="enqCategory">Product Category *</label>
                        </div>
                        <div class="form-group">
                            <input type="text" id="enqQty" name="quantity" placeholder=" " inputmode="numeric" />
                            <label for="enqQty">Quantity (pcs) *</label>
                        </div>
                    </div>
                    <div class="eq-row">
                        <div class="form-group">
                            <input type="text" id="enqCountry" name="country" placeholder=" "
                                autocomplete="country-name" />
                            <label for="enqCountry">Ship To (Country) *</label>
                        </div>
                        <div class="form-group">
                            <select id="enqFreq" name="frequency" required>
                                <option value="" hidden></option>
                                <option>One-time order</option>
                                <option>Monthly</option>
                                <option>Quarterly</option>
                                <option>Seasonal / Yearly</option>
                            </select>
                            <label for="enqFreq">Order Frequency</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea id="enqMsg" name="message" placeholder=" "></textarea>
                        <label for="enqMsg">Product names / SKUs, size, customization</label>
                    </div>
                    <label class="eq-upload" for="enqFile">
                        <span class="eq-upload-ic">
                            <svg class="ic" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                <path d="m17 8-5-5-5 5" />
                                <path d="M12 3v12" />
                            </svg>
                        </span>
                        <span class="eq-upload-text">
                            <b>Attach reference images or files</b>
                            <small>Optional · JPG, PNG, PDF, DOC · max 10 MB each</small>
                        </span>
                        <input type="file" id="enqFile" name="reference[]"
                            accept=".jpg,.jpeg,.png,.webp,.pdf,.doc,.docx,.xls,.xlsx" multiple />
                    </label>
                </div>
                <div class="eq-foot">
                    <button type="submit" class="btn btn-primary eq-submit">
                        Request Quote
                    </button>
                    <p class="eq-note">
                        Your details are private and used only for this enquiry.
                    </p>
                </div>
            </form>
        </div>
    </div>

    <div class="model become-pop">
        <button class="close" type="button">
            <p>Close</p>
            <svg width="20" height="20" viewBox="0 0 26 26" fill="none">
                <path d="M0.5 0.5L25.5 25.5M0.5 25.5L25.5 0.5" stroke="black" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </button>
        <div class="model-body">
            <div class="pop-title">
                <small class="eyebrow">PARTNERSHIP APPLICATION</small>
                <h3>Apply for Partnership</h3>
                <p>
                    Tell us a little about yourself and our team will get back to you.
                </p>
            </div>
            <form class="form bp-form" id="becomeForm" action="#" method="post" novalidate>
                <div class="bp-group">
                    <div class="bp-row">
                        <div class="form-group">
                            <input type="text" id="bpName" name="full_name" placeholder=" " autocomplete="name" />
                            <label for="bpName">Full Name *</label>
                        </div>
                        <div class="form-group">
                            <input type="email" id="bpEmail" name="email" placeholder=" " autocomplete="email" />
                            <label for="bpEmail">Email Address *</label>
                        </div>
                    </div>
                    <div class="form-group phone-group">
                        <input type="tel" id="bpPhone" name="phone" class="js-phone" placeholder="Phone Number  "
                            inputmode="tel" autocomplete="tel" />
                        <input type="hidden" name="phone_full" />
                        <input type="hidden" name="country_code" />
                        <input type="hidden" name="dial_code" />
                    </div>
                    <div class="form-group">
                        <input type="text" id="bpProfile" name="profile" placeholder=" " />
                        <label for="bpProfile">Website / Social Media Profile *</label>
                    </div>
                    <div class="form-group">
                        <textarea id="bpReason" name="reason" placeholder=" "></textarea>
                        <label for="bpReason">Why would you like to partner with us? *</label>
                    </div>
                </div>
                <div class="bp-foot">
                    <button type="submit" class="btn btn-primary bp-submit">
                        Submit Application
                    </button>
                    <p class="bp-note">We review every application personally.</p>
                </div>
            </form>
            <div class="bp-done">
                <span class="bp-done-ic"><i class="fa-solid fa-check"></i></span>
                <h4>Thank You!</h4>
                <p>
                    Your application has been received. Our team will review it and
                    contact you soon.
                </p>
            </div>
        </div>
    </div>

    <div class="ham-pop">
        <div class="ham-body">
            <div class="ham-top">
                <button type="button" class="ham-back" data-ham-back>
                    <i class="fa-solid fa-arrow-left" aria-hidden="true"></i>
                    <span>Back</span>
                </button>

                <a href="{{ route('home') }}" class="ham-logo">
                    <img src="{{ asset('assets/images/logo.png')}}" alt="Parijaat Handicraft"
                        title="Parijaat Handicraft" />
                </a>

                <button class="close close-btn" type="button" aria-label="Close menu">
                    <i class="fa-solid fa-xmark" aria-hidden="true"></i>
                </button>
            </div>

            @php
                $hamShop = $navMenu['shop'] ?? [];
                $hamC = $navMenu['collection'] ?? [];

                $hamHasCollection = !empty($hamC['occasions']) || !empty($hamC['collections']) || !empty($hamC['attributes']);
            @endphp

            <div class="ham-views">
                {{-- MAIN --}}
                <div class="ham-view is-active" data-ham-view="main" data-ham-title="Menu">
                    <ul class="ham-list">
                        <li class="active"><a href="{{ route('home') }}">Home</a></li>

                        @if (!empty($hamShop))
                            <li>
                                <button type="button" class="ham-link" data-ham-open="shop">
                                    <span class="ham-link-text">Shop All</span>
                                    <span class="ham-arrow"><i class="fa-solid fa-arrow-right"
                                            aria-hidden="true"></i></span>
                                </button>
                            </li>
                        @endif

                        @if ($hamHasCollection)
                            <li>
                                <button type="button" class="ham-link" data-ham-open="collection">
                                    <span class="ham-link-text">Shop by Collection</span>
                                    <span class="ham-arrow"><i class="fa-solid fa-arrow-right"
                                            aria-hidden="true"></i></span>
                                </button>
                            </li>
                        @endif

                        <li><a href="about.html#craft">Our Craft</a></li>
                        <li><a href="{{ route('about') }}">About Us</a></li>
                        <li><a href="{{ route('certifications') }}">Certifications</a></li>
                        <li><a href="{{ route('dashboard') }}#tab-2">Track Order</a></li>
                        <li><a href="{{ route('contact') }}">Help &amp; Support</a></li>
                        <li><a href="{{ route('contact') }}">Contact Us</a></li>
                    </ul>
                </div>

                {{-- SHOP ALL : list of categories --}}
                @if (!empty($hamShop))
                    <div class="ham-view" data-ham-view="shop" data-ham-title="Shop All" aria-hidden="true">
                        <div class="ham-head">
                            <h3 class="ham-title">Shop All</h3>
                            <p class="ham-sub">Handcrafted pieces for every corner of your home.</p>
                        </div>
                        <ul class="ham-list">
                            @foreach ($hamShop as $cat)
                                <li>
                                    @if (!empty($cat['children']))
                                        <button type="button" class="ham-link" data-ham-open="shop-{{ $cat['slug'] }}">
                                            <span class="ham-link-text">{{ $cat['name'] }}</span>
                                            <span class="ham-arrow"><i class="fa-solid fa-arrow-right"
                                                    aria-hidden="true"></i></span>
                                        </button>
                                    @else
                                        <a href="{{ route('category.show', $cat['slug']) }}">{{ $cat['name'] }}</a>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    {{-- one sub view per category --}}
                    @foreach ($hamShop as $cat)
                        @if (!empty($cat['children']))
                            <div class="ham-view" data-ham-view="shop-{{ $cat['slug'] }}" data-ham-title="Shop All"
                                aria-hidden="true">
                                <div class="ham-head">
                                    <h3 class="ham-title">{{ $cat['name'] }}</h3>
                                </div>
                                <ul class="ham-list ham-list--sub">
                                    @foreach ($cat['children'] as $sub)
                                        <li><a
                                                href="{{ route('category.show', [$cat['slug'], 'sub' => $sub['slug']]) }}">{{ $sub['name'] }}</a>
                                        </li>
                                    @endforeach
                                    <li><a href="{{ route('category.show', $cat['slug']) }}">Explore All {{ $cat['name'] }}
                                            &rarr;</a></li>
                                </ul>
                            </div>
                        @endif
                    @endforeach
                @endif

                {{-- SHOP BY COLLECTION --}}
                @if ($hamHasCollection)
                    <div class="ham-view" data-ham-view="collection" data-ham-title="Shop by Collection" aria-hidden="true">
                        <div class="ham-head">
                            <h3 class="ham-title">Shop by Collection</h3>
                            <p class="ham-sub">Find the perfect piece by occasion, budget or material.</p>
                        </div>
                        <ul class="ham-list">
                            @if (!empty($hamC['occasions']))
                                <li>
                                    <button type="button" class="ham-link" data-ham-open="collection-occasion">
                                        <span class="ham-link-text">Shop by Occasion</span>
                                        <span class="ham-arrow"><i class="fa-solid fa-arrow-right"
                                                aria-hidden="true"></i></span>
                                    </button>
                                </li>
                            @endif
                            @if (!empty($hamC['prices']))
                                <li>
                                    <button type="button" class="ham-link" data-ham-open="collection-price">
                                        <span class="ham-link-text">Shop by Price</span>
                                        <span class="ham-arrow"><i class="fa-solid fa-arrow-right"
                                                aria-hidden="true"></i></span>
                                    </button>
                                </li>
                            @endif
                            @if (!empty($hamC['collections']))
                                <li>
                                    <button type="button" class="ham-link" data-ham-open="collection-popularity">
                                        <span class="ham-link-text">Shop by Popularity</span>
                                        <span class="ham-arrow"><i class="fa-solid fa-arrow-right"
                                                aria-hidden="true"></i></span>
                                    </button>
                                </li>
                            @endif
                            @foreach ($hamC['attributes'] ?? [] as $attr)
                                <li>
                                    <button type="button" class="ham-link" data-ham-open="collection-attr-{{ $attr['slug'] }}">
                                        <span class="ham-link-text">Shop by {{ $attr['name'] }}</span>
                                        <span class="ham-arrow"><i class="fa-solid fa-arrow-right"
                                                aria-hidden="true"></i></span>
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    @if (!empty($hamC['occasions']))
                        <div class="ham-view" data-ham-view="collection-occasion" data-ham-title="Shop by Collection"
                            aria-hidden="true">
                            <div class="ham-head">
                                <h3 class="ham-title">Shop by Occasion</h3>
                            </div>
                            <ul class="ham-list ham-list--sub">
                                @foreach ($hamC['occasions'] as $o)
                                    <li><a href="{{ route('products', ['occasion' => [$o['slug']]]) }}">{{ $o['name'] }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (!empty($hamC['prices']))
                        <div class="ham-view" data-ham-view="collection-price" data-ham-title="Shop by Collection"
                            aria-hidden="true">
                            <div class="ham-head">
                                <h3 class="ham-title">Shop by Price</h3>
                            </div>
                            <ul class="ham-list ham-list--sub">
                                @foreach ($hamC['prices'] as [$label, $min, $max])
                                    <li>
                                        <a
                                            href="{{ route('products', array_filter(['price_min' => $min, 'price_max' => $max], fn($v) => $v !== null)) }}">{{ $label }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (!empty($hamC['collections']))
                        <div class="ham-view" data-ham-view="collection-popularity" data-ham-title="Shop by Collection"
                            aria-hidden="true">
                            <div class="ham-head">
                                <h3 class="ham-title">Shop by Popularity</h3>
                            </div>
                            <ul class="ham-list ham-list--sub">
                                @foreach ($hamC['collections'] as $col)
                                    <li><a href="{{ route('products', ['collection' => [$col['slug']]]) }}">{{ $col['name'] }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @foreach ($hamC['attributes'] ?? [] as $attr)
                        <div class="ham-view" data-ham-view="collection-attr-{{ $attr['slug'] }}"
                            data-ham-title="Shop by Collection" aria-hidden="true">
                            <div class="ham-head">
                                <h3 class="ham-title">Shop by {{ $attr['name'] }}</h3>
                            </div>
                            <ul class="ham-list ham-list--sub">
                                @foreach ($attr['values'] as $v)
                                    <li><a
                                            href="{{ route('products', ['attr' => [$attr['slug'] => [$v['slug']]]]) }}">{{ $v['name'] }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                @endif
            </div>

            <div class="ham-bottom">
                <div class="ham-social">
                    <a href="javascript:void(0)" target="_blank" title="Facebook" aria-label="Facebook"><i
                            class="fa-brands fa-facebook-f"></i></a>
                    <a href="javascript:void(0)" target="_blank" title="Instagram" aria-label="Instagram"><i
                            class="fa-brands fa-instagram"></i></a>
                    <a href="javascript:void(0)" target="_blank" title="Pinterest" aria-label="Pinterest"><i
                            class="fa-brands fa-pinterest-p"></i></a>
                    <a href="javascript:void(0)" target="_blank" title="YouTube" aria-label="YouTube"><i
                            class="fa-brands fa-youtube"></i></a>
                    <a href="https://wa.me/910000000000" target="_blank" rel="noopener" title="WhatsApp"
                        aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
                </div>

                <a href="{{ route('products', ['collection' => ['new-arrivals']]) }}"
                    class="btn btn-primary header-cta">
                    <i class="fa-solid fa-bag-shopping" aria-hidden="true"></i>
                    Shop New Arrivals
                </a>
            </div>
        </div>
    </div>

    <div class="model cart-pop">
        <button class="close" type="button">
            <p>Close</p>
            <svg width="20" height="20" viewBox="0 0 26 26" fill="none">
                <path d="M0.5 0.5L25.5 25.5M0.5 25.5L25.5 0.5" stroke="black" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </button>

        <div class="model-body" id="miniCartBody">
            @include('layouts.mini-cart', ['miniCart' => $miniCart])
        </div>
    </div>

    <div class="model login-pop">
        <button class="close" type="button">
            <p>Close</p>
            <svg width="20" height="20" viewBox="0 0 26 26" fill="none">
                <path d="M0.5 0.5L25.5 25.5M0.5 25.5L25.5 0.5" stroke="black" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </button>
        <div class="model-body">
            <a href="{{ route('home') }}" class="pop-logo" aria-label="Parijaat Handicraft Home">
                <img src="{{ asset('assets/images/logo.png')}}" alt="" />
            </a>
            <div class="pop-title">
                <h3>Welcome Back</h3>
                <p>
                    Login or create an account to track your orders, save your wishlist
                    and check out faster.
                </p>
            </div>
            <ul class="tab-nav">
                <li class="active" data-tab="pop-login">Login</li>
                <li data-tab="pop-register">Create Account</li>
            </ul>
            <div class="tab-nav-content">
                <div class="tabs active" data-tab="pop-login">
                    <form class="form pop-form" novalidate>
                        <div class="form-group">
                            <input type="email" id="popLoginEmail" name="email" placeholder=" " autocomplete="email" />
                            <label for="popLoginEmail">Email Address</label>
                        </div>
                        <div class="pop-or"><span>or</span></div>
                        <div class="form-group phone-group">
                            <input type="tel" id="popLoginPhone" name="phone" class="js-phone"
                                placeholder="Phone Number " inputmode="tel" autocomplete="tel" />

                            <input type="hidden" name="phone_full" />
                            <input type="hidden" name="country_code" />
                            <input type="hidden" name="dial_code" />
                        </div>
                        <div class="form-group">
                            <input type="password" id="popLoginPass" name="password" placeholder=" "
                                autocomplete="current-password" />
                            <label for="popLoginPass">Password</label>
                        </div>
                        <div class="pop-meta">
                            <a href="javascript:void(0);">Forgot password?</a>
                        </div>
                        <button type="submit" class="btn btn-primary pop-submit">
                            Login
                        </button>
                    </form>
                    <div class="pop-divider"><span>or</span></div>
                    <button type="button" class="pop-google">
                        <svg width="18" height="18" viewBox="0 0 48 48" aria-hidden="true">
                            <path fill="#EA4335"
                                d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z" />
                            <path fill="#4285F4"
                                d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z" />
                            <path fill="#FBBC05"
                                d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z" />
                            <path fill="#34A853"
                                d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z" />
                        </svg>
                        Continue with Google
                    </button>
                </div>
                <div class="tabs" data-tab="pop-register">
                    <form class="form pop-form" novalidate>
                        <div class="form-group">
                            <input type="text" id="popRegName" name="full_name" placeholder=" " autocomplete="name" />
                            <label for="popRegName">Full Name</label>
                        </div>
                        <div class="form-group">
                            <input type="email" id="popRegEmail" name="email" placeholder=" " autocomplete="email" />
                            <label for="popRegEmail">Email Address</label>
                        </div>
                        <div class="form-group phone-group">
                            <input type="tel" id="popRegPhone" name="phone" class="js-phone" placeholder="Phone Number "
                                inputmode="tel" autocomplete="tel" />
                            <input type="hidden" name="phone_full" />
                            <input type="hidden" name="country_code" />
                            <input type="hidden" name="dial_code" />
                        </div>
                        <div class="form-group">
                            <input type="password" id="popRegPass" name="password" placeholder=" "
                                autocomplete="new-password" />
                            <label for="popRegPass">Create Password</label>
                        </div>
                        <div class="form-group">
                            <input type="password" id="popRegConfirm" name="password_confirmation" placeholder=" "
                                autocomplete="new-password" />
                            <label for="popRegConfirm">Confirm Password</label>
                        </div>
                        <button type="submit" class="btn btn-primary pop-submit">
                            Register Account
                        </button>
                        <p class="pop-note">
                            By continuing, you agree to our
                            <a href="terms-conditions.html">Terms &amp; Conditions</a> and
                            <a href="privacy-policy.html">Privacy Policy</a>.
                        </p>
                    </form>
                    <div class="pop-divider"><span>or</span></div>
                    <button type="button" class="pop-google">
                        <svg width="18" height="18" viewBox="0 0 48 48" aria-hidden="true">
                            <path fill="#EA4335"
                                d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z" />
                            <path fill="#4285F4"
                                d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z" />
                            <path fill="#FBBC05"
                                d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z" />
                            <path fill="#34A853"
                                d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z" />
                        </svg>
                        Continue with Google
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="model offer-pop">
        <div class="model-body">
            <button class="close close-btn" type="button" aria-label="Close offer">
                <i class="fa-solid fa-xmark" aria-hidden="true"></i>
            </button>

            <div class="op-grid">
                <div class="op-visual">
                    <img src="{{ asset('assets/images/home/cat1.png')}}" alt="Welcome to Parijaat Handicraft"
                        loading="lazy" />
                    <span class="op-badge"><b>10%</b> Off First Order</span>
                </div>

                <div class="op-content">
                    <span class="op-eyebrow">Exclusive Offer</span>
                    <h4 class="op-title">Welcome to Parijaat</h4>
                    <p class="op-desc">
                        Enjoy a special welcome benefit on your first order of handcrafted
                        brass decor, pooja essentials and copper drinkware.
                    </p>

                    <div class="op-price">
                        <span class="op-save">Extra 10% Off</span>
                        <span class="op-min">on your first order</span>
                    </div>

                    <div class="op-coupon">
                        <span class="op-label">Use Coupon Code</span>
                        <div class="op-code-box">
                            <span class="op-code">PARIJAAT10</span>
                            <button type="button" class="op-copy coupon-copy" data-code="PARIJAAT10">
                                <span>Copy Code</span>
                            </button>
                        </div>
                    </div>

                    <ul class="op-points">
                        <li>
                            <i class="fa-solid fa-check"></i> Valid on all collections
                        </li>
                        <li>
                            <i class="fa-solid fa-check"></i> Free shipping above Rs. 2,999
                        </li>
                        <li><i class="fa-solid fa-check"></i> Shipping worldwide</li>
                    </ul>

                    <div class="op-btns">
                        <a href="{{ route('products') }}" class="btn btn-primary">
                            Shop Now <i class="fa-solid fa-arrow-right-long"></i>
                        </a>
                        <a href="{{ route('products') }}" class="btn btn-outline-primary">
                            View All Offers
                        </a>
                    </div>

                    <p class="op-note">*Terms &amp; conditions apply.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="model video-pop">
        <div class="model-body">
            <button class="close-video close">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.75 0.75L23.25 23.25M0.75 23.25L23.25 0.75" stroke="black" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </button>

            <iframe id="iframe1" allow="autoplay; fullscreen" src=""></iframe>
        </div>
    </div>

    <div class="overlay"></div>
    <!-- ================= jQuery ================= -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-visible/1.2.0/jquery.visible.min.js"
        integrity="sha512-771ZvVCYr4EfUGXr63AcX7thw7EKa6QE1fhxi8JG7mPacB/arC0cyvYPXKUkCrX2sYKnnFCZby3ZZik42jOuSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.14.0/jquery-ui.min.js"
        integrity="sha512-MlEyuwT6VkRXExjj8CdBKNgd+e2H+aYZOCUaCrt9KRk6MlZDOs91V1yK22rwm8aCIsb5Ec1euL8f0g58RKT/Pg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@23.0.10/build/js/intlTelInput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/glightbox/3.3.0/js/glightbox.min.js"></script>
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

    <!-- ================= Swiper ================= -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.js"></script>

    <!-- ================= Project JS ================= -->
    <script type="text/javascript" src="{{ asset('assets/js/animate.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/fancybox.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/function.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/main.js')}}"></script>
    <script>
        window.APP = {
            cartAdd: "{{ route('cart.add') }}",
            cartQty: "{{ route('cart.update') }}",
            cartRemove: "{{ route('cart.remove', ':id') }}"
        };
    </script>
    <script src="{{ asset('assets/js/cart.js') }}"></script>

    <script>
        (function () {
            var form = document.querySelector('.search-form[data-suggest]');
            if (!form) return;

            var input = form.querySelector('.searchInput');
            var drop = form.closest('.search-drop');
            var results = drop.querySelector('.search-results');
            var list = results.querySelector('.res-list');
            var empty = results.querySelector('.res-empty');
            var all = results.querySelector('.res-all');
            var allLink = all.querySelector('a');
            var def = drop.querySelector('.search-default');
            var endpoint = form.dataset.suggest;

            var timer = null, ctrl = null;

            function esc(s) {
                return String(s == null ? '' : s).replace(/[&<>"']/g, function (c) {
                    return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c];
                });
            }

            function show(mode) {
                // mode: default | results | empty
                def.style.display = mode === 'default' ? '' : 'none';
                results.style.display = mode === 'default' ? 'none' : 'block';
                list.style.display = mode === 'results' ? '' : 'none';
                all.style.display = mode === 'results' ? '' : 'none';
                empty.style.display = mode === 'empty' ? 'block' : 'none';
            }

            function render(data) {
                if (!data.items || !data.items.length) {
                    list.innerHTML = '';
                    show('empty');
                    return;
                }

                list.innerHTML = data.items.map(function (p) {
                    return '<li><a href="' + esc(p.url) + '">' +
                        '<figure><img src="' + esc(p.img) + '" alt="' + esc(p.name) + '" loading="lazy" /></figure>' +
                        '<div class="res-info"><h5>' + esc(p.name) + '</h5>' +
                        '<div class="res-price"><b>' + esc(p.now) + '</b>' +
                        (p.old ? '<del>' + esc(p.old) + '</del>' : '') +
                        '</div></div></a></li>';
                }).join('');

                allLink.href = data.all || allLink.href;
                allLink.textContent = data.total > data.items.length ?
                    'View All ' + data.total + ' Results' : 'View All Results';
                show('results');
            }

            function search() {
                var term = input.value.trim();

                if (term.length < 2) {
                    if (ctrl) ctrl.abort();
                    list.innerHTML = '';
                    show('default');
                    return;
                }

                if (ctrl) ctrl.abort();
                ctrl = new AbortController();

                fetch(endpoint + '?q=' + encodeURIComponent(term), {
                    headers: { 'Accept': 'application/json' },
                    signal: ctrl.signal
                })
                    .then(function (r) { return r.json(); })
                    .then(render)
                    .catch(function (e) { /* aborted or network error: keep current view */ });
            }

            input.addEventListener('input', function () {
                clearTimeout(timer);
                timer = setTimeout(search, 250);
            });

            show('default');
        })();
    </script>

    <script>
        $(function () {
            var AUTH = {
                loggedIn: @json((bool) $authCustomer),
                login: "{{ route('checkout.ajax-login') }}",
                register: "{{ route('checkout.ajax-register') }}",
                google: "{{ route('user.google.login') }}",
                openAuth: @json(session('open_auth'))
            };

            function csrf() { return $('meta[name="csrf-token"]').attr('content'); }
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': csrf(), 'Accept': 'application/json' } });

            function errText(xhr) {
                var j = xhr.responseJSON || {};
                return (j.errors && Object.values(j.errors)[0][0]) || j.message || 'Something went wrong. Please try again.';
            }

            function showError($f, msg) {
                var $e = $f.find('.pop-error');
                if (!$e.length) {
                    $e = $('<p class="pop-error" style="color:#b22222;font-size:13px;margin:8px 0"></p>')
                        .insertBefore($f.find('.pop-submit'));
                }
                $e.text(msg || '').toggle(!!msg);
            }

            // ── login / register from the modal (works on every page) ──
            $(document).on('submit', '.login-pop .pop-form', function (e) {
                e.preventDefault();
                e.stopImmediatePropagation();

                var $f = $(this), $btn = $f.find('.pop-submit');
                if ($btn.data('busy')) return;

                var isReg = $f.closest('.tabs').data('tab') === 'pop-register';
                var data = {};
                $.each($f.serializeArray(), function (_, f) { data[f.name] = f.value; });

                showError($f, '');
                $btn.data('busy', true).prop('disabled', true);

                $.ajax({
                    url: isReg ? AUTH.register : AUTH.login, method: 'POST', dataType: 'json',
                    contentType: 'application/json', data: JSON.stringify(data)
                })
                    .done(function (res) {
                        $btn.data('busy', false).prop('disabled', false);

                        // session was regenerated: use the new CSRF token
                        if (res.csrf_token) {
                            $('meta[name="csrf-token"]').attr('content', res.csrf_token);
                            $('input[name="_token"]').val(res.csrf_token);
                            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': res.csrf_token, 'Accept': 'application/json' } });
                        }
                        AUTH.loggedIn = true;

                        // pages (like payment) can listen, take over, and call e.preventDefault()
                        var ev = $.Event('auth:success');
                        $(document).trigger(ev, [res]);
                        if (!ev.isDefaultPrevented()) window.location.reload();
                    })
                    .fail(function (xhr) {
                        $btn.data('busy', false).prop('disabled', false);
                        showError($f, errText(xhr));
                    });
            });

            // ── Google ──
            $(document).on('click', '.pop-google', function () {
                window.location.href = AUTH.google + '?redirect=' + encodeURIComponent(window.location.href);
            });

            // ── open the modal when the server asks for it (/user/login, /user/register) ──
            if (AUTH.openAuth && !AUTH.loggedIn) {
                setTimeout(function () {
                    $('[data-model=".login-pop"]').first().trigger('click');
                    if (AUTH.openAuth === 'register') {
                        $('.login-pop .tab-nav li[data-tab="pop-register"]').trigger('click');
                    }
                }, 300);
            }
        });
    </script>

    <style>
        .wish-btn.is-wished i,
        .wish-link.is-wished i {
            color: #e0245e;
        }

        .wish-btn.is-busy,
        .wish-link.is-busy {
            pointer-events: none;
            opacity: .6;
        }
    </style>

    <script>
        $(function () {
            var WISH_URL = "{{ route('wishlist.toggle') }}";

            // only real heart buttons (they carry data-id); the header link has no data-id
            var SEL = '.wish-btn[data-id], .wish-link[data-id]';

            function paint(id, added) {
                $(SEL).filter(function () { return String($(this).data('id')) === String(id); }).each(function () {
                    var $b = $(this);
                    $b.toggleClass('is-wished', added).attr('aria-pressed', added ? 'true' : 'false');
                    $b.find('i').toggleClass('fa-solid', added).toggleClass('fa-regular', !added);
                    $b.find('.wl-text').text(added ? 'Added to Wishlist' : 'Add to Wishlist');
                    if ($b.hasClass('wish-btn')) {
                        $b.attr('aria-label', added ? 'Remove from wishlist' : 'Add to wishlist');
                    }
                });
            }

            function notify(type, title, text) {
                var ui = window.cartUI || {};
                if (ui.notify) ui.notify(type, title, text);
            }

            $(document).off('click.wish').on('click.wish', SEL, function (e) {
                var $b = $(this);
                var id = parseInt($b.data('id'), 10);

                if (!id) return;
                e.preventDefault();

                if ($b.hasClass('is-busy')) return;
                $b.addClass('is-busy');

                $.ajax({
                    url: WISH_URL,
                    method: 'POST',
                    dataType: 'json',
                    data: { product_id: id },
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } // fresh token after in-page login
                })
                    .done(function (res) {
                        paint(id, !!res.added);

                        $('[data-wish-count]').text(res.count);

                        if (res.tracking_events && typeof window.runTrackingEvents === 'function') {
                            window.runTrackingEvents(res.tracking_events);
                        }

                        notify('success', res.added ? 'Added to Wishlist' : 'Removed from Wishlist', res.message);
                    })
                    .fail(function (xhr) {
                        var j = xhr.responseJSON || {};
                        notify('error', 'Wishlist', j.message || 'Something went wrong. Please try again.');
                    })
                    .always(function () { $b.removeClass('is-busy'); });
            });
        });
    </script>

    @stack('scripts')
    @include('layouts.tracking-body-bottom')

</body>

</html>