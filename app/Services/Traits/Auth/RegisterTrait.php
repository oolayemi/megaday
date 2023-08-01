<?php

namespace App\Services\Traits\Auth;

use App\Models\User;
use App\Services\Actions\OtpAction;
use App\Services\Enums\ApiResponseEnum;
use App\Services\Enums\ProviderEnum;
use App\Services\Helpers\ApiResponse;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

trait RegisterTrait
{

    public function register(array $userDetails): \Illuminate\Http\JsonResponse
    {
        $user = $this->createAccount($userDetails);

        //send otp
        $otpAction = resolve(OtpAction::class);
        $otpAction->generateOtp($user->id);

        //send email verification mail

        $dataToken = ['token' => $user->createToken($userDetails['email'])];
        return ApiResponse::success("Account created successfully", $dataToken);

    }


    /**
     * @param array $userDetails
     * @return User
     */
    protected function createAccount(array $userDetails): User
    {
//        [
//            'first_name' => $userNames[0],
//            'last_name' => $userNames[1],
//            'email' => $userGenerated->getEmail(),
//            'image_url' => $userGenerated->getAvatar(),
//            'fcm_token' => $request->fcm_token,
//            'provider' => $request->provider
//        ]
        $user = User::create($userDetails);
        $user->wallet()->create();
        $user->assignRole('customer');

        return $user;
    }

    //social sign ins
    public function socialSignIn(ProviderEnum $providerEnum, array $userDetails) {
        $generatedUser = Socialite::driver($providerEnum->name)->userFromToken($userDetails['token']);
        if (!$generatedUser) {
            return ApiResponse::failed("An error occurred with $providerEnum->name sign in", );
        }

        $user = User::query()
            ->where('email', $generatedUser->getEmail())
            ->first();

//        if (!$user || $user->provider != $providerEnum->name)

    }

}
