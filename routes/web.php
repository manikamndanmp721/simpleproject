<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\ProductController;

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
Route::group(['prefix' => 'product'], function () {

    Route::get('/index', [ProductController::class, 'index']);
    Route::get('/add', [ProductController::class, 'addProduct']);
    Route::post('/store', [ProductController::class, 'store']);
    Route::get('/edit/{product_id}', [ProductController::class, 'edit']);
    Route::post('/product', [ProductController::class, 'updateProduct'])->name("product.update");
    Route::get('/delete/{product_id}', [ProductController::class, 'delete']);
    Route::get('/order', [ProductController::class, 'order']);
    Route::post('/order-store', [ProductController::class, 'saveOrder']);
    Route::get('/order-list', [ProductController::class, 'orderList']);
    Route::get('/get-orders', [ProductController::class, 'getOrders'])->name('get.orders');
    Route::get('/order-edit/{id}', [ProductController::class, 'orderEdit']);
    Route::delete('/order-delete/{id}',[ProductController::class, 'deleteOrder']);
    Route::post('/order-update', [ProductController::class, 'updateOrder'])->name("orderupdate");
    Route::get('/get-invoice/{id}', [ProductController::class, 'getInvoice']);


});
