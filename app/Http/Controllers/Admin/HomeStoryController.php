<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeStory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeStoryController extends Controller
{
    public function edit()
    {
        $story = HomeStory::first() ?? new HomeStory(['status' => 1]);

        return view('admin.home.story', compact('story'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'eyebrow' => 'nullable|string|max:120',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1500',
            'main_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'main_image_alt' => 'nullable|string|max:255',
            'detail_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'detail_image_alt' => 'nullable|string|max:255',
            'badge_text' => 'nullable|string|max:60',
            'pillars' => 'nullable|array|max:3',
            'pillars.*.icon' => 'nullable|string|max:60',
            'pillars.*.title' => 'nullable|string|max:60',
            'pillars.*.text' => 'nullable|string|max:120',
            'primary_btn_text' => 'nullable|string|max:60',
            'primary_btn_link' => 'nullable|string|max:255',
            'secondary_btn_text' => 'nullable|string|max:60',
            'secondary_btn_link' => 'nullable|string|max:255',
        ]);

        $story = HomeStory::first() ?? new HomeStory();

        foreach (['main_image', 'detail_image'] as $field) {
            if ($request->hasFile($field)) {
                if ($story->{$field}) {
                    Storage::disk('public')->delete($story->{$field});
                }
                $data[$field] = $request->file($field)->store('home-story', 'public');
            } else {
                unset($data[$field]);
            }
        }

        // keep only pillars that have a title
        $data['pillars'] = collect($request->input('pillars', []))
            ->filter(fn($p) => filled($p['title'] ?? null))
            ->map(fn($p) => [
                'icon' => $p['icon'] ?? '',
                'title' => $p['title'],
                'text' => $p['text'] ?? '',
            ])
            ->values()
            ->all();

        $data['status'] = $request->boolean('status') ? 1 : 0;

        $story->fill($data)->save();

        return redirect()->route('admin.home-story.edit')->with('success', 'Brand story saved successfully.');
    }
}