<?php

use App\Http\Controllers\Admin\AdminCustomerController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminInventoryController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Cashier\DashboardController;
use App\Http\Controllers\Cashier\TransactionAjaxController;
use App\Http\Controllers\Cashier\TransactionController;
use App\Http\Controllers\RedirectController;
use Illuminate\Support\Facades\Route;


// use Illuminate\Support\Facades\Route;

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
    return view('welcome'); }
);

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::group(['middleware' => 'auth'], function() {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/redirect', [RedirectController::class, 'redirectUser'])->name('redirect.user');

    Route::group(['middleware' => 'role:1,2'], function () {
        Route::prefix('admin')->group(function () {
            Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.index');

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

            Route::controller(AdminUserController::class)->group(function () {
                Route::get('/users', 'index')->name('admin.user.index');
                Route::get('/user/create', 'create')->name('admin.user.create');
                Route::get('/user/{user}', 'show')->name('admin.user.show');
                Route::post('/user/store', 'store')->name('admin.user.store');
                Route::get('/user/{user}/edit', 'edit')->name('admin.user.edit');
                Route::post('/user/{user}/update', 'update')->name('admin.user.update');
                Route::get('/user/{user}/destroy', 'destroy')->name('admin.user.destroy');
            });

            // later on
            Route::prefix('ajax')->group(function () {
                // another ajax route here
            }); //add middleware only.ajax here

        });
    });
});

Route::group(['prefix' => 'cashier', 'namespace' => 'Cashier'], function () {

    Route::get('/login', [AuthController::class, 'cashierLoginForm'])->name('cashier.login');
    Route::post('/login', [AuthController::class, 'cashierLogin'])->name('cashier.login');

    Route::group(['middleware' => 'cashier'], function(){

        Route::post('/logout', [AuthController::class, 'logout'])->name('cashier.logout');

        Route::get('/', [DashboardController::class, 'index'])->name('cashier.index');
        Route::get('/transaction', [TransactionController::class, 'index'])->name('cashier.transaction.index');
    });

    Route::group(['middleware' => 'only.ajax'], function () {
        Route::get('/search/inventories', [TransactionAjaxController::class, 'inventories'])->name('cashier.inventories.search');
        Route::get('/search/inventory/{inventory}', [TransactionAjaxController::class, 'inventory'])->name('cashier.inventory.search.details');
        Route::get('/search/customers', [TransactionAjaxController::class, 'customers'])->name('cashier.customers.search');
        Route::post('/transaction/store', [TransactionAjaxController::class, 'transactionStore'])->name('cashier.transaction.store');
        Route::post('/transaction/details/store', [TransactionAjaxController::class, 'transactionDetailsStore'])->name('cashier.transaction.detail.store');
    });
});
