{{-- resources/views/front-pages/certifications.blade.php --}}
@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/sass/certifications/certifications.css') }}" />
@endpush

@section('content')
    @php
        // Static data for now – swap with DB/controller data later.
        $certs = [
            ['ISO Certification', 'assets/images/home/demo1.jpg'],
            ['GST Registration', 'assets/images/home/demo1.jpg'],
            ['Import Export Code', 'assets/images/home/demo1.jpg'],
            ['Udyam Registration', 'assets/images/home/demo1.jpg'],
            ['ISO Certification', 'assets/images/home/demo1.jpg'],
            ['GST Registration', 'assets/images/home/demo1.jpg'],
            ['Import Export Code', 'assets/images/home/demo1.jpg'],
            ['Udyam Registration', 'assets/images/home/demo1.jpg'],
        ];

        $standards = [
            ['fa-eye', 'Business Transparency', 'Clear and accessible business credentials.'],
            ['fa-scale-balanced', 'Professional Standards', 'Commitment to applicable business requirements.'],
            ['fa-award', 'Quality Consciousness', 'Attention to product selection and presentation.'],
            ['fa-handshake', 'Trusted Relationships', 'Building lasting relationships with customers and partners.'],
        ];
    @endphp

    <main>
        <section class="comman-banner">
            <figure class="banner-media">
                <img src="{{ asset('assets/images/home/faq.png') }}" alt="" loading="eager" />
            </figure>

            <div class="banner-top">
                <div class="container">
                    <ul class="banner-crumb">
                        <li><a href="index.html">Home</a></li>
                        <li><i class="fa-solid fa-chevron-right"></i></li>
                        <li class="current">Certifications &amp; Registrations</li>
                    </ul>
                </div>
            </div>

            <div class="container">
                <div class="banner-content">
                    <h1>Certifications &amp; Registrations</h1>
                    <p>Built on Trust. Backed by Credentials.</p>
                </div>
            </div>
        </section>

        <section class="cert-secA">
            <div class="container">
                <div class="intro-grid">
                    <div class="intro-content">
                        <div class="heading left">
                            <small class="eyebrow">TRUST &amp; TRANSPARENCY</small>
                            <h3>A Commitment to Standards. A Foundation of Trust.</h3>
                            <p>
                                At Parijaat Handicraft, we believe that trust is built through transparency, responsible
                                business practices and a commitment to professional standards.
                            </p>
                            <p>
                                Our company registrations and certifications reflect the credentials we hold as a
                                business and give our customers and business partners greater confidence when working
                                with us.
                            </p>
                        </div>

                        <div class="intro-note">
                            <small>Our Promise</small>
                            <p>
                                We maintain transparency and make relevant business documentation accessible whenever
                                required.
                            </p>
                        </div>
                    </div>

                    <div class="intro-media">
                        <figure>
                            <img src="{{ asset('assets/images/home/pro30.jpg') }}"
                                alt="Handcrafted products by Parijaat Handicraft" loading="lazy" />
                        </figure>
                        <div class="intro-badge">
                            <span class="intro-badge-ic"><i class="fa-solid fa-shield-halved"></i></span>
                            <span class="intro-badge-text">
                                <b>Verified Credentials</b>
                                <small>Available on request</small>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="cert-secB">
            <div class="container">
                <div class="heading">
                    <small class="eyebrow">VERIFIED BUSINESS CREDENTIALS</small>
                    <h3>Our Official Certifications &amp; Registrations.</h3>
                    <p>
                        Explore our available business registrations, certificates and official credentials. Each
                        document represents an important part of our business identity and professional compliance.
                    </p>
                </div>

                <div class="cert-grid">
                    @foreach ($certs as [$certTitle, $certImg])
                        <a href="{{ asset($certImg) }}" class="cert-card glightbox" data-gallery="certs"
                            data-glightbox="title: {{ $certTitle }}" aria-label="View {{ $certTitle }}">
                            <span class="cert-img">
                                <img src="{{ asset($certImg) }}" alt="{{ $certTitle }}" loading="lazy" />
                                <span class="cert-zoom"><i class="fa-solid fa-magnifying-glass-plus"></i></span>
                            </span>
                            <h4>{{ $certTitle }}</h4>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="cert-secC">
            <div class="container">
                <div class="heading">
                    <small class="eyebrow">OUR BUSINESS COMMITMENT</small>
                    <h3>Standards That Support Better Business.</h3>
                    <p>
                        We value responsible business practices, transparent communication and a quality-conscious
                        approach in every business interaction.
                    </p>
                </div>

                <ul class="std-grid">
                    @foreach ($standards as [$sIcon, $sTitle, $sText])
                        <li>
                            <span class="std-ic"><i class="fa-solid {{ $sIcon }}"></i></span>
                            <h4>{{ $sTitle }}</h4>
                            <p>{{ $sText }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>

        <section class="contact-secE">
            <div class="container">
                <div class="cta-box">
                    <span class="cta-orb cta-orb-1" aria-hidden="true"></span>
                    <span class="cta-orb cta-orb-2" aria-hidden="true"></span>
                    <i class="fa-solid fa-file-shield cta-mark" aria-hidden="true"></i>

                    <div class="cta-left">
                        <small class="eyebrow">HERE TO HELP</small>
                        <h3>Need More Information About Our Credentials?</h3>
                        <p>
                            For business verification, documentation requests or partnership-related enquiries, our team
                            will be happy to assist you.
                        </p>

                        <div class="cta-btns">
                            <a href="contact.html" class="btn btn-white">
                                Contact Our Team <i class="fa-solid fa-arrow-right"></i>
                            </a>
                            <button type="button" class="btn cta-line" data-model=".enquiry-pop">
                                <i class="fa-solid fa-boxes-stacked"></i> Bulk Enquiry
                            </button>
                        </div>
                    </div>

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
                            <a href="https://wa.me/910000000000" target="_blank" rel="noopener" class="cta-action">
                                <span class="cta-action-ic"><i class="fa-brands fa-whatsapp"></i></span>
                                <span class="cta-action-text">
                                    <b>Chat on WhatsApp</b>
                                    <small>Request documents directly</small>
                                </span>
                                <i class="fa-solid fa-arrow-right cta-action-go"></i>
                            </a>
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