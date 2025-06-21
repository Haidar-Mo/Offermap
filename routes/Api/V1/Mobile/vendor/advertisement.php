<?php

use App\Enums\TokenAbility;
use App\Http\Controllers\Api\Mobile\Vendor\AdvertisementController;
use Illuminate\Support\Facades\Route;


Route::prefix('advertisements/')
    ->middleware([
        'auth:sanctum',
        'ability:' . TokenAbility::ACCESS_API->value
    ])
    ->group(function () {

        Route::get('index', [AdvertisementController::class, 'index']);
        Route::get('show/{id}', [AdvertisementController::class, 'show']);
        Route::post('create', [AdvertisementController::class, 'store']);
        Route::post('update/{id}', [AdvertisementController::class, 'update']);
        Route::delete('delete/{id}', [AdvertisementController::class, 'destroy']);
    });