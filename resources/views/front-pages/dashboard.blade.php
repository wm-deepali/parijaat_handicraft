@extends('layouts.app')

@section('title', 'Dashboard | Parijaat Handicraft')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/sass/dashboard/dashboard.css') }}" />
@endpush

@php
    $isIndia = !$country || $country->iso2 === 'IN';
    $typeTag = ['home' => 'Home', 'office' => 'Work', 'other' => 'Other'];
    $initial = strtoupper(mb_substr($customer->name, 0, 1));
    $avatar = $customer->avatar ? asset('storage/' . $customer->avatar) : null;
    $mobileLabel = ($customer->dial_code ? $customer->dial_code . ' ' : '') . $customer->mobile;
@endphp

@section('content')
    <main>
        <section class="dash-secA">
            <div class="container">
                <nav class="breadcrumb" aria-label="Breadcrumb">
                    <a href="{{ route('home') }}">Home</a>
                    <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
                    <span class="current">My Account</span>
                </nav>

                <div class="dash-layout">

                    <!-- ===== User card ===== -->
                    <div class="user-card">
                        <span class="avatar">
                            @if ($avatar)
                                <img src="{{ $avatar }}" alt="{{ $customer->name }}" />
                            @else
                                {{ $initial }}
                            @endif
                        </span>
                        <div class="meta">
                            <h4>{{ $customer->name }}</h4>
                            <p>{{ $customer->email }}</p>
                        </div>
                    </div>

                    <!-- ===== Tab nav ===== -->
                    <ul class="tab-nav">
                        <li data-tab="1" class="active">
                            <i class="fa-solid fa-table-columns" aria-hidden="true"></i> Dashboard
                        </li>
                        <li data-tab="2">
                            <i class="fa-solid fa-truck-fast" aria-hidden="true"></i> Track Order
                        </li>
                        <li data-tab="3">
                            <i class="fa-solid fa-box-open" aria-hidden="true"></i> My Orders
                            @if($ordersTotal)<span class="count">{{ $ordersTotal }}</span>@endif
                        </li>
                          <li data-tab="4">
                            <i class="fa-regular fa-heart" aria-hidden="true"></i> My Wishlist
                            @if($wishCount)<span class="count">{{ $wishCount }}</span>@endif
                        </li>
                        <li data-tab="5">
                            <i class="fa-regular fa-user" aria-hidden="true"></i> My Profile
                        </li>
                    </ul>

                    <!-- ===== Tab content ===== -->
                    <div class="tab-nav-content">

                        <!-- ========== TAB 1: DASHBOARD ========== -->
                        <div class="tabs active" data-tab="1">
                            <div class="welcome">
                                <div class="welcome-text">
                                    <h2>Welcome back, {{ \Illuminate\Support\Str::before($customer->name, ' ') }}!</h2>
                                    <p>Track your orders, manage your wishlist and keep your details up to date.</p>
                                </div>
                                <a href="{{ route('products') }}" class="btn btn-white">
                                    Continue Shopping
                                    <i class="fa-solid fa-arrow-right-long" aria-hidden="true"></i>
                                </a>
                            </div>

                            <div class="stat-grid">
                                <div class="stat-card">
                                    <span class="stat-icon"><i class="fa-solid fa-box-open" aria-hidden="true"></i></span>
                                    <div><strong>{{ $stats['total'] }}</strong><span>Total Orders</span></div>
                                </div>
                                <div class="stat-card">
                                    <span class="stat-icon"><i class="fa-solid fa-truck-fast" aria-hidden="true"></i></span>
                                    <div><strong>{{ $stats['active'] }}</strong><span>Active Deliveries</span></div>
                                </div>
                                <div class="stat-card">
                                    <span class="stat-icon"><i class="fa-solid fa-circle-check"
                                            aria-hidden="true"></i></span>
                                    <div><strong>{{ $stats['delivered'] }}</strong><span>Delivered</span></div>
                                </div>
                                <div class="stat-card">
                                    <span class="stat-icon"><i class="fa-solid fa-rotate-left"
                                            aria-hidden="true"></i></span>
                                    <div><strong>{{ $stats['cancelled'] }}</strong><span>Cancelled</span></div>
                                </div>
                            </div>

                            <div class="dash-panel">
                                <div class="panel-head">
                                    <h3><i class="fa-solid fa-clock-rotate-left" aria-hidden="true"></i> Recent Orders</h3>
                                    @if($recent->isNotEmpty())
                                        <a href="javascript:void(0);" class="panel-link go-tab" data-go="3">
                                            View all orders
                                            <i class="fa-solid fa-arrow-right-long" aria-hidden="true"></i>
                                        </a>
                                    @endif
                                </div>

                                @if($recent->isNotEmpty())
                                    <div class="recent-list">
                                        @foreach($recent as $r)
                                            @php
                                                $first = $r['items'][0] ?? null;
                                                $more  = $r['items_count'] - 1;
                                            @endphp
                                            <div class="recent-item">
                                                <span class="thumb">
                                                    @if($first && $first['thumb'])
                                                        <img src="{{ $first['thumb'] }}" alt="" loading="lazy" />
                                                    @endif
                                                </span>
                                                <div class="info">
                                                    <h4>{{ $first['name'] ?? 'Order' }}{{ $more > 0 ? ' + ' . $more . ' more ' . \Illuminate\Support\Str::plural('item', $more) : '' }}</h4>
                                                    <p>Order #{{ $r['number'] }} · {{ $r['placed'] }}</p>
                                                </div>
                                                <strong class="amount">{{ $r['total'] }}</strong>
                                                <span class="status {{ $r['status_class'] }}">{{ $r['status_label'] }}</span>
                                                @if($r['is_active'])
                                                    <a href="{{ $r['track_url'] }}" class="btn btn-outline-primary btn-sm">Track</a>
                                                @else
                                                    <a href="javascript:void(0);" class="btn btn-outline-primary btn-sm go-tab"
                                                        data-go="3">View</a>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="empty-state">
                                        <i class="fa-solid fa-bag-shopping" aria-hidden="true"></i>
                                        <h4>No orders yet</h4>
                                        <p>When you place an order it will show up here.</p>
                                        <a href="{{ route('products') }}" class="btn btn-primary">Start Shopping</a>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- ========== TAB 2: TRACK ORDER ========== -->
                        <div class="tabs" data-tab="2">
                            <div class="dash-panel">
                                <div class="panel-head">
                                    <h3><i class="fa-solid fa-magnifying-glass-location" aria-hidden="true"></i> Track Your
                                        Order</h3>
                                </div>

                                <form class="form track-form" action="{{ url()->current() }}#tab-2" method="get">
                                    <div class="form-group">
                                        <input type="text" id="tr-id" name="track" value="{{ $trackNo }}" placeholder=" "
                                            required />
                                        <label for="tr-id">Order ID (e.g. PH-10482)</label>
                                        <span class="error"></span>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Track Order</button>
                                </form>
                            </div>

                            @if($trackNotFound)
                                <div class="dash-panel">
                                    <div class="empty-state">
                                        <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
                                        <h4>Order not found</h4>
                                        <p>We couldn't find order #{{ $trackNo }} on your account. Please check the order ID.</p>
                                    </div>
                                </div>
                            @elseif($tracked)
                                @php
                                    $stageIcons = [
                                        'new' => 'fa-receipt',
                                        'processing' => 'fa-circle-check',
                                        'shipped' => 'fa-truck-fast',
                                        'delivered' => 'fa-house',
                                    ];
                                    // detailed log: only steps that actually happened, newest first
                                    $logSteps = array_reverse(array_values(array_filter($tracked['steps'], fn($s) => $s['time'])));
                                @endphp

                                <div class="dash-panel shipment">
                                    <div class="ship-top">
                                        <div>
                                            <h4>Order #{{ $tracked['number'] }}</h4>
                                            <p>Placed on {{ $tracked['placed'] }} · {{ $tracked['items_count'] }}
                                                {{ \Illuminate\Support\Str::plural('item', $tracked['items_count']) }} ·
                                                {{ $tracked['total'] }}</p>
                                        </div>
                                        <span class="status {{ $tracked['status_class'] }}">{{ $tracked['status_label'] }}</span>
                                    </div>

                                    <div class="ship-meta">
                                        @if($tracked['shipment'] && $tracked['shipment']['courier'])
                                            <div><small>Courier Partner</small><strong>{{ $tracked['shipment']['courier'] }}</strong></div>
                                        @endif
                                        @if($tracked['shipment'] && $tracked['shipment']['tracking'])
                                            <div><small>Tracking ID (AWB)</small><strong>{{ $tracked['shipment']['tracking'] }}</strong></div>
                                        @endif
                                        <div><small>Payment</small><strong>{{ $tracked['payment']['method'] }} · {{ $tracked['payment']['status'] }}</strong></div>
                                        <div><small>Delivering To</small><strong>{{ $tracked['address']['city'] }}{{ $tracked['address']['state'] ? ', ' . $tracked['address']['state'] : '' }}</strong></div>
                                    </div>

                                    @if($tracked['shipment'] && $tracked['shipment']['site'])
                                        <p style="margin:0 0 14px">
                                            <a href="{{ $tracked['shipment']['site'] }}" target="_blank" rel="noopener"
                                                class="btn btn-outline-primary btn-sm">
                                                <i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i>
                                                Track on courier website
                                            </a>
                                        </p>
                                    @endif

                                    @if($tracked['stages'])
                                        <ul class="track-steps">
                                            @foreach($tracked['stages'] as $st)
                                                <li class="{{ $st['class'] }}">
                                                    <span class="dot"><i class="fa-solid {{ $stageIcons[$st['key']] }}"
                                                            aria-hidden="true"></i></span>
                                                    <h5>{{ $st['title'] }}</h5>
                                                    <span class="time">{{ $st['time'] ?? 'Pending' }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif

                                    <div class="ship-log">
                                        <h5 class="od-title">{{ $tracked['status'] === 'cancelled' ? 'Order Updates' : 'Delivery Updates' }}</h5>
                                        <ul class="timeline">
                                            @foreach($logSteps as $s)
                                                <li class="{{ $s['class'] }}">
                                                    <span class="dot">
                                                        @if($s['class'] === 'done')
                                                            <i class="fa-solid fa-check" aria-hidden="true"></i>
                                                        @elseif($s['class'] === 'cancel')
                                                            <i class="fa-solid fa-xmark" aria-hidden="true"></i>
                                                        @endif
                                                    </span>
                                                    <h5>{{ $s['title'] }}</h5>
                                                    @if($s['desc'])<p>{{ $s['desc'] }}</p>@endif
                                                    <span class="time">{{ $s['time'] }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @else
                                <div class="dash-panel">
                                    <div class="empty-state">
                                        <i class="fa-solid fa-truck-fast" aria-hidden="true"></i>
                                        <h4>Nothing to track yet</h4>
                                        <p>Once you place an order, you can follow it here.</p>
                                        <a href="{{ route('products') }}" class="btn btn-primary">Start Shopping</a>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- ========== TAB 3: MY ORDERS ========== -->
                        <div class="tabs" data-tab="3">
                            <div class="dash-panel">
                                <div class="panel-head">
                                    <h3><i class="fa-solid fa-box-open" aria-hidden="true"></i> My Orders</h3>
                                </div>

                                <form class="form orders-bar" action="{{ url()->current() }}#tab-3" method="get">
                                    <div class="form-group has-icon search-icon">
                                        <input type="text" id="od-search" name="q" value="{{ request('q') }}"
                                            placeholder=" " />
                                        <label for="od-search">Search by order ID or product</label>
                                    </div>
                                </form>

                                @forelse ($orders as $o)
                                    <div class="order-card">
                                        <div class="order-head">
                                            <div class="oh-id">
                                                <strong>#{{ $o['number'] }}</strong>
                                                <span>Placed on {{ $o['placed'] }}</span>
                                            </div>
                                            <div class="oh-total"><small>Total</small><b>{{ $o['total'] }}</b></div>
                                            <div class="oh-status">
                                                <span class="status {{ $o['status_class'] }}">{{ $o['status_label'] }}</span>
                                            </div>
                                            <button type="button" class="order-toggle" aria-label="Show order details">
                                                <i class="fa-solid fa-chevron-down" aria-hidden="true"></i>
                                            </button>
                                        </div>

                                        <div class="order-detail">
                                            <div class="od-grid">
                                                <div>
                                                    <h5 class="od-title">Items in this order</h5>
                                                    <div class="od-items">
                                                        @foreach ($o['items'] as $it)
                                                            <div class="od-item">
                                                                <span class="thumb">
                                                                    @if ($it['thumb'])
                                                                        <img src="{{ $it['thumb'] }}" alt="" loading="lazy" />
                                                                    @endif
                                                                </span>
                                                                <div class="od-name">
                                                                    <h4>{{ $it['name'] }}</h4>
                                                                    <p>
                                                                        @if ($it['variant']) {{ $it['variant'] }} · @endif
                                                                        Qty {{ $it['qty'] }}
                                                                    </p>
                                                                    @foreach ($it['addons'] as $ad)
                                                                        <p>+ {{ $ad }}</p>
                                                                    @endforeach
                                                                </div>
                                                                <strong>{{ $it['line'] }}</strong>
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                    <h5 class="od-title">Price details</h5>
                                                    <div class="od-summary">
                                                        @foreach ($o['prices'] as $p)
                                                            <p class="{{ $p['total'] ? 'total' : '' }}">
                                                                <span>{{ $p['label'] }}</span>
                                                                <span class="{{ $p['green'] ? 'green' : '' }}">{{ $p['value'] }}</span>
                                                            </p>
                                                        @endforeach
                                                    </div>

                                                    @if ($o['refund'])
                                                        <h5 class="od-title">Refund details</h5>
                                                        <div class="od-summary">
                                                            <p><span>Refund amount</span><span>{{ $o['refund']['amount'] }}</span></p>
                                                            <p><span>Refund to</span><span>Original payment method</span></p>
                                                            <p class="total"><span>Status</span><span class="green">{{ $o['refund']['status'] }}</span></p>
                                                        </div>
                                                    @endif
                                                </div>

                                                <div>
                                                    <h5 class="od-title">Order progress</h5>
                                                    <ul class="timeline">
                                                        @foreach ($o['steps'] as $s)
                                                            <li class="{{ $s['class'] }}">
                                                                <span class="dot">
                                                                    @if ($s['class'] === 'done')
                                                                        <i class="fa-solid fa-check" aria-hidden="true"></i>
                                                                    @elseif ($s['class'] === 'cancel')
                                                                        <i class="fa-solid fa-xmark" aria-hidden="true"></i>
                                                                    @endif
                                                                </span>
                                                                <h5>{{ $s['title'] }}</h5>
                                                                @if ($s['desc']) <p>{{ $s['desc'] }}</p> @endif
                                                                @if ($s['time']) <span class="time">{{ $s['time'] }}</span> @endif
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="od-info">
                                                <div class="od-box">
                                                    <h5 class="od-title">Delivery address</h5>
                                                    <p>
                                                        <b>{{ $o['address']['name'] }}</b><br />
                                                        {{ $o['address']['line1'] }}@if ($o['address']['line2']), {{ $o['address']['line2'] }}@endif<br />
                                                        {{ $o['address']['city'] }}@if ($o['address']['state']), {{ $o['address']['state'] }}@endif
                                                        @if ($o['address']['pin']) - {{ $o['address']['pin'] }}@endif<br />
                                                        {{ $o['address']['country'] }}
                                                        @if ($o['address']['phone'])<br />Mobile: {{ $o['address']['phone'] }}@endif
                                                    </p>
                                                </div>
                                                <div class="od-box">
                                                    <h5 class="od-title">Payment</h5>
                                                    <p>
                                                        <b>{{ $o['payment']['method'] }}</b>
                                                        @if ($o['payment']['paid_via'])<br />Paid via: {{ $o['payment']['paid_via'] }}@endif
                                                        @if ($o['payment']['txn'])<br />Transaction ID: {{ $o['payment']['txn'] }}@endif
                                                        <br />Status: {{ $o['payment']['status'] }}
                                                        <br />Amount: {{ $o['total'] }}
                                                    </p>
                                                </div>
                                                @if ($o['shipment'])
                                                    <div class="od-box">
                                                        <h5 class="od-title">Shipment</h5>
                                                        <p>
                                                            @if ($o['shipment']['courier'])<b>{{ $o['shipment']['courier'] }}</b><br />@endif
                                                            @if ($o['shipment']['tracking'])AWB: {{ $o['shipment']['tracking'] }}@endif
                                                        </p>
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="od-actions">
                                                @if ($o['is_active'])
                                                    <a href="{{ $o['track_url'] }}" class="btn btn-primary btn-sm">
                                                        <i class="fa-solid fa-truck-fast" aria-hidden="true"></i> Track Order
                                                    </a>
                                                @endif
                                                @if ($o['invoice_url'])
                                                    <a href="{{ $o['invoice_url'] }}" target="_blank"
                                                        class="btn btn-outline-primary btn-sm">
                                                        <i class="fa-solid fa-file-invoice" aria-hidden="true"></i> Download Invoice
                                                    </a>
                                                @endif
                                                <a href="{{ route('contact') }}" class="btn btn-outline-primary btn-sm">
                                                    <i class="fa-solid fa-headset" aria-hidden="true"></i> Need Help?
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="empty-state">
                                        <i class="fa-solid fa-bag-shopping" aria-hidden="true"></i>
                                        <h4>{{ request('q') ? 'No matching orders' : 'No orders yet' }}</h4>
                                        <p>{{ request('q') ? 'Try a different order ID or product name.' : 'When you place an order it will show up here.' }}</p>
                                        @if (request('q'))
                                            <a href="{{ url()->current() }}#tab-3" class="btn btn-primary">Clear search</a>
                                        @else
                                            <a href="{{ route('products') }}" class="btn btn-primary">Start Shopping</a>
                                        @endif
                                    </div>
                                @endforelse

                                @if ($orders->hasPages())
                                    <div style="display:flex;justify-content:space-between;align-items:center;margin-top:16px;gap:10px;flex-wrap:wrap">
                                        <small class="muted">
                                            Showing {{ $orders->firstItem() }}–{{ $orders->lastItem() }} of {{ $orders->total() }}
                                        </small>
                                        <div style="display:flex;gap:8px">
                                            @if ($orders->onFirstPage())
                                                <span class="btn btn-outline-primary btn-sm" style="opacity:.4;pointer-events:none">← Previous</span>
                                            @else
                                                <a href="{{ $orders->previousPageUrl() }}" class="btn btn-outline-primary btn-sm">← Previous</a>
                                            @endif
                                            @if ($orders->hasMorePages())
                                                <a href="{{ $orders->nextPageUrl() }}" class="btn btn-outline-primary btn-sm">Next →</a>
                                            @else
                                                <span class="btn btn-outline-primary btn-sm" style="opacity:.4;pointer-events:none">Next →</span>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- ========== TAB 4: WISHLIST ========== -->
                        <div class="tabs" data-tab="4">
                            <div class="dash-panel">
                                <div class="panel-head">
                                    <h3>
                                        <i class="fa-regular fa-heart" aria-hidden="true"></i> My Wishlist
                                        <span class="muted wish-count">({{ $wishCount }}
                                            {{ \Illuminate\Support\Str::plural('item', $wishCount) }})</span>
                                    </h3>
                                </div>

                                <div class="wish-grid" @if(!$wishCount) style="display:none" @endif>
                                    @foreach ($wishlist as $w)
                                        <article @class(['wish-card', 'out' => !$w['in_stock']]) data-id="{{ $w['id'] }}">
                                            <button type="button" class="wish-remove" aria-label="Remove from wishlist">
                                                <i class="fa-solid fa-xmark" aria-hidden="true"></i>
                                            </button>

                                            <a href="{{ $w['url'] ?? 'javascript:void(0)' }}" class="wish-image">
                                                @if ($w['img'])
                                                    <img src="{{ $w['img'] }}" alt="{{ $w['name'] }}" loading="lazy" />
                                                @endif
                                                @if ($w['in_stock'] && (int) ($w['off'] ?? 0) > 0)
                                                    <span class="badge">-{{ (int) $w['off'] }}%</span>
                                                @endif
                                            </a>

                                            <div class="wish-info">
                                                @if ($w['category'])
                                                    <span class="cat">{{ $w['category'] }}</span>
                                                @endif
                                                <h4><a href="{{ $w['url'] ?? 'javascript:void(0)' }}">{{ $w['name'] }}</a></h4>

                                                <div class="wish-price">
                                                    <strong>{{ $w['now'] ?? '' }}</strong>
                                                    @if (!empty($w['old']))
                                                        <del>{{ $w['old'] }}</del>
                                                    @endif
                                                    @if ($w['save'])
                                                        <span class="save">Save {{ $w['save'] }}</span>
                                                    @endif
                                                </div>

                                                @if ($w['in_stock'])
                                                    <span class="stock in"><i class="fa-solid fa-circle-check"
                                                            aria-hidden="true"></i> In Stock</span>
                                                @else
                                                    <span class="stock"><i class="fa-solid fa-circle-xmark"
                                                            aria-hidden="true"></i> Out of Stock</span>
                                                @endif

                                                <div class="wish-cta">
                                                    @if ($w['in_stock'])
                                                        <button type="button" class="btn btn-primary btn-sm js-add-cart"
                                                            data-id="{{ $w['id'] }}" data-name="{{ $w['name'] }}"
                                                            data-toast-title="Added to Cart"
                                                            data-toast-text="{{ $w['name'] }} has been added to your cart."
                                                            data-toast-type="success">
                                                            <i class="fa-solid fa-bag-shopping" aria-hidden="true"></i> Add to Cart
                                                        </button>
                                                    @else
                                                        <button type="button" class="btn btn-primary btn-sm" disabled>
                                                            <i class="fa-regular fa-bell" aria-hidden="true"></i> Notify Me
                                                        </button>
                                                    @endif
                                                    <a href="{{ $w['url'] ?? 'javascript:void(0)' }}"
                                                        class="btn btn-outline-primary btn-sm">View</a>
                                                </div>
                                            </div>
                                        </article>
                                    @endforeach
                                </div>

                                <div class="empty-state wish-empty" @if($wishCount) style="display:none" @else style="display:block" @endif>
                                    <i class="fa-regular fa-heart" aria-hidden="true"></i>
                                    <h4>Your wishlist is empty</h4>
                                    <p>Save the brass and copper pieces you love and find them here.</p>
                                    <a href="{{ route('products') }}" class="btn btn-primary">Explore Collection</a>
                                </div>
                            </div>
                        </div>

                        <!-- ========== TAB 5: MY PROFILE ========== -->
                        <div class="tabs" data-tab="5">
                            <!-- Personal details -->
                            <div class="dash-panel">
                                <div class="panel-head">
                                    <h3><i class="fa-regular fa-user" aria-hidden="true"></i> Personal Details</h3>
                                    <button type="button" class="btn btn-outline-primary btn-sm edit-toggle">
                                        <span class="t-edit"><i class="fa-solid fa-pen" aria-hidden="true"></i> Edit</span>
                                        <span class="t-close"><i class="fa-solid fa-xmark" aria-hidden="true"></i>
                                            Close</span>
                                    </button>
                                </div>

                                <div class="view-box">
                                    <div class="profile-head">
                                        <span class="avatar lg" id="pfAvatarView">
                                            @if ($avatar) <img src="{{ $avatar }}" alt="{{ $customer->name }}" /> @else
                                            {{ $initial }} @endif
                                        </span>
                                        <div>
                                            <h4>{{ $customer->name }}</h4>
                                            <p>Member since {{ $customer->created_at->format('M Y') }}</p>
                                        </div>
                                    </div>
                                    <div class="detail-list">
                                        <div><small>Full Name</small>
                                            <p>{{ $customer->name }}</p>
                                        </div>
                                        <div><small>Email</small>
                                            <p>{{ $customer->email }}</p>
                                        </div>
                                        <div><small>Mobile</small>
                                            <p>{{ $customer->mobile ? $mobileLabel : '—' }}</p>
                                        </div>
                                        <div><small>Date of Birth</small>
                                            <p>{{ $customer->dob ? \Illuminate\Support\Carbon::parse($customer->dob)->format('d M Y') : '—' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="edit-box">
                                    <form class="form profile-form" id="profileForm" action="{{ route('profile.update') }}"
                                        method="post" enctype="multipart/form-data" novalidate>
                                        @csrf
                                        <div class="avatar-upload">
                                            <span class="avatar lg">
                                                @if ($avatar) <img src="{{ $avatar }}" alt="" /> @else {{ $initial }} @endif
                                            </span>
                                            <div>
                                                <label class="btn btn-outline-primary btn-sm" for="pf-photo">
                                                    <i class="fa-solid fa-camera" aria-hidden="true"></i> Change Photo
                                                </label>
                                                <input type="file" id="pf-photo" name="photo" accept="image/*" hidden />
                                                <p>JPG or PNG, max 2 MB.</p>
                                            </div>
                                        </div>

                                        <div class="form-grid">
                                            <div class="form-group">
                                                <input type="text" id="pf-name" name="name" value="{{ $customer->name }}"
                                                    placeholder=" " required />
                                                <label for="pf-name">Full Name</label>
                                                <span class="error"></span>
                                            </div>
                                            <div class="form-group">
                                                <input type="email" id="pf-email" value="{{ $customer->email }}"
                                                    placeholder=" " readonly />
                                                <label for="pf-email">Email</label>
                                                <span class="error"></span>
                                            </div>
                                            <div class="form-group">
                                                <input type="tel" id="pf-mobile" name="mobile"
                                                    value="{{ $customer->mobile }}" placeholder=" " inputmode="numeric"
                                                    required />
                                                <label for="pf-mobile">Mobile Number</label>
                                                <span class="error"></span>
                                            </div>
                                            <div class="form-group">
                                                <input type="date" id="pf-dob" name="dob"
                                                    value="{{ $customer->dob ? \Illuminate\Support\Carbon::parse($customer->dob)->format('Y-m-d') : '' }}"
                                                    max="{{ now()->subDay()->format('Y-m-d') }}" placeholder=" " />
                                                <label for="pf-dob">Date of Birth</label>
                                                <span class="error"></span>
                                            </div>
                                        </div>

                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                            <button type="button"
                                                class="btn btn-outline-primary edit-cancel">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Saved addresses -->
                            <div class="dash-panel">
                                <div class="panel-head">
                                    <h3><i class="fa-solid fa-location-dot" aria-hidden="true"></i> Saved Addresses</h3>
                                    <button type="button" class="btn btn-outline-primary btn-sm addr-open" data-id="">
                                        <i class="fa-solid fa-plus" aria-hidden="true"></i> Add New
                                    </button>
                                </div>

                                <div class="addr-list">
                                    @forelse ($addresses as $a)
                                        @php
                                            $addrData = [
                                                'name' => $a->name,
                                                'phone' => $a->phone,
                                                'pincode' => $a->pincode,
                                                'state_id' => $a->state_id,
                                                'city_id' => $a->city_id,
                                                'address_line_1' => $a->address_line_1,
                                                'address_line_2' => $a->address_line_2,
                                                'address_type' => $a->address_type ?: 'home',
                                                'is_default' => (bool) $a->is_default,
                                            ];
                                        @endphp
                                        <div class="addr-card" data-id="{{ $a->id }}"
                                            data-address="{{ json_encode($addrData) }}">

                                            <span class="addr-type {{ $a->is_default ? 'default' : '' }}">
                                                {{ $typeTag[$a->address_type ?: 'home'] ?? 'Home' }}{{ $a->is_default ? ' · Default' : '' }}
                                            </span>
                                            <h5>{{ $a->name }}</h5>
                                            <p>{{ $a->address_line_1 }}@if (filled($a->address_line_2)),
                                            {{ $a->address_line_2 }}@endif<br />
                                                {{ $a->city?->name }}, {{ $a->state?->name }} - {{ $a->pincode }}<br />
                                                Mobile: {{ $a->phone }}
                                            </p>
                                            <div class="addr-actions">
                                                <a href="javascript:void(0);" class="addr-open" data-id="{{ $a->id }}"><i
                                                        class="fa-solid fa-pen" aria-hidden="true"></i> Edit</a>
                                                <a href="javascript:void(0);" class="remove" data-id="{{ $a->id }}"><i
                                                        class="fa-regular fa-trash-can" aria-hidden="true"></i> Remove</a>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="muted">You have no saved addresses yet.</p>
                                    @endforelse
                                </div>

                                <div class="addr-form">
                                    <h5 class="od-title" id="adTitle">Address details</h5>
                                    <form class="form address-form" id="addressForm" action="#" method="post" novalidate>
                                        @csrf
                                        <input type="hidden" id="ad-id" value="">
                                        <div class="form-grid">
                                            <div class="form-group">
                                                <input type="text" id="ad-name" name="name" placeholder=" " required />
                                                <label for="ad-name">Full Name</label>
                                                <span class="error"></span>
                                            </div>
                                            <div class="form-group">
                                                <input type="tel" id="ad-mobile" name="phone" placeholder=" "
                                                    inputmode="{{ $isIndia ? 'numeric' : 'tel' }}"
                                                    maxlength="{{ $isIndia ? 10 : 20 }}" required />
                                                <label for="ad-mobile">Mobile Number</label>
                                                <span class="error"></span>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" id="ad-pin" name="pincode" placeholder=" "
                                                    maxlength="{{ $isIndia ? 6 : 12 }}" required />
                                                <label for="ad-pin">{{ $isIndia ? 'Pincode' : 'Postal code' }}</label>
                                                <span class="error"></span>
                                            </div>
                                            <div class="form-group">
                                                <select id="ad-state" name="state_id" required>
                                                    <option value="" hidden></option>
                                                    @foreach ($states as $st)
                                                        <option value="{{ $st->id }}">{{ $st->name }}</option>
                                                    @endforeach
                                                </select>
                                                <label for="ad-state">State</label>
                                                <span class="error"></span>
                                            </div>
                                            <div class="form-group">
                                                <select id="ad-city" name="city_id" required>
                                                    <option value="" hidden></option>
                                                </select>
                                                <label for="ad-city">City</label>
                                                <span class="error"></span>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" id="ad-line2" name="address_line_2" placeholder=" " />
                                                <label for="ad-line2">Street / Area / Landmark (optional)</label>
                                                <span class="error"></span>
                                            </div>
                                            <div class="form-group full">
                                                <input type="text" id="ad-line" name="address_line_1" placeholder=" "
                                                    required />
                                                <label for="ad-line">House / Flat no., building</label>
                                                <span class="error"></span>
                                            </div>
                                        </div>

                                        <div class="addr-extra">
                                            <div class="type-pills">
                                                <label class="pill"><input type="radio" name="address_type" value="home"
                                                        checked /> <span>Home</span></label>
                                                <label class="pill"><input type="radio" name="address_type"
                                                        value="office" /> <span>Work</span></label>
                                                <label class="pill"><input type="radio" name="address_type" value="other" />
                                                    <span>Other</span></label>
                                            </div>
                                            <label class="check"><input type="checkbox" name="is_default" id="ad-default" />
                                                <span>Make this my default address</span></label>
                                        </div>

                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-primary">Save Address</button>
                                            <button type="button"
                                                class="btn btn-outline-primary addr-cancel">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- ===== Sign out ===== -->
                    <a href="javascript:void(0)" class="logout-btn">
                        <i class="fa-solid fa-arrow-right-from-bracket" aria-hidden="true"></i> Sign Out
                    </a>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('scripts')
    <script>
        $(function () {
            var $dash = $(".dash-secA");
            var $nav = $dash.find(".tab-nav");
            var $content = $dash.find(".tab-nav-content");

            // ===== Tab activate (common JS par depend nahi) =====
            function activateTab(n) {
                var $li = $nav.children('li[data-tab="' + n + '"]');
                var $target = $content.children('.tabs[data-tab="' + n + '"]');
                if (!$li.length || !$target.length) return false;

                $li.addClass("active").siblings().removeClass("active");
                $target.addClass("active").siblings(".tabs").removeClass("active");

                var el = $li.get(0);
                if (el && el.scrollIntoView && $nav.css("overflow-x") === "auto") {
                    $nav.scrollLeft(el.offsetLeft - 20);
                }
                return true;
            }

            function scrollToDash() {
                $("html, body").animate({ scrollTop: $dash.offset().top - 150 }, 300);
            }

            // ===== Hash se tab kholna (/dashboard#tab-1 ... #tab-5) =====
            function openTabFromHash(scroll) {
                var h = window.location.hash.match(/^#tab-(\d+)$/);
                if (!h) return;
                if (activateTab(h[1]) && scroll) scrollToDash();
            }

            openTabFromHash(false);
            $(window).on("load", function () { openTabFromHash(true); });
            setTimeout(function () { openTabFromHash(false); }, 300);
            $(window).on("hashchange", function () { openTabFromHash(true); });

            // same hash par dobara click karne par bhi kaam kare
            $(document).on("click", 'a[href*="dashboard#tab-"]', function () {
                var m = this.getAttribute("href").match(/#tab-(\d+)$/);
                var onDash = window.location.pathname.replace(/\/+$/, "").split("/").pop() === "dashboard";
                if (m && onDash) {
                    activateTab(m[1]);
                    scrollToDash();
                }
            });

            // tab click par URL hash update (refresh par wahi tab khule)
            $nav.children("li").on("click", function () {
                try { history.replaceState(null, "", "#tab-" + $(this).data("tab")); } catch (e) { }
            });

            // ===== "View all / Track" links =====
            $(".go-tab").on("click", function () {
                var n = $(this).data("go");
                $nav.children('li[data-tab="' + n + '"]').trigger("click");
                activateTab(n);
                scrollToDash();
            });

            // ===== Order detail: slide up / down (ek time pe ek open) =====
            $(".order-head").on("click", function () {
                var $card = $(this).closest(".order-card");
                $card.siblings(".order-card.open").removeClass("open").find(".order-detail").slideUp(300);
                $card.toggleClass("open").find(".order-detail").slideToggle(300);
            });

            // ===== Profile: view <-> edit =====
            $(".edit-toggle").on("click", function () {
                var $p = $(this).closest(".dash-panel");
                $(this).toggleClass("is-open");
                $p.find(".view-box").slideToggle(250);
                $p.find(".edit-box").slideToggle(250);
            });
            $(".edit-cancel").on("click", function () {
                $(this).closest(".dash-panel").find(".edit-toggle").trigger("click");
            });

            // ===== Profile / address (ajax) =====
            var URL = {
                profile: "{{ route('profile.update') }}",
                store: "{{ route('profile.address.store') }}",
                update: "{{ route('profile.address.update', ':id') }}",
                destroy: "{{ route('profile.address.destroy', ':id') }}",
                cities: "{{ route('state.cities', ':id') }}",
                wishlistRemove: "{{ route('profile.wishlist.remove', ':id') }}"
            };
            var CSRF = $('meta[name="csrf-token"]').attr('content');

                        // ===== Wishlist: remove (ajax) =====
            $(document).on("click", ".wish-remove", function () {
                var $card = $(this).closest(".wish-card");
                var id = $card.data("id");

                $.ajax({
                    url: URL.wishlistRemove.replace(':id', id), method: 'DELETE', dataType: 'json',
                    headers: { 'X-CSRF-TOKEN': CSRF }
                })
                    .done(function () {
                        $card.fadeOut(250, function () {
                            $card.remove();
                            var n = $(".wish-grid .wish-card").length;
                            $(".wish-count").text("(" + n + (n === 1 ? " item)" : " items)"));

                            var $cnt = $nav.children('li[data-tab="4"]').find(".count");
                            n ? $cnt.text(n).show() : $cnt.hide();

                            if (!n) {
                                $(".wish-grid").hide();
                                $(".wish-empty").show();
                            }
                        });
                    })
                    .fail(function (xhr) { toast('error', 'Wishlist', errText(xhr)); });
            });
            
            function errText(xhr) {
                var j = xhr.responseJSON || {};
                return (j.errors && Object.values(j.errors)[0][0]) || j.message || 'Something went wrong. Please try again.';
            }
            function toast(type, title, text) {
                var ui = window.cartUI || {};
                if (ui.notify) return ui.notify(type, title, text);
                if (type === 'error') alert(text || title);
            }
            function loadCities(stateId, selected) {
                var $c = $('#ad-city').html('<option value="" hidden></option>');
                if (!stateId) return $.Deferred().resolve();
                return $.getJSON(URL.cities.replace(':id', stateId)).done(function (list) {
                    var html = '<option value="" hidden></option>';
                    $.each(list, function (_, c) {
                        html += '<option value="' + c.id + '"' + (String(c.id) === String(selected) ? ' selected' : '') + '>' +
                            $('<i>').text(c.name).html() + '</option>';
                    });
                    $c.html(html);
                    if (selected) $c.val(String(selected));

                    // refresh the custom select UI, if the site uses one
                    if ($.fn.niceSelect) $c.niceSelect('update');
                    $c.trigger('change.select2');   // harmless if select2 isn't used
                });
            }
            $('#ad-state').on('change', function () { loadCities(this.value, null); });

            // set a value and refresh the custom select UI (nice-select / select2 / native)
            function setSelect($el, val) {
                $el.val(val == null ? '' : String(val));
                if ($.fn.niceSelect) $el.niceSelect('update');
                $el.trigger('change.select2');   // harmless if select2 isn't used
            }

            // profile save
            $('#profileForm').on('submit', function (e) {
                e.preventDefault();
                var $b = $(this).find('[type=submit]');
                if ($b.data('busy')) return;
                $b.data('busy', true);

                $.ajax({
                    url: URL.profile, method: 'POST', data: new FormData(this),
                    processData: false, contentType: false, dataType: 'json',
                    headers: { 'X-CSRF-TOKEN': CSRF }
                })
                    .done(function () { window.location.hash = '#tab-5'; window.location.reload(); })
                    .fail(function (xhr) { $b.data('busy', false); toast('error', 'Profile', errText(xhr)); });
            });

            $(document).on('click', '.addr-open', function () {
                var id = $(this).data('id');
                $('#addressForm')[0].reset();
                $('#ad-id').val(id || '');
                $('#adTitle').text(id ? 'Edit address' : 'Add new address');

                setSelect($('#ad-state'), '');                       // reset state UI
                $('#ad-city').html('<option value="" hidden></option>');
                if ($.fn.niceSelect) $('#ad-city').niceSelect('update');

                if (id) {
                    var d = $(this).closest('.addr-card').data('address');
                    $('#ad-name').val(d.name);
                    $('#ad-mobile').val(d.phone);
                    $('#ad-pin').val(d.pincode);
                    $('#ad-line').val(d.address_line_1);
                    $('#ad-line2').val(d.address_line_2);
                    setSelect($('#ad-state'), d.state_id);           // state shows as selected
                    $('input[name="address_type"][value="' + d.address_type + '"]').prop('checked', true);
                    $('#ad-default').prop('checked', !!d.is_default);
                    loadCities(d.state_id, d.city_id);               // city list + selected city
                }
                $('.addr-form').slideDown(250);
            });
            $('.addr-cancel').on('click', function () { $('.addr-form').slideUp(250); });

            // address save
            $('#addressForm').on('submit', function (e) {
                e.preventDefault();
                var $b = $(this).find('[type=submit]');
                if ($b.data('busy')) return;

                var id = $('#ad-id').val();
                var payload = {
                    name: $.trim($('#ad-name').val()),
                    phone: $.trim($('#ad-mobile').val()),
                    pincode: $.trim($('#ad-pin').val()),
                    state_id: $('#ad-state').val(),
                    city_id: $('#ad-city').val(),
                    address_line_1: $.trim($('#ad-line').val()),
                    address_line_2: $.trim($('#ad-line2').val()) || null,
                    address_type: $('input[name="address_type"]:checked').val() || 'home',
                    is_default: $('#ad-default').is(':checked')
                };

                $b.data('busy', true);
                $.ajax({
                    url: id ? URL.update.replace(':id', id) : URL.store,
                    method: id ? 'PUT' : 'POST', dataType: 'json',
                    contentType: 'application/json', data: JSON.stringify(payload),
                    headers: { 'X-CSRF-TOKEN': CSRF }
                })
                    .done(function () { window.location.hash = '#tab-5'; window.location.reload(); })
                    .fail(function (xhr) { $b.data('busy', false); toast('error', 'Address', errText(xhr)); });
            });

            // address remove
            $(document).on('click', '.addr-card .remove', function () {
                if (!confirm('Remove this address?')) return;
                $.ajax({
                    url: URL.destroy.replace(':id', $(this).data('id')), method: 'DELETE', dataType: 'json',
                    headers: { 'X-CSRF-TOKEN': CSRF }
                })
                    .done(function () { window.location.hash = '#tab-5'; window.location.reload(); })
                    .fail(function (xhr) { toast('error', 'Address', errText(xhr)); });
            });

        });
    </script>
@endpush