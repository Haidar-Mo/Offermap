<?php

use App\Http\Controllers\Api\Mobile\HomePageController;
use Illuminate\Support\Facades\Route;

Route::prefix('homepage/')
    ->middleware([])
    ->group(function () {

        Route::get('branches/nearby', [HomePageController::class, 'getNearbyBranches']);
        Route::get('advertisements/branch/{id}', [HomePageController::class, 'getBranchAdvertisements']);
        Route::get('show/advertisement/{id}', [HomePageController::class, 'getAdvertisementDetails']);

        Route::post('order/advertisement/{id}', [HomePageController::class, 'orderAdvertisement']);
    });