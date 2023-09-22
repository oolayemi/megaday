<?php

namespace App\Services\Traits\Auth;

use App\Helpers\Helper;
use App\Models\Otp;
use App\Models\User;
use App\Notifications\EmailVerificationCode;
use App\Services\Actions\OtpAction;
use App\Services\Enums\ProviderEnum;
use App\Services\Helpers\ApiResponse;
use Carbon\Carbon;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

trait RegisterTrait
{
    use LoginTrait;

    public function register(array $userDetails): JsonResponse
    {
        $userDetails['provider'] = ProviderEnum::email->name;
        $user = $this->createAccount($userDetails);

        //send otp
        $otpAction = resolve(OtpAction::class);
        $otpAction->generateOtp($user->id);

        //send email verification mail
//        $user->notify(new EmailVerificationCode());

        $dataToken = ['token' => $user->createToken($userDetails['email'])->plainTextToken];

        return ApiResponse::success('Account created successfully', $dataToken);

    }

    public function resendOtp(): JsonResponse
    {
        $user = \request()->user();

        $otpAction = resolve(OtpAction::class);
        $otpAction->generateOtp($user->id);

        //send email verification mail
//        $user->notify(new EmailVerificationCode());

        return ApiResponse::success('OTP resent successfully');
    }

    public function verifyOtp(Request $request, $otp): JsonResponse
    {
        $user = $request->user();

        $checkOtp = Otp::where('user_id', $user->id)->first();
        if ($checkOtp->is_used || $checkOtp->expires_at < Carbon::now() || $checkOtp->code != $otp) {
            return ApiResponse::failed('The provided otp is invalid');
        } else {
            $user->markEmailAsVerified();
            $checkOtp->update(['is_used' => true]);
            event(new Verified($user));
            return ApiResponse::success('Email has been verified successfully');
        }
    }

    protected function createAccount(array $userDetails): User
    {
        $user = User::create($userDetails);
        $user->virtualAccount()->create([
            'account_name' => $user->firstname . " " . $user->lastname,
            'account_number' => rand(1000000000, 9999999999),
            'bank_name' => 'Test Bank',
            'account_email' => $user->email,
            'account_reference' => \Str::random(17),
        ]);
        $user->wallet()->create();
        $user->assignRole('customer');

        return $user;
    }

    //social sign ins
    public function socialSignIn(ProviderEnum $providerEnum, array $tokenDetails): JsonResponse
    {
        $generatedUser = Socialite::driver($providerEnum->name)->userFromToken($tokenDetails['token']);
        if (!$generatedUser) {
            return ApiResponse::failed("An error occurred with $providerEnum->name sign in");
        }

        $user = User::query()
            ->where('email', $generatedUser->getEmail())
            ->first();

        if (!$user?->exists()) {
            $userNames = explode(' ', $generatedUser->getName());
            $data = [
                'firstname' => $userNames[0],
                'lastname' => $userNames[1] ?? '',
                'email' => $generatedUser->getEmail(),
                'email_verified_at' => now(),
                'provider' => $providerEnum->name,
                'image_url' => $generatedUser->getAvatar() ?? null,
                'fcm_token' => $tokenDetails['fcm_token'] ?? null,
            ];

            $this->createAccount($data);

            $dataToken = ['token' => $user->createToken($generatedUser->getEmail())];

            return ApiResponse::success('Account created successfully', $dataToken);
        } elseif ($user->provider == $providerEnum->name) {
            $loginData = [
                'email' => $generatedUser->getEmail(),
                'fcm_token' => $tokenDetails['fcm_token'] ?? null,
            ];

            return self::login($loginData, $providerEnum);
        } else {
            return ApiResponse::failed('An account with this email already exist');
        }
    }
}
