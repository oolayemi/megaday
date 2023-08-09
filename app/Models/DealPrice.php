<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DealPrice extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'deal_id', 'amount', 'duration_value', 'duration'
    ];

    protected $casts = [
        'duration_value' => 'integer',
    ];

    protected $hidden = ['deal_id', 'created_at', 'updated_at'];

    public function amount(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => floatval($value) / 100,
            set: fn ($value) => floatval($value) * 100
        );
    }

    public function deal(): BelongsTo
    {
        return $this->belongsTo(Deal::class);
    }
}
