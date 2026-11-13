@extends('layouts.app')

@section('title', 'FAQs | Parijaat Handicraft')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/sass/faqs/faqs.css') }}" />
@endpush

@section('content')
<main>
    <!-- ================= BANNER ================= -->
    <section class="comman-banner">
        <figure class="banner-media">
            <img src="{{ asset('assets/images/home/faq.png') }}" alt="" loading="eager" />
        </figure>

        <!-- BREADCRUMB (top) -->
        <div class="banner-top">
            <div class="container">
                <ul class="banner-crumb">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><i class="fa-solid fa-chevron-right"></i></li>
                    <li class="current">Frequently Asked Questions</li>
                </ul>
            </div>
        </div>

        <div class="container">
            <div class="banner-content">
                <h1>Frequently Asked Questions</h1>
                <p>Answers on our handcrafted pieces, orders, delivery and care.</p>
            </div>
        </div>
    </section>

    <!-- ================= SEC B : INTRO ================= -->
    <section class="faq-secB">
        <div class="container">
            <div class="heading">
                <small class="eyebrow">NEED SOME HELP?</small>
                <h3>Everything You Need to Know Before You Shop.</h3>
                <p>
                    Whether you are choosing a brass diya, planning a pooja corner or
                    checking on an order, find quick answers to the questions our
                    customers ask most often.
                </p>
            </div>
        </div>
    </section>

    <!-- ================= SEC C : TABS + ACCORDION ================= -->
    <section class="faq-secC">
        <div class="container">
            <div class="faq-layout">
                <ul class="tab-nav">
                    <li class="active" data-tab="1">
                        <span class="tab-ico"><i class="fa-solid fa-bag-shopping"></i></span>
                        <span class="tab-txt">Shopping &amp; Collections</span>
                    </li>
                    <li data-tab="2">
                        <span class="tab-ico"><i class="fa-solid fa-gem"></i></span>
                        <span class="tab-txt">Product &amp; Care</span>
                    </li>
                    <li data-tab="3">
                        <span class="tab-ico"><i class="fa-solid fa-credit-card"></i></span>
                        <span class="tab-txt">Orders &amp; Payments</span>
                    </li>
                    <li data-tab="4">
                        <span class="tab-ico"><i class="fa-solid fa-truck-fast"></i></span>
                        <span class="tab-txt">Shipping &amp; Delivery</span>
                    </li>
                    <li data-tab="5">
                        <span class="tab-ico"><i class="fa-solid fa-rotate-left"></i></span>
                        <span class="tab-txt">Returns &amp; Exchanges</span>
                    </li>
                    <li data-tab="6">
                        <span class="tab-ico"><i class="fa-solid fa-headset"></i></span>
                        <span class="tab-txt">Bulk &amp; Support</span>
                    </li>
                </ul>

                <div class="tab-nav-content">
                    <!-- ============ TAB 1 : SHOPPING & COLLECTIONS ============ -->
                    <div class="tabs active" data-tab="1">
                        <div class="accordion-wrapper">
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <h4>What can I shop at Parijaat Handicraft?</h4>
                                    <span class="accordion-icon">+</span>
                                </div>
                                <div class="accordion-content">
                                    <p>
                                        We offer handcrafted brass and copper pieces including
                                        idols and statues, pooja essentials, copper drinkware,
                                        diyas and lamps, antique locks and keys, and bells and
                                        wind chimes. Browse everything in our
                                        <a href="{{ route('products') }}">collections</a>.
                                    </p>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <h4>Are your products handmade?</h4>
                                    <span class="accordion-icon">+</span>
                                </div>
                                <div class="accordion-content">
                                    <p>
                                        Our pieces are handcrafted, so small variations in
                                        detailing, finish and shade are part of their character.
                                        No two pieces are ever exactly alike.
                                    </p>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <h4>Where can I find pieces for pooja and festivals?</h4>
                                    <span class="accordion-icon">+</span>
                                </div>
                                <div class="accordion-content">
                                    <p>
                                        Explore our Pooja Essentials and Brass Diyas &amp; Lamps
                                        categories for traditional pieces made for devotion and
                                        celebration. Festive offers are shown on our home page
                                        during the season.
                                    </p>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <h4>Do you have gift options?</h4>
                                    <span class="accordion-icon">+</span>
                                </div>
                                <div class="accordion-content">
                                    <p>
                                        Yes. Our gift collection includes housewarming gifts,
                                        traditional gifts and collectible treasures, each made
                                        to leave a lasting impression on any occasion.
                                    </p>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <h4>Do you offer discounts and coupon codes?</h4>
                                    <span class="accordion-icon">+</span>
                                </div>
                                <div class="accordion-content">
                                    <p>
                                        Current offers and coupon codes are displayed on our
                                        website. Terms and conditions apply, and offers are
                                        valid for a limited time.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ============ TAB 2 : PRODUCT & CARE ============ -->
                    <div class="tabs" data-tab="2">
                        <div class="accordion-wrapper">
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <h4>How can I check the details of a product before ordering?</h4>
                                    <span class="accordion-icon">+</span>
                                </div>
                                <div class="accordion-content">
                                    <p>
                                        Open the product page to view the images, material and
                                        finish details, product description, pricing and offers
                                        before placing your order.
                                    </p>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <h4>What is the difference between lacquered and raw brass?</h4>
                                    <span class="accordion-icon">+</span>
                                </div>
                                <div class="accordion-content">
                                    <p>
                                        Lacquered brass has a protective coating for a lasting
                                        shine, while raw brass is left unlacquered so it can age
                                        naturally. The finish is listed on each product page.
                                    </p>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <h4>How do I clean and polish brass at home?</h4>
                                    <span class="accordion-icon">+</span>
                                </div>
                                <div class="accordion-content">
                                    <p>
                                        Wipe dust with a soft dry cloth, and use mild soap and
                                        warm water on lacquered pieces. Raw brass can be
                                        polished gently when it loses its shine. Read our full
                                        <a href="{{ route('blog.detail') }}">brass care guide</a> for
                                        step-by-step tips.
                                    </p>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <h4>Will the colour look exactly the same as shown online?</h4>
                                    <span class="accordion-icon">+</span>
                                </div>
                                <div class="accordion-content">
                                    <p>
                                        We try to show colours as accurately as possible. Slight
                                        variations may occur due to photography, lighting and
                                        individual screen settings.
                                    </p>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <h4>Can I ask about availability before ordering?</h4>
                                    <span class="accordion-icon">+</span>
                                </div>
                                <div class="accordion-content">
                                    <p>
                                        Yes. To confirm availability or product details, reach
                                        our team through the
                                        <a href="{{ route('contact') }}">Contact page</a>
                                        by call or WhatsApp.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ============ TAB 3 : ORDERS & PAYMENTS ============ -->
                    <div class="tabs" data-tab="3">
                        <div class="accordion-wrapper">
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <h4>How can I place an order?</h4>
                                    <span class="accordion-icon">+</span>
                                </div>
                                <div class="accordion-content">
                                    <p>
                                        Choose a product, click Add to Cart or Buy Now, and
                                        complete the checkout steps to confirm your purchase.
                                    </p>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <h4>What payment methods are available?</h4>
                                    <span class="accordion-icon">+</span>
                                </div>
                                <div class="accordion-content">
                                    <p>
                                        Available payment methods are displayed at checkout.
                                        Please review the options shown for your order before
                                        paying.
                                    </p>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <h4>How do I use a coupon code?</h4>
                                    <span class="accordion-icon">+</span>
                                </div>
                                <div class="accordion-content">
                                    <p>
                                        Enter a valid coupon code at checkout. Each code has its
                                        own terms and validity, which are mentioned alongside
                                        the offer.
                                    </p>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <h4>Can I cancel my order after placing it?</h4>
                                    <span class="accordion-icon">+</span>
                                </div>
                                <div class="accordion-content">
                                    <p>
                                        Cancellation depends on the order status and our store
                                        policy. Contact our support team as soon as possible
                                        with your order details.
                                    </p>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <h4>How can I get help with my order?</h4>
                                    <span class="accordion-icon">+</span>
                                </div>
                                <div class="accordion-content">
                                    <p>
                                        Contact our team with your order number and query. We
                                        can help with order questions, product information and
                                        delivery updates.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ============ TAB 4 : SHIPPING & DELIVERY ============ -->
                    <div class="tabs" data-tab="4">
                        <div class="accordion-wrapper">
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <h4>How long will my order take to arrive?</h4>
                                    <span class="accordion-icon">+</span>
                                </div>
                                <div class="accordion-content">
                                    <p>
                                        Delivery time depends on your location, product
                                        availability and the shipping method used. The
                                        applicable delivery information is shown during
                                        checkout.
                                    </p>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <h4>Do you offer free shipping?</h4>
                                    <span class="accordion-icon">+</span>
                                </div>
                                <div class="accordion-content">
                                    <p>
                                        Free shipping offers and their eligibility are shown on
                                        our website and at checkout. Terms and conditions apply.
                                    </p>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <h4>Can I track my order?</h4>
                                    <span class="accordion-icon">+</span>
                                </div>
                                <div class="accordion-content">
                                    <p>
                                        If tracking is available for your shipment, the details
                                        are shared once your order has been dispatched.
                                    </p>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <h4>Do you deliver outside India?</h4>
                                    <span class="accordion-icon">+</span>
                                </div>
                                <div class="accordion-content">
                                    <p>
                                        We serve customers in India and abroad. Availability for
                                        your location is shown at checkout, and customers in the
                                        United States can also shop through our Amazon store.
                                    </p>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <h4>What should I do if my order is delayed?</h4>
                                    <span class="accordion-icon">+</span>
                                </div>
                                <div class="accordion-content">
                                    <p>
                                        If your order has not arrived within the expected
                                        period, contact our support team with your order number
                                        and we will check the latest shipment information for
                                        you.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ============ TAB 5 : RETURNS & EXCHANGES ============ -->
                    <div class="tabs" data-tab="5">
                        <div class="accordion-wrapper">
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <h4>Can I return or exchange a product?</h4>
                                    <span class="accordion-icon">+</span>
                                </div>
                                <div class="accordion-content">
                                    <p>
                                        Returns and exchanges are subject to the applicable
                                        product and store policy. Please review the Returns
                                        &amp; Exchanges policy for eligibility, timelines and
                                        exclusions before raising a request.
                                    </p>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <h4>What if I receive a damaged or incorrect product?</h4>
                                    <span class="accordion-icon">+</span>
                                </div>
                                <div class="accordion-content">
                                    <p>
                                        Contact our support team as soon as possible with your
                                        order details and clear photographs of the product and
                                        packaging. We will guide you through the next steps.
                                    </p>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <h4>Is a small variation in a handcrafted piece a defect?</h4>
                                    <span class="accordion-icon">+</span>
                                </div>
                                <div class="accordion-content">
                                    <p>
                                        Minor variations in detailing and finish are natural in
                                        handcrafted work. If you are unsure whether something is
                                        a variation or a defect, send us photos and our team
                                        will help.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ============ TAB 6 : BULK & SUPPORT ============ -->
                    <div class="tabs" data-tab="6">
                        <div class="accordion-wrapper">
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <h4>Do you accept bulk and wholesale orders?</h4>
                                    <span class="accordion-icon">+</span>
                                </div>
                                <div class="accordion-content">
                                    <p>
                                        Yes. Share your requirements through the
                                        <a href="javascript:void(0);" data-model=".enquiry-pop">bulk enquiry form</a>
                                        and our team will reply with pricing and availability.
                                    </p>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <h4>Can I contact you on WhatsApp before buying?</h4>
                                    <span class="accordion-icon">+</span>
                                </div>
                                <div class="accordion-content">
                                    <p>
                                        Yes. WhatsApp is a convenient way to ask about
                                        availability, finishes, gifting options and general
                                        shopping queries before you order.
                                    </p>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <h4>How can I contact Parijaat Handicraft?</h4>
                                    <span class="accordion-icon">+</span>
                                </div>
                                <div class="accordion-content">
                                    <p>
                                        You can reach our team by phone, WhatsApp or email.
                                        Visit the
                                        <a href="{{ route('contact') }}">Contact page</a> for all the
                                        available contact details.
                                    </p>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <h4>Can I partner with Parijaat Handicraft?</h4>
                                    <span class="accordion-icon">+</span>
                                </div>
                                <div class="accordion-content">
                                    <p>
                                        If you love handcrafted products and want to introduce
                                        them to a wider audience, use the Apply for Partnership
                                        option on our home page and our team will get in touch.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= SEC D : GRADIENT HELP BOX ================= -->
    <section class="faq-secD">
        <div class="container">
            <div class="help-box">
                <span class="help-orb help-orb-1" aria-hidden="true"></span>
                <span class="help-orb help-orb-2" aria-hidden="true"></span>
                <i class="fa-regular fa-circle-question help-mark" aria-hidden="true"></i>

                <div class="help-content">
                    <div class="heading left">
                        <small class="eyebrow">STILL HAVE A QUESTION?</small>
                        <h3>We're Here to Help.</h3>
                        <p>
                            Couldn't find the answer you were looking for? Speak with our
                            team and we'll be happy to help with product details,
                            availability, orders or choosing the right piece for your
                            home.
                        </p>
                    </div>
                    <span class="help-meta">
                        <i class="fa-regular fa-clock"></i> Mon – Sat, 10 AM – 7 PM
                    </span>
                </div>

                <ul class="help-actions">
                    <li>
                        <a href="https://wa.me/919876543210" target="_blank" rel="noopener" class="help-action">
                            <span class="help-action-ic"><i class="fa-brands fa-whatsapp"></i></span>
                            <span class="help-action-text">
                                <b>Chat on WhatsApp</b>
                                <small>Quick replies on product queries</small>
                            </span>
                            <i class="fa-solid fa-arrow-right help-action-go"></i>
                        </a>
                    </li>
                    <li>
                        <a href="tel:+919876543210" class="help-action">
                            <span class="help-action-ic"><i class="fa-solid fa-phone"></i></span>
                            <span class="help-action-text">
                                <b>Call Our Team</b>
                                <small>+91 98765 43210</small>
                            </span>
                            <i class="fa-solid fa-arrow-right help-action-go"></i>
                        </a>
                    </li>
                    <li>
                        <a href="mailto:info@parijaathandicraft.com" class="help-action">
                            <span class="help-action-ic"><i class="fa-solid fa-envelope"></i></span>
                            <span class="help-action-text">
                                <b>Email Us</b>
                                <small>info@parijaathandicraft.com</small>
                            </span>
                            <i class="fa-solid fa-arrow-right help-action-go"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </section>
</main>
@endsection