<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\DealController;
use App\Http\Controllers\Api\FeedbackController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SubCategoryController;
use App\Http\Controllers\Api\SubscriptionController;
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

    Route::prefix('category')->group(function () {
        Route::get('all', [CategoryController::class, 'index']);
        Route::post('add', [CategoryController::class, 'store']);
        Route::get('show/{id}', [CategoryController::class, 'show']);
        Route::put('update/{id}', [CategoryController::class, 'update']);
        Route::delete('delete/{id}', [CategoryController::class, 'destroy']);
    });

    Route::prefix('sub-category')->group(function () {
        Route::get('all', [SubCategoryController::class, 'index']);
        Route::post('add', [SubCategoryController::class, 'store']);
        Route::get('show/{id}', [SubCategoryController::class, 'show']);
        Route::put('update/{id}', [SubCategoryController::class, 'update']);
        Route::delete('delete/{id}', [SubCategoryController::class, 'destroy']);
    });

    Route::prefix('deals')->group(function () {
        Route::get('all', [DealController::class, 'index']);
        Route::get('show/{id}', [DealController::class, 'show']);
        Route::delete('delete/{id}', [DealController::class, 'destroy']);
    });

    Route::middleware(['auth:sanctum', 'role:customer'])->group(function () {
        Route::prefix('products')->group(function () {
            Route::post('add', [ProductController::class, 'store']);
            Route::get('view/{id}', [ProductController::class, 'show']);
        });

        Route::prefix('subscriptions')->group(function () {
           Route::get('', [SubscriptionController::class, 'index']);
           Route::post('subscribe', [SubscriptionController::class, 'store']);
        });

        Route::prefix('dashboard')->group(function () {
           Route::post('', DashboardController::class);
        });

        Route::prefix('feedbacks')->group(function () {
            Route::post('add', [FeedbackController::class, 'store']);
        });
    });

});
