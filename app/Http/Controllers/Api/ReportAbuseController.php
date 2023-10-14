<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ReportAbuse;
use App\Services\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReportAbuseController extends Controller
{
    public function report(Request $request): JsonResponse
    {
        $request->validate([
            'product_id' => ['required','exists:products,id'],
            'reason' => ['required', 'string', 'max:200'],
            'description' => ['required', 'string', 'max:1000']
        ]);

        ReportAbuse::create([
            'user_id' => auth('sanctum')->user()?->id ?? null,
            'product_id' => $request->product_id,
            'reason' => $request->reason,
            'description' => $request->description
        ]);

        //notify admin of the report abuse

        return ApiResponse::success("The report has been submitted successfully");
    }
}
