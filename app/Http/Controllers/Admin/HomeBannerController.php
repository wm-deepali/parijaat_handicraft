<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeBannerController extends Controller
{
    public function index()
    {
        $banners = HomeBanner::ordered()->paginate(20);

        return view('admin.home.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.home.banners.form', ['banner' => new HomeBanner(['status' => 1, 'sort_order' => 0])]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request, true);
        $data['image'] = $request->file('image')->store('home-banners', 'public');

        HomeBanner::create($data);

        return redirect()->route('admin.home-banners.index')->with('success', 'Banner added successfully.');
    }

    public function edit(HomeBanner $home_banner)
    {
        return view('admin.home.banners.form', ['banner' => $home_banner]);
    }

    public function update(Request $request, HomeBanner $home_banner)
    {
        $data = $this->validated($request, false);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($home_banner->image);
            $data['image'] = $request->file('image')->store('home-banners', 'public');
        }

        $home_banner->update($data);

        return redirect()->route('admin.home-banners.index')->with('success', 'Banner updated successfully.');
    }

    public function destroy(HomeBanner $home_banner)
    {
        Storage::disk('public')->delete($home_banner->image);
        $home_banner->delete();

        return response()->json(['message' => 'Banner deleted successfully.']);
    }

    private function validated(Request $request, bool $imageRequired): array
    {
        $data = $request->validate([
            'eyebrow' => 'nullable|string|max:120',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'button_text' => 'nullable|string|max:60',
            'button_link' => 'nullable|string|max:255',
            'image' => ($imageRequired ? 'required' : 'nullable') . '|image|mimes:jpg,jpeg,png,webp|max:4096',
            'image_alt' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);
        $data['status'] = $request->boolean('status') ? 1 : 0;
        unset($data['image']);

        return $data;
    }
}