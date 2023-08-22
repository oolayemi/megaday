<?php

namespace Database\Factories;

use App\Models\ProductLocation;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ProductLocationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'city' => $this->faker->city(),
            'state' => $this->faker->word(),
            'country' => $this->faker->country(),
        ];
    }
}
