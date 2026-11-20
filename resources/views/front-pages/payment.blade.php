@extends('layouts.app')

@section('title', 'Payment')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/sass/payment/payment.css') }}" />
@endpush

@section('content')
    @php
        $region = app(\App\Support\Region::class);
        $money = fn($v) => $region->format($v);
        $items = $cart->items->filter(fn($i) => $i->product)->values();
        $arrive = now()->addWeekdays(7);
        $isIndia = !$country || $country->iso2 === 'IN';

        // price rows: same logic as the cart and checkout pages
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
    @endphp

    <main>
        <section class="payment-secA">
            <div class="container">
                <!-- TOP : title + steps -->
                <div class="pay-top">
                    <div class="pay-head">
                        <a href="{{ route('checkout') }}" class="back-link"><i class="fa-solid fa-arrow-left-long"
                                aria-hidden="true"></i>
                            Back to address</a>
                        <h1>Payment</h1>
                    </div>

                    <ol class="pay-steps" aria-label="Checkout progress">
                        <li class="step is-done">
                            <a href="{{ route('cart') }}" class="step-link">
                                <span class="step-icon"><i class="fa-solid fa-check" aria-hidden="true"></i></span>
                                <span class="step-label">Cart</span>
                            </a>
                        </li>
                        <li class="step is-done">
                            <a href="{{ route('checkout') }}" class="step-link">
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

                <!-- Payment failed: JS isko dikhata hai -->
                <div class="pay-alert" role="alert" hidden>
                    <i class="fa-solid fa-triangle-exclamation" aria-hidden="true"></i>
                    <p>
                        <strong>Payment failed.</strong> Your payment could not be completed. Please try again.
                    </p>
                    <a href="#pmTabs" class="alert-link">Try again</a>
                </div>

                <form class="pay-layout form" id="payForm" action="#" method="post" novalidate>
                    @csrf

                    <div class="pay-card">
                        <!-- Row 1: Deliver to -->
                        <div class="pay-sec ship-to">
                            <span class="ship-icon"><i class="fa-solid fa-location-dot" aria-hidden="true"></i></span>
                            <p class="ship-text">
                                <strong>Deliver to {{ $address->name }}, {{ $address->pincode }}</strong>
                                <small>{{ $address->address_line_1 }}@if (filled($address->address_line_2)),
                                {{ $address->address_line_2 }}@endif, {{ $address->city?->name }} · Arrives by
                                    {{ $arrive->format('D, d M') }}</small>
                            </p>
                            <a href="{{ route('checkout') }}" class="ship-change">Change</a>
                        </div>

                        <!-- Row 2: Payment method -->
                        <div class="pay-sec pm">
                            <h2 class="sec-label">
                                <span class="num">1</span> Choose how to pay
                            </h2>

                            <input type="radio" name="payment" id="pmOnline" class="pm-radio" value="online" checked />
                            @if ($codEnabled)
                                <input type="radio" name="payment" id="pmCod" class="pm-radio" value="cod" />
                            @endif

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
                                @if ($codEnabled)
                                    <label for="pmCod" class="pm-tab">
                                        <span class="pm-icon"><i class="fa-solid fa-dollar-sign" aria-hidden="true"></i></span>
                                        <span class="pm-text">
                                            <strong>Cash on Delivery</strong>
                                            <small>India only · Pay when it arrives</small>
                                        </span>
                                        <span class="radio-dot" aria-hidden="true"></span>
                                        <span class="pm-badge">Pay at the door</span>
                                    </label>
                                @endif
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
                            @if ($codEnabled)
                                <p class="pm-info pm-cod">
                                    <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
                                    <span>Cash on Delivery is available for PIN {{ $address->pincode }}. Please keep
                                        the exact amount ready for our delivery partner.</span>
                                </p>
                            @endif
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
                                            inputmode="{{ $isIndia ? 'numeric' : 'text' }}"
                                            maxlength="{{ $isIndia ? 6 : 12 }}" autocomplete="billing postal-code" />
                                        <label for="bPin">{{ $isIndia ? 'PIN code' : 'Postal code' }}</label>
                                    </div>
                                    <div class="form-group s-4">
                                        <select id="bState" name="bill_state">
                                            <option value="" hidden></option>
                                            @foreach ($states as $st)
                                                <option value="{{ $st->id }}">{{ $st->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="bState">State</label>
                                    </div>
                                    <div class="form-group s-4">
                                        <select id="bCity" name="bill_city">
                                            <option value="" hidden></option>
                                        </select>
                                        <label for="bCity">City</label>
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
                                    @foreach ($items->take(3) as $it)
                                        <li>
                                            <img src="{{ asset($it->display_image) }}" alt="{{ $it->product->name }}" width="44"
                                                height="44" loading="lazy" />
                                        </li>
                                    @endforeach
                                </ul>
                                <p class="mini-text">
                                    <strong>Order Summary</strong>
                                    <small>{{ $summary['count'] }}
                                        {{ \Illuminate\Support\Str::plural('item', $summary['count']) }}</small>
                                </p>
                                <a href="{{ route('cart') }}" class="mini-edit">Edit cart</a>
                            </div>

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
                                    <dt>Amount Payable</dt>
                                    <dd>@money($summary['total'])</dd>
                                </div>
                            </dl>

                            @if ($summary['saved'] > 0)
                                <p class="save-chip">
                                    <i class="fa-solid fa-piggy-bank" aria-hidden="true"></i> You
                                    are saving @money($summary['saved']) · Inclusive of all taxes
                                </p>
                            @endif

                            <a href="javascript:void(0)" class="btn btn-primary place-btn pay-btn js-pay">
                                <i class="fa-solid fa-lock" aria-hidden="true"></i> Pay @money($summary['total'])
                                Securely
                            </a>
                            @if ($codEnabled)
                                <button type="submit" class="btn btn-primary place-btn cod-btn">
                                    Place Order
                                    <i class="fa-solid fa-arrow-right-long" aria-hidden="true"></i>
                                </button>
                            @endif
                            <p class="terms-note">
                                By continuing, you agree to our
                                <a href="{{ url('/terms') }}">Terms</a> and
                                <a href="{{ route('privacy-policy') }}">Privacy Policy</a>.
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
                </form>

                <!-- mobile sticky bar -->
                <div class="pay-bar">
                    <div class="bar-total">
                        <span>Amount Payable</span>
                        <strong>@money($summary['total'])</strong>
                    </div>
                    <a href="javascript:void(0)" class="btn btn-primary bar-pay js-pay">
                        <i class="fa-solid fa-lock" aria-hidden="true"></i> Pay Securely
                    </a>
                    @if ($codEnabled)
                        <button type="submit" form="payForm" class="btn btn-primary bar-cod">
                            Place Order
                            <i class="fa-solid fa-arrow-right-long" aria-hidden="true"></i>
                        </button>
                    @endif
                </div>
            </div>
        </section>
    </main>
@endsection

@push('scripts')
    <script src="https://sdk.cashfree.com/js/v3/cashfree.js"></script>
    <!-- <script src="https://checkout.razorpay.com/v1/checkout.js"></script> -->

    @php
        $payJs = [
            'auth' => (bool) $customer,
            'placeOrder' => route('checkout.place-order'),
            'cashfreeVerify' => route('checkout.cashfree.verify'),
            'cities' => route('state.cities', ':id'),
            'ajaxLogin' => route('checkout.ajax-login'),
            'ajaxRegister' => route('checkout.ajax-register'),
            'trackStep' => route('checkout.track-step'),
            'addressId' => $address->id,          // null for guests
            'guestAddress' => $guestAddress,      // null for logged-in users
            'siteName' => $general->site_name ?? config('app.name'),
            'codAllowed' => (bool) $codEnabled,
        ];
    @endphp
    <script>
        $(function () {
            var PAY = @json($payJs);
            var ui = window.cartUI || {};
            var busy = false;
            var pendingMethod = null;   // payment method waiting for login

            function errText(xhr) {
                if (ui.errorText) return ui.errorText(xhr);
                var j = xhr.responseJSON || {};
                return (j.errors && Object.values(j.errors)[0][0]) || j.message || 'Something went wrong. Please try again.';
            }
            function send(url, payload) {
                return $.ajax({
                    url: url, method: 'POST', dataType: 'json',
                    contentType: 'application/json', data: JSON.stringify(payload || {})
                });
            }
            function setBusy(on) {
                busy = on;
                $('.js-pay').css({ 'pointer-events': on ? 'none' : '', 'opacity': on ? '.6' : '' });
                $('.cod-btn, .bar-cod').prop('disabled', on);
            }
            function fail(msg) {
                setBusy(false);
                var $a = $('.pay-alert');
                $a.find('p').empty()
                    .append($('<strong>').text('Payment failed. '))
                    .append(document.createTextNode(msg || 'Your payment could not be completed. Please try again.'));
                $a.prop('hidden', false);
                $('html, body').animate({ scrollTop: $a.offset().top - 120 }, 250);
            }

            // ── billing cities ──
            $(document).on('change', '#bState', function () {
                var $city = $('#bCity');
                $city.html('<option value="" hidden></option>');
                if (!this.value) return;

                $.getJSON(PAY.cities.replace(':id', this.value)).done(function (list) {
                    var html = '<option value="" hidden></option>';
                    $.each(list, function (_, c) {
                        html += '<option value="' + c.id + '">' + $('<i>').text(c.name).html() + '</option>';
                    });
                    $city.html(html);
                    if ($.fn.niceSelect) $city.niceSelect('update');
                });
            });

            function payload(method) {
                var same = $('#billSame').is(':checked');
                var p = { billing_same: same, payment_method: method };

                if (PAY.addressId) {
                    p.address_id = PAY.addressId;
                } else if (PAY.guestAddress) {
                    $.extend(p, PAY.guestAddress);   // placeOrder creates the address from these fields
                }

                if (!same) {
                    p.bill_name = $.trim($('#bName').val());
                    p.bill_address_line_1 = $.trim($('#bHouse').val());
                    p.bill_address_line_2 = $.trim($('#bStreet').val()) || null;
                    p.bill_pincode = $.trim($('#bPin').val());
                    p.bill_state_id = $('#bState').val();
                    p.bill_city_id = $('#bCity').val();
                }
                return p;
            }

            // ── the actual payment (needs a logged in customer) ──
            function startPayment(method) {
                setBusy(true);
                $('.pay-alert').prop('hidden', true);

                send(PAY.placeOrder, payload(method))
                    .done(function (res) {
                        if (!res.success) { fail(res.message); return; }

                        // address is now saved: retries must reuse it
                        if (res.address_id) { PAY.addressId = res.address_id; PAY.guestAddress = null; }

                        if (method === 'cod') {
                            if (res.redirect_url) { window.location.href = res.redirect_url; return; }
                            fail(res.message);
                            return;
                        }

                        if (!window.Cashfree) {
                            fail('Payment service could not load. Please refresh and try again.');
                            return;
                        }

                        var cf = Cashfree({ mode: res.mode });

                        cf.checkout({ paymentSessionId: res.payment_session_id, redirectTarget: '_modal' })
                            .then(function () {
                                // popup closed (paid, failed or cancelled): the server asks Cashfree what happened
                                return send(PAY.cashfreeVerify, { order_id: res.order_id })
                                    .done(function (v) { window.location.href = v.redirect_url; })
                                    .fail(function (xhr) { fail(errText(xhr)); });
                            })
                            .catch(function () { fail('Could not open the payment window. Please try again.'); });
                    })
                    .fail(function (xhr) { fail(errText(xhr)); });
            }

            // ── click on Pay / Place Order: guest -> login modal first ──
            function begin(method) {
                if (busy) return;

                if (!PAY.auth) {
                    pendingMethod = method;
                    send(PAY.trackStep, { step: 'login_prompt' });
                    var $open = $('[data-model=".login-pop"]').first();
                    if ($open.length) { $open.trigger('click'); }
                    else { window.location.href = '{{ route('user.login') }}'; }
                    return;
                }

                startPayment(method);
            }

            $(document).on('click', '.js-pay', function (e) {
                e.preventDefault();
                begin('cashfree');
            });

            $('#payForm').on('submit', function (e) {
                e.preventDefault();
                // Enter dabane par online select ho to kuch na ho
                if (!PAY.codAllowed || $('input[name="payment"]:checked').val() !== 'cod') return;
                begin('cod');
            });

            // user ne modal band kar diya: pending payment cancel
            $(document).on('click', '.login-pop .close', function () { pendingMethod = null; });

            // layout logs the user in, then tells us: continue the payment with no second click
            $(document).on('auth:success', function (e) {
                var method = pendingMethod;
                pendingMethod = null;

                if (!method) return;            // logged in from the header: let the page reload

                e.preventDefault();             // no reload, we continue the payment
                PAY.auth = true;
                $('.login-pop .close').first().trigger('click');
                startPayment(method);
            });
        });

    </script>
@endpush