@extends('layouts.app')

@section('title', 'Checkout | Parijaat Handicraft')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/sass/checkout/checkout.css') }}" />
@endpush

@section('content')
    @php
        $region = app(\App\Support\Region::class);
        $money = fn($v) => $region->format($v);
        $isIndia = !$country || $country->iso2 === 'IN';
        $countryName = $country?->name ?? 'India';
        $items = $cart->items->filter(fn($i) => $i->product)->values();

        $selectedId = $defaultAddress?->id ?? $addresses->first()?->id;
        $firstAddrId = $addresses->first()?->id;

        $prefEmail = $defaultAddress->email ?? ($customer->email ?? '');
        $prefPhone = $defaultAddress->phone ?? ($customer->phone ?? '');

        $typeIcon = ['home' => 'fa-house', 'office' => 'fa-briefcase', 'other' => 'fa-location-dot'];
        $typeTag = ['home' => 'Home', 'office' => 'Work', 'other' => 'Other'];

        // price rows: same logic as the cart page
        $priceRows = [];
        $priceRows[] = ['Total MRP', $money($summary['total_mrp']), ''];
        if ($summary['mrp_discount'] > 0) {
            $priceRows[] = ['Discount on MRP', '−' . $money($summary['mrp_discount']), 'is-green'];
        }
        foreach ($summary['addons'] as $addonLabel => $addonAmount) {
            $priceRows[] = [$addonLabel, '+' . $money($addonAmount), ''];
        }
        if ($summary['coupon'] > 0) {
            $priceRows[] = ['Coupon (' . $summary['coupon_code'] . ')', '−' . $money($summary['coupon']), 'is-green'];
        }
        if ($summary['tax'] > 0) {
            $priceRows[] = ['GST', '+' . $money($summary['tax']), ''];
        }

        $shipText = $summary['shipping'] > 0
            ? $money($summary['shipping'])
            : ($summary['shipping_known'] ? 'Free' : 'Calculated at checkout');

        $stdDate = now()->addWeekdays(7);
    @endphp

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

                <form class="co-layout form" id="checkoutForm" action="#" method="post" novalidate>
                    @csrf
                    <div class="co-main">

                        <!-- 1. Your details -->
                        <section class="co-block">
                            <div class="co-row">
                                <h2 class="co-title"><span class="num">1</span> Your details</h2>
                                <p class="co-aside">
                                    @if ($customer)
                                        Signed in as <b>{{ $customer->name }}</b>
                                    @else
                                        Already a member?
                                        <a href="{{ route('user.login') }}" data-model=".login-pop">Sign in</a>
                                    @endif
                                </p>
                            </div>
                            <div class="fields">
                                <div class="form-group s-6">
                                    <input type="email" id="cEmail" name="email" value="{{ $prefEmail }}" placeholder=" "
                                        autocomplete="email" />
                                    <label for="cEmail">Email address</label>
                                </div>
                                <div class="form-group {{ $isIndia ? 'has-prefix' : '' }} s-6">
                                    @if ($isIndia)
                                        <span class="prefix">+91</span>
                                    @endif
                                    <input type="tel" id="cPhone" name="phone" value="{{ $prefPhone }}" placeholder=" "
                                        inputmode="{{ $isIndia ? 'numeric' : 'tel' }}" maxlength="{{ $isIndia ? 10 : 20 }}"
                                        autocomplete="{{ $isIndia ? 'tel-national' : 'tel' }}" />
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
                                <p class="co-aside">
                                    Delivering to {{ $countryName }}@if ($addresses->count()) · {{ $addresses->count() }}
                                        saved
                                    {{ \Illuminate\Support\Str::plural('address', $addresses->count()) }}@endif
                                </p>
                            </div>

                            <div class="addr-list" role="radiogroup" aria-label="Choose a delivery address">

                                @foreach ($addresses as $a)
                                    @php
                                        $aId = $a->id;
                                        $aType = $a->address_type ?: 'home';
                                    @endphp
                                    <!-- Address {{ $aId }} -->
                                    <div class="addr-card">
                                        <input type="radio" name="address" id="addr{{ $aId }}" class="addr-radio"
                                            value="{{ $aId }}" data-email="{{ $a->email }}" @checked((int) $selectedId === (int) $aId) />
                                        <label for="addr{{ $aId }}" class="addr-body">
                                            <span class="addr-ico" aria-hidden="true"><i
                                                    class="fa-solid {{ $typeIcon[$aType] ?? 'fa-location-dot' }}"></i></span>
                                            <span class="addr-info">
                                                <span class="addr-top">
                                                    <strong>{{ $a->name }}</strong>
                                                    <span class="tag">{{ $typeTag[$aType] ?? 'Home' }}</span>
                                                    @if ($a->is_default)
                                                        <span class="tag tag-default">Default</span>
                                                    @endif
                                                </span>
                                                <span
                                                    class="addr-line">{{ $a->address_line_1 }}@if (filled($a->address_line_2)),
                                                    {{ $a->address_line_2 }}@endif</span>
                                                <span class="addr-line">{{ $a->city?->name }}, {{ $a->state?->name }} -
                                                    {{ $a->pincode }}</span>
                                                <span class="addr-phone"><i class="fa-solid fa-phone" aria-hidden="true"></i>
                                                    {{ $isIndia ? '+91 ' : '' }}{{ $a->phone }}</span>
                                            </span>
                                            <span class="radio-dot" aria-hidden="true"></span>
                                        </label>

                                        <input type="checkbox" id="edit{{ $aId }}" class="edit-toggle" />
                                        <label for="edit{{ $aId }}" class="addr-edit"><i class="fa-solid fa-pen"
                                                aria-hidden="true"></i> Edit address</label>

                                        <div class="addr-form">
                                            <h3>Edit address</h3>
                                            <div class="fields">
                                                <div class="form-group s-6">
                                                    <input type="text" id="a{{ $aId }}Name" name="a{{ $aId }}_name"
                                                        data-f="name" value="{{ $a->name }}" placeholder=" "
                                                        autocomplete="name" />
                                                    <label for="a{{ $aId }}Name">Full name</label>
                                                </div>
                                                <div class="form-group {{ $isIndia ? 'has-prefix' : '' }} s-6">
                                                    @if ($isIndia)
                                                        <span class="prefix">+91</span>
                                                    @endif
                                                    <input type="tel" id="a{{ $aId }}Phone" name="a{{ $aId }}_phone"
                                                        data-f="phone" value="{{ $a->phone }}" placeholder=" "
                                                        inputmode="{{ $isIndia ? 'numeric' : 'tel' }}"
                                                        maxlength="{{ $isIndia ? 10 : 20 }}"
                                                        autocomplete="{{ $isIndia ? 'tel-national' : 'tel' }}" />
                                                    <label for="a{{ $aId }}Phone">Phone number</label>
                                                </div>
                                                <div class="form-group s-4">
                                                    <input type="text" id="a{{ $aId }}Pin" name="a{{ $aId }}_pin" data-f="pin"
                                                        value="{{ $a->pincode }}" placeholder=" "
                                                        inputmode="{{ $isIndia ? 'numeric' : 'text' }}"
                                                        maxlength="{{ $isIndia ? 6 : 12 }}" autocomplete="postal-code" />
                                                    <label
                                                        for="a{{ $aId }}Pin">{{ $isIndia ? 'PIN code' : 'Postal code' }}</label>
                                                </div>
                                                <div class="form-group s-4">
                                                    <select id="a{{ $aId }}State" name="a{{ $aId }}_state" data-f="state">
                                                        <option value="" hidden></option>
                                                        @foreach ($states as $st)
                                                            <option value="{{ $st->id }}" @selected((int) $a->state_id === (int) $st->id)>{{ $st->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <label for="a{{ $aId }}State">State</label>
                                                </div>
                                                <div class="form-group s-4">
                                                    <select id="a{{ $aId }}City" name="a{{ $aId }}_city" data-f="city">
                                                        <option value="" hidden></option>
                                                        @if ($a->city_id)
                                                            <option value="{{ $a->city_id }}" selected>{{ $a->city?->name }}
                                                            </option>
                                                        @endif
                                                    </select>
                                                    <label for="a{{ $aId }}City">City</label>
                                                </div>
                                                <div class="form-group s-5">
                                                    <input type="text" id="a{{ $aId }}House" name="a{{ $aId }}_house"
                                                        data-f="house" value="{{ $a->address_line_1 }}" placeholder=" "
                                                        autocomplete="address-line1" />
                                                    <label for="a{{ $aId }}House">House / Flat no.</label>
                                                </div>
                                                <div class="form-group s-7">
                                                    <input type="text" id="a{{ $aId }}Street" name="a{{ $aId }}_street"
                                                        data-f="street" value="{{ $a->address_line_2 }}" placeholder=" "
                                                        autocomplete="address-line2" />
                                                    <label for="a{{ $aId }}Street">Street / Area / Locality</label>
                                                </div>
                                                <div class="form-group s-12">
                                                    <input type="text" id="a{{ $aId }}Landmark" name="a{{ $aId }}_landmark"
                                                        data-f="landmark" value="" placeholder=" " />
                                                    <label for="a{{ $aId }}Landmark">Landmark (optional)</label>
                                                </div>
                                            </div>

                                            <fieldset class="type-group">
                                                <legend>Address type</legend>
                                                <div class="type-options">
                                                    <label class="type-chip"><input type="radio" name="a{{ $aId }}_type"
                                                            data-f="type" value="home" @checked($aType === 'home') /><span><i
                                                                class="fa-solid fa-house" aria-hidden="true"></i>
                                                            Home</span></label>
                                                    <label class="type-chip"><input type="radio" name="a{{ $aId }}_type"
                                                            data-f="type" value="office" @checked($aType === 'office') /><span><i
                                                                class="fa-solid fa-briefcase" aria-hidden="true"></i>
                                                            Work</span></label>
                                                    <label class="type-chip"><input type="radio" name="a{{ $aId }}_type"
                                                            data-f="type" value="other" @checked($aType === 'other') /><span><i
                                                                class="fa-solid fa-location-dot" aria-hidden="true"></i>
                                                            Other</span></label>
                                                </div>
                                            </fieldset>

                                            <label class="check">
                                                <input type="checkbox" name="a{{ $aId }}_default" data-f="default"
                                                    @checked($a->is_default) />
                                                <span>Keep this as my default address</span>
                                            </label>

                                            <div class="form-actions">
                                                <button type="button" class="btn btn-primary js-save-address"
                                                    data-id="{{ $aId }}">Save address</button>
                                                <label for="edit{{ $aId }}" class="btn btn-outline-primary">Cancel</label>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <!-- Add new (full row) -->
                                <div class="addr-card addr-new">
                                    <input type="radio" name="address" id="addrNew" class="addr-radio" value="new"
                                        data-email="" @checked(!$selectedId) />
                                    <label for="addrNew" class="addr-body">
                                        <span class="addr-ico" aria-hidden="true"><i class="fa-solid fa-plus"></i></span>
                                        <span class="addr-info">
                                            <span class="addr-top"><strong>Deliver to a new address</strong></span>
                                            <span class="addr-line">Add a different name, phone number or location for this
                                                order.</span>
                                        </span>
                                        <span class="radio-dot" aria-hidden="true"></span>
                                    </label>

                                    <div class="addr-form">
                                        <div class="fields">
                                            <div class="form-group s-6">
                                                <input type="text" id="nName" name="new_name" data-f="name" placeholder=" "
                                                    autocomplete="name" />
                                                <label for="nName">Full name</label>
                                            </div>
                                            <div class="form-group {{ $isIndia ? 'has-prefix' : '' }} s-6">
                                                @if ($isIndia)
                                                    <span class="prefix">+91</span>
                                                @endif
                                                <input type="tel" id="nPhone" name="new_phone" data-f="phone"
                                                    placeholder=" " inputmode="{{ $isIndia ? 'numeric' : 'tel' }}"
                                                    maxlength="{{ $isIndia ? 10 : 20 }}"
                                                    autocomplete="{{ $isIndia ? 'tel-national' : 'tel' }}" />
                                                <label for="nPhone">Phone number</label>
                                            </div>
                                            <div class="form-group s-4">
                                                <input type="text" id="nPin" name="new_pin" data-f="pin" placeholder=" "
                                                    inputmode="{{ $isIndia ? 'numeric' : 'text' }}"
                                                    maxlength="{{ $isIndia ? 6 : 12 }}" autocomplete="postal-code" />
                                                <label for="nPin">{{ $isIndia ? 'PIN code' : 'Postal code' }}</label>
                                            </div>
                                            <div class="form-group s-4">
                                                <select id="nState" name="new_state" data-f="state">
                                                    <option value="" hidden></option>
                                                    @foreach ($states as $st)
                                                        <option value="{{ $st->id }}">{{ $st->name }}</option>
                                                    @endforeach
                                                </select>
                                                <label for="nState">State</label>
                                            </div>
                                            <div class="form-group s-4">
                                                <select id="nCity" name="new_city" data-f="city">
                                                    <option value="" hidden></option>
                                                </select>
                                                <label for="nCity">City</label>
                                            </div>
                                            <div class="form-group s-5">
                                                <input type="text" id="nHouse" name="new_house" data-f="house"
                                                    placeholder=" " autocomplete="address-line1" />
                                                <label for="nHouse">House / Flat no.</label>
                                            </div>
                                            <div class="form-group s-7">
                                                <input type="text" id="nStreet" name="new_street" data-f="street"
                                                    placeholder=" " autocomplete="address-line2" />
                                                <label for="nStreet">Street / Area / Locality</label>
                                            </div>
                                            <div class="form-group s-12">
                                                <input type="text" id="nLandmark" name="new_landmark" data-f="landmark"
                                                    placeholder=" " />
                                                <label for="nLandmark">Landmark (optional)</label>
                                            </div>
                                        </div>

                                        <fieldset class="type-group">
                                            <legend>Address type</legend>
                                            <div class="type-options">
                                                <label class="type-chip"><input type="radio" name="new_type" data-f="type"
                                                        value="home" checked /><span><i class="fa-solid fa-house"
                                                            aria-hidden="true"></i> Home</span></label>
                                                <label class="type-chip"><input type="radio" name="new_type" data-f="type"
                                                        value="office" /><span><i class="fa-solid fa-briefcase"
                                                            aria-hidden="true"></i> Work</span></label>
                                                <label class="type-chip"><input type="radio" name="new_type" data-f="type"
                                                        value="other" /><span><i class="fa-solid fa-location-dot"
                                                            aria-hidden="true"></i> Other</span></label>
                                            </div>
                                        </fieldset>

                                        <label class="check">
                                            <input type="checkbox" name="new_default" data-f="default" />
                                            <span>Save this address for next time</span>
                                        </label>

                                        <div class="form-actions">
                                            <button type="button" class="btn btn-primary js-save-address" data-id="">Save
                                                &amp; deliver here</button>
                                            <label for="{{ $firstAddrId ? 'addr' . $firstAddrId : 'addrNew' }}"
                                                class="btn btn-outline-primary">Cancel</label>
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
                                            <small>{{ $stdDate->format('D') }}</small>
                                            <b>{{ $stdDate->format('d') }}</b>
                                            <em>{{ $stdDate->format('M') }}</em>
                                        </span>
                                        <span class="method-text">
                                            <strong>Standard Delivery</strong>
                                            <small>3–7 working days · Tracked</small>
                                            <span
                                                class="method-price {{ $summary['shipping'] > 0 ? '' : 'is-free' }}">{{ $shipText }}</span>
                                        </span>
                                        <span class="radio-dot" aria-hidden="true"></span>
                                    </span>
                                </label>
                            </div>
                        </section>

                        <!-- 4. Gift note (static: abhi order me save nahi hota) -->
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
                                <h5>In your cart <span>({{ $summary['count'] }}
                                        {{ \Illuminate\Support\Str::plural('item', $summary['count']) }})</span></h5>
                            </div>

                            <ul class="mini-list">
                                @foreach ($items as $item)
                                    @php
                                        $p = $item->product;
                                        $small = collect($item->selected_attributes ?? [])->pluck('value')->filter()->implode(' · ');
                                        $addonNames = $item->addons->pluck('detail')->filter()->implode(', ');
                                        $small .= ($small !== '' && $addonNames !== '' ? ' · ' : '') . $addonNames;
                                    @endphp
                                    <li>
                                        <span class="mini-img">
                                            <img src="{{ asset($item->display_image) }}" alt="" width="60" height="60"
                                                loading="lazy" />
                                            <b>{{ $item->quantity }}</b>
                                        </span>
                                        <span class="mini-text">
                                            <strong>{{ $p->name }}</strong>
                                            @if ($small !== '')
                                                <small>{{ $small }}</small>
                                            @endif
                                        </span>
                                        <span class="mini-price">@money($item->total)</span>
                                    </li>
                                @endforeach
                            </ul>

                            <dl class="rows">
                                @foreach ($priceRows as [$rLabel, $rValue, $rClass])
                                    <div class="row {{ $rClass }}">
                                        <dt>{{ $rLabel }}</dt>
                                        <dd>{{ $rValue }}</dd>
                                    </div>
                                @endforeach
                                <div class="row">
                                    <dt>Shipping Fee</dt>
                                    @if ($summary['shipping'] > 0)
                                        <dd>@money($summary['shipping'])</dd>
                                    @elseif ($summary['shipping_known'])
                                        <dd class="is-green">Free</dd>
                                    @else
                                        <dd>Calculated at checkout</dd>
                                    @endif
                                </div>
                                <div class="row row-total">
                                    <dt>Total Amount<small>Inclusive of all taxes</small></dt>
                                    <dd>@money($summary['total'])</dd>
                                </div>
                            </dl>

                            @if ($summary['saved'] > 0)
                                <p class="save-chip">
                                    <i class="fa-solid fa-piggy-bank" aria-hidden="true"></i> You are saving
                                    @money($summary['saved']) on this order
                                </p>
                            @endif

                            <a href="javascript:void(0)" class="btn btn-primary place-btn js-place-order">
                                Continue to Payment
                                <i class="fa-solid fa-arrow-right-long" aria-hidden="true"></i>
                            </a>
                            <p class="terms-note">
                                By continuing, you agree to our <a href="{{ url('/terms') }}">Terms</a> and
                                <a href="{{ route('privacy-policy') }}">Privacy Policy</a>.
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
                </form>

                <!-- mobile sticky bar -->
                <div class="co-bar">
                    <div class="bar-total">
                        <span>Total</span>
                        <strong>@money($summary['total'])</strong>
                    </div>
                    <a href="javascript:void(0)" class="btn btn-primary js-place-order">
                        Continue to Payment
                        <i class="fa-solid fa-arrow-right-long" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('scripts')
    @if (!empty($beginCheckoutScript))
        {!! $beginCheckoutScript !!}
    @endif

    @php
        $coJs = [
            'auth' => (bool) $customer,
            'cities' => route('state.cities', ':id'),
            'addressStore' => route('address.store'),
            'addressUpdate' => route('address.update', ':id'),
            'changeDefault' => route('checkout.change-default-address'),
            'guestAddress' => route('checkout.guest-address'),   // NEW
            'ajaxLogin' => route('checkout.ajax-login'),
            'ajaxRegister' => route('checkout.ajax-register'),
            'trackStep' => route('checkout.track-step'),
            'payment' => route('payment'),
            'login' => route('user.login'),
        ];
    @endphp
    <script>
        $(function () {
            var CO = @json($coJs);
            var ui = window.cartUI || {};

            function notify(type, title, text) {
                if (ui.notify) return ui.notify(type, title, text);
                if (type === 'error') alert(text || title);
            }
            function errText(xhr) {
                if (ui.errorText) return ui.errorText(xhr);
                var j = xhr.responseJSON || {};
                return (j.errors && Object.values(j.errors)[0][0]) || j.message || 'Something went wrong. Please try again.';
            }
            function send(url, method, payload) {
                return $.ajax({
                    url: url, method: method, dataType: 'json',
                    contentType: 'application/json', data: JSON.stringify(payload || {})
                });
            }

            // Enter dabane par poora page submit na ho
            $('#checkoutForm').on('submit', function (e) { e.preventDefault(); });

            // chuna hua address ka email contact section me aa jaye
            $(document).on('change', 'input[name="address"]', function () {
                var em = $(this).data('email');
                if (em) $('#cEmail').val(em);
            });

            // ── cities load ──
            function loadCities($city, stateId, selected) {
                $city.html('<option value="" hidden></option>');
                if (!stateId) return;

                return $.getJSON(CO.cities.replace(':id', stateId))
                    .done(function (list) {
                        if (!list.length) {
                            notify('error', 'City', 'No cities found for this state. Please contact us.');
                            return;
                        }

                        var html = '<option value="" hidden></option>';
                        $.each(list, function (_, c) {
                            html += '<option value="' + c.id + '"' + (String(c.id) === String(selected) ? ' selected' : '') + '>' +
                                $('<i>').text(c.name).html() + '</option>';
                        });
                        $city.html(html);

                        if (selected) $city.val(String(selected));
                        if ($.fn.niceSelect) $city.niceSelect('update');   // agar site custom select plugin use karti ho
                    })
                    .fail(function () {
                        notify('error', 'City', 'Could not load cities. Please try again.');
                    });
            }

            // state badalne par us state ki cities
            $(document).on('change', '.addr-form [data-f="state"]', function () {
                loadCities($(this).closest('.addr-form').find('[data-f="city"]'), this.value, null);
            });

            // saved addresses: Edit kholne se pehle hi poori city list aa jaye (saved city selected rahegi)
            $('.addr-form').each(function () {
                var $f = $(this),
                    $city = $f.find('[data-f="city"]'),
                    st = $f.find('[data-f="state"]').val();

                if (st && $city.val()) loadCities($city, st, $city.val());
            });

            // ── form se address payload ──
            function readForm($s) {
                var street = $.trim($s.find('[data-f="street"]').val());
                var land = $.trim($s.find('[data-f="landmark"]').val());
                return {
                    name: $.trim($s.find('[data-f="name"]').val()),
                    email: $.trim($('#cEmail').val()),
                    phone: $.trim($s.find('[data-f="phone"]').val()),
                    pincode: $.trim($s.find('[data-f="pin"]').val()),
                    state_id: $s.find('[data-f="state"]').val(),
                    city_id: $s.find('[data-f="city"]').val(),
                    address_line_1: $.trim($s.find('[data-f="house"]').val()),
                    // landmark ke liye alag column nahi hai, isliye street ke saath jodh dete hain
                    address_line_2: [street, land].filter(Boolean).join(', ') || null,
                    address_type: $s.find('input[data-f="type"]:checked').val() || 'home',
                    is_default: $s.find('[data-f="default"]').is(':checked')
                };
            }

            // ── guest: address session me save, phir seedha payment page (login wahan hoga) ──
            function guestContinue() {
                var $b = $('.js-place-order, .addr-new .js-save-address');
                if ($b.first().data('busy')) return;
                $b.data('busy', true);

                send(CO.guestAddress, 'POST', readForm($('.addr-new .addr-form')))
                    .done(function () { window.location.href = CO.payment; })
                    .fail(function (xhr) { $b.data('busy', false); notify('error', 'Address', errText(xhr)); });
            }

            // ── address save (edit) / save & deliver here (new) ──
            $(document).on('click', '.js-save-address', function () {
                var $b = $(this), $s = $b.closest('.addr-form'), id = $b.data('id');

                if (!CO.auth && !id) { guestContinue(); return; }   // guest + new address

                if ($b.data('busy')) return;
                $b.data('busy', true);

                var req = id
                    ? send(CO.addressUpdate.replace(':id', id), 'PUT', readForm($s))
                    : send(CO.addressStore, 'POST', readForm($s));

                req.done(function () { window.location.reload(); })
                    .fail(function (xhr) { $b.data('busy', false); notify('error', 'Address', errText(xhr)); });
            });

            // ── Continue to Payment ──
            $(document).on('click', '.js-place-order', function (e) {
                e.preventDefault();

                if (!CO.auth) { guestContinue(); return; }   // login ab payment page par

                var val = $('input[name="address"]:checked').val();

                if (!val) { notify('error', 'Address', 'Please choose a delivery address.'); return; }
                if (val === 'new') {
                    notify('error', 'Address', 'Please fill the new address and click "Save & deliver here".');
                    return;
                }

                var $b = $('.js-place-order');
                if ($b.first().data('busy')) return;
                $b.data('busy', true);

                send(CO.changeDefault, 'POST', { address_id: val })
                    .done(function () { window.location.href = CO.payment; })
                    .fail(function (xhr) { $b.data('busy', false); notify('error', 'Address', errText(xhr)); });
            });

        });
    </script>
@endpush