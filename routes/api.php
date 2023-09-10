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
use App\Http\Controllers\OfferController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserController;
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

    Route::prefix('store')->group(function () {
        Route::post('{userId}', [StoreController::class, 'userStorePage']);
    });

    Route::middleware(['auth:sanctum', 'role:customer'])->group(function () {
        Route::prefix('products')->group(function () {
            Route::post('add', [ProductController::class, 'store']);
            Route::get('view/{id}', [ProductController::class, 'show']);
            Route::post('view-by-deals', [ProductController::class, 'showBySuperDeal']);
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

        Route::prefix('offers')->group(function () {
            Route::post('make', [OfferController::class, 'makeOffer']);
        });

        Route::prefix('user')->group(function () {
            Route::prefix('profile')->group(function () {
                Route::get('', [UserController::class, 'profile']);
                Route::prefix('my-adverts')->group(function () {
                    Route::get('{status}', [UserController::class, 'myAdverts']);
                    Route::get('mark-as-sold/{productId}', [UserController::class, 'markAsSold']);
                    Route::get('delete/{productId}', [UserController::class, 'deleteProduct']);
                });
                Route::get('feedbacks', [UserController::class, 'feedbacks']);
                Route::get('wallet', [UserController::class, 'wallet']);
                Route::get('performance', [UserController::class, 'performance']);
                Route::get('subscriptions', [UserController::class, 'subscriptions']);
            });
            Route::get('delete-account', [UserController::class, 'deleteAccount']);
        });

    });

});
