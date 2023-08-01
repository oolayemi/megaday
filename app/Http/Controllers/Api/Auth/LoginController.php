<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\Enums\ProviderEnum;
use App\Services\Traits\Auth\LoginTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use LoginTrait;
    public function emailLogin(LoginRequest $request): JsonResponse
    {
        return self::login($request->all(), ProviderEnum::email);
    }
}
