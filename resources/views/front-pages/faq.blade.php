@extends('layouts.app')

@section('title', 'FAQs | ' . config('app.name'))

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
    @if($categories->isNotEmpty())
        <section class="faq-secC">
            <div class="container">
                <div class="faq-layout">
                    <ul class="tab-nav">
                        @foreach($categories as $cat)
                            <li @class(['active' => $loop->first]) data-tab="{{ $loop->iteration }}">
                                @if($cat->icon_class)
                                    <span class="tab-ico"><i class="{{ $cat->icon_class }}"></i></span>
                                @endif
                                <span class="tab-txt">{{ $cat->name }}</span>
                            </li>
                        @endforeach
                    </ul>

                    <div class="tab-nav-content">
                        @foreach($categories as $cat)
                            <div @class(['tabs', 'active' => $loop->first]) data-tab="{{ $loop->iteration }}">
                                <div class="accordion-wrapper">
                                    @foreach($cat->faqs as $faq)
                                        <div class="accordion-item">
                                            <div class="accordion-header">
                                                <h4>{{ $faq->question }}</h4>
                                                <span class="accordion-icon">+</span>
                                            </div>
                                            <div class="accordion-content">
                                                <p>{!! $faq->answer_html !!}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

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
                    @if($contact['hours'])
                        <span class="help-meta">
                            <i class="fa-regular fa-clock"></i> {{ $contact['hours'] }}
                        </span>
                    @endif
                </div>

                @if($contact['whatsapp'] || $contact['phone_link'] || $contact['email'])
                    <ul class="help-actions">
                        @if($contact['whatsapp'])
                            <li>
                                <a href="https://wa.me/{{ $contact['whatsapp'] }}" target="_blank" rel="noopener"
                                    class="help-action">
                                    <span class="help-action-ic"><i class="fa-brands fa-whatsapp"></i></span>
                                    <span class="help-action-text">
                                        <b>Chat on WhatsApp</b>
                                        <small>Quick replies on product queries</small>
                                    </span>
                                    <i class="fa-solid fa-arrow-right help-action-go"></i>
                                </a>
                            </li>
                        @endif
                        @if($contact['phone_link'])
                            <li>
                                <a href="tel:{{ $contact['phone_link'] }}" class="help-action">
                                    <span class="help-action-ic"><i class="fa-solid fa-phone"></i></span>
                                    <span class="help-action-text">
                                        <b>Call Our Team</b>
                                        <small>{{ $contact['phone'] }}</small>
                                    </span>
                                    <i class="fa-solid fa-arrow-right help-action-go"></i>
                                </a>
                            </li>
                        @endif
                        @if($contact['email'])
                            <li>
                                <a href="mailto:{{ $contact['email'] }}" class="help-action">
                                    <span class="help-action-ic"><i class="fa-solid fa-envelope"></i></span>
                                    <span class="help-action-text">
                                        <b>Email Us</b>
                                        <small>{{ $contact['email'] }}</small>
                                    </span>
                                    <i class="fa-solid fa-arrow-right help-action-go"></i>
                                </a>
                            </li>
                        @endif
                    </ul>
                @endif
            </div>
        </div>
    </section>
</main>
@endsection