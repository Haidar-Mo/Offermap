<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::prefix('v1/')->group(function () {

    //! Dashboard section

    Route::prefix('dashboard')->group(function () {

    });


    //! Mobile section

    Route::prefix('mobile')->group(function () {
        include __DIR__ . "/Api/V1/Mobile/Auth.php";

    });
});
