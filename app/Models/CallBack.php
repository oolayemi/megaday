<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CallBack extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'user_id', 'name', 'phone', 'product_id', 'is_read'
    ];

    protected $casts = ['is_read' => 'boolean'];

    protected $hidden = ['created_at', 'updated_at', 'product_id', 'user_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
