@extends('layouts.app')

@section('title', 'Checkout | Parijaat Handicraft')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/sass/checkout/checkout.css') }}" />
@endpush

@section('content')
<main>
    <section class="checkout-secA">
        <div class="container">
            <!-- TOP : title + steps -->
            <div class="co-top">
                <div class="co-head">
                    <a href="{{ route('cart') }}" class="back-link"><i class="fa-solid fa-arrow-left-long"
                            aria-hidden="true"></i> Back to cart</a>
                    <h1>Delivery Details</h1>
                </div>

                <ol class="co-steps" aria-label="Checkout progress">
                    <li class="step is-done">
                        <a href="{{ route('cart') }}" class="step-link">
                            <span class="step-icon"><i class="fa-solid fa-check" aria-hidden="true"></i></span>
                            <span class="step-label">Cart</span>
                        </a>
                    </li>
                    <li class="step is-active" aria-current="step">
                        <span class="step-icon"><i class="fa-solid fa-location-dot" aria-hidden="true"></i></span>
                        <span class="step-label">Address</span>
                    </li>
                    <li class="step">
                        <span class="step-icon"><i class="fa-solid fa-credit-card" aria-hidden="true"></i></span>
                        <span class="step-label">Payment</span>
                    </li>
                </ol>
            </div>

            <form class="co-layout form" action="{{ url('/checkout/payment') }}" method="post" novalidate>
                @csrf
                <div class="co-main">
                    <!-- 1. Your details -->
                    <section class="co-block">
                        <div class="co-row">
                            <h2 class="co-title"><span class="num">1</span> Your details</h2>
                            <p class="co-aside">
                                Already a member?
                                <a href="{{ url('/login') }}?next={{ url('/checkout') }}">Sign in</a>
                            </p>
                        </div>
                        <div class="fields">
                            <div class="form-group s-6">
                                <input type="email" id="cEmail" name="email" placeholder=" " autocomplete="email" />
                                <label for="cEmail">Email address</label>
                            </div>
                            <div class="form-group has-prefix s-6">
                                <span class="prefix">+91</span>
                                <input type="tel" id="cPhone" name="phone" placeholder=" " inputmode="numeric"
                                    maxlength="10" autocomplete="tel-national" />
                                <label for="cPhone">Mobile number</label>
                            </div>
                        </div>
                        <label class="check">
                            <input type="checkbox" name="updates" checked />
                            <span>Send my order updates on WhatsApp and email</span>
                        </label>
                    </section>

                    <!-- 2. Address -->
                    <section class="co-block">
                        <div class="co-row">
                            <h2 class="co-title"><span class="num">2</span> Where should we send it?</h2>
                            <p class="co-aside">2 saved addresses</p>
                        </div>

                        <div class="addr-list" role="radiogroup" aria-label="Choose a delivery address">
                            <!-- Address 1 -->
                            <div class="addr-card">
                                <input type="radio" name="address" id="addr1" class="addr-radio" value="1" checked />
                                <label for="addr1" class="addr-body">
                                    <span class="addr-ico" aria-hidden="true"><i class="fa-solid fa-house"></i></span>
                                    <span class="addr-info">
                                        <span class="addr-top">
                                            <strong>Ananya Kapoor</strong>
                                            <span class="tag">Home</span>
                                            <span class="tag tag-default">Default</span>
                                        </span>
                                        <span class="addr-line">B-204, Sunrise Apartments, Sector 56, Golf Course Road</span>
                                        <span class="addr-line">Gurugram, Haryana - 122011</span>
                                        <span class="addr-phone"><i class="fa-solid fa-phone" aria-hidden="true"></i> +91 98111 22334</span>
                                    </span>
                                    <span class="radio-dot" aria-hidden="true"></span>
                                </label>

                                <input type="checkbox" id="edit1" class="edit-toggle" />
                                <label for="edit1" class="addr-edit"><i class="fa-solid fa-pen" aria-hidden="true"></i> Edit address</label>

                                <div class="addr-form">
                                    <h3>Edit address</h3>
                                    <div class="fields">
                                        <div class="form-group s-6">
                                            <input type="text" id="a1Name" name="a1_name" value="Ananya Kapoor" placeholder=" " autocomplete="name" />
                                            <label for="a1Name">Full name</label>
                                        </div>
                                        <div class="form-group has-prefix s-6">
                                            <span class="prefix">+91</span>
                                            <input type="tel" id="a1Phone" name="a1_phone" value="9811122334" placeholder=" " inputmode="numeric" maxlength="10" autocomplete="tel-national" />
                                            <label for="a1Phone">Phone number</label>
                                        </div>
                                        <div class="form-group s-4">
                                            <input type="text" id="a1Pin" name="a1_pin" value="122011" placeholder=" " inputmode="numeric" maxlength="6" autocomplete="postal-code" />
                                            <label for="a1Pin">PIN code</label>
                                        </div>
                                        <div class="form-group s-4">
                                            <input type="text" id="a1City" name="a1_city" value="Gurugram" placeholder=" " autocomplete="address-level2" />
                                            <label for="a1City">City</label>
                                        </div>
                                        <div class="form-group s-4">
                                            <input type="text" id="a1State" name="a1_state" value="Haryana" placeholder=" " list="stateList" autocomplete="address-level1" />
                                            <label for="a1State">State</label>
                                        </div>
                                        <div class="form-group s-5">
                                            <input type="text" id="a1House" name="a1_house" value="B-204" placeholder=" " autocomplete="address-line1" />
                                            <label for="a1House">House / Flat no.</label>
                                        </div>
                                        <div class="form-group s-7">
                                            <input type="text" id="a1Street" name="a1_street" value="Sunrise Apartments, Sector 56" placeholder=" " autocomplete="address-line2" />
                                            <label for="a1Street">Street / Area / Locality</label>
                                        </div>
                                        <div class="form-group s-12">
                                            <input type="text" id="a1Landmark" name="a1_landmark" value="Golf Course Road" placeholder=" " />
                                            <label for="a1Landmark">Landmark (optional)</label>
                                        </div>
                                    </div>

                                    <fieldset class="type-group">
                                        <legend>Address type</legend>
                                        <div class="type-options">
                                            <label class="type-chip"><input type="radio" name="a1_type" value="home" checked /><span><i class="fa-solid fa-house" aria-hidden="true"></i> Home</span></label>
                                            <label class="type-chip"><input type="radio" name="a1_type" value="work" /><span><i class="fa-solid fa-briefcase" aria-hidden="true"></i> Work</span></label>
                                            <label class="type-chip"><input type="radio" name="a1_type" value="other" /><span><i class="fa-solid fa-location-dot" aria-hidden="true"></i> Other</span></label>
                                        </div>
                                    </fieldset>

                                    <label class="check">
                                        <input type="checkbox" name="a1_default" checked />
                                        <span>Keep this as my default address</span>
                                    </label>

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary" formaction="{{ url('/checkout/address/save') }}">Save address</button>
                                        <label for="edit1" class="btn btn-outline-primary">Cancel</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Address 2 -->
                            <div class="addr-card">
                                <input type="radio" name="address" id="addr2" class="addr-radio" value="2" />
                                <label for="addr2" class="addr-body">
                                    <span class="addr-ico" aria-hidden="true"><i class="fa-solid fa-briefcase"></i></span>
                                    <span class="addr-info">
                                        <span class="addr-top">
                                            <strong>Ananya Kapoor</strong>
                                            <span class="tag">Work</span>
                                        </span>
                                        <span class="addr-line">Tower C, 7th Floor, Sector 62, Near Metro Station</span>
                                        <span class="addr-line">Noida, Uttar Pradesh - 201301</span>
                                        <span class="addr-phone"><i class="fa-solid fa-phone" aria-hidden="true"></i> +91 98111 22334</span>
                                    </span>
                                    <span class="radio-dot" aria-hidden="true"></span>
                                </label>

                                <input type="checkbox" id="edit2" class="edit-toggle" />
                                <label for="edit2" class="addr-edit"><i class="fa-solid fa-pen" aria-hidden="true"></i> Edit address</label>

                                <div class="addr-form">
                                    <h3>Edit address</h3>
                                    <div class="fields">
                                        <div class="form-group s-6">
                                            <input type="text" id="a2Name" name="a2_name" value="Ananya Kapoor" placeholder=" " autocomplete="name" />
                                            <label for="a2Name">Full name</label>
                                        </div>
                                        <div class="form-group has-prefix s-6">
                                            <span class="prefix">+91</span>
                                            <input type="tel" id="a2Phone" name="a2_phone" value="9811122334" placeholder=" " inputmode="numeric" maxlength="10" autocomplete="tel-national" />
                                            <label for="a2Phone">Phone number</label>
                                        </div>
                                        <div class="form-group s-4">
                                            <input type="text" id="a2Pin" name="a2_pin" value="201301" placeholder=" " inputmode="numeric" maxlength="6" autocomplete="postal-code" />
                                            <label for="a2Pin">PIN code</label>
                                        </div>
                                        <div class="form-group s-4">
                                            <input type="text" id="a2City" name="a2_city" value="Noida" placeholder=" " autocomplete="address-level2" />
                                            <label for="a2City">City</label>
                                        </div>
                                        <div class="form-group s-4">
                                            <input type="text" id="a2State" name="a2_state" value="Uttar Pradesh" placeholder=" " list="stateList" autocomplete="address-level1" />
                                            <label for="a2State">State</label>
                                        </div>
                                        <div class="form-group s-5">
                                            <input type="text" id="a2House" name="a2_house" value="Tower C, 7th Floor" placeholder=" " autocomplete="address-line1" />
                                            <label for="a2House">House / Flat no.</label>
                                        </div>
                                        <div class="form-group s-7">
                                            <input type="text" id="a2Street" name="a2_street" value="Sector 62" placeholder=" " autocomplete="address-line2" />
                                            <label for="a2Street">Street / Area / Locality</label>
                                        </div>
                                        <div class="form-group s-12">
                                            <input type="text" id="a2Landmark" name="a2_landmark" value="Near Metro Station" placeholder=" " />
                                            <label for="a2Landmark">Landmark (optional)</label>
                                        </div>
                                    </div>

                                    <fieldset class="type-group">
                                        <legend>Address type</legend>
                                        <div class="type-options">
                                            <label class="type-chip"><input type="radio" name="a2_type" value="home" /><span><i class="fa-solid fa-house" aria-hidden="true"></i> Home</span></label>
                                            <label class="type-chip"><input type="radio" name="a2_type" value="work" checked /><span><i class="fa-solid fa-briefcase" aria-hidden="true"></i> Work</span></label>
                                            <label class="type-chip"><input type="radio" name="a2_type" value="other" /><span><i class="fa-solid fa-location-dot" aria-hidden="true"></i> Other</span></label>
                                        </div>
                                    </fieldset>

                                    <label class="check">
                                        <input type="checkbox" name="a2_default" />
                                        <span>Keep this as my default address</span>
                                    </label>

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary" formaction="{{ url('/checkout/address/save') }}">Save address</button>
                                        <label for="edit2" class="btn btn-outline-primary">Cancel</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Add new (full row) -->
                            <div class="addr-card addr-new">
                                <input type="radio" name="address" id="addrNew" class="addr-radio" value="new" />
                                <label for="addrNew" class="addr-body">
                                    <span class="addr-ico" aria-hidden="true"><i class="fa-solid fa-plus"></i></span>
                                    <span class="addr-info">
                                        <span class="addr-top"><strong>Deliver to a new address</strong></span>
                                        <span class="addr-line">Add a different name, phone number or location for this order.</span>
                                    </span>
                                    <span class="radio-dot" aria-hidden="true"></span>
                                </label>

                                <div class="addr-form">
                                    <div class="fields">
                                        <div class="form-group s-6">
                                            <input type="text" id="nName" name="new_name" placeholder=" " autocomplete="name" />
                                            <label for="nName">Full name</label>
                                        </div>
                                        <div class="form-group has-prefix s-6">
                                            <span class="prefix">+91</span>
                                            <input type="tel" id="nPhone" name="new_phone" placeholder=" " inputmode="numeric" maxlength="10" autocomplete="tel-national" />
                                            <label for="nPhone">Phone number</label>
                                        </div>
                                        <div class="form-group s-4">
                                            <input type="text" id="nPin" name="new_pin" placeholder=" " inputmode="numeric" maxlength="6" autocomplete="postal-code" />
                                            <label for="nPin">PIN code</label>
                                        </div>
                                        <div class="form-group s-4">
                                            <input type="text" id="nCity" name="new_city" placeholder=" " autocomplete="address-level2" />
                                            <label for="nCity">City</label>
                                        </div>
                                        <div class="form-group s-4">
                                            <input type="text" id="nState" name="new_state" placeholder=" " list="stateList" autocomplete="address-level1" />
                                            <label for="nState">State</label>
                                        </div>
                                        <div class="form-group s-5">
                                            <input type="text" id="nHouse" name="new_house" placeholder=" " autocomplete="address-line1" />
                                            <label for="nHouse">House / Flat no.</label>
                                        </div>
                                        <div class="form-group s-7">
                                            <input type="text" id="nStreet" name="new_street" placeholder=" " autocomplete="address-line2" />
                                            <label for="nStreet">Street / Area / Locality</label>
                                        </div>
                                        <div class="form-group s-12">
                                            <input type="text" id="nLandmark" name="new_landmark" placeholder=" " />
                                            <label for="nLandmark">Landmark (optional)</label>
                                        </div>
                                    </div>

                                    <fieldset class="type-group">
                                        <legend>Address type</legend>
                                        <div class="type-options">
                                            <label class="type-chip"><input type="radio" name="new_type" value="home" checked /><span><i class="fa-solid fa-house" aria-hidden="true"></i> Home</span></label>
                                            <label class="type-chip"><input type="radio" name="new_type" value="work" /><span><i class="fa-solid fa-briefcase" aria-hidden="true"></i> Work</span></label>
                                            <label class="type-chip"><input type="radio" name="new_type" value="other" /><span><i class="fa-solid fa-location-dot" aria-hidden="true"></i> Other</span></label>
                                        </div>
                                    </fieldset>

                                    <label class="check">
                                        <input type="checkbox" name="new_default" />
                                        <span>Save this address for next time</span>
                                    </label>

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary" formaction="{{ url('/checkout/address/save') }}">Save &amp; deliver here</button>
                                        <label for="addr1" class="btn btn-outline-primary">Cancel</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- 3. Delivery method -->
                    <section class="co-block">
                        <div class="co-row">
                            <h2 class="co-title"><span class="num">3</span> How soon do you need it?</h2>
                            <p class="co-aside">Dispatched within 2–4 working days</p>
                        </div>

                        <div class="method-list" role="radiogroup" aria-label="Choose a delivery method">
                            <label class="method">
                                <input type="radio" name="delivery" value="standard" checked />
                                <span class="method-body">
                                    <span class="method-date" aria-hidden="true">
                                        <small>Wed</small>
                                        <b>18</b>
                                        <em>Nov</em>
                                    </span>
                                    <span class="method-text">
                                        <strong>Standard Delivery</strong>
                                        <small>3–7 working days · Tracked</small>
                                        <span class="method-price is-free">Free</span>
                                    </span>
                                    <span class="radio-dot" aria-hidden="true"></span>
                                </span>
                            </label>

                            <label class="method">
                                <input type="radio" name="delivery" value="express" />
                                <span class="method-body">
                                    <span class="method-date" aria-hidden="true">
                                        <small>Mon</small>
                                        <b>16</b>
                                        <em>Nov</em>
                                    </span>
                                    <span class="method-text">
                                        <strong>Priority Delivery</strong>
                                        <small>Faster dispatch · Tracked</small>
                                        <span class="method-price">$12</span>
                                    </span>
                                    <span class="radio-dot" aria-hidden="true"></span>
                                </span>
                            </label>
                        </div>
                    </section>

                    <!-- 4. Gift note -->
                    <section class="co-block">
                        <div class="co-row">
                            <h2 class="co-title"><span class="num">4</span> Gift message</h2>
                            <p class="co-aside">Optional</p>
                        </div>
                        <div class="fields">
                            <div class="form-group s-12">
                                <input type="text" id="giftMsg" name="gift_message" placeholder=" " maxlength="120" />
                                <label for="giftMsg">Message for the card (optional)</label>
                            </div>
                        </div>
                    </section>
                </div>

                <!-- ============ SUMMARY ============ -->
                <aside class="co-summary" aria-label="Order summary">
                    <div class="sum-head">
                        <h4>Order Summary</h4>
                        <a href="{{ route('cart') }}">Edit cart</a>
                    </div>

                    <div class="box price-box">
                        <div class="box-head">
                            <h5>In your cart <span>(4 items)</span></h5>
                        </div>

                        <ul class="mini-list">
                            <li>
                                <span class="mini-img">
                                    <img src="{{ asset('assets/images/home/cat4.png') }}" alt="" width="60" height="60" loading="lazy" />
                                    <b>1</b>
                                </span>
                                <span class="mini-text">
                                    <strong>Handmade Brass Oil Lamp</strong>
                                    <small>Polished Gold · 6 in · Gift packed</small>
                                </span>
                                <span class="mini-price">$208</span>
                            </li>
                            <li>
                                <span class="mini-img">
                                    <img src="{{ asset('assets/images/home/cat1.png') }}" alt="" width="60" height="60" loading="lazy" />
                                    <b>1</b>
                                </span>
                                <span class="mini-text">
                                    <strong>Brass Elephant Diya Stand</strong>
                                    <small>Antique Brass · 8 in</small>
                                </span>
                                <span class="mini-price">$249</span>
                            </li>
                            <li>
                                <span class="mini-img">
                                    <img src="{{ asset('assets/images/home/cat2.png') }}" alt="" width="60" height="60" loading="lazy" />
                                    <b>2</b>
                                </span>
                                <span class="mini-text">
                                    <strong>Brass Aladdin Incense Burner</strong>
                                    <small>Polished Gold · Solid Brass</small>
                                </span>
                                <span class="mini-price">$298</span>
                            </li>
                        </ul>

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
                                <dt>Total Amount<small>Inclusive of all taxes</small></dt>
                                <dd>$680</dd>
                            </div>
                        </dl>

                        <p class="save-chip">
                            <i class="fa-solid fa-piggy-bank" aria-hidden="true"></i> You are saving $235 on this order
                        </p>

                        <a href="{{ url('/payment') }}" class="btn btn-primary place-btn">
                            Continue to Payment
                            <i class="fa-solid fa-arrow-right-long" aria-hidden="true"></i>
                        </a>
                        <p class="terms-note">
                            By continuing, you agree to our <a href="{{ url('/terms') }}">Terms</a> and
                            <a href="{{ url('/privacy') }}">Privacy Policy</a>.
                        </p>

                        <ul class="sum-trust">
                            <li><i class="fa-solid fa-shield-halved" aria-hidden="true"></i> Secure checkout</li>
                            <li><i class="fa-solid fa-arrow-right-arrow-left" aria-hidden="true"></i> 7-day returns</li>
                            <li><i class="fa-solid fa-hammer" aria-hidden="true"></i> Handcrafted in India</li>
                        </ul>
                    </div>

                    <a href="javascript:void(0)" class="co-help">
                        <i class="fa-brands fa-whatsapp" aria-hidden="true"></i>
                        <span>Need help? <b>Chat with our team</b></span>
                        <i class="fa-solid fa-arrow-right-long go" aria-hidden="true"></i>
                    </a>
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
            <div class="co-bar">
                <div class="bar-total">
                    <span>Total</span>
                    <strong>$680</strong>
                </div>
                <a href="{{ url('/payment') }}" class="btn btn-primary">
                    Continue to Payment
                    <i class="fa-solid fa-arrow-right-long" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </section>
</main>
@endsection