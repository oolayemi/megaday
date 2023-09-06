<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class VirtualAccount extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id', 'account_number', 'account_email', 'account_reference', 'account_name', 'bank_name',
    ];

    /**
     * A user has a wallet
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
