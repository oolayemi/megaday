<?php

namespace App\Models;

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

    public function superDeal(): BelongsTo
    {
        return $this->belongsTo(SuperDeal::class);
    }

    public function prices(): HasMany
    {
        return $this->hasMany(DealPrice::class);
    }
}
