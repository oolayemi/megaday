<?php

namespace App\Services\Actions;

use App\Models\ProductLocation;

class ProductLocationAction
{
    public function create(array $data): ProductLocation
    {
        return ProductLocation::firstOrCreate($data);
    }
}
