<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductDeal;
use Illuminate\Http\Request;

class ProductDealController extends Controller
{
    public function index()
    {
        $deals = ProductDeal::with(['product' => fn($q) => $q->withTrashed()->with('images')])
            ->orderByDesc('ends_at')
            ->paginate(20);

        return view('admin.home.deals.index', compact('deals'));
    }

    public function create()
    {
        return view('admin.home.deals.form', [
            'deal' => new ProductDeal(['status' => 1]),
            'products' => $this->products(),
        ]);
    }

    public function store(Request $request)
    {
        ProductDeal::create($this->validated($request));

        return redirect()->route('admin.product-deals.index')->with('success', 'Deal added successfully.');
    }

    public function edit(ProductDeal $product_deal)
    {
        return view('admin.home.deals.form', [
            'deal' => $product_deal,
            'products' => $this->products(),
        ]);
    }

    public function update(Request $request, ProductDeal $product_deal)
    {
        $product_deal->update($this->validated($request));

        return redirect()->route('admin.product-deals.index')->with('success', 'Deal updated successfully.');
    }

    public function destroy(ProductDeal $product_deal)
    {
        $product_deal->delete();

        return response()->json(['message' => 'Deal deleted successfully.']);
    }

    private function products()
    {
        return Product::orderBy('name')->get(['id', 'name', 'sku']);
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'title' => 'nullable|string|max:120',
            'text' => 'nullable|string|max:255',
            'coupon_code' => 'nullable|string|max:60',
            'starts_at' => 'nullable|date',
            'ends_at' => ['required', 'date', $request->filled('starts_at') ? 'after:starts_at' : 'date'],
        ]);

        $data['coupon_code'] = filled($data['coupon_code'] ?? null) ? strtoupper(trim($data['coupon_code'])) : null;
        $data['status'] = $request->boolean('status') ? 1 : 0;

        return $data;
    }
}