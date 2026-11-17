@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/sass/about/about.css') }}" />
@endpush

@section('content')

    <main>
      <section class="comman-banner">
        <figure class="banner-media">
          <img
            src="assets/images/home/blog.png"
            alt=""
            loading="eager"
          />
        </figure>

        <!-- BREADCRUMB (top) : change the links and current page on each page -->
        <div class="banner-top">
          <div class="container">
            <ul class="banner-crumb">
              <li><a href="{{ route('home') }}">Home</a></li>
              <li><i class="fa-solid fa-chevron-right"></i></li>
              <li class="current">About Us</li>
            </ul>
          </div>
        </div>

        <div class="container">
          <div class="banner-content">
            <h1>About Us</h1>
            <p>Celebrating Craftsmanship. Creating Timeless Beauty.</p>
          </div>
        </div>
      </section>

      <section class="about-secA" id="who-we-are">
        <div class="container">
          <div class="who-grid">
            <!-- LEFT : IMAGE -->
            <div class="who-media">
              <figure>
                <img src="assets/images/home/cat1.png" alt="" loading="lazy" />
              </figure>
            </div>

            <!-- RIGHT : CONTENT -->
            <div class="who-content">
              <div class="heading">
                <small class="eyebrow">OUR STORY &amp; HERITAGE</small>
                <h3>
                  More Than Handicrafts. A Celebration of Indian Heritage.
                </h3>
                <p>
                  Parijaat Handicraft is dedicated to bringing the beauty of
                  traditional Indian craftsmanship into modern living. We offer
                  a thoughtfully curated range of decorative and functional
                  products that reflect artistic heritage, intricate detailing
                  and timeless appeal.
                </p>
                <p>
                  From elegant brass décor and religious artefacts to
                  distinctive home accessories and handcrafted treasures, our
                  collections celebrate the creativity and skill behind every
                  design.
                </p>
                <p>
                  Our focus is on connecting customers and businesses with
                  distinctive handicraft products through quality-conscious
                  sourcing, careful selection and a commitment to customer
                  satisfaction.
                </p>
              </div>

              <div class="who-philosophy">
                <small>Our Philosophy</small>
                <p>
                  We believe every handcrafted creation carries a story – of
                  creativity, culture and the hands that bring it to life.
                </p>
              </div>
            </div>
          </div>

          <!-- BOTTOM : HIGHLIGHTS -->
          <ul class="who-highlights">
            <li>
              <span class="who-icon"><i class="fa-solid fa-palette"></i></span>
              <h4>Traditional Artistry</h4>
            </li>
            <li>
              <span class="who-icon"><i class="fa-solid fa-gem"></i></span>
              <h4>Distinctive Collections</h4>
            </li>
            <li>
              <span class="who-icon"><i class="fa-solid fa-award"></i></span>
              <h4>Quality Focus</h4>
            </li>
            <li>
              <span class="who-icon"><i class="fa-solid fa-globe"></i></span>
              <h4>Global Outlook</h4>
            </li>
          </ul>
        </div>
      </section>

      <section class="about-secB">
        <div class="container">
          <div class="heading">
            <small class="eyebrow">OUR JOURNEY IN NUMBERS</small>
            <h3>Growing Through Craftsmanship &amp; Trust.</h3>
          </div>

          <!-- DEV NOTE: Numbers are placeholders. Replace with verified company figures before publishing. -->
          <div class="swiper-wrap stats-panel">
            <div
              class="swiper fourSlider"
              data-mob="1.4"
              data-sm="2.2"
              data-lg="4"
              data-xl="4"
            >
              <div class="swiper-wrapper">
                <div class="swiper-slide">
                  <div class="stat-card">
                    <i class="fa-solid fa-calendar-check"></i>
                    <h3 class="countNum" data-num="15" data-num-icon="+">0</h3>
                    <h4>Years of Experience</h4>
                    <p>Our journey in the handicraft industry</p>
                  </div>
                </div>

                <div class="swiper-slide">
                  <div class="stat-card">
                    <i class="fa-solid fa-shapes"></i>
                    <h3 class="countNum" data-num="500" data-num-icon="+">0</h3>
                    <h4>Product Designs</h4>
                    <p>Distinctive products and creations</p>
                  </div>
                </div>

                <div class="swiper-slide">
                  <div class="stat-card">
                    <i class="fa-solid fa-globe"></i>
                    <h3 class="countNum" data-num="10" data-num-icon="+">0</h3>
                    <h4>Countries Served</h4>
                    <p>Verified international markets</p>
                  </div>
                </div>

                <div class="swiper-slide">
                  <div class="stat-card">
                    <i class="fa-solid fa-layer-group"></i>
                    <h3 class="countNum" data-num="5" data-num-icon="+">0</h3>
                    <h4>Product Categories</h4>
                    <p>A diverse range of collections</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="about-secC">
        <div class="container">
          <div class="craft-grid">
            <!-- LEFT : IMAGE -->
            <figure class="craft-media">
              <img
                src="assets/images/home/pro30.jpg"
                alt="Handcrafted brass decor"
                loading="lazy"
              />
            </figure>

            <!-- RIGHT : CONTENT -->
            <div class="craft-content">
              <div class="heading left">
                <small class="eyebrow">WHAT WE DO</small>
                <h3>Bringing Traditional Artistry Into Modern Spaces.</h3>
                <p>
                  At Parijaat Handicraft, we celebrate the versatility of Indian
                  handicrafts through a diverse collection of decorative,
                  spiritual and functional products. Our focus is on distinctive
                  designs that combine cultural inspiration with everyday
                  usability.
                </p>
              </div>

              <span class="craft-label">Our Areas of Expertise</span>

              <ul class="craft-points">
                <li>
                  <span class="craft-ic"
                    ><i class="fa-solid fa-house"></i
                  ></span>
                  <h4>Home &amp; Kitchen Décor</h4>
                  <p>
                    Thoughtfully selected decorative and functional pieces that
                    add character to everyday spaces.
                  </p>
                </li>
                <li>
                  <span class="craft-ic"><i class="fa-solid fa-om"></i></span>
                  <h4>Religious &amp; Spiritual Products</h4>
                  <p>
                    Traditional artefacts and devotional accessories inspired by
                    India's rich cultural heritage.
                  </p>
                </li>
                <li>
                  <span class="craft-ic"
                    ><i class="fa-solid fa-briefcase"></i
                  ></span>
                  <h4>Office &amp; Decorative Products</h4>
                  <p>
                    Distinctive handcrafted accents designed to bring elegance
                    and personality to professional spaces.
                  </p>
                </li>
                <li>
                  <span class="craft-ic"
                    ><i class="fa-solid fa-screwdriver-wrench"></i
                  ></span>
                  <h4>Tools, Hardware &amp; Lifestyle Accessories</h4>
                  <p>
                    A diverse selection of traditional and decorative
                    accessories for different applications.
                  </p>
                </li>
              </ul>

              <div class="craft-btns">
                <a href="{{ route('products') }}" class="btn btn-primary"
                  >Explore Our Collections</a
                >
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="about-secD">
        <div class="container">
          <div class="heading">
            <h3>Our Vision &amp; Mission</h3>
          </div>

          <div class="vm-grid">
            <!-- VISION -->
            <article class="vm-card vm-vision">
              <i class="fa-solid fa-earth-asia vm-mark" aria-hidden="true"></i>
              <span class="vm-ic"><i class="fa-solid fa-earth-asia"></i></span>
              <small class="eyebrow">OUR VISION</small>
              <h4>Taking Indian Craftsmanship to the World.</h4>
              <p>
                To become a trusted name in the handicraft and decorative
                products industry by showcasing the richness of Indian artistry
                and making distinctive creations accessible to customers across
                the globe.
              </p>
            </article>

            <!-- MISSION -->
            <article class="vm-card vm-mission">
              <i
                class="fa-solid fa-hands-holding vm-mark"
                aria-hidden="true"
              ></i>
              <span class="vm-ic"
                ><i class="fa-solid fa-hands-holding"></i
              ></span>
              <small class="eyebrow">OUR MISSION</small>
              <h4>Quality, Creativity &amp; Lasting Relationships.</h4>
              <p>
                To offer thoughtfully curated handicraft collections, focus on
                quality-conscious business practices, support meaningful
                customer relationships and create valuable opportunities for
                buyers and business partners.
              </p>
            </article>
          </div>
        </div>
      </section>

      <section class="about-secE">
        <div class="container">
          <div class="heading">
            <small class="eyebrow">THE PARIJAAT ADVANTAGE</small>
            <h3>Crafted With Care. Chosen With Confidence.</h3>
            <p>
              We bring together distinctive collections, thoughtful product
              selection and a customer-focused approach to make every business
              relationship meaningful.
            </p>
          </div>

          <div class="swiper-wrap">
            <div
              class="swiper fourSlider"
              data-mob="1.2"
              data-sm="2"
              data-lg="3"
              data-xl="3"
            >
              <div class="swiper-wrapper">
                <div class="swiper-slide">
                  <article class="adv-card">
                    <span class="adv-no">01</span>
                    <span class="adv-ic" aria-hidden="true">
                      <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.4"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      >
                        <path d="M6 3h12l4 6-10 12L2 9z" />
                        <path d="M2 9h20" />
                        <path d="M9 3l3 6 3-6" />
                      </svg>
                    </span>
                    <h4>Distinctive Collections</h4>
                    <p>
                      A diverse selection of traditional and decorative
                      products.
                    </p>
                  </article>
                </div>

                <div class="swiper-slide">
                  <article class="adv-card">
                    <span class="adv-no">02</span>
                    <span class="adv-ic" aria-hidden="true">
                      <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.4"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      >
                        <circle cx="12" cy="9" r="6" />
                        <path d="M8.5 14 7 22l5-3 5 3-1.5-8" />
                      </svg>
                    </span>
                    <h4>Quality Focus</h4>
                    <p>
                      Attention to product selection, finishing and
                      presentation.
                    </p>
                  </article>
                </div>

                <div class="swiper-slide">
                  <article class="adv-card">
                    <span class="adv-no">03</span>
                    <span class="adv-ic" aria-hidden="true">
                      <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.4"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      >
                        <path d="M21 8 12 3 3 8v8l9 5 9-5z" />
                        <path d="m3 8 9 5 9-5" />
                        <path d="M12 13v8" />
                      </svg>
                    </span>
                    <h4>Careful Packaging</h4>
                    <p>
                      Packaging considerations to help protect products during
                      transit.
                    </p>
                  </article>
                </div>

                <div class="swiper-slide">
                  <article class="adv-card">
                    <span class="adv-no">04</span>
                    <span class="adv-ic" aria-hidden="true">
                      <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.4"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      >
                        <path d="M3 14v-2a9 9 0 0 1 18 0v2" />
                        <path d="M3 14h4v6H3z" />
                        <path d="M17 14h4v6h-4z" />
                        <path d="M21 20c0 1.5-1.5 2-4 2h-2" />
                      </svg>
                    </span>
                    <h4>Customer-Focused Support</h4>
                    <p>
                      Assistance for product selection and business enquiries.
                    </p>
                  </article>
                </div>

                <div class="swiper-slide">
                  <article class="adv-card">
                    <span class="adv-no">05</span>
                    <span class="adv-ic" aria-hidden="true">
                      <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.4"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      >
                        <rect x="3" y="3" width="7.5" height="7.5" rx="1.5" />
                        <rect
                          x="13.5"
                          y="3"
                          width="7.5"
                          height="7.5"
                          rx="1.5"
                        />
                        <rect
                          x="3"
                          y="13.5"
                          width="7.5"
                          height="7.5"
                          rx="1.5"
                        />
                        <path d="M17.25 13.5v7.5M13.5 17.25H21" />
                      </svg>
                    </span>
                    <h4>Diverse Product Range</h4>
                    <p>
                      Multiple categories for different customer and business
                      needs.
                    </p>
                  </article>
                </div>

                <div class="swiper-slide">
                  <article class="adv-card">
                    <span class="adv-no">06</span>
                    <span class="adv-ic" aria-hidden="true">
                      <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.4"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      >
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                      </svg>
                    </span>
                    <h4>Business Partnerships</h4>
                    <p>
                      Opportunities to connect with retailers, wholesalers and
                      buyers.
                    </p>
                  </article>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="about-secF">
        <div class="container">
          <div class="heading">
            <small class="eyebrow">OUR PROCESS</small>
            <h3>From Product Selection to Delivery.</h3>
            <p>
              We follow a thoughtful process to help customers and business
              buyers find the right products and move forward with confidence.
            </p>
          </div>

          <!-- DEV NOTE: Proposed customer journey. Adjust wording as per the client's actual order fulfilment process. -->
          <ol class="proc-steps">
            <li>
              <span class="proc-ic"
                ><i class="fa-solid fa-magnifying-glass"></i
              ></span>
              <div class="proc-text">
                <h4>Discover &amp; Select</h4>
                <p>
                  Explore our diverse handicraft collections and identify the
                  products that match your needs.
                </p>
              </div>
            </li>

            <li>
              <span class="proc-ic"><i class="fa-solid fa-comments"></i></span>
              <div class="proc-text">
                <h4>Enquiry &amp; Consultation</h4>
                <p>
                  Share your product preferences, quantities and customization
                  requirements with our team.
                </p>
              </div>
            </li>

            <li>
              <span class="proc-ic"
                ><i class="fa-solid fa-clipboard-check"></i
              ></span>
              <div class="proc-text">
                <h4>Confirmation &amp; Preparation</h4>
                <p>
                  Discuss product availability, pricing, packaging and delivery
                  arrangements before order confirmation.
                </p>
              </div>
            </li>

            <li>
              <span class="proc-ic"
                ><i class="fa-solid fa-truck-fast"></i
              ></span>
              <div class="proc-text">
                <h4>Dispatch &amp; Delivery</h4>
                <p>
                  Once the order is finalized, products are prepared and
                  dispatched according to the agreed arrangements.
                </p>
              </div>
            </li>
          </ol>

          <div class="proc-btns">
            <button
              type="button"
              class="btn btn-primary"
              data-model=".enquiry-pop"
            >
              Start Your Enquiry
            </button>
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
      <div
        class="swiper fourSlider"
        data-mob="1.4"
        data-sm="2.2"
        data-lg="4"
        data-xl="4"
      >
        <div class="swiper-wrapper">
          <!-- OFFICIAL STORE (current site, highlighted, first) -->
          <div class="swiper-slide">
            <a href="{{ route('products') }}" class="mp-card mp-official" aria-label="Continue shopping on Parijaat Handicraft">
              <figure class="mp-logo">
                <img src="assets/images/logo.png" alt="Parijaat Handicraft" width="160" height="60" loading="lazy" />
              </figure>
              <small class="mp-here">You're Shopping Here</small>
              <h4>Parijaat Handicraft</h4>
              <p>Our official store with exclusive coupons and festive offers.</p>
              <span class="mp-link">Continue Shopping <i class="fa-solid fa-arrow-right"></i></span>
            </a>
          </div>

          <!-- AMAZON -->
          <div class="swiper-slide">
            <a href="javascript:void(0)" class="mp-card"  aria-label="Visit our Amazon store">
              <figure class="mp-logo">
                <img src="assets/icon/amazon.png" alt="Amazon" width="160" height="60" loading="lazy" />
              </figure>
              <h4>Amazon</h4>
              <p>Shop our handcrafted range on Amazon.</p>
              <span class="mp-link">Visit Store <i class="fa-solid fa-arrow-right"></i></span>
            </a>
          </div>

          <!-- ALIBABA -->
          <div class="swiper-slide">
            <a href="javascript:void(0)" class="mp-card"  aria-label="Visit our Alibaba store">
              <figure class="mp-logo">
                <img src="assets/icon/alibaba.png" alt="Alibaba" width="160" height="60" loading="lazy" />
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

      <section class="about-secH">
        <div class="container">
          <div class="heading">
            <small class="eyebrow">TRUST &amp; CREDIBILITY</small>
            <h3>Recognized Credentials. Responsible Business.</h3>
            <p>
              We value transparency and professional business practices. Explore
              our official registrations and certifications.
            </p>
          </div>

          <div class="swiper-wrap">
            <div
              class="swiper fourSlider"
              data-mob="1.3"
              data-sm="2.2"
              data-lg="4"
              data-xl="4"
            >
              <div class="swiper-wrapper">
                <div class="swiper-slide">
                  <article class="cert-card">
                    <a
                      href="assets/images/home/demo1.jpg"
                      class="cert-img glightbox"
                      data-gallery="certs"
                      data-glightbox="title: Quality Certification"
                      aria-label="View Quality Certification"
                    >
                      <img
                        src="assets/images/home/demo1.jpg"
                        alt="Quality Certification"
                        loading="lazy"
                      />
                    </a>
                    <h4>Quality Certification</h4>
                  </article>
                </div>

                <div class="swiper-slide">
                  <article class="cert-card">
                    <a
                      href="assets/images/home/demo1.jpg"
                      class="cert-img glightbox"
                      data-gallery="certs"
                      data-glightbox="title: GST Registration"
                      aria-label="View GST Registration"
                    >
                      <img
                        src="assets/images/home/demo1.jpg"
                        alt="GST Registration"
                        loading="lazy"
                      />
                    </a>
                    <h4>GST Registration</h4>
                  </article>
                </div>

                <div class="swiper-slide">
                  <article class="cert-card">
                    <a
                      href="assets/images/home/demo1.jpg"
                      class="cert-img glightbox"
                      data-gallery="certs"
                      data-glightbox="title: Import Export Registration"
                      aria-label="View Import Export Registration"
                    >
                      <img
                        src="assets/images/home/demo1.jpg"
                        alt="Import Export Registration"
                        loading="lazy"
                      />
                    </a>
                    <h4>Import Export Registration</h4>
                  </article>
                </div>

                <div class="swiper-slide">
                  <article class="cert-card">
                    <a
                      href="assets/images/home/demo1.jpg"
                      class="cert-img glightbox"
                      data-gallery="certs"
                      data-glightbox="title: Business Registration"
                      aria-label="View Business Registration"
                    >
                      <img
                        src="assets/images/home/demo1.jpg"
                        alt="Business Registration"
                        loading="lazy"
                      />
                    </a>
                    <h4>Business Registration</h4>
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

          <div class="cert-btns">
            <a href="{{ route('certifications') }}" class="btn btn-primary"
              >View All Certifications</a
            >
          </div>
        </div>
      </section>

      <section class="about-secI">
        <div class="container">
          <div class="bulk-grid">
            <!-- LEFT : HEADING -->
            <div class="bulk-head">
              <div class="heading left">
                <small class="eyebrow">WHOLESALE &amp; BULK ORDERS</small>
                <h3>Looking for Handicrafts in Bulk?</h3>
                <p>
                  From retail businesses and wholesalers to corporate buyers and
                  international importers, we welcome enquiries for larger
                  product requirements. Tell us what you need, and our team will
                  help you explore the possibilities.
                </p>
              </div>
            </div>

            <!-- RIGHT : 4 STEPS -->
            <ol class="bulk-steps">
              <li>
                <span class="bulk-no">01</span>
                <div class="bulk-text">
                  <h4>Share Your Requirements</h4>
                  <p>
                    Tell us which products you need, the required quantities and
                    your delivery destination.
                  </p>
                </div>
                <span class="bulk-ic"
                  ><i class="fa-solid fa-clipboard-list"></i
                ></span>
              </li>
              <li>
                <span class="bulk-no">02</span>
                <div class="bulk-text">
                  <h4>Receive a Custom Quotation</h4>
                  <p>
                    Our team reviews your enquiry and discusses availability,
                    pricing and shipping requirements.
                  </p>
                </div>
                <span class="bulk-ic"
                  ><i class="fa-solid fa-file-invoice"></i
                ></span>
              </li>
              <li>
                <span class="bulk-no">03</span>
                <div class="bulk-text">
                  <h4>Confirm Your Order</h4>
                  <p>
                    Finalize the products, quantities, pricing and agreed order
                    terms.
                  </p>
                </div>
                <span class="bulk-ic"
                  ><i class="fa-solid fa-handshake"></i
                ></span>
              </li>
              <li>
                <span class="bulk-no">04</span>
                <div class="bulk-text">
                  <h4>Order Preparation &amp; Dispatch</h4>
                  <p>
                    Your order moves forward according to the confirmed
                    packaging and delivery arrangements.
                  </p>
                </div>
                <span class="bulk-ic"
                  ><i class="fa-solid fa-truck-fast"></i
                ></span>
              </li>
            </ol>
          </div>

          <!-- BOTTOM : CTA PANEL -->
          <div class="bulk-cta">
            <div class="bulk-cta-text">
              <h4>Have a Bulk Requirement?</h4>
              <p>
                Get in touch with our team to discuss your business needs and
                request a quotation.
              </p>
            </div>
            <button
              type="button"
              class="btn btn-primary"
              data-model=".enquiry-pop"
            >
              Request a Bulk Quote <i class="fa-solid fa-arrow-right"></i>
            </button>
          </div>
        </div>
      </section>

      <!-- ================= SEC E : GRADIENT CTA ================= -->
      <section class="contact-secE">
        <div class="container">
          <div class="cta-box">
            <!-- decorative glow circles -->
            <span class="cta-orb cta-orb-1" aria-hidden="true"></span>
            <span class="cta-orb cta-orb-2" aria-hidden="true"></span>
            <i class="fa-solid fa-handshake cta-mark" aria-hidden="true"></i>

            <!-- LEFT : CONTENT -->
            <div class="cta-left">
              <small class="eyebrow">STILL HAVE QUESTIONS?</small>
              <h3>Let's Bring Handcrafted Beauty to You.</h3>
              <p>
                Explore our collections, request a bulk quote or chat with our
                team. We're here to help you find the right pieces.
              </p>

              <div class="cta-btns">
                <a href="{{ route('products') }}" class="btn btn-white">
                  Explore Collections <i class="fa-solid fa-arrow-right"></i>
                </a>
                <a
                  href="https://wa.me/910000000000"
                  target="_blank"
                  rel="noopener"
                  class="btn cta-line"
                >
                  <i class="fa-brands fa-whatsapp"></i> WhatsApp Us
                </a>
              </div>
            </div>

            <!-- RIGHT : QUICK ACTION CARDS -->
            <ul class="cta-actions">
              <li>
                <a href="tel:+910000000000" class="cta-action">
                  <span class="cta-action-ic"
                    ><i class="fa-solid fa-phone"></i
                  ></span>
                  <span class="cta-action-text">
                    <b>Call Our Team</b>
                    <small>Mon – Sat, 10 AM – 7 PM</small>
                  </span>
                  <i class="fa-solid fa-arrow-right cta-action-go"></i>
                </a>
              </li>
              <li>
                <button
                  type="button"
                  class="cta-action"
                  data-model=".enquiry-pop"
                >
                  <span class="cta-action-ic"
                    ><i class="fa-solid fa-boxes-stacked"></i
                  ></span>
                  <span class="cta-action-text">
                    <b>Request a Bulk Quote</b>
                    <small>Reply within 1–2 business days</small>
                  </span>
                  <i class="fa-solid fa-arrow-right cta-action-go"></i>
                </button>
              </li>
              <li>
                <a href="mailto:info@parijaathandicraft.com" class="cta-action">
                  <span class="cta-action-ic"
                    ><i class="fa-solid fa-envelope"></i
                  ></span>
                  <span class="cta-action-text">
                    <b>Email Us</b>
                    <small>info@parijaathandicraft.com</small>
                  </span>
                  <i class="fa-solid fa-arrow-right cta-action-go"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </section>
    </main>
  
@endsection