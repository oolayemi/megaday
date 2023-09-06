<?php

namespace Database\Factories;

use App\Models\Product;
use App\Services\Enums\MediaTypeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductMediaFile>
 */
class ProductMediaFileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $productId = Product::query()->inRandomOrder()->first()->id;
        $isFeatured = fake()->boolean;
        return [
            'product_id' => $productId,
            'path' => fake()->imageUrl,
            'media_type' =>  fake()->randomElement(
                $isFeatured
                    ? [MediaTypeEnum::image->name]
                    : [MediaTypeEnum::image->name, MediaTypeEnum::video->name]),
            'is_featured' => $isFeatured,
        ];
    }
}
