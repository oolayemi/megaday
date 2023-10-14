<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Favourite;
use App\Models\WishList;
use App\Services\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WishListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $user = \request()->user();

        $wishList = WishList::with('product')
            ->where('user_id', $user->id)
            ->get();

        return ApiResponse::success('All wish lists retrieved successfully', $wishList->toArray());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate(['product_id' => 'required|exists:products,id']);

        $authCheck = auth('sanctum')->check();

        if (! $authCheck){
            return ApiResponse::failed("You need to be authorised for this, please sign in to continue", 403);
        }

        $user = auth('sanctum')->user();

        WishList::query()->firstOrCreate([
            'user_id' => $user->id,
            'product_id' => $request->product_id]
        );

        return ApiResponse::success('Wish list added successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $wishList = WishList::query()->find($id);

        if (!$wishList?->exists()) {
            return ApiResponse::failed('The selected wishlist cannot be found');
        }

        $wishList->delete();
        return ApiResponse::success('Wishlist removed successfully');

    }
}
