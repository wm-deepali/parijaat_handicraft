@extends('layouts.app')

@section('title', 'Payment')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/sass/payment/payment.css') }}" />
@endpush

@section('content')
    <main>
        <section class="payment-secA">
            <div class="container">
                <!-- TOP : title + steps -->
                <div class="pay-top">
                    <div class="pay-head">
                        <a href="checkout.html" class="back-link"><i class="fa-solid fa-arrow-left-long"
                                aria-hidden="true"></i>
                            Back to address</a>
                        <h1>Payment</h1>
                    </div>

                    <ol class="pay-steps" aria-label="Checkout progress">
                        <li class="step is-done">
                            <a href="cart.html" class="step-link">
                                <span class="step-icon"><i class="fa-solid fa-check" aria-hidden="true"></i></span>
                                <span class="step-label">Cart</span>
                            </a>
                        </li>
                        <li class="step is-done">
                            <a href="checkout.html" class="step-link">
                                <span class="step-icon"><i class="fa-solid fa-check" aria-hidden="true"></i></span>
                                <span class="step-label">Address</span>
                            </a>
                        </li>
                        <li class="step is-active" aria-current="step">
                            <span class="step-icon"><i class="fa-solid fa-credit-card" aria-hidden="true"></i></span>
                            <span class="step-label">Payment</span>
                        </li>
                    </ol>
                </div>

                <!-- Payment failed: remove the hidden attribute to show -->
                <div class="pay-alert" role="alert" hidden>
                    <i class="fa-solid fa-triangle-exclamation" aria-hidden="true"></i>
                    <p>
                        <strong>Payment failed.</strong> Your payment of $680 could not be
                        completed. Please try again.
                    </p>
                    <a href="#pmTabs" class="alert-link">Try again</a>
                </div>

                <form class="pay-layout form" id="payForm" action="/checkout/payment/confirm" method="post"
                    novalidate>
                    @csrf

                    <div class="pay-card">
                        <!-- Row 1: Deliver to -->
                        <div class="pay-sec ship-to">
                            <span class="ship-icon"><i class="fa-solid fa-location-dot" aria-hidden="true"></i></span>
                            <p class="ship-text">
                                <strong>Deliver to Ananya Kapoor, 122011</strong>
                                <small>B-204, Sunrise Apartments, Sector 56, Gurugram · Arrives by
                                    Wed, 18 Nov</small>
                            </p>
                            <a href="checkout.html" class="ship-change">Change</a>
                        </div>

                        <!-- Row 2: Payment method -->
                        <div class="pay-sec pm">
                            <h2 class="sec-label">
                                <span class="num">1</span> Choose how to pay
                            </h2>

                            <input type="radio" name="payment" id="pmOnline" class="pm-radio" value="online" checked />
                            <input type="radio" name="payment" id="pmCod" class="pm-radio" value="cod" />

                            <div class="pm-tabs" id="pmTabs" role="radiogroup" aria-label="Choose a payment method">
                                <label for="pmOnline" class="pm-tab">
                                    <span class="pm-icon"><i class="fa-solid fa-shield-halved"
                                            aria-hidden="true"></i></span>
                                    <span class="pm-text">
                                        <strong>Pay Online</strong>
                                        <small>UPI, Cards, Net Banking</small>
                                    </span>
                                    <span class="radio-dot" aria-hidden="true"></span>
                                    <span class="pm-badge">Instant confirmation</span>
                                </label>
                                <label for="pmCod" class="pm-tab">
                                    <span class="pm-icon"><i class="fa-solid fa-dollar-sign"
                                            aria-hidden="true"></i></span>
                                    <span class="pm-text">
                                        <strong>Cash on Delivery</strong>
                                        <small>India only · Pay when it arrives</small>
                                    </span>
                                    <span class="radio-dot" aria-hidden="true"></span>
                                    <span class="pm-badge">Pay at the door</span>
                                </label>
                            </div>

                            <p class="pm-info pm-online">
                                <i class="fa-solid fa-lock" aria-hidden="true"></i>
                                <span>
                                    You will pay on our secure page. We never store your card or
                                    bank details.
                                    <span class="pm-chips"><em>UPI</em><em>Visa</em><em>Mastercard</em><em>Net
                                            Banking</em></span>
                                </span>
                            </p>
                            <p class="pm-info pm-cod">
                                <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
                                <span>Cash on Delivery is available for PIN 122011. Please keep
                                    the exact amount ready for our delivery partner.</span>
                            </p>
                        </div>

                        <!-- Row 3: Billing -->
                        <div class="pay-sec bill">
                            <h2 class="sec-label">
                                <span class="num">2</span> Billing address
                            </h2>

                            <label class="check">
                                <input type="checkbox" id="billSame" name="billing_same" checked />
                                <span>My billing address is the same as my delivery address</span>
                            </label>

                            <div class="bill-form">
                                <div class="fields">
                                    <div class="form-group s-12">
                                        <input type="text" id="bName" name="bill_name" placeholder=" "
                                            autocomplete="billing name" />
                                        <label for="bName">Full name</label>
                                    </div>
                                    <div class="form-group s-5">
                                        <input type="text" id="bHouse" name="bill_house" placeholder=" "
                                            autocomplete="billing address-line1" />
                                        <label for="bHouse">House / Flat no.</label>
                                    </div>
                                    <div class="form-group s-7">
                                        <input type="text" id="bStreet" name="bill_street" placeholder=" "
                                            autocomplete="billing address-line2" />
                                        <label for="bStreet">Street / Area / Locality</label>
                                    </div>
                                    <div class="form-group s-4">
                                        <input type="text" id="bPin" name="bill_pin" placeholder=" "
                                            inputmode="numeric" maxlength="6" autocomplete="billing postal-code" />
                                        <label for="bPin">PIN code</label>
                                    </div>
                                    <div class="form-group s-4">
                                        <input type="text" id="bCity" name="bill_city" placeholder=" "
                                            autocomplete="billing address-level2" />
                                        <label for="bCity">City</label>
                                    </div>
                                    <div class="form-group s-4">
                                        <input type="text" id="bState" name="bill_state" placeholder=" "
                                            list="stateList" autocomplete="billing address-level1" />
                                        <label for="bState">State</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ============ SUMMARY ============ -->
                    <aside class="pay-summary" aria-label="Order summary">
                        <div class="box">
                            <div class="mini-row">
                                <ul class="mini-imgs">
                                    <li>
                                        <img src="{{ asset('assets/images/home/cat4.png') }}"
                                            alt="Handmade Brass Oil Lamp" width="44" height="44" loading="lazy" />
                                    </li>
                                    <li>
                                        <img src="{{ asset('assets/images/home/cat1.png') }}"
                                            alt="Brass Elephant Diya Stand" width="44" height="44" loading="lazy" />
                                    </li>
                                    <li>
                                        <img src="{{ asset('assets/images/home/cat2.png') }}"
                                            alt="Brass Aladdin Incense Burner" width="44" height="44"
                                            loading="lazy" />
                                    </li>
                                </ul>
                                <p class="mini-text">
                                    <strong>Order Summary</strong>
                                    <small>4 items</small>
                                </p>
                                <a href="cart.html" class="mini-edit">Edit cart</a>
                            </div>

                            <dl class="rows">
                                <div class="row">
                                    <dt>Total MRP</dt>
                                    <dd>$906</dd>
                                </div>
                                <div class="row is-green">
                                    <dt>Discount on MRP</dt>
                                    <dd>−$160</dd>
                                </div>
                                <div class="row">
                                    <dt>Gift Packaging</dt>
                                    <dd>+$9</dd>
                                </div>
                                <div class="row is-green">
                                    <dt>Coupon (PARIJAAT10)</dt>
                                    <dd>−$75</dd>
                                </div>
                                <div class="row">
                                    <dt>Shipping Fee</dt>
                                    <dd class="is-green"><del>$15</del> Free</dd>
                                </div>
                                <div class="row row-total">
                                    <dt>Amount Payable</dt>
                                    <dd>$680</dd>
                                </div>
                            </dl>

                            <p class="save-chip">
                                <i class="fa-solid fa-piggy-bank" aria-hidden="true"></i> You
                                are saving $235 · Inclusive of all taxes
                            </p>

                            <a href="order-confirmed.html" class="btn btn-primary place-btn pay-btn">
                                <i class="fa-solid fa-lock" aria-hidden="true"></i> Pay $680
                                Securely
                            </a>
                            <button type="submit" class="btn btn-primary place-btn cod-btn">
                                Place Order
                                <i class="fa-solid fa-arrow-right-long" aria-hidden="true"></i>
                            </button>
                            <p class="terms-note">
                                By continuing, you agree to our
                                <a href="terms-conditions.html">Terms</a> and
                                <a href="privacy-policy.html">Privacy Policy</a>.
                            </p>
                        </div>

                        <ul class="trust-list">
                            <li>
                                <i class="fa-solid fa-arrow-right-arrow-left" aria-hidden="true"></i>
                                7-day returns
                            </li>
                            <li>
                                <i class="fa-solid fa-hammer" aria-hidden="true"></i>
                                Handcrafted in India
                            </li>
                            <li>
                                <i class="fa-solid fa-truck-fast" aria-hidden="true"></i>
                                Tracked delivery
                            </li>
                        </ul>
                    </aside>

                    <datalist id="stateList">
                        <option value="Andhra Pradesh"></option>
                        <option value="Delhi"></option>
                        <option value="Gujarat"></option>
                        <option value="Haryana"></option>
                        <option value="Karnataka"></option>
                        <option value="Kerala"></option>
                        <option value="Maharashtra"></option>
                        <option value="Punjab"></option>
                        <option value="Rajasthan"></option>
                        <option value="Tamil Nadu"></option>
                        <option value="Telangana"></option>
                        <option value="Uttar Pradesh"></option>
                        <option value="West Bengal"></option>
                    </datalist>
                </form>

                <!-- mobile sticky bar -->
                <div class="pay-bar">
                    <div class="bar-total">
                        <span>Amount Payable</span>
                        <strong>$680</strong>
                    </div>
                    <a href="order-confirmed.html" class="btn btn-primary bar-pay">
                        <i class="fa-solid fa-lock" aria-hidden="true"></i> Pay Securely
                    </a>
                    <button type="submit" form="payForm" class="btn btn-primary bar-cod">
                        Place Order
                        <i class="fa-solid fa-arrow-right-long" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </section>
    </main>
@endsection