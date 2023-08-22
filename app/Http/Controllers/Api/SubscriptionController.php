<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DealPrice;
use App\Models\Subscription;
use App\Services\Helpers\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userDeals = \request()->user()
            ->subscriptions()
            ->with(['deal', 'dealPrice', 'deal.superDeal:id,name'])
            ->get();

        return ApiResponse::success('User deals retrieved successfully', $userDeals->toArray());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'deal_id' => ['required', 'exists:deals,id'],
            'deal_price_id' => ['required', 'exists:deal_prices,id'],
        ]);

        $user = $request->user();

        $dealPrice = DealPrice::query()
            ->where('id', $request->deal_price_id)
            ->where('deal_id', $request->deal_id)
            ->first();

        if (! $dealPrice?->exists()) {
            return ApiResponse::failed('The provided deals details is incorrect', 404);
        }

        $expiresAt = $this->getExpiryDate($dealPrice);
        Subscription::updateOrCreate(
            ['user_id' => $user->id,
                'deal_price_id' => $request->deal_price_id,
                'deal_id' => $request->deal_id],
            ['expires_at' => $expiresAt]
        );

        return ApiResponse::success("Subscription successful");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    protected function getExpiryDate(DealPrice $dealPrice): Carbon
    {
        $expiresAt = Carbon::now();
        if (strtolower($dealPrice->duration) == 'month') {
            $expiresAt->addMonths($dealPrice->duration_value);
        } elseif (strtolower($dealPrice->duration) == 'weekly') {
            $expiresAt->addWeeks($dealPrice->duration_value);
        } else {
            $expiresAt->addDays(2);
        }

        return $expiresAt;
    }
}
