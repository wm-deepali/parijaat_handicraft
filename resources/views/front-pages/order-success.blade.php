@extends('layouts.app')

@section('title', 'Thank You for Your Order | Parijaat Handicraft')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/sass/other/other.css') }}" />
@endpush

@section('content')
    @php
        $region = app(\App\Support\Region::class);
        $money = fn($v) => $region->format($v);

        $isCod = $order->payment_method === 'cod';
        $paymentLabel = $isCod
            ? 'Cash on Delivery'
            : ($order->payment_status === 'paid' ? 'Paid Online' : 'Payment Pending');

        $deliveryBy = $order->created_at->copy()->addWeekdays(7);
        $totalLabel = $isCod ? 'Total to Pay' : ($order->payment_status === 'paid' ? 'Total Paid' : 'Total');
    @endphp

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
                            to {{ $order->customer_email ?: 'your email' }}.
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
                            <li><span>Order ID</span><strong>#{{ $order->order_number }}</strong></li>
                            <li><span>Date</span><strong>{{ $order->created_at->format('d M Y') }}</strong></li>
                            <li><span>Payment</span><strong>{{ $paymentLabel }}</strong></li>
                            <li><span>Delivery by</span><strong>{{ $deliveryBy->format('D, d M') }}</strong></li>
                        </ul>

                        <div class="order-summary">
                            <ul class="order-items">
                                @foreach ($order->items as $item)
                                    @php
                                        $p = $item->product;
                                        $img = $item->display_image ?? ($p?->images?->first()?->image ?? 'assets/images/logo.png');

                                        $small = collect($item->selected_attributes ?? [])->pluck('value')->filter()->implode(' · ');
                                        $addonNames = $item->addons->pluck('detail')->filter()->implode(', ');
                                        $small .= ($small !== '' && $addonNames !== '' ? ' · ' : '') . $addonNames;
                                    @endphp
                                    <li>
                                        <img class="thumb" src="{{ asset($img) }}" alt="{{ $item->product_name }}"
                                            width="60" height="60" loading="lazy" />
                                        <div class="info">
                                            <h4>{{ $item->product_name }}</h4>
                                            <p>{{ $small !== '' ? $small . ' · ' : '' }}Qty {{ $item->quantity }}</p>
                                        </div>
                                        <span class="price">{{ $money($item->total) }}</span>
                                    </li>
                                @endforeach
                            </ul>

                            <ul class="order-totals">
                                <li>
                                    <span>Subtotal</span>
                                    <strong>{{ $money($order->subtotal) }}</strong>
                                </li>
                                @if ($order->discount > 0)
                                    <li>
                                        <span>Coupon{{ $order->coupon_code ? ' (' . $order->coupon_code . ')' : '' }}</span>
                                        <strong class="is-green">−{{ $money($order->discount) }}</strong>
                                    </li>
                                @endif
                                @if ($order->tax_amount > 0)
                                    <li>
                                        <span>GST</span>
                                        <strong>+{{ $money($order->tax_amount) }}</strong>
                                    </li>
                                @endif
                                <li>
                                    <span>Shipping</span>
                                    @if ($order->shipping_charge > 0)
                                        <strong>{{ $money($order->shipping_charge) }}</strong>
                                    @else
                                        <strong class="is-green">Free</strong>
                                    @endif
                                </li>
                                <li class="grand">
                                    <span>{{ $totalLabel }}</span>
                                    <strong>{{ $money($order->grand_total) }}</strong>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('scripts')
    @if (!empty($purchaseScript))
        {!! $purchaseScript !!}
    @endif
@endpush