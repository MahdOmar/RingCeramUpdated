<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\AchatController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\OrderDetailsController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [WelcomeController::class, 'index']);

Route::get('/dashboard/products', [ProductController::class, 'index']);
Route::get('/allproducts', [ProductController::class, 'allProducts']);
Route::get('/dashboard/products/create',[ProductController::class, 'create']);
Route::post('/dashboard/products/update/{id}',[ProductController::class, 'update']);
Route::get('/dashboard/products/update/{id}',[ProductController::class, 'showData']);
Route::get('/dashboard/products/{id}',[ProductController::class, 'showDetails']);
Route::get('/products/filter',[ProductController::class, 'Category']);
Route::post('/dashboard/products',[ProductController::class, 'store']);
Route::get('/dashboard/stock/sort',[ProductController::class, 'filter']);

Route::delete('/dashboard/product/delete',[ProductController::class, 'destroy']);



//Commandes Routes

Route::get('/dashboard/commandes', [CommandeController::class, 'index']);
Route::get('/dashboard/commandes/create',[CommandeController::class, 'create']);
Route::post('/dashboard/commandes',[CommandeController::class, 'store']);
Route::post('/dashboard/commandes/update/{id}',[CommandeController::class, 'update']);
Route::get('/dashboard/commandes/update/{id}',[CommandeController::class, 'showData']  );
Route::delete('/dashboard/commandes/delete',[CommandeController::class, 'destroy']);
Route::post('/dashboard/commandes/complete',[CommandeController::class, 'complete']);
Route::post('/dashboard/commandes/deComplete',[CommandeController::class, 'deComplete']);

//Sales Routes
Route::get('/dashboard/sales', [AchatController::class, 'index']);
Route::post('/dashboard/sales', [AchatController::class, 'index']);

Route::get('/get/type', [OrderDetailsController::class, 'Type'])->name("type");
Route::get('/dashboard/sales/create',[AchatController::class, 'create']);
Route::get('/dashboard/sales/filter',[AchatController::class, 'filter']);
Route::post('/dashboard/order/save',[AchatController::class, 'store']);
Route::post('/dashboard/order/update',[AchatController::class, 'update']);
Route::get('/dashboard/sales/show',[AchatController::class, 'showData']  );
Route::get('/dashboard/sales/download/{id}',[AchatController::class, 'downloadPdf']  );
Route::delete('/dashboard/order/delete',[AchatController::class, 'destroy']);




Route::get('/dashboard/sales/view/{id}',[OrderDetailsController::class, 'showView']);
Route::get('/dashboard/order/{id}/order_details', [OrderDetailsController::class, 'order_details']);
Route::post('/dashboard/order/{id}/order_details', [OrderDetailsController::class, 'store_order_details']);
Route::get('/dashboard/order/order_details/get', [OrderDetailsController::class, 'getOrderDetails']);
Route::get('/dashboard/order/order_details/getProduct', [OrderDetailsController::class, 'getProduct']);
Route::post('/dashboard/order/order_details/update', [OrderDetailsController::class, 'updateOrderDetails']);
Route::delete('/dashboard/order/order_details/delete', [OrderDetailsController::class, 'deleteOrderDetails']);
Route::get('/dashboard/order_item/filter', [OrderDetailsController::class, 'getCategory']);









//Dashboard Routes
Route::get('/dashboard', [DashboardController::class, 'index']);







Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
