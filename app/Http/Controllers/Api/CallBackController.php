<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Rules\Phone;
use App\Services\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CallBackController extends Controller
{
    public function all(): JsonResponse
    {
        $user = \request()->user();
        $callBacks = $user->callBacks;

        return ApiResponse::success("Call backs fetched successfully", $callBacks?->toArray());
    }

    public function request(Request $request): JsonResponse
    {
        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'name' => ['required','string'],
            'phone' => ['required', new Phone],
        ]);

        $data = $request->all();
        $user = Product::find($request->product_id)->user;

        $user->callBacks()->create($data);
        return ApiResponse::success("Call ball request sent successfully");

    }

}
