<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'user_id',
        'category_id',
        'sub_category_id',
        'product_location_id',
        'subscription_id',
        'name',
        'description',
        'quantity',
        'price',
        'discount',
        'is_negotiable',
        'status',
        'expires_at',
        'condition',
        'is_premium',
        'views',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'discount' => 'double',
        'is_negotiable' => 'boolean',
        'expires_at' => 'datetime',
        'views' => 'integer',
        'is_premium' => 'boolean',
    ];

    public function location(): BelongsTo
    {
        return $this->belongsTo(ProductLocation::class, 'product_location_id');
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

    public function subscription(): BelongsTo
    {
        return $this->belongsTo(Subscription::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategory(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function feedbacks(): HasMany
    {
        return $this->hasMany(Feedback::class);
    }

    public function views(): HasMany
    {
        return $this->hasMany(ProductView::class);
    }

    public function impressions(): HasMany
    {
        return $this->hasMany(ProductImpression::class);
    }
}
