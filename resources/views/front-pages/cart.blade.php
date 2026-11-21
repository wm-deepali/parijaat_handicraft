{{-- resources/views/front-pages/cart.blade.php --}}
@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/sass/cart/cart.css') }}" />
@endpush

@section('content')
    @php
        $region = app(\App\Support\Region::class);
        $money = fn($v) => $region->format($v);

        $items = ($cart?->items ?? collect())->filter(fn($i) => $i->product)->values();

        // meta: [label, value, dot colour|null]  (same shape as before, now from the real cart)
        $cartItems = $items->map(function ($item) use ($money) {
            $p = $item->product;
            $unit = (float) $item->price;
            $mrp = max((float) (($item->priceVariant->mrp ?? $p->mrp) ?: $unit), $unit);
            $off = $mrp > $unit ? (int) round((($mrp - $unit) / $mrp) * 100) : 0;

            $meta = collect($item->selected_attributes ?? [])
                ->map(fn($a) => [$a['attribute'] ?? '', $a['value'] ?? '', !empty($a['hex']) ? $a['hex'] : null])
                ->filter(fn($m) => $m[0] !== '' && $m[1] !== '')
                ->values()
                ->all();

            foreach ($item->addons as $a) {
                $meta[] = [$a->detail, 'Yes', null];
            }

            $extra = $item->addons->isNotEmpty()
                ? $item->addons->map(fn($a) => '+ ' . ($a->price > 0 ? $money($a->price) . ' ' : '') . $a->detail)->implode(' · ')
                : null;

            $stock = (int) ($item->stockVariant->stock ?? $p->stock);

            return [
                'id' => $item->id,
                'pid' => $p->id,
                'url' => route('product.show', $p->slug),
                'name' => $p->name,
                'img' => $item->display_image,
                'cat' => $p->subcategory?->name ?: $p->category?->name,
                'meta' => $meta,
                'price' => $money($unit),
                'old' => $off > 0 ? $money($mrp) : null,
                'off' => $off > 0 ? $off . '% OFF' : null,
                'qty' => (int) $item->quantity,
                'total' => $money($item->total),
                'extra' => $extra,
                'stock' => ($stock > 0 && $stock <= 10) ? 'Only ' . $stock . ' ' . \Illuminate\Support\Str::plural('piece', $stock) . ' left' : null,
                'delivery' => filled($p->delivery_time) ? 'Ready to ship, dispatched in ' . $p->delivery_time : null,
            ];
        })->all();

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

        $payMethods = [
            ['Visa', 'fa-brands fa-cc-visa'],
            ['Mastercard', 'fa-brands fa-cc-mastercard'],
            ['UPI and Wallets', 'fa-solid fa-mobile-screen-button'],
            ['Net Banking', 'fa-solid fa-building-columns'],
        ];
    @endphp

    <main>
        @if (count($cartItems))
            <section class="cart-secA">
                <div class="container">
                    {{-- TOP : title + steps --}}
                    <div class="cart-top">
                        <div class="cart-head">
                            <span class="eyebrow">Your Selection</span>
                            <h1>My Cart</h1>
                            <p>{{ $summary['count'] }} {{ \Illuminate\Support\Str::plural('item', $summary['count']) }} ·
                                <b>@money($summary['total'])</b>
                            </p>
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
                            @if ($freeShip)
                                <div @class(['ship-progress', 'is-done' => $freeShip['done']])
                                    style="--p: {{ $freeShip['percent'] }}%">
                                    <span class="ship-icon"><i class="fa-solid fa-truck-fast" aria-hidden="true"></i></span>
                                    @if ($freeShip['done'])
                                        <p><b>Free shipping unlocked</b><span>Your order is above @money($freeShip['threshold'])</span>
                                        </p>
                                        <em>Free delivery</em>
                                    @else
                                        <p><b>Add @money($freeShip['remaining']) more for free shipping</b><span>Free shipping on orders
                                                above @money($freeShip['threshold'])</span></p>
                                        <em>{{ $freeShip['percent'] }}%</em>
                                    @endif
                                    <div class="ship-bar"><span></span></div>
                                </div>
                            @endif

                            <div class="cart-card">
                                <div class="cart-cols" aria-hidden="true">
                                    <span>Product</span>
                                    <span>Total</span>
                                </div>

                                <ul class="cart-list">
                                    @foreach ($cartItems as $item)
                                        <li class="cart-item" data-id="{{ $item['id'] }}" data-product-id="{{ $item['pid'] }}">
                                            <a class="item-img" href="{{ $item['url'] }}">
                                                <img src="{{ asset($item['img']) }}" alt="{{ $item['name'] }}" width="120"
                                                    height="120" loading="lazy" />
                                            </a>
                                            <div class="item-info">
                                                @if ($item['cat'])
                                                    <span class="item-cat">{{ $item['cat'] }}</span>
                                                @endif
                                                <h2 class="item-name"><a href="{{ $item['url'] }}">{{ $item['name'] }}</a></h2>
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
                                                    <strong>{{ $item['price'] }}</strong>
                                                    @if ($item['old'])
                                                        <del>{{ $item['old'] }}</del><span class="item-off">{{ $item['off'] }}</span>
                                                    @endif
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
                                                        <input type="text" class="qty-input" value="{{ $item['qty'] }}" readonly
                                                            aria-label="Quantity" />
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

                            <a href="{{ route('products') }}" class="continue-link">
                                <i class="fa-solid fa-arrow-left-long" aria-hidden="true"></i>
                                Continue Shopping
                            </a>
                        </div>

                        {{-- ============ RIGHT : SUMMARY ============ --}}
                        <aside class="cart-summary" aria-label="Order summary">
                            <div class="sum-head">
                                <h4>Order Summary</h4>
                                <span>{{ $summary['count'] }}
                                    {{ \Illuminate\Support\Str::plural('item', $summary['count']) }}</span>
                            </div>

                            {{-- Coupons --}}
                            <div class="box coupon-box">
                                <h5><i class="fa-solid fa-ticket" aria-hidden="true"></i> Coupons &amp; Offers</h5>
                                <form class="form coupon-form" action="{{ route('cart.apply.coupon') }}" method="post"
                                    novalidate>
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" id="couponInput" name="coupon_code" placeholder=" "
                                            autocomplete="off" />
                                        <label for="couponInput">Enter coupon code</label>
                                    </div>
                                    <button type="submit" class="btn btn-outline-primary">Apply</button>
                                </form>

                                @if ($summary['coupon_code'])
                                    <div class="coupon-applied">
                                        <span class="applied-icon"><i class="fa-solid fa-check" aria-hidden="true"></i></span>
                                        <div class="applied-text">
                                            <strong>{{ $summary['coupon_code'] }} applied</strong>
                                            <span>You saved @money($summary['coupon']) with this coupon</span>
                                        </div>
                                        <button type="button" class="applied-remove"
                                            aria-label="Remove coupon {{ $summary['coupon_code'] }}">
                                            Remove
                                        </button>
                                    </div>
                                @endif

                                @if ($offers->isNotEmpty() || $freeShip)
                                    <p class="offers-title">Available Offers</p>
                                    <ul class="offer-list">
                                        @foreach ($offers as $offer)
                                            @php $isOn = $summary['coupon_code'] && strcasecmp($summary['coupon_code'], $offer->code) === 0; @endphp
                                            <li @class(['is-applied' => $isOn])>
                                                <span class="offer-icon"><i class="fa-solid fa-tag" aria-hidden="true"></i></span>
                                                <div class="offer-text">
                                                    <span class="offer-code">{{ $offer->code }}</span>
                                                    @if (filled($offer->offer_text))
                                                        <p>{{ $offer->offer_text }}</p>
                                                    @endif
                                                </div>
                                                @if ($isOn)
                                                    <span class="offer-state">Applied</span>
                                                @else
                                                    <span class="offer-state js-apply-offer" role="button" tabindex="0"
                                                        data-code="{{ $offer->code }}" style="cursor:pointer">Apply</span>
                                                @endif
                                            </li>
                                        @endforeach

                                        @if ($freeShip)
                                            <li @class(['is-applied' => $freeShip['done']])>
                                                <span class="offer-icon"><i class="fa-solid fa-truck-fast"
                                                        aria-hidden="true"></i></span>
                                                <div class="offer-text">
                                                    <span class="offer-code">FREESHIP</span>
                                                    <p>Free shipping on orders above @money($freeShip['threshold'])</p>
                                                </div>
                                                <span class="offer-state">{{ $freeShip['done'] ? 'Unlocked' : 'Locked' }}</span>
                                            </li>
                                        @endif
                                    </ul>
                                @endif
                            </div>

                            {{-- Delivery --}}
                            <div class="box delivery-box">
                                <h5><i class="fa-solid fa-location-dot" aria-hidden="true"></i> Delivery Details</h5>
                                <form class="form pin-form" action="{{ route('pincode.check') }}" method="get" novalidate>
                                    <div class="form-group">
                                        <input type="text" id="cartPin" name="pincode" inputmode="numeric" maxlength="6"
                                            placeholder=" " value="" />
                                        <label for="cartPin">Pincode</label>
                                    </div>
                                    <button type="submit" class="btn btn-outline-primary">Check</button>
                                </form>
                                <p class="pin-result">
                                    <i class="fa-solid fa-circle-info" aria-hidden="true"></i>
                                    <span>Enter your pincode to check delivery. Ordering from outside India? Delivery time and
                                        charges are shown at checkout.</span>
                                </p>
                                <ul class="del-points">
                                    <li><i class="fa-solid fa-box" aria-hidden="true"></i> Dispatch in 2–4 working days</li>
                                    <li><i class="fa-solid fa-earth-asia" aria-hidden="true"></i> Worldwide shipping with
                                        tracking</li>
                                    <li><i class="fa-solid fa-box-open" aria-hidden="true"></i> Packed to protect metal and
                                        finish</li>
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
                            <strong>@money($summary['total'])</strong>
                        </div>
                        <a href="{{ route('checkout') }}" class="btn btn-primary">
                            Proceed to Address
                            <i class="fa-solid fa-arrow-right-long" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </section>
        @else
            {{-- cart has no items: .cart-secA is not rendered, this is shown instead --}}
            @php $emptyLinks = array_slice(\App\Support\NavMenu::build()['footer'] ?? [], 0, 4); @endphp
            <div class="cart-empty">
                <span class="empty-ico"><i class="fa-solid fa-bag-shopping" aria-hidden="true"></i></span>
                <h2>Your cart is empty</h2>
                <p>
                    Looks like you have not added anything yet. Explore our handcrafted brass diyas, lamps and pooja
                    essentials.
                </p>
                <div class="empty-btns">
                    <a href="{{ route('products') }}" class="btn btn-primary">Shop Now</a>
                    <a href="{{ route('products', ['collection' => ['new-arrivals']]) }}" class="btn btn-outline-primary">View
                        New Arrivals</a>
                </div>
                @if ($emptyLinks)
                    <ul class="empty-links">
                        @foreach ($emptyLinks as $el)
                            <li><a href="{{ route('category.show', $el['slug']) }}">{{ $el['name'] }}</a></li>
                        @endforeach
                    </ul>
                @endif
            </div>
        @endif
    </main>
