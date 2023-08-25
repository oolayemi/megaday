<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\Enums\ProductStatusEnum;
use App\Services\Helpers\ApiResponse;

class UserController extends Controller
{
    public function profile()
    {
        $user = \request()->user()
            ->with(['subscriptions:id,deal_id,user_id', 'subscriptions.deal:id,super_deal_id', 'subscriptions.deal.superDeal'])
            ->first()
            ->toArray();

        return ApiResponse::success('User profile retrieved', $user);
    }

    public function myAdverts(string $status)
    {
        $user = \request()->user();
        $adverts = Product::query()
            ->select(['id', 'user_id', 'status', 'name', 'price', 'quantity', 'discount'])
            ->where('status', strtolower($status))
            ->where('user_id', $user->id)
            ->paginate(20)
            ->toArray();

        return ApiResponse::success(ucfirst($status) . ' ads retrieved retrieved', $adverts);
    }

    public function feedbacks()
    {
        $feedbacks = $this->user->feedbacks;

        dd($feedbacks);
    }

    public function wallet()
    {
        $wallet = $this->user->wallet;
        dd($wallet);
    }


    protected function getStatus($status):string|false
    {
        return in_array($status, ProductStatusEnum::cases());
    }
}
