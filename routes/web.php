<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


use App\Http\Controllers\BalanceController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategorySpecialController;
use App\Http\Controllers\ClosureController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\ClothesController;
use App\Http\Controllers\StyleController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HyperPayController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\OrderCasesController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\Password\UserPasswordController;
use App\Http\Controllers\PaymentTypesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\PayoutController;
use App\Http\Controllers\TranslationController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\Auth\SystemAdminLoginController;
use App\Http\Controllers\SystemAdminController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\AdminsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\GovController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ApplePaymentController;
use App\Http\Controllers\TracePaymentController;


// fjksjfg
// adfjkdsjkg

Route::get('user/password/reset/{token}', [UserPasswordController::class, 'showResetForm'])->name('user.password.reset-form');
Route::post('user/password/reset', [UserPasswordController::class, 'reset'])->name('user.password.reset');

/////////////////////old landing page

// Route::get('/', [WebsiteController::class, 'gotoIndex'])->name('website.home2');
// Route::get('home', [WebsiteController::class, 'index'])->name('website.home');
// Route::post('/contact_us', [WebsiteController::class, 'contactUs'])->name('website.do.contact');

// Route::get('/page/{id}', [WebsiteController::class, 'show_page'])->name('website.page');
// Route::get('activate_als', [WebsiteController::class, 'do_activate'])->middleware('guest')->name('web.activate');
// Route::get('blocked', [WebsiteController::class, 'blocked'])->middleware('guest')->name('web.blocked');
// Route::get('activate', [WebsiteController::class, 'do_activate'])->middleware('guest')->name('website.activate');
// Route::post('do/activate', [WebsiteController::class, 'doactivate'])->middleware('guest')->name('website.do.activate');
// Route::get('/activity/{name}/{id}', [WebsiteController::class, 'show_activity'])->name('website.activity');
// Route::post('/addActivity', [WebsiteController::class, 'do_activity'])->name('website.do.activity');

//////////dummy front

// Route::post("/filter", [AjaxController::class, 'filter'])->name('filter');
// Route::get('checkout', [CheckoutController::class, 'checkout'])->name('checkout');
// Route::post('payment_method', [CheckoutController::class, 'payment_method'])->name('payment_method');
// Route::get('tabby', [CheckoutController::class, 'tabby'])->name('tabby');
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        Route::post('applepayindex', [ApplePaymentController::class, 'index'])->name('applepayindex');
        Route::get('/findCity/{id}', [WebController::class, 'findcity'])->name('findCity');
        Route::get('/', [WebController::class, 'home'])->name('home');
        // Route::get('/about', [WebController::class, 'about'])->name('about');
        Route::get('/terms', [WebController::class, 'terms'])->name('terms');
        Route::get('/privacy', [WebController::class, 'privacy'])->name('privacy');
        Route::get('/contact', [WebController::class, 'contact'])->name('contact');
        Route::post('/send_msg', [WebController::class, 'send_msg'])->name('send_msg');
        Route::get('/search', [WebController::class, 'search'])->name('search');
        Route::get('/login', [AuthController::class, 'login'])->name('login');
        Route::get('/website_login', function () {
            return redirect()->route('login');
        })->name('website.login');
        Route::get('/verify', [AuthController::class, 'verify'])->name('verify');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::post('/loginRegister', [AuthController::class, 'loginRegister'])->name('loginRegister');
        Route::post('/verifyLogin', [AuthController::class, 'verifyLogin'])->name('verifyLogin');
        Route::post('/resendVerifyCode', [AuthController::class, 'resendVerifyCode'])->name('resendVerifyCode'); 

        Route::get('/single_product/{id}', [WebController::class, 'single_product'])->name('single_product');
        Route::get('/table_size', [WebController::class, 'table_size'])->name('table_size'); 
        Route::get('/stores', [WebController::class, 'stores'])->name('stores');
        Route::get('/store/{id}', [WebController::class, 'store'])->name('store');
        Route::get('/most_selling', [WebController::class, 'most_sell'])->name('most_sell');
        Route::get('/special_products', [WebController::class, 'special'])->name('special');
        Route::get('/order/{id}', [WebController::class, 'single_order'])->name('single_order');
        Route::get('/cat/{id}', [WebController::class, 'cat'])->name('cat');

        Route::get('/add_to_fav/{id}', [WebController::class, 'add_to_fav'])->name('add_to_fav');
        Route::get('/favs', [WebController::class, 'favs'])->name('favs');
        /////////////////////////new filter
        // Route::get('/old-products', 'FilterController@index')->name('web.products');
        Route::get('/products', 'FilterController@index')->name('web.products');
        Route::get('filter', 'FilterController@faceted');

        Route::post('load-cat', 'FilterController@loadCat');
        Route::post('load-brand', 'FilterController@loadBrand');
        Route::post('load-type', 'FilterController@loadType');
        Route::post('load-color', 'FilterController@loadColor');
        Route::post('load-offer', 'FilterController@loadOffer');
        /////////////////////////////////

        ///////////////////Cart
        Route::get('cart', [WebController::class, 'cart'])->name('cart');
        Route::post('add_to_cart', [WebController::class, 'addToCart'])->name('add_to_cart');
        Route::post('update_cart', [WebController::class, 'update'])->name('update_cart');
        Route::post('remove_from_cart', [WebController::class, 'remove'])->name('remove_from_cart');
        Route::get('/checkout', [checkoutController::class, 'checkout'])->name('checkout');
        Route::post('/payment', [checkoutController::class, 'payment'])->name('payment');

        Route::post('/check-coupon', [WebController::class, 'checkCoupon'])->name('checkCoupon');

        Route::get('profile', [ProfileController::class, 'profile'])->name('profile');
        Route::post('update_profile', [ProfileController::class, 'updateProfile'])->name('update_profile');
        Route::post('delete_address', [ProfileController::class, 'deleteaddress'])->name('deleteaddress');
        Route::post('add_address', [ProfileController::class, 'addaddress'])->name('addaddress');
        Route::post('edit_address', [ProfileController::class, 'editaddress'])->name('editaddress');


        Route::get('success_tabby', [checkoutController::class, 'success_tabby'])->name('success_tabby');
        Route::get('failure_tabby', [checkoutController::class, 'failure_tabby'])->name('failure_tabby');
        Route::get('cancel_tabby', [checkoutController::class, 'cancel_tabby'])->name('cancel_tabby');

        Route::get('success_tamara', [checkoutController::class, 'success_tamara'])->name('web_success_tamara');
        Route::get('failure_tamara', [checkoutController::class, 'failure_tamara'])->name('web_failure_tamara');
        Route::get('cancel_tamara', [checkoutController::class, 'cancel_tamara'])->name('web_cancel_tamara');
        Route::get('notification_tamara', [checkoutController::class, 'notification_tamara'])->name('web_notification_tamara');

        Route::get('urway_response', [checkoutController::class, 'urway_response'])->name('urway_response');


        /////////////////////////new filter
        // Route::get('/products','FilterController@index')->name('web.products');
        // Route::get('filter','FilterController@faceted');

        // Route::post('load-cat','FilterController@loadCat');
        // Route::post('load-brand','FilterController@loadBrand');
        // Route::post('load-type','FilterController@loadType');
        // Route::post('load-color','FilterController@loadColor');
        // Route::post('load-offer','FilterController@loadOffer');
        ///////////////////////////////////
    }
);
// Route::get('products', [FilterController::class, 'index'])->name('web.products');

