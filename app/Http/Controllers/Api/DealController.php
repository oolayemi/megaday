<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Deal;
use App\Models\SuperDeal;
use App\Services\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DealController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $superDeals = SuperDeal::with(['deals', 'deals.prices'])->get();

        return ApiResponse::success('All deals retrieved successfully', $superDeals->toArray());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        $deal = Deal::with('prices')->find($id);
        if (! $deal) {
            return ApiResponse::failed('The selected deal does not exist');
        }

        return ApiResponse::success('Deal retrieved successfully', $deal->toArray());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Deal $deal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        $deal = Deal::with('prices')->find($id);
        if (! $deal) {
            return ApiResponse::failed('The selected deal does not exist');
        }

        $deal->delete();

        return ApiResponse::success('Deal has been deleted successfully');
    }
}
