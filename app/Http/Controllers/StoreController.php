<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Product;
use App\Models\User;
use App\Services\Enums\MediaTypeEnum;
use App\Services\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;

class StoreController extends Controller
{
    public function userStorePage($userId): JsonResponse
    {
        $user = User::query()->find($userId);

        if (! $user?->exists()) {
            return ApiResponse::failed(
                'The provider user store details provided is invalid, please check and try again',
                404);
        }

        $orderBy = match (strtolower(request()->order ?? 'cheapest')) {
            'newest' => 'created_at',
            default => 'price'
        };

        $products = Product::query()
            ->select(['id', 'product_location_id', 'subscription_id', 'name', 'price', 'created_at'])
            ->with(['location', 'mediaFiles' => function ($query) {
                $query->select('id', 'product_id', 'path', 'is_featured', 'media_type')
                    ->where('media_type', MediaTypeEnum::image->name)
                    ->orderByDesc('is_featured');
            }])
            ->withWhereHas('subscription', function ($query) {
                $query->where('expires_at', '>', now());
            })
            ->where('user_id', $userId)
            ->orderBy($orderBy, $orderBy == 'created_at' ? 'desc' : 'asc')
            ->paginate(20)
            ->toArray();

        $feedbacks = Feedback::query()
            ->where('user_id', $userId)
            ->select('rating', \DB::raw('count(*) as count'))
            ->groupBy('rating')
            ->get()
            ->toArray();

        $result = [
            'user' => $user->toArray(),
            'feedbacks' => $feedbacks,
            'products' => $products,
        ];

        return ApiResponse::success('User details added successfully', $result);
    }
}
