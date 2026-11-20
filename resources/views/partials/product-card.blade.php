{{-- resources/views/partials/product-card.blade.php --}}
{{-- Usage: @include('partials.product-card', ['p' => $product->toCard()]) --}}
@php
    $url = $p['url'] ?? null;
    $href = $url ?: 'javascript:void(0)';

    $img = $p['img'] ?? null;
    if ($img && !\Illuminate\Support\Str::startsWith($img, ['http://', 'https://', '//'])) {
        $img = asset($img);
    }

    $id = $p['id'] ?? ($p['sku'] ?? null);
    $name = $p['name'] ?? '';
    $off = (int) ($p['off'] ?? 0);

    // wishlist: hidden when the admin switch is off; heart filled when already saved
    $wishOn = (bool) ($general->wishlist ?? true);
    $wished = $wishOn && in_array($id, \App\Models\Wishlist::currentProductIds());
@endphp
<article class="prod_cart">
    <div class="prod-img">
        <a href="{{ $href }}" class="prod-link">
            @if ($img)
                <img src="{{ $img }}" alt="{{ $name }}" loading="lazy" />
            @endif
        </a>

        @if (!empty($p['badge']))
            <span class="prod-badge">{{ $p['badge'] }}</span>
        @endif

        @if ($wishOn)
            <button type="button" @class(['wish-btn', 'is-wished' => $wished])
                aria-label="{{ $wished ? 'Remove from wishlist' : 'Add to wishlist' }}"
                aria-pressed="{{ $wished ? 'true' : 'false' }}" data-id="{{ $id }}">
                <i class="{{ $wished ? 'fa-solid' : 'fa-regular' }} fa-heart"></i>
            </button>
        @endif
    </div>

    <div class="prod-info">
        @if (!empty($p['brand']))
            <h4 class="prod-brand">{{ $p['brand'] }}</h4>
        @endif

        <p class="prod-name">
            <a href="{{ $href }}">{{ $name }}</a>
        </p>

        <div class="prod-price">
            <span class="price-now">{{ $p['now'] ?? '' }}</span>
            @if (!empty($p['old']))
                <span class="price-old">{{ $p['old'] }}</span>
                @if ($off > 0)
                    <span class="price-off">({{ $off }}% OFF)</span>
                @endif
            @endif
        </div>

        <div class="prod-btns">
            <button type="button" class="btn btn-outline-black js-add-cart" data-id="{{ $id }}" data-name="{{ $name }}"
                data-toast-title="Added to Cart" data-toast-text="{{ $name }} has been added to your cart."
                data-toast-type="success">
                Add to Cart
            </button>
            <a href="{{ $href }}" class="btn btn-primary">Buy Now</a>
        </div>
    </div>
</article>