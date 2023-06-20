<?php

use App\Http\Controllers\Api\V1\MainController;
use App\Http\Controllers\Api\V1\ProductController;
use App\Http\Controllers\Api\V1\StoreController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Controller;

Route::group(['middleware' => ['jsonify']], function () {
    Route::post('/update-fcm-token', [MainController::class, 'updateFcmToken'])->name('update.fcm');
    Route::get('/categories-list', [MainController::class, 'categoriesList']);
    Route::get('/categories-spesific', [MainController::class, 'categoriesSpesific']);
    Route::get('/cities-list', [MainController::class, 'citiesList']);
    Route::get('/test-shipping', [MainController::class, 'testShipping']);
    Route::get('/payment-types', [MainController::class, 'paymentTypeList']);
    Route::post('/check-coupon', [MainController::class, 'checkCoupon']);
    Route::post('/check-promo', [MainController::class, 'checkPromoCode'])->middleware('auth:customer', 'scopes:customer', 'jsonify');
    Route::post('/test-sms', [MainController::class, 'testSms']);
    Route::get('/coupons-list', [MainController::class, 'couponsList']);
    Route::get('/send-test-notification', [MainController::class, 'sendTestNotification']);
    Route::get('/get-product-details', [ProductController::class, 'getProductById'])->name('api.product.details');
    Route::get('/slider-products', [ProductController::class, 'sliders']);
    Route::get('/home-products', [ProductController::class, 'homeProducts']);
    Route::get('/most-selling', [ProductController::class, 'mostSelling']);
    Route::get('/filter-products', [ProductController::class, 'filterProducts']);
    Route::get('/update-products-prices', [ProductController::class, 'updateProductsPrice']);
    Route::get('/app-settings', [MainController::class, 'appSettings']);
    Route::get('/trending-search', [MainController::class, 'trendingSearch']);
    Route::get('/trending-designer-search', [MainController::class, 'trendingDesignerSearch']);
    Route::get('/filter-settings', [MainController::class, 'filterSettings']);
    Route::get('/app-content', [MainController::class, 'appContent']);
    Route::post('/contact-us', [MainController::class, 'contactUs']);
    Route::get('/designers-list', [StoreController::class, 'getDesigners']);
    Route::get('/validateMarchent', [\App\Http\Controllers\ApplePaymentController::class, 'validateMarchent']);
    Route::get('/get-designer-with-products', [StoreController::class, 'getDesignerWithProducts']);

    Route::get('/cities-list', [\App\Http\Controllers\Api\V1\CustomerAddressController::class, 'citiesList']);


    Route::get('/offers', [ProductController::class, 'offers']);

    Route::get('success_tamara', [CheckoutController::class, 'success_tamaraapi'])->name('success_tamara');
    Route::get('failure_tamara', [CheckoutController::class, 'failure_tamara'])->name('failure_tamara');
    Route::get('cancel_tamara', [CheckoutController::class, 'cancel_tamara'])->name('cancel_tamara');
    Route::get('notification_tamara', [CheckoutController::class, 'notification_tamara'])->name('notification_tamara');



    //


    //    Route::prefix('store')->group(function(){
    //            Route::get('/all','StoreController@all')->name('api.store.list');
    //            Route::get('/details','StoreController@getDetails')->name('api.store.details');
    //    });
});
