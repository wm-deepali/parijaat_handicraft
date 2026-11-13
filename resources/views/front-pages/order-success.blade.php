@extends('layouts.app')

@section('title', 'Thank You for Your Order | Parijaat Handicraft')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/sass/other/other.css') }}" />
@endpush

@section('content')
<main>
    <section class="comman-banner order-success">
        <div class="container">
            <div class="os-wrap">
                <div class="os-thanks">
                    <div class="success-icon">
                        <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
                    </div>
                    <span class="status">Order Confirmed</span>
                    <h1>Thank You for Your Order!</h1>
                    <p class="msg">
                        Your order is placed successfully. A confirmation has been sent
                        to your email.
                    </p>
                    <div class="btn-grp">
                        <a href="{{ route('dashboard') }}#tab-2" id="trackBtn" class="btn btn-primary">
                            <i class="fa-solid fa-box" aria-hidden="true"></i> Track My Order
                        </a>
                        <a href="{{ route('products') }}" id="shopBtn" class="btn btn-outline-primary">
                            <i class="fa-solid fa-bag-shopping" aria-hidden="true"></i> Shop Again
                        </a>
                    </div>
                </div>
                <div class="os-receipt">
                    <ul class="order-meta">
                        <li><span>Order ID</span><strong>#PH-20481</strong></li>
                        <li><span>Date</span><strong>11 Nov 2026</strong></li>
                        <li><span>Payment</span><strong>Paid Online</strong></li>
                        <li><span>Delivery by</span><strong>Mon, 23 Nov</strong></li>
                    </ul>
                    <div class="order-summary">
                        <ul class="order-items">
                            <li>
                                <img class="thumb" src="{{ asset('assets/images/home/cat1.png') }}"
                                    alt="Handcrafted Brass Idol" width="60" height="60" loading="lazy" />
                                <div class="info">
                                    <h4>Handcrafted Brass Idol</h4>
                                    <p>Brass · Qty 1</p>
                                </div>
                                <span class="price">$399</span>
                            </li>
                            <li>
                                <img class="thumb" src="{{ asset('assets/images/home/cat2.png') }}"
                                    alt="Copper Pooja Thali Set" width="60" height="60" loading="lazy" />
                                <div class="info">
                                    <h4>Copper Pooja Thali Set</h4>
                                    <p>Copper · Qty 2</p>
                                </div>
                                <span class="price">$258</span>
                            </li>
                        </ul>
                        <ul class="order-totals">
                            <li>
                                <span>Subtotal</span>
                                <strong>$657</strong>
                            </li>
                            <li>
                                <span>Coupon (PARIJAAT10)</span>
                                <strong class="is-green">−$66</strong>
                            </li>
                            <li class="grand">
                                <span>Total Paid</span>
                                <strong>$591</strong>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection