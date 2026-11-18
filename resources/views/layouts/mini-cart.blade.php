@php
    $items = $miniCart?->items ?? collect();
    $count = (int) $items->sum('quantity');
    $subtotal = (float) $items->sum('total');
    $freeFrom = (float) (\App\Models\ShippingSetting::first()?->free_delivery_threshold ?? 0);
@endphp

<div class="cp-head">
    <h3>My Cart <span>{{ $count }} {{ \Illuminate\Support\Str::plural('item', $count) }}</span></h3>
</div>

@if ($items->isEmpty())
    <div class="cp-empty">
        <span class="cp-empty-icon"><i class="fa-solid fa-bag-shopping" aria-hidden="true"></i></span>
        <h4>Your cart is empty</h4>
        <p>Add something you love and it will show up here.</p>
        <a href="{{ route('products') }}" class="btn btn-primary">Shop Now</a>
    </div>
@else
    <ul class="cp-list">
        @foreach ($items as $item)
            @php
                $p = $item->product;
            @endphp
            @continue(!$p)
            @php
                $addonUnit = (float) $item->addons->sum('price');
                $unit = (float) $item->price + $addonUnit;
                $mrpUnit = (float) ($item->priceVariant?->mrp ?: $p->mrp) + $addonUnit;
                $off = $mrpUnit > $unit ? (int) round((($mrpUnit - $unit) / $mrpUnit) * 100) : 0;

                $variant = collect($item->selected_attributes ?? [])->pluck('value')->filter()->implode(' · ');
                $addonNames = $item->addons->pluck('detail')->filter()->implode(', ');
                $img = $item->imageVariant?->image ? asset('storage/' . $item->imageVariant->image) : $p->display_image;
                $url = url('product/' . $p->slug);
                $cat = $p->subcategory?->name ?: $p->category?->name;
            @endphp

            <li class="cp-item" data-id="{{ $item->id }}">
                <a class="cp-img" href="{{ $url }}">
                    <img src="{{ $img }}" alt="{{ $p->name }}" width="96" height="128" loading="lazy" />
                </a>
                <div class="cp-info">
                    @if ($cat)
                        <span class="cp-cat">{{ $cat }}</span>
                    @endif
                    <h4 class="cp-name"><a href="{{ $url }}">{{ $p->name }}</a></h4>

                    @if ($variant !== '' || $addonNames !== '')
                        <span class="cp-variant">
                            {{ $variant }}{{ $variant !== '' && $addonNames !== '' ? ' · ' : '' }}{{ $addonNames !== '' ? '+ ' . $addonNames : '' }}
                        </span>
                    @endif

                    <div class="cp-price">
                        <strong>@money($item->total)</strong>
                        @if ($off > 0)
                            <del>@money($mrpUnit * $item->quantity)</del>
                            <span class="cp-off">{{ $off }}% off</span>
                        @endif
                    </div>

                    <div class="cp-actions">
                        <div class="qty" role="group" aria-label="Quantity for {{ $p->name }}">
                            <button type="button" class="qty-minus" aria-label="Decrease quantity">
                                <i class="fa-solid fa-minus" aria-hidden="true"></i>
                            </button>
                            <input type="text" inputmode="numeric" value="{{ $item->quantity }}" aria-label="Quantity" readonly />
                            <button type="button" class="qty-plus" aria-label="Increase quantity">
                                <i class="fa-solid fa-plus" aria-hidden="true"></i>
                            </button>
                        </div>
                        <button type="button" class="cp-remove">
                            <i class="fa-regular fa-trash-can" aria-hidden="true"></i>
                            Remove
                        </button>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>

    <div class="cp-foot">
        <div class="cp-total">
            <span>Subtotal</span>
            <strong>@money($subtotal)</strong>
        </div>
        <p class="cp-note">
            <i class="fa-solid fa-truck-fast" aria-hidden="true"></i>
            @if ($freeFrom > 0)
                @if ($subtotal >= $freeFrom)
                    You have unlocked FREE shipping.
                @else
                    Add @money($freeFrom - $subtotal) more for FREE shipping.
                @endif
            @endif
            Taxes, coupons and shipping charges are shown at checkout.
        </p>
        <div class="cp-btns">
            <a href="{{ route('cart') }}" class="btn btn-outline-primary">View Cart</a>
            <a href="{{ route('checkout') }}" class="btn btn-primary">Checkout</a>
        </div>
    </div>
@endif