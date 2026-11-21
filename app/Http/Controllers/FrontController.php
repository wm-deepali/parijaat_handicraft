<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Coupon;
use App\Support\Region;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Category;
use App\Models\HomeCard;
use App\Models\Attribute;
use App\Models\HomeStory;
use App\Models\HomeBanner;
use App\Models\Collection;
use App\Models\HomeSection;
use App\Models\ProductDeal;
use App\Models\DynamicPage;
use App\Models\BulkEnquiry;
use App\Models\FaqCategory;
use Illuminate\Support\Str;
use App\Traits\LogsApiCalls;
use Illuminate\Http\Request;
use App\Models\AffiliateLink;
use App\Models\ProductReview;
use App\Models\AttributeValue;
use App\Models\ShippingSetting;
use Illuminate\Validation\Rule;
use App\Models\GiftingOccasion;
use App\Models\CategoryAttribute;
use App\Models\NewsletterSubscriber;
class FrontController extends Controller
{
    use LogsApiCalls;

    public function home()
    {
        $banners = HomeBanner::active()->ordered()->get();

        // home-secA : Shop by Category
        $categories = Category::active()
            ->parents()
            ->withCount(['products as products_count' => fn($q) => $q->visible()])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        // home-secG : spotlight on one category
        $spotCategory = Category::active()
            ->parents()
            ->where('is_featured', 1)
            ->orderBy('sort_order')
            ->first()
            ?? $categories->firstWhere('products_count', '>', 0);

        $spotProducts = collect();

        if ($spotCategory) {
            $spotProducts = Product::visible()
                ->forCard()
                ->where('category_id', $spotCategory->id)
                ->latest('id')
                ->limit(10)
                ->get()
                ->map(fn($p) => $p->toCard());
        }

        // home-secB : Best Sellers (collection slug: best-sellers)
        $bestProducts = Product::visible()
            ->forCard()
            ->whereHas('collections', fn($q) => $q->where('slug', 'best-sellers'))
            ->latest('id')
            ->limit(40)
            ->get();

        $toCards = fn($list) => $list->map(function ($p) {
            $card = $p->toCard();
            $card['badge'] = 'Bestseller';

            return $card;
        })->values()->all();

        $bestTabs = [];

        if ($bestProducts->isNotEmpty()) {
            $bestTabs[] = [
                'label' => 'All Bestsellers',
                'items' => $toCards($bestProducts->take(10)),
            ];

            // one extra tab per category that has bestsellers (max 4, biggest first)
            $bestProducts->groupBy('category_id')
                ->filter(fn($g) => $g->first()->category)
                ->sortByDesc(fn($g) => $g->count())
                ->take(4)
                ->each(function ($group) use (&$bestTabs, $toCards) {
                    $bestTabs[] = [
                        'label' => $group->first()->category->name,
                        'items' => $toCards($group->take(10)),
                    ];
                });
        }

        // home-secC : brand story
        $story = HomeStory::where('status', 1)->first();

        // home-secD : Just Arrived (latest products, tabs by category)
        $newProducts = Product::visible()
            ->forCard()
            ->latest('id')
            ->limit(40)
            ->get();

        $toNewCards = fn($list) => $list->map(function ($p) {
            $card = $p->toCard();
            // "New" badge only while the product is recent (30 days)
            $card['badge'] = $p->created_at && $p->created_at->gt(now()->subDays(30)) ? 'New' : null;

            return $card;
        })->values()->all();

        $newTabs = [];

        if ($newProducts->isNotEmpty()) {
            $newTabs[] = [
                'label' => 'Recently Added',
                'items' => $toNewCards($newProducts->take(10)),
            ];

            $newProducts->groupBy('category_id')
                ->filter(fn($g) => $g->first()->category)
                ->sortByDesc(fn($g) => $g->count())
                ->take(3)
                ->each(function ($group) use (&$newTabs, $toNewCards) {
                    $newTabs[] = [
                        'label' => $group->first()->category->name,
                        'items' => $toNewCards($group->take(10)),
                    ];
                });
        }

        // home-secF / secH / secV : editable blocks
        $sections = HomeSection::where('status', 1)->get()->keyBy('key');
        $craftCards = HomeCard::active()->section('craft')->ordered()->get();
        $whyCards = HomeCard::active()->section('why')->ordered()->get();

        // home-secF chips: real categories (linked)
        $craftChips = $categories->where('products_count', '>', 0)->take(4);

        $affiliateLinks = AffiliateLink::active()->orderBy('sort_order')->latest('id')->limit(8)->get();

        // home-secJ : recently viewed (session) - uses the existing private method
        $recent = $this->recentlyViewed();

        // home-secP / secN : editable cards
        $marketCards = HomeCard::active()->section('marketplace')->ordered()->get();
        $reelCards = HomeCard::active()->section('reel')->ordered()->get();

        // home-secK : real approved reviews (4 stars and above)
        $homeReviews = ProductReview::where('status', 'approved')
            ->where('rating', '>=', 4)
            ->with(['customer:id,name', 'product:id,name'])
            ->latest('id')
            ->limit(9)
            ->get()
            ->map(function ($rv) {
                $parts = preg_split('/\s+/', trim($rv->customer?->name ?? 'Customer'));
                $name = count($parts) > 1
                    ? $parts[0] . ' ' . Str::upper(Str::substr(end($parts), 0, 1)) . '.'
                    : $parts[0];

                return [
                    'initial' => Str::upper(Str::substr($parts[0], 0, 1)),
                    'name' => $name,
                    'stars' => (int) $rv->rating,
                    'text' => Str::limit(trim((string) $rv->review), 170),
                    'product' => $rv->product?->name,
                    'verified' => (bool) $rv->verified_purchase,
                ];
            })
            ->filter(fn($r) => $r['text'] !== '')
            ->values();

        // home-secM : the live deal that ends first (next one shows automatically after it expires)
        $deal = ProductDeal::live()
            ->whereHas('product', fn($q) => $q->visible())
            ->with(['product' => fn($q) => $q->forCard()])
            ->soonest()
            ->first();

        $dealCard = $deal?->product?->toCard();

        // home-secE : offer cards (first = big feature card, rest = slider)
        $offerCards = HomeCard::active()->section('offer')->ordered()->get();
        $offerFeature = $offerCards->first();
        $offerSlides = $offerCards->slice(1)->values();

        // home-secE : real coupons
        $region = app(Region::class);

        $homeCoupons = Coupon::available()
            ->latest('id')
            ->limit(3)
            ->get()
            ->map(function ($c) use ($region) {
                $v = rtrim(rtrim(number_format((float) $c->discount_value, 2, '.', ''), '0'), '.');
                $off = $c->is_percent ? "{$v}% off" : $region->format($c->discount_value) . ' off';

                return [
                    'code' => $c->code,
                    'text' => filled($c->offer_text) ? $c->offer_text : $off,
                ];
            });

        return view('front-pages.home', compact(
            'banners',
            'categories',
            'bestTabs',
            'spotCategory',
            'spotProducts',
            'story',
            'newTabs',
            'sections',
            'craftCards',
            'whyCards',
            'craftChips',
            'recent',
            'marketCards',
            'reelCards',
            'homeReviews',
            'affiliateLinks',
            'deal',
            'dealCard',
            'offerFeature',
            'offerSlides',
            'homeCoupons'
        ));
    }

