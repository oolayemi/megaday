<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Services\Enums\ProviderEnum;
use App\Services\Traits\Auth\RegisterTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use RegisterTrait;

    public function registerWithEmail(RegisterRequest $request): JsonResponse
    {
        $data = $request->all();
        return self::register($data);
    }

    public function sendResendOtp(): JsonResponse
    {
        return $this->resendOtp();
    }

    public function registerWithGoogle(Request $request): JsonResponse
    {
        \Log::channel('slack')->info("request login with google", $request->all());
        $request->validate([
            'token' => ['required', 'string'],
            'fcm_token' => ['nullable', 'string'],
        ]);

        $data = $request->all();

        return self::socialSignIn(ProviderEnum::google, $data);
    }

    public function registerWithFacebook(Request $request): JsonResponse
    {
        $request->validate([
            'token' => ['required', 'string'],
            'fcm_token' => ['nullable', 'string'],
        ]);

        $data = $request->all();

        return self::socialSignIn(ProviderEnum::facebook, $data);
    }

    public function registerWithApple(Request $request): JsonResponse
    {
        $request->validate([
            'token' => ['required', 'string'],
            'fcm_token' => ['nullable', 'string'],
        ]);

        $data = $request->all();

        return self::socialSignIn(ProviderEnum::apple, $data);
    }
}