//===============================================================
//                 SYSTEM ADMIN ROUTES
//===============================================================
Route::prefix('admin/system')->group(function () {
    Route::get('/login', [SystemAdminLoginController::class, 'showLoginForm'])->middleware(['guest:system_admin'])->name('system_admin.showLogin');
    Route::post('/login', [SystemAdminLoginController::class, 'login'])->middleware(['guest:system_admin'])->name('system_admin.login');
    Route::get('/logout', [SystemAdminLoginController::class, 'logout'])->middleware(['auth:system_admin', 'active', 'delete_temp'])->name('system_admin.logout');
});

Route::prefix('admin/system')->group(function () {
    Route::get('/generalProperties', [SystemAdminController::class, 'generalProperties'])->name('system_admin.generalProperties');
    //    Route::view('/activation', 'system_admin.system_activation')->name('system_admin.activation');
    Route::post('/activate', [SystemAdminController::class, 'generalProperties'])->name('system_admin.activate');
});


Route::prefix('admin/system')->middleware(['auth:system_admin'])->group(function () {
    Route::get('/', [SystemAdminController::class, 'home'])->name('system_admin.dashboard');

    Route::prefix('settings')->group(function () {
        Route::get('', [SettingController::class, 'index'])->name('system.settings.index');
        Route::post('add', [SettingController::class, 'add'])->name('system.settings.add');
        Route::post('settingAboutUs', [SettingController::class, 'settingAboutUs'])->name('system.settings.settingAboutUs');
        Route::post('updateImage', [SettingController::class, 'updateImage'])->name('system.settings.updateImage');
        Route::post('addMedia', [SettingController::class, 'addMedia'])->name('system.settings.addMedia');
        Route::post('addShippingCost', [SettingController::class, 'addShippingCost'])->name('system.settings.addShippingCost');
        Route::post('addPoints', [SettingController::class, 'addPoints'])->name('system.settings.addPoints');
        Route::get('sys', [SettingController::class, 'system_settings'])->name('system.settings.system_settings');
        Route::post('export', [SettingController::class, 'exportDB'])->name('system.settings.exportDB');
        Route::post('trancateDB', [SettingController::class, 'trancateDB'])->name('system.settings.trancateDB');
        Route::get('reload_modules', [SettingController::class, 'reload_modules'])->name('system.settings.reload_modules');
    });

    //======================================================================================================
    //              Search log modules
    //======================================================================================================
    Route::prefix('search-log-designer/')->group(function () {
        Route::get('', [\App\Http\Controllers\SearchLogController::class, 'designerList'])->name('system.search.log.designer.index');
    });
    Route::prefix('search-log-products/')->group(function () {
        Route::get('', [\App\Http\Controllers\SearchLogController::class, 'productList'])->name('system.search.log.products.index');
    });
    Route::post('/delete-designer-search-log', [\App\Http\Controllers\SearchLogController::class, 'deleteDesignerKeyword'])->name('system.search.log.designer.destroy');
    Route::post('/delete-product-search-log', [\App\Http\Controllers\SearchLogController::class, 'deleteProductKeyword'])->name('system.search.log.product.destroy');

    //======================================================================================================
    //                 Splash settings
    //======================================================================================================

    Route::prefix('splash_settings/')->group(function () {
        Route::get('', [SettingController::class, 'splashSettingsView'])->name('system.splash.index');
        Route::post('update', [SettingController::class, 'updateSplashSettings'])->name('system.splash.update');
        Route::post('slider-product', [SettingController::class, 'updateSplashImage'])->name('system.splash.add.image');
        Route::post('delete', [SettingController::class, 'deleteSplashImage'])->name('system.splash.delete.image');
    });


    Route::prefix('about_us')->group(function () {
        Route::get('', [SettingController::class, 'getAbout'])->name('system.settings.getAbout');
        Route::post('about_us', [SettingController::class, 'postAbout'])->name('system.settings.postAbout');
    });

    Route::prefix('terms_and_conditions')->group(function () {
        Route::get('', [SettingController::class, 'getTerms'])->name('system.settings.getTerms');
        Route::post('terms_and_conditions', [SettingController::class, 'postTerms'])->name('system.settings.postTerms');
    });
    
    
     Route::prefix('trace_payment')->group(function () {
        Route::get('', [TracePaymentController::class, 'index'])->name('system.trace.index');
    });

    Route::prefix('privacy_and_policy')->group(function () {
        Route::get('', [SettingController::class, 'getPolicy'])->name('system.settings.getPolicy');
        Route::post('privacy_and_policy', [SettingController::class, 'postPolicy'])->name('system.settings.postPolicy');
    });


    Route::get('getNotifications', [SettingController::class, 'getNotifications'])->name('system_admin.get.notifications');
    Route::get('quick-search', [SettingController::class, 'quick-search'])->name('system_admin.quick-search');


    Route::prefix('sliders/')->group(function () {
        Route::get('', [\App\Http\Controllers\SliderImageController::class, 'index'])->name('system.slider.index');
        Route::post('', [\App\Http\Controllers\SliderImageController::class, 'store'])->name('system.slider.store');
        Route::post('delete', [\App\Http\Controllers\SliderImageController::class, 'delete'])->name('system.slider.destroy');
    });


    //=====================================================================================================
    //                   ADMIN ROUTRS
    //=====================================================================================================

    Route::prefix('admins/')->group(function () {
        Route::get('', [AdminsController::class, 'index'])->name('system.admin.index');
        Route::get('show_create', [AdminsController::class, 'showCreateView'])->name('system.admin.create');
        Route::post('create', [AdminsController::class, 'create'])->name('system.admin.do.create');
        Route::get('show_change_permission/{id}', [AdminsController::class, 'showPermissionView'])->name('system.admin.permission');
        Route::post('change_permission', [AdminsController::class, 'changePermission'])->name('system.admin.do.permission');
        Route::get('{id}/update', [AdminsController::class, 'showUpdateView'])->name('system.admin.update');
        Route::post('update/{id}', [AdminsController::class, 'Update'])->name('system.admin.do.update');
        Route::get('{id}/password', [AdminsController::class, 'showPasswordView'])->name('system.admin.password');
        Route::post('password/{id}', [AdminsController::class, 'password'])->name('system.admin.do.password');
        Route::post('delete', [AdminsController::class, 'delete'])->name('system.admin.delete');
        Route::post('update-fcm-token', [AdminsController::class, 'saveFcmToken'])->name('system.admin.update.fcm.token');
    });
    Route::prefix('profile')->group(function () {
        Route::get('', [AdminsController::class, 'showProfileView'])->name('system.admin.profile');
        Route::get('showpassword', [AdminsController::class, 'showProfilePasswordView'])->name('system.admin.profile.password');
        Route::post('updatepassword', [AdminsController::class, 'profilePassword'])->name('system.admin.do.profile.password');

        Route::post('do_update', [AdminsController::class, 'profile'])->name('system.admin.do.profile');
    });

    //======================================================================================================
    //                   Users Admin ROUTES
    //======================================================================================================
    /* Route::prefix('users/')->middleware(['checkRule:view,users'])->group(function () {
         Route::get('', [UserController::class, 'index'])->name('system.users.index');
         Route::get('show_create', [UserController::class, 'showCreateView'])->name('system.users.create');
         Route::post('create', [UserController::class, 'create'])->name('system.users.do.create');

         Route::get('{id}/update',[UserController::class, 'showUpdateView'])->name('system.users.update')->middleware(['checkRule:edit,users']);
         Route::get('{id}/view', [UserController::class, 'show'])->name('system.users.details');
         Route::get('addresses/{id}', [UserController::class, 'showUserAddresses'])->name('user.addresses');
         Route::post('delete',[UserController::class, 'delete'])->name('system.users.delete')->middleware(['checkRule:delete,users']);
         Route::post('activate', [UserController::class, 'activate'])->name('system.users.activate')->middleware(['checkRule:activate,users']);
         Route::post('deactivate', [UserController::class, 'deactivate'])->name('system.users.deactivate')->middleware(['checkRule:activate,users']);
     });*/


    //======================================================================================================
    //                   Users Admin ROUTES
    //======================================================================================================
    Route::prefix('users/')->group(function () {
        Route::get('', [CustomerController::class, 'index'])->name('system.users.index');
        Route::get('most_buying', [CustomerController::class, 'mostcustomers'])->name('system.users.mostcustomers');
        Route::get('{id}/view', [CustomerController::class, 'show'])->name('system.users.details');

        Route::post('delete', [CustomerController::class, 'delete'])->name('system.users.delete');
        Route::post('activate', [CustomerController::class, 'activate'])->name('system.users.activate');
        Route::post('deactivate', [CustomerController::class, 'deactivate'])->name('system.users.deactivate');
        Route::post('ban', [CustomerController::class, 'ban'])->name('system.users.ban');

        Route::post('change_status', [CustomerController::class, 'changeStatus'])->name('system.users.change_status');

        Route::get('{id}/view', [CustomerController::class, 'show'])->name('system.users.details');
        Route::get('addresses/{id}', [CustomerController::class, 'showUserAddresses'])->name('user.addresses');
        Route::post('wallet', [CustomerController::class, 'wallet'])->name('user.wallet');
    });

    //======================================================================================================
    //                   Balance  ROUTES
    //======================================================================================================
    Route::prefix('balance/')->group(function () {
        Route::get('', [BalanceController::class, 'user'])->name('system.balance.index');
        Route::get('users/{id}/view', [BalanceController::class, 'showUser'])->name('system.balance.userBalance');
    });


    //======================================================================================================
    //                   Users transactions ROUTES
    //======================================================================================================
    //    Route::prefix('transactions/')->middleware(['checkRule:view,transactions'])->group(function () {
    //        Route::get('', 'TransactionController@index')->name('system.transactions.index');
    //        Route::get('{id}/view', 'TransactionController@show')->name('system.transactions.details');
    //        Route::post('delete', 'TransactionController@delete')->name('system.transactions.delete')->middleware(['checkRule:delete,transactions']);
    //        Route::post('activate', 'TransactionController@activate')->name('system.transactions.activate')->middleware(['checkRule:activate,transactions']);
    //        Route::post('deactivate', 'TransactionController@deactivate')->name('system.transactions.deactivate')->middleware(['checkRule:activate,transactions']);
    //    });

    //======================================================================================================
    //                   notifications ROUTES
    //======================================================================================================
    Route::prefix('notifications/')->group(function () {
        Route::get('', [NotificationsController::class, 'notifications'])->name('system.notifications.index');
        Route::get('show/{text}/{type}', [NotificationsController::class, 'show'])->name('system.notifications.show');
        Route::post('delete/{text}/{type}', [NotificationsController::class, 'delete_group'])->name('system.notifications.delete.group');
        Route::post('delete_user', [NotificationsController::class, 'delete_user'])->name('system.notifications.delete.user');
        Route::get('show_create', [NotificationsController::class, 'showCreateView'])->name('system.notifications.create');
        Route::post('create', [NotificationsController::class, 'create'])->name('system.notifications.do.create');
        Route::post('delete', [NotificationsController::class, 'delete'])->name('system.notifications.delete');
    });
    //======================================================================================================
    //                   Users transactions ROUTES
    //======================================================================================================
    Route::prefix('translation/')->group(function () {
        Route::get('', [TranslationController::class, 'index'])->name('system.translations.index');
        Route::get('apiTexts', [TranslationController::class, 'apiNotifications'])->name('system.translations.apiTexts');
        Route::post('saveText', [TranslationController::class, 'saveText'])->name('system.translations.saveText');
        Route::post('saveApi', [TranslationController::class, 'saveApi'])->name('system.translations.saveApi');
    });

    //=====================================================================================================
    //                   ROLE ROUTRS
    //=====================================================================================================

    Route::prefix('roles/')->group(function () {

        Route::get('', [RoleController::class, 'index'])->name('system.roles.index');

        Route::get('show_create', [RoleController::class, 'showCreateView'])->name('system.roles.create');

        Route::post('create', [RoleController::class, 'create'])->name('system.roles.do.create'); //

        Route::get('{id}/update', [RoleController::class, 'showUpdateView'])->name('system.roles.update');

        Route::post('update/{id}', [RoleController::class, 'Update'])->name('system.roles.do.update');

        Route::post('delete', [RoleController::class, 'delete'])->name('system.roles.delete');
    });

    //======================================================================================================
    //                   Users user_balances ROUTES
    //======================================================================================================
    //    Route::prefix('user_balances/')->middleware(['checkRule:view,transactions'])->group(function () {
    //        Route::get('', 'TransactionController@user_balances')->name('system.user_balances.index');
    //        Route::get('{id}/view', 'TransactionController@show_user_balance')->name('system.user_balances.details');
    //        Route::post('activate', 'TransactionController@add_user_balance')->name('system.user_balances.add_balance')->middleware(['checkRule:activate,transactions']);
    //        Route::post('deactivate', 'TransactionController@sub_user_balance')->name('system.user_balances.sub_balance')->middleware(['checkRule:activate,transactions']);
    //
    //    });


    //======================================================================================================
    //                   areas ROUTES
    //======================================================================================================

    //    Route::prefix('areas/')->middleware(['checkRule:view,areas'])->group(function () {
    //
    //        Route::get('', 'CountriesController@index')->name('system.areas.index');
    //        Route::post('add_country', "CountriesController@add_country")->name('system.areas.add_country')->middleware(['checkRule:add,areas']);//
    //        Route::post('add_city', "CountriesController@add_city")->name('system.areas.add_city')->middleware(['checkRule:add,areas']);//
    //        Route::post('edit_country', 'CountriesController@edit_country')->name('system.areas.edit_country')->middleware(['checkRule:edit,areas']);
    //        Route::post('edit_city', 'CountriesController@edit_city')->name('system.areas.edit_city')->middleware(['checkRule:edit,areas']);
    //        Route::post('delete_country', 'CountriesController@delete_country')->name('system.areas.delete_country')->middleware(['checkRule:delete,areas']);
    //        Route::post('delete_city', 'CountriesController@delete_city')->name('system.areas.delete_city')->middleware(['checkRule:delete,areas']);
    //        Route::get('show_create', "CountriesController@showCreateView")->name('system.areas.create')->middleware(['checkRule:add,areas']);
    //        Route::post('create', "CountriesController@create")->name('system.areas.do.create')->middleware(['checkRule:add,areas']);//
    //        Route::get('{id}/update/{type}', 'CountriesController@showUpdateView')->name('system.areas.update')->middleware(['checkRule:edit,areas']);
    //        Route::post('update/{id}', 'CountriesController@Update')->name('system.areas.do.update')->middleware(['checkRule:edit,areas']);
    //
    //    });

    //======================================================================================================
    //                   categories ROUTES
    //======================================================================================================

    Route::prefix('categories/')->group(function () {
        Route::get('', [CategoryController::class, 'index'])->name('system.categories.index');
        Route::get('show_create', [CategoryController::class, 'showCreateView'])->name('system.categories.create');
        Route::post('create', [CategoryController::class, 'create'])->name('system.categories.do.create'); //
        Route::get('{id}/update', [CategoryController::class, 'showUpdateView'])->name('system.categories.update');
        Route::post('update/{id}', [CategoryController::class, 'Update'])->name('system.categories.do.update');
        Route::post('delete', [CategoryController::class, 'delete'])->name('system.categories.delete');
        Route::post('createJson', [CategoryController::class, 'createJson'])->name('system.categories.createJson'); //

        Route::post('activate', [CategoryController::class, 'activate'])->name('system.categories.activate');
        Route::post('deactivate', [CategoryController::class, 'deactivate'])->name('system.categories.deactivate');
    });
    //sjkdfgksfg
    
    Route::prefix('categories_special/')->group(function () {
        Route::get('', [CategorySpecialController::class, 'index'])->name('system.categories_special.index');
        Route::get('show_create', [CategorySpecialController::class, 'showCreateView'])->name('system.categories_special.create');
        Route::post('create', [CategorySpecialController::class, 'create'])->name('system.categories_special.do.create'); //
        Route::get('{id}/update', [CategorySpecialController::class, 'showUpdateView'])->name('system.categories_special.update');
        Route::post('update/{id}', [CategorySpecialController::class, 'Update'])->name('system.categories_special.do.update');
        Route::post('delete', [CategorySpecialController::class, 'delete'])->name('system.categories_special.delete');
        Route::post('createJson', [CategorySpecialController::class, 'createJson'])->name('system.categories_special.createJson'); //

        Route::post('activate', [CategorySpecialController::class, 'activate'])->name('system.categories_special.activate');
        Route::post('deactivate', [CategorySpecialController::class, 'deactivate'])->name('system.categories_special.deactivate');
    });


    //======================================================================================================
    //                   payments ROUTES
    //======================================================================================================

    Route::prefix('payments/')->group(function () {
        Route::get('', [PaymentTypesController::class, 'index'])->name('system.payments.index');
        Route::get('show_create', [PaymentTypesController::class, 'showCreateView'])->name('system.payments.create');
        Route::post('create', [PaymentTypesController::class, 'create'])->name('system.payments.do.create'); //
        Route::get('{id}/update', [PaymentTypesController::class, 'showUpdateView'])->name('system.payments.update');
        Route::post('update/{id}', [PaymentTypesController::class, 'Update'])->name('system.payments.do.update');
        Route::post('delete', [PaymentTypesController::class, 'delete'])->name('system.payments.delete');
        Route::post('activate', [PaymentTypesController::class, 'activate'])->name('system.payments.activate');
        Route::post('deactivate', [PaymentTypesController::class, 'deactivate'])->name('system.payments.deactivate');

        Route::post('change_is_active', [PaymentTypesController::class, 'changeIsActive'])->name('system.payments.change_is_active');
    });

    //======================================================================================================
    //                   coupons ROUTES
    //======================================================================================================

    Route::prefix('coupons/')->group(function () {
        Route::get('', [CouponController::class, 'index'])->name('system.coupons.index');
        Route::get('show_create', [CouponController::class, 'showCreateView'])->name('system.coupons.create');
        Route::get('orders/{id}', [CouponController::class, 'orders'])->name('system.coupons.orders');
        Route::post('create', [CouponController::class, 'create'])->name('system.coupons.do.create'); //
        Route::get('{id}/update', [CouponController::class, 'showUpdateView'])->name('system.coupons.update');
        Route::post('update/{id}', [CouponController::class, 'Update'])->name('system.coupons.do.update');
        Route::post('delete', [CouponController::class, 'delete'])->name('system.coupons.delete');

        Route::post('activate', [CouponController::class, 'activate'])->name('system.coupons.activate');
        Route::post('deactivate', [CouponController::class, 'deactivate'])->name('system.coupons.deactivate');
    });

    //======================================================================================================
    //                   coupons ROUTES
    //======================================================================================================

    Route::prefix('statistics/')->group(function () {
        Route::get('/sales-list', [StatisticController::class, 'salesList'])->name('system.sales.index');
    });


    //======================================================================================================
    //                   Order Cases ROUTES
    //======================================================================================================

    Route::prefix('order_cases/')->group(function () {
        Route::get('', [OrderCasesController::class, 'index'])->name('system.orderCases.index');
        Route::get('show_create', [OrderCasesController::class, 'showCreateView'])->name('system.orderCases.create');
        Route::post('create', [OrderCasesController::class, 'create'])->name('system.orderCases.do.create'); //
        Route::get('{id}/update', [OrderCasesController::class, 'showUpdateView'])->name('system.orderCases.update');
        Route::post('update/{id}', [OrderCasesController::class, 'Update'])->name('system.orderCases.do.update');
        Route::post('delete', [OrderCasesController::class, 'delete'])->name('system.orderCases.delete');
        Route::post('activate', [OrderCasesController::class, 'activate'])->name('system.orderCases.activate');
        Route::post('deactivate', [OrderCasesController::class, 'deactivate'])->name('system.orderCases.deactivate');
    });


    //======================================================================================================
    //                   properties ROUTES
    //======================================================================================================

    //    Route::prefix('properties/')->group(function () {
    //        Route::get('', 'PropertyController@index')->name('system.properties.index');
    //        Route::get('show_create', "PropertyController@showCreateView")->name('system.properties.create');
    //        Route::post('create', "PropertyController@create")->name('system.properties.do.create');//
    //        Route::get('{id}/update', 'PropertyController@showUpdateView')->name('system.properties.update');
    //        Route::post('update/{id}', 'PropertyController@Update')->name('system.properties.do.update');
    //        Route::post('delete', 'PropertyController@delete')->name('system.properties.delete');
    //        Route::post('createJson', "PropertyController@createJson")->name('system.properties.createJson');//
    //        Route::post('activate', 'PropertyController@activate')->name('system.properties.activate');
    //        Route::post('deactivate', 'PropertyController@deactivate')->name('system.properties.deactivate');
    //    });

    //======================================================================================================
    //                   colors ROUTES
    //======================================================================================================

    Route::prefix('colors/')->group(function () {
        Route::get('', [ColorController::class, 'index'])->name('system.colors.index');
        Route::get('show_create', [ColorController::class, 'showCreateView'])->name('system.colors.create');
        Route::post('create', [ColorController::class, 'create'])->name('system.colors.do.create'); //
        Route::get('{id}/update', [ColorController::class, 'showUpdateView'])->name('system.colors.update');
        Route::post('update/{id}', [ColorController::class, 'Update'])->name('system.colors.do.update');
        Route::post('delete', [ColorController::class, 'delete'])->name('system.colors.delete');
        Route::post('createJson', [ColorController::class, 'createJson'])->name('system.colors.createJson'); //
        Route::post('activate', [ColorController::class, 'activate'])->name('system.colors.activate');
        Route::post('deactivate', [ColorController::class, 'deactivate'])->name('system.colors.deactivate');
        Route::post('add_new_color', [ColorController::class, 'addNewColor'])->name('system.colors.addNewColor');
    });



    //======================================================================================================
    //                   styles ROUTES
    //======================================================================================================

    Route::prefix('styles/')->group(function () {
        Route::get('', [StyleController::class, 'index'])->name('system.styles.index');
        Route::get('show_create', [StyleController::class, 'showCreateView'])->name('system.styles.create');
        Route::post('create', [StyleController::class, 'create'])->name('system.styles.do.create'); //
        Route::get('{id}/update', [StyleController::class, 'showUpdateView'])->name('system.styles.update');
        Route::post('update/{id}', [StyleController::class, 'Update'])->name('system.styles.do.update');
        Route::post('delete', [StyleController::class, 'delete'])->name('system.styles.delete');
        Route::post('createJson', [StyleController::class, 'createJson'])->name('system.styles.createJson'); //
        Route::post('activate', [StyleController::class, 'activate'])->name('system.styles.activate');
        Route::post('deactivate', [StyleController::class, 'deactivate'])->name('system.styles.deactivate');
        Route::post('add_new_style', [StyleController::class, 'addNewStyle'])->name('system.styles.addNewStyle');
    });
    
    
    
    //======================================================================================================
    //                   Clothes ROUTES
    //======================================================================================================

    Route::prefix('clothes/')->group(function () {
        Route::get('', [ClothesController::class, 'index'])->name('system.clothes.index');
        Route::get('show_create', [ClothesController::class, 'showCreateView'])->name('system.clothes.create');
        Route::post('create', [ClothesController::class, 'create'])->name('system.clothes.do.create'); //
        Route::get('{id}/update', [ClothesController::class, 'showUpdateView'])->name('system.clothes.update');
        Route::post('update/{id}', [ClothesController::class, 'Update'])->name('system.clothes.do.update');
        Route::post('delete', [ClothesController::class, 'delete'])->name('system.clothes.delete');
        Route::post('createJson', [ClothesController::class, 'createJson'])->name('system.clothes.createJson'); //
        Route::post('activate', [ClothesController::class, 'activate'])->name('system.clothes.activate');
        Route::post('deactivate', [ClothesController::class, 'deactivate'])->name('system.clothes.deactivate');
        Route::post('add_new_clothes', [ClothesController::class, 'addNewClothes'])->name('system.clothes.addNewClothes');
    });


    //======================================================================================================
    //                   sizes ROUTES
    //======================================================================================================

    Route::prefix('sizes/')->group(function () {
        Route::get('', [SizeController::class, 'index'])->name('system.sizes.index');
        Route::get('show_create', [SizeController::class, 'showCreateView'])->name('system.sizes.create');
        Route::post('create', [SizeController::class, 'create'])->name('system.sizes.do.create'); //
        Route::get('{id}/update', [SizeController::class, 'showUpdateView'])->name('system.sizes.update');
        Route::post('update/{id}', [SizeController::class, 'Update'])->name('system.sizes.do.update');
        Route::post('delete', [SizeController::class, 'delete'])->name('system.sizes.delete');
        Route::post('createJson', [SizeController::class, 'createJson'])->name('system.sizes.createJson'); //
        Route::post('activate', [SizeController::class, 'activate'])->name('system.sizes.activate');
        Route::post('deactivate', [SizeController::class, 'deactivate'])->name('system.sizes.deactivate');
        Route::post('add_new_size', [SizeController::class, 'addNewSize'])->name('system.sizes.addNewSize');
    });

    //======================================================================================================
    //                  ROUTES stores
    //======================================================================================================

    Route::prefix('designers/')->group(function () {
        Route::get('', [StoreController::class, 'index'])->name('system.stores.index');
        //        Route::get('{id}/view', [StoreController::class, 'show'])->name('system.stores.details');
        Route::get('show_create', [StoreController::class, 'showCreateView'])->name('system.stores.create');
        Route::post('create', [StoreController::class, 'create'])->name('system.stores.do.create'); //
        Route::get('{id}/update', [StoreController::class, 'showUpdateView'])->name('system.stores.update');
        Route::post('update/{id}', [StoreController::class, 'Update'])->name('system.stores.do.update');
        Route::post('delete', [StoreController::class, 'delete'])->name('system.stores.delete');
        Route::post('createJson', [StoreController::class, 'createJson'])->name('system.stores.createJson'); //
        Route::post('activate', [StoreController::class, 'activate'])->name('system.stores.activate');
        Route::post('deactivate', [StoreController::class, 'deactivate'])->name('system.stores.deactivate');
        Route::get('show', [StoreController::class, 'show'])->name('system.stores.show');
        Route::get('view/{store}', [StoreController::class, 'view'])->name('system.stores.view');
        Route::get('sales/{id}', [StoreController::class, 'sales'])->name('system.stores.sales');
    });
    //======================================================================================================
    //                  ROUTES offers
    //======================================================================================================

    Route::prefix('offers/')->group(function () {
        Route::get('', [OfferController::class, 'index'])->name('system.offers.index');
        Route::get('{id}/view', [OfferController::class, 'show'])->name('system.offers.details');
        Route::get('show_create', [OfferController::class, 'showCreateView'])->name('system.offers.create');
        Route::post('create', [OfferController::class, 'create'])->name('system.offers.do.create'); //
        Route::get('{id}/update', [OfferController::class, 'showUpdateView'])->name('system.offers.update');
        Route::post('update/{id}', [OfferController::class, 'Update'])->name('system.offers.do.update');
        Route::post('delete', [OfferController::class, 'delete'])->name('system.offers.delete');
        Route::get('show', [OfferController::class, 'show'])->name('system.offers.show');
        Route::get('view/{offer}', [OfferController::class, 'view'])->name('system.offers.view');
    });
    //======================================================================================================
    //                  ROUTES sliders
    //======================================================================================================

    Route::prefix('sliders/')->group(function () {
        Route::get('', [SliderController::class, 'index'])->name('system.sliders.index');
        Route::get('{id}/view', [SliderController::class, 'show'])->name('system.sliders.details');
        Route::get('show_create', [SliderController::class, 'showCreateView'])->name('system.sliders.create');
        Route::post('create', [SliderController::class, 'create'])->name('system.sliders.do.create'); //
        Route::get('{id}/update', [SliderController::class, 'showUpdateView'])->name('system.sliders.update');
        Route::post('update/{id}', [SliderController::class, 'Update'])->name('system.sliders.do.update');
        Route::post('delete', [SliderController::class, 'delete'])->name('system.sliders.delete');
        Route::get('show', [SliderController::class, 'show'])->name('system.sliders.show');
        Route::get('view/{slider}', [SliderController::class, 'view'])->name('system.sliders.view');
    });
    //======================================================================================================
    //                  ROUTES Payouts
    //======================================================================================================

    // Route::prefix('payouts/')->group(function () {
    //     Route::get('', [PayoutController::class, 'index'])->name('system.payouts.index');
    //     Route::get('orders/{id}', [PayoutController::class, 'orders'])->name('system.payouts.orders');
    // });

    //======================================================================================================
    //                  ROUTES products
    //======================================================================================================
    Route::prefix('products/')->group(function () {
        Route::get('', [ProductController::class, 'index'])->name('system.products.index');
        Route::get('/{product}/sizes', [ProductController::class, 'productSizes'])->name('system.products.sizes');
         Route::get('/{product}/orders', [ProductController::class, 'productOrders'])->name('system.products.orders');
        Route::get('{storeId?}/store', [ProductController::class, 'index2'])->name('system.products.store');
        Route::get('{id}/view', [ProductController::class, 'show'])->name('system.products.details');
        Route::get('{id}/update', [ProductController::class, 'showUpdateView'])->name('system.products.update');
        Route::post('{id}/update', [ProductController::class, 'Update'])->name('system.products.do.update');
        Route::get('show_create/{storeId?}', [ProductController::class, 'showCreateView'])->name('system.products.create');
        Route::post('create', [ProductController::class, 'create'])->name('system.products.do.create');
        Route::post('delete', [ProductController::class, 'delete'])->name('system.products.delete');
        Route::post('activate', [ProductController::class, 'activate'])->name('system.products.activate');
        Route::post('deactivate', [ProductController::class, 'deactivate'])->name('system.products.deactivate');
        Route::post('change_offer_status', [ProductController::class, 'change_offer_status'])->name('system.products.change_offer_status');
        Route::post('delete_image', [ProductController::class, 'delete_image'])->name('system.products.delete_image');
        Route::post('upload_image', [ProductController::class, 'saveMultiFileJson'])->name('system.products.upload_image');
        Route::post('default_image', [ProductController::class, 'defaultIMG'])->name('system.products.default_image');
        Route::post('add-product-size-qty', [ProductController::class, 'addProductSizeQuantity'])->name('system.products.add.qty');
        Route::post('withdraw-product-size-qty', [ProductController::class, 'withdrawProductSizeQuantity'])->name('system.products.withdraw.qty');
        Route::post('size-qty-update', [ProductController::class, 'ProductSizeQuantityUpdate'])->name('system.product.size.qty.update');
        Route::post('stock-delete', [ProductController::class, 'deleteStock'])->name('system.stock.delete');

        Route::post('change_is_active', [ProductController::class, 'changeIsActive'])->name('system.products.change_is_active');


        /*   Route::get('feature_products', [ProductController::class, 'getFeatureProducts'])->name('system.featureProducts.index');
           Route::post('feature_products', [ProductController::class, 'postFeatureProducts'])->name('system.featureProducts.update');
           Route::post('change_show_feature_product', [ProductController::class, 'change_show_feature_product'])->name('system.featureProducts.change_show_feature_product');*/
        Route::post('feature_products', [ProductController::class, 'postFeatureProducts'])->name('system.featureProducts.update');
        Route::post('slider-product', [ProductController::class, 'updateSliderImage'])->name('system.slider.update');
        Route::post('change_show_feature_product', [ProductController::class, 'change_show_feature_product'])->name('system.featureProducts.change_show_feature_product');

        Route::post('change_show_in_slider', [ProductController::class, 'change_show_in_slider'])->name('system.sliderProducts.change_show_in_slider');
    });

    Route::prefix('feature_products/')->group(function () {

        Route::get('', [ProductController::class, 'getFeatureProducts'])->name('system.featureProducts.index');
    });

    Route::prefix('slider_products/')->group(function () {

        Route::get('', [ProductController::class, 'getProductsInSlider'])->name('system.sliderProducts.index');
    });

    //======================================================================================================
    //                   Pages ROUTES
    //======================================================================================================
    Route::prefix('pages/')->group(function () {
        Route::get('', [PagesController::class, 'index'])->name('system.pages.index');
        Route::get('{id}/update', [PagesController::class, 'showUpdateView'])->name('system.pages.update');
        Route::post('update/{id}', [PagesController::class, 'Update'])->name('system.pages.do.update');
    });

    //======================================================================================================
    //                   contacts ROUTES
    //======================================================================================================
    //    Route::prefix('contacts/')->group(function () {
    //        Route::get('', [ContactsController::class, 'index'])->name('system.contacts.index');
    //        Route::post('delete',[ContactsController::class, 'delete'])->name('system.contacts.delete');
    //        Route::post('replay', [ContactsController::class, 'contactReplay'])->name('system.contacts.replay');
    //        Route::get('/getContactReplies/{id}',[ContactsController::class, 'getContactReplies'])->name('system.contacts.getReplay');
    //
    //    });
    //======================================================================================================
    //                   Orders ROUTES
    //======================================================================================================
    Route::prefix('orders/')->group(function () {
        Route::get('mainIndex', [OrdersController::class, 'mainIndex'])->name('system.orders.mainIndex');

        Route::get('', [OrdersController::class, 'index'])->name('system.orders.index');

        /* Route::get('accept',[OrdersController::class, 'accept'])->name('system.orders.accept');
         Route::get('onDelivery',[OrdersController::class, 'onDelivery'])->name('system.orders.onDelivery');
         Route::get('archive', [OrdersController::class, 'archive'])->name('system.orders.archive');
         Route::get('canceled', [OrdersController::class, 'canceled'])->name('system.orders.canceled');
         Route::get('rejected', [OrdersController::class, 'rejected'])->name('system.orders.rejected');*/


        //  Route::get('store', [OrdersController::class, 'index2'])->name('system.orders.store');
        Route::get('details/{id}', [OrdersController::class, 'details'])->name('system.orders.details');
        Route::get('edit/{id}', [OrdersController::class, 'edit'])->name('system.orders.edit');
        Route::post('addproduct/{id}', [OrdersController::class, 'addproduct'])->name('system.orders.addproduct');
        Route::post('change_status', [OrdersController::class, 'change_status'])->name('system.orders.change_status');
        Route::post('change_order_status_to_can', [OrdersController::class, 'change_order_status_to_can'])->name('system.orders.change_order_status_to_can');
        Route::post('delete', [OrdersController::class, 'delete'])->name('system.orders.delete');
        Route::post('deleteproduct', [OrdersController::class, 'deleteproduct'])->name('system.orders.deleteproduct');
        Route::post('editpay/{id}', [OrdersController::class, 'editpay'])->name('system.orders.editpay');
        Route::get('new_row', [OrdersController::class, 'new_row'])->name('system.orders.new_row');
        Route::get('new_row_2', [OrdersController::class, 'new_row_2'])->name('system.orders.new_row_2');
    });


    //======================================================================================================
    //                   reports ROUTES
    //======================================================================================================
    Route::prefix('reports/')->group(function () {
        Route::get('', [ReportController::class, 'index'])->name('system.reports.index');
        Route::get('R1', [ReportController::class, 'report1'])->name('system.reports.r1');
        Route::get('R2', [ReportController::class, 'report2'])->name('system.reports.r2');
        Route::get('R3', [ReportController::class, 'report3'])->name('system.reports.r3');
        Route::get('R4', [ReportController::class, 'report4'])->name('system.reports.r4');
        Route::get('R5', [ReportController::class, 'report5'])->name('system.reports.r5');
    });

    //======================================================================================================
    //                   Excel Export ROUTES
    //======================================================================================================

    Route::get('customers/export/', 'ExcelController@exportcustomer')->name('customersexport');
    Route::get('orders/export/', 'ExcelController@exportorder')->name('ordersexport');
    Route::get('products/export/', 'ExcelController@exportproduct')->name('productsexport');
    Route::get('productsize/export/', 'ExcelController@exportsize')->name('storeproductsexport');
    Route::get('stores/export/', 'ExcelController@exportstore')->name('storesexport');
    Route::get('sales/export/', 'ExcelController@exportsales')->name('salesexport');
});


