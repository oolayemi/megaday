<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Favourite;
use App\Services\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FavouriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $user = \request()->user();

        $favourites = Favourite::with('product')
            ->where('user_id', $user->id)
            ->get();

        return ApiResponse::success('All favourites retrieved successfully', $favourites->toArray());
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

        Favourite::query()->firstOrCreate([
            'user_id' => $user->id,
            'product_id' => $request->product_id]
        );

        return ApiResponse::success('Favourite added successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $favourite = Favourite::query()->find($id);

        if (!$favourite?->exists()) {
            return ApiResponse::failed('The selected favourite cannot be found');
        }

        $favourite->delete();
        return ApiResponse::success('Favourite removed successfully');

    }
}
