<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Offer extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['user_id', 'seller_user_id', 'product_id', 'amount'];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function seller(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'seller_user_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
