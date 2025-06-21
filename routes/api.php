<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::prefix('v1/')->group(function () {

    //! Dashboard section

    Route::prefix('dashboard/')->group(function () {
        include __DIR__ . "/Api/V1/Dashboard/Auth.php";
        include __DIR__ . "/Api/V1/Dashboard/Notification.php";
        include __DIR__ . "/Api/V1/Dashboard/PendinNotification.php";
        include __DIR__ . "/Api/V1/Dashboard/Plan.php";
        include __DIR__ . "/Api/V1/Dashboard/User.php";
        include __DIR__ . "/Api/V1/Dashboard/Delar.php";
        include __DIR__ . "/Api/V1/Dashboard/Ads.php";
    });


    //! Mobile section

    Route::prefix('mobile/')->group(function () {
        include __DIR__ . "/Api/V1/Mobile/Auth.php";
        include __DIR__ . "/Api/V1/Mobile/HomePage.php";

        Route::prefix('vendor/')->group(function () {

            include __DIR__ . "/Api/V1/Mobile/vendor/Branch.php";
            include __DIR__ . "/Api/V1/Mobile/vendor/Store.php";
            include __DIR__ . "/Api/V1/Mobile/vendor/advertisement.php";
            include __DIR__ . "/Api/V1/Mobile/vendor/order.php";
            include __DIR__ . "/Api/V1/Mobile/vendor/PlanAndSubscription.php";

        });

    });
});
