<?php

namespace App\Support;

use App\Models\SeoPage;
use Illuminate\Support\Facades\Route;

class Seo
{
    /**
     * Per-record SEO. Values you pass win; empty ones fall back to the route-level row.
     * Titles/descriptions may contain {site}, which the head partial replaces with the brand name.
     */
    public static function for(array $data = []): SeoPage
    {
        $base = ($name = Route::currentRouteName()) ? SeoPage::forKey($name) : null;
        $seo = $base ? $base->replicate() : new SeoPage();   // never saved

        foreach ($data as $key => $value) {
            if (filled($value)) {
                $seo->{$key} = $value;
            }
        }

        return $seo;
    }
}