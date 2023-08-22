<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subscription extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['user_id', 'deal_id', 'deal_price_id', 'expires_at'];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'user_id', 'deal_id', 'deal_price_id', 'expires_at'
    ];

    protected $appends = ['is_subscription_valid'];

    protected function isSubscriptionValid(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->expires_at->greaterThan(Carbon::now()),
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(HasMany::class);
    }

    public function deal(): BelongsTo
    {
        return $this->belongsTo(Deal::class);
    }

    public function dealPrice(): BelongsTo
    {
        return $this->belongsTo(DealPrice::class);
    }
}
