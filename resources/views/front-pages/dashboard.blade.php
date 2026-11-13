@extends('layouts.app')

@section('title', 'Dashboard | Parijaat Handicraft')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/sass/dashboard/dashboard.css') }}" />
@endpush

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
                    {{-- if there is img: <span class="avatar"><img src="user.jpg" alt="Aarav Mehta" /></span> --}}
                    <span class="avatar">A</span>
                    <div class="meta">
                        <h4>Aarav Mehta</h4>
                        <p>aarav@example.com</p>
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
                        <span class="count">3</span>
                    </li>
                    <li data-tab="4">
                        <i class="fa-regular fa-heart" aria-hidden="true"></i> My Wishlist
                        <span class="count">3</span>
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
                                <h2>Welcome back, Aarav!</h2>
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
                                <div><strong>12</strong><span>Total Orders</span></div>
                            </div>
                            <div class="stat-card">
                                <span class="stat-icon"><i class="fa-solid fa-truck-fast" aria-hidden="true"></i></span>
                                <div><strong>1</strong><span>Active Deliveries</span></div>
                            </div>
                            <div class="stat-card">
                                <span class="stat-icon"><i class="fa-solid fa-circle-check" aria-hidden="true"></i></span>
                                <div><strong>10</strong><span>Delivered</span></div>
                            </div>
                            <div class="stat-card">
                                <span class="stat-icon"><i class="fa-solid fa-rotate-left" aria-hidden="true"></i></span>
                                <div><strong>1</strong><span>Cancelled / Returned</span></div>
                            </div>
                        </div>

                        <div class="dash-panel">
                            <div class="panel-head">
                                <h3><i class="fa-solid fa-clock-rotate-left" aria-hidden="true"></i> Recent Orders</h3>
                                <a href="javascript:void(0);" class="panel-link go-tab" data-go="3">
                                    View all orders
                                    <i class="fa-solid fa-arrow-right-long" aria-hidden="true"></i>
                                </a>
                            </div>

                            <div class="recent-list">
                                <div class="recent-item">
                                    <span class="thumb"><img src="{{ asset('assets/images/home/cat4.png') }}" alt="" loading="lazy" /></span>
                                    <div class="info">
                                        <h4>Brass Lotus Kuber Diya + 2 more items</h4>
                                        <p>Order #PH-10482 · 24 Oct 2026</p>
                                    </div>
                                    <strong class="amount">$456</strong>
                                    <span class="status shipped">Out for Delivery</span>
                                    <a href="javascript:void(0);" class="btn btn-outline-primary btn-sm go-tab" data-go="2">Track</a>
                                </div>

                                <div class="recent-item">
                                    <span class="thumb"><img src="{{ asset('assets/images/home/cat1.png') }}" alt="" loading="lazy" /></span>
                                    <div class="info">
                                        <h4>Brass Elephant Figurine</h4>
                                        <p>Order #PH-10431 · 12 Oct 2026</p>
                                    </div>
                                    <strong class="amount">$299</strong>
                                    <span class="status delivered">Delivered</span>
                                    <a href="javascript:void(0);" class="btn btn-outline-primary btn-sm go-tab" data-go="3">View</a>
                                </div>

                                <div class="recent-item">
                                    <span class="thumb"><img src="{{ asset('assets/images/home/cat3.png') }}" alt="" loading="lazy" /></span>
                                    <div class="info">
                                        <h4>Copper Jug with Tumblers</h4>
                                        <p>Order #PH-10377 · 02 Oct 2026</p>
                                    </div>
                                    <strong class="amount">$349</strong>
                                    <span class="status cancelled">Cancelled</span>
                                    <a href="javascript:void(0);" class="btn btn-outline-primary btn-sm go-tab" data-go="3">View</a>
                                </div>
                            </div>

                            {{-- EMPTY STATE (backend: orders na ho to ye dikhao)
                            <div class="empty-state">
                                <i class="fa-solid fa-bag-shopping" aria-hidden="true"></i>
                                <h4>No orders yet</h4>
                                <p>When you place an order it will show up here.</p>
                                <a href="{{ route('products') }}" class="btn btn-primary">Start Shopping</a>
                            </div> --}}
                        </div>
                    </div>

                    <!-- ========== TAB 2: TRACK ORDER ========== -->
                    <div class="tabs" data-tab="2">
                        <div class="dash-panel">
                            <div class="panel-head">
                                <h3><i class="fa-solid fa-magnifying-glass-location" aria-hidden="true"></i> Track Your Order</h3>
                            </div>

                            <form class="form track-form" action="{{ url('/track-order') }}" method="get">
                                <div class="form-group">
                                    <input type="text" id="tr-id" name="order_id" placeholder=" " required />
                                    <label for="tr-id">Order ID (e.g. PH-10482)</label>
                                    <span class="error"></span>
                                </div>
                                <div class="form-group">
                                    <input type="tel" id="tr-phone" name="phone" placeholder=" " required />
                                    <label for="tr-phone">Mobile number</label>
                                    <span class="error"></span>
                                </div>
                                <button type="submit" class="btn btn-primary">Track Order</button>
                            </form>
                        </div>

                        <div class="dash-panel shipment">
                            <div class="ship-top">
                                <div>
                                    <h4>Order #PH-10482</h4>
                                    <p>Placed on 24 Oct 2026 · 3 items · $456</p>
                                </div>
                                <span class="status shipped">Out for Delivery</span>
                            </div>

                            <div class="ship-meta">
                                <div><small>Expected Delivery</small><strong>Today, by 8:00 PM</strong></div>
                                <div><small>Courier Partner</small><strong>Delhivery Express</strong></div>
                                <div><small>Tracking ID (AWB)</small><strong>DLV784522109</strong></div>
                                <div><small>Payment</small><strong>Paid Online (UPI)</strong></div>
                            </div>

                            <ul class="track-steps">
                                <li class="done">
                                    <span class="dot"><i class="fa-solid fa-receipt" aria-hidden="true"></i></span>
                                    <h5>Order Placed</h5>
                                    <span class="time">24 Oct, 10:42 AM</span>
                                </li>
                                <li class="done">
                                    <span class="dot"><i class="fa-solid fa-circle-check" aria-hidden="true"></i></span>
                                    <h5>Confirmed</h5>
                                    <span class="time">24 Oct, 11:05 AM</span>
                                </li>
                                <li class="done">
                                    <span class="dot"><i class="fa-solid fa-box" aria-hidden="true"></i></span>
                                    <h5>Packed</h5>
                                    <span class="time">24 Oct, 05:30 PM</span>
                                </li>
                                <li class="done">
                                    <span class="dot"><i class="fa-solid fa-truck-fast" aria-hidden="true"></i></span>
                                    <h5>Dispatched</h5>
                                    <span class="time">26 Oct, 09:15 AM</span>
                                </li>
                                <li class="current">
                                    <span class="dot"><i class="fa-solid fa-motorcycle" aria-hidden="true"></i></span>
                                    <h5>Out for Delivery</h5>
                                    <span class="time">29 Oct, 08:40 AM</span>
                                </li>
                                <li>
                                    <span class="dot"><i class="fa-solid fa-house" aria-hidden="true"></i></span>
                                    <h5>Delivered</h5>
                                    <span class="time">Expected today</span>
                                </li>
                            </ul>

                            <div class="ship-log">
                                <h5 class="od-title">Delivery Updates</h5>
                                <ul class="timeline">
                                    <li class="current">
                                        <span class="dot"></span>
                                        <h5>Out for delivery</h5>
                                        <p>Delivery partner is on the way to your address. Please keep your phone reachable.</p>
                                        <span class="time">29 Oct 2026, 08:40 AM · Delhi Hub</span>
                                    </li>
                                    <li class="done">
                                        <span class="dot"><i class="fa-solid fa-check" aria-hidden="true"></i></span>
                                        <h5>Arrived at local delivery hub</h5>
                                        <p>Your package reached the delivery hub nearest to you.</p>
                                        <span class="time">29 Oct 2026, 05:10 AM · Delhi Hub</span>
                                    </li>
                                    <li class="done">
                                        <span class="dot"><i class="fa-solid fa-check" aria-hidden="true"></i></span>
                                        <h5>Shipment in transit</h5>
                                        <p>Your package left the sorting centre.</p>
                                        <span class="time">28 Oct 2026, 07:25 PM · Gurugram Sorting Centre</span>
                                    </li>
                                    <li class="done">
                                        <span class="dot"><i class="fa-solid fa-check" aria-hidden="true"></i></span>
                                        <h5>Dispatched from warehouse</h5>
                                        <p>Handed over to Delhivery Express.</p>
                                        <span class="time">26 Oct 2026, 09:15 AM · Parijaat Warehouse</span>
                                    </li>
                                    <li class="done">
                                        <span class="dot"><i class="fa-solid fa-check" aria-hidden="true"></i></span>
                                        <h5>Packed &amp; quality checked</h5>
                                        <p>Brass and copper pieces checked, wrapped and packed with protective cushioning.</p>
                                        <span class="time">24 Oct 2026, 05:30 PM</span>
                                    </li>
                                    <li class="done">
                                        <span class="dot"><i class="fa-solid fa-check" aria-hidden="true"></i></span>
                                        <h5>Order placed &amp; confirmed</h5>
                                        <p>We have received your order.</p>
                                        <span class="time">24 Oct 2026, 10:42 AM</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- ========== TAB 3: MY ORDERS ========== -->
                    <div class="tabs" data-tab="3">
                        <div class="dash-panel">
                            <div class="panel-head">
                                <h3><i class="fa-solid fa-box-open" aria-hidden="true"></i> My Orders</h3>
                            </div>

                            <form class="form orders-bar" action="{{ url('/my-orders') }}" method="get">
                                <div class="form-group has-icon search-icon">
                                    <input type="text" id="od-search" name="q" placeholder=" " />
                                    <label for="od-search">Search by order ID or product</label>
                                </div>
                            </form>

                            <!-- ORDER 1: ACTIVE -->
                            <div class="order-card">
                                <div class="order-head">
                                    <div class="oh-id"><strong>#PH-10482</strong><span>Placed on 24 Oct 2026</span></div>
                                    <div class="oh-total"><small>Total</small><b>$456</b></div>
                                    <div class="oh-status"><span class="status shipped">Out for Delivery</span></div>
                                    <button type="button" class="order-toggle" aria-label="Show order details">
                                        <i class="fa-solid fa-chevron-down" aria-hidden="true"></i>
                                    </button>
                                </div>

                                <div class="order-detail">
                                    <div class="od-grid">
                                        <div>
                                            <h5 class="od-title">Items in this order</h5>
                                            <div class="od-items">
                                                <div class="od-item">
                                                    <span class="thumb"><img src="{{ asset('assets/images/home/cat4.png') }}" alt="" loading="lazy" /></span>
                                                    <div class="od-name">
                                                        <h4>Brass Lotus Kuber Diya</h4>
                                                        <p>Finish: Lacquered · Qty 1</p>
                                                    </div>
                                                    <strong>$179</strong>
                                                </div>
                                                <div class="od-item">
                                                    <span class="thumb"><img src="{{ asset('assets/images/home/cat3.png') }}" alt="" loading="lazy" /></span>
                                                    <div class="od-name">
                                                        <h4>Hammered Copper Goblet</h4>
                                                        <p>Finish: Hammered · Qty 1</p>
                                                    </div>
                                                    <strong>$99</strong>
                                                </div>
                                                <div class="od-item">
                                                    <span class="thumb"><img src="{{ asset('assets/images/home/cat6.png') }}" alt="" loading="lazy" /></span>
                                                    <div class="od-name">
                                                        <h4>Brass Wind Chime</h4>
                                                        <p>Finish: Raw Brass · Qty 1</p>
                                                    </div>
                                                    <strong>$229</strong>
                                                </div>
                                            </div>

                                            <h5 class="od-title">Price details</h5>
                                            <div class="od-summary">
                                                <p><span>Subtotal</span><span>$507</span></p>
                                                <p><span>Coupon (PARIJAAT10)</span><span class="green">− $51</span></p>
                                                <p><span>Shipping</span><span class="green">Free</span></p>
                                                <p class="total"><span>Total paid</span><span>$456</span></p>
                                            </div>
                                        </div>

                                        <div>
                                            <h5 class="od-title">Order progress</h5>
                                            <ul class="timeline">
                                                <li class="done">
                                                    <span class="dot"><i class="fa-solid fa-check" aria-hidden="true"></i></span>
                                                    <h5>Order Placed</h5>
                                                    <p>We have received your order.</p>
                                                    <span class="time">24 Oct, 10:42 AM</span>
                                                </li>
                                                <li class="done">
                                                    <span class="dot"><i class="fa-solid fa-check" aria-hidden="true"></i></span>
                                                    <h5>Order Confirmed</h5>
                                                    <p>Our team confirmed your order.</p>
                                                    <span class="time">24 Oct, 11:05 AM</span>
                                                </li>
                                                <li class="done">
                                                    <span class="dot"><i class="fa-solid fa-check" aria-hidden="true"></i></span>
                                                    <h5>Packed</h5>
                                                    <p>Quality checked and packed securely.</p>
                                                    <span class="time">24 Oct, 05:30 PM</span>
                                                </li>
                                                <li class="done">
                                                    <span class="dot"><i class="fa-solid fa-check" aria-hidden="true"></i></span>
                                                    <h5>Dispatched</h5>
                                                    <p>Shipped with Delhivery Express.</p>
                                                    <span class="time">26 Oct, 09:15 AM</span>
                                                </li>
                                                <li class="current">
                                                    <span class="dot"></span>
                                                    <h5>Out for Delivery</h5>
                                                    <p>Delivery partner is on the way.</p>
                                                    <span class="time">29 Oct, 08:40 AM</span>
                                                </li>
                                                <li>
                                                    <span class="dot"></span>
                                                    <h5>Delivered</h5>
                                                    <p>Expected today, by 8:00 PM.</p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="od-info">
                                        <div class="od-box">
                                            <h5 class="od-title">Delivery address</h5>
                                            <p><b>Aarav Mehta</b><br />12, Park Street, Connaught Place<br />New Delhi, Delhi - 110001<br />Mobile: +91 98765 43210</p>
                                        </div>
                                        <div class="od-box">
                                            <h5 class="od-title">Payment</h5>
                                            <p><b>Paid Online (UPI)</b><br />Transaction ID: TXN84520011<br />Amount: $456</p>
                                        </div>
                                        <div class="od-box">
                                            <h5 class="od-title">Shipment</h5>
                                            <p><b>Delhivery Express</b><br />AWB: DLV784522109<br />Expected: 29 Oct 2026</p>
                                        </div>
                                    </div>

                                    <div class="od-actions">
                                        <a href="javascript:void(0);" class="btn btn-primary btn-sm go-tab" data-go="2">
                                            <i class="fa-solid fa-truck-fast" aria-hidden="true"></i> Track Order
                                        </a>
                                        <a href="javascript:void(0);" class="btn btn-outline-primary btn-sm">
                                            <i class="fa-solid fa-file-invoice" aria-hidden="true"></i> Download Invoice
                                        </a>
                                        <a href="{{ route('contact') }}" class="btn btn-outline-primary btn-sm">
                                            <i class="fa-solid fa-headset" aria-hidden="true"></i> Need Help?
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- ORDER 2: DELIVERED -->
                            <div class="order-card">
                                <div class="order-head">
                                    <div class="oh-id"><strong>#PH-10431</strong><span>Placed on 12 Oct 2026</span></div>
                                    <div class="oh-total"><small>Total</small><b>$299</b></div>
                                    <div class="oh-status"><span class="status delivered">Delivered</span></div>
                                    <button type="button" class="order-toggle" aria-label="Show order details">
                                        <i class="fa-solid fa-chevron-down" aria-hidden="true"></i>
                                    </button>
                                </div>

                                <div class="order-detail">
                                    <div class="od-grid">
                                        <div>
                                            <h5 class="od-title">Items in this order</h5>
                                            <div class="od-items">
                                                <div class="od-item">
                                                    <span class="thumb"><img src="{{ asset('assets/images/home/cat1.png') }}" alt="" loading="lazy" /></span>
                                                    <div class="od-name">
                                                        <h4>Brass Elephant Figurine</h4>
                                                        <p>Finish: Antique · Qty 1</p>
                                                    </div>
                                                    <strong>$299</strong>
                                                </div>
                                            </div>

                                            <h5 class="od-title">Price details</h5>
                                            <div class="od-summary">
                                                <p><span>Subtotal</span><span>$299</span></p>
                                                <p><span>Shipping</span><span class="green">Free</span></p>
                                                <p class="total"><span>Total paid</span><span>$299</span></p>
                                            </div>
                                        </div>

                                        <div>
                                            <h5 class="od-title">Order progress</h5>
                                            <ul class="timeline">
                                                <li class="done">
                                                    <span class="dot"><i class="fa-solid fa-check" aria-hidden="true"></i></span>
                                                    <h5>Order Placed</h5>
                                                    <span class="time">12 Oct, 01:12 PM</span>
                                                </li>
                                                <li class="done">
                                                    <span class="dot"><i class="fa-solid fa-check" aria-hidden="true"></i></span>
                                                    <h5>Packed</h5>
                                                    <span class="time">12 Oct, 06:40 PM</span>
                                                </li>
                                                <li class="done">
                                                    <span class="dot"><i class="fa-solid fa-check" aria-hidden="true"></i></span>
                                                    <h5>Dispatched</h5>
                                                    <p>Shipped with Delhivery Express.</p>
                                                    <span class="time">13 Oct, 10:05 AM</span>
                                                </li>
                                                <li class="done">
                                                    <span class="dot"><i class="fa-solid fa-check" aria-hidden="true"></i></span>
                                                    <h5>Delivered</h5>
                                                    <p>Package handed over to you.</p>
                                                    <span class="time">17 Oct, 04:20 PM</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="od-info">
                                        <div class="od-box">
                                            <h5 class="od-title">Delivery address</h5>
                                            <p><b>Aarav Mehta</b><br />12, Park Street, Connaught Place<br />New Delhi, Delhi - 110001</p>
                                        </div>
                                        <div class="od-box">
                                            <h5 class="od-title">Payment</h5>
                                            <p><b>Paid Online (Card)</b><br />Transaction ID: TXN84201377<br />Amount: $299</p>
                                        </div>
                                        <div class="od-box">
                                            <h5 class="od-title">Shipment</h5>
                                            <p><b>Delhivery Express</b><br />AWB: DLV771340982<br />Delivered: 17 Oct 2026</p>
                                        </div>
                                    </div>

                                    <div class="od-actions">
                                        <a href="javascript:void(0);" class="btn btn-primary btn-sm">
                                            <i class="fa-solid fa-star" aria-hidden="true"></i> Write a Review
                                        </a>
                                        <a href="javascript:void(0);" class="btn btn-outline-primary btn-sm">
                                            <i class="fa-solid fa-rotate-right" aria-hidden="true"></i> Buy Again
                                        </a>
                                        <a href="javascript:void(0);" class="btn btn-outline-primary btn-sm">
                                            <i class="fa-solid fa-file-invoice" aria-hidden="true"></i> Download Invoice
                                        </a>
                                        <a href="{{ url('/returns-exchange') }}" class="btn btn-outline-primary btn-sm">
                                            <i class="fa-solid fa-rotate-left" aria-hidden="true"></i> Return / Exchange
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- ORDER 3: CANCELLED -->
                            <div class="order-card">
                                <div class="order-head">
                                    <div class="oh-id"><strong>#PH-10377</strong><span>Placed on 02 Oct 2026</span></div>
                                    <div class="oh-total"><small>Total</small><b>$349</b></div>
                                    <div class="oh-status"><span class="status cancelled">Cancelled</span></div>
                                    <button type="button" class="order-toggle" aria-label="Show order details">
                                        <i class="fa-solid fa-chevron-down" aria-hidden="true"></i>
                                    </button>
                                </div>

                                <div class="order-detail">
                                    <div class="od-grid">
                                        <div>
                                            <h5 class="od-title">Items in this order</h5>
                                            <div class="od-items">
                                                <div class="od-item">
                                                    <span class="thumb"><img src="{{ asset('assets/images/home/cat3.png') }}" alt="" loading="lazy" /></span>
                                                    <div class="od-name">
                                                        <h4>Copper Jug with Tumblers</h4>
                                                        <p>Finish: Hammered · Qty 1</p>
                                                    </div>
                                                    <strong>$349</strong>
                                                </div>
                                            </div>

                                            <h5 class="od-title">Refund details</h5>
                                            <div class="od-summary">
                                                <p><span>Refund amount</span><span>$349</span></p>
                                                <p><span>Refund to</span><span>Original payment method</span></p>
                                                <p class="total"><span>Status</span><span class="green">Refund initiated</span></p>
                                            </div>
                                        </div>

                                        <div>
                                            <h5 class="od-title">Order progress</h5>
                                            <ul class="timeline">
                                                <li class="done">
                                                    <span class="dot"><i class="fa-solid fa-check" aria-hidden="true"></i></span>
                                                    <h5>Order Placed</h5>
                                                    <span class="time">02 Oct, 03:18 PM</span>
                                                </li>
                                                <li class="cancel">
                                                    <span class="dot"><i class="fa-solid fa-xmark" aria-hidden="true"></i></span>
                                                    <h5>Order Cancelled</h5>
                                                    <p>Cancelled by you before dispatch.</p>
                                                    <span class="time">02 Oct, 05:02 PM</span>
                                                </li>
                                                <li class="done">
                                                    <span class="dot"><i class="fa-solid fa-check" aria-hidden="true"></i></span>
                                                    <h5>Refund Initiated</h5>
                                                    <p>Amount will reflect in 5-7 working days.</p>
                                                    <span class="time">03 Oct, 10:30 AM</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="od-actions">
                                        <a href="javascript:void(0);" class="btn btn-primary btn-sm">
                                            <i class="fa-solid fa-rotate-right" aria-hidden="true"></i> Buy Again
                                        </a>
                                        <a href="{{ route('contact') }}" class="btn btn-outline-primary btn-sm">
                                            <i class="fa-solid fa-headset" aria-hidden="true"></i> Need Help?
                                        </a>
                                    </div>
                                </div>
                            </div>

                            {{-- EMPTY STATE: <div class="empty-state"> ...dashboard tab wala markup... </div> --}}
                        </div>
                    </div>

                    <!-- ========== TAB 4: WISHLIST ========== -->
                    <div class="tabs" data-tab="4">
                        <div class="dash-panel">
                            <div class="panel-head">
                                <h3>
                                    <i class="fa-regular fa-heart" aria-hidden="true"></i> My Wishlist
                                    <span class="muted wish-count">(3 items)</span>
                                </h3>
                            </div>

                            <div class="wish-grid">
                                <article class="wish-card">
                                    <button type="button" class="wish-remove" aria-label="Remove from wishlist">
                                        <i class="fa-solid fa-xmark" aria-hidden="true"></i>
                                    </button>
                                    <a href="{{ url('/product-detail') }}" class="wish-image">
                                        <img src="{{ asset('assets/images/home/cat4.png') }}" alt="Brass Peacock Diya" loading="lazy" />
                                        <span class="badge">-17%</span>
                                    </a>
                                    <div class="wish-info">
                                        <span class="cat">Brass Diyas &amp; Lamps</span>
                                        <h4><a href="{{ url('/product-detail') }}">Brass Peacock Diya</a></h4>
                                        <div class="wish-price">
                                            <strong>$299</strong><del>$359</del><span class="save">Save $60</span>
                                        </div>
                                        <span class="stock in"><i class="fa-solid fa-circle-check" aria-hidden="true"></i> In Stock</span>
                                        <div class="wish-cta">
                                            <button type="button" class="btn btn-primary btn-sm" data-id="SKU-P7"
                                                data-name="Brass Peacock Diya" data-toast-title="Added to Bag"
                                                data-toast-text="Brass Peacock Diya has been added to your bag."
                                                data-toast-type="success">
                                                <i class="fa-solid fa-bag-shopping" aria-hidden="true"></i> Add to Bag
                                            </button>
                                            <a href="{{ url('/product-detail') }}" class="btn btn-outline-primary btn-sm">View</a>
                                        </div>
                                    </div>
                                </article>

                                <article class="wish-card">
                                    <button type="button" class="wish-remove" aria-label="Remove from wishlist">
                                        <i class="fa-solid fa-xmark" aria-hidden="true"></i>
                                    </button>
                                    <a href="{{ url('/product-detail') }}" class="wish-image">
                                        <img src="{{ asset('assets/images/home/cat3.png') }}" alt="Copper Goblet Gift Set" loading="lazy" />
                                        <span class="badge">-15%</span>
                                    </a>
                                    <div class="wish-info">
                                        <span class="cat">Copper Drinkware</span>
                                        <h4><a href="{{ url('/product-detail') }}">Copper Goblet Gift Set</a></h4>
                                        <div class="wish-price">
                                            <strong>$199</strong><del>$235</del><span class="save">Save $36</span>
                                        </div>
                                        <span class="stock in"><i class="fa-solid fa-circle-check" aria-hidden="true"></i> In Stock</span>
                                        <div class="wish-cta">
                                            <button type="button" class="btn btn-primary btn-sm" data-id="SKU-P16"
                                                data-name="Copper Goblet Gift Set" data-toast-title="Added to Bag"
                                                data-toast-text="Copper Goblet Gift Set has been added to your bag."
                                                data-toast-type="success">
                                                <i class="fa-solid fa-bag-shopping" aria-hidden="true"></i> Add to Bag
                                            </button>
                                            <a href="{{ url('/product-detail') }}" class="btn btn-outline-primary btn-sm">View</a>
                                        </div>
                                    </div>
                                </article>

                                <article class="wish-card out">
                                    <button type="button" class="wish-remove" aria-label="Remove from wishlist">
                                        <i class="fa-solid fa-xmark" aria-hidden="true"></i>
                                    </button>
                                    <a href="{{ url('/product-detail') }}" class="wish-image">
                                        <img src="{{ asset('assets/images/home/cat6.png') }}" alt="Brass Temple Bell" loading="lazy" />
                                    </a>
                                    <div class="wish-info">
                                        <span class="cat">Bells &amp; Wind Chimes</span>
                                        <h4><a href="{{ url('/product-detail') }}">Brass Temple Bell</a></h4>
                                        <div class="wish-price">
                                            <strong>$159</strong><del>$199</del><span class="save">Save $40</span>
                                        </div>
                                        <span class="stock"><i class="fa-solid fa-circle-xmark" aria-hidden="true"></i> Out of Stock</span>
                                        <div class="wish-cta">
                                            <button type="button" class="btn btn-primary btn-sm" disabled>
                                                <i class="fa-regular fa-bell" aria-hidden="true"></i> Notify Me
                                            </button>
                                            <a href="{{ url('/product-detail') }}" class="btn btn-outline-primary btn-sm">View</a>
                                        </div>
                                    </div>
                                </article>
                            </div>

                            <!-- Empty state (JS se tab dikhta hai jab saare items remove ho jayein) -->
                            <div class="empty-state wish-empty">
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
                                    <span class="t-close"><i class="fa-solid fa-xmark" aria-hidden="true"></i> Close</span>
                                </button>
                            </div>

                            <!-- view mode -->
                            <div class="view-box">
                                <div class="profile-head">
                                    <span class="avatar lg">A</span>
                                    <div>
                                        <h4>Aarav Mehta</h4>
                                        <p>Member since Jan 2026</p>
                                    </div>
                                </div>
                                <div class="detail-list">
                                    <div><small>Full Name</small><p>Aarav Mehta</p></div>
                                    <div><small>Email</small><p>aarav@example.com</p></div>
                                    <div><small>Mobile</small><p>+91 98765 43210</p></div>
                                    <div><small>Date of Birth</small><p>12 Aug 1996</p></div>
                                </div>
                            </div>

                            <!-- edit mode -->
                            <div class="edit-box">
                                <form class="form profile-form" action="{{ url('/profile/update') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="avatar-upload">
                                        <span class="avatar lg">A</span>
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
                                            <input type="text" id="pf-name" name="name" value="Aarav Mehta" placeholder=" " required />
                                            <label for="pf-name">Full Name</label>
                                            <span class="error"></span>
                                        </div>
                                        <div class="form-group">
                                            <input type="email" id="pf-email" name="email" value="aarav@example.com" placeholder=" " readonly />
                                            <label for="pf-email">Email</label>
                                            <span class="error"></span>
                                        </div>
                                        <div class="form-group">
                                            <input type="tel" id="pf-mobile" name="mobile" value="+91 98765 43210" placeholder=" " required />
                                            <label for="pf-mobile">Mobile Number</label>
                                            <span class="error"></span>
                                        </div>
                                        <div class="form-group has-icon calender-icon">
                                            <input type="text" id="pf-dob" name="dob" value="12 Aug 1996" placeholder=" " />
                                            <label for="pf-dob">Date of Birth</label>
                                            <span class="error"></span>
                                        </div>
                                    </div>

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                        <button type="button" class="btn btn-outline-primary edit-cancel">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Saved addresses -->
                        <div class="dash-panel">
                            <div class="panel-head">
                                <h3><i class="fa-solid fa-location-dot" aria-hidden="true"></i> Saved Addresses</h3>
                                <button type="button" class="btn btn-outline-primary btn-sm addr-open">
                                    <i class="fa-solid fa-plus" aria-hidden="true"></i> Add New
                                </button>
                            </div>

                            <div class="addr-list">
                                <div class="addr-card">
                                    <span class="addr-type default">Home · Default</span>
                                    <h5>Aarav Mehta</h5>
                                    <p>12, Park Street, Near Metro Gate 3, Connaught Place<br />New Delhi, Delhi - 110001<br />Mobile: +91 98765 43210</p>
                                    <div class="addr-actions">
                                        <a href="javascript:void(0);" class="addr-open"><i class="fa-solid fa-pen" aria-hidden="true"></i> Edit</a>
                                        <a href="javascript:void(0);" class="remove"><i class="fa-regular fa-trash-can" aria-hidden="true"></i> Remove</a>
                                    </div>
                                </div>

                                <div class="addr-card">
                                    <span class="addr-type">Work</span>
                                    <h5>Aarav Mehta</h5>
                                    <p>4th Floor, Tech Park, MG Road, Opp. City Mall<br />Bengaluru, Karnataka - 560001<br />Mobile: +91 98765 43210</p>
                                    <div class="addr-actions">
                                        <a href="javascript:void(0);" class="addr-open"><i class="fa-solid fa-pen" aria-hidden="true"></i> Edit</a>
                                        <a href="javascript:void(0);" class="remove"><i class="fa-regular fa-trash-can" aria-hidden="true"></i> Remove</a>
                                    </div>
                                </div>
                            </div>

                            <!-- add / edit address form -->
                            <div class="addr-form">
                                <h5 class="od-title">Address details</h5>
                                <form class="form address-form" action="{{ url('/profile/address') }}" method="post">
                                    @csrf
                                    <div class="form-grid">
                                        <div class="form-group">
                                            <input type="text" id="ad-name" name="name" placeholder=" " required />
                                            <label for="ad-name">Full Name</label>
                                            <span class="error"></span>
                                        </div>
                                        <div class="form-group">
                                            <input type="tel" id="ad-mobile" name="mobile" placeholder=" " required />
                                            <label for="ad-mobile">Mobile Number</label>
                                            <span class="error"></span>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" id="ad-pin" name="pincode" placeholder=" " required />
                                            <label for="ad-pin">Pincode</label>
                                            <span class="error"></span>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" id="ad-city" name="city" placeholder=" " required />
                                            <label for="ad-city">City</label>
                                            <span class="error"></span>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" id="ad-state" name="state" placeholder=" " required />
                                            <label for="ad-state">State</label>
                                            <span class="error"></span>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" id="ad-landmark" name="landmark" placeholder=" " />
                                            <label for="ad-landmark">Landmark (optional)</label>
                                            <span class="error"></span>
                                        </div>
                                        <div class="form-group full">
                                            <input type="text" id="ad-line" name="address" placeholder=" " required />
                                            <label for="ad-line">House no., building, street, area</label>
                                            <span class="error"></span>
                                        </div>
                                    </div>

                                    <div class="addr-extra">
                                        <div class="type-pills">
                                            <label class="pill"><input type="radio" name="type" value="home" checked /> <span>Home</span></label>
                                            <label class="pill"><input type="radio" name="type" value="work" /> <span>Work</span></label>
                                            <label class="pill"><input type="radio" name="type" value="other" /> <span>Other</span></label>
                                        </div>
                                        <label class="check"><input type="checkbox" name="is_default" /> <span>Make this my default address</span></label>
                                    </div>

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary">Save Address</button>
                                        <button type="button" class="btn btn-outline-primary addr-cancel">Cancel</button>
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
            try { history.replaceState(null, "", "#tab-" + $(this).data("tab")); } catch (e) {}
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

        // ===== Orders search =====
        $(".orders-bar").on("submit", function (e) { e.preventDefault(); });
        $("#od-search").on("input", function () {
            var q = $.trim($(this).val()).toLowerCase();
            $dash.find(".order-card").each(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(q) > -1);
            });
        });

        // ===== Wishlist: remove =====
        $(".wish-remove").on("click", function () {
            var $card = $(this).closest(".wish-card");
            $card.fadeOut(250, function () {
                $card.remove();
                var n = $(".wish-grid .wish-card").length;
                $(".wish-count").text("(" + n + " items)");
                $nav.children('li[data-tab="4"]').find(".count").text(n);
                if (!n) {
                    $(".wish-grid").hide();
                    $(".wish-empty").show();
                }
            });
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

        // ===== Address form open / close =====
        $(".addr-open").on("click", function () { $(".addr-form").slideDown(250); });
        $(".addr-cancel").on("click", function () { $(".addr-form").slideUp(250); });
    });
</script>
@endpush