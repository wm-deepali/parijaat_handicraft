<?php

namespace App\Providers;

use App\Models\Setting;
use App\Models\SeoPage;
use App\Support\NavMenu;
use App\Models\GoogleSetting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('*', function ($view) {
            // Built once per request, then reused for every view / partial
            static $shared = null;

            if ($shared === null) {
                $name = Route::currentRouteName();

                $shared = [
                    'seo' => $name ? SeoPage::forKey($name) : null,
                    // new Setting() avoids "property on null" errors if the row doesn't exist yet
                    'general' => Setting::first() ?? new Setting(),
                ];
            }

            $view->with($shared);
        });

        View::composer('layouts.app', function ($view) {
            $view->with([
                'googleSetting' => GoogleSetting::first() ?? new GoogleSetting(),
                'navMenu' => NavMenu::build(),
            ]);
        });
    }
}