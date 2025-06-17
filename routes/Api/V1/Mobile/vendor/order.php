<?php

use App\Enums\TokenAbility;
use App\Http\Controllers\Api\Mobile\Vendor\OrderController;
use Illuminate\Support\Facades\Route;


Route::prefix('orders')
    ->middleware([
        'auth:sanctum',
        'ability:' . TokenAbility::ACCESS_API->value
    ])
    ->group(function () {

        Route::get('index', [OrderController::class, 'indexAllOrders']);
        Route::get('index/branch/{id}', [OrderController::class, 'indexBranchOrders']);
        Route::get('show/{id}', [OrderController::class, 'show']);

        Route::post('accept/{id}', [OrderController::class, 'accept']);
        Route::post('reject/{id}', [OrderController::class, 'reject']);

        Route::delete('delete', [OrderController::class, 'destroy']);
    });