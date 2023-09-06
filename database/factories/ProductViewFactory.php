<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductView;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductViewFactory extends Factory
{
    protected $model = ProductView::class;

    public function definition(): array
    {
        $products = Product::pluck('id');

        return [
            'product_id' => fake()->unique()->randomElement($products->toArray()),
            'user_id' => User::first()->id,
            'created_at' => fake()->dateTimeThisYear()
        ];
    }
}