//======================================================================================================
//                   template ROUTES
//======================================================================================================

//Route::prefix('template/')->middleware(['checkRule:view,template'])->group(function () {
//    Route::get('', 'TemplateController@index')->name('system.template.index');
//    Route::get('show_create', "TemplateController@showCreateView")->name('system.template.create')->middleware(['checkRule:add,template']);
//    Route::post('create', "TemplateController@create")->name('system.template.do.create')->middleware(['checkRule:add,template']);//
//    Route::get('{id}/update', 'TemplateController@showUpdateView')->name('system.template.update')->middleware(['checkRule:edit,template']);
//    Route::post('update/{id}', 'TemplateController@Update')->name('system.template.do.update')->middleware(['checkRule:edit,template']);
//    Route::post('delete', 'TemplateController@delete')->name('system.template.delete')->middleware(['checkRule:delete,template']);
//});


//======================================================================================================
//                  ROUTES template with multi upload
//======================================================================================================
//Route::prefix('templates/')->middleware(['checkRule:view,templates'])->group(function () {
//    Route::get('', 'TemplateController@index')->name('system.templates.index');
//    Route::get('{id}/view', 'TemplateController@show')->name('system.templates.details');
//    Route::get('{id}/update', 'TemplateController@showUpdateView')->name('system.templates.update')->middleware(['checkRule:edit,templates']);
//    Route::post('{id}/update', 'TemplateController@Update')->name('system.templates.do.update');
//    Route::get('show_create', "TemplateController@showCreateView")->name('system.templates.create')->middleware(['checkRule:add,templates']);
//    Route::post('create', "TemplateController@create")->name('system.templates.do.create')->middleware(['checkRule:add,templates']);
//    Route::post('delete', 'TemplateController@delete')->name('system.templates.delete')->middleware(['checkRule:delete,templates']);
//    Route::post('activate', 'TemplateController@activate')->name('system.templates.activate')->middleware(['checkRule:activate,templates']);
//    Route::post('deactivate', 'TemplateController@deactivate')->name('system.templates.deactivate')->middleware(['checkRule:activate,templates']);
//    Route::post('delete_image', 'TemplateController@delete_image')->name('system.templates.delete_image')->middleware(['checkRule:edit,templates']);
//    Route::post('upload_image', 'TemplateController@saveMultiFileJson')->name('system.templates.upload_image')->middleware(['checkRule:edit,templates']);
//    Route::post('default_image', 'TemplateController@defaultIMG')->name('system.templates.default_image')->middleware(['checkRule:edit,templates']);
//
//
//});


