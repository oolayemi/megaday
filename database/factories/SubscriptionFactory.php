<?php

namespace Database\Factories;

use App\Models\Deal;
use App\Models\DealPrice;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class SubscriptionFactory extends Factory
{
    public function definition(): array
    {
        $deal = Deal::whereHas('prices')->inRandomOrder()->first();
        $dealPrice = $deal->prices()->inRandomOrder()->first();

        return [
            'expires_at' => Carbon::now()->addWeeks(fake()->numberBetween(1, 20)),

            'user_id' => User::first()->id,
            'deal_id' => $deal->id,
            'deal_price_id' => $dealPrice->id,
        ];
    }
}
