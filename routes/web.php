<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\Auth\RegisterController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::prefix('/admin')->name('admin.')->group(function (){
    Route::middleware('auth:admin')->group(function (){
        Route::get('/', [AdminController::class,'index'])->name('index');
    });
    Route::get('/register', [RegisterController::class, 'showAdminRegisterForm'])->name('register');
    Route::get('/login', [LoginController::class, 'showAdminLoginForm'])->name('login');
    Route::post('/register', [RegisterController::class, 'createAdmin'])->name('register');
    Route::post('/login', [LoginController::class, 'adminLogin'])->name('login');
    Route::get('/subscription/cancel/{customer?}', [SubscriptionController::class, 'cancel'])->name('subscription.cancel');
});

Route::prefix('/customer')->name('customer.')->group(function (){
    Route::middleware('auth:customer')->group(function (){
        Route::get('/', [CustomerController::class,'index'])->name('index');
        Route::get('/products', [ProductController::class, 'getAllProducts'])->name('products.index');
        Route::get('/products/{id}', [ProductController::class, 'productDetails'])->name('products.show');
        Route::get('/product/purchase/{product}', [ProductController::class, 'show'])->name('product.purchase');
      
    });
    Route::get('/register', [RegisterController::class, 'showCustomerRegisterForm'])->name('register');
    Route::get('/login', [LoginController::class, 'showCustomerLoginForm'])->name('login');
    Route::post('/register', [RegisterController::class, 'createCustomer'])->name('register');
    Route::post('/login', [LoginController::class, 'customerLogin'])->name('login');
});

Route::middleware("auth:customer")->group(function () {
    Route::post('/subscription', [SubscriptionController::class, 'create'])->name('subscription.create');
    Route::get('/subscription/cancel', [SubscriptionController::class, 'cancel'])->name('subscription.destroy');

});