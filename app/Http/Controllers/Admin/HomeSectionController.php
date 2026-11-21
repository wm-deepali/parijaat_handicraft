<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeSectionController extends Controller
{
    /** Which fields each block shows in the form. */
    private function defs(): array
    {
        return [
            'craft' => [
                'label' => 'Craft Collections: Heading',
                'fields' => ['eyebrow', 'title', 'description', 'btn1', 'btn2'],
            ],
            'craft_feature' => [
                'label' => 'Craft Collections: Featured Card',
                'fields' => ['eyebrow', 'title', 'description', 'image', 'btn1'],
                'labels' => ['eyebrow' => 'Small Label (e.g. category name)', 'btn1' => 'CTA Text / Link'],
            ],
            'why' => [
                'label' => 'Why Choose Us: Heading',
                'fields' => ['eyebrow', 'title', 'description'],
            ],
            'affiliate' => [
                'label' => 'Become a Partner Block',
                'fields' => ['eyebrow', 'title', 'description', 'image', 'btn1', 'btn2', 'lines'],
                'labels' => [
                    'btn1' => 'Apply Button Text (opens the partner popup, link not needed)',
                    'btn2' => 'Secondary Button Text / Link',
                    'lines' => 'Why Partner With Us? (one point per line, max 3)',
                ],
            ],
            'recent' => [
                'label' => 'Recently Viewed: Heading',
                'fields' => ['eyebrow', 'title', 'description'],
            ],
            'marketplace' => [
                'label' => 'Marketplaces: Heading',
                'fields' => ['eyebrow', 'title', 'description'],
            ],
            'reviews' => [
                'label' => 'Customer Reviews: Heading',
                'fields' => ['eyebrow', 'title', 'description'],
            ],
            'reels' => [
                'label' => 'Reels: Heading',
                'fields' => ['eyebrow', 'title', 'description', 'btn1'],
                'labels' => ['btn1' => 'Button Text / Link (e.g. Follow Us on Instagram)'],
            ],
            'offers' => [
                'label' => 'Offers & Deals: Heading',
                'fields' => ['eyebrow', 'title', 'description'],
            ],
            'newsletter' => [
                'label' => 'Footer Newsletter',
                'fields' => ['title', 'description', 'image'],
                'labels' => [
                    'title' => 'Heading',
                    'description' => 'Short text under the heading',
                    'image' => 'Background image',
                ],
            ],
        ];
    }

    private function def(string $key): array
    {
        return $this->defs()[$key] ?? abort(404);
    }

    public function edit(string $key)
    {
        $def = $this->def($key);
        $section = HomeSection::firstOrNew(['key' => $key], ['status' => 1]);

        return view('admin.home.section', compact('key', 'def', 'section'));
    }

    public function update(Request $request, string $key)
    {
        $def = $this->def($key);

        $data = $request->validate([
            'eyebrow' => 'nullable|string|max:120',
            'title' => (in_array('title', $def['fields']) ? 'required' : 'nullable') . '|string|max:255',
            'description' => 'nullable|string|max:1500',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'image_alt' => 'nullable|string|max:255',
            'btn1_text' => 'nullable|string|max:80',
            'btn1_link' => 'nullable|string|max:255',
            'btn2_text' => 'nullable|string|max:80',
            'btn2_link' => 'nullable|string|max:255',
            'lines' => 'nullable|string|max:1000',
        ]);

        $section = HomeSection::firstOrNew(['key' => $key]);

        if ($request->hasFile('image')) {
            if ($section->image) {
                Storage::disk('public')->delete($section->image);
            }
            $data['image'] = $request->file('image')->store('home-sections', 'public');
        } else {
            unset($data['image']);
        }

        $data['lines'] = array_slice(
            array_values(array_filter(array_map('trim', preg_split('/\R/', (string) $request->input('lines', ''))))),
            0,
            3
        );
        $data['status'] = $request->boolean('status') ? 1 : 0;

        $section->fill($data)->save();

        return redirect()->route('admin.home-sections.edit', $key)->with('success', 'Saved successfully.');
    }
}