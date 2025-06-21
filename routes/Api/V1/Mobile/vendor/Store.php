<?php

use App\Enums\TokenAbility;
use App\Http\Controllers\Api\Mobile\Vendor\StoreController;
use Illuminate\Support\Facades\Route;


Route::prefix('store/')
    ->middleware([
        'auth:sanctum',
        'ability:' . TokenAbility::ACCESS_API->value
    ])
    ->group(function () {

        Route::get('show', [StoreController::class, 'show']);
        Route::post('create', [StoreController::class, 'store']);
        Route::post('update', [StoreController::class, 'update']);
        Route::delete('delete', [StoreController::class, 'destroy']);
    });