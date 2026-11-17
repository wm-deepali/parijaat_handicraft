<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductReview;
use App\Models\ProductReviewImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductReviewController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $customer = auth('customer')->user();

        $data = $request->validate([
            'rating'     => 'required|integer|between:1,5',
            'title'      => 'nullable|string|max:120',
            'review'     => 'required|string|min:10|max:2000',
            'photos'     => 'nullable|array|max:5',
            'photos.*'   => 'image|max:5120',
        ]);

        $item = $product->reviewableOrderItemFor($customer->id);

        if (!$item) {
            return response()->json([
                'status'  => false,
                'message' => 'Only customers who received this product can review it.',
            ], 403);
        }

        DB::transaction(function () use ($request, $product, $customer, $item, $data) {
            $review = ProductReview::create([
                'product_id'        => $product->id,
                'customer_id'       => $customer->id,
                'order_id'          => $item->order_id,
                'order_item_id'     => $item->id,
                'rating'            => $data['rating'],
                'title'             => $data['title'] ?? null,
                'review'            => $data['review'],
                'verified_purchase' => true,
                'featured'          => false,
                'status'            => 'pending',
            ]);

            foreach ($request->file('photos', []) as $file) {
                ProductReviewImage::create([
                    'product_review_id' => $review->id,
                    'image'             => $file->store('review-images', 'public'),
                ]);
            }
        });

        return response()->json([
            'status'  => true,
            'message' => 'Thank you! Your review will appear after approval.',
        ]);
    }
}