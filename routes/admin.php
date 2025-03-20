<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\FeaturedlocationController;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\MembershipController;

// Dashboard
Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/statistics_view', [AdminController::class, 'statistics_view'])->name('admin.statisticsView');

// User Management
Route::group(['prefix'=>'users'], function(){
    Route::get('/',[UsersController::class, 'index'])->name('admin.customers');
    Route::post('/store',[UsersController::class, 'store'])->name('admin.userstore');
    Route::get('/edit/{id}', [UsersController::class, 'edit_user'])->name('admin.editUser');
    Route::get('/create',[UsersController::class,'add_user'])->name('admin.addUser');
    Route::delete('/destroy', [UsersController::class,'destroy'])->name('admin.usersDestroy');
    Route::get('/search',[UsersController::class,'search'])->name('admin.user.search');
    Route::get('/membership/{id}',[MembershipController::class,'admin_cancel'])->name('admin.user.membership');
});

//Products Management
Route::prefix('products')->group(function () {
    Route::get('/list',  [ProductController::class,'list'])->name('admin.products');
    Route::get('/download',[ProductController::class,'download'])->name('admin.prodDownload');
    Route::get('/synchroize/{id}',[ProductController::class,'synchronize'])->name('admin.prodSync');
    // Route::get('/synchroize/{id}',[ProductController::class,'synchronize'])->name('admin.prodSync');
    Route::get('/search',[ProductController::class,'search'])->name('admin.prodSearch');
    Route::get('/add', [ProductController::class,'add'])->name('admin.prodAdd');
    Route::get('/add_product', [ProductController::class,'add_product'])->name('admin.prodAdd.manual');
    Route::post('/store_product', [ProductController::class,'store'])->name('admin.prodStore');
    Route::get('/edit/{id}', [ProductController::class,'edit'])->name('admin.prodEdit');
    Route::patch('/update/{id}', [ProductController::class,'update'])->name('admin.prodUpdate');
    Route::get('/edit_details/{id}', [ProductController::class,'edit_details'])->name('admin.prodEdit.details');
    Route::patch('/update_details/{id}', [ProductController::class,'update_details'])->name('admin.prodUpdate.details');

    Route::delete('/destroy', [ProductController::class,'destroy'])->name('admin.prodDestroy');
});

//Transaction
Route::get('/transactions',[App\Http\Controllers\TransactionController::class,'index'])->name('admin.transactions');
Route::delete('/transactions/destory', [App\Http\Controllers\TransactionController::class,'destroy'])->name('admin.transactionDestroy');

//Category 
Route::prefix('categories')->group(function () {
    Route::get('/',[CategoryController::class,'index'])->name('admin.category');
    Route::get('/search',[CategoryController::class,'search'])->name('admin.categorySearch');
    Route::get('/synchroize',[CategoryController::class,'synchronize'])->name('admin.categorySync');
    Route::post('/add', [CategoryController::class,'store'])->name('admin.categoryStore');
    Route::patch('/edit/{id}', [CategoryController::class,'update'])->name('admin.categoryUpdate');
    Route::delete('/destroy', [CategoryController::class,'destroy'])->name('admin.categoryDestroy');
});

// Sales 
Route::prefix('sales')->group(function () {
    Route::get('/',[SalesController::class,'index'])->name('admin.sales');
    Route::patch('/order/{id}',[SalesController::class,'order'])->name('admin.order');
    Route::delete('/destroy', [SalesController::class,'destroy'])->name('admin.salesDestroy');
    Route::get('/search',[SalesController::class,'search'])->name('admin.sales.search');

});
 

// Settings
Route::prefix('settings')->group(function () {
    Route::get('profile', [UsersController::class, 'admin_profile'])->name('admin.profile');
    Route::get('maintenance', function(){
        return view('admin.maintenance');
    })->name('admin.maintenance');
    Route::post('maintenance', [AdminController::class, 'update_maintenance'])->name('admin.maintenanceUpdate');
});


