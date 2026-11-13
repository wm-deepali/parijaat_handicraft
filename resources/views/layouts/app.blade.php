<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
                        <li><a href="dashboard.html#tab-2">Track Your Order</a></li>
                        <li class="hide-lg">
                            <a href="contact.html">Help &amp; Support</a>
                        </li>
                        <li><a href="tel:+910000000000">+91 00000 00000</a></li>
                        <li class="currency">
                            <select class="currency-select" aria-label="Currency">
                                <option value="INR" selected>INR ₹</option>
                                <option value="USD">USD $</option>
                                <option value="GBP">GBP £</option>
                                <option value="EUR">EUR €</option>
                            </select>
                            <i class="fa-solid fa-chevron-down fi currency-arrow"></i>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="main-bar">
            <div class="container-fluid">
                <div class="main-wrapper">
                    <div class="colA">
                        <a href="index.html" class="logo">
                            <img src="assets/images/logo.png" alt="Parijaat Handicraft" title="Parijaat Handicraft"
                                width="180" height="54" />
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
                            <form class="search-form" action="javascript:void(0)" method="get">
                                <input type="text" name="q" class="searchInput" placeholder="Search products..."
                                    autocomplete="off" />
                                <button type="submit" aria-label="Search">
                                    <svg class="ic" viewBox="0 0 24 24" aria-hidden="true">
                                        <circle cx="11" cy="11" r="7" />
                                        <path d="m20 20-3.5-3.5" />
                                    </svg>
                                </button>
                            </form>

                            <div class="search-results">
                                <p class="sg-title">Products</p>
                                <ul class="res-list">
                                    <li data-name="handmade brass oil lamp diya lamp pooja">
                                        <a href="product-detail.html">
                                            <figure>
                                                <img src="assets/images/home/cat4.png" alt="Handmade Brass Oil Lamp"
                                                    loading="lazy" />
                                            </figure>
                                            <div class="res-info">
                                                <h5>Handmade Brass Oil Lamp</h5>
                                                <div class="res-price">
                                                    <b>Rs. 1,299</b><del>Rs. 1,599</del>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li data-name="brass aladdin incense burner pooja dhoop">
                                        <a href="product-detail.html">
                                            <figure>
                                                <img src="assets/images/home/cat2.png"
                                                    alt="Brass Aladdin Incense Burner" loading="lazy" />
                                            </figure>
                                            <div class="res-info">
                                                <h5>Brass Aladdin Incense Burner</h5>
                                                <div class="res-price">
                                                    <b>Rs. 899</b><del>Rs. 1,099</del>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li data-name="brass decorative rabbit figurine home decor showpiece gift">
                                        <a href="product-detail.html">
                                            <figure>
                                                <img src="assets/images/home/cat1.png"
                                                    alt="Brass Decorative Rabbit Figurine" loading="lazy" />
                                            </figure>
                                            <div class="res-info">
                                                <h5>Brass Decorative Rabbit Figurine</h5>
                                                <div class="res-price">
                                                    <b>Rs. 2,199</b><del>Rs. 2,599</del>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li data-name="hammered copper goblet copper drinkware kitchen">
                                        <a href="product-detail.html">
                                            <figure>
                                                <img src="assets/images/home/cat3.png" alt="Hammered Copper Goblet"
                                                    loading="lazy" />
                                            </figure>
                                            <div class="res-info">
                                                <h5>Hammered Copper Goblet</h5>
                                                <div class="res-price">
                                                    <b>Rs. 749</b><del>Rs. 899</del>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li data-name="brass lotus kuber diya pooja lamp">
                                        <a href="product-detail.html">
                                            <figure>
                                                <img src="assets/images/home/cat4.png" alt="Brass Lotus Kuber Diya"
                                                    loading="lazy" />
                                            </figure>
                                            <div class="res-info">
                                                <h5>Brass Lotus Kuber Diya</h5>
                                                <div class="res-price">
                                                    <b>Rs. 1,099</b><del>Rs. 1,299</del>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li data-name="brass elephant diya stand pooja">
                                        <a href="product-detail.html">
                                            <figure>
                                                <img src="assets/images/home/cat1.png" alt="Brass Elephant Diya Stand"
                                                    loading="lazy" />
                                            </figure>
                                            <div class="res-info">
                                                <h5>Brass Elephant Diya Stand</h5>
                                                <div class="res-price">
                                                    <b>Rs. 1,499</b><del>Rs. 1,799</del>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li data-name="brass peacock diya pooja lamp">
                                        <a href="product-detail.html">
                                            <figure>
                                                <img src="assets/images/home/cat4.png" alt="Brass Peacock Diya"
                                                    loading="lazy" />
                                            </figure>
                                            <div class="res-info">
                                                <h5>Brass Peacock Diya</h5>
                                                <div class="res-price">
                                                    <b>Rs. 1,899</b><del>Rs. 2,299</del>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li data-name="antique brass lock key decor">
                                        <a href="product-detail.html">
                                            <figure>
                                                <img src="assets/images/home/cat5.png" alt="Antique Brass Lock"
                                                    loading="lazy" />
                                            </figure>
                                            <div class="res-info">
                                                <h5>Antique Brass Lock</h5>
                                                <div class="res-price">
                                                    <b>Rs. 749</b><del>Rs. 899</del>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li data-name="brass wind chime bells chimes home decor">
                                        <a href="product-detail.html">
                                            <figure>
                                                <img src="assets/images/home/cat6.png" alt="Brass Wind Chime"
                                                    loading="lazy" />
                                            </figure>
                                            <div class="res-info">
                                                <h5>Brass Wind Chime</h5>
                                                <div class="res-price">
                                                    <b>Rs. 1,499</b><del>Rs. 1,799</del>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li data-name="brass temple bell pooja bells">
                                        <a href="product-detail.html">
                                            <figure>
                                                <img src="assets/images/home/cat6.png" alt="Brass Temple Bell"
                                                    loading="lazy" />
                                            </figure>
                                            <div class="res-info">
                                                <h5>Brass Temple Bell</h5>
                                                <div class="res-price">
                                                    <b>Rs. 1,199</b><del>Rs. 1,499</del>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li data-name="copper water bottle copper drinkware kitchen">
                                        <a href="product-detail.html">
                                            <figure>
                                                <img src="assets/images/home/cat3.png" alt="Copper Water Bottle"
                                                    loading="lazy" />
                                            </figure>
                                            <div class="res-info">
                                                <h5>Copper Water Bottle</h5>
                                                <div class="res-price">
                                                    <b>Rs. 999</b><del>Rs. 1,199</del>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li data-name="copper serving bowl copper kitchen dining tableware">
                                        <a href="product-detail.html">
                                            <figure>
                                                <img src="assets/images/home/cat3.png" alt="Copper Serving Bowl"
                                                    loading="lazy" />
                                            </figure>
                                            <div class="res-info">
                                                <h5>Copper Serving Bowl</h5>
                                                <div class="res-price">
                                                    <b>Rs. 1,149</b><del>Rs. 1,399</del>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li data-name="copper jug with tumblers copper drinkware kitchen gift">
                                        <a href="product-detail.html">
                                            <figure>
                                                <img src="assets/images/home/cat3.png" alt="Copper Jug with Tumblers"
                                                    loading="lazy" />
                                            </figure>
                                            <div class="res-info">
                                                <h5>Copper Jug with Tumblers</h5>
                                                <div class="res-price">
                                                    <b>Rs. 2,499</b><del>Rs. 2,999</del>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li data-name="hammered copper tumbler copper drinkware kitchen">
                                        <a href="product-detail.html">
                                            <figure>
                                                <img src="assets/images/home/cat3.png" alt="Hammered Copper Tumbler"
                                                    loading="lazy" />
                                            </figure>
                                            <div class="res-info">
                                                <h5>Hammered Copper Tumbler</h5>
                                                <div class="res-price">
                                                    <b>Rs. 549</b><del>Rs. 699</del>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li data-name="brass elephant figurine home decor sculpture gift">
                                        <a href="product-detail.html">
                                            <figure>
                                                <img src="assets/images/home/cat1.png" alt="Brass Elephant Figurine"
                                                    loading="lazy" />
                                            </figure>
                                            <div class="res-info">
                                                <h5>Brass Elephant Figurine</h5>
                                                <div class="res-price">
                                                    <b>Rs. 2,499</b><del>Rs. 2,999</del>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li data-name="copper goblet gift set gift copper">
                                        <a href="product-detail.html">
                                            <figure>
                                                <img src="assets/images/home/cat3.png" alt="Copper Goblet Gift Set"
                                                    loading="lazy" />
                                            </figure>
                                            <div class="res-info">
                                                <h5>Copper Goblet Gift Set</h5>
                                                <div class="res-price">
                                                    <b>Rs. 2,799</b><del>Rs. 3,299</del>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                                <p class="res-empty">
                                    No products found. Try "brass", "diya" or "copper".
                                </p>
                                <div class="res-all">
                                    <a href="product-listing.html">View All Results</a>
                                </div>
                            </div>

                            <div class="search-default">
                                <p class="sg-title">Popular Searches</p>
                                <ul class="sg-list">
                                    <li>
                                        <a href="product-listing.html">Brass Decorative Items</a>
                                    </li>
                                    <li><a href="product-listing.html">Pooja Essentials</a></li>
                                    <li><a href="product-listing.html">Home Decor</a></li>
                                    <li>
                                        <a href="product-listing.html">Kitchen &amp; Dining</a>
                                    </li>
                                    <li>
                                        <a href="product-listing.html">Handcrafted Gifts</a>
                                    </li>
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
                                <div class="acc-user">
                                    <div class="acc-head">
                                        <span class="acc-avatar">A</span>
                                        <div class="acc-meta">
                                            <b>Aarav Mehta</b><span>aarav@example.com</span>
                                        </div>
                                    </div>
                                    <ul class="acc-list">
                                        <li>
                                            <a href="dashboard.html#tab-2"><i class="fa-solid fa-truck-fast"></i>Track
                                                Order</a>
                                        </li>
                                        <li>
                                            <a href="dashboard.html#tab-2"><i class="fa-solid fa-box-open"></i>My
                                                Orders</a>
                                        </li>
                                        <li>
                                            <a href="dashboard.html#tab-4"><i class="fa-regular fa-heart"></i>My
                                                Wishlist</a>
                                        </li>
                                        <li>
                                            <a href="dashboard.html#tab-1"><i class="fa-regular fa-user"></i>My
                                                Profile</a>
                                        </li>
                                    </ul>
                                    <div class="acc-foot">
                                        <a href="javascript:void(0)" class="acc-out"><i
                                                class="fa-solid fa-right-from-bracket"></i>Sign
                                            Out</a>
                                    </div>
                                </div>
                                <div class="acc-guest" hidden>
                                    <h5>Welcome!</h5>
                                    <p>
                                        Login to track orders, save your wishlist and check out
                                        faster.
                                    </p>
                                    <button type="button" class="btn btn-primary" data-model=".login-pop">
                                        Login
                                    </button>
                                    <button type="button" class="btn btn-outline-primary" data-model=".login-pop"
                                        data-tab-go="register">
                                        Create Account
                                    </button>
                                </div>
                            </div>
                        </div>

                        <a href="javascript:void()" data-model=".login-pop" class="action-link wish-link"
                            aria-label="Wishlist">
                            <span class="ico">
                                <svg class="ic" viewBox="0 0 24 24" aria-hidden="true">
                                    <path
                                        d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7z" />
                                </svg>
                                <span class="count wish-count">0</span>
                            </span>
                        </a>

                        <button type="button" class="action-link cart-link" data-model=".cart-pop" aria-label="My Cart">
                            <span class="ico">
                                <svg class="ic" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z" />
                                    <path d="M3 6h18" />
                                    <path d="M16 10a4 4 0 0 1-8 0" />
                                </svg>
                                <span class="count cart-count">0</span>
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
                        <li class="active"><a href="index.html">Home</a></li>

                        <li class="hasMega">
                            <a href="all-categories-listing.html">Shop All <i
                                    class="fa-solid fa-chevron-down fi chev"></i></a>
                            <div class="mega-menu">
                                <div class="mega-cols">
                                    <div class="mega-col">
                                        <h4><a href="product-listing.html">Home Decor</a></h4>
                                        <ul>
                                            <li>
                                                <a href="product-listing.html">Decorative Showpieces</a>
                                            </li>
                                            <li><a href="product-listing.html">Wall Decor</a></li>
                                            <li><a href="product-listing.html">Table Decor</a></li>
                                            <li>
                                                <a href="product-listing.html">Decorative Bowls</a>
                                            </li>
                                            <li><a href="product-listing.html">Sculptures</a></li>
                                        </ul>
                                    </div>
                                    <div class="mega-col">
                                        <h4>
                                            <a href="product-listing.html">Pooja Essentials</a>
                                        </h4>
                                        <ul>
                                            <li><a href="product-listing.html">Brass Diyas</a></li>
                                            <li><a href="product-listing.html">Pooja Thali</a></li>
                                            <li>
                                                <a href="product-listing.html">Pooja Accessories</a>
                                            </li>
                                            <li>
                                                <a href="product-listing.html">Traditional Decor</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="mega-col">
                                        <h4>
                                            <a href="product-listing.html">Kitchen &amp; Dining</a>
                                        </h4>
                                        <ul>
                                            <li><a href="product-listing.html">Dinner Sets</a></li>
                                            <li>
                                                <a href="product-listing.html">Brass Utensils</a>
                                            </li>
                                            <li>
                                                <a href="product-listing.html">Serving Accessories</a>
                                            </li>
                                            <li><a href="product-listing.html">Tableware</a></li>
                                        </ul>
                                    </div>
                                    <div class="mega-col">
                                        <h4>
                                            <a href="product-listing.html">Metal Handicrafts</a>
                                        </h4>
                                        <ul>
                                            <li>
                                                <a href="product-listing.html">Brass Handicrafts</a>
                                            </li>
                                            <li>
                                                <a href="product-listing.html">Copper Products</a>
                                            </li>
                                            <li>
                                                <a href="product-listing.html">Traditional Metal Art</a>
                                            </li>
                                            <li>
                                                <a href="product-listing.html">Decorative Metal Items</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="mega-col">
                                        <h4>
                                            <a href="product-listing.html">Gifts &amp; Collections</a>
                                        </h4>
                                        <ul>
                                            <li>
                                                <a href="product-listing.html">Traditional Gifts</a>
                                            </li>
                                            <li>
                                                <a href="product-listing.html">Festive Gifts</a>
                                            </li>
                                            <li>
                                                <a href="product-listing.html">Decorative Gifts</a>
                                            </li>
                                            <li>
                                                <a href="product-listing.html">Special Collections</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="mega-strip">
                                    <div class="strip-text">
                                        <b>The Beauty of Handcrafted Living</b>
                                        <span>Explore timeless creations inspired by India's rich
                                            artistic heritage.</span>
                                    </div>
                                    <a href="all-categories-listing.html" class="strip-btn">Explore Collection
                                        <i class="fa-solid fa-arrow-right fi"></i></a>
                                </div>
                            </div>
                        </li>

                        <li class="hasMega">
                            <a href="product-listing.html">Shop by Collection
                                <i class="fa-solid fa-chevron-down fi chev"></i></a>
                            <div class="mega-menu">
                                <div class="mega-cols">
                                    <div class="mega-col">
                                        <h4>
                                            <a href="product-listing.html">Shop by Occasion</a>
                                        </h4>
                                        <ul>
                                            <li>
                                                <a href="product-listing.html">Diwali &amp; Festive</a>
                                            </li>
                                            <li><a href="product-listing.html">Housewarming</a></li>
                                            <li>
                                                <a href="product-listing.html">Wedding Gifting</a>
                                            </li>
                                            <li>
                                                <a href="product-listing.html">Corporate Gifting</a>
                                            </li>
                                            <li>
                                                <a href="product-listing.html">Anniversary &amp; Birthday</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="mega-col">
                                        <h4><a href="product-listing.html">Shop by Price</a></h4>
                                        <ul>
                                            <li><a href="product-listing.html">Under ₹999</a></li>
                                            <li>
                                                <a href="product-listing.html">₹1,000 – ₹2,999</a>
                                            </li>
                                            <li>
                                                <a href="product-listing.html">₹3,000 – ₹5,999</a>
                                            </li>
                                            <li>
                                                <a href="product-listing.html">₹6,000 &amp; Above</a>
                                            </li>
                                            <li><a href="product-listing.html">Luxury Edit</a></li>
                                        </ul>
                                    </div>
                                    <div class="mega-col">
                                        <h4>
                                            <a href="product-listing.html">Shop by Popularity</a>
                                        </h4>
                                        <ul>
                                            <li><a href="product-listing.html">Best Sellers</a></li>
                                            <li><a href="product-listing.html">New Arrivals</a></li>
                                            <li><a href="product-listing.html">Most Loved</a></li>
                                            <li><a href="product-listing.html">Trending Now</a></li>
                                            <li>
                                                <a href="product-listing.html">Customer Favourites</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="mega-col">
                                        <h4>
                                            <a href="product-listing.html">Shop by Material</a>
                                        </h4>
                                        <ul>
                                            <li><a href="product-listing.html">Pure Brass</a></li>
                                            <li><a href="product-listing.html">Copper</a></li>
                                            <li>
                                                <a href="product-listing.html">Bronze &amp; Bell Metal</a>
                                            </li>
                                            <li>
                                                <a href="product-listing.html">Wood &amp; Metal Blend</a>
                                            </li>
                                            <li>
                                                <a href="product-listing.html">Antique Finish</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="mega-col">
                                        <h4><a href="product-listing.html">Shop by Space</a></h4>
                                        <ul>
                                            <li><a href="product-listing.html">Living Room</a></li>
                                            <li><a href="product-listing.html">Pooja Room</a></li>
                                            <li>
                                                <a href="product-listing.html">Kitchen &amp; Dining</a>
                                            </li>
                                            <li>
                                                <a href="product-listing.html">Entrance &amp; Foyer</a>
                                            </li>
                                            <li>
                                                <a href="product-listing.html">Garden &amp; Outdoor</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="mega-strip">
                                    <div class="strip-text">
                                        <b>Curated for Every Moment</b>
                                        <span>Find the perfect handcrafted piece by occasion, budget
                                            or space.</span>
                                    </div>
                                    <a href="all-categories-listing.html" class="strip-btn">View All Collections
                                        <i class="fa-solid fa-arrow-right fi"></i></a>
                                </div>
                            </div>
                        </li>

                        <li><a href="about.html#craft">Our Craft</a></li>
                        <li><a href="about.html">About Us</a></li>
                        <li><a href="certifications.html">Certifications</a></li>
                        <li><a href="contact.html">Contact Us</a></li>
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
                <picture><img src="assets/images/home/contact.png" alt="Handcrafted brass decor" loading="lazy" />
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
                        <a href="about.html" class="learn-more">Learn more</a>
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
                            <li><a href="about.html">About Us</a></li>
                            <li><a href="about.html#craft">Our Craft</a></li>
                            <li><a href="certifications.html">Certifications</a></li>
                            <li><a href="blogs.html">Blogs</a></li>
                            <li><a href="contact.html">Contact Us</a></li>
                            <li><a href="faqs.html">FAQs</a></li>
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
                            <li><a href="dashboard.html#tab-2">Track Order</a></li>
                            <li><a href="dashboard.html#tab-4">Wishlist</a></li>
                        </ul>
                    </div>

                    <div class="foot-col">
                        <h5>Shop Categories</h5>
                        <ul>
                            <li><a href="product-listing.html">Home Decor</a></li>
                            <li><a href="product-listing.html">Pooja Essentials</a></li>
                            <li><a href="product-listing.html">Kitchen &amp; Dining</a></li>
                            <li><a href="product-listing.html">Metal Handicrafts</a></li>
                            <li>
                                <a href="product-listing.html">Gifts &amp; Collections</a>
                            </li>
                            <li>
                                <a href="all-categories-listing.html">All Categories</a>
                            </li>
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
            <a href="index.html" class="float-link active"><i class="fa-solid fa-house"></i><span>Home</span></a>
            <button type="button" class="float-link" data-model=".ham-pop" aria-label="Menu">
                <i class="fa-solid fa-bars"></i><span>Menu</span>
            </button>
            <a href="javascript:void()" data-model=".login-pop" class="float-link"><i
                    class="fa-regular fa-heart"></i><span>Wishlist</span><b class="f-count">0</b></a>
            <a href="cart.html" class="float-link"><i class="fa-solid fa-bag-shopping"></i><span>Cart</span><b
                    class="f-count">0</b></a>
            <a href="dashboard.html#tab-1" class="float-link"><i class="fa-regular fa-user"></i><span>Account</span></a>
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

                <a href="index.html" class="ham-logo">
                    <img src="assets/images/logo.png" alt="Parijaat Handicraft" title="Parijaat Handicraft" />
                </a>

                <button class="close close-btn" type="button" aria-label="Close menu">
                    <i class="fa-solid fa-xmark" aria-hidden="true"></i>
                </button>
            </div>

            <div class="ham-views">
                <div class="ham-view is-active" data-ham-view="main" data-ham-title="Menu">
                    <ul class="ham-list">
                        <li class="active"><a href="index.html">Home</a></li>
                        <li>
                            <button type="button" class="ham-link" data-ham-open="shop">
                                <span class="ham-link-text">Shop All</span>
                                <span class="ham-arrow"><i class="fa-solid fa-arrow-right"
                                        aria-hidden="true"></i></span>
                            </button>
                        </li>
                        <li>
                            <button type="button" class="ham-link" data-ham-open="collection">
                                <span class="ham-link-text">Shop by Collection</span>
                                <span class="ham-arrow"><i class="fa-solid fa-arrow-right"
                                        aria-hidden="true"></i></span>
                            </button>
                        </li>
                        <li><a href="about.html#craft">Our Craft</a></li>
                        <li><a href="about.html">About Us</a></li>
                        <li><a href="certifications.html">Certifications</a></li>
                        <li><a href="dashboard.html#tab-2">Track Order</a></li>
                        <li><a href="contact.html">Help &amp; Support</a></li>
                        <li><a href="contact.html">Contact Us</a></li>
                    </ul>
                </div>

                <div class="ham-view" data-ham-view="shop" data-ham-title="Shop All" aria-hidden="true">
                    <div class="ham-head">
                        <h3 class="ham-title">Shop All</h3>
                        <p class="ham-sub">
                            Handcrafted pieces for every corner of your home.
                        </p>
                    </div>
                    <ul class="ham-list">
                        <li>
                            <button type="button" class="ham-link" data-ham-open="shop-decor">
                                <span class="ham-link-text">Home Decor</span>
                                <span class="ham-arrow"><i class="fa-solid fa-arrow-right"
                                        aria-hidden="true"></i></span>
                            </button>
                        </li>
                        <li>
                            <button type="button" class="ham-link" data-ham-open="shop-pooja">
                                <span class="ham-link-text">Pooja Essentials</span>
                                <span class="ham-arrow"><i class="fa-solid fa-arrow-right"
                                        aria-hidden="true"></i></span>
                            </button>
                        </li>
                        <li>
                            <button type="button" class="ham-link" data-ham-open="shop-kitchen">
                                <span class="ham-link-text">Kitchen &amp; Dining</span>
                                <span class="ham-arrow"><i class="fa-solid fa-arrow-right"
                                        aria-hidden="true"></i></span>
                            </button>
                        </li>
                        <li>
                            <button type="button" class="ham-link" data-ham-open="shop-metal">
                                <span class="ham-link-text">Metal Handicrafts</span>
                                <span class="ham-arrow"><i class="fa-solid fa-arrow-right"
                                        aria-hidden="true"></i></span>
                            </button>
                        </li>
                        <li>
                            <button type="button" class="ham-link" data-ham-open="shop-gifts">
                                <span class="ham-link-text">Gifts &amp; Collections</span>
                                <span class="ham-arrow"><i class="fa-solid fa-arrow-right"
                                        aria-hidden="true"></i></span>
                            </button>
                        </li>
                    </ul>
                </div>

                <div class="ham-view" data-ham-view="shop-decor" data-ham-title="Shop All" aria-hidden="true">
                    <div class="ham-head">
                        <h3 class="ham-title">Home Decor</h3>
                    </div>
                    <ul class="ham-list ham-list--sub">
                        <li><a href="product-listing.html">Decorative Showpieces</a></li>
                        <li><a href="product-listing.html">Wall Decor</a></li>
                        <li><a href="product-listing.html">Table Decor</a></li>
                        <li><a href="product-listing.html">Decorative Bowls</a></li>
                        <li><a href="product-listing.html">Sculptures</a></li>
                        <li>
                            <a href="product-listing.html">Explore All Home Decor &rarr;</a>
                        </li>
                    </ul>
                </div>

                <div class="ham-view" data-ham-view="shop-pooja" data-ham-title="Shop All" aria-hidden="true">
                    <div class="ham-head">
                        <h3 class="ham-title">Pooja Essentials</h3>
                    </div>
                    <ul class="ham-list ham-list--sub">
                        <li><a href="product-listing.html">Brass Diyas</a></li>
                        <li><a href="product-listing.html">Pooja Thali</a></li>
                        <li><a href="product-listing.html">Pooja Accessories</a></li>
                        <li><a href="product-listing.html">Traditional Decor</a></li>
                        <li>
                            <a href="product-listing.html">Explore All Pooja Items &rarr;</a>
                        </li>
                    </ul>
                </div>

                <div class="ham-view" data-ham-view="shop-kitchen" data-ham-title="Shop All" aria-hidden="true">
                    <div class="ham-head">
                        <h3 class="ham-title">Kitchen &amp; Dining</h3>
                    </div>
                    <ul class="ham-list ham-list--sub">
                        <li><a href="product-listing.html">Dinner Sets</a></li>
                        <li><a href="product-listing.html">Brass Utensils</a></li>
                        <li><a href="product-listing.html">Serving Accessories</a></li>
                        <li><a href="product-listing.html">Tableware</a></li>
                        <li>
                            <a href="product-listing.html">Explore Kitchen &amp; Dining &rarr;</a>
                        </li>
                    </ul>
                </div>

                <div class="ham-view" data-ham-view="shop-metal" data-ham-title="Shop All" aria-hidden="true">
                    <div class="ham-head">
                        <h3 class="ham-title">Metal Handicrafts</h3>
                    </div>
                    <ul class="ham-list ham-list--sub">
                        <li><a href="product-listing.html">Brass Handicrafts</a></li>
                        <li><a href="product-listing.html">Copper Products</a></li>
                        <li><a href="product-listing.html">Traditional Metal Art</a></li>
                        <li><a href="product-listing.html">Decorative Metal Items</a></li>
                        <li>
                            <a href="product-listing.html">Explore Metal Handicrafts &rarr;</a>
                        </li>
                    </ul>
                </div>

                <div class="ham-view" data-ham-view="shop-gifts" data-ham-title="Shop All" aria-hidden="true">
                    <div class="ham-head">
                        <h3 class="ham-title">Gifts &amp; Collections</h3>
                    </div>
                    <ul class="ham-list ham-list--sub">
                        <li><a href="product-listing.html">Traditional Gifts</a></li>
                        <li><a href="product-listing.html">Festive Gifts</a></li>
                        <li><a href="product-listing.html">Decorative Gifts</a></li>
                        <li><a href="product-listing.html">Special Collections</a></li>
                        <li>
                            <a href="all-categories-listing.html">Explore All Categories &rarr;</a>
                        </li>
                    </ul>
                </div>

                <div class="ham-view" data-ham-view="collection" data-ham-title="Shop by Collection" aria-hidden="true">
                    <div class="ham-head">
                        <h3 class="ham-title">Shop by Collection</h3>
                        <p class="ham-sub">
                            Find the perfect piece by occasion, budget or space.
                        </p>
                    </div>
                    <ul class="ham-list">
                        <li>
                            <button type="button" class="ham-link" data-ham-open="collection-occasion">
                                <span class="ham-link-text">Shop by Occasion</span>
                                <span class="ham-arrow"><i class="fa-solid fa-arrow-right"
                                        aria-hidden="true"></i></span>
                            </button>
                        </li>
                        <li>
                            <button type="button" class="ham-link" data-ham-open="collection-price">
                                <span class="ham-link-text">Shop by Price</span>
                                <span class="ham-arrow"><i class="fa-solid fa-arrow-right"
                                        aria-hidden="true"></i></span>
                            </button>
                        </li>
                        <li>
                            <button type="button" class="ham-link" data-ham-open="collection-popularity">
                                <span class="ham-link-text">Shop by Popularity</span>
                                <span class="ham-arrow"><i class="fa-solid fa-arrow-right"
                                        aria-hidden="true"></i></span>
                            </button>
                        </li>
                        <li>
                            <button type="button" class="ham-link" data-ham-open="collection-material">
                                <span class="ham-link-text">Shop by Material</span>
                                <span class="ham-arrow"><i class="fa-solid fa-arrow-right"
                                        aria-hidden="true"></i></span>
                            </button>
                        </li>
                        <li>
                            <button type="button" class="ham-link" data-ham-open="collection-space">
                                <span class="ham-link-text">Shop by Space</span>
                                <span class="ham-arrow"><i class="fa-solid fa-arrow-right"
                                        aria-hidden="true"></i></span>
                            </button>
                        </li>
                    </ul>
                </div>

                <div class="ham-view" data-ham-view="collection-occasion" data-ham-title="Shop by Collection"
                    aria-hidden="true">
                    <div class="ham-head">
                        <h3 class="ham-title">Shop by Occasion</h3>
                    </div>
                    <ul class="ham-list ham-list--sub">
                        <li><a href="product-listing.html">Diwali &amp; Festive</a></li>
                        <li><a href="product-listing.html">Housewarming</a></li>
                        <li><a href="product-listing.html">Wedding Gifting</a></li>
                        <li><a href="product-listing.html">Corporate Gifting</a></li>
                        <li>
                            <a href="product-listing.html">Anniversary &amp; Birthday</a>
                        </li>
                    </ul>
                </div>

                <div class="ham-view" data-ham-view="collection-price" data-ham-title="Shop by Collection"
                    aria-hidden="true">
                    <div class="ham-head">
                        <h3 class="ham-title">Shop by Price</h3>
                    </div>
                    <ul class="ham-list ham-list--sub">
                        <li><a href="product-listing.html">Under ₹999</a></li>
                        <li><a href="product-listing.html">₹1,000 – ₹2,999</a></li>
                        <li><a href="product-listing.html">₹3,000 – ₹5,999</a></li>
                        <li><a href="product-listing.html">₹6,000 &amp; Above</a></li>
                        <li><a href="product-listing.html">Luxury Edit</a></li>
                    </ul>
                </div>

                <div class="ham-view" data-ham-view="collection-popularity" data-ham-title="Shop by Collection"
                    aria-hidden="true">
                    <div class="ham-head">
                        <h3 class="ham-title">Shop by Popularity</h3>
                    </div>
                    <ul class="ham-list ham-list--sub">
                        <li><a href="product-listing.html">Best Sellers</a></li>
                        <li><a href="product-listing.html">New Arrivals</a></li>
                        <li><a href="product-listing.html">Most Loved</a></li>
                        <li><a href="product-listing.html">Trending Now</a></li>
                        <li><a href="product-listing.html">Customer Favourites</a></li>
                    </ul>
                </div>

                <div class="ham-view" data-ham-view="collection-material" data-ham-title="Shop by Collection"
                    aria-hidden="true">
                    <div class="ham-head">
                        <h3 class="ham-title">Shop by Material</h3>
                    </div>
                    <ul class="ham-list ham-list--sub">
                        <li><a href="product-listing.html">Pure Brass</a></li>
                        <li><a href="product-listing.html">Copper</a></li>
                        <li>
                            <a href="product-listing.html">Bronze &amp; Bell Metal</a>
                        </li>
                        <li><a href="product-listing.html">Wood &amp; Metal Blend</a></li>
                        <li><a href="product-listing.html">Antique Finish</a></li>
                    </ul>
                </div>

                <div class="ham-view" data-ham-view="collection-space" data-ham-title="Shop by Collection"
                    aria-hidden="true">
                    <div class="ham-head">
                        <h3 class="ham-title">Shop by Space</h3>
                    </div>
                    <ul class="ham-list ham-list--sub">
                        <li><a href="product-listing.html">Living Room</a></li>
                        <li><a href="product-listing.html">Pooja Room</a></li>
                        <li><a href="product-listing.html">Kitchen &amp; Dining</a></li>
                        <li><a href="product-listing.html">Entrance &amp; Foyer</a></li>
                        <li><a href="product-listing.html">Garden &amp; Outdoor</a></li>
                    </ul>
                </div>
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

                <a href="product-listing.html" class="btn btn-primary header-cta">
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

        <div class="model-body">
            <div class="cp-head">
                <h3>My Cart <span>3 items</span></h3>
            </div>

            <ul class="cp-list">
                <li class="cp-item">
                    <a class="cp-img" href="javascript:void(0);">
                        <img src="assets/images/home/cat4.png" alt="Handmade Brass Oil Lamp" width="96" height="128"
                            loading="lazy" />
                    </a>
                    <div class="cp-info">
                        <span class="cp-cat">Diyas &amp; Lamps</span>
                        <h4 class="cp-name">
                            <a href="javascript:void(0);">Handmade Brass Oil Lamp</a>
                        </h4>
                        <span class="cp-variant">Brass · Medium · Antique Finish</span>
                        <div class="cp-price">
                            <strong>Rs. 1,299</strong><del>Rs. 1,599</del><span class="cp-off">19% off</span>
                        </div>
                        <div class="cp-actions">
                            <div class="qty" role="group" aria-label="Quantity for Handmade Brass Oil Lamp">
                                <button type="button" class="qty-minus" aria-label="Decrease quantity">
                                    <i class="fa-solid fa-minus" aria-hidden="true"></i>
                                </button>
                                <input type="text" inputmode="numeric" value="1" aria-label="Quantity" />
                                <button type="button" class="qty-plus" aria-label="Increase quantity">
                                    <i class="fa-solid fa-plus" aria-hidden="true"></i>
                                </button>
                            </div>
                            <button type="button" class="cp-remove">
                                <i class="fa-regular fa-trash-can" aria-hidden="true"></i>
                                Remove
                            </button>
                        </div>
                    </div>
                </li>

                <li class="cp-item">
                    <a class="cp-img" href="javascript:void(0);">
                        <img src="assets/images/home/cat1.png" alt="Brass Lotus Kuber Diya" width="96" height="128"
                            loading="lazy" />
                    </a>
                    <div class="cp-info">
                        <span class="cp-cat">Pooja Essentials</span>
                        <h4 class="cp-name">
                            <a href="javascript:void(0);">Brass Lotus Kuber Diya</a>
                        </h4>
                        <span class="cp-variant">Brass · Small · Polished Finish</span>
                        <div class="cp-price">
                            <strong>Rs. 1,099</strong><del>Rs. 1,299</del><span class="cp-off">15% off</span>
                        </div>
                        <div class="cp-actions">
                            <div class="qty" role="group" aria-label="Quantity for Brass Lotus Kuber Diya">
                                <button type="button" class="qty-minus" aria-label="Decrease quantity">
                                    <i class="fa-solid fa-minus" aria-hidden="true"></i>
                                </button>
                                <input type="text" inputmode="numeric" value="1" aria-label="Quantity" />
                                <button type="button" class="qty-plus" aria-label="Increase quantity">
                                    <i class="fa-solid fa-plus" aria-hidden="true"></i>
                                </button>
                            </div>
                            <button type="button" class="cp-remove">
                                <i class="fa-regular fa-trash-can" aria-hidden="true"></i>
                                Remove
                            </button>
                        </div>
                    </div>
                </li>

                <li class="cp-item">
                    <a class="cp-img" href="javascript:void(0);">
                        <img src="assets/images/home/cat3.png" alt="Hammered Copper Goblet" width="96" height="128"
                            loading="lazy" />
                    </a>
                    <div class="cp-info">
                        <span class="cp-cat">Copper Drinkware</span>
                        <h4 class="cp-name">
                            <a href="javascript:void(0);">Hammered Copper Goblet</a>
                        </h4>
                        <span class="cp-variant">Copper · Hammered Finish</span>
                        <div class="cp-price">
                            <strong>Rs. 749</strong><del>Rs. 899</del><span class="cp-off">17% off</span>
                        </div>
                        <div class="cp-actions">
                            <div class="qty" role="group" aria-label="Quantity for Hammered Copper Goblet">
                                <button type="button" class="qty-minus" aria-label="Decrease quantity">
                                    <i class="fa-solid fa-minus" aria-hidden="true"></i>
                                </button>
                                <input type="text" inputmode="numeric" value="1" aria-label="Quantity" />
                                <button type="button" class="qty-plus" aria-label="Increase quantity">
                                    <i class="fa-solid fa-plus" aria-hidden="true"></i>
                                </button>
                            </div>
                            <button type="button" class="cp-remove">
                                <i class="fa-regular fa-trash-can" aria-hidden="true"></i>
                                Remove
                            </button>
                        </div>
                    </div>
                </li>
            </ul>

            <!-- empty state: cart khali ho to ise dikhao, .cp-list aur .cp-foot hide karo -->
            <div class="cp-empty" hidden>
                <span class="cp-empty-icon"><i class="fa-solid fa-bag-shopping" aria-hidden="true"></i></span>
                <h4>Your cart is empty</h4>
                <p>Explore brass decor, pooja essentials and copper drinkware.</p>
                <a href="product-listing.html" class="btn btn-primary">Shop Now</a>
            </div>

            <div class="cp-foot">
                <div class="cp-total">
                    <span>Subtotal</span>
                    <strong>Rs. 3,147</strong>
                </div>
                <p class="cp-note">
                    <i class="fa-solid fa-truck-fast" aria-hidden="true"></i>
                    You have unlocked FREE shipping. Taxes, coupons and customs duties
                    (for international orders) are shown at checkout.
                </p>
                <div class="cp-btns">
                    <a href="cart.html" class="btn btn-outline-primary">View Cart</a>
                    <a href="checkout.html" class="btn btn-primary">Checkout</a>
                </div>
            </div>
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
            <a href="index.html" class="pop-logo" aria-label="Parijaat Handicraft Home">
                <img src="assets/images/logo.png" alt="" />
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
                    <img src="assets/images/home/cat1.png" alt="Welcome to Parijaat Handicraft" loading="lazy" />
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
                        <a href="product-listing.html" class="btn btn-primary">
                            Shop Now <i class="fa-solid fa-arrow-right-long"></i>
                        </a>
                        <a href="product-listing.html" class="btn btn-outline-primary">
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

    @stack('scripts')
    @include('layouts.tracking-body-bottom')

</body>

</html>