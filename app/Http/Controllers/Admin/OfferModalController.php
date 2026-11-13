<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OfferModal;
use App\Traits\StoresHomeImages;
use Illuminate\Http\Request;

class OfferModalController extends Controller
{
    use StoresHomeImages;

    public function edit()
    {
        $offer = OfferModal::current();

        return view('admin.offer-modal.edit', compact('offer'));
    }

    public function update(Request $request)
    {
        $link = ['nullable', 'string', 'max:255', 'regex:/^(https?:\/\/|\/|#)/i'];

        $request->validate([
            'sub_title' => 'nullable|string|max:120',
            'title' => 'required|string|max:255',
            'short_content' => 'nullable|string|max:1000',
            'coupon_text' => 'nullable|string|max:120',
            'coupon_sub_text' => 'nullable|string|max:160',
            'coupon_code' => ['nullable', 'string', 'max:50', 'regex:/^[A-Za-z0-9\-_]+$/'],
            'terms' => 'nullable|array|max:10',
            'terms.*' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'button_text' => 'nullable|string|max:60',
            'button_link' => $link,
            'is_active' => 'required|in:0,1',
        ], [
            'coupon_code.regex' => 'Coupon code can contain only letters, numbers, hyphen and underscore.',
            'button_link.regex' => 'Button link must start with http://, https://, / or #.',
        ]);

        $offer = OfferModal::first() ?? new OfferModal();

        $data = $request->only([
            'sub_title',
            'title',
            'short_content',
            'coupon_text',
            'coupon_sub_text',
            'button_text',
            'button_link',
        ]);

        $data['coupon_code'] = filled($request->coupon_code)
            ? strtoupper(trim($request->coupon_code))
            : null;

        // terms: drop empty rows, reindex
        $data['terms'] = array_values(array_filter(
            array_map('trim', (array) $request->input('terms', [])),
            fn($t) => $t !== ''
        ));

        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            $this->deleteStored($offer->image);
            $data['image'] = $this->compressAndStore($request->file('image'), 'offer', 1200);
        } elseif ($request->boolean('remove_image') && $offer->image) {
            $this->deleteStored($offer->image);
            $data['image'] = null;
        }

        $offer->fill($data)->save();

        return redirect()->route('admin.offer-modal.edit')->with('success', 'Offer modal saved successfully.');
    }
}