<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeCardController extends Controller
{
    private function def(string $section): array
    {
        return [
            'craft' => ['label' => 'Craft Collection Cards', 'fields' => ['text', 'image', 'link']],
            'why' => ['label' => 'Why Choose Us Items', 'fields' => ['text', 'icon']],
            'marketplace' => [
                'label' => 'Marketplace Cards',
                'fields' => ['text', 'image', 'link'],
                'labels' => ['image' => 'Logo', 'link' => 'Store link (https://...)'],
            ],
            'reel' => [
                'label' => 'Reels',
                'fields' => ['text', 'image', 'link'],
                'labels' => ['image' => 'Thumbnail', 'link' => 'Video link (YouTube watch, shorts or embed link)'],
            ],
            'offer' => [
                'label' => 'Offer Cards (first card = big feature card)',
                'fields' => ['text', 'image', 'link', 'badge_big', 'badge_small', 'btn_text'],
                'labels' => [
                    'text' => 'Short description (shown on the big card only)',
                    'link' => 'Offer link (e.g. /products?collection=diwali or /category/slug)',
                    'badge_big' => 'Badge big text (e.g. 40%, FREE)',
                    'badge_small' => 'Badge small text (e.g. OFF, SHIPPING)',
                    'btn_text' => 'Button text (big card only)',
                ],
            ],
            'promise' => ['label' => 'Footer Promise Items', 'fields' => ['text', 'icon']],
        ][$section] ?? abort(404);
    }

    public function index(string $section)
    {
        $def = $this->def($section);
        $cards = HomeCard::section($section)->ordered()->get();

        return view('admin.home.cards.index', compact('section', 'def', 'cards'));
    }

    public function create(string $section)
    {
        $def = $this->def($section);
        $card = new HomeCard(['section' => $section, 'status' => 1, 'sort_order' => 0]);

        return view('admin.home.cards.form', compact('section', 'def', 'card'));
    }

    public function store(Request $request, string $section)
    {
        $def = $this->def($section);
        $data = $this->validated($request, $def, true);
        $data['section'] = $section;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('home-cards', 'public');
        }

        HomeCard::create($data);

        return redirect()->route('admin.home-cards.index', $section)->with('success', 'Added successfully.');
    }

    public function edit(string $section, HomeCard $card)
    {
        $def = $this->def($section);

        return view('admin.home.cards.form', compact('section', 'def', 'card'));
    }

    public function update(Request $request, string $section, HomeCard $card)
    {
        $def = $this->def($section);
        $data = $this->validated($request, $def, false);

        if ($request->hasFile('image')) {
            if ($card->image) {
                Storage::disk('public')->delete($card->image);
            }
            $data['image'] = $request->file('image')->store('home-cards', 'public');
        }

        $card->update($data);

        return redirect()->route('admin.home-cards.index', $section)->with('success', 'Updated successfully.');
    }

    public function destroy(string $section, HomeCard $card)
    {
        if ($card->image) {
            Storage::disk('public')->delete($card->image);
        }
        $card->delete();

        return response()->json(['message' => 'Deleted successfully.']);
    }

    private function validated(Request $request, array $def, bool $creating): array
    {
        $needsImage = in_array('image', $def['fields']) && $creating;

        $data = $request->validate([
            'title' => 'required|string|max:120',
            'text' => 'nullable|string|max:255',
            'badge_big' => 'nullable|string|max:20',
            'badge_small' => 'nullable|string|max:20',
            'btn_text' => 'nullable|string|max:60',
            'icon' => 'nullable|string|max:60',
            'link' => 'nullable|string|max:255',
            'image' => ($needsImage ? 'required' : 'nullable') . '|image|mimes:jpg,jpeg,png,webp|max:4096',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);
        $data['status'] = $request->boolean('status') ? 1 : 0;
        unset($data['image']);

        return $data;
    }
}