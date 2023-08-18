<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'user_id',
        'category_id',
        'sub_category_id',
        'product_location_id',
        'name',
        'description',
        'quantity',
        'price',
        'discount',
        'is_negotiable',
        'status',
        'expires_at',
        'condition',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'discount' => 'double',
        'is_negotiable' => 'boolean',
        'expires_at' => 'datetime'
    ];

    public function location(): HasOne
    {
        return $this->hasOne(ProductLocation::class);
    }

    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn (int $value) => ($value / 100),
            set: fn (float $value) => ($value * 100)
        );
    }

    public function mediaFiles(): HasMany
    {
        return $this->hasMany(ProductMediaFile::class);
    }
}
