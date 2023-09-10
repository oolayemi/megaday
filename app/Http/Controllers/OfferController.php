<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function makeOffer(Request $request): JsonResponse
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'amount' => 'required|decimal:0,2',
        ]);

        $user = $request->user();

        $product = Product::find($request->product_id);

        if (! $product->is_negotiable) {
            return ApiResponse::failed("You cannot make an offer for this product, it is a non-negotiable product");
        }

        $user->offers()->create([
            'product_id' => $product->id,
            'amount' => $request->amount,
            'seller_user_id' => $product->user_id
        ]);

        //TODO: send notification to seller and also send email for notice

        return ApiResponse::success("You have successfully made an offer to the seller, you will get a notification when they respond");
    }
}
