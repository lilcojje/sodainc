<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TruckingController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SalesController;

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
    return redirect()->action([HomeController::class, 'index']);
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::get('/customer', [CustomerController::class, 'index'])->name('customer.index');
Route::get('/trucking', [TruckingController::class, 'index'])->name('trucking.index');
Route::get('/sales', [SalesController::class, 'index'])->name('sales.index');
Route::get('/order', [OrderController::class, 'index'])->name('order.index');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/order/get', [OrderController::class, 'getData'])->name('get.order');
Route::get('/customer/get', [CustomerController::class, 'getData'])->name('get.customer');
Route::get('/trucking/get', [TruckingController::class, 'getData'])->name('get.trucking');
Route::get('/sales/get', [SalesController::class, 'getData'])->name('get.sales');

// Route::get('/user.get_data',[UserController::class, 'get_data'])->name('get_data');
Route::resource('users', UsersController::class);
Route::resource('trucking', TruckingController::class);
Route::resource('order', OrderController::class);
Route::resource('customer', CustomerController::class);
Route::resource('sales', SalesController::class);
Route::post('/customer/search', [CustomerController::class, 'listSearch'])->name('customer.search');
Route::post('/trucking/search', [TruckingController::class, 'listSearch'])->name('trucking.search');
Route::post('/order/customer', [OrderController::class, 'customerOrder'])->name('customer.order');
Route::post('/order/view', [OrderController::class, 'viewOrder'])->name('view.order');
