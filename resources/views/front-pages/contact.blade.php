@extends('layouts.app')

@section('title', 'Contact Us | Parijaat Handicraft')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/sass/contact/contact.css') }}" />
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
                    <li class="current">Contact Us</li>
                </ul>
            </div>
        </div>

        <div class="container">
            <div class="banner-content">
                <h1>Contact Us</h1>
                <p>We'd Love to Hear From You.</p>
            </div>
        </div>
    </section>

    <!-- ================= SEC A : CONTACT INFO CARDS ================= -->
    <section class="contact-secA">
        <div class="container">
            <div class="heading">
                <small class="eyebrow">GET IN TOUCH</small>
                <h3>Let's Start a Conversation.</h3>
                <p>
                    Questions about a product, an order or a bulk requirement? Reach
                    out to our team and we'll be happy to help.
                </p>
            </div>

            {{-- DEV NOTE: Phone, email and address are placeholders. Replace with client-confirmed details. --}}
            <ul class="ct-info">
                <li>
                    <span class="ct-ic"><i class="fa-solid fa-phone"></i></span>
                    <h4>Call Us</h4>
                    <p>Speak directly with our support team.</p>
                    <a href="tel:+910000000000">+91 00000 00000</a>
                </li>

                <li>
                    <span class="ct-ic"><i class="fa-solid fa-envelope"></i></span>
                    <h4>Email Us</h4>
                    <p>Send us your queries anytime.</p>
                    <a href="mailto:info@parijaathandicraft.com">info@parijaathandicraft.com</a>
                </li>

                <li>
                    <span class="ct-ic"><i class="fa-brands fa-whatsapp"></i></span>
                    <h4>WhatsApp</h4>
                    <p>Quick answers and product help.</p>
                    <a href="https://wa.me/910000000000" target="_blank" rel="noopener">Chat on WhatsApp</a>
                </li>

                <li>
                    <span class="ct-ic"><i class="fa-solid fa-location-dot"></i></span>
                    <h4>Visit Us</h4>
                    <p>Parijaat Handicraft, Your Street Address, City, State - 000000</p>
                    <a href="#ct-map">View on Map</a>
                </li>
            </ul>
        </div>
    </section>

    <!-- ================= SEC B : FORMS (TABS) + SIDE INFO ================= -->
    <section class="contact-secB">
        <div class="container">
            <div class="ct-grid">
                <div class="ct-main">
                    <div class="heading left">
                        <small class="eyebrow">SEND US A MESSAGE</small>
                        <h3>How Can We Help You?</h3>
                        <p>
                            Choose the type of enquiry and fill in the form. Our team will
                            get back to you shortly.
                        </p>
                    </div>

                    <ul class="tab-nav">
                        <li data-tab="1" class="active"><i class="fa-regular fa-comments"></i> General Enquiry</li>
                        <li data-tab="2"><i class="fa-solid fa-boxes-stacked"></i> Bulk / Wholesale</li>
                    </ul>

                    <div class="tab-nav-content">
                        <!-- TAB 1 : GENERAL -->
                        <div class="tabs active" data-tab="1">
                            <div class="ct-form-card">
                                <div class="ct-card-head">
                                    <h4>General Enquiry</h4>
                                    <p>Questions about products, orders, shipping or anything else.</p>
                                </div>

                                <form class="form ct-form" id="contactForm" action="#" method="post" novalidate>
                                    @csrf
                                    <div class="ct-group">
                                        <div class="ct-row">
                                            <div class="form-group">
                                                <input type="text" id="ctName" name="full_name" placeholder=" " autocomplete="name" />
                                                <label for="ctName">Full Name *</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="email" id="ctEmail" name="email" placeholder=" " autocomplete="email" />
                                                <label for="ctEmail">Email Address *</label>
                                            </div>
                                        </div>

                                        <div class="ct-row">
                                            <div class="form-group phone-group">
                                                <input type="tel" id="ctPhone" name="phone" class="js-phone" placeholder="Phone Number " inputmode="tel" autocomplete="tel" />
                                                <input type="hidden" name="phone_full" />
                                                <input type="hidden" name="country_code" />
                                                <input type="hidden" name="dial_code" />
                                            </div>
                                            <div class="form-group">
                                                <select id="ctSubject" name="subject" required>
                                                    <option value="">Subject *</option>
                                                    <option>Product Information</option>
                                                    <option>Order Status</option>
                                                    <option>Shipping &amp; Delivery</option>
                                                    <option>Returns &amp; Support</option>
                                                    <option>Feedback</option>
                                                    <option>Other</option>
                                                </select>
                                                <label for="ctSubject">Subject *</label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <textarea id="ctMsg" name="message" placeholder=" "></textarea>
                                            <label for="ctMsg">Your Message *</label>
                                        </div>
                                    </div>

                                    <div class="ct-foot">
                                        <button type="submit" class="btn btn-primary ct-submit">Send Message</button>
                                        <p class="ct-note">
                                            <i class="fa-solid fa-lock"></i>
                                            Your details are private and used only to reply to you.
                                        </p>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- TAB 2 : BULK -->
                        <div class="tabs" data-tab="2">
                            <div class="ct-form-card">
                                <div class="ct-card-head">
                                    <h4>Get Your Bulk Quote</h4>
                                    <p>
                                        Tell us what you need. We'll reply with pricing and
                                        availability within 1–2 business days.
                                    </p>
                                </div>

                                <form class="form ct-form" id="bulkForm" action="#" method="post" enctype="multipart/form-data" novalidate>
                                    @csrf
                                    <div class="ct-group">
                                        <span class="ct-label">Your Details</span>

                                        <div class="ct-row">
                                            <div class="form-group">
                                                <input type="text" id="bkName" name="full_name" placeholder=" " autocomplete="name" />
                                                <label for="bkName">Full Name *</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" id="bkCompany" name="company" placeholder=" " autocomplete="organization" />
                                                <label for="bkCompany">Company Name *</label>
                                            </div>
                                        </div>

                                        <div class="ct-row">
                                            <div class="form-group">
                                                <input type="email" id="bkEmail" name="email" placeholder=" " autocomplete="email" />
                                                <label for="bkEmail">Business Email *</label>
                                            </div>
                                            <div class="form-group phone-group">
                                                <input type="tel" id="bkPhone" name="phone" class="js-phone" placeholder=" Phone Number" inputmode="tel" autocomplete="tel" />
                                                <input type="hidden" name="phone_full" />
                                                <input type="hidden" name="country_code" />
                                                <input type="hidden" name="dial_code" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="ct-group">
                                        <span class="ct-label">Your Requirement</span>

                                        <div class="ct-row">
                                            <div class="form-group">
                                                <select id="bkCategory" name="category" required>
                                                    <option value="">Product Category *</option>
                                                    <option>Home Decor</option>
                                                    <option>Pooja Essentials</option>
                                                    <option>Kitchen &amp; Dining</option>
                                                    <option>Metal Handicrafts</option>
                                                    <option>Gifts &amp; Collections</option>
                                                    <option>Mixed Order</option>
                                                </select>
                                                <label for="bkCategory">Product Category *</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" id="bkQty" name="quantity" placeholder=" " inputmode="numeric" />
                                                <label for="bkQty">Quantity (pcs) *</label>
                                            </div>
                                        </div>

                                        <div class="ct-row">
                                            <div class="form-group">
                                                <input type="text" id="bkCountry" name="country" placeholder=" " autocomplete="country-name" />
                                                <label for="bkCountry">Ship To (Country) *</label>
                                            </div>
                                            <div class="form-group">
                                                <select id="bkFreq" name="frequency">
                                                    <option value="">Order Frequency</option>
                                                    <option>One-time order</option>
                                                    <option>Monthly</option>
                                                    <option>Quarterly</option>
                                                    <option>Seasonal / Yearly</option>
                                                </select>
                                                <label for="bkFreq">Order Frequency</label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <textarea id="bkMsg" name="message" placeholder=" "></textarea>
                                            <label for="bkMsg">Product names / SKUs, size, customization</label>
                                        </div>

                                        <label class="ct-upload" for="bkFile">
                                            <span class="ct-upload-ic">
                                                <svg viewBox="0 0 24 24" aria-hidden="true">
                                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                                    <path d="m17 8-5-5-5 5" />
                                                    <path d="M12 3v12" />
                                                </svg>
                                            </span>
                                            <span class="ct-upload-text">
                                                <b>Attach reference images or files</b>
                                                <small>Optional · JPG, PNG, PDF, DOC · max 10 MB each</small>
                                            </span>
                                            <input type="file" id="bkFile" name="reference[]"
                                                accept=".jpg,.jpeg,.png,.webp,.pdf,.doc,.docx,.xls,.xlsx" multiple />
                                        </label>
                                    </div>

                                    <div class="ct-foot">
                                        <button type="submit" class="btn btn-primary ct-submit">Request Quote</button>
                                        <p class="ct-note">
                                            <i class="fa-solid fa-lock"></i>
                                            Your details are private and used only for this enquiry.
                                        </p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <aside class="ct-side">
                    <figure class="ct-side-img">
                        <img src="{{ asset('assets/images/home/pro30.jpg') }}" alt="Handcrafted brass decor" loading="lazy" />
                        <figcaption>
                            <small>Handcrafted with care</small>
                            <b>Every enquiry is answered by a real person.</b>
                        </figcaption>
                    </figure>

                    <div class="ct-side-box">
                        <h5><i class="fa-regular fa-clock"></i> Business Hours</h5>
                        <ul class="ct-hours">
                            <li><span>Monday – Saturday</span><b>10:00 AM – 7:00 PM</b></li>
                            <li><span>Sunday</span><b>Closed</b></li>
                        </ul>
                        <p>We usually reply within 1–2 business days.</p>
                    </div>

                    <div class="ct-side-box">
                        <h5><i class="fa-solid fa-share-nodes"></i> Follow Us</h5>
                        <ul class="ct-social">
                            <li><a href="javascript:void(0)" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a></li>
                            <li><a href="javascript:void(0)" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a></li>
                            <li><a href="javascript:void(0)" aria-label="Pinterest"><i class="fa-brands fa-pinterest-p"></i></a></li>
                            <li><a href="javascript:void(0)" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a></li>
                        </ul>
                    </div>
                </aside>
            </div>
        </div>
    </section>

    <!-- ================= SEC C : MAP + OFFICE CARD ================= -->
    <section class="contact-secC" id="ct-map">
        <div class="container">
            <div class="heading">
                <small class="eyebrow">FIND US</small>
                <h3>Visit Our Office.</h3>
                <p>Drop by to see our collections or meet our team.</p>
            </div>

            <div class="ct-map-wrap">
                {{-- DEV NOTE: Replace the iframe src with the client's real Google Maps embed link. --}}
                <iframe src="https://www.google.com/maps?q=India&output=embed" title="Parijaat Handicraft location"
                    loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>

                <div class="ct-office">
                    <small class="eyebrow">HEAD OFFICE</small>
                    <h4>Parijaat Handicraft</h4>

                    <ul>
                        <li>
                            <i class="fa-solid fa-location-dot"></i>
                            <span>Your Street Address, City, State - 000000</span>
                        </li>
                        <li>
                            <i class="fa-solid fa-phone"></i>
                            <a href="tel:+910000000000">+91 00000 00000</a>
                        </li>
                        <li>
                            <i class="fa-solid fa-envelope"></i>
                            <a href="mailto:info@parijaathandicraft.com">info@parijaathandicraft.com</a>
                        </li>
                        <li>
                            <i class="fa-regular fa-clock"></i>
                            <span>Mon – Sat, 10:00 AM – 7:00 PM</span>
                        </li>
                    </ul>

                    <a href="https://maps.google.com" target="_blank" rel="noopener" class="btn btn-primary">
                        Get Directions <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= SEC E : GRADIENT CTA ================= -->
    <section class="contact-secE">
        <div class="container">
            <div class="cta-box">
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
                        <a href="https://wa.me/910000000000" target="_blank" rel="noopener" class="btn cta-line">
                            <i class="fa-brands fa-whatsapp"></i> WhatsApp Us
                        </a>
                    </div>
                </div>

                <!-- RIGHT : QUICK ACTION CARDS -->
                <ul class="cta-actions">
                    <li>
                        <a href="tel:+910000000000" class="cta-action">
                            <span class="cta-action-ic"><i class="fa-solid fa-phone"></i></span>
                            <span class="cta-action-text">
                                <b>Call Our Team</b>
                                <small>Mon – Sat, 10 AM – 7 PM</small>
                            </span>
                            <i class="fa-solid fa-arrow-right cta-action-go"></i>
                        </a>
                    </li>
                    <li>
                        <button type="button" class="cta-action" data-model=".enquiry-pop">
                            <span class="cta-action-ic"><i class="fa-solid fa-boxes-stacked"></i></span>
                            <span class="cta-action-text">
                                <b>Request a Bulk Quote</b>
                                <small>Reply within 1–2 business days</small>
                            </span>
                            <i class="fa-solid fa-arrow-right cta-action-go"></i>
                        </button>
                    </li>
                    <li>
                        <a href="mailto:info@parijaathandicraft.com" class="cta-action">
                            <span class="cta-action-ic"><i class="fa-solid fa-envelope"></i></span>
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