<?php

use App\Enums\TokenAbility;
use App\Http\Controllers\Api\Mobile\Auth\RegistrationController;
use App\Http\Controllers\Api\Mobile\Auth\AuthenticationController;
use App\Http\Controllers\Api\Mobile\Auth\ResetPasswordController;
use App\Http\Controllers\Api\Mobile\Auth\SocialiteController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


Route::prefix('auth/')->group(function () {

    //** Socialite Routes
    Route::post('social/{provider}', [SocialiteController::class, 'loginWithSocial']);


    //** Email Routes
    Route::post('register', [RegistrationController::class, 'create']);
    Route::post('confirm-email', [RegistrationController::class, 'verifyEmail']);
    Route::post('resend-verification-code', [RegistrationController::class, 'resendVerificationCode']);
    Route::post('information-fill', [RegistrationController::class, 'informationRegistration'])->middleware([
        'auth:sanctum',
        'ability:' . TokenAbility::ACCESS_API->value
    ]);

    Route::post('send-reset-code', [ResetPasswordController::class, 'sendResetCode']);
    Route::post('verify-reset-code', [ResetPasswordController::class, 'verifyResetCode']);
    Route::post('reset-password', [ResetPasswordController::class, 'resetPassword']);

    Route::post('login', [AuthenticationController::class, 'create']);

    Route::post('logout', [AuthenticationController::class, 'delete'])->middleware([
        'auth:sanctum',
        'ability:' . TokenAbility::ACCESS_API->value
    ]);

    Route::post('refresh-token', [AuthenticationController::class, 'refreshToken'])->middleware([
        'auth:sanctum',
        'ability:' . TokenAbility::ISSUE_ACCESS_TOKEN->value
    ]);

    Route::middleware([
        'auth:sanctum',
        'ability:' . TokenAbility::ACCESS_API->value,
    ])->get('check-token', function (Request $request) {
        return response()->json([
            'success' => true,
            'message' => 'Token is valid',
            'user' => $request->user(),
        ]);
    });


});