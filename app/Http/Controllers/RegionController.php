<?php

namespace App\Http\Controllers;

use App\Support\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class RegionController extends Controller
{
    public function set(Request $request, Region $region)
    {
        $data = $request->validate(['country' => 'required|string|size:2']);

        $country = $region->options()->firstWhere('iso2', strtoupper($data['country']));

        if ($country) {
            Cookie::queue('country', $country->iso2, 60 * 24 * 365);   // 1 saal
        }

        return back();
    }
}