    /**
     * /products
     * ?category[]=slug &sub[]=slug &price_min= &price_max= &collection[]=slug
     * &occasion[]=slug &availability[]=in-stock &rating=4 &attr[material][]=brass &sort=low &page=2
     */
    public function products(Request $request)
    {
        // "Explore by Category" tiles
        $categories = Category::active()
            ->parents()
            ->withCount([
                'products as products_count' => fn($q) => $q->where('status', 1),
            ])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        // price slider bounds (rounded up to the next 1000)
        $maxPrice = (float) Product::visible()->max('price');
        [$priceCeil, $priceMin, $priceMax, $priceStep] = $this->priceBounds($request);

        $sort = array_key_exists((string) $request->input('sort'), Product::SORT_OPTIONS)
            ? $request->input('sort')
            : 'recommended';

        $products = $this->applyListingFilters(Product::visible()->forCard(), $request, $priceMin, $priceMax, $priceCeil)
            ->orderForListing($sort)
            ->paginate(12)
            ->withQueryString()
            ->through(fn($p) => $p->toCard());

        $filters = $this->listingFilters($request);
        $recent = $this->recentlyViewed();
        $related = $this->youMayAlsoLove();

        return view('front-pages.product-listing', compact(
            'categories',
            'products',
            'filters',
            'sort',
            'priceCeil',
            'priceMin',
            'priceMax',
            'recent',
            'related',
            'priceStep'
        ));
    }