@endsection

@push('scripts')
    @php
        $cartRoutes = [
            'applyCoupon' => route('cart.apply.coupon'),
            'removeCoupon' => route('cart.remove.coupon'),
            'pincode' => route('pincode.check'),
        ];
    @endphp
    <script>
        $(function () {
            var CP = @json($cartRoutes);
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
            function post(url, method, payload) {
                return $.ajax({
                    url: url, method: method, dataType: 'json',
                    contentType: 'application/json', data: JSON.stringify(payload || {})
                });
            }
            function fire(events) {
                if (typeof window.fireTrackingEvents === 'function') window.fireTrackingEvents(events);
            }

            // page ko dobara fetch karke <main> badal do: items, summary, free-shipping bar sab ek saath sahi rahenge
            function refresh() {
                $.ajax({ url: window.location.href, method: 'GET', dataType: 'html', headers: { Accept: 'text/html' } })
                    .done(function (html) {
                        var $m = $('<div>').append($.parseHTML(html)).find('main').first();
                        if ($m.length) { $('main').first().html($m.html()); }
                        else { window.location.reload(); }
                    })
                    .fail(function () { window.location.reload(); });
            }

            // ── quantity + / - ──
            $(document).on('click', '.cart-item .qty-plus, .cart-item .qty-minus', function () {
                var $b = $(this), $row = $b.closest('.cart-item');
                if ($row.data('busy')) return;
                $row.data('busy', true);

                post(window.APP.cartQty, 'POST', {
                    item_id: $row.data('id'),
                    action: $b.hasClass('qty-plus') ? 'plus' : 'minus'
                })
                    .done(function (res) {
                        if (ui.updateCartUI) ui.updateCartUI(res);
                        fire(res.tracking_events);   // AddToCart (plus) / RemoveFromCart (minus), null if qty didn't change
                        if (res.coupon_message) notify('error', 'Coupon', res.coupon_message);
                        refresh();
                    })
                    .fail(function (xhr) { $row.data('busy', false); notify('error', 'Could not update', errText(xhr)); });
            });

            // ── remove item ──
            $(document).on('click', '.cart-item .item-link.is-remove', function () {
                var $row = $(this).closest('.cart-item');
                if ($row.data('busy')) return;
                $row.data('busy', true);

                post(window.APP.cartRemove.replace(':id', $row.data('id')), 'DELETE')
                    .done(function (res) {
                        if (ui.updateCartUI) ui.updateCartUI(res);
                        fire(res.tracking_events);   // RemoveFromCart
                        if (res.coupon_message) notify('error', 'Coupon', res.coupon_message);
                        refresh();
                    })
                    .fail(function (xhr) { $row.data('busy', false); notify('error', 'Could not remove', errText(xhr)); });
            });

            // ── coupon ──
            function applyCoupon(code) {
                code = $.trim(code || '');
                if (!code) { notify('error', 'Coupon', 'Please enter a coupon code.'); return; }

                post(CP.applyCoupon, 'POST', { coupon_code: code })
                    .done(function (r) {
                        if (r.status) { notify('success', 'Coupon', r.message); refresh(); }
                        else { notify('error', 'Coupon', r.message); }
                    })
                    .fail(function (xhr) { notify('error', 'Coupon', errText(xhr)); });
            }

            $(document).on('submit', '.coupon-form', function (e) {
                e.preventDefault();
                applyCoupon($(this).find('[name="coupon_code"]').val());
            });

            $(document).on('click', '.js-apply-offer', function () { applyCoupon($(this).data('code')); });
            $(document).on('keydown', '.js-apply-offer', function (e) {
                if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); applyCoupon($(this).data('code')); }
            });

            $(document).on('click', '.applied-remove', function () {
                post(CP.removeCoupon, 'POST')
                    .done(function () { refresh(); })
                    .fail(function (xhr) { notify('error', 'Coupon', errText(xhr)); });
            });

            // ── pincode check ──
            $(document).on('submit', '.cart-summary .pin-form', function (e) {
                e.preventDefault();
                var $f = $(this), pin = $.trim($f.find('[name="pincode"]').val());
                var $res = $f.closest('.delivery-box').find('.pin-result'), $txt = $res.find('span'), $ic = $res.find('i');

                function show(ok, msg) {
                    $res.removeClass('ok err').addClass(ok ? 'ok' : 'err');
                    $ic.attr('class', 'fa-solid ' + (ok ? 'fa-circle-check' : 'fa-circle-exclamation'));
                    $txt.text(msg);
                }

                if (!/^\d{6}$/.test(pin)) { show(false, 'Enter a valid 6-digit pincode.'); return; }

                $f.find('button').prop('disabled', true);
                $.getJSON(CP.pincode, { pincode: pin })
                    .done(function (r) {
                        if (!r.status) { show(false, r.message); return; }
                        var place = [r.district, r.state].filter(Boolean).join(', ');
                        var msg = 'Delivery available' + (place ? ' to ' + place : '');
                        if (r.eta) msg += '. Estimated ' + r.eta + (r.eta_date ? ' (by ' + r.eta_date + ')' : '');
                        show(true, msg + '.');
                    })
                    .fail(function (xhr) {
                        var err = xhr.responseJSON && xhr.responseJSON.errors && xhr.responseJSON.errors.pincode;
                        show(false, err ? err[0] : 'Could not check right now. Please try again.');
                    })
                    .always(function () { $f.find('button').prop('disabled', false); });
            });
        });
    </script>
@endpush