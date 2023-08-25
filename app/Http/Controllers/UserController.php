<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Helpers\ApiResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile()
    {
        $user = \request()->user()
            ->with(['subscriptions:id,deal_id,user_id','subscriptions.deal:id,super_deal_id','subscriptions.deal.superDeal'])
            ->first()
            ->toArray();

        return ApiResponse::success("dfkjsd", $user);
    }

    public function myAdverts(string $status)
    {
        $adverts = $this->user
            ->products()
            ->where('status', $status)
            ->get();

        dd($adverts);
    }

    public function feedbacks()
    {
        $feedbacks = $this->user->feedbacks;

        dd($feedbacks);
    }

    public function wallet() {
        $wallet = $this->user->wallet;
        dd($wallet);
    }
}
