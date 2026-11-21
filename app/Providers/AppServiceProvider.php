<?php

namespace App\Providers;

use App\Support\Region;
use App\Models\Setting;
use App\Models\SeoPage;
use App\Support\NavMenu;
use App\Models\HomeCard;
use App\Models\HomeSection;
use App\Models\DynamicPage;
use App\Models\Announcement;
use App\Models\GoogleSetting;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // ek request me ek hi baar country/rates load hon
        $this->app->singleton(Region::class);
    }

    public function boot(): void
    {
        Blade::directive('defaultSymbol', function () {
            return "<?php echo e(app(\\App\\Support\\Region::class)->defaultSymbol()); ?>";
        });

        // @moneyDefault($amount): amount already in the default currency, shown as is: "$120.00"
        Blade::directive('moneyDefault', function ($expression) {
            $expression = trim((string) $expression);

            if ($expression === '') {
                return '';
            }

            return "<?php echo e(app(\\App\\Support\\Region::class)->formatDefault($expression)); ?>";
        });

        // @money($amount): default currency ka amount, customer ki currency me
        Blade::directive('money', function ($expression) {
            $expression = trim((string) $expression);

            if ($expression === '') {
                return '';   // galat jagah likha @money page nahi todega, bas khali dikhega
            }

            return "<?php echo e(app(\\App\\Support\\Region::class)->format($expression)); ?>";
        });

        // $seo (route-level row, page_key = route name) + $general for every view / partial
        View::composer('*', function ($view) {
            $request = request();

            // built once per request (kept on the request, not in a static, so tests/Octane don't leak it)
            $shared = $request->attributes->get('view_shared');

            if ($shared === null) {
                $name = Route::currentRouteName();

                $shared = [
                    'seo' => $name ? SeoPage::forKey($name) : null,
                    // new Setting() avoids "property on null" errors if the row doesn't exist yet
                    'general' => Setting::first() ?? new Setting(),
                ];

                $request->attributes->set('view_shared', $shared);
            }

            // never overwrite something a controller passed on purpose
            $view->with(array_diff_key($shared, $view->getData()));
        });

        View::composer('layouts.app', function ($view) {
            $region = app(Region::class);

            $cartQuery = auth('customer')->check()
                ? \App\Models\Cart::where('customer_id', auth('customer')->id())
                : \App\Models\Cart::where('session_id', session()->getId());

            $view->with([
                'announcements' => Announcement::active()->orderBy('id')->get(),
                'promiseCards' => HomeCard::active()->section('promise')->ordered()->get(),
                'newsSection' => HomeSection::where('key', 'newsletter')->where('status', 1)->first(),
                'googleSetting' => GoogleSetting::first() ?? new GoogleSetting(),
                'navMenu' => NavMenu::build(),
                'regionOptions' => $region->options(),
                'regionCurrent' => $region->current(),
                // slug => heading of every active dynamic page (footer policy links)
                'policyPages' => DynamicPage::active()->pluck('heading', 'slug'),
                'miniCart' => $cartQuery->with([
                    'items.product.images',
                    'items.product.category',
                    'items.product.subcategory',
                    'items.imageVariant',
                    'items.priceVariant',
                    'items.stockVariant',
                    'items.addons',
                ])->first(),
            ]);
        });
    }
}