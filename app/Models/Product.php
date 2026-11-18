<?php

namespace App\Models;

use App\Support\Region;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    public const SORT_OPTIONS = [
        'recommended' => 'Recommended',
        'newest' => 'New Arrivals',
        'sold' => 'Best Selling',
        'low' => 'Price: Low to High',
        'high' => 'Price: High to Low',
        'rating' => 'Customer Rating',
    ];

    protected $fillable = [
        'tax_class_id',
        'category_id',
        'subcategory_id',
        'brand_id',

        'name',
        'slug',

        'sku',

        'short_description',
        'specifications',
        'material_craft',
        'size_dimensions',
        'care_instructions',
        'shipping_delivery',
        'returns_exchange',

        'price_type',
        'mrp',
        'discount_type',
        'discount',
        'price',

        'stock',
        'min_qty',

        'delivery_time',

        'meta_title',
        'meta_description',

        'status',

    ];

    protected $casts = [
        'specifications' => 'array',
        'status' => 'boolean',
    ];

    public function taxClass()
    {
        return $this->belongsTo(TaxClass::class);
    }

    public function priceTiers()
    {
        return $this->hasMany(ProductPriceTier::class)->orderBy('min_qty');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Category::class, 'subcategory_id');
    }

    /**
     * ✅ Used across all grid/listing views (homepage sections, product
     * listing pages, luxury tabs, etc). Prefers the compressed THUMB
     * (400px) since these are always shown small — falls back to the
     * full image for older rows created before the thumb column existed.
     *
     * Uses the already-loaded `images` relation (forCard() eager loads it),
     * so no extra query per product (N+1 fix).
     */
    public function getDisplayImageAttribute()
    {
        $image = $this->images->firstWhere('is_default', 1) ?? $this->images->first();

        return $image
            ? asset('storage/' . ($image->thumb ?? $image->image))
            : asset('assets/images/home/cat4.png');
    }

    /**
     * Array shape expected by partials/product-card.blade.php
     */
    public function toCard(): array
    {
        return [
            'id' => $this->id,
            'sku' => $this->sku,
            'name' => $this->name,
            'brand' => $this->brand?->name,
            'url' => url('product/' . $this->slug), // swap for route('product.show', $this->slug) once that route exists
            'img' => $this->display_image,           // already a full asset() URL
            'now' => app(Region::class)->format($this->price),
            'old' => $this->mrp > $this->price ? app(Region::class)->format($this->mrp) : null,
            'off' => $this->discount_percent,
            'badge' => null,                           // decide badge rule later (New / Bestseller / collection)
        ];
    }

    public function attributeValues()
    {
        return $this->hasMany(ProductAttributeValue::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    // ✅ new: product videos (Media → Video)
    public function videos()
    {
        return $this->hasMany(ProductVideo::class);
    }

    // ✅ new: addon options (Addon Options section)
    public function addons()
    {
        return $this->hasMany(ProductAddon::class);
    }

    // OCCASIONS
    public function occasions()
    {
        return $this->belongsToMany(
            GiftingOccasion::class,
            'occasion_product',
            'product_id',
            'occasion_id'
        );
    }

    public function collections()
    {
        return $this->belongsToMany(
            Collection::class,
            'collection_product',
            'product_id',
            'collection_id'
        );
    }

    public function cartItems()
    {
        return $this->hasMany(
            CartItem::class
        );
    }

    public function scopeVisible($query)
    {
        $query->where('status', 1);

        if (StockSetting::current()->auto_disable_out_of_stock) {
            $query->where('stock', '>', 0);
        }

        return $query;
    }

    public function reviews()
    {
        return $this->hasMany(ProductReview::class);
    }

    public function approvedReviews()
    {
        return $this->hasMany(ProductReview::class)->where('status', 'approved');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderItem::class, 'product_id');
    }

    // card ke liye jo relations aur rating chahiye, ek jagah
    public function scopeForCard($query)
    {
        // Product.php: in scopeForCard() add 'brand:id,name' to the with() list
        return $query->with(['images', 'collections:id,name', 'category:id,name', 'subcategory:id,name', 'brand:id,name'])
            ->withAvg('approvedReviews as avg_rating', 'rating');
    }

    // recently viewed: product detail page se call hoga
    public static function trackView(int $id, int $limit = 10): void
    {
        $ids = array_values(array_diff(session('recently_viewed', []), [$id]));
        array_unshift($ids, $id);
        session(['recently_viewed' => array_slice($ids, 0, $limit)]);
    }

    public function getDiscountPercentAttribute(): int
    {
        return $this->mrp > $this->price
            ? (int) round((($this->mrp - $this->price) / $this->mrp) * 100)
            : 0;
    }

    public function scopeOrderForListing($query, ?string $sort)
    {
        switch ($sort) {
            case 'low':
                $query->orderBy('price');
                break;
            case 'high':
                $query->orderByDesc('price');
                break;
            case 'rating':
                $query->orderByDesc('avg_rating'); // forCard() ka alias
                break;
            case 'sold':
                if (method_exists($this, 'orderDetails')) {
                    $query->withSum('orderDetails as sold_qty', 'quantity')->orderByDesc('sold_qty');
                } else {
                    $query->orderByDesc('created_at'); // relation nahi to crash ki jagah newest
                }
                break;
            case 'newest':
                $query->orderByDesc('created_at');
                break;
        }

        // tie-breaker: barabar values par bhi order stable rahe
        return $query->orderByDesc('id');
    }

    /**
     * Customer ka pehla aisa order item jo is product ka hai, deliver ho chuka hai,
     * aur jis par abhi tak review nahi diya gaya. Nahi mila to null.
     */
    public function reviewableOrderItemFor(int $customerId): ?OrderItem
    {
        $reviewed = ProductReview::where('customer_id', $customerId)
            ->where('product_id', $this->id)
            ->whereNotNull('order_item_id')
            ->pluck('order_item_id');

        return OrderItem::where('product_id', $this->id)
            ->whereNotIn('id', $reviewed)
            ->whereHas('order', function ($q) use ($customerId) {
                $q->where('customer_id', $customerId)
                    ->whereIn('status', ['delivered', 'completed']); // apne status values yahan rakho
            })
            ->orderBy('id')
            ->first();
    }

    /** CKEditor HTML -> safe HTML (only formatting tags, no scripts or event handlers) */
    public static function rich(?string $html): string
    {
        $html = strip_tags((string) $html, '<p><br><ul><ol><li><strong><b><em><i><u><a><span><h3><h4><h5><table><thead><tbody><tr><th><td>');
        $html = preg_replace('/\son\w+\s*=\s*("[^"]*"|\'[^\']*\')/i', '', $html);
        $html = preg_replace('/(href)\s*=\s*(["\'])\s*javascript:[^"\']*\2/i', '$1=$2#$2', $html);

        return trim($html);
    }

    /** true if the field has real text (CKEditor saves <p>&nbsp;</p> when "empty") */
    public static function hasText(?string $html): bool
    {
        $text = html_entity_decode(strip_tags((string) $html), ENT_QUOTES, 'UTF-8');

        return trim(str_replace("\xC2\xA0", ' ', $text)) !== '';
    }

    /** Quantity ke hisaab se unit price (default currency). Range product me tier jeetta hai, warna $fallback. */
    public function unitPriceFor(int $qty, ?float $fallback = null): float
    {
        if ($this->price_type === 'range' && $this->priceTiers->isNotEmpty()) {
            $tiers = $this->priceTiers;
            $hit = $tiers->first(fn($t) => $qty >= $t->min_qty && ($t->max_qty === null || $qty <= $t->max_qty))
                ?? ($qty < $tiers->first()->min_qty ? $tiers->first() : $tiers->last());

            return (float) $hit->price;
        }

        return (float) ($fallback ?? $this->price);
    }

    public function minOrderQty(): int
    {
        $min = max(1, (int) $this->min_qty);

        if ($this->price_type === 'range' && $first = $this->priceTiers->first()) {
            $min = max($min, (int) $first->min_qty);
        }

        return $min;
    }

    /** null = koi cap nahi */
    public function maxOrderQty(): ?int
    {
        if ($this->price_type === 'range' && $last = $this->priceTiers->last()) {
            return $last->max_qty ? (int) $last->max_qty : null;
        }

        return null;
    }

}