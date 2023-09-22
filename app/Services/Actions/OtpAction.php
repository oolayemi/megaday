<?php

namespace App\Services\Actions;

use App\Models\Otp;
use Illuminate\Support\Carbon;

class OtpAction
{
    public function generateOtp(string $userId): void
    {
//            $otp = str_pad(strval(rand(1000, 999999)), 6, '0', STR_PAD_LEFT);
            $otp = str_pad(strval(123456), 6, '0', STR_PAD_LEFT);

            Otp::query()->updateOrCreate(
                ['user_id' => $userId],
                ['code' => $otp, 'is_used' => false, 'expires_at' => Carbon::now()->addMinutes(5)]);
    }
}
