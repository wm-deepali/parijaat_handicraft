<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeBanner;

class HomePageController extends Controller
{
    public function index()
    {
        $bannerCount = HomeBanner::count();
        $bannerActive = HomeBanner::active()->count();

        return view('admin.home.index', compact('bannerCount', 'bannerActive'));
    }
}