<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(array('middleware' => array('auth')), function () {
    Route::group(['prefix' => '{locale}',  'where' => ['locale' => '[a-zA-Z]{2}'], 'middleware' => 'setlocale'], function() {
    });

  
    //Packages & Orders
    Route::get('/packages', [App\Http\Controllers\PackagesController::class,'shopper_packages'])->name('shopper.packages');
    Route::get('/processing_packages', [App\Http\Controllers\PackagesController::class,'shopper_processing_packages'])->name('shopper.processing_packages');
    Route::get('/ready_to_ship_packages', [App\Http\Controllers\PackagesController::class,'shopper_ready_to_ship_packages'])->name('shopper.ready_to_ship_packages');
    Route::get('/shipped_packages', [App\Http\Controllers\PackagesController::class,'shopper_shipped_packages'])->name('shopper.shipped_packages');
    
    
    
    
    Route::get('/orders', [App\Http\Controllers\OrdersController::class,'shopper_orders'])->name('shopper.orders');
    Route::post('/orders/create_assisted', [App\Http\Controllers\OrdersController::class,'shopper_create_assisted'])->name('shopper.create_assisted');
    Route::get('/orders/details/{id}', [App\Http\Controllers\OrdersController::class,'shopper_order_details'])->name('shopper.order_details');
    Route::get('/orders/assisted_purchase', [App\Http\Controllers\OrdersController::class,'assisted_purchase'])->name('shopper.assisted_purchase');
    Route::get('shopper_orderlists', [App\Http\Controllers\OrdersController::class, 'shopper_orderlists']);
    Route::delete('/orders/delete_assisted', [App\Http\Controllers\OrdersController::class, 'shopper_destroy_assisted'])->name('shopper.delete_assisted');
   
    // Address
    Route::get('/address', [App\Http\Controllers\AddressController::class, 'index'])->name('shopper.address');
    Route::get('/create_address', [App\Http\Controllers\AddressController::class, 'create'])->name('shopper.create_address');
    Route::post('/create_address', [App\Http\Controllers\AddressController::class, 'store'])->name('shopper.store_address');
    Route::patch('/update_address/{id}', [App\Http\Controllers\AddressController::class, 'update'])->name('shopper.update_address');
    Route::delete('/delete_address', [App\Http\Controllers\AddressController::class, 'destroy'])->name('shopper.delete_address');

    // Mailbox & Membership
    Route::get('/upgrade_membership', [App\Http\Controllers\MembershipController::class, 'upgrade_membership'])->name('shopper.upgrade_membership');
    Route::get('/mailbox', [App\Http\Controllers\WarehouseController::class,'shopper_mailbox'])->name('shopper.mailbox');
    Route::get('/mailbox_detail', [App\Http\Controllers\WarehouseController::class,'shopper_mailbox_detail'])->name('shopper.mailbox_detail');

    // Package
    Route::get('/package_declare/{id}',[App\Http\Controllers\PackageItemController::class, 'shopper_package_declare'])->name('shopper.package_declare');
    Route::get('/package_item/{id}', [App\Http\Controllers\PackageItemController::class,'shopper_item_edit'])->name('shopper.pacakge_items');
    Route::post('/packager_item_store', [App\Http\Controllers\PackageItemController::class, 'shopper_item_store'])->name('shopper.package_item_store');
    Route::patch('/packager_item_update/{id}', [App\Http\Controllers\PackageItemController::class, 'shopper_item_update'])->name('shopper.package_item_update');
    Route::delete('/packager_item_destroy', [App\Http\Controllers\PackageItemController::class, 'shopper_item_destroy'])->name('shopper.package_item_destroy');
    Route::get('/package_ready_to_ship/{id}', [App\Http\Controllers\PackagesController::class, 'shopper_ready_to_ship'])->name('shopper.ready_to_ship');
    Route::get('/shippment', [App\Http\Controllers\PackagesController::class, 'shopper_shippment'])->name('shopper.shippment');
    Route::get('/checkout', [App\Http\Controllers\PackagesController::class, 'shopper_checkout'])->name('shopper.checkout');
    Route::get('/pacakge_details', [App\Http\Controllers\PackagesController::class, 'shopper_package_details'])->name('shopper.pacakge_details');
    Route::post('/consolidate', [App\Http\Controllers\PackagesController::class, 'shopper_consolidate'])->name('shopper.consolidate');
    Route::post('/repack', [App\Http\Controllers\PackagesController::class, 'shopper_repack'])->name('shopper.repack');
    Route::post('/special_request', [App\Http\Controllers\PackagesController::class, 'shopper_special_request'])->name('shopper.special_request');
 

});
