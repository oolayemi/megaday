<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('login-with-email', [LoginController::class, 'emailLogin']);
        Route::post('register-with-email', [RegisterController::class, 'registerWithEmail']);
        Route::post('register-with-google', [RegisterController::class, 'registerWithGoogle']);
        Route::post('register-with-facebook', [RegisterController::class, 'registerWithFacebook']);
        Route::post('register-with-apple', [RegisterController::class, 'registerWithApple']);
    });
});
