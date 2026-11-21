<?php

namespace App\Http\View\Composers;

use App\Models\SeoPage;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class SeoComposer
{
    public function compose(View $view): void
    {
        $name = Route::currentRouteName();

        $view->with('seo', $name ? SeoPage::forKey($name) : null);
    }
}