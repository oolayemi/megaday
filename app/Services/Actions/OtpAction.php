<?php

namespace App\Services\Actions;

use App\Models\Otp;
use Illuminate\Support\Carbon;

class OtpAction
{
    public function generateOtp(string $userId): bool
    {
        try {
            $otp = str_pad(strval(rand(1000, 999999)), 6, '0', STR_PAD_LEFT);

            Otp::query()->updateOrCreate(
                ['user_id' => $userId],
                ['otp' => $otp, 'is_used' => false, 'expires_at' => Carbon::now()->addMinute()]);

            return true;

        } catch (\Exception $e) {
            return false;
        }
    }
}
