<?php

use App\Enums\TokenAbility;
use App\Http\Controllers\Api\Mobile\Vendor\PlanAndSubscriptionController;
use Illuminate\Support\Facades\Route;


Route::prefix('subscriptions')
    ->middleware([
        'auth:sanctum',
        'ability:' . TokenAbility::ACCESS_API->value
    ])
    ->group(function () {

        Route::get('index/plans', [PlanAndSubscriptionController::class, 'indexPlans']);
        Route::get('show/plan/{id}', [PlanAndSubscriptionController::class, 'showPlan']);
        Route::get('show/current/subscription', [PlanAndSubscriptionController::class, 'showSubscription']);
        Route::post('create/{id}', [PlanAndSubscriptionController::class, 'subscribeToPlan']);
    });