//======================================================================================================
//                  ROUTES test
//======================================================================================================
//Route::prefix('test/')->middleware(['checkRule:view,test'])->group(function () {
//    Route::get('', 'TestController@index')->name('system.test.index');
//    Route::get('{id}/view', 'TestController@show')->name('system.test.details');
//    Route::get('{id}/update', 'TestController@showUpdateView')->name('system.test.update')->middleware(['checkRule:edit,test']);
//    Route::post('{id}/update', 'TestController@Update')->name('system.test.do.update');
//    Route::get('show_create', "TestController@showCreateView")->name('system.test.create')->middleware(['checkRule:add,test']);
//    Route::post('create', "TestController@create")->name('system.test.do.create')->middleware(['checkRule:add,test']);
//    Route::post('delete', 'TestController@delete')->name('system.test.delete')->middleware(['checkRule:delete,test']);
//    Route::post('activate', 'TestController@activate')->name('system.test.activate')->middleware(['checkRule:activate,test']);
//    Route::post('deactivate', 'TestController@deactivate')->name('system.test.deactivate')->middleware(['checkRule:activate,test']);
//
//
//});


//Route::get('start_mada_transaction', 'MadaController@index')->name('mada.start_transaction');
Route::get('start_hyperpay_transaction', [HyperPayController::class, 'index'])->name('hyper.start_transaction');
Route::get('return_from_transaction', [HyperPayController::class, 'return_from_transaction'])->name('hyper.return');

