<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
use App\Http\Middleware\AuthCheck;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function() {
    redirect('products');
});

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'authenticate']);
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(AuthCheck::class)->group(function () {
    Route::controller(ProductController::class)->prefix('products')->group(function() {
        Route::get('/', 'index')->name('products');
        Route::post('add', 'add')->name('addProduct');
        Route::get('{productID}/delete', 'delete')->name('deleteProduct');
    });

    Route::controller(StockController::class)->prefix('stocks')->group(function() {
        Route::get('supply', 'supply')->name('supply');
        Route::post('add', 'add')->name('add');
        Route::get('sell', 'sell')->name('sell');
        Route::post('remove', 'remove')->name('remove');
        Route::get('reports', 'reports')->name('reports');
        Route::post('reports/generate', 'generateReport')->name('generateReport');
    });
}); 
