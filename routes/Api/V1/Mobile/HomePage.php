<?php

use App\Enums\TokenAbility;
use App\Http\Controllers\Api\Mobile\HomePageController;
use Illuminate\Support\Facades\Route;

Route::prefix('homepage/')
    ->middleware([
        'auth:sanctum',
        'ability:' . TokenAbility::ACCESS_API->value
    ])
    ->group(function () {

        Route::get('branches/nearby', [HomePageController::class, 'getNearbyBranches']);
        Route::get('advertisements/branch/{id}', [HomePageController::class, 'getBranchAdvertisements']);
        Route::get('show/advertisement/{id}', [HomePageController::class, 'getAdvertisementDetails']);
        Route::get('similar/advertisement/{id}', [HomePageController::class, 'getSimilarAdvertisement']);

        Route::post('order/advertisement/{id}', [HomePageController::class, 'orderAdvertisement']);
    });