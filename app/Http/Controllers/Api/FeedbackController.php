<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Services\Helpers\ApiResponse;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|digits_between:1,5',
            'review' => 'nullable',
        ]);

        $user = $request->user();
        $data = $request->all();

        Feedback::updateOrCreate([
            'user_id' => $user->id,
            'product_id' => $data['product_id'],
        ], [
            'rating' => $data['rating'],
            'review' => $data['review'] ?? null,
        ]);

        return ApiResponse::success('You have successfully rated this ad');
    }
}
