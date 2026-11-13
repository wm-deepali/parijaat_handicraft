{{-- resources/views/partials/product-card.blade.php --}}
{{-- Usage: @include('partials.product-card', ['p' => $product]) --}}
<article class="prod_cart">
    <div class="prod-img">
        <a href="product-detail.html" class="prod-link">
            <img src="{{ asset($p['img']) }}" alt="{{ $p['name'] }}" loading="lazy" />
        </a>
        @if (!empty($p['badge']))
            <span class="prod-badge">{{ $p['badge'] }}</span>
        @endif
        <button type="button" class="wish-btn" aria-label="Add to wishlist">
            <i class="fa-regular fa-heart"></i>
        </button>
    </div>
    <div class="prod-info">
        <h4 class="prod-brand">Parijat Handicraft</h4>
        <p class="prod-name">
            <a href="product-detail.html">{{ $p['name'] }}</a>
        </p>
        <div class="prod-price">
            <span class="price-now">{{ $p['now'] }}</span>
            <span class="price-old">{{ $p['old'] }}</span>
            <span class="price-off">({{ $p['off'] }}% OFF)</span>
        </div>
        <div class="prod-btns">
            <button type="button" class="btn btn-outline-black" data-id="{{ $p['sku'] }}"
                data-name="{{ $p['name'] }}" data-toast-title="Added to Cart"
                data-toast-text="{{ $p['name'] }} has been added to your cart." data-toast-type="success">
                Add to Cart
            </button>
            <a href="product-detail.html" class="btn btn-primary">Buy Now</a>
        </div>
    </div>
</article>