<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductImpression;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductImpressionFactory extends Factory
{
    protected $model = ProductImpression::class;

    public function definition(): array
    {
        $products = Product::pluck('id');
        return [
            'product_id' => fake()->unique()->randomElement($products->toArray()),
            'user_id' => User::first()->id,
        ];
    }
}
