<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Deal extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'super_deal_id', 'category_id', 'name', 'selected_ads',
        'auto_renewal', 'visibility', 'notifications', 'promotions',
        'consultations', 'reports', 'feedbacks',
    ];

    protected $casts = [
        'selected_ads' => 'integer',
        'auto_renewal' => 'integer',
        'notifications' => 'boolean',
        'promotions' => 'boolean',
        'consultations' => 'boolean',
        'reports' => 'boolean',
        'feedbacks' => 'boolean',
    ];

    protected $hidden = ['super_deal_id', 'category_id', 'created_at', 'updated_at'];

    public function selectedAds(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value == null || $value == 0 ? "Unlimited" : sprintf('%s %s', $value, 'Ads'),
        );
    }

    public function autoRenewal(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value == null || $value == 0 ? "0" : sprintf('%s %s', $value, 'Hour(s)'),
        );
    }



    public function superDeal(): BelongsTo
    {
        return $this->belongsTo(SuperDeal::class);
    }

    public function prices(): HasMany
    {
        return $this->hasMany(DealPrice::class);
    }
}
