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

        <button type="button" class="wish-btn" aria-label="Add to wishlist" data-id="{{ $id }}">
            <i class="fa-regular fa-heart"></i>
        </button>
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