//======================================================================================================
//                   Others ROUTES
//======================================================================================================
Route::post('uploadFile', [MediaController::class, 'saveFileJson']);
Route::post('uploadVideo', [MediaController::class, 'saveVideoJson']);
Route::post('uploadFiles', [MediaController::class, 'saveMultiFileJson']);
Route::post('uploadFilesNew', [MediaController::class, 'saveMultiFileJsonNew']);


Route::prefix('commands/')/*->middleware(['auth:system_admin','checkRule:view,admins'])*/->group(function () {
    Route::get('migrate', [ClosureController::class, 'migrate']);
    Route::get('generate_models', [ClosureController::class, 'generate_models']);
    Route::get('restart_queue', [ClosureController::class, 'restart_queue']);

    Route::get('clear', [ClosureController::class, 'clearView']);
    Route::get('changeKey', [ClosureController::class, 'changeKey']);
    Route::get('ChangeToProduction', [ClosureController::class, 'ChangeToProduction']);
    Route::get('ChangeToDevelopment', [ClosureController::class, 'ChangeToDevelopment']);
});
Route::get('/artisan/generate_docs', function () {
    Artisan::call('l5-swagger:generate');
    return "<h1>Generating Done</h1>";
});

Route::get('down', [ClosureController::class, 'down'])->name('api.down');

