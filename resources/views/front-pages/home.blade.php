@extends('layouts.app')

@section('content')

    <main>
        <section class="home-banner">
            <div class="swiper singleSlider">
                <div class="swiper-wrapper">
                    <!-- Slide 01 – Home Decor -->
                    <div class="swiper-slide">
                        <div class="slide-content">
                            <div class="content-inner">
                                <span class="hero-eyebrow">Timeless Home Collection</span>
                                <h1 class="hero-title">
                                    Give Your Home a Touch of Artistry.
                                </h1>
                                <p class="hero-desc">
                                    Explore distinctive decorative pieces, handcrafted accents
                                    and timeless creations that add warmth and character to
                                    every space.
                                </p>
                                <div class="hero-btns">
                                    <a href="javascript:void(0)" class="hero-btn">Shop Home Decor</a>
                                </div>
                            </div>
                        </div>
                        <figure class="slide-img">
                            <img src="assets/images/home/herobanner.png"
                                alt="Handcrafted brass decor and traditional accessories" />
                        </figure>
                    </div>

                    <!-- Slide 02 – Pooja Collection -->
                    <div class="swiper-slide">
                        <div class="slide-content">
                            <div class="content-inner">
                                <span class="hero-eyebrow">Celebrate with Tradition</span>
                                <h1 class="hero-title">
                                    Bring Home the Beauty of Tradition.
                                </h1>
                                <p class="hero-desc">
                                    From traditional diyas to elegant pooja essentials, discover
                                    handcrafted pieces that make every celebration more
                                    meaningful.
                                </p>
                                <div class="hero-btns">
                                    <a href="javascript:void(0)" class="hero-btn">Shop Pooja Collection</a>
                                </div>
                            </div>
                        </div>
                        <figure class="slide-img">
                            <img src="assets/images/home/herobanner2.png"
                                alt="Brass diya, pooja thali and traditional accessories" />
                        </figure>
                    </div>
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
                            <div class="swiper-slide">
                                <a href="product-listing.html" class="cat_card">
                                    <figure>
                                        <picture>
                                            <img src="assets/images/home/cat1.png" alt="Brass Idols &amp; Statues"
                                                loading="lazy" />
                                        </picture>
                                    </figure>
                                    <h2>Brass Idols &amp; Statues</h2>
                                    <span>12 items</span>
                                </a>
                            </div>

                            <div class="swiper-slide">
                                <a href="product-listing.html" class="cat_card">
                                    <figure>
                                        <picture>
                                            <img src="assets/images/home/cat2.png" alt="Pooja Essentials" loading="lazy" />
                                        </picture>
                                    </figure>
                                    <h2>Pooja Essentials</h2>
                                    <span>16 items</span>
                                </a>
                            </div>

                            <div class="swiper-slide">
                                <a href="product-listing.html" class="cat_card">
                                    <figure>
                                        <picture>
                                            <img src="assets/images/home/cat3.png" alt="Copper Drinkware" loading="lazy" />
                                        </picture>
                                    </figure>
                                    <h2>Copper Drinkware</h2>
                                    <span>18 items</span>
                                </a>
                            </div>

                            <div class="swiper-slide">
                                <a href="product-listing.html" class="cat_card">
                                    <figure>
                                        <picture>
                                            <img src="assets/images/home/cat4.png" alt="Brass Diyas &amp; Lamps"
                                                loading="lazy" />
                                        </picture>
                                    </figure>
                                    <h2>Brass Diyas &amp; Lamps</h2>
                                    <span>24 items</span>
                                </a>
                            </div>

                            <div class="swiper-slide">
                                <a href="product-listing.html" class="cat_card">
                                    <figure>
                                        <picture>
                                            <img src="assets/images/home/cat5.png" alt="Antique Locks &amp; Keys"
                                                loading="lazy" />
                                        </picture>
                                    </figure>
                                    <h2>Antique Locks &amp; Keys</h2>
                                    <span>08 items</span>
                                </a>
                            </div>

                            <div class="swiper-slide">
                                <a href="product-listing.html" class="cat_card">
                                    <figure>
                                        <picture>
                                            <img src="assets/images/home/cat6.png" alt="Bells &amp; Wind Chimes"
                                                loading="lazy" />
                                        </picture>
                                    </figure>
                                    <h2>Bells &amp; Wind Chimes</h2>
                                    <span>26 items</span>
                                </a>
                            </div>
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
                    <li data-tab="1" class="active">All Bestsellers</li>
                    <li data-tab="2">Brass Decor</li>
                    <li data-tab="3">Religious</li>
                    <li data-tab="4">Home &amp; Living</li>
                    <li data-tab="5">Kitchen &amp; Dining</li>
                </ul>

                <div class="tab-nav-content">
                    <!-- ============ TAB 1 : ALL BESTSELLERS ============ -->
                    <div class="tabs active" data-tab="1">
                        <div class="swiper-wrap">
                            <div class="swiper fourSlider" data-mob="2" data-sm="3" data-lg="4" data-xl="5">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <article class="prod_cart">
                                            <div class="prod-img">
                                                <a href="product-detail.html" class="prod-link"><img
                                                        src="assets/images/home/cat4.png" alt="Handmade Brass Oil Lamp"
                                                        loading="lazy" /></a>
                                                <span class="prod-badge">Bestseller</span>
                                                <button type="button" class="wish-btn" aria-label="Add to wishlist">
                                                    <i class="fa-regular fa-heart"></i>
                                                </button>
                                            </div>
                                            <div class="prod-info">
                                                <h4 class="prod-brand">Parijat Handicraft</h4>
                                                <p class="prod-name">
                                                    <a href="product-detail.html">Handmade Brass Oil Lamp</a>
                                                </p>
                                                <div class="prod-price">
                                                    <span class="price-now">$229</span>
                                                    <span class="price-old">$279</span>
                                                    <span class="price-off">(18% OFF)</span>
                                                </div>
                                                <div class="prod-btns">
                                                    <button type="button" class="btn btn-outline-black" data-id="SKU-P1"
                                                        data-name="Handmade Brass Oil Lamp" data-toast-title="Added to Cart"
                                                        data-toast-text="Handmade Brass Oil Lamp has been added to your cart."
                                                        data-toast-type="success">
                                                        Add to Cart
                                                    </button>
                                                    <a href="product-detail.html" class="btn btn-primary">Buy Now</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>

                                    <div class="swiper-slide">
                                        <article class="prod_cart">
                                            <div class="prod-img">
                                                <a href="product-detail.html" class="prod-link"><img
                                                        src="assets/images/home/cat2.png" alt="Brass Aladdin Incense Burner"
                                                        loading="lazy" /></a>
                                                <button type="button" class="wish-btn" aria-label="Add to wishlist">
                                                    <i class="fa-regular fa-heart"></i>
                                                </button>
                                            </div>
                                            <div class="prod-info">
                                                <h4 class="prod-brand">Parijat Handicraft</h4>
                                                <p class="prod-name">
                                                    <a href="product-detail.html">Brass Aladdin Incense Burner</a>
                                                </p>
                                                <div class="prod-price">
                                                    <span class="price-now">$129</span>
                                                    <span class="price-old">$159</span>
                                                    <span class="price-off">(19% OFF)</span>
                                                </div>
                                                <div class="prod-btns">
                                                    <button type="button" class="btn btn-outline-black" data-id="SKU-P2"
                                                        data-name="Brass Aladdin Incense Burner"
                                                        data-toast-title="Added to Cart"
                                                        data-toast-text="Brass Aladdin Incense Burner has been added to your cart."
                                                        data-toast-type="success">
                                                        Add to Cart
                                                    </button>
                                                    <a href="product-detail.html" class="btn btn-primary">Buy Now</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>

                                    <div class="swiper-slide">
                                        <article class="prod_cart">
                                            <div class="prod-img">
                                                <a href="product-detail.html" class="prod-link"><img
                                                        src="assets/images/home/cat1.png"
                                                        alt="Brass Decorative Rabbit Figurine" loading="lazy" /></a>
                                                <span class="prod-badge">Limited Stock</span>
                                                <button type="button" class="wish-btn" aria-label="Add to wishlist">
                                                    <i class="fa-regular fa-heart"></i>
                                                </button>
                                            </div>
                                            <div class="prod-info">
                                                <h4 class="prod-brand">Parijat Handicraft</h4>
                                                <p class="prod-name">
                                                    <a href="product-detail.html">Brass Decorative Rabbit Figurine</a>
                                                </p>
                                                <div class="prod-price">
                                                    <span class="price-now">$389</span>
                                                    <span class="price-old">$459</span>
                                                    <span class="price-off">(15% OFF)</span>
                                                </div>
                                                <div class="prod-btns">
                                                    <button type="button" class="btn btn-outline-black" data-id="SKU-P3"
                                                        data-name="Brass Decorative Rabbit Figurine"
                                                        data-toast-title="Added to Cart"
                                                        data-toast-text="Brass Decorative Rabbit Figurine has been added to your cart."
                                                        data-toast-type="success">
                                                        Add to Cart
                                                    </button>
                                                    <a href="product-detail.html" class="btn btn-primary">Buy Now</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>

                                    <div class="swiper-slide">
                                        <article class="prod_cart">
                                            <div class="prod-img">
                                                <a href="product-detail.html" class="prod-link"><img
                                                        src="assets/images/home/cat3.png" alt="Hammered Copper Goblet"
                                                        loading="lazy" /></a>
                                                <button type="button" class="wish-btn" aria-label="Add to wishlist">
                                                    <i class="fa-regular fa-heart"></i>
                                                </button>
                                            </div>
                                            <div class="prod-info">
                                                <h4 class="prod-brand">Parijat Handicraft</h4>
                                                <p class="prod-name">
                                                    <a href="product-detail.html">Hammered Copper Goblet</a>
                                                </p>
                                                <div class="prod-price">
                                                    <span class="price-now">$125</span>
                                                    <span class="price-old">$149</span>
                                                    <span class="price-off">(16% OFF)</span>
                                                </div>
                                                <div class="prod-btns">
                                                    <button type="button" class="btn btn-outline-black" data-id="SKU-P4"
                                                        data-name="Hammered Copper Goblet" data-toast-title="Added to Cart"
                                                        data-toast-text="Hammered Copper Goblet has been added to your cart."
                                                        data-toast-type="success">
                                                        Add to Cart
                                                    </button>
                                                    <a href="product-detail.html" class="btn btn-primary">Buy Now</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>

                                    <div class="swiper-slide">
                                        <article class="prod_cart">
                                            <div class="prod-img">
                                                <a href="product-detail.html" class="prod-link"><img
                                                        src="assets/images/home/cat4.png" alt="Brass Lotus Kuber Diya"
                                                        loading="lazy" /></a>
                                                <span class="prod-badge">Bestseller</span>
                                                <button type="button" class="wish-btn" aria-label="Add to wishlist">
                                                    <i class="fa-regular fa-heart"></i>
                                                </button>
                                            </div>
                                            <div class="prod-info">
                                                <h4 class="prod-brand">Parijat Handicraft</h4>
                                                <p class="prod-name">
                                                    <a href="product-detail.html">Brass Lotus Kuber Diya</a>
                                                </p>
                                                <div class="prod-price">
                                                    <span class="price-now">$179</span>
                                                    <span class="price-old">$209</span>
                                                    <span class="price-off">(14% OFF)</span>
                                                </div>
                                                <div class="prod-btns">
                                                    <button type="button" class="btn btn-outline-black" data-id="SKU-P5"
                                                        data-name="Brass Lotus Kuber Diya" data-toast-title="Added to Cart"
                                                        data-toast-text="Brass Lotus Kuber Diya has been added to your cart."
                                                        data-toast-type="success">
                                                        Add to Cart
                                                    </button>
                                                    <a href="product-detail.html" class="btn btn-primary">Buy Now</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>

                                    <div class="swiper-slide">
                                        <article class="prod_cart">
                                            <div class="prod-img">
                                                <a href="product-detail.html" class="prod-link"><img
                                                        src="assets/images/home/cat1.png" alt="Brass Elephant Diya Stand"
                                                        loading="lazy" /></a>
                                                <button type="button" class="wish-btn" aria-label="Add to wishlist">
                                                    <i class="fa-regular fa-heart"></i>
                                                </button>
                                            </div>
                                            <div class="prod-info">
                                                <h4 class="prod-brand">Parijat Handicraft</h4>
                                                <p class="prod-name">
                                                    <a href="product-detail.html">Brass Elephant Diya Stand</a>
                                                </p>
                                                <div class="prod-price">
                                                    <span class="price-now">$259</span>
                                                    <span class="price-old">$309</span>
                                                    <span class="price-off">(16% OFF)</span>
                                                </div>
                                                <div class="prod-btns">
                                                    <button type="button" class="btn btn-outline-black" data-id="SKU-P6"
                                                        data-name="Brass Elephant Diya Stand"
                                                        data-toast-title="Added to Cart"
                                                        data-toast-text="Brass Elephant Diya Stand has been added to your cart."
                                                        data-toast-type="success">
                                                        Add to Cart
                                                    </button>
                                                    <a href="product-detail.html" class="btn btn-primary">Buy Now</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
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

                    <!-- ============ TAB 2 : BRASS DECOR ============ -->
                    <div class="tabs" data-tab="2">
                        <div class="swiper-wrap">
                            <div class="swiper fourSlider" data-mob="2" data-sm="3" data-lg="4" data-xl="5">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <article class="prod_cart">
                                            <div class="prod-img">
                                                <a href="product-detail.html" class="prod-link"><img
                                                        src="assets/images/home/cat1.png"
                                                        alt="Brass Decorative Rabbit Figurine" loading="lazy" /></a>
                                                <span class="prod-badge">Limited Stock</span>
                                                <button type="button" class="wish-btn" aria-label="Add to wishlist">
                                                    <i class="fa-regular fa-heart"></i>
                                                </button>
                                            </div>
                                            <div class="prod-info">
                                                <h4 class="prod-brand">Parijat Handicraft</h4>
                                                <p class="prod-name">
                                                    <a href="product-detail.html">Brass Decorative Rabbit Figurine</a>
                                                </p>
                                                <div class="prod-price">
                                                    <span class="price-now">$389</span>
                                                    <span class="price-old">$459</span>
                                                    <span class="price-off">(15% OFF)</span>
                                                </div>
                                                <div class="prod-btns">
                                                    <button type="button" class="btn btn-outline-black" data-id="SKU-P3"
                                                        data-name="Brass Decorative Rabbit Figurine"
                                                        data-toast-title="Added to Cart"
                                                        data-toast-text="Brass Decorative Rabbit Figurine has been added to your cart."
                                                        data-toast-type="success">
                                                        Add to Cart
                                                    </button>
                                                    <a href="product-detail.html" class="btn btn-primary">Buy Now</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>

                                    <div class="swiper-slide">
                                        <article class="prod_cart">
                                            <div class="prod-img">
                                                <a href="product-detail.html" class="prod-link"><img
                                                        src="assets/images/home/cat2.png" alt="Brass Aladdin Incense Burner"
                                                        loading="lazy" /></a>
                                                <button type="button" class="wish-btn" aria-label="Add to wishlist">
                                                    <i class="fa-regular fa-heart"></i>
                                                </button>
                                            </div>
                                            <div class="prod-info">
                                                <h4 class="prod-brand">Parijat Handicraft</h4>
                                                <p class="prod-name">
                                                    <a href="product-detail.html">Brass Aladdin Incense Burner</a>
                                                </p>
                                                <div class="prod-price">
                                                    <span class="price-now">$129</span>
                                                    <span class="price-old">$159</span>
                                                    <span class="price-off">(19% OFF)</span>
                                                </div>
                                                <div class="prod-btns">
                                                    <button type="button" class="btn btn-outline-black" data-id="SKU-P2"
                                                        data-name="Brass Aladdin Incense Burner"
                                                        data-toast-title="Added to Cart"
                                                        data-toast-text="Brass Aladdin Incense Burner has been added to your cart."
                                                        data-toast-type="success">
                                                        Add to Cart
                                                    </button>
                                                    <a href="product-detail.html" class="btn btn-primary">Buy Now</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>

                                    <div class="swiper-slide">
                                        <article class="prod_cart">
                                            <div class="prod-img">
                                                <a href="product-detail.html" class="prod-link"><img
                                                        src="assets/images/home/cat4.png" alt="Handmade Brass Oil Lamp"
                                                        loading="lazy" /></a>
                                                <span class="prod-badge">Bestseller</span>
                                                <button type="button" class="wish-btn" aria-label="Add to wishlist">
                                                    <i class="fa-regular fa-heart"></i>
                                                </button>
                                            </div>
                                            <div class="prod-info">
                                                <h4 class="prod-brand">Parijat Handicraft</h4>
                                                <p class="prod-name">
                                                    <a href="product-detail.html">Handmade Brass Oil Lamp</a>
                                                </p>
                                                <div class="prod-price">
                                                    <span class="price-now">$229</span>
                                                    <span class="price-old">$279</span>
                                                    <span class="price-off">(18% OFF)</span>
                                                </div>
                                                <div class="prod-btns">
                                                    <button type="button" class="btn btn-outline-black" data-id="SKU-P1"
                                                        data-name="Handmade Brass Oil Lamp" data-toast-title="Added to Cart"
                                                        data-toast-text="Handmade Brass Oil Lamp has been added to your cart."
                                                        data-toast-type="success">
                                                        Add to Cart
                                                    </button>
                                                    <a href="product-detail.html" class="btn btn-primary">Buy Now</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>

                                    <div class="swiper-slide">
                                        <article class="prod_cart">
                                            <div class="prod-img">
                                                <a href="product-detail.html" class="prod-link"><img
                                                        src="assets/images/home/cat4.png" alt="Brass Lotus Kuber Diya"
                                                        loading="lazy" /></a>
                                                <span class="prod-badge">Bestseller</span>
                                                <button type="button" class="wish-btn" aria-label="Add to wishlist">
                                                    <i class="fa-regular fa-heart"></i>
                                                </button>
                                            </div>
                                            <div class="prod-info">
                                                <h4 class="prod-brand">Parijat Handicraft</h4>
                                                <p class="prod-name">
                                                    <a href="product-detail.html">Brass Lotus Kuber Diya</a>
                                                </p>
                                                <div class="prod-price">
                                                    <span class="price-now">$179</span>
                                                    <span class="price-old">$209</span>
                                                    <span class="price-off">(14% OFF)</span>
                                                </div>
                                                <div class="prod-btns">
                                                    <button type="button" class="btn btn-outline-black" data-id="SKU-P5"
                                                        data-name="Brass Lotus Kuber Diya" data-toast-title="Added to Cart"
                                                        data-toast-text="Brass Lotus Kuber Diya has been added to your cart."
                                                        data-toast-type="success">
                                                        Add to Cart
                                                    </button>
                                                    <a href="product-detail.html" class="btn btn-primary">Buy Now</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>

                                    <div class="swiper-slide">
                                        <article class="prod_cart">
                                            <div class="prod-img">
                                                <a href="product-detail.html" class="prod-link"><img
                                                        src="assets/images/home/cat1.png" alt="Brass Elephant Diya Stand"
                                                        loading="lazy" /></a>
                                                <button type="button" class="wish-btn" aria-label="Add to wishlist">
                                                    <i class="fa-regular fa-heart"></i>
                                                </button>
                                            </div>
                                            <div class="prod-info">
                                                <h4 class="prod-brand">Parijat Handicraft</h4>
                                                <p class="prod-name">
                                                    <a href="product-detail.html">Brass Elephant Diya Stand</a>
                                                </p>
                                                <div class="prod-price">
                                                    <span class="price-now">$259</span>
                                                    <span class="price-old">$309</span>
                                                    <span class="price-off">(16% OFF)</span>
                                                </div>
                                                <div class="prod-btns">
                                                    <button type="button" class="btn btn-outline-black" data-id="SKU-P6"
                                                        data-name="Brass Elephant Diya Stand"
                                                        data-toast-title="Added to Cart"
                                                        data-toast-text="Brass Elephant Diya Stand has been added to your cart."
                                                        data-toast-type="success">
                                                        Add to Cart
                                                    </button>
                                                    <a href="product-detail.html" class="btn btn-primary">Buy Now</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
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

                    <!-- ============ TAB 3 : RELIGIOUS ============ -->
                    <div class="tabs" data-tab="3">
                        <div class="swiper-wrap">
                            <div class="swiper fourSlider" data-mob="2" data-sm="3" data-lg="4" data-xl="5">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <article class="prod_cart">
                                            <div class="prod-img">
                                                <a href="product-detail.html" class="prod-link"><img
                                                        src="assets/images/home/cat4.png" alt="Brass Lotus Kuber Diya"
                                                        loading="lazy" /></a>
                                                <span class="prod-badge">Bestseller</span>
                                                <button type="button" class="wish-btn" aria-label="Add to wishlist">
                                                    <i class="fa-regular fa-heart"></i>
                                                </button>
                                            </div>
                                            <div class="prod-info">
                                                <h4 class="prod-brand">Parijat Handicraft</h4>
                                                <p class="prod-name">
                                                    <a href="product-detail.html">Brass Lotus Kuber Diya</a>
                                                </p>
                                                <div class="prod-price">
                                                    <span class="price-now">$179</span>
                                                    <span class="price-old">$209</span>
                                                    <span class="price-off">(14% OFF)</span>
                                                </div>
                                                <div class="prod-btns">
                                                    <button type="button" class="btn btn-outline-black" data-id="SKU-P5"
                                                        data-name="Brass Lotus Kuber Diya" data-toast-title="Added to Cart"
                                                        data-toast-text="Brass Lotus Kuber Diya has been added to your cart."
                                                        data-toast-type="success">
                                                        Add to Cart
                                                    </button>
                                                    <a href="product-detail.html" class="btn btn-primary">Buy Now</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>

                                    <div class="swiper-slide">
                                        <article class="prod_cart">
                                            <div class="prod-img">
                                                <a href="product-detail.html" class="prod-link"><img
                                                        src="assets/images/home/cat4.png" alt="Handmade Brass Oil Lamp"
                                                        loading="lazy" /></a>
                                                <span class="prod-badge">Bestseller</span>
                                                <button type="button" class="wish-btn" aria-label="Add to wishlist">
                                                    <i class="fa-regular fa-heart"></i>
                                                </button>
                                            </div>
                                            <div class="prod-info">
                                                <h4 class="prod-brand">Parijat Handicraft</h4>
                                                <p class="prod-name">
                                                    <a href="product-detail.html">Handmade Brass Oil Lamp</a>
                                                </p>
                                                <div class="prod-price">
                                                    <span class="price-now">$229</span>
                                                    <span class="price-old">$279</span>
                                                    <span class="price-off">(18% OFF)</span>
                                                </div>
                                                <div class="prod-btns">
                                                    <button type="button" class="btn btn-outline-black" data-id="SKU-P1"
                                                        data-name="Handmade Brass Oil Lamp" data-toast-title="Added to Cart"
                                                        data-toast-text="Handmade Brass Oil Lamp has been added to your cart."
                                                        data-toast-type="success">
                                                        Add to Cart
                                                    </button>
                                                    <a href="product-detail.html" class="btn btn-primary">Buy Now</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>

                                    <div class="swiper-slide">
                                        <article class="prod_cart">
                                            <div class="prod-img">
                                                <a href="product-detail.html" class="prod-link"><img
                                                        src="assets/images/home/cat1.png" alt="Brass Elephant Diya Stand"
                                                        loading="lazy" /></a>
                                                <button type="button" class="wish-btn" aria-label="Add to wishlist">
                                                    <i class="fa-regular fa-heart"></i>
                                                </button>
                                            </div>
                                            <div class="prod-info">
                                                <h4 class="prod-brand">Parijat Handicraft</h4>
                                                <p class="prod-name">
                                                    <a href="product-detail.html">Brass Elephant Diya Stand</a>
                                                </p>
                                                <div class="prod-price">
                                                    <span class="price-now">$259</span>
                                                    <span class="price-old">$309</span>
                                                    <span class="price-off">(16% OFF)</span>
                                                </div>
                                                <div class="prod-btns">
                                                    <button type="button" class="btn btn-outline-black" data-id="SKU-P6"
                                                        data-name="Brass Elephant Diya Stand"
                                                        data-toast-title="Added to Cart"
                                                        data-toast-text="Brass Elephant Diya Stand has been added to your cart."
                                                        data-toast-type="success">
                                                        Add to Cart
                                                    </button>
                                                    <a href="product-detail.html" class="btn btn-primary">Buy Now</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>

                                    <div class="swiper-slide">
                                        <article class="prod_cart">
                                            <div class="prod-img">
                                                <a href="product-detail.html" class="prod-link"><img
                                                        src="assets/images/home/cat2.png" alt="Brass Aladdin Incense Burner"
                                                        loading="lazy" /></a>
                                                <button type="button" class="wish-btn" aria-label="Add to wishlist">
                                                    <i class="fa-regular fa-heart"></i>
                                                </button>
                                            </div>
                                            <div class="prod-info">
                                                <h4 class="prod-brand">Parijat Handicraft</h4>
                                                <p class="prod-name">
                                                    <a href="product-detail.html">Brass Aladdin Incense Burner</a>
                                                </p>
                                                <div class="prod-price">
                                                    <span class="price-now">$129</span>
                                                    <span class="price-old">$159</span>
                                                    <span class="price-off">(19% OFF)</span>
                                                </div>
                                                <div class="prod-btns">
                                                    <button type="button" class="btn btn-outline-black" data-id="SKU-P2"
                                                        data-name="Brass Aladdin Incense Burner"
                                                        data-toast-title="Added to Cart"
                                                        data-toast-text="Brass Aladdin Incense Burner has been added to your cart."
                                                        data-toast-type="success">
                                                        Add to Cart
                                                    </button>
                                                    <a href="product-detail.html" class="btn btn-primary">Buy Now</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>

                                    <div class="swiper-slide">
                                        <article class="prod_cart">
                                            <div class="prod-img">
                                                <a href="product-detail.html" class="prod-link"><img
                                                        src="assets/images/home/cat1.png"
                                                        alt="Brass Decorative Rabbit Figurine" loading="lazy" /></a>
                                                <span class="prod-badge">Limited Stock</span>
                                                <button type="button" class="wish-btn" aria-label="Add to wishlist">
                                                    <i class="fa-regular fa-heart"></i>
                                                </button>
                                            </div>
                                            <div class="prod-info">
                                                <h4 class="prod-brand">Parijat Handicraft</h4>
                                                <p class="prod-name">
                                                    <a href="product-detail.html">Brass Decorative Rabbit Figurine</a>
                                                </p>
                                                <div class="prod-price">
                                                    <span class="price-now">$389</span>
                                                    <span class="price-old">$459</span>
                                                    <span class="price-off">(15% OFF)</span>
                                                </div>
                                                <div class="prod-btns">
                                                    <button type="button" class="btn btn-outline-black" data-id="SKU-P3"
                                                        data-name="Brass Decorative Rabbit Figurine"
                                                        data-toast-title="Added to Cart"
                                                        data-toast-text="Brass Decorative Rabbit Figurine has been added to your cart."
                                                        data-toast-type="success">
                                                        Add to Cart
                                                    </button>
                                                    <a href="product-detail.html" class="btn btn-primary">Buy Now</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
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

                    <!-- ============ TAB 4 : HOME & LIVING ============ -->
                    <div class="tabs" data-tab="4">
                        <div class="swiper-wrap">
                            <div class="swiper fourSlider" data-mob="2" data-sm="3" data-lg="4" data-xl="5">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <article class="prod_cart">
                                            <div class="prod-img">
                                                <a href="product-detail.html" class="prod-link"><img
                                                        src="assets/images/home/cat1.png"
                                                        alt="Brass Decorative Rabbit Figurine" loading="lazy" /></a>
                                                <span class="prod-badge">Limited Stock</span>
                                                <button type="button" class="wish-btn" aria-label="Add to wishlist">
                                                    <i class="fa-regular fa-heart"></i>
                                                </button>
                                            </div>
                                            <div class="prod-info">
                                                <h4 class="prod-brand">Parijat Handicraft</h4>
                                                <p class="prod-name">
                                                    <a href="product-detail.html">Brass Decorative Rabbit Figurine</a>
                                                </p>
                                                <div class="prod-price">
                                                    <span class="price-now">$389</span>
                                                    <span class="price-old">$459</span>
                                                    <span class="price-off">(15% OFF)</span>
                                                </div>
                                                <div class="prod-btns">
                                                    <button type="button" class="btn btn-outline-black" data-id="SKU-P3"
                                                        data-name="Brass Decorative Rabbit Figurine"
                                                        data-toast-title="Added to Cart"
                                                        data-toast-text="Brass Decorative Rabbit Figurine has been added to your cart."
                                                        data-toast-type="success">
                                                        Add to Cart
                                                    </button>
                                                    <a href="product-detail.html" class="btn btn-primary">Buy Now</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>

                                    <div class="swiper-slide">
                                        <article class="prod_cart">
                                            <div class="prod-img">
                                                <a href="product-detail.html" class="prod-link"><img
                                                        src="assets/images/home/cat6.png" alt="Brass Wind Chime"
                                                        loading="lazy" /></a>
                                                <button type="button" class="wish-btn" aria-label="Add to wishlist">
                                                    <i class="fa-regular fa-heart"></i>
                                                </button>
                                            </div>
                                            <div class="prod-info">
                                                <h4 class="prod-brand">Parijat Handicraft</h4>
                                                <p class="prod-name">
                                                    <a href="product-detail.html">Brass Wind Chime</a>
                                                </p>
                                                <div class="prod-price">
                                                    <span class="price-now">$249</span>
                                                    <span class="price-old">$299</span>
                                                    <span class="price-off">(17% OFF)</span>
                                                </div>
                                                <div class="prod-btns">
                                                    <button type="button" class="btn btn-outline-black" data-id="SKU-P9"
                                                        data-name="Brass Wind Chime" data-toast-title="Added to Cart"
                                                        data-toast-text="Brass Wind Chime has been added to your cart."
                                                        data-toast-type="success">
                                                        Add to Cart
                                                    </button>
                                                    <a href="product-detail.html" class="btn btn-primary">Buy Now</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>

                                    <div class="swiper-slide">
                                        <article class="prod_cart">
                                            <div class="prod-img">
                                                <a href="product-detail.html" class="prod-link"><img
                                                        src="assets/images/home/cat4.png" alt="Handmade Brass Oil Lamp"
                                                        loading="lazy" /></a>
                                                <span class="prod-badge">Bestseller</span>
                                                <button type="button" class="wish-btn" aria-label="Add to wishlist">
                                                    <i class="fa-regular fa-heart"></i>
                                                </button>
                                            </div>
                                            <div class="prod-info">
                                                <h4 class="prod-brand">Parijat Handicraft</h4>
                                                <p class="prod-name">
                                                    <a href="product-detail.html">Handmade Brass Oil Lamp</a>
                                                </p>
                                                <div class="prod-price">
                                                    <span class="price-now">$229</span>
                                                    <span class="price-old">$279</span>
                                                    <span class="price-off">(18% OFF)</span>
                                                </div>
                                                <div class="prod-btns">
                                                    <button type="button" class="btn btn-outline-black" data-id="SKU-P1"
                                                        data-name="Handmade Brass Oil Lamp" data-toast-title="Added to Cart"
                                                        data-toast-text="Handmade Brass Oil Lamp has been added to your cart."
                                                        data-toast-type="success">
                                                        Add to Cart
                                                    </button>
                                                    <a href="product-detail.html" class="btn btn-primary">Buy Now</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>

                                    <div class="swiper-slide">
                                        <article class="prod_cart">
                                            <div class="prod-img">
                                                <a href="product-detail.html" class="prod-link"><img
                                                        src="assets/images/home/cat5.png" alt="Antique Brass Lock"
                                                        loading="lazy" /></a>
                                                <button type="button" class="wish-btn" aria-label="Add to wishlist">
                                                    <i class="fa-regular fa-heart"></i>
                                                </button>
                                            </div>
                                            <div class="prod-info">
                                                <h4 class="prod-brand">Parijat Handicraft</h4>
                                                <p class="prod-name">
                                                    <a href="product-detail.html">Antique Brass Lock</a>
                                                </p>
                                                <div class="prod-price">
                                                    <span class="price-now">$135</span>
                                                    <span class="price-old">$159</span>
                                                    <span class="price-off">(15% OFF)</span>
                                                </div>
                                                <div class="prod-btns">
                                                    <button type="button" class="btn btn-outline-black" data-id="SKU-P8"
                                                        data-name="Antique Brass Lock" data-toast-title="Added to Cart"
                                                        data-toast-text="Antique Brass Lock has been added to your cart."
                                                        data-toast-type="success">
                                                        Add to Cart
                                                    </button>
                                                    <a href="product-detail.html" class="btn btn-primary">Buy Now</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>

                                    <div class="swiper-slide">
                                        <article class="prod_cart">
                                            <div class="prod-img">
                                                <a href="product-detail.html" class="prod-link"><img
                                                        src="assets/images/home/cat4.png" alt="Brass Lotus Kuber Diya"
                                                        loading="lazy" /></a>
                                                <span class="prod-badge">Bestseller</span>
                                                <button type="button" class="wish-btn" aria-label="Add to wishlist">
                                                    <i class="fa-regular fa-heart"></i>
                                                </button>
                                            </div>
                                            <div class="prod-info">
                                                <h4 class="prod-brand">Parijat Handicraft</h4>
                                                <p class="prod-name">
                                                    <a href="product-detail.html">Brass Lotus Kuber Diya</a>
                                                </p>
                                                <div class="prod-price">
                                                    <span class="price-now">$179</span>
                                                    <span class="price-old">$209</span>
                                                    <span class="price-off">(14% OFF)</span>
                                                </div>
                                                <div class="prod-btns">
                                                    <button type="button" class="btn btn-outline-black" data-id="SKU-P5"
                                                        data-name="Brass Lotus Kuber Diya" data-toast-title="Added to Cart"
                                                        data-toast-text="Brass Lotus Kuber Diya has been added to your cart."
                                                        data-toast-type="success">
                                                        Add to Cart
                                                    </button>
                                                    <a href="product-detail.html" class="btn btn-primary">Buy Now</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
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

                    <!-- ============ TAB 5 : KITCHEN & DINING ============ -->
                    <div class="tabs" data-tab="5">
                        <div class="swiper-wrap">
                            <div class="swiper fourSlider" data-mob="2" data-sm="3" data-lg="4" data-xl="5">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <article class="prod_cart">
                                            <div class="prod-img">
                                                <a href="product-detail.html" class="prod-link"><img
                                                        src="assets/images/home/cat3.png" alt="Hammered Copper Goblet"
                                                        loading="lazy" /></a>
                                                <button type="button" class="wish-btn" aria-label="Add to wishlist">
                                                    <i class="fa-regular fa-heart"></i>
                                                </button>
                                            </div>
                                            <div class="prod-info">
                                                <h4 class="prod-brand">Parijat Handicraft</h4>
                                                <p class="prod-name">
                                                    <a href="product-detail.html">Hammered Copper Goblet</a>
                                                </p>
                                                <div class="prod-price">
                                                    <span class="price-now">$125</span>
                                                    <span class="price-old">$149</span>
                                                    <span class="price-off">(16% OFF)</span>
                                                </div>
                                                <div class="prod-btns">
                                                    <button type="button" class="btn btn-outline-black" data-id="SKU-P4"
                                                        data-name="Hammered Copper Goblet" data-toast-title="Added to Cart"
                                                        data-toast-text="Hammered Copper Goblet has been added to your cart."
                                                        data-toast-type="success">
                                                        Add to Cart
                                                    </button>
                                                    <a href="product-detail.html" class="btn btn-primary">Buy Now</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>

                                    <div class="swiper-slide">
                                        <article class="prod_cart">
                                            <div class="prod-img">
                                                <a href="product-detail.html" class="prod-link"><img
                                                        src="assets/images/home/cat3.png" alt="Copper Water Bottle"
                                                        loading="lazy" /></a>
                                                <span class="prod-badge">Bestseller</span>
                                                <button type="button" class="wish-btn" aria-label="Add to wishlist">
                                                    <i class="fa-regular fa-heart"></i>
                                                </button>
                                            </div>
                                            <div class="prod-info">
                                                <h4 class="prod-brand">Parijat Handicraft</h4>
                                                <p class="prod-name">
                                                    <a href="product-detail.html">Copper Water Bottle</a>
                                                </p>
                                                <div class="prod-price">
                                                    <span class="price-now">$169</span>
                                                    <span class="price-old">$199</span>
                                                    <span class="price-off">(15% OFF)</span>
                                                </div>
                                                <div class="prod-btns">
                                                    <button type="button" class="btn btn-outline-black" data-id="SKU-P10"
                                                        data-name="Copper Water Bottle" data-toast-title="Added to Cart"
                                                        data-toast-text="Copper Water Bottle has been added to your cart."
                                                        data-toast-type="success">
                                                        Add to Cart
                                                    </button>
                                                    <a href="product-detail.html" class="btn btn-primary">Buy Now</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>

                                    <div class="swiper-slide">
                                        <article class="prod_cart">
                                            <div class="prod-img">
                                                <a href="product-detail.html" class="prod-link"><img
                                                        src="assets/images/home/cat3.png" alt="Copper Serving Bowl"
                                                        loading="lazy" /></a>
                                                <button type="button" class="wish-btn" aria-label="Add to wishlist">
                                                    <i class="fa-regular fa-heart"></i>
                                                </button>
                                            </div>
                                            <div class="prod-info">
                                                <h4 class="prod-brand">Parijat Handicraft</h4>
                                                <p class="prod-name">
                                                    <a href="product-detail.html">Copper Serving Bowl</a>
                                                </p>
                                                <div class="prod-price">
                                                    <span class="price-now">$219</span>
                                                    <span class="price-old">$269</span>
                                                    <span class="price-off">(19% OFF)</span>
                                                </div>
                                                <div class="prod-btns">
                                                    <button type="button" class="btn btn-outline-black" data-id="SKU-P15"
                                                        data-name="Copper Serving Bowl" data-toast-title="Added to Cart"
                                                        data-toast-text="Copper Serving Bowl has been added to your cart."
                                                        data-toast-type="success">
                                                        Add to Cart
                                                    </button>
                                                    <a href="product-detail.html" class="btn btn-primary">Buy Now</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>

                                    <div class="swiper-slide">
                                        <article class="prod_cart">
                                            <div class="prod-img">
                                                <a href="product-detail.html" class="prod-link"><img
                                                        src="assets/images/home/cat3.png" alt="Copper Jug with Tumblers"
                                                        loading="lazy" /></a>
                                                <span class="prod-badge">Limited Stock</span>
                                                <button type="button" class="wish-btn" aria-label="Add to wishlist">
                                                    <i class="fa-regular fa-heart"></i>
                                                </button>
                                            </div>
                                            <div class="prod-info">
                                                <h4 class="prod-brand">Parijat Handicraft</h4>
                                                <p class="prod-name">
                                                    <a href="product-detail.html">Copper Jug with Tumblers</a>
                                                </p>
                                                <div class="prod-price">
                                                    <span class="price-now">$399</span>
                                                    <span class="price-old">$479</span>
                                                    <span class="price-off">(17% OFF)</span>
                                                </div>
                                                <div class="prod-btns">
                                                    <button type="button" class="btn btn-outline-black" data-id="SKU-P11"
                                                        data-name="Copper Jug with Tumblers"
                                                        data-toast-title="Added to Cart"
                                                        data-toast-text="Copper Jug with Tumblers has been added to your cart."
                                                        data-toast-type="success">
                                                        Add to Cart
                                                    </button>
                                                    <a href="product-detail.html" class="btn btn-primary">Buy Now</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>

                                    <div class="swiper-slide">
                                        <article class="prod_cart">
                                            <div class="prod-img">
                                                <a href="product-detail.html" class="prod-link"><img
                                                        src="assets/images/home/cat3.png" alt="Hammered Copper Tumbler"
                                                        loading="lazy" /></a>
                                                <button type="button" class="wish-btn" aria-label="Add to wishlist">
                                                    <i class="fa-regular fa-heart"></i>
                                                </button>
                                            </div>
                                            <div class="prod-info">
                                                <h4 class="prod-brand">Parijat Handicraft</h4>
                                                <p class="prod-name">
                                                    <a href="product-detail.html">Hammered Copper Tumbler</a>
                                                </p>
                                                <div class="prod-price">
                                                    <span class="price-now">$99</span>
                                                    <span class="price-old">$129</span>
                                                    <span class="price-off">(23% OFF)</span>
                                                </div>
                                                <div class="prod-btns">
                                                    <button type="button" class="btn btn-outline-black" data-id="SKU-P13"
                                                        data-name="Hammered Copper Tumbler" data-toast-title="Added to Cart"
                                                        data-toast-text="Hammered Copper Tumbler has been added to your cart."
                                                        data-toast-type="success">
                                                        Add to Cart
                                                    </button>
                                                    <a href="product-detail.html" class="btn btn-primary">Buy Now</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
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
                </div>
            </div>
        </section>

        <section class="home-secM">
            <div class="container">
                <div class="sale-card">
                    <!-- PRODUCT IMAGE (blends into the gradient) -->
                    <figure class="sale-photo">
                        <img src="assets/images/home/offer1.jpg" alt="Handcrafted brass decor" loading="lazy" />
                    </figure>

                    <!-- LEFT : TEXT -->
                    <div class="sale-text">
                        <h3>Festive Sale now on!</h3>
                        <p>Score big savings on all your handcrafted favorites.</p>
                    </div>

                    <!-- CENTER : COUNTDOWN -->
                    <ul class="sale-timer" data-end="2026-12-31T23:59:59">
                        <li>
                            <b class="num" data-unit="days">00</b>
                            <span class="lbl">DAYS</span>
                        </li>
                        <li>
                            <b class="num" data-unit="hours">00</b>
                            <span class="lbl">HOUR</span>
                        </li>
                        <li>
                            <b class="num" data-unit="mins">00</b>
                            <span class="lbl">MINS</span>
                        </li>
                        <li>
                            <b class="num" data-unit="secs">00</b>
                            <span class="lbl">SECS</span>
                        </li>
                    </ul>

                    <!-- RIGHT : CODE + BUTTON -->
                    <div class="sale-action">
                        <button type="button" class="sale-code" data-code="PARIJAAT10" aria-label="Copy coupon code">
                            <i class="fa-regular fa-copy"></i>
                            <span>Use Code: PARIJAAT10</span>
                        </button>
                        <a href="javascript:void()" class="btn btn-white">Shop Sale</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="home-secG">
            <div class="container">
                <div class="spot-grid">
                    <!-- LEFT : SPOT MEDIA (overlay card) -->
                    <a href="product-listing.html" class="spot-media">
                        <figure class="spot-photo">
                            <picture><img src="assets/images/home/cat1.png" alt="Sacred Spaces" loading="lazy" /></picture>
                        </figure>
                        <span class="spot-tag">Featured Collection</span>
                        <div class="spot-info">
                            <small>Pooja Essentials</small>
                            <h4>Sacred Spaces</h4>
                            <p>
                                Brass idols, diyas and pooja thalis crafted to bring peace and
                                devotion to every corner of your home.
                            </p>
                            <span class="spot-cta">Shop Pooja Essentials <i class="fa-solid fa-arrow-right"></i></span>
                        </div>
                    </a>

                    <!-- RIGHT : CONTENT + SLIDER -->
                    <div class="spot-content">
                        <div class="heading left">
                            <small class="eyebrow">A CLOSER LOOK</small>
                            <h3>More Than Decor. A Piece of Art.</h3>
                            <p>
                                Discover the details, craftsmanship and character behind one
                                of our featured creations.
                            </p>
                        </div>

                        <div class="spot-collection">
                            <small>Featured Collection</small>
                            <h4>The Timeless Brass Collection</h4>
                            <p>
                                Beautifully detailed handcrafted pieces that add a distinctive
                                touch of heritage and elegance to your surroundings.
                            </p>
                        </div>

                        <!-- SLIDER -->
                        <div class="swiper-wrap spot-slider">
                            <div class="spot-strip">
                                <span>PIECES IN THIS COLLECTION</span>
                            </div>

                            <div class="swiper fourSlider" data-mob="3" data-sm="3" data-lg="4" data-xl="5">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <a href="product-listing.html" class="spot-card">
                                            <figure>
                                                <picture><img src="assets/images/home/cat1.png"
                                                        alt="Brass Idols &amp; Statues" loading="lazy" /></picture>
                                            </figure>
                                            <h5>Brass Idols &amp; Statues</h5>
                                            <span>12 items</span>
                                        </a>
                                    </div>

                                    <div class="swiper-slide">
                                        <a href="product-listing.html" class="spot-card">
                                            <figure>
                                                <picture><img src="assets/images/home/cat2.png" alt="Pooja Essentials"
                                                        loading="lazy" /></picture>
                                            </figure>
                                            <h5>Pooja Essentials</h5>
                                            <span>16 items</span>
                                        </a>
                                    </div>

                                    <div class="swiper-slide">
                                        <a href="product-listing.html" class="spot-card">
                                            <figure>
                                                <picture><img src="assets/images/home/cat3.png" alt="Copper Drinkware"
                                                        loading="lazy" /></picture>
                                            </figure>
                                            <h5>Copper Drinkware</h5>
                                            <span>18 items</span>
                                        </a>
                                    </div>

                                    <div class="swiper-slide">
                                        <a href="product-listing.html" class="spot-card">
                                            <figure>
                                                <picture><img src="assets/images/home/cat4.png"
                                                        alt="Brass Diyas &amp; Lamps" loading="lazy" /></picture>
                                            </figure>
                                            <h5>Brass Diyas &amp; Lamps</h5>
                                            <span>24 items</span>
                                        </a>
                                    </div>

                                    <div class="swiper-slide">
                                        <a href="product-listing.html" class="spot-card">
                                            <figure>
                                                <picture><img src="assets/images/home/cat5.png"
                                                        alt="Antique Locks &amp; Keys" loading="lazy" /></picture>
                                            </figure>
                                            <h5>Antique Locks &amp; Keys</h5>
                                            <span>08 items</span>
                                        </a>
                                    </div>

                                    <div class="swiper-slide">
                                        <a href="product-listing.html" class="spot-card">
                                            <figure>
                                                <picture><img src="assets/images/home/cat6.png"
                                                        alt="Bells &amp; Wind Chimes" loading="lazy" /></picture>
                                            </figure>
                                            <h5>Bells &amp; Wind Chimes</h5>
                                            <span>26 items</span>
                                        </a>
                                    </div>
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
                            <a href="product-detail.html" class="btn btn-primary">Explore This Creation</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="home-secC">
            <div class="container">
                <div class="story-grid">
                    <!-- LEFT : arch image + tilted detail photo + rotating badge -->
                    <div class="story-media">
                        <figure class="story-main">
                            <img src="assets/images/home/cat3.png" alt="Artisan shaping handcrafted pieces in a workshop"
                                loading="lazy" />
                        </figure>

                        <figure class="story-detail">
                            <img src="https://images.unsplash.com/photo-1610701596007-11502861dcfa?auto=format&fit=crop&w=600&q=80"
                                alt="Close-up of handcrafted brass detail" loading="lazy" />
                        </figure>

                        <div class="story-badge" aria-hidden="true">
                            <svg viewBox="0 0 120 120">
                                <defs>
                                    <path id="badgeCircle" d="M60,60 m-46,0 a46,46 0 1,1 92,0 a46,46 0 1,1 -92,0" />
                                </defs>
                                <text>
                                    <textPath href="#badgeCircle" textLength="286">
                                        HANDCRAFTED IN INDIA • HANDCRAFTED IN INDIA •
                                    </textPath>
                                </text>
                            </svg>
                            <i class="fa-solid fa-gem"></i>
                        </div>
                    </div>

                    <!-- RIGHT : content -->
                    <div class="story-content">
                        <div class="heading left">
                            <small class="eyebrow">Our Heritage, Your Home</small>
                            <h3>Crafted with Passion. Inspired by Tradition.</h3>
                            <p>
                                Every handcrafted creation tells a story of skill, patience
                                and artistic expression. At Parijaat Handicraft, we bring
                                together traditional inspiration and distinctive decorative
                                pieces to make everyday spaces feel special.
                            </p>
                        </div>

                        <ul class="story-pillars">
                            <li>
                                <div class="pillar-icon">
                                    <i class="fa-solid fa-hammer"></i>
                                </div>
                                <h4>Fine Craft</h4>
                                <p>Shaped with care and fine detail.</p>
                            </li>
                            <li>
                                <div class="pillar-icon">
                                    <i class="fa-solid fa-hourglass-half"></i>
                                </div>
                                <h4>Timeless Design</h4>
                                <p>Tradition made for modern homes.</p>
                            </li>
                            <li>
                                <div class="pillar-icon">
                                    <i class="fa-solid fa-wand-magic-sparkles"></i>
                                </div>
                                <h4>Unique Pieces</h4>
                                <p>Pieces that make homes special.</p>
                            </li>
                        </ul>

                        <div class="story-btns">
                            <a href="about.html" class="btn btn-primary">Discover Our Story</a>
                            <a href="product-listing.html" class="btn btn-outline-black">Explore Collection</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

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
                    <li data-tab="1" class="active">Recently Added</li>
                    <li data-tab="2">New Brass Creations</li>
                    <li data-tab="3">Home Decor</li>
                    <li data-tab="4">Gifts &amp; Collectibles</li>
                </ul>

                <div class="tab-nav-content">
                    <!-- ============ TAB 1 : RECENTLY ADDED ============ -->
                    <div class="tabs active" data-tab="1">
                        <div class="swiper-wrap">
                            <div class="swiper fourSlider" data-mob="2" data-sm="3" data-lg="4" data-xl="5">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <article class="prod_cart">
                                            <div class="prod-img">
                                                <a href="product-detail.html" class="prod-link"><img
                                                        src="assets/images/home/cat4.png" alt="Brass Peacock Diya"
                                                        loading="lazy" /></a>
                                                <span class="prod-badge">New</span>
                                                <button type="button" class="wish-btn" aria-label="Add to wishlist">
                                                    <i class="fa-regular fa-heart"></i>
                                                </button>
                                            </div>
                                            <div class="prod-info">
                                                <h4 class="prod-brand">Parijat Handicraft</h4>
                                                <p class="prod-name">
                                                    <a href="product-detail.html">Brass Peacock Diya</a>
                                                </p>
                                                <div class="prod-price">
                                                    <span class="price-now">$329</span>
                                                    <span class="price-old">$399</span>
                                                    <span class="price-off">(18% OFF)</span>
                                                </div>
                                                <div class="prod-btns">
                                                    <button type="button" class="btn btn-outline-black" data-id="SKU-P7"
                                                        data-name="Brass Peacock Diya" data-toast-title="Added to Cart"
                                                        data-toast-text="Brass Peacock Diya has been added to your cart."
                                                        data-toast-type="success">
                                                        Add to Cart
                                                    </button>
                                                    <a href="product-detail.html" class="btn btn-primary">Buy Now</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>

                                    <div class="swiper-slide">
                                        <article class="prod_cart">
                                            <div class="prod-img">
                                                <a href="product-detail.html" class="prod-link"><img
                                                        src="assets/images/home/cat5.png" alt="Antique Brass Lock"
                                                        loading="lazy" /></a>
                                                <span class="prod-badge">New</span>
                                                <button type="button" class="wish-btn" aria-label="Add to wishlist">
                                                    <i class="fa-regular fa-heart"></i>
                                                </button>
                                            </div>
                                            <div class="prod-info">
                                                <h4 class="prod-brand">Parijat Handicraft</h4>
                                                <p class="prod-name">
                                                    <a href="product-detail.html">Antique Brass Lock</a>
                                                </p>
                                                <div class="prod-price">
                                                    <span class="price-now">$135</span>
                                                    <span class="price-old">$159</span>
                                                    <span class="price-off">(15% OFF)</span>
                                                </div>
                                                <div class="prod-btns">
                                                    <button type="button" class="btn btn-outline-black" data-id="SKU-P8"
                                                        data-name="Antique Brass Lock" data-toast-title="Added to Cart"
                                                        data-toast-text="Antique Brass Lock has been added to your cart."
                                                        data-toast-type="success">
                                                        Add to Cart
                                                    </button>
                                                    <a href="product-detail.html" class="btn btn-primary">Buy Now</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>

                                    <div class="swiper-slide">
                                        <article class="prod_cart">
                                            <div class="prod-img">
                                                <a href="product-detail.html" class="prod-link"><img
                                                        src="assets/images/home/cat3.png" alt="Hammered Copper Tumbler"
                                                        loading="lazy" /></a>
                                                <button type="button" class="wish-btn" aria-label="Add to wishlist">
                                                    <i class="fa-regular fa-heart"></i>
                                                </button>
                                            </div>
                                            <div class="prod-info">
                                                <h4 class="prod-brand">Parijat Handicraft</h4>
                                                <p class="prod-name">
                                                    <a href="product-detail.html">Hammered Copper Tumbler</a>
                                                </p>
                                                <div class="prod-price">
                                                    <span class="price-now">$99</span>
                                                    <span class="price-old">$129</span>
                                                    <span class="price-off">(23% OFF)</span>
                                                </div>
                                                <div class="prod-btns">
                                                    <button type="button" class="btn btn-outline-black" data-id="SKU-P13"
                                                        data-name="Hammered Copper Tumbler" data-toast-title="Added to Cart"
                                                        data-toast-text="Hammered Copper Tumbler has been added to your cart."
                                                        data-toast-type="success">
                                                        Add to Cart
                                                    </button>
                                                    <a href="product-detail.html" class="btn btn-primary">Buy Now</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>

                                    <div class="swiper-slide">
                                        <article class="prod_cart">
                                            <div class="prod-img">
                                                <a href="product-detail.html" class="prod-link"><img
                                                        src="assets/images/home/cat6.png" alt="Brass Wind Chime"
                                                        loading="lazy" /></a>
                                                <span class="prod-badge">New</span>
                                                <button type="button" class="wish-btn" aria-label="Add to wishlist">
                                                    <i class="fa-regular fa-heart"></i>
                                                </button>
                                            </div>
                                            <div class="prod-info">
                                                <h4 class="prod-brand">Parijat Handicraft</h4>
                                                <p class="prod-name">
                                                    <a href="product-detail.html">Brass Wind Chime</a>
                                                </p>
                                                <div class="prod-price">
                                                    <span class="price-now">$249</span>
                                                    <span class="price-old">$299</span>
                                                    <span class="price-off">(17% OFF)</span>
                                                </div>
                                                <div class="prod-btns">
                                                    <button type="button" class="btn btn-outline-black" data-id="SKU-P9"
                                                        data-name="Brass Wind Chime" data-toast-title="Added to Cart"
                                                        data-toast-text="Brass Wind Chime has been added to your cart."
                                                        data-toast-type="success">
                                                        Add to Cart
                                                    </button>
                                                    <a href="product-detail.html" class="btn btn-primary">Buy Now</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>

                                    <div class="swiper-slide">
                                        <article class="prod_cart">
                                            <div class="prod-img">
                                                <a href="product-detail.html" class="prod-link"><img
                                                        src="assets/images/home/cat1.png" alt="Brass Elephant Figurine"
                                                        loading="lazy" /></a>
                                                <span class="prod-badge">New</span>
                                                <button type="button" class="wish-btn" aria-label="Add to wishlist">
                                                    <i class="fa-regular fa-heart"></i>
                                                </button>
                                            </div>
                                            <div class="prod-info">
                                                <h4 class="prod-brand">Parijat Handicraft</h4>
                                                <p class="prod-name">
                                                    <a href="product-detail.html">Brass Elephant Figurine</a>
                                                </p>
                                                <div class="prod-price">
                                                    <span class="price-now">$429</span>
                                                    <span class="price-old">$519</span>
                                                    <span class="price-off">(17% OFF)</span>
                                                </div>
                                                <div class="prod-btns">
                                                    <button type="button" class="btn btn-outline-black" data-id="SKU-P14"
                                                        data-name="Brass Elephant Figurine" data-toast-title="Added to Cart"
                                                        data-toast-text="Brass Elephant Figurine has been added to your cart."
                                                        data-toast-type="success">
                                                        Add to Cart
                                                    </button>
                                                    <a href="product-detail.html" class="btn btn-primary">Buy Now</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>

                                    <div class="swiper-slide">
                                        <article class="prod_cart">
                                            <div class="prod-img">
                                                <a href="product-detail.html" class="prod-link"><img
                                                        src="assets/images/home/cat3.png" alt="Hammered Copper Tumbler"
                                                        loading="lazy" /></a>
                                                <button type="button" class="wish-btn" aria-label="Add to wishlist">
                                                    <i class="fa-regular fa-heart"></i>
                                                </button>
                                            </div>
                                            <div class="prod-info">
                                                <h4 class="prod-brand">Parijat Handicraft</h4>
                                                <p class="prod-name">
                                                    <a href="product-detail.html">Hammered Copper Tumbler</a>
                                                </p>
                                                <div class="prod-price">
                                                    <span class="price-now">$99</span>
                                                    <span class="price-old">$129</span>
                                                    <span class="price-off">(23% OFF)</span>
                                                </div>
                                                <div class="prod-btns">
                                                    <button type="button" class="btn btn-outline-black" data-id="SKU-P13"
                                                        data-name="Hammered Copper Tumbler" data-toast-title="Added to Cart"
                                                        data-toast-text="Hammered Copper Tumbler has been added to your cart."
                                                        data-toast-type="success">
                                                        Add to Cart
                                                    </button>
                                                    <a href="product-detail.html" class="btn btn-primary">Buy Now</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
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

                    <!-- ============ TAB 2 : NEW BRASS CREATIONS ============ -->
                    <div class="tabs" data-tab="2">
                        <div class="swiper-wrap">
                            <div class="swiper fourSlider" data-mob="2" data-sm="3" data-lg="4" data-xl="5">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <article class="prod_cart">
                                            <div class="prod-img">
                                                <a href="product-detail.html" class="prod-link"><img
                                                        src="assets/images/home/cat1.png" alt="Brass Elephant Figurine"
                                                        loading="lazy" /></a>
                                                <span class="prod-badge">New</span>
                                                <button type="button" class="wish-btn" aria-label="Add to wishlist">
                                                    <i class="fa-regular fa-heart"></i>
                                                </button>
                                            </div>
                                            <div class="prod-info">
                                                <h4 class="prod-brand">Parijat Handicraft</h4>
                                                <p class="prod-name">
                                                    <a href="product-detail.html">Brass Elephant Figurine</a>
                                                </p>
                                                <div class="prod-price">
                                                    <span class="price-now">$429</span>
                                                    <span class="price-old">$519</span>
                                                    <span class="price-off">(17% OFF)</span>
                                                </div>
                                                <div class="prod-btns">
                                                    <button type="button" class="btn btn-outline-black" data-id="SKU-P14"
                                                        data-name="Brass Elephant Figurine" data-toast-title="Added to Cart"
                                                        data-toast-text="Brass Elephant Figurine has been added to your cart."
                                                        data-toast-type="success">
                                                        Add to Cart
                                                    </button>
                                                    <a href="product-detail.html" class="btn btn-primary">Buy Now</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>

                                    <div class="swiper-slide">
                                        <article class="prod_cart">
                                            <div class="prod-img">
                                                <a href="product-detail.html" class="prod-link"><img
                                                        src="assets/images/home/cat2.png" alt="Brass Aladdin Incense Burner"
                                                        loading="lazy" /></a>
                                                <span class="prod-badge">New</span>
                                                <button type="button" class="wish-btn" aria-label="Add to wishlist">
                                                    <i class="fa-regular fa-heart"></i>
                                                </button>
                                            </div>
                                            <div class="prod-info">
                                                <h4 class="prod-brand">Parijat Handicraft</h4>
                                                <p class="prod-name">
                                                    <a href="product-detail.html">Brass Aladdin Incense Burner</a>
                                                </p>
                                                <div class="prod-price">
                                                    <span class="price-now">$129</span>
                                                    <span class="price-old">$159</span>
                                                    <span class="price-off">(19% OFF)</span>
                                                </div>
                                                <div class="prod-btns">
                                                    <button type="button" class="btn btn-outline-black" data-id="SKU-P2"
                                                        data-name="Brass Aladdin Incense Burner"
                                                        data-toast-title="Added to Cart"
                                                        data-toast-text="Brass Aladdin Incense Burner has been added to your cart."
                                                        data-toast-type="success">
                                                        Add to Cart
                                                    </button>
                                                    <a href="product-detail.html" class="btn btn-primary">Buy Now</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>

                                    <div class="swiper-slide">
                                        <article class="prod_cart">
                                            <div class="prod-img">
                                                <a href="product-detail.html" class="prod-link"><img
                                                        src="assets/images/home/cat4.png" alt="Brass Lotus Kuber Diya"
                                                        loading="lazy" /></a>
                                                <button type="button" class="wish-btn" aria-label="Add to wishlist">
                                                    <i class="fa-regular fa-heart"></i>
                                                </button>
                                            </div>
                                            <div class="prod-info">
                                                <h4 class="prod-brand">Parijat Handicraft</h4>
                                                <p class="prod-name">
                                                    <a href="product-detail.html">Brass Lotus Kuber Diya</a>
                                                </p>
                                                <div class="prod-price">
                                                    <span class="price-now">$179</span>
                                                    <span class="price-old">$209</span>
                                                    <span class="price-off">(14% OFF)</span>
                                                </div>
                                                <div class="prod-btns">
                                                    <button type="button" class="btn btn-outline-black" data-id="SKU-P5"
                                                        data-name="Brass Lotus Kuber Diya" data-toast-title="Added to Cart"
                                                        data-toast-text="Brass Lotus Kuber Diya has been added to your cart."
                                                        data-toast-type="success">
                                                        Add to Cart
                                                    </button>
                                                    <a href="product-detail.html" class="btn btn-primary">Buy Now</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>

                                    <div class="swiper-slide">
                                        <article class="prod_cart">
                                            <div class="prod-img">
                                                <a href="product-detail.html" class="prod-link"><img
                                                        src="assets/images/home/cat6.png" alt="Brass Temple Bell"
                                                        loading="lazy" /></a>
                                                <span class="prod-badge">New</span>
                                                <button type="button" class="wish-btn" aria-label="Add to wishlist">
                                                    <i class="fa-regular fa-heart"></i>
                                                </button>
                                            </div>
                                            <div class="prod-info">
                                                <h4 class="prod-brand">Parijat Handicraft</h4>
                                                <p class="prod-name">
                                                    <a href="product-detail.html">Brass Temple Bell</a>
                                                </p>
                                                <div class="prod-price">
                                                    <span class="price-now">$199</span>
                                                    <span class="price-old">$249</span>
                                                    <span class="price-off">(20% OFF)</span>
                                                </div>
                                                <div class="prod-btns">
                                                    <button type="button" class="btn btn-outline-black" data-id="SKU-P12"
                                                        data-name="Brass Temple Bell" data-toast-title="Added to Cart"
                                                        data-toast-text="Brass Temple Bell has been added to your cart."
                                                        data-toast-type="success">
                                                        Add to Cart
                                                    </button>
                                                    <a href="product-detail.html" class="btn btn-primary">Buy Now</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>

                                    <div class="swiper-slide">
                                        <article class="prod_cart">
                                            <div class="prod-img">
                                                <a href="product-detail.html" class="prod-link"><img
                                                        src="assets/images/home/cat4.png" alt="Brass Peacock Diya"
                                                        loading="lazy" /></a>
                                                <span class="prod-badge">New</span>
                                                <button type="button" class="wish-btn" aria-label="Add to wishlist">
                                                    <i class="fa-regular fa-heart"></i>
                                                </button>
                                            </div>
                                            <div class="prod-info">
                                                <h4 class="prod-brand">Parijat Handicraft</h4>
                                                <p class="prod-name">
                                                    <a href="product-detail.html">Brass Peacock Diya</a>
                                                </p>
                                                <div class="prod-price">
                                                    <span class="price-now">$329</span>
                                                    <span class="price-old">$399</span>
                                                    <span class="price-off">(18% OFF)</span>
                                                </div>
                                                <div class="prod-btns">
                                                    <button type="button" class="btn btn-outline-black" data-id="SKU-P7"
                                                        data-name="Brass Peacock Diya" data-toast-title="Added to Cart"
                                                        data-toast-text="Brass Peacock Diya has been added to your cart."
                                                        data-toast-type="success">
                                                        Add to Cart
                                                    </button>
                                                    <a href="product-detail.html" class="btn btn-primary">Buy Now</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
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

                    <!-- ============ TAB 3 : HOME DECOR ============ -->
                    <div class="tabs" data-tab="3">
                        <div class="swiper-wrap">
                            <div class="swiper fourSlider" data-mob="2" data-sm="3" data-lg="4" data-xl="5">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <article class="prod_cart">
                                            <div class="prod-img">
                                                <a href="product-detail.html" class="prod-link"><img
                                                        src="assets/images/home/cat1.png"
                                                        alt="Brass Decorative Rabbit Figurine" loading="lazy" /></a>
                                                <span class="prod-badge">New</span>
                                                <button type="button" class="wish-btn" aria-label="Add to wishlist">
                                                    <i class="fa-regular fa-heart"></i>
                                                </button>
                                            </div>
                                            <div class="prod-info">
                                                <h4 class="prod-brand">Parijat Handicraft</h4>
                                                <p class="prod-name">
                                                    <a href="product-detail.html">Brass Decorative Rabbit Figurine</a>
                                                </p>
                                                <div class="prod-price">
                                                    <span class="price-now">$389</span>
                                                    <span class="price-old">$459</span>
                                                    <span class="price-off">(15% OFF)</span>
                                                </div>
                                                <div class="prod-btns">
                                                    <button type="button" class="btn btn-outline-black" data-id="SKU-P3"
                                                        data-name="Brass Decorative Rabbit Figurine"
                                                        data-toast-title="Added to Cart"
                                                        data-toast-text="Brass Decorative Rabbit Figurine has been added to your cart."
                                                        data-toast-type="success">
                                                        Add to Cart
                                                    </button>
                                                    <a href="product-detail.html" class="btn btn-primary">Buy Now</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>

                                    <div class="swiper-slide">
                                        <article class="prod_cart">
                                            <div class="prod-img">
                                                <a href="product-detail.html" class="prod-link"><img
                                                        src="assets/images/home/cat6.png" alt="Brass Wind Chime"
                                                        loading="lazy" /></a>
                                                <button type="button" class="wish-btn" aria-label="Add to wishlist">
                                                    <i class="fa-regular fa-heart"></i>
                                                </button>
                                            </div>
                                            <div class="prod-info">
                                                <h4 class="prod-brand">Parijat Handicraft</h4>
                                                <p class="prod-name">
                                                    <a href="product-detail.html">Brass Wind Chime</a>
                                                </p>
                                                <div class="prod-price">
                                                    <span class="price-now">$249</span>
                                                    <span class="price-old">$299</span>
                                                    <span class="price-off">(17% OFF)</span>
                                                </div>
                                                <div class="prod-btns">
                                                    <button type="button" class="btn btn-outline-black" data-id="SKU-P9"
                                                        data-name="Brass Wind Chime" data-toast-title="Added to Cart"
                                                        data-toast-text="Brass Wind Chime has been added to your cart."
                                                        data-toast-type="success">
                                                        Add to Cart
                                                    </button>
                                                    <a href="product-detail.html" class="btn btn-primary">Buy Now</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>

                                    <div class="swiper-slide">
                                        <article class="prod_cart">
                                            <div class="prod-img">
                                                <a href="product-detail.html" class="prod-link"><img
                                                        src="assets/images/home/cat4.png" alt="Handmade Brass Oil Lamp"
                                                        loading="lazy" /></a>
                                                <span class="prod-badge">New</span>
                                                <button type="button" class="wish-btn" aria-label="Add to wishlist">
                                                    <i class="fa-regular fa-heart"></i>
                                                </button>
                                            </div>
                                            <div class="prod-info">
                                                <h4 class="prod-brand">Parijat Handicraft</h4>
                                                <p class="prod-name">
                                                    <a href="product-detail.html">Handmade Brass Oil Lamp</a>
                                                </p>
                                                <div class="prod-price">
                                                    <span class="price-now">$229</span>
                                                    <span class="price-old">$279</span>
                                                    <span class="price-off">(18% OFF)</span>
                                                </div>
                                                <div class="prod-btns">
                                                    <button type="button" class="btn btn-outline-black" data-id="SKU-P1"
                                                        data-name="Handmade Brass Oil Lamp" data-toast-title="Added to Cart"
                                                        data-toast-text="Handmade Brass Oil Lamp has been added to your cart."
                                                        data-toast-type="success">
                                                        Add to Cart
                                                    </button>
                                                    <a href="product-detail.html" class="btn btn-primary">Buy Now</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>

                                    <div class="swiper-slide">
                                        <article class="prod_cart">
                                            <div class="prod-img">
                                                <a href="product-detail.html" class="prod-link"><img
                                                        src="assets/images/home/cat5.png" alt="Antique Brass Lock"
                                                        loading="lazy" /></a>
                                                <button type="button" class="wish-btn" aria-label="Add to wishlist">
                                                    <i class="fa-regular fa-heart"></i>
                                                </button>
                                            </div>
                                            <div class="prod-info">
                                                <h4 class="prod-brand">Parijat Handicraft</h4>
                                                <p class="prod-name">
                                                    <a href="product-detail.html">Antique Brass Lock</a>
                                                </p>
                                                <div class="prod-price">
                                                    <span class="price-now">$135</span>
                                                    <span class="price-old">$159</span>
                                                    <span class="price-off">(15% OFF)</span>
                                                </div>
                                                <div class="prod-btns">
                                                    <button type="button" class="btn btn-outline-black" data-id="SKU-P8"
                                                        data-name="Antique Brass Lock" data-toast-title="Added to Cart"
                                                        data-toast-text="Antique Brass Lock has been added to your cart."
                                                        data-toast-type="success">
                                                        Add to Cart
                                                    </button>
                                                    <a href="product-detail.html" class="btn btn-primary">Buy Now</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>

                                    <div class="swiper-slide">
                                        <article class="prod_cart">
                                            <div class="prod-img">
                                                <a href="product-detail.html" class="prod-link"><img
                                                        src="assets/images/home/cat2.png" alt="Brass Aladdin Incense Burner"
                                                        loading="lazy" /></a>
                                                <span class="prod-badge">New</span>
                                                <button type="button" class="wish-btn" aria-label="Add to wishlist">
                                                    <i class="fa-regular fa-heart"></i>
                                                </button>
                                            </div>
                                            <div class="prod-info">
                                                <h4 class="prod-brand">Parijat Handicraft</h4>
                                                <p class="prod-name">
                                                    <a href="product-detail.html">Brass Aladdin Incense Burner</a>
                                                </p>
                                                <div class="prod-price">
                                                    <span class="price-now">$129</span>
                                                    <span class="price-old">$159</span>
                                                    <span class="price-off">(19% OFF)</span>
                                                </div>
                                                <div class="prod-btns">
                                                    <button type="button" class="btn btn-outline-black" data-id="SKU-P2"
                                                        data-name="Brass Aladdin Incense Burner"
                                                        data-toast-title="Added to Cart"
                                                        data-toast-text="Brass Aladdin Incense Burner has been added to your cart."
                                                        data-toast-type="success">
                                                        Add to Cart
                                                    </button>
                                                    <a href="product-detail.html" class="btn btn-primary">Buy Now</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
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

                    <!-- ============ TAB 4 : GIFTS & COLLECTIBLES ============ -->
                    <div class="tabs" data-tab="4">
                        <div class="swiper-wrap">
                            <div class="swiper fourSlider" data-mob="2" data-sm="3" data-lg="4" data-xl="5">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <article class="prod_cart">
                                            <div class="prod-img">
                                                <a href="product-detail.html" class="prod-link"><img
                                                        src="assets/images/home/cat3.png" alt="Copper Goblet Gift Set"
                                                        loading="lazy" /></a>
                                                <span class="prod-badge">New</span>
                                                <button type="button" class="wish-btn" aria-label="Add to wishlist">
                                                    <i class="fa-regular fa-heart"></i>
                                                </button>
                                            </div>
                                            <div class="prod-info">
                                                <h4 class="prod-brand">Parijat Handicraft</h4>
                                                <p class="prod-name">
                                                    <a href="product-detail.html">Copper Goblet Gift Set</a>
                                                </p>
                                                <div class="prod-price">
                                                    <span class="price-now">$449</span>
                                                    <span class="price-old">$529</span>
                                                    <span class="price-off">(15% OFF)</span>
                                                </div>
                                                <div class="prod-btns">
                                                    <button type="button" class="btn btn-outline-black" data-id="SKU-P16"
                                                        data-name="Copper Goblet Gift Set" data-toast-title="Added to Cart"
                                                        data-toast-text="Copper Goblet Gift Set has been added to your cart."
                                                        data-toast-type="success">
                                                        Add to Cart
                                                    </button>
                                                    <a href="product-detail.html" class="btn btn-primary">Buy Now</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>

                                    <div class="swiper-slide">
                                        <article class="prod_cart">
                                            <div class="prod-img">
                                                <a href="product-detail.html" class="prod-link"><img
                                                        src="assets/images/home/cat2.png" alt="Brass Aladdin Incense Burner"
                                                        loading="lazy" /></a>
                                                <button type="button" class="wish-btn" aria-label="Add to wishlist">
                                                    <i class="fa-regular fa-heart"></i>
                                                </button>
                                            </div>
                                            <div class="prod-info">
                                                <h4 class="prod-brand">Parijat Handicraft</h4>
                                                <p class="prod-name">
                                                    <a href="product-detail.html">Brass Aladdin Incense Burner</a>
                                                </p>
                                                <div class="prod-price">
                                                    <span class="price-now">$129</span>
                                                    <span class="price-old">$159</span>
                                                    <span class="price-off">(19% OFF)</span>
                                                </div>
                                                <div class="prod-btns">
                                                    <button type="button" class="btn btn-outline-black" data-id="SKU-P2"
                                                        data-name="Brass Aladdin Incense Burner"
                                                        data-toast-title="Added to Cart"
                                                        data-toast-text="Brass Aladdin Incense Burner has been added to your cart."
                                                        data-toast-type="success">
                                                        Add to Cart
                                                    </button>
                                                    <a href="product-detail.html" class="btn btn-primary">Buy Now</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>

                                    <div class="swiper-slide">
                                        <article class="prod_cart">
                                            <div class="prod-img">
                                                <a href="product-detail.html" class="prod-link"><img
                                                        src="assets/images/home/cat4.png" alt="Brass Lotus Kuber Diya"
                                                        loading="lazy" /></a>
                                                <span class="prod-badge">New</span>
                                                <button type="button" class="wish-btn" aria-label="Add to wishlist">
                                                    <i class="fa-regular fa-heart"></i>
                                                </button>
                                            </div>
                                            <div class="prod-info">
                                                <h4 class="prod-brand">Parijat Handicraft</h4>
                                                <p class="prod-name">
                                                    <a href="product-detail.html">Brass Lotus Kuber Diya</a>
                                                </p>
                                                <div class="prod-price">
                                                    <span class="price-now">$179</span>
                                                    <span class="price-old">$209</span>
                                                    <span class="price-off">(14% OFF)</span>
                                                </div>
                                                <div class="prod-btns">
                                                    <button type="button" class="btn btn-outline-black" data-id="SKU-P5"
                                                        data-name="Brass Lotus Kuber Diya" data-toast-title="Added to Cart"
                                                        data-toast-text="Brass Lotus Kuber Diya has been added to your cart."
                                                        data-toast-type="success">
                                                        Add to Cart
                                                    </button>
                                                    <a href="product-detail.html" class="btn btn-primary">Buy Now</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>

                                    <div class="swiper-slide">
                                        <article class="prod_cart">
                                            <div class="prod-img">
                                                <a href="product-detail.html" class="prod-link"><img
                                                        src="assets/images/home/cat1.png" alt="Brass Elephant Diya Stand"
                                                        loading="lazy" /></a>
                                                <button type="button" class="wish-btn" aria-label="Add to wishlist">
                                                    <i class="fa-regular fa-heart"></i>
                                                </button>
                                            </div>
                                            <div class="prod-info">
                                                <h4 class="prod-brand">Parijat Handicraft</h4>
                                                <p class="prod-name">
                                                    <a href="product-detail.html">Brass Elephant Diya Stand</a>
                                                </p>
                                                <div class="prod-price">
                                                    <span class="price-now">$259</span>
                                                    <span class="price-old">$309</span>
                                                    <span class="price-off">(16% OFF)</span>
                                                </div>
                                                <div class="prod-btns">
                                                    <button type="button" class="btn btn-outline-black" data-id="SKU-P6"
                                                        data-name="Brass Elephant Diya Stand"
                                                        data-toast-title="Added to Cart"
                                                        data-toast-text="Brass Elephant Diya Stand has been added to your cart."
                                                        data-toast-type="success">
                                                        Add to Cart
                                                    </button>
                                                    <a href="product-detail.html" class="btn btn-primary">Buy Now</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>

                                    <div class="swiper-slide">
                                        <article class="prod_cart">
                                            <div class="prod-img">
                                                <a href="product-detail.html" class="prod-link"><img
                                                        src="assets/images/home/cat3.png" alt="Hammered Copper Goblet"
                                                        loading="lazy" /></a>
                                                <span class="prod-badge">New</span>
                                                <button type="button" class="wish-btn" aria-label="Add to wishlist">
                                                    <i class="fa-regular fa-heart"></i>
                                                </button>
                                            </div>
                                            <div class="prod-info">
                                                <h4 class="prod-brand">Parijat Handicraft</h4>
                                                <p class="prod-name">
                                                    <a href="product-detail.html">Hammered Copper Goblet</a>
                                                </p>
                                                <div class="prod-price">
                                                    <span class="price-now">$125</span>
                                                    <span class="price-old">$149</span>
                                                    <span class="price-off">(16% OFF)</span>
                                                </div>
                                                <div class="prod-btns">
                                                    <button type="button" class="btn btn-outline-black" data-id="SKU-P4"
                                                        data-name="Hammered Copper Goblet" data-toast-title="Added to Cart"
                                                        data-toast-text="Hammered Copper Goblet has been added to your cart."
                                                        data-toast-type="success">
                                                        Add to Cart
                                                    </button>
                                                    <a href="product-detail.html" class="btn btn-primary">Buy Now</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
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
                </div>
            </div>
        </section>

        <section class="home-secE">
            <div class="container">
                <div class="heading">
                    <small class="eyebrow">OFFERS &amp; DEALS</small>
                    <h3>Festive Offers, Handpicked for You.</h3>
                    <p>
                        Special savings on handcrafted pieces for every celebration and
                        every home.
                    </p>
                </div>

                <div class="offer-cards">
                    <!-- FEATURE (big) -->
                    <article class="offer-card offer-feature">
                        <figure class="offer-img">
                            <picture><img src="assets/images/home/diwali_7_11zon.png" alt="Diwali Offers" loading="lazy" />
                            </picture>
                        </figure>
                        <div class="offer-badge">
                            <strong>40%</strong><small>OFF</small>
                        </div>
                        <div class="offer-info">
                            <h4>Diwali Offers</h4>
                            <p>
                                Light up your celebrations with handcrafted brass decor at
                                festive prices.
                            </p>
                            <a href="javascript:void(0)" class="btn btn-white">
                                EXPLORE DIWALI EDIT <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    </article>

                    <!-- SLIDER (2 cards in a row) -->
                    <div class="swiper-wrap offer-slider">
                        <div class="swiper offerSlider">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <a href="javascript:void(0)" class="offer-card">
                                        <figure class="offer-img">
                                            <picture><img src="assets/images/home/jam_6_11zon.png"
                                                    alt="Krishna Janmashtami Festival Offers" loading="lazy" /></picture>
                                        </figure>
                                        <div class="offer-badge">
                                            <strong>40%</strong><small>OFF</small>
                                        </div>
                                        <div class="offer-info">
                                            <h4>Janmashtami Offers</h4>
                                            <div class="offer-link">
                                                <em>Shop Now</em>
                                                <i class="fa-solid fa-arrow-right"></i>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="swiper-slide">
                                    <a href="javascript:void(0)" class="offer-card">
                                        <figure class="offer-img">
                                            <picture><img src="assets/images/home/free_5_11zon.png" alt="Free Shipping"
                                                    loading="lazy" /></picture>
                                        </figure>
                                        <div class="offer-badge">
                                            <strong>FREE</strong><small>SHIPPING</small>
                                        </div>
                                        <div class="offer-info">
                                            <h4>Free Shipping</h4>
                                            <div class="offer-link">
                                                <em>Shop Now</em>
                                                <i class="fa-solid fa-arrow-right"></i>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="swiper-slide">
                                    <a href="javascript:void(0)" class="offer-card">
                                        <figure class="offer-img">
                                            <picture><img src="assets/images/home/bressbell_1_11zon.png" alt="Best Selling"
                                                    loading="lazy" /></picture>
                                        </figure>
                                        <div class="offer-badge">
                                            <strong>40%</strong><small>OFF</small>
                                        </div>
                                        <div class="offer-info">
                                            <h4>Best Selling</h4>
                                            <div class="offer-link">
                                                <em>Shop Now</em>
                                                <i class="fa-solid fa-arrow-right"></i>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="swiper-slide">
                                    <a href="javascript:void(0)" class="offer-card">
                                        <figure class="offer-img">
                                            <picture><img src="assets/images/home/door_3_11zon.png" alt="Door Lock"
                                                    loading="lazy" /></picture>
                                        </figure>
                                        <div class="offer-badge">
                                            <strong>40%</strong><small>OFF</small>
                                        </div>
                                        <div class="offer-info">
                                            <h4>Door Lock</h4>
                                            <div class="offer-link">
                                                <em>Shop Now</em>
                                                <i class="fa-solid fa-arrow-right"></i>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="swiper-slide">
                                    <a href="javascript:void(0)" class="offer-card">
                                        <figure class="offer-img">
                                            <picture><img src="assets/images/home/pro30.jpg" alt="Brass Bell"
                                                    loading="lazy" /></picture>
                                        </figure>
                                        <div class="offer-badge">
                                            <strong>40%</strong><small>OFF</small>
                                        </div>
                                        <div class="offer-info">
                                            <h4>Brass Bell</h4>
                                            <div class="offer-link">
                                                <em>Shop Now</em>
                                                <i class="fa-solid fa-arrow-right"></i>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="swiper-slide">
                                    <a href="javascript:void(0)" class="offer-card">
                                        <figure class="offer-img">
                                            <picture><img src="assets/images/home/dinner_2_11zon.png" alt="Dinner Set"
                                                    loading="lazy" /></picture>
                                        </figure>
                                        <div class="offer-badge">
                                            <strong>40%</strong><small>OFF</small>
                                        </div>
                                        <div class="offer-info">
                                            <h4>Dinner Set</h4>
                                            <div class="offer-link">
                                                <em>Shop Now</em>
                                                <i class="fa-solid fa-arrow-right"></i>
                                            </div>
                                        </div>
                                    </a>
                                </div>
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

                <!-- COUPONS -->
                <div class="coupon-strip">
                    <div class="strip-head"><span>COUPONS &amp; DEALS</span></div>
                    <div class="coupon-list">
                        <div class="coupon-tile">
                            <div class="coupon-text">
                                <strong>WELCOME10</strong>
                                <p>Extra 40% off on your first order.</p>
                            </div>
                            <button type="button" class="copy-btn" data-code="WELCOME10">
                                COPY CODE
                            </button>
                        </div>

                        <div class="coupon-tile">
                            <div class="coupon-text">
                                <strong>FESTIVE20</strong>
                                <p>Flat 40% off on selected festive offers.</p>
                            </div>
                            <button type="button" class="copy-btn" data-code="FESTIVE20">
                                COPY CODE
                            </button>
                        </div>

                        <div class="coupon-tile">
                            <div class="coupon-text">
                                <strong>FREESHIP</strong>
                                <p>Free shipping on orders above ₹2,999.</p>
                            </div>
                            <button type="button" class="copy-btn" data-code="FREESHIP">
                                COPY CODE
                            </button>
                        </div>
                    </div>
                    <p class="coupon-note">
                        *Terms &amp; conditions apply. Offers valid for a limited time.
                    </p>
                </div>
            </div>
        </section>

        <section class="home-secF">
            <div class="container">
                <div class="craft-grid">
                    <!-- LEFT : HEADING + BUTTONS + CHIPS -->
                    <div class="craft-head">
                        <div class="heading left">
                            <small class="eyebrow">CURATED FOR EVERY SPACE</small>
                            <h3>Discover Your Kind of Craft.</h3>
                            <p>
                                From sacred corners to beautifully styled interiors, explore
                                collections that make every space more personal.
                            </p>
                        </div>
                        <div class="craft-btns">
                            <a href="product-listing.html" class="btn btn-primary">Explore Collections</a>
                            <a href="product-listing.html" class="btn btn-outline-black">Shop All Decor</a>
                        </div>
                        <ul class="craft-tags">
                            <li>Pooja Essentials</li>
                            <li>Brass Decor</li>
                            <li>Sculptures</li>
                            <li>Tableware</li>
                        </ul>
                    </div>

                    <!-- RIGHT : WIDE FEATURE -->
                    <a href="product-listing.html" class="craft-feature">
                        <figure class="craft-feature-img">
                            <picture><img src="assets/images/home/cat1.png" alt="Sacred Spaces" loading="lazy" /></picture>
                        </figure>
                        <span class="craft-tag">Featured Collection</span>
                        <div class="craft-feature-info">
                            <small>Pooja Essentials</small>
                            <h4>Sacred Spaces</h4>
                            <p>
                                Brass idols, diyas and pooja thalis crafted to bring peace and
                                devotion to every corner of your home.
                            </p>
                            <span class="craft-cta">Shop Pooja Essentials <i class="fa-solid fa-arrow-right"></i></span>
                        </div>
                    </a>

                    <!-- BOTTOM : SWIPER -->
                    <div class="swiper-wrap craft-slider">
                        <div class="craft-strip"><span>MORE COLLECTIONS</span></div>

                        <div class="swiper fourSlider" data-mob="2" data-sm="3" data-lg="4" data-xl="5">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <a href="product-listing.html" class="craft-card">
                                        <figure class="craft-img">
                                            <picture><img src="assets/images/home/cat1.png" alt="Timeless Interiors"
                                                    loading="lazy" /></picture>
                                        </figure>
                                        <span class="craft-no">01</span>
                                        <div class="craft-body">
                                            <div class="craft-text">
                                                <h4>Timeless Interiors</h4>
                                                <p>
                                                    Brass home decor that adds warmth and character.
                                                </p>
                                            </div>
                                            <i class="fa-solid fa-arrow-right"></i>
                                        </div>
                                    </a>
                                </div>

                                <div class="swiper-slide">
                                    <a href="product-listing.html" class="craft-card">
                                        <figure class="craft-img">
                                            <picture><img src="assets/images/home/cat2.png" alt="Artful Living"
                                                    loading="lazy" /></picture>
                                        </figure>
                                        <span class="craft-no">02</span>
                                        <div class="craft-body">
                                            <div class="craft-text">
                                                <h4>Artful Living</h4>
                                                <p>
                                                    Decorative sculptures with distinctive artistry.
                                                </p>
                                            </div>
                                            <i class="fa-solid fa-arrow-right"></i>
                                        </div>
                                    </a>
                                </div>

                                <div class="swiper-slide">
                                    <a href="product-listing.html" class="craft-card">
                                        <figure class="craft-img">
                                            <picture><img src="assets/images/home/cat3.png" alt="The Art of Dining"
                                                    loading="lazy" /></picture>
                                        </figure>
                                        <span class="craft-no">03</span>
                                        <div class="craft-body">
                                            <div class="craft-text">
                                                <h4>The Art of Dining</h4>
                                                <p>
                                                    Copper &amp; brass tableware for elegant tables.
                                                </p>
                                            </div>
                                            <i class="fa-solid fa-arrow-right"></i>
                                        </div>
                                    </a>
                                </div>

                                <div class="swiper-slide">
                                    <a href="product-listing.html" class="craft-card">
                                        <figure class="craft-img">
                                            <picture><img src="assets/images/home/cat4.png" alt="Lamps &amp; Diyas"
                                                    loading="lazy" /></picture>
                                        </figure>
                                        <span class="craft-no">04</span>
                                        <div class="craft-body">
                                            <div class="craft-text">
                                                <h4>Lamps &amp; Diyas</h4>
                                                <p>Handcrafted brass lamps for every festival.</p>
                                            </div>
                                            <i class="fa-solid fa-arrow-right"></i>
                                        </div>
                                    </a>
                                </div>

                                <div class="swiper-slide">
                                    <a href="product-listing.html" class="craft-card">
                                        <figure class="craft-img">
                                            <picture><img src="assets/images/home/cat6.png" alt="Bells &amp; Chimes"
                                                    loading="lazy" /></picture>
                                        </figure>
                                        <span class="craft-no">05</span>
                                        <div class="craft-body">
                                            <div class="craft-text">
                                                <h4>Bells &amp; Chimes</h4>
                                                <p>Soulful brass bells and wind chimes.</p>
                                            </div>
                                            <i class="fa-solid fa-arrow-right"></i>
                                        </div>
                                    </a>
                                </div>

                                <div class="swiper-slide">
                                    <a href="product-listing.html" class="craft-card">
                                        <figure class="craft-img">
                                            <picture><img src="assets/images/home/cat5.png" alt="Antique Locks"
                                                    loading="lazy" /></picture>
                                        </figure>
                                        <span class="craft-no">06</span>
                                        <div class="craft-body">
                                            <div class="craft-text">
                                                <h4>Antique Locks</h4>
                                                <p>Vintage brass locks with old-world charm.</p>
                                            </div>
                                            <i class="fa-solid fa-arrow-right"></i>
                                        </div>
                                    </a>
                                </div>
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
            </div>
        </section>

        <section class="home-secH">
            <div class="container">
                <div class="heading">
                    <small class="eyebrow">WHY CHOOSE PARIJAAT HANDICRAFT</small>
                    <h3>The Parijaat Difference.</h3>
                    <p>
                        A thoughtful approach to craftsmanship, collection and customer
                        experience.
                    </p>
                </div>

                <div class="swiper-wrap why-slider">
                    <div class="swiper fourSlider" data-mob="1.3" data-sm="2.2" data-lg="4" data-xl="4">
                        <div class="swiper-wrapper">
                            <!-- 01 : Craftsmanship -->
                            <div class="swiper-slide">
                                <div class="why-item">
                                    <span class="why-icon" aria-hidden="true">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M6 3h12l4 6-10 12L2 9z" />
                                            <path d="M2 9h20" />
                                            <path d="M9 3l3 6 3-6" />
                                            <path d="M12 9v12" />
                                        </svg>
                                    </span>
                                    <h4>Distinctive Craftsmanship</h4>
                                    <p>Carefully selected handcrafted designs.</p>
                                </div>
                            </div>

                            <!-- 02 : Collections -->
                            <div class="swiper-slide">
                                <div class="why-item">
                                    <span class="why-icon" aria-hidden="true">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="3" y="3" width="7.5" height="7.5" rx="1.5" />
                                            <rect x="13.5" y="3" width="7.5" height="7.5" rx="1.5" />
                                            <rect x="3" y="13.5" width="7.5" height="7.5" rx="1.5" />
                                            <path d="M17.25 13.5v7.5M13.5 17.25H21" />
                                        </svg>
                                    </span>
                                    <h4>Thoughtful Collections</h4>
                                    <p>Pieces for different spaces and occasions.</p>
                                </div>
                            </div>

                            <!-- 03 : Secure shopping -->
                            <div class="swiper-slide">
                                <div class="why-item">
                                    <span class="why-icon" aria-hidden="true">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M12 2.5l8 3v6c0 5-3.4 8.7-8 10-4.6-1.3-8-5-8-10v-6z" />
                                            <path d="M8.5 12l2.5 2.5L15.5 10" />
                                        </svg>
                                    </span>
                                    <h4>Secure Shopping</h4>
                                    <p>A safe and reliable checkout experience.</p>
                                </div>
                            </div>

                            <!-- 04 : Worldwide reach -->
                            <div class="swiper-slide">
                                <div class="why-item">
                                    <span class="why-icon" aria-hidden="true">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="9.5" />
                                            <path d="M2.5 12h19" />
                                            <path
                                                d="M12 2.5c2.6 2.6 4 5.8 4 9.5s-1.4 6.9-4 9.5c-2.6-2.6-4-5.8-4-9.5s1.4-6.9 4-9.5z" />
                                        </svg>
                                    </span>
                                    <h4>Worldwide Reach</h4>
                                    <p>Shopping designed for customers in India and abroad.</p>
                                </div>
                            </div>
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

        <section class="home-secI">
            <div class="container">
                <div class="gift-grid">
                    <!-- LEFT : LARGE EDITORIAL IMAGE -->
                    <a href="product-listing.html" class="gift-feature">
                        <figure class="gift-photo">
                            <picture><img src="assets/images/home/cat1.png" alt="Handcrafted gifts that tell a story"
                                    loading="lazy" /></picture>
                        </figure>
                        <span class="gift-tag">Gift Edit</span>
                        <div class="gift-caption">
                            <small>Handcrafted with meaning</small>
                            <h4>Every gift carries a story.</h4>
                        </div>
                    </a>

                    <!-- RIGHT : CONTENT + TILES -->
                    <div class="gift-content">
                        <div class="heading left">
                            <small class="eyebrow">GIVE SOMETHING MEANINGFUL</small>
                            <h3>Gifts That Tell a Story.</h3>
                            <p>
                                Make every occasion special with distinctive handcrafted gifts
                                that leave a lasting impression.
                            </p>
                        </div>

                        <div class="gift-tiles">
                            <a href="product-listing.html" class="gift-tile">
                                <figure>
                                    <picture><img src="assets/images/home/cat4.png" alt="Gifts for Every Occasion"
                                            loading="lazy" /></picture>
                                </figure>
                                <div class="gift-text">
                                    <h5>Gifts for Every Occasion</h5>
                                    <span>Shop now</span>
                                </div>
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>

                            <a href="product-listing.html" class="gift-tile">
                                <figure>
                                    <picture><img src="assets/images/home/cat2.png" alt="Traditional Gifts"
                                            loading="lazy" /></picture>
                                </figure>
                                <div class="gift-text">
                                    <h5>Traditional Gifts</h5>
                                    <span>Shop now</span>
                                </div>
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>

                            <a href="product-listing.html" class="gift-tile">
                                <figure>
                                    <picture><img src="assets/images/home/cat1.png" alt="Housewarming Gifts"
                                            loading="lazy" /></picture>
                                </figure>
                                <div class="gift-text">
                                    <h5>Housewarming Gifts</h5>
                                    <span>Shop now</span>
                                </div>
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>

                            <a href="product-listing.html" class="gift-tile">
                                <figure>
                                    <picture><img src="assets/images/home/cat5.png" alt="Collectible Treasures"
                                            loading="lazy" /></picture>
                                </figure>
                                <div class="gift-text">
                                    <h5>Collectible Treasures</h5>
                                    <span>Shop now</span>
                                </div>
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>

                        <div class="gift-btns">
                            <a href="product-listing.html" class="btn btn-primary">Explore Gift Collection</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="home-secV">
            <div class="container">
                <div class="aff-card">
                    <!-- IMAGE -->
                    <figure class="aff-media">
                        <img src="assets/images/home/cat1.png" alt="Handcrafted brass idol by Parijaat Handicraft"
                            loading="lazy" />
                    </figure>

                    <!-- CONTENT -->
                    <div class="aff-content">
                        <small class="eyebrow">BECOME A PARTNER</small>
                        <h3>Share the Craft. Grow Together.</h3>
                        <p>
                            Love beautiful handcrafted products? Partner with Parijaat
                            Handicraft and introduce the beauty of Indian craftsmanship to a
                            wider audience.
                        </p>
                        <div class="aff-btns">
                            <!-- DEV NOTE: If the affiliate system goes live, change the label to "Become an Affiliate". -->
                            <button type="button" class="btn btn-primary" data-model=".become-pop">
                                Apply for Partnership <i class="fa-solid fa-arrow-right"></i>
                            </button>

                            <a href="javascript:void()" class="btn btn-outline-black">
                                How It Work</a>
                        </div>
                        <!-- DEV NOTE: Do NOT show commission %, referral tracking or payment terms until the client confirms the program is operational. -->
                    </div>

                    <!-- WHY PARTNER -->
                    <div class="aff-why">
                        <span class="aff-label">Why Partner With Us?</span>
                        <ul class="aff-points">
                            <li>
                                <span class="aff-ic"><i class="fa-solid fa-gem"></i></span>
                                <b>Promote Unique Handcrafted Products</b>
                            </li>
                            <li>
                                <span class="aff-ic"><i class="fa-solid fa-handshake"></i></span>
                                <b>Access Partnership Opportunities</b>
                            </li>
                            <li>
                                <span class="aff-ic"><i class="fa-solid fa-seedling"></i></span>
                                <b>Grow With Our Brand</b>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

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

        <section class="home-secJ">
            <div class="container">
                <div class="heading">
                    <small class="eyebrow">RECENTLY VIEWED</small>
                    <h3>Pick Up Where You Left Off.</h3>
                    <p>
                        Take another look at the handcrafted pieces you've recently
                        explored.
                    </p>
                </div>

                <div class="swiper-wrap">
                    <div class="swiper fourSlider" data-mob="2" data-sm="3" data-lg="4" data-xl="5">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <article class="prod_cart">
                                    <div class="prod-img">
                                        <a href="product-detail.html" class="prod-link"><img
                                                src="assets/images/home/cat4.png" alt="Handmade Brass Oil Lamp"
                                                loading="lazy" /></a>
                                        <span class="prod-badge">Bestseller</span>
                                        <button type="button" class="wish-btn" aria-label="Add to wishlist">
                                            <i class="fa-regular fa-heart"></i>
                                        </button>
                                    </div>
                                    <div class="prod-info">
                                        <h4 class="prod-brand">Parijat Handicraft</h4>
                                        <p class="prod-name">
                                            <a href="product-detail.html">Handmade Brass Oil Lamp</a>
                                        </p>
                                        <div class="prod-price">
                                            <span class="price-now">$229</span>
                                            <span class="price-old">$279</span>
                                            <span class="price-off">(18% OFF)</span>
                                        </div>
                                        <div class="prod-btns">
                                            <button type="button" class="btn btn-outline-black" data-id="SKU-P1"
                                                data-name="Handmade Brass Oil Lamp" data-toast-title="Added to Cart"
                                                data-toast-text="Handmade Brass Oil Lamp has been added to your cart."
                                                data-toast-type="success">
                                                Add to Cart
                                            </button>
                                            <a href="product-detail.html" class="btn btn-primary">Buy Now</a>
                                        </div>
                                    </div>
                                </article>
                            </div>

                            <div class="swiper-slide">
                                <article class="prod_cart">
                                    <div class="prod-img">
                                        <a href="product-detail.html" class="prod-link"><img
                                                src="assets/images/home/cat2.png" alt="Brass Aladdin Incense Burner"
                                                loading="lazy" /></a>
                                        <button type="button" class="wish-btn" aria-label="Add to wishlist">
                                            <i class="fa-regular fa-heart"></i>
                                        </button>
                                    </div>
                                    <div class="prod-info">
                                        <h4 class="prod-brand">Parijat Handicraft</h4>
                                        <p class="prod-name">
                                            <a href="product-detail.html">Brass Aladdin Incense Burner</a>
                                        </p>
                                        <div class="prod-price">
                                            <span class="price-now">$129</span>
                                            <span class="price-old">$159</span>
                                            <span class="price-off">(19% OFF)</span>
                                        </div>
                                        <div class="prod-btns">
                                            <button type="button" class="btn btn-outline-black" data-id="SKU-P2"
                                                data-name="Brass Aladdin Incense Burner" data-toast-title="Added to Cart"
                                                data-toast-text="Brass Aladdin Incense Burner has been added to your cart."
                                                data-toast-type="success">
                                                Add to Cart
                                            </button>
                                            <a href="product-detail.html" class="btn btn-primary">Buy Now</a>
                                        </div>
                                    </div>
                                </article>
                            </div>

                            <div class="swiper-slide">
                                <article class="prod_cart">
                                    <div class="prod-img">
                                        <a href="product-detail.html" class="prod-link"><img
                                                src="assets/images/home/cat1.png" alt="Brass Decorative Rabbit Figurine"
                                                loading="lazy" /></a>
                                        <span class="prod-badge">Limited Stock</span>
                                        <button type="button" class="wish-btn" aria-label="Add to wishlist">
                                            <i class="fa-regular fa-heart"></i>
                                        </button>
                                    </div>
                                    <div class="prod-info">
                                        <h4 class="prod-brand">Parijat Handicraft</h4>
                                        <p class="prod-name">
                                            <a href="product-detail.html">Brass Decorative Rabbit Figurine</a>
                                        </p>
                                        <div class="prod-price">
                                            <span class="price-now">$389</span>
                                            <span class="price-old">$459</span>
                                            <span class="price-off">(15% OFF)</span>
                                        </div>
                                        <div class="prod-btns">
                                            <button type="button" class="btn btn-outline-black" data-id="SKU-P3"
                                                data-name="Brass Decorative Rabbit Figurine"
                                                data-toast-title="Added to Cart"
                                                data-toast-text="Brass Decorative Rabbit Figurine has been added to your cart."
                                                data-toast-type="success">
                                                Add to Cart
                                            </button>
                                            <a href="product-detail.html" class="btn btn-primary">Buy Now</a>
                                        </div>
                                    </div>
                                </article>
                            </div>

                            <div class="swiper-slide">
                                <article class="prod_cart">
                                    <div class="prod-img">
                                        <a href="product-detail.html" class="prod-link"><img
                                                src="assets/images/home/cat3.png" alt="Hammered Copper Goblet"
                                                loading="lazy" /></a>
                                        <button type="button" class="wish-btn" aria-label="Add to wishlist">
                                            <i class="fa-regular fa-heart"></i>
                                        </button>
                                    </div>
                                    <div class="prod-info">
                                        <h4 class="prod-brand">Parijat Handicraft</h4>
                                        <p class="prod-name">
                                            <a href="product-detail.html">Hammered Copper Goblet</a>
                                        </p>
                                        <div class="prod-price">
                                            <span class="price-now">$125</span>
                                            <span class="price-old">$149</span>
                                            <span class="price-off">(16% OFF)</span>
                                        </div>
                                        <div class="prod-btns">
                                            <button type="button" class="btn btn-outline-black" data-id="SKU-P4"
                                                data-name="Hammered Copper Goblet" data-toast-title="Added to Cart"
                                                data-toast-text="Hammered Copper Goblet has been added to your cart."
                                                data-toast-type="success">
                                                Add to Cart
                                            </button>
                                            <a href="product-detail.html" class="btn btn-primary">Buy Now</a>
                                        </div>
                                    </div>
                                </article>
                            </div>

                            <div class="swiper-slide">
                                <article class="prod_cart">
                                    <div class="prod-img">
                                        <a href="product-detail.html" class="prod-link"><img
                                                src="assets/images/home/cat4.png" alt="Brass Lotus Kuber Diya"
                                                loading="lazy" /></a>
                                        <span class="prod-badge">Bestseller</span>
                                        <button type="button" class="wish-btn" aria-label="Add to wishlist">
                                            <i class="fa-regular fa-heart"></i>
                                        </button>
                                    </div>
                                    <div class="prod-info">
                                        <h4 class="prod-brand">Parijat Handicraft</h4>
                                        <p class="prod-name">
                                            <a href="product-detail.html">Brass Lotus Kuber Diya</a>
                                        </p>
                                        <div class="prod-price">
                                            <span class="price-now">$179</span>
                                            <span class="price-old">$209</span>
                                            <span class="price-off">(14% OFF)</span>
                                        </div>
                                        <div class="prod-btns">
                                            <button type="button" class="btn btn-outline-black" data-id="SKU-P5"
                                                data-name="Brass Lotus Kuber Diya" data-toast-title="Added to Cart"
                                                data-toast-text="Brass Lotus Kuber Diya has been added to your cart."
                                                data-toast-type="success">
                                                Add to Cart
                                            </button>
                                            <a href="product-detail.html" class="btn btn-primary">Buy Now</a>
                                        </div>
                                    </div>
                                </article>
                            </div>

                            <div class="swiper-slide">
                                <article class="prod_cart">
                                    <div class="prod-img">
                                        <a href="product-detail.html" class="prod-link"><img
                                                src="assets/images/home/cat6.png" alt="Brass Wind Chime"
                                                loading="lazy" /></a>
                                        <button type="button" class="wish-btn" aria-label="Add to wishlist">
                                            <i class="fa-regular fa-heart"></i>
                                        </button>
                                    </div>
                                    <div class="prod-info">
                                        <h4 class="prod-brand">Parijat Handicraft</h4>
                                        <p class="prod-name">
                                            <a href="product-detail.html">Brass Wind Chime</a>
                                        </p>
                                        <div class="prod-price">
                                            <span class="price-now">$249</span>
                                            <span class="price-old">$299</span>
                                            <span class="price-off">(17% OFF)</span>
                                        </div>
                                        <div class="prod-btns">
                                            <button type="button" class="btn btn-outline-black" data-id="SKU-P9"
                                                data-name="Brass Wind Chime" data-toast-title="Added to Cart"
                                                data-toast-text="Brass Wind Chime has been added to your cart."
                                                data-toast-type="success">
                                                Add to Cart
                                            </button>
                                            <a href="product-detail.html" class="btn btn-primary">Buy Now</a>
                                        </div>
                                    </div>
                                </article>
                            </div>
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

        <section class="home-secP">
            <div class="container">
                <div class="heading">
                    <small class="eyebrow">ALSO AVAILABLE ON</small>
                    <h3>Find Us on Your Favourite Marketplace.</h3>
                    <p>
                        Shop Parijaat Handicraft on our own store or on trusted global
                        marketplaces, wherever you prefer to buy.
                    </p>
                </div>

                <div class="swiper-wrap">
                    <div class="swiper fourSlider" data-mob="1.4" data-sm="2.2" data-lg="4" data-xl="4">
                        <div class="swiper-wrapper">
                            <!-- OFFICIAL STORE (current site, highlighted, first) -->
                            <div class="swiper-slide">
                                <a href="product-listing.html" class="mp-card mp-official"
                                    aria-label="Continue shopping on Parijaat Handicraft">
                                    <figure class="mp-logo">
                                        <img src="assets/images/logo.png" alt="Parijaat Handicraft" width="160" height="60"
                                            loading="lazy" />
                                    </figure>
                                    <small class="mp-here">You're Shopping Here</small>
                                    <h4>Parijaat Handicraft</h4>
                                    <p>
                                        Our official store with exclusive coupons and festive
                                        offers.
                                    </p>
                                    <span class="mp-link">Continue Shopping <i class="fa-solid fa-arrow-right"></i></span>
                                </a>
                            </div>

                            <!-- AMAZON -->
                            <div class="swiper-slide">
                                <a href="javascript:void(0)" class="mp-card" aria-label="Visit our Amazon store">
                                    <figure class="mp-logo">
                                        <img src="assets/icon/amazon.png" alt="Amazon" width="160" height="60"
                                            loading="lazy" />
                                    </figure>
                                    <h4>Amazon</h4>
                                    <p>Shop our handcrafted range on Amazon.</p>
                                    <span class="mp-link">Visit Store <i class="fa-solid fa-arrow-right"></i></span>
                                </a>
                            </div>

                            <!-- ALIBABA -->
                            <div class="swiper-slide">
                                <a href="javascript:void(0)" class="mp-card" aria-label="Visit our Alibaba store">
                                    <figure class="mp-logo">
                                        <img src="assets/icon/alibaba.png" alt="Alibaba" width="160" height="60"
                                            loading="lazy" />
                                    </figure>
                                    <h4>Alibaba</h4>
                                    <p>Bulk and wholesale orders for global buyers.</p>
                                    <span class="mp-link">Visit Store <i class="fa-solid fa-arrow-right"></i></span>
                                </a>
                            </div>

                            <!-- EBAY -->
                            <div class="swiper-slide">
                                <a href="javascript:void(0)" class="mp-card" aria-label="Visit our eBay store">
                                    <figure class="mp-logo">
                                        <img src="assets/icon/ebay.png" alt="eBay" width="160" height="60" loading="lazy" />
                                    </figure>
                                    <h4>eBay</h4>
                                    <p>Find our decor and collectible pieces on eBay.</p>
                                    <span class="mp-link">Visit Store <i class="fa-solid fa-arrow-right"></i></span>
                                </a>
                            </div>
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

        <section class="home-secK">
            <div class="container">
                <div class="heading">
                    <small class="eyebrow">KIND WORDS FROM OUR CUSTOMERS</small>
                    <h3>Loved for the Details.</h3>
                    <p>
                        See what customers appreciate about their Parijaat Handicraft
                        purchases.
                    </p>
                </div>

                <div class="swiper-wrap">
                    <div class="swiper fourSlider" data-mob="1.15" data-sm="2" data-lg="3" data-xl="3">
                        <div class="swiper-wrapper">
                            <!-- REVIEW 01 -->
                            <div class="swiper-slide">
                                <article class="review-card">
                                    <div class="review-head">
                                        <span class="review-quote"><i class="fa-solid fa-quote-left"></i></span>
                                        <div class="review-meta">
                                            <div class="review-stars" role="img" aria-label="5 out of 5 stars">
                                                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                                    class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                                    class="fa-solid fa-star"></i>
                                            </div>
                                            <span class="review-verified"><i class="fa-solid fa-circle-check"></i> Verified
                                                Purchase</span>
                                        </div>
                                    </div>
                                    <p class="review-text">
                                        The detailing on the brass diya is beautiful. It looks
                                        even better in person and fits perfectly in our pooja
                                        corner.
                                    </p>
                                    <div class="review-user">
                                        <span class="review-avatar">A</span>
                                        <div class="review-info">
                                            <h5>Anjali S.</h5>
                                            <span>Brass Lotus Kuber Diya</span>
                                        </div>
                                    </div>
                                </article>
                            </div>

                            <!-- REVIEW 02 -->
                            <div class="swiper-slide">
                                <article class="review-card">
                                    <div class="review-head">
                                        <span class="review-quote"><i class="fa-solid fa-quote-left"></i></span>
                                        <div class="review-meta">
                                            <div class="review-stars" role="img" aria-label="5 out of 5 stars">
                                                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                                    class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                                    class="fa-solid fa-star"></i>
                                            </div>
                                            <span class="review-verified"><i class="fa-solid fa-circle-check"></i> Verified
                                                Purchase</span>
                                        </div>
                                    </div>
                                    <p class="review-text">
                                        Packed with great care and delivered on time. The finish
                                        feels solid and the copper goblets look lovely on our
                                        dining table.
                                    </p>
                                    <div class="review-user">
                                        <span class="review-avatar">R</span>
                                        <div class="review-info">
                                            <h5>Rohit M.</h5>
                                            <span>Hammered Copper Goblet</span>
                                        </div>
                                    </div>
                                </article>
                            </div>

                            <!-- REVIEW 03 -->
                            <div class="swiper-slide">
                                <article class="review-card">
                                    <div class="review-head">
                                        <span class="review-quote"><i class="fa-solid fa-quote-left"></i></span>
                                        <div class="review-meta">
                                            <div class="review-stars" role="img" aria-label="4 out of 5 stars">
                                                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                                    class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                                    class="fa-regular fa-star"></i>
                                            </div>
                                            <span class="review-verified"><i class="fa-solid fa-circle-check"></i> Verified
                                                Purchase</span>
                                        </div>
                                    </div>
                                    <p class="review-text">
                                        Bought this as a housewarming gift and it was loved. The
                                        workmanship is fine and it feels like a real heirloom
                                        piece.
                                    </p>
                                    <div class="review-user">
                                        <span class="review-avatar">N</span>
                                        <div class="review-info">
                                            <h5>Neha K.</h5>
                                            <span>Brass Elephant Diya Stand</span>
                                        </div>
                                    </div>
                                </article>
                            </div>

                            <!-- REVIEW 04 -->
                            <div class="swiper-slide">
                                <article class="review-card">
                                    <div class="review-head">
                                        <span class="review-quote"><i class="fa-solid fa-quote-left"></i></span>
                                        <div class="review-meta">
                                            <div class="review-stars" role="img" aria-label="5 out of 5 stars">
                                                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                                    class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                                    class="fa-solid fa-star"></i>
                                            </div>
                                            <span class="review-verified"><i class="fa-solid fa-circle-check"></i> Verified
                                                Purchase</span>
                                        </div>
                                    </div>
                                    <p class="review-text">
                                        The wind chime has a soft, soothing sound. Looks great
                                        near our balcony door and the quality is very good for the
                                        price.
                                    </p>
                                    <div class="review-user">
                                        <span class="review-avatar">S</span>
                                        <div class="review-info">
                                            <h5>Sandeep V.</h5>
                                            <span>Brass Wind Chime</span>
                                        </div>
                                    </div>
                                </article>
                            </div>

                            <!-- REVIEW 05 -->
                            <div class="swiper-slide">
                                <article class="review-card">
                                    <div class="review-head">
                                        <span class="review-quote"><i class="fa-solid fa-quote-left"></i></span>
                                        <div class="review-meta">
                                            <div class="review-stars" role="img" aria-label="5 out of 5 stars">
                                                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                                    class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                                    class="fa-solid fa-star"></i>
                                            </div>
                                            <span class="review-verified"><i class="fa-solid fa-circle-check"></i> Verified
                                                Purchase</span>
                                        </div>
                                    </div>
                                    <p class="review-text">
                                        The antique lock is a lovely decor piece. Exactly as shown
                                        on the website, with a rich colour and neat finishing.
                                    </p>
                                    <div class="review-user">
                                        <span class="review-avatar">P</span>
                                        <div class="review-info">
                                            <h5>Priya D.</h5>
                                            <span>Antique Brass Lock</span>
                                        </div>
                                    </div>
                                </article>
                            </div>

                            <!-- REVIEW 06 -->
                            <div class="swiper-slide">
                                <article class="review-card">
                                    <div class="review-head">
                                        <span class="review-quote"><i class="fa-solid fa-quote-left"></i></span>
                                        <div class="review-meta">
                                            <div class="review-stars" role="img" aria-label="5 out of 5 stars">
                                                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                                    class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                                    class="fa-solid fa-star"></i>
                                            </div>
                                            <span class="review-verified"><i class="fa-solid fa-circle-check"></i> Verified
                                                Purchase</span>
                                        </div>
                                    </div>
                                    <p class="review-text">
                                        Ordered the incense burner for Diwali. It arrived safely
                                        and the design adds a warm, traditional touch to our
                                        living room.
                                    </p>
                                    <div class="review-user">
                                        <span class="review-avatar">M</span>
                                        <div class="review-info">
                                            <h5>Meera T.</h5>
                                            <span>Brass Aladdin Incense Burner</span>
                                        </div>
                                    </div>
                                </article>
                            </div>
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

        <section class="home-secN">
            <div class="container">
                <div class="heading">
                    <small class="eyebrow">WATCH &amp; DISCOVER</small>
                    <h3>See Our Craft in Motion.</h3>
                    <p>
                        Short reels from our workshop, from the first hammer strike to the
                        final polish.
                    </p>
                </div>

                <div class="swiper-wrap">
                    <div class="swiper fourSlider" data-mob="2" data-sm="3" data-lg="3" data-xl="4">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <article class="reel-card">
                                    <img src="assets/images/home/cat1.png" alt="Brass idol being finished by hand"
                                        loading="lazy" />
                                    <span class="reel-tag"><i class="fa-brands fa-instagram"></i></span>
                                    <div class="content-wrap">
                                        <div class="reel-text">
                                            <h4>Brass Idol Finishing</h4>
                                            <p>Hand polished by our artisans</p>
                                        </div>
                                        <button type="button" class="play-btn"
                                            data-video="https://youtube.com/embed/HyJfGib_Ds4"
                                            aria-label="Play video: Brass Idol Finishing"></button>
                                    </div>
                                </article>
                            </div>

                            <div class="swiper-slide">
                                <article class="reel-card">
                                    <img src="assets/images/home/cat2.png" alt="Pooja essentials arranged for aarti"
                                        loading="lazy" />
                                    <span class="reel-tag"><i class="fa-brands fa-instagram"></i></span>
                                    <div class="content-wrap">
                                        <div class="reel-text">
                                            <h4>Pooja Thali Setup</h4>
                                            <p>Styling your daily aarti</p>
                                        </div>
                                        <button type="button" class="play-btn"
                                            data-video="https://youtube.com/embed/HyJfGib_Ds4"
                                            aria-label="Play video: Pooja Thali Setup"></button>
                                    </div>
                                </article>
                            </div>

                            <div class="swiper-slide">
                                <article class="reel-card">
                                    <img src="assets/images/home/cat3.png" alt="Copper drinkware being crafted"
                                        loading="lazy" />
                                    <span class="reel-tag"><i class="fa-brands fa-instagram"></i></span>
                                    <div class="content-wrap">
                                        <div class="reel-text">
                                            <h4>Copper Hammering</h4>
                                            <p>Every dent is made by hand</p>
                                        </div>
                                        <button type="button" class="play-btn"
                                            data-video="https://youtube.com/embed/HyJfGib_Ds4"
                                            aria-label="Play video: Copper Hammering"></button>
                                    </div>
                                </article>
                            </div>

                            <div class="swiper-slide">
                                <article class="reel-card">
                                    <img src="assets/images/home/cat4.png" alt="Brass diya being lit" loading="lazy" />
                                    <span class="reel-tag"><i class="fa-brands fa-instagram"></i></span>
                                    <div class="content-wrap">
                                        <div class="reel-text">
                                            <h4>Lighting the Diya</h4>
                                        </div>
                                        <button type="button" class="play-btn"
                                            data-video="https://youtube.com/embed/HyJfGib_Ds4"
                                            aria-label="Play video: Lighting the Diya"></button>
                                    </div>
                                </article>
                            </div>

                            <div class="swiper-slide">
                                <article class="reel-card">
                                    <img src="assets/images/home/cat5.png" alt="Antique brass lock detail" loading="lazy" />
                                    <span class="reel-tag"><i class="fa-brands fa-instagram"></i></span>
                                    <div class="content-wrap">
                                        <div class="reel-text">
                                            <h4>Antique Lock Detail</h4>
                                            <p>Old world craft, up close</p>
                                        </div>
                                        <button type="button" class="play-btn"
                                            data-video="https://youtube.com/embed/HyJfGib_Ds4"
                                            aria-label="Play video: Antique Lock Detail"></button>
                                    </div>
                                </article>
                            </div>

                            <div class="swiper-slide">
                                <article class="reel-card">
                                    <img src="assets/images/home/cat6.png" alt="Temple bells and wind chimes"
                                        loading="lazy" />
                                    <span class="reel-tag"><i class="fa-brands fa-instagram"></i></span>
                                    <div class="content-wrap">
                                        <div class="reel-text">
                                            <h4>Bells &amp; Chimes</h4>
                                            <p>Hear the sound of brass</p>
                                        </div>
                                        <button type="button" class="play-btn"
                                            data-video="https://youtube.com/embed/HyJfGib_Ds4"
                                            aria-label="Play video: Bells and Chimes"></button>
                                    </div>
                                </article>
                            </div>
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

                <div class="sec-cta">
                    <a href="javascript:void(0)" class="btn btn-outline-black">
                        Follow Us on Instagram
                        <i class="fa-solid fa-arrow-right-long"></i>
                    </a>
                </div>
            </div>
        </section>
    </main>

@endsection