    /**
     * /category/{slug}?sub=child-slug&sort=low&page=2
     */
    /**
     * /category/{slug}?sub=child-slug&sort=low&page=2 + all listing filters
     */
    public function category(Request $request, string $slug)
    {
        $category = Category::active()->parents()->where('slug', $slug)->firstOrFail();

        $tabs = $category->children()->active()->orderBy('sort_order')->get();
        $activeSub = $tabs->firstWhere('slug', $request->input('sub'));

        // price slider bounds for this category only
        $maxPrice = (float) Product::visible()->where('category_id', $category->id)->max('price');
        [$priceCeil, $priceMin, $priceMax, $priceStep] = $this->priceBounds($request, $category->id);

        $sort = array_key_exists((string) $request->input('sort'), Product::SORT_OPTIONS)
            ? $request->input('sort')
            : 'recommended';

        $query = Product::visible()
            ->forCard()
            ->where('category_id', $category->id)
            ->when($activeSub, fn($q) => $q->where('subcategory_id', $activeSub->id));

        $products = $this->applyListingFilters($query, $request, $priceMin, $priceMax, $priceCeil)
            ->orderForListing($sort)
            ->paginate(12)
            ->withQueryString()
            ->through(fn($p) => $p->toCard());

        $filters = $this->listingFilters($request, $category);
        $recent = $this->recentlyViewed();
        $related = $this->youMayAlsoLove($category->id);

        return view('front-pages.category', compact(
            'category',
            'tabs',
            'activeSub',
            'products',
            'filters',
            'sort',
            'priceCeil',
            'priceMin',
            'priceMax',
            'recent',
            'related',
            'priceStep'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | LISTING FILTERS
    |--------------------------------------------------------------------------
    */

    /** Clean array input: drops empty values. */
    private function arr(Request $request, string $key): array
    {
        return array_values(array_filter((array) $request->input($key, []), fn($v) => $v !== null && $v !== ''));
    }

    private function applyListingFilters($query, Request $request, int $priceMin, int $priceMax, int $priceCeil)
    {
        // text search (header search box)
        if ($term = trim((string) $request->input('q', ''))) {
            $this->applySearch($query, $term);
        }

        // categories (parents)
        if ($slugs = $this->arr($request, 'category')) {
            $ids = Category::parents()->whereIn('slug', $slugs)->pluck('id');
            $query->whereIn('category_id', $ids);
        }

        // sub categories (only children of the ticked categories, if any are ticked)
        if ($slugs = $this->arr($request, 'sub')) {
            $ids = Category::subCategories()
                ->whereIn('slug', $slugs)
                ->when($this->arr($request, 'category'), fn($q, $cats) =>
                    $q->whereHas('parent', fn($p) => $p->whereIn('slug', $cats)))
                ->pluck('id');

            $query->whereIn('subcategory_id', $ids);
        }

        // price (request values are in the customer's currency -> convert to default for the query)
        $region = app(Region::class);
        $tol = 0.5 / (10 ** $region->decimals()); // card prices are rounded, so allow half a unit at the edges

        if ($priceMin > 0) {
            $query->where('price', '>=', $region->toBase($priceMin - $tol));
        }
        if ($priceMax < $priceCeil) {
            $query->where('price', '<=', $region->toBase($priceMax + $tol));
        }

        // collections
        if ($slugs = $this->arr($request, 'collection')) {
            $query->whereHas('collections', fn($q) => $q->whereIn('slug', $slugs));
        }

        // occasions
        if ($slugs = $this->arr($request, 'occasion')) {
            $query->whereHas('occasions', fn($q) => $q->whereIn('slug', $slugs));
        }

        // availability (both ticked = no filter)
        $av = $this->arr($request, 'availability');
        $in = in_array('in-stock', $av, true);
        $out = in_array('out-of-stock', $av, true);
        if ($in xor $out) {
            $in ? $query->where('stock', '>', 0) : $query->where('stock', '<=', 0);
        }

        // customer rating (average of approved reviews)
        if ($r = (int) $request->input('rating')) {
            $query->whereIn(
                'id',
                ProductReview::where('status', 'approved')
                    ->groupBy('product_id')
                    ->havingRaw('AVG(rating) >= ?', [$r])
                    ->select('product_id')
            );
        }

        // attributes: OR inside one attribute, AND between attributes
        foreach ((array) $request->input('attr', []) as $attrSlug => $valSlugs) {
            if (!is_array($valSlugs) || !$valSlugs) {
                continue;
            }

            $attr = Attribute::where('slug', $attrSlug)->first();
            if (!$attr) {
                continue;
            }

            $valueIds = AttributeValue::where('attribute_id', $attr->id)
                ->whereIn('slug', $valSlugs)
                ->pluck('id');

            if ($valueIds->isEmpty()) {
                continue;
            }

            $query->whereHas('attributeValues', fn($q) => $q
                ->where('attribute_id', $attr->id)
                ->whereIn('attribute_value_id', $valueIds));
        }

        return $query;
    }

    /**
     * Sidebar filter groups.
     * type: check | chip | swatch | price | rating
     * When $category is given (category page), Categories / Sub Categories groups are skipped
     * and attribute filters are limited to that category and its children.
     */
    private function listingFilters(Request $request, ?Category $category = null): array
    {
        $groups = [];
        $selectedParentSlugs = $this->arr($request, 'category');

        if (!$category) {
            // Categories
            $parents = Category::active()->parents()->orderBy('sort_order')->orderBy('name')->get(['id', 'name', 'slug']);
            $groups[] = [
                'title' => 'Categories',
                'type' => 'check',
                'field' => 'category',
                'key' => 'category',
                'open' => true,
                'items' => $parents->pluck('name', 'slug')->all(),
            ];

            // Sub categories: only shown once a category is ticked
            if ($selectedParentSlugs) {
                $subs = Category::active()->subCategories()
                    ->whereHas('parent', fn($p) => $p->whereIn('slug', $selectedParentSlugs))
                    ->orderBy('parent_id')->orderBy('sort_order')
                    ->get();

                if ($subs->isNotEmpty()) {
                    $groups[] = [
                        'title' => 'Sub Categories',
                        'type' => 'check',
                        'field' => 'sub',
                        'key' => 'sub',
                        'open' => true,
                        'items' => $subs->pluck('name', 'slug')->all(),
                    ];
                }
            }
        }

        // Price (rendered by the blade)
        $groups[] = ['title' => 'Price Range', 'type' => 'price', 'open' => true];

        // Collections
        $collections = Collection::where('status', 1)->orderBy('sort_order')->orderBy('name')->pluck('name', 'slug')->all();
        if ($collections) {
            $groups[] = ['title' => 'Collections', 'type' => 'chip', 'field' => 'collection', 'key' => 'collection', 'open' => false, 'items' => $collections];
        }

        // Occasions
        $occasions = GiftingOccasion::where('status', 1)->orderBy('title')->pluck('title', 'slug')->all();
        if ($occasions) {
            $groups[] = ['title' => 'Occasion', 'type' => 'chip', 'field' => 'occasion', 'key' => 'occasion', 'open' => false, 'items' => $occasions];
        }

        // Attributes (CategoryAttribute.show_in_filter)
        $catIds = [];
        if ($category) {
            $catIds = Category::where('id', $category->id)->orWhere('parent_id', $category->id)->pluck('id')->all();
        } elseif ($selectedParentSlugs) {
            $parentIds = Category::parents()->whereIn('slug', $selectedParentSlugs)->pluck('id');
            $catIds = Category::whereIn('id', $parentIds)->orWhereIn('parent_id', $parentIds)->pluck('id')->all();
        }

        $rows = CategoryAttribute::where('show_in_filter', 1)
            ->where('status', 1)
            ->when($catIds, fn($q) => $q->whereIn('category_id', $catIds))
            ->orderBy('sort_order')
            ->with(['attribute.values' => fn($q) => $q->where('status', 1)->orderBy('sort_order')])
            ->get()
            ->unique('attribute_id');

        foreach ($rows as $row) {
            $attr = $row->attribute;
            if (!$attr || !$attr->status || $attr->values->isEmpty()) {
                continue;
            }

            $isSwatch = $attr->values->contains(fn($v) => !empty($v->hex_code));

            $groups[] = [
                'title' => $attr->name,
                'type' => $isSwatch ? 'swatch' : 'chip',
                'field' => 'attr[' . $attr->slug . ']',
                'key' => 'attr.' . $attr->slug,
                'open' => false,
                'items' => $isSwatch
                    ? $attr->values->mapWithKeys(fn($v) => [$v->slug => [$v->value, $v->hex_code ?: '#cccccc']])->all()
                    : $attr->values->pluck('value', 'slug')->all(),
            ];
        }

        // Availability
        $groups[] = [
            'title' => 'Availability',
            'type' => 'check',
            'field' => 'availability',
            'key' => 'availability',
            'open' => false,
            'items' => ['in-stock' => 'In Stock', 'out-of-stock' => 'Out of Stock'],
        ];

        // Customer rating
        $groups[] = ['title' => 'Customer Rating', 'type' => 'rating', 'open' => false];

        return $groups;
    }

    /*
    |--------------------------------------------------------------------------
    | SHARED SECTIONS
    |--------------------------------------------------------------------------
    */

    /** Recently viewed (session, filled by Product::trackView on the detail page). */
    private function recentlyViewed(int $limit = 10)
    {
        $ids = array_slice(session('recently_viewed', []), 0, $limit);

        if (!$ids) {
            return collect();
        }

        return Product::visible()->forCard()
            ->whereIn('id', $ids)
            ->get()
            ->sortBy(fn($p) => array_search($p->id, $ids))
            ->map(fn($p) => $p->toCard())
            ->values();
    }

    /** "You may also love": newest visible products, optionally skipping one category. */
    private function youMayAlsoLove(?int $excludeCategoryId = null, int $limit = 8)
    {
        return Product::visible()->forCard()
            ->when($excludeCategoryId, fn($q) => $q->where('category_id', '!=', $excludeCategoryId))
            ->latest('id')
            ->limit($limit)
            ->get()
            ->map(fn($p) => $p->toCard());
    }

    /** Shared by header suggestions and /products?q= */
    private function applySearch($query, string $term)
    {
        $like = '%' . addcslashes($term, '\\%_') . '%';

        return $query->where(function ($q) use ($like) {
            $q->where('name', 'like', $like)
                ->orWhereHas('category', fn($c) => $c->where('name', 'like', $like));
        });
    }

    /**
     * /search/suggest?q=brass  (JSON, used by header search dropdown)
     */
    public function searchSuggest(Request $request)
    {
        $term = trim((string) $request->input('q', ''));

        if (mb_strlen($term) < 2) {
            return response()->json(['items' => [], 'total' => 0, 'all' => route('products')]);
        }

        $base = $this->applySearch(Product::visible(), $term);
        $total = (clone $base)->count();

        $items = $this->applySearch(Product::visible()->forCard(), $term)
            ->orderByRaw('CASE WHEN name LIKE ? THEN 0 ELSE 1 END', [addcslashes($term, '\\%_') . '%'])
            ->orderBy('name')
            ->limit(6)
            ->get()
            ->map(function ($p) {
                $c = $p->toCard();

                return [
                    'name' => $c['name'],
                    'url' => $c['url'],
                    'img' => $c['img'],
                    'now' => $c['now'],
                    'old' => $c['old'] ?? null,
                ];
            })
            ->values();

        return response()->json([
            'items' => $items,
            'total' => $total,
            'all' => route('products', ['q' => $term]),
        ]);
    }

    /**
     * /product/{slug}
     */
    public function product(string $slug)
    {
        $product = Product::visible()
            ->where('slug', $slug)
            ->with([
                'images',
                'videos',
                'variants.values',      // ProductVariantValue  (variant_id, attribute_id, attribute_value_id)
                'variants.images',      // ProductVariantImage  (variant_id, image, thumb?, is_default)
                'addons',
                'attributeValues',
                'category:id,name,slug,size_chart',
                'subcategory:id,name,slug',
                'collections:id,name,slug',
                'occasions',
                'priceTiers',
            ])
            ->withAvg('approvedReviews as avg_rating', 'rating')
            ->withCount('approvedReviews as reviews_count')
            ->firstOrFail();

        // reviews: summary + latest list
        $ratingBreakdown = $product->approvedReviews()
            ->selectRaw('rating, COUNT(*) as total')
            ->groupBy('rating')
            ->pluck('total', 'rating')
            ->all();

        $reviews = $product->approvedReviews()
            ->with(['customer:id,name', 'images'])
            ->latest('id')
            ->limit(12)
            ->get();

        $reviewCards = $reviews->map(function ($rv) {
            $full = trim($rv->customer?->name ?? 'Customer');
            $parts = preg_split('/\s+/', $full);
            $name = count($parts) > 1
                ? $parts[0] . ' ' . Str::upper(Str::substr(end($parts), 0, 1)) . '.'
                : $parts[0];

            return [
                'initials' => Str::upper(Str::substr($parts[0], 0, 1) . (count($parts) > 1 ? Str::substr(end($parts), 0, 1) : '')),
                'name' => $name,
                'stars' => (int) $rv->rating,
                'title' => $rv->title ?? '',
                'text' => $rv->review ?? '',
                'meta' => $rv->verified_purchase ? ['Verified purchase'] : [],
                'photos' => $rv->images->map(fn($i) => 'storage/' . ltrim($i->image, '/'))->values()->all(),
                'date' => $rv->created_at?->format('F Y'),
                'helpful' => 0,
            ];
        })->values();

        $reviewTabs = [
            1 => $reviewCards->all(),
            2 => $reviewCards->filter(fn($r) => !empty($r['photos']))->values()->all(),
            3 => $reviewCards->filter(fn($r) => $r['stars'] === 5)->values()->all(),
        ];

        $reviewPhotos = $reviewCards->pluck('photos')->flatten()->values();

        // related: same category, excluding this product
        $related = Product::visible()->forCard()
            ->where('id', '!=', $product->id)
            ->where('category_id', $product->category_id)
            ->latest('id')
            ->limit(10)
            ->get()
            ->map(fn($p) => $p->toCard());

        // recently viewed: read before tracking, so this product is not in the list
        $recent = $this->recentlyViewed()->reject(fn($c) => $c['id'] === $product->id)->values();

        // ---------- attributes: facts (info) + options (selectable) ----------
        $catAttrs = CategoryAttribute::where('status', 1)
            ->whereIn('category_id', array_filter([$product->category_id, $product->subcategory_id]))
            ->with('attribute:id,name,slug,type')
            ->orderBy('sort_order')
            ->get()
            ->unique('attribute_id')
            ->keyBy('attribute_id');

        $valueRows = AttributeValue::whereIn('id', $product->attributeValues->pluck('attribute_value_id'))
            ->where('status', 1)
            ->orderBy('sort_order')
            ->get()
            ->keyBy('id');

        $attrGroups = $product->attributeValues
            ->groupBy('attribute_id')
            ->map(function ($rows, $attrId) use ($catAttrs, $valueRows) {
                $ca = $catAttrs[$attrId] ?? null;
                if (!$ca || !$ca->attribute) {
                    return null;
                }

                $values = $rows->map(fn($r) => $valueRows[$r->attribute_value_id] ?? null)
                    ->filter()->sortBy('sort_order')->values();

                return $values->isEmpty() ? null : [
                    'id' => (int) $attrId,
                    'name' => $ca->attribute->name,
                    'slug' => $ca->attribute->slug,
                    'type' => $ca->attribute->type,        // color_swatch | button
                    'selectable' => (bool) $ca->is_selectable,
                    'sort' => $ca->sort_order,
                    'values' => $values,
                ];
            })
            ->filter()->sortBy('sort')->values();

        $facts = $attrGroups->where('selectable', false)->values();
        $options = $attrGroups->where('selectable', true)->values();

        // ---------- variants as JSON for the page script ----------
        $variantData = $product->variants
            ->filter(fn($v) => $v->status)
            ->map(function ($v) {
                $images = $v->images->sortByDesc(fn($i) => (int) $i->is_default)
                    ->map(fn($i) => [
                        'full' => asset('storage/' . $i->image),
                        'thumb' => asset('storage/' . ($i->thumb ?? $i->image)),
                    ])->values();

                if ($images->isEmpty() && $v->image) {
                    $images = collect([['full' => asset('storage/' . $v->image), 'thumb' => asset('storage/' . $v->image)]]);
                }

                return [
                    'id' => $v->id,
                    'type' => $v->type,                      // price | image | stock | sku
                    'sku' => $v->sku,
                    'mrp' => (float) $v->mrp,
                    'price' => (float) $v->price,
                    'stock' => (int) $v->stock,
                    'available' => $v->is_available !== false,
                    'images' => $images,
                    'attrs' => $v->values->pluck('attribute_value_id')->map(fn($id) => (int) $id)->values()->all(),
                ];
            })
            ->values();

        $region = app(Region::class);
        $regionJs = $region->js();

        // real coupons -> [icon, title, desc, code]
        $coupons = Coupon::available()
            ->latest('id')
            ->limit(3)
            ->get()
            ->map(function ($c) use ($region) {
                $v = rtrim(rtrim(number_format((float) $c->discount_value, 2, '.', ''), '0'), '.');

                return [
                    $c->is_percent ? 'fa-percent' : 'fa-tag',
                    $c->is_percent ? "{$v}% Off" : $region->format($c->discount_value) . ' Off',
                    $c->offer_text,
                    $c->code,
                ];
            })
            ->all();

        $cur = $region->current();
        $freeShipFrom = ($cur && !$cur->is_default)
            ? 0.0
            : (float) (ShippingSetting::first()?->free_delivery_threshold ?? 0);

        $customer = auth('customer')->user();

        $reviewState = !$customer
            ? 'guest'
            : ($product->reviewableOrderItemFor($customer->id) ? 'ok' : 'none');

        Product::trackView($product->id);

        return view('front-pages.product-detail', compact(
            'product',
            'ratingBreakdown',
            'reviews',
            'reviewTabs',
            'reviewPhotos',
            'related',
            'recent',
            'facts',
            'options',
            'variantData',
            'coupons',
            'freeShipFrom',
            'reviewState',
            'regionJs'
        ));
    }

    /** Price slider bounds, in the CUSTOMER's currency. Returns [ceil, min, max, step]. */
    private function priceBounds(Request $request, ?int $categoryId = null): array
    {
        $region = app(Region::class);

        $maxShown = $region->convert((float) Product::visible()
            ->when($categoryId, fn($q) => $q->where('category_id', $categoryId))
            ->max('price'));

        $power = $maxShown >= 1 ? (int) floor(log10($maxShown)) : 0;
        $step = (int) max(1, 10 ** max(0, $power - 2));    // 12000 -> 100, 144 -> 1
        $unit = (int) max(10, 10 ** max(0, $power - 1));   // 12000 -> 1000, 144 -> 10
        $ceil = $maxShown > 0 ? (int) (ceil($maxShown / $unit) * $unit) : $unit * 10;

        $min = max(0, min((int) $request->input('price_min', 0), $ceil));
        $max = $request->filled('price_max')
            ? max($min, min((int) $request->input('price_max'), $ceil))
            : $ceil;

        return [$ceil, $min, $max, $step];
    }

    /** /blogs */
    public function blogs()
    {
        // featured: the flagged post, otherwise the newest one
        $featured = Blog::published()->where('is_featured', 1)->orderByDesc('published_at')->first()
            ?? Blog::published()->orderByDesc('published_at')->orderByDesc('id')->first();

        $base = Blog::published()->when($featured, fn($q) => $q->where('id', '!=', $featured->id));

        $posts = (clone $base)
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->paginate(12)
            ->through(fn($b) => $this->card($b));

        $trending = (clone $base)
            ->orderByDesc('views')
            ->orderByDesc('published_at')
            ->limit(3)
            ->get()
            ->map(fn($b) => $this->card($b));

        // tabs: "All" + one per category found on this page
        $tabs = [1 => 'All'];
        foreach ($posts->getCollection()->pluck('cat')->filter()->unique()->values() as $i => $cat) {
            $tabs[$i + 2] = $cat;
        }

        return view('front-pages.blogs', compact('featured', 'posts', 'trending', 'tabs'));
    }

    /** /blog/{slug} */
    public function blogDetail(string $slug)
    {
        $blog = Blog::published()->where('slug', $slug)->firstOrFail();

        // count one view per visitor session
        if (!session()->has("blog_viewed.{$blog->id}")) {
            $blog->increment('views');
            session(["blog_viewed.{$blog->id}" => true]);
        }

        [$content, $toc] = $this->withToc($blog->body_html);

        // same category first, then the newest
        $related = Blog::published()
            ->where('id', '!=', $blog->id)
            ->when($blog->category, fn($q) => $q->orderByRaw('category = ? desc', [$blog->category]))
            ->orderByDesc('published_at')
            ->limit(6)
            ->get()
            ->map(fn($b) => $this->card($b));

        $popular = Blog::published()
            ->where('id', '!=', $blog->id)
            ->orderByDesc('views')
            ->orderByDesc('published_at')
            ->limit(3)
            ->get()
            ->map(fn($b) => $this->card($b));

        return view('front-pages.blog-detail', compact('blog', 'content', 'toc', 'related', 'popular'));
    }

    /** Same array shape the blog-card partial already uses (+ url, date_label) */
    private function card(Blog $b): array
    {
        return [
            'url' => $b->url,
            'img' => $b->image_url,
            'alt' => $b->title,
            'date' => $b->display_date->toDateString(),
            'date_label' => $b->display_date->format('d M Y'),
            'cat' => $b->category,
            'author' => $b->author ?: config('app.name'),
            'read' => $b->read_time,
            'title' => $b->title,
            'excerpt' => $b->excerpt,
        ];
    }

    /** Adds ids to <h2> tags (keeps existing ones) and returns [html, [id => label]] */
    private function withToc(string $html): array
    {
        $toc = [];
        $n = 0;

        $html = preg_replace_callback('/<h2\b([^>]*)>(.*?)<\/h2>/is', function ($m) use (&$toc, &$n) {
            $n++;
            $attrs = $m[1];

            if (preg_match('/\bid\s*=\s*["\']([^"\']+)["\']/i', $attrs, $idm)) {
                $id = $idm[1];
            } else {
                $id = 's' . $n;
                $attrs .= ' id="' . $id . '"';
            }

            $toc[$id] = trim(strip_tags($m[2]));

            return '<h2' . $attrs . '>' . $m[2] . '</h2>';
        }, $html);

        return [$html, $toc];
    }

    /**
     * /faqs
     */
    public function faqs()
    {
        // one tab per active category that has at least one active FAQ
        $categories = FaqCategory::active()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->with(['faqs' => fn($q) => $q->active()->orderBy('sort_order')->orderBy('id')])
            ->get()
            ->filter(fn($c) => $c->faqs->isNotEmpty())
            ->values();

        $contact = Setting::contact();

        return view('front-pages.faq', compact('categories', 'contact'));
    }

    /**
     * /page/{slug}   (and /privacy-policy, which uses the "privacy-policy" slug)
     */
    public function page(string $slug)
    {
        $page = DynamicPage::active()->where('slug', $slug)->firstOrFail();
        $content = $page->renderedContent(Setting::current());

        return view('front-pages.page', compact('page', 'content'));
    }

    public function subscribe(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email:rfc|max:150',
        ]);

        $sub = NewsletterSubscriber::firstOrCreate(
            ['email' => strtolower(trim($data['email']))],
            ['ip_address' => $request->ip(), 'status' => 1]
        );

        return response()->json([
            'message' => $sub->wasRecentlyCreated
                ? 'Thank you for subscribing!'
                : 'This email is already subscribed.',
        ]);
    }

    public function bulkEnquiryStore(Request $request)
    {
        // honeypot: bots fill this, humans never see it
        if ($request->filled('website')) {
            return response()->json(['message' => 'Thank you! We will contact you shortly.']);
        }

        $data = $request->validate([
            'full_name'    => 'required|string|max:120',
            'company'      => 'required|string|max:150',
            'email'        => 'required|email:rfc|max:150',
            'phone'        => 'required|string|max:30',
            'phone_full'   => 'nullable|string|max:30',
            'country_code' => 'nullable|string|max:5',
            'dial_code'    => 'nullable|string|max:8',
            'category'     => 'required|string|max:120',
            'quantity'     => 'required|integer|min:1|max:10000000',
            'country'      => 'required|string|max:100',
            'frequency'    => ['nullable', Rule::in(BulkEnquiry::FREQUENCIES)],
            'message'      => 'nullable|string|max:3000',
            'reference'    => 'nullable|array|max:5',
            'reference.*'  => 'file|mimes:jpg,jpeg,png,webp,pdf,doc,docx,xls,xlsx|max:10240',
        ], [
            'full_name.required' => 'Please enter your full name.',
            'company.required'   => 'Please enter your company name.',
            'email.required'     => 'Please enter your business email.',
            'phone.required'     => 'Please enter your phone number.',
            'category.required'  => 'Please select a product category.',
            'quantity.required'  => 'Please enter the quantity.',
            'quantity.integer'   => 'Quantity must be a number.',
            'country.required'   => 'Please enter the country to ship to.',
            'reference.max'      => 'You can attach up to 5 files.',
            'reference.*.max'    => 'Each file must be 10 MB or smaller.',
            'reference.*.mimes'  => 'Allowed files: JPG, PNG, WEBP, PDF, DOC, XLS.',
        ]);

        $files = [];
        foreach ($request->file('reference', []) as $file) {
            $files[] = [
                'name' => $file->getClientOriginalName(),
                'path' => $file->store('bulk-enquiries', 'public'),
            ];
        }

        $enquiry = BulkEnquiry::create([
            'full_name'    => $data['full_name'],
            'company'      => $data['company'],
            'email'        => strtolower(trim($data['email'])),
            'phone'        => $data['phone'],
            'phone_full'   => $data['phone_full'] ?? null,
            'country_code' => $data['country_code'] ?? null,
            'dial_code'    => $data['dial_code'] ?? null,
            'category'     => $data['category'],
            'quantity'     => $data['quantity'],
            'ship_country' => $data['country'],
            'frequency'    => $data['frequency'] ?? null,
            'message'      => $data['message'] ?? null,
            'files'        => $files ?: null,
            'ip_address'   => $request->ip(),
        ]);

        return response()->json([
            'message' => 'Thank you! We will reply with pricing and availability within 1–2 business days.',
        ]);
    }

}