//======================================================================================================
//                   govs ROUTES
//======================================================================================================

Route::prefix('govs/')->group(function () {
    Route::get('', [GovController::class, 'index'])->name('system.govs.index');
    Route::get('show_create', [GovController::class, 'showCreateView'])->name('system.govs.create');
    Route::post('create', [GovController::class, 'create'])->name('system.govs.do.create'); //
    Route::get('{id}/update', [GovController::class, 'showUpdateView'])->name('system.govs.update');
    Route::post('update/{id}', [GovController::class, 'Update'])->name('system.govs.do.update');
    Route::post('delete', [GovController::class, 'delete'])->name('system.govs.delete');
    Route::post('createJson', [GovController::class, 'createJson'])->name('system.govs.createJson'); //
});


//======================================================================================================
//                   areas ROUTES
//======================================================================================================

Route::prefix('areas/')->group(function () {
    Route::get('', [AreaController::class, 'index'])->name('system.areas.index');
    Route::get('show_create', [AreaController::class, 'showCreateView'])->name('system.areas.create');
    Route::post('create', [AreaController::class, 'create'])->name('system.areas.do.create'); //
    Route::get('{id}/update', [AreaController::class, 'showUpdateView'])->name('system.areas.update');
    Route::post('update/{id}', [AreaController::class, 'Update'])->name('system.areas.do.update');
    Route::post('delete', [AreaController::class, 'delete'])->name('system.areas.delete');
    Route::post('createJson', [AreaController::class, 'createJson'])->name('system.areas.createJson'); //
});
