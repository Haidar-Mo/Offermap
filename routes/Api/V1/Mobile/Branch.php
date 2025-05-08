<?php

use App\Enums\TokenAbility;
use App\Http\Controllers\Api\Mobile\BranchController;
use Illuminate\Support\Facades\Route;


Route::prefix('branch/')
    ->middleware([
        'auth:sanctum',
        'ability:' . TokenAbility::ACCESS_API->value
    ])->group(function () {

        Route::get('index/{id}', [BranchController::class, 'index']);
        Route::get('show/{id}', [BranchController::class, 'show']);
        Route::post('create', [BranchController::class, 'store']);
        Route::post('update/{id}', [BranchController::class, 'update']);
        Route::delete('delete/{id}', [BranchController::class, 'destroy']);
    });