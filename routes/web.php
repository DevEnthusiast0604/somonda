<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\CartController;

Auth::routes([
    'register' => false, // Registration Routes...
    // 'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);
// Auth::routes();

Route::get('lang/{locale}', [App\Http\Controllers\LocalizationController::class, 'index'])->name('setLanguage');

Route::middleware(['setPageLocale:fr', 'is_maintenance'])->group(function () {
    Route::get('/', [FrontendController::class,'index'])->name('home');
    // Route::view('/member_register','frontend.register')->name('member.register');
    // Route::post('/member_register_checkout', [FrontendController::class, 'member_register_checkout'])->name('member.register.checkout');

    Route::get('/membership_checkout', [FrontendController::class, 'membership'])->name('membership');
    Route::post('/membership_checkout/process', [FrontendController::class, 'membership_checkout'])->name('membership.checkout');
    Route::get('/membership_checkout/process/success', [FrontendController::class, 'membership_process_success'])->name('membership.checkout.process');

    Route::prefix('products')->group(function () {
        Route::get('/', [FrontendController::class, 'products_all'])->name('products.all');
        Route::get('/{category_url}', [FrontendController::class, 'products'])->name('products');
        Route::get('/details/{product_url}', [FrontendController::class, 'product_details'])->name('products.details');
        Route::get('/view/{product_url}', [FrontendController::class, 'product_view'])->name('products.view');
        Route::get('/purchase/{product_url}', [FrontendController::class, 'product_purchase'])->name('products.purchase');
    });
    Route::prefix('cart')->group(function () {
        Route::get('/', [CartController::class, 'cartList'])->name('cart.list');
        Route::post('/add', [CartController::class, 'addToCart'])->name('cart.store');
        Route::get('/update', [CartController::class, 'updateCart'])->name('cart.update');
        // Route::post('/update', [CartController::class, 'updateCart'])->name('cart.update');
        Route::post('/remove', [CartController::class, 'removeCart'])->name('cart.remove');
        Route::post('/clear', [CartController::class, 'clearAllCart'])->name('cart.clear');    
    });
  
    // iphone page data submit and payment
    Route::post('/purchase_checkout', [CartController::class, 'purchase_checkout'])->name('purchase.checkout');
    Route::get('/purchase_payment', [CartController::class, 'purchase_payment'])->name('purchase.payment');
    Route::post('/purchase_checkout/process', [CartController::class, 'purchase_process'])->name('purchase.checkout.process');
    Route::get('/purchase_checkout/process/success', [CartController::class, 'purchase_process_success'])->name('purchase.checkout.process.success');
    
    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
    Route::post('/process_checkout', [CartController::class, 'process_checkout'])->name('process.checkout');
    Route::get('/shipping', [CartController::class, 'shipping'])->name('shipping');

    Route::get('/payment', [CartController::class, 'payment'])->name('payment'); // old payment without 3ds
    Route::post('/process_payment', [CartController::class, 'process_payment'])->name('process.payment');
    
    // 3DS payment
    Route::post('/checkout/process', [CartController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/process/success', [CartController::class, 'process_success'])->name('checkout.process.success');
    Route::get('/checkout/process/failed', [CartController::class, 'process_failed'])->name('checkout.process.failed');

    Route::get('/thank-you', function(){ return view('frontend.pages.thank-you'); })->name('thankyou');
    Route::get('/failed', function(){ return view('frontend.pages.failed'); })->name('failed');

    Route::prefix('event')->group(function () {
        Route::get('/details/{id}', [FrontendController::class, 'event_details'])->name('event.details');
        Route::get('/advanced_search', [FrontendController::class, 'advanced_event_search'])->name('event.advancedSearch');
        Route::get('/search', [FrontendController::class, 'event_search'])->name('event.Search');
    }); 
    // Ajax Call for calendar
    Route::get('/get_events', [FrontendController::class, 'get_events']);

    Route::view('/membership-compare','frontend.pages.compare')->name('compare');
    Route::view('/terms_conditions','frontend.pages.terms_conditions')->name('terms');
    Route::view('/privacy_policy', 'frontend.pages.privacy_policy')->name('privacy');
    Route::view('/contact-us', 'frontend.pages.contact')->name('contact');
    Route::view('/faq', 'frontend.pages.faq')->name('faq');
});

Route::post('/contact', [FrontendController::class, 'contact'])->name('user.contact');
Route::post('/subscribe', [FrontendController::class, 'subscribe'])->name('user.subscribe');
Route::get('/unsubscribe/{id}', [FrontendController::class, 'unsubscribe'])->name('user.unsubscribe');
Route::post('/unsubscribe', [FrontendController::class, 'update_unsubscribe'])->name('user.update_unsubscribe');

Route::get('/maintenance', function(){
    return view('frontend.pages.maintenance');
})->name('maintenance');


// Ajax Call
Route::get('/getcountries',[FrontendController::class, 'getcountries']);
Route::get('/getStates/{id}',[FrontendController::class, 'getStates']);
Route::get('/getCities/{id}',[FrontendController::class, 'getCities']);

Route::get('/getCategories',[FrontendController::class, 'get_categories']);
Route::get('/getSubcategories/{id}',[FrontendController::class, 'get_subcategories']);

Route::group(array('middleware' => array('auth')), function(){
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
});

Route::group(array('middleware' => array('auth','is_maintenance')), function(){
    //Users
    Route::group(['prefix'=>'user'], function(){
        Route::get('profile',[UsersController::class, 'profile'])->name('user.profile');
        Route::patch('/update/{id}', [UsersController::class,'update'])->name('usersUpdate');
        Route::post('change_password', [UsersController::class,'change_password'])->name('ChangePassword');

        // Subscribtion
        Route::get('/membership', [MembershipController::class,'index'])->name('user.membership');
        Route::get('/cancel_membership', [MembershipController::class,'cancel'])->name('user.cancelMembership');

        // Products
        Route::get('/products', [SalesController::class, 'user_products'])->name('user.products');

        Route::get('email_preferences',[UsersController::class, 'email_preferences'])->name('user.emailPreferences');
        Route::post('email_preferences',[UsersController::class, 'update_email_preferences'])->name('user.updateEmailPreferences');
    });
});


Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    $exitCode = Artisan::call('optimize:clear');
    return 'DONE'; //Return anything
});