<?php

namespace App\Services\Traits\Auth;

use App\Models\User;
use App\Services\Actions\OtpAction;
use App\Services\Enums\ProviderEnum;
use App\Services\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;
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

        $dataToken = ['token' => $user->createToken($userDetails['email'])->plainTextToken];

        return ApiResponse::success('Account created successfully', $dataToken);

    }

    protected function createAccount(array $userDetails): User
    {
        $user = User::create($userDetails);
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
                'fcm_token' => $tokenDetails['fcm_token'] ?? null
            ];

            $this->createAccount($data);

            $dataToken = ['token' => $user->createToken($generatedUser->getEmail())];
            return ApiResponse::success('Account created successfully', $dataToken);
        } elseif ($user->provider == $providerEnum->name){
            $loginData = [
                'email' => $generatedUser->getEmail(),
                'fcm_token' => $tokenDetails['fcm_token'] ?? null
            ];
            return self::login($loginData, $providerEnum);
        } else {
            return ApiResponse::failed("An account with this email already exist");
        }
    }
}
