<?php

use App\Http\Controllers\Admin\AdminCustomerController;
use App\Http\Controllers\Admin\AdminInventoryController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {
    Route::controller(AdminInventoryController::class)->group(function() {
        Route::get('/inventories', 'index')->name('admin.inventory.index');
        Route::get('/inventory/{id}', 'show')->name('admin.inventory.show');
        Route::get('/inventory/create', 'create')->name('admin.inventory.create');
        Route::post('/inventory/store', 'store')->name('admin.inventory.store');
        Route::get('/inventory/{id}/edit', 'edit')->name('admin.inventory.edit');
        Route::post('/inventory/{id}/update', 'update')->name('admin.inventory.update');
        Route::get('/inventory/{id}/destroy', 'destroy')->name('admin.inventory.destroy');
    });

    Route::controller(AdminCustomerController::class)->group(function () {
        Route::get('/customers', 'index')->name('admin.customer.index');
        Route::get('/customer/{id}', 'show')->name('admin.customer.show');
        Route::get('/customer/create', 'create')->name('admin.customer.create');
        Route::post('/customer/store', 'store')->name('admin.customer.store');
        Route::get('/customer/{id}/edit', 'edit')->name('admin.customer.edit');
        Route::post('/customer/{id}/update', 'update')->name('admin.customer.update');
        Route::get('/customer/{id}/destroy', 'destroy')->name('admin.customer.destroy');
    });

    // later on
    Route::prefix('ajax')->group(function () {
        // Route::get('/products', 'Admin\AdminProductController@getProducts')->name('admin.ajax.getProducts');
        // Route::get('/product/{id}/edit', 'Admin\AdminProductController@editProduct')->name('admin.ajax.editProducts');

        // Route::get('/product/{id}/edit', [AdminProductController::class, 'editProduct'])->name('admin.ajax.product.edit');

        // another ajax route here

    }); //add middleware only.ajax here

}); //add middleware admi.only here
