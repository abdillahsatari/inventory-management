<?php

use App\Http\Controllers\Admin\AdminProductController;
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
    Route::controller(AdminProductController::class)->group(function () {
        Route::get('/products', 'index')->name('admin.product.index');
        Route::get('/product/{id}', 'show')->name('admin.product.show');
        Route::get('/product/create', 'create')->name('admin.product.create');
        Route::post('/product/store', 'store')->name('admin.product.store');
        Route::get('/product/{id}/edit', 'edit')->name('admin.product.edit');
        Route::put('/product/{id}/update', 'update')->name('admin.product.update');
        Route::delete('/product/{id}/destroy', 'destroy')->name('admin.product.destroy');
    });

    // later on
    // Route::prefix('ajax')->group(function () {
    //     Route::get('/products', 'Admin\AdminProductController@getProducts')->name('admin.ajax.getProducts');
    //     // another ajax route here

    // }); //add middleware only.ajax here

}); //add middleware admi.only here
