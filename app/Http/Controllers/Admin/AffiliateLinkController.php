<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AffiliateLink;
use App\Services\LinkPreview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AffiliateLinkController extends Controller
{
    public function index()
    {
        $links = AffiliateLink::orderBy('sort_order')->latest('id')->paginate(15);
        return view('admin.affiliate-links.index', compact('links'));
    }

    public function create()
    {
        return view('admin.affiliate-links.form', ['link' => new AffiliateLink(['status' => 1, 'sort_order' => 0])]);
    }

    public function store(Request $request)
    {
        return $this->save($request, new AffiliateLink());
    }

    public function edit(AffiliateLink $affiliate_link)
    {
        return view('admin.affiliate-links.form', ['link' => $affiliate_link]);
    }

    public function update(Request $request, AffiliateLink $affiliate_link)
    {
        return $this->save($request, $affiliate_link);
    }

    public function destroy(AffiliateLink $affiliate_link)
    {
        $this->deleteLocalImage($affiliate_link);
        $affiliate_link->delete();

        return back()->with('success', 'Link deleted.');
    }

    private function save(Request $request, AffiliateLink $link)
    {
        $data = $request->validate([
            'url' => 'required|url|max:2048',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'price' => 'nullable|numeric|min:0',
            'mrp' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|max:2048',
            'sort_order' => 'nullable|integer|min:0',
            'status' => 'required|boolean',
        ]);

        $refetch = $request->boolean('refetch');
        $fetch = !$link->exists || $link->url !== $data['url'] || $refetch;
        $preview = $fetch ? (LinkPreview::fetch($data['url']) ?? []) : [];

        $link->url = $data['url'];
        $link->sort_order = $data['sort_order'] ?? 0;
        $link->status = $data['status'];

        // price fields (blank = null)
        $link->price = filled($data['price'] ?? null) ? $data['price'] : null;
        $link->mrp = filled($data['mrp'] ?? null) ? $data['mrp'] : null;

        // typed value wins, unless "refresh from link" is ticked
        $link->title = (filled($data['title'] ?? null) && !$refetch) ? $data['title'] : ($preview['title'] ?? $link->title);
        $link->description = (filled($data['description'] ?? null) && !$refetch) ? $data['description'] : ($preview['description'] ?? $link->description);

        if ($request->hasFile('image')) {
            $this->deleteLocalImage($link);
            $link->image = $request->file('image')->store('affiliate-links', 'public');
        } elseif (!empty($preview['image'])) {
            $this->deleteLocalImage($link);
            $link->image = LinkPreview::downloadImage($preview['image']) ?? $preview['image'];
        }

        $link->save();

        $msg = 'Link saved.';
        if ($fetch && empty($preview['title']) && empty($preview['image'])) {
            $msg .= ' The site did not give a preview, so please add the title, description and image manually.';
        }

        return redirect()->route('admin.affiliate-links.index')->with('success', $msg);
    }

    private function deleteLocalImage(AffiliateLink $link): void
    {
        if ($link->image && !str_starts_with($link->image, 'http')) {
            Storage::disk('public')->delete($link->image);
        }
    }
}