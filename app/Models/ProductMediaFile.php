<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductMediaFile extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'product_id',
        'path',
        'thumbnail_path',
        'media_type',
        'is_featured',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
