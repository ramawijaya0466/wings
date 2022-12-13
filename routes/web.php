<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CheckoutSuccessController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::resource('product', ProductController::class);

Route::middleware(['auth'])->group(function () {
	Route::resource('cart', CartController::class)->only(['store', 'update', 'destroy']);
	Route::resource('checkout', CheckoutController::class)->only(['index', 'store']);
    Route::get('/checkout-success', [CheckoutSuccessController::class, 'index'])->name('checkout.success');
	Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware(['auth.admin'])->group(function () {
      Route::get('/report', [ReportController::class, 'index'])->name('report');
      Route::get('/report/pagination', [ReportController::class, 'pagination'])->name('report.pagination');
    });
});
