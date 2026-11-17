{{-- resources/views/front-pages/cart.blade.php --}}
@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/sass/cart/cart.css') }}" />
@endpush

@section('content')
    @php
        // Static data for now – swap with the real cart (session/DB) later.
        // meta: [label, value, dot colour|null]
        $cartItems = [
            ['name' => 'Handmade Brass Oil Lamp', 'img' => 'assets/images/home/cat4.png', 'cat' => 'Brass Diyas & Lamps',
                'meta' => [['Finish', 'Polished Gold', '#d9a93a'], ['Height', '6 in', null], ['Gift Packaging', 'Yes', null]],
                'price' => '$199', 'old' => '$249', 'off' => '20% OFF', 'qty' => 1, 'total' => '$208',
                'extra' => '+ $9 gift packaging with message card', 'stock' => 'Only 6 pieces left in Polished Gold', 'delivery' => null],
            ['name' => 'Brass Elephant Diya Stand', 'img' => 'assets/images/home/cat1.png', 'cat' => 'Brass Diyas & Lamps',
                'meta' => [['Finish', 'Antique Brass', '#a8782a'], ['Height', '8 in', null]],
                'price' => '$249', 'old' => '$299', 'off' => '17% OFF', 'qty' => 1, 'total' => '$249',
                'extra' => null, 'stock' => null, 'delivery' => 'Ready to ship, dispatched in 2–4 working days'],
            ['name' => 'Brass Aladdin Incense Burner', 'img' => 'assets/images/home/cat2.png', 'cat' => 'Pooja Essentials',
                'meta' => [['Finish', 'Polished Gold', '#d9a93a'], ['Material', 'Solid Brass', null]],
                'price' => '$149', 'old' => '$179', 'off' => '17% OFF', 'qty' => 2, 'total' => '$298',
                'extra' => null, 'stock' => null, 'delivery' => 'Ready to ship, dispatched in 2–4 working days'],
        ];

        $priceRows = [
            ['Total MRP', '$906', ''],
            ['Discount on MRP', '−$160', 'is-green'],
            ['Gift Packaging', '+$9', ''],
            ['Coupon (PARIJAAT10)', '−$75', 'is-green'],
        ];

        $payMethods = [
            ['Visa', 'fa-brands fa-cc-visa'],
            ['Mastercard', 'fa-brands fa-cc-mastercard'],
            ['UPI and Wallets', 'fa-solid fa-mobile-screen-button'],
            ['Net Banking', 'fa-solid fa-building-columns'],
        ];
    @endphp

    <main>
        <section class="cart-secA">
            <div class="container">
                {{-- TOP : title + steps --}}
                <div class="cart-top">
                    <div class="cart-head">
                        <span class="eyebrow">Your Selection</span>
                        <h1>My Cart</h1>
                        <p>4 items · <b>$680</b></p>
                    </div>

                    <ol class="cart-steps" aria-label="Checkout progress">
                        <li class="step is-active" aria-current="step">
                            <span class="step-icon"><i class="fa-solid fa-bag-shopping" aria-hidden="true"></i></span>
                            <span class="step-label">Cart</span>
                        </li>
                        <li class="step">
                            <span class="step-icon"><i class="fa-solid fa-location-dot" aria-hidden="true"></i></span>
                            <span class="step-label">Address</span>
                        </li>
                        <li class="step">
                            <span class="step-icon"><i class="fa-solid fa-credit-card" aria-hidden="true"></i></span>
                            <span class="step-label">Payment</span>
                        </li>
                    </ol>
                </div>

                <div class="cart-layout">
                    {{-- ============ LEFT : ITEMS ============ --}}
                    <div class="cart-main">
                        <div class="ship-progress is-done" style="--p: 100%">
                            <span class="ship-icon"><i class="fa-solid fa-truck-fast" aria-hidden="true"></i></span>
                            <p><b>Free shipping unlocked</b><span>Your order is above $149</span></p>
                            <em>$15 saved</em>
                            <div class="ship-bar"><span></span></div>
                        </div>

                        <div class="cart-card">
                            <div class="cart-cols" aria-hidden="true">
                                <span>Product</span>
                                <span>Total</span>
                            </div>

                            <ul class="cart-list">
                                @foreach ($cartItems as $item)
                                    <li class="cart-item">
                                        <a class="item-img" href="product-detail.html">
                                            <img src="{{ asset($item['img']) }}" alt="{{ $item['name'] }}" width="120"
                                                height="120" loading="lazy" />
                                        </a>
                                        <div class="item-info">
                                            <span class="item-cat">{{ $item['cat'] }}</span>
                                            <h2 class="item-name"><a href="product-detail.html">{{ $item['name'] }}</a></h2>
                                            <ul class="item-meta">
                                                @foreach ($item['meta'] as [$mLabel, $mValue, $mColor])
                                                    <li>
                                                        <span>{{ $mLabel }}</span>
                                                        <b>
                                                            @if ($mColor)
                                                                <i class="dot" style="--c: {{ $mColor }}"></i>
                                                            @endif
                                                            {{ $mValue }}
                                                        </b>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <div class="item-price">
                                                <strong>{{ $item['price'] }}</strong><del>{{ $item['old'] }}</del><span
                                                    class="item-off">{{ $item['off'] }}</span>
                                            </div>
                                            @if ($item['extra'])
                                                <p class="item-extra">{{ $item['extra'] }}</p>
                                            @endif
                                            @if ($item['stock'])
                                                <p class="item-stock">
                                                    <i class="fa-solid fa-circle-exclamation" aria-hidden="true"></i>
                                                    {{ $item['stock'] }}
                                                </p>
                                            @endif
                                            @if ($item['delivery'])
                                                <p class="item-delivery">
                                                    <i class="fa-solid fa-truck" aria-hidden="true"></i>
                                                    {{ $item['delivery'] }}
                                                </p>
                                            @endif
                                            <div class="item-actions">
                                                <div class="cart-qty" role="group"
                                                    aria-label="Quantity for {{ $item['name'] }}">
                                                    <button type="button" class="qty-minus" aria-label="Decrease quantity">
                                                        <i class="fa-solid fa-minus" aria-hidden="true"></i>
                                                    </button>
                                                    <input type="text" class="qty-input" value="{{ $item['qty'] }}"
                                                        readonly aria-label="Quantity" />
                                                    <button type="button" class="qty-plus" aria-label="Increase quantity">
                                                        <i class="fa-solid fa-plus" aria-hidden="true"></i>
                                                    </button>
                                                </div>
                                                <button type="button" class="item-link">
                                                    <i class="fa-regular fa-heart" aria-hidden="true"></i>
                                                    Move to Wishlist
                                                </button>
                                                <button type="button" class="item-link is-remove">
                                                    <i class="fa-regular fa-trash-can" aria-hidden="true"></i>
                                                    Remove
                                                </button>
                                            </div>
                                        </div>
                                        <div class="item-total">
                                            <span>Item total</span>
                                            <strong>{{ $item['total'] }}</strong>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <a href="all-categories-listing.html" class="continue-link">
                            <i class="fa-solid fa-arrow-left-long" aria-hidden="true"></i>
                            Continue Shopping
                        </a>
                    </div>

                    {{-- ============ RIGHT : SUMMARY ============ --}}
                    <aside class="cart-summary" aria-label="Order summary">
                        <div class="sum-head">
                            <h4>Order Summary</h4>
                            <span>4 items</span>
                        </div>

                        {{-- Coupons --}}
                        <div class="box coupon-box">
                            <h5><i class="fa-solid fa-ticket" aria-hidden="true"></i> Coupons &amp; Offers</h5>
                            <form class="form coupon-form" action="#" method="post" novalidate>
                                @csrf
                                <div class="form-group">
                                    <input type="text" id="couponInput" name="coupon" placeholder=" "
                                        autocomplete="off" />
                                    <label for="couponInput">Enter coupon code</label>
                                </div>
                                <button type="submit" class="btn btn-outline-primary">Apply</button>
                            </form>

                            <div class="coupon-applied">
                                <span class="applied-icon"><i class="fa-solid fa-check" aria-hidden="true"></i></span>
                                <div class="applied-text">
                                    <strong>PARIJAAT10 applied</strong>
                                    <span>You saved $75 with this coupon</span>
                                </div>
                                <button type="button" class="applied-remove" aria-label="Remove coupon PARIJAAT10">
                                    Remove
                                </button>
                            </div>

                            <p class="offers-title">Available Offers</p>
                            <ul class="offer-list">
                                <li class="is-applied">
                                    <span class="offer-icon"><i class="fa-solid fa-tag" aria-hidden="true"></i></span>
                                    <div class="offer-text">
                                        <span class="offer-code">PARIJAAT10</span>
                                        <p>Extra 10% off on your first order</p>
                                    </div>
                                    <span class="offer-state">Applied</span>
                                </li>
                                <li class="is-applied">
                                    <span class="offer-icon"><i class="fa-solid fa-truck-fast" aria-hidden="true"></i></span>
                                    <div class="offer-text">
                                        <span class="offer-code">FREESHIP</span>
                                        <p>Free shipping on orders above $149</p>
                                    </div>
                                    <span class="offer-state">Unlocked</span>
                                </li>
                            </ul>
                        </div>

                        {{-- Delivery --}}
                        <div class="box delivery-box">
                            <h5><i class="fa-solid fa-location-dot" aria-hidden="true"></i> Delivery Details</h5>
                            <form class="form pin-form" action="#" method="post" novalidate>
                                @csrf
                                <div class="form-group">
                                    <input type="text" id="cartPin" name="pincode" inputmode="numeric" maxlength="6"
                                        placeholder=" " value="110001" />
                                    <label for="cartPin">Pincode</label>
                                </div>
                                <button type="submit" class="btn btn-outline-primary">Check</button>
                            </form>
                            <p class="pin-result">
                                <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
                                Delivery available. Estimated by <b>Wed, 18 Nov</b>.
                            </p>
                            <ul class="del-points">
                                <li><i class="fa-solid fa-box" aria-hidden="true"></i> Dispatch in 2–4 working days</li>
                                <li><i class="fa-solid fa-earth-asia" aria-hidden="true"></i> Worldwide shipping with tracking</li>
                                <li><i class="fa-solid fa-box-open" aria-hidden="true"></i> Packed to protect metal and finish</li>
                            </ul>
                        </div>

                        {{-- Price --}}
                        <div class="box price-box">
                            <h5>Price Details</h5>
                            <dl class="rows">
                                @foreach ($priceRows as [$rLabel, $rValue, $rClass])
                                    <div class="row {{ $rClass }}">
                                        <dt>{{ $rLabel }}</dt>
                                        <dd>{{ $rValue }}</dd>
                                    </div>
                                @endforeach
                                <div class="row">
                                    <dt>Shipping Fee</dt>
                                    <dd class="is-green"><del>$15</del> Free</dd>
                                </div>
                                <div class="row row-total">
                                    <dt>Total Amount<small>Inclusive of all taxes</small></dt>
                                    <dd>$680</dd>
                                </div>
                            </dl>
                            <p class="save-chip">
                                <i class="fa-solid fa-piggy-bank" aria-hidden="true"></i> You are saving $235 on this order
                            </p>
                            <a href="{{ route('checkout') }}" class="btn btn-primary place-btn">
                                Proceed to Address
                                <i class="fa-solid fa-arrow-right-long" aria-hidden="true"></i>
                            </a>
                            <ul class="pay-methods" aria-label="Accepted payment methods">
                                @foreach ($payMethods as [$pTitle, $pIcon])
                                    <li title="{{ $pTitle }}">
                                        <i class="{{ $pIcon }}" aria-hidden="true"></i><span
                                            class="sr-only">{{ $pTitle }}</span>
                                    </li>
                                @endforeach
                            </ul>
                            <ul class="sum-trust">
                                <li><i class="fa-solid fa-shield-halved" aria-hidden="true"></i> Secure checkout</li>
                                <li><i class="fa-solid fa-arrow-right-arrow-left" aria-hidden="true"></i> 7-day returns</li>
                                <li><i class="fa-solid fa-hammer" aria-hidden="true"></i> Handcrafted in India</li>
                            </ul>
                        </div>

                        <a href="javascript:void(0)" class="cart-help">
                            <i class="fa-brands fa-whatsapp" aria-hidden="true"></i>
                            <span>Need help? <b>Chat with our team</b></span>
                            <i class="fa-solid fa-arrow-right-long go" aria-hidden="true"></i>
                        </a>
                    </aside>
                </div>

                {{-- mobile sticky bar --}}
                <div class="cart-bar">
                    <div class="bar-total">
                        <span>Total</span>
                        <strong>$680</strong>
                    </div>
                    <a href="{{ route('checkout') }}" class="btn btn-primary">
                        Proceed to Address
                        <i class="fa-solid fa-arrow-right-long" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </section>

        {{-- Show this and hide .cart-secA when the cart has no items --}}
        <div class="cart-empty" hidden>
            <span class="empty-ico"><i class="fa-solid fa-bag-shopping" aria-hidden="true"></i></span>
            <h2>Your cart is empty</h2>
            <p>
                Looks like you have not added anything yet. Explore our handcrafted brass diyas, lamps and pooja
                essentials.
            </p>
            <div class="empty-btns">
                <a href="{{ route('products') }}" class="btn btn-primary">Shop Now</a>
                <a href="javascript:void(0)" class="btn btn-outline-primary">View New Arrivals</a>
            </div>
            <ul class="empty-links">
                <li><a href="javascript:void(0)">Brass Diyas &amp; Lamps</a></li>
                <li><a href="javascript:void(0)">Pooja Essentials</a></li>
                <li><a href="javascript:void(0)">Brass Decor</a></li>
                <li><a href="javascript:void(0)">Gifting</a></li>
            </ul>
        </div>
    </main>
@endsection