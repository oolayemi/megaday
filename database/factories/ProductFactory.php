<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductLocation;
use App\Models\SubCategory;
use App\Models\Subscription;
use App\Models\User;
use App\Services\Enums\ProductConditionEnum;
use App\Services\Enums\ProductStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $subCategory = SubCategory::inRandomOrder()->first();
        $user = User::first();
        $subscription = Subscription::first();

        return [
            'category_id' => $subCategory->category_id,
            'sub_category_id' => $subCategory->id,
            'product_location_id' => ProductLocation::factory(),
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'quantity' => $this->faker->randomNumber(),
            'price' => $this->faker->randomFloat(),
            'discount' => $this->faker->randomFloat(2, 5, 90),
            'is_negotiable' => $this->faker->boolean(70),
            'status' => $this->faker->randomElement([ProductStatusEnum::pending->name, ProductStatusEnum::active->name, ProductStatusEnum::draft->name, ProductStatusEnum::expired->name]),
            'expires_at' => Carbon::now()->addWeeks(fake()->numberBetween(1, 10)),
            'condition' => $this->faker->randomElement([ProductConditionEnum::new->name, ProductConditionEnum::used->name]),
            'is_premium' => $this->faker->boolean(),

            'user_id' => $user->id,
            'subscription_id' => $subscription->id,
        ];
    }
}
