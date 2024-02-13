<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use PharIo\Version\UnsupportedVersionConstraintException;
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
    return view('/welcome');
})->middleware('auth');

Route::middleware('only_guest')->group(function (){
    Route::get('/login',[AuthController::class,'login'])->name('login');
    Route::post('/login',[AuthController::class,'authenticating']);
    Route::get('/register',[AuthController::class,'register']);
    Route::post('/register',[AuthController::class,'registerProcess']);
});

Route::middleware('auth')->group(function (){
    Route::get('/logout',[AuthController::class,'logout']);

    Route::middleware('only_client')->group(function (){
        Route::get('/home',[HomeController::class,'index']);
        Route::post('/add_cart/{id}', [HomeController::class, 'add_cart'])->name('add_cart');
        Route::get('/cart',[HomeController::class, 'cart']);
        Route::get('/cart-delete/{id}',[HomeController::class, 'delete']);
        Route::get('/order',[HomeController::class, 'order']);

        Route::get('/invoice',[InvoiceController::class, 'invoiceClient']);
        Route::get('/invoice-open/{invoice}',[InvoiceController::class, 'invoiceOpen']);
    });

    Route::middleware('only_admin')->group(function (){
        Route::get('/dashboard',[DashboardController::class,'index']);

        Route::get('/invoices',[InvoiceController::class, 'invoiceAdmin']);
        Route::get('/invoices-open/{invoice}',[InvoiceController::class, 'invoiceOpen']);

        Route::get('/items',[ItemController::class,'index']);
        Route::get('/items-add',[ItemController::class,'add']);
        Route::post('/items-add',[ItemController::class,'store']);
        Route::get('/items-edit/{slug}',[ItemController::class,'edit']);
        Route::put('/items-edit/{slug}',[ItemController::class,'update']);
        Route::get('/items-delete/{slug}',[ItemController::class,'delete']);
        Route::get('/items-deleted',[ItemController::class,'deleted']);
        Route::get('/items-restore/{slug}',[ItemController::class,'restore']);

        Route::get('/category',[CategoryController::class,'index']);
        Route::get('/category-add',[CategoryController::class,'add']);
        Route::post('/category-add',[CategoryController::class,'store']);
        Route::get('/category-edit/{slug}',[CategoryController::class,'edit']);
        Route::put('/category-edit/{slug}',[CategoryController::class,'update']);
        Route::get('/category-delete/{slug}',[CategoryController::class,'delete']);
        Route::get('/category-deleted',[CategoryController::class,'deletedCategory']);
        Route::get('/category-restore/{slug}',[CategoryController::class,'restore']);

        Route::get('/user',[UserController::class,'index']);
        Route::get('/user-add',[UserController::class,'add']);
        Route::post('/user-add',[UserController::class,'store']);
        Route::get('/user-edit/{slug}',[UserController::class,'edit']);
        Route::put('/user-edit/{slug}',[UserController::class,'update']);
        Route::get('/user-delete/{slug}',[UserController::class,'delete']);
        Route::get('/user-deleted',[UserController::class,'deleted']);
        Route::get('/user-restore/{slug}',[UserController::class,'restore']);
    });
});
