<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::prefix('v1/')->group(function () {

    //! Dashboard section

    Route::prefix('dashboard')->group(function () {
        include __DIR__ . "/Api/V1/Dashboard/Auth.php";
        include __DIR__ . "/Api/V1/Dashboard/Notification.php";
    });


    //! Mobile section

    Route::prefix('mobile')->group(function () {
        include __DIR__ . "/Api/V1/Mobile/Auth.php";

    });
});
