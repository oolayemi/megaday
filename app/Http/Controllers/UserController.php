<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Product;
use App\Models\User;
use App\Services\Enums\MediaTypeEnum;
use App\Services\Enums\ProductStatusEnum;
use App\Services\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function profile(): JsonResponse
    {
        $user = User::query()
            ->with(['subscriptions:id,deal_id,user_id', 'subscriptions.deal:id,super_deal_id', 'subscriptions.deal.superDeal'])
            ->find(auth()->id())
            ->toArray();

        return ApiResponse::success('User profile retrieved', $user);
    }

    public function myAdverts(string $status): JsonResponse
    {
        $user = \request()->user();
        $adverts = Product::query()
            ->with(['mediaFiles' => function ($query) {
                $query->where('media_type', MediaTypeEnum::image->name)
                    ->where('is_featured', true);
            }])
            ->select(['id', 'user_id', 'status', 'name', 'price', 'quantity', 'discount'])
            ->where('status', strtolower($status))
            ->where('user_id', $user->id)
            ->paginate(20)
            ->toArray();

        return ApiResponse::success(ucfirst($status) . ' ads retrieved retrieved', $adverts);
    }

    public function feedbacks(): JsonResponse
    {
        $feedbacks = Feedback::with(['product:id,name'])->where('user_id', auth()->id())->get();

            \request()->user()->feedbacks();
        return ApiResponse::success('Feedbacks fetched successfully', $feedbacks->toArray());
    }

    public function wallet(): JsonResponse
    {
        $wallet = \request()->user()->wallet;
        return ApiResponse::success('Wallet fetched successfully', $wallet?->toArray());
    }

    public function markAsSold(string $productId): JsonResponse
    {
        $product = Product::query()->find($productId);

        if (!$product?->exists()) {
            return ApiResponse::failed("The provided product is not valid", 404);
        }

        $product->update(['status' => ProductStatusEnum::sold->name]);
        return ApiResponse::success("The product has been marked as sold");
    }

    public function deleteProduct(string $productId): JsonResponse
    {
        $product = Product::query()->find($productId);

        if (!$product?->exists()) {
            return ApiResponse::failed("The provided product is not valid", 404);
        }

        $product->delete();
        return ApiResponse::success("The product has been deleted");
    }




    protected function getStatus($status):string|false
    {
        return in_array($status, ProductStatusEnum::cases());
    }
}
