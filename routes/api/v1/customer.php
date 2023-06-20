<?php
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\MainController;
use App\Http\Controllers\Api\V1\CustomerAddressController;
use App\Http\Controllers\Api\V1\ProductController;
use App\Http\Controllers\Api\V1\OrderController;

Route::group(['prefix' => 'auth', 'as' => 'customer.'], function () {
    Route::post('/login-register',  [AuthController::class, 'loginOrRegister']);
    Route::post('/verify-login-code', [AuthController::class, 'verifyMobileLogin']);
    Route::post('/resend-verify-code', [AuthController::class, 'resendVerifyCode']);
    Route::group(['middleware' => ['auth:customer', 'scopes:customer', 'jsonify']], function () {
        Route::get('/logout', [AuthController::class, 'logout']);
    });
Route::post('update-tamara',[OrderController::class, 'updatetamara']);

});
Route::group(['middleware' => ['auth:customer', 'scopes:customer', 'jsonify'],'as' => 'customer.'], function () {

    Route::get('/get-customer-notification', [MainController::class,'getCustomerNotfications']);
    Route::get('/clear-notifications', [AuthController::class,'clearCustomerNotification']);
    Route::post('/delete-notification', [AuthController::class,'deleteSingleNotification']);
    Route::post('/delete-user', [AuthController::class,'deleteUser']);
    Route::post('/update-profile',[AuthController::class, 'updateProfile']);
    Route::get('/my-data',[AuthController::class, 'myData']);
    Route::post('/convert-points-to-cash',[AuthController::class, 'convertPointToCash']);
    // customer address
    Route::group(['prefix'=>'address'],function(){
        Route::post('/add',[CustomerAddressController::class, 'store']);
        Route::post('/delete',[CustomerAddressController::class, 'delete']);
    });

    // customer product
    Route::group(['prefix' =>'product','as'=>'product.'], function () {
        Route::post('/add-remove-product-wishlist',  [ProductController::class, 'addRemoveProductWishlist']);
        Route::get('/favorite-list',  [ProductController::class, 'favoriteList']);

    });
    // customer orders
    Route::group(['prefix' =>'order','as'=>'order.'], function () {
        Route::post('place',[OrderController::class, 'placeOrder']);
        Route::post('place-new',[OrderController::class, 'placeOrderNew']);
        Route::post('confirm-payment',[OrderController::class, 'confirmOrder']);
        Route::post('update-tamara',[OrderController::class, 'updatetamara']);
        Route::get('list',[OrderController::class, 'myOrders']);
        Route::get('get-order-details',[OrderController::class, 'getOrderDetails']);
        Route::post('cancel-order',[OrderController::class, 'cancelOrder']);
        Route::post('return-product',[OrderController::class, 'returnProduct']);

    });



});
Route::group(['prefix' =>'apple','as'=>'apple.'], function () {
    Route::get('/{transaction}/pay-form',[\App\Http\Controllers\ApplePaymentController::class, 'startPayment'])->name('form');
    Route::post('/pay-form',[\App\Http\Controllers\ApplePaymentController::class, 'index'])->name('action');
//    Route::post('/{order}/action',[\App\Http\Controllers\Api\V1\ApplePayController::class, 'pay'])->name('action');
});

Route::get('/success-payment',[\App\Http\Controllers\Api\V1\OrderController::class, 'successPayment'])->name('order.success.payment');
Route::get('/apple-pay-success-payment',[\App\Http\Controllers\Api\V1\OrderController::class, 'applePaySuccessPayment'])->name('order.success.apple.pay.payment');
Route::get('/failed-payment',[\App\Http\Controllers\Api\V1\OrderController::class, 'failedPayment'])->name('payment.fail');
