<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\DashboardController;


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
    return view('home');
});

Route::group(['prefix' => 'admin'], function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
        Route::post('/login', [AdminController::class, 'login'])->name('admin.login.post');
    });
    
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');

    Route::group(['midleware' => ['auth:sanctum']], function (){
        Route::get('/', [AdminController::class, 'index'])->name('admin.index');
        Route::post('/', [AdminController::class, 'store'])->name('admin.store');
    });

    Route::middleware(['auth:sanctum', 'checkAdminEmail'])->group(function () {
        Route::get('/create', [AdminController::class, 'create'])->name('admin.create');
    });
});


Route::group(['prefix' => 'user'], function () {
    Route::get('/', [UserController::class, 'index'])->name('user.name');
    Route::get('/login', [UserController::class, 'showLoginForm'])->name('user.login');
    Route::post('/login', [UserController::class, 'login'])->name('user.login.post');
    Route::get('/create', [UserController::class, 'create'])
        ->name('user.create');
    Route::post('/', [UserController::class, 'store'])->name('user.store');
});

Route::group(['prefix' => 'products' ], function() {
    Route::get('/', [ProductsController::class, 'index'])->name('product.name');
    Route::get('/{id}', [ProductsController::class, 'show'])->name('product.show');
});


Route::group(['prefix' => 'dashboard'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/products', [DashboardController::class, 'showProducts'])->name('dashboard.products.index');
    Route::get('/products/{id}', [DashboardController::class, 'editProduct'])->name('dashboard.products.edit');
    Route::get('/appearence', [DashboardController::class, 'appearence'])->name('dashboard.appearence.index');
    Route::get('/create', [DashboardController::class, 'createProduct'])->name('dashboard.products.create');
    Route::post('/store', [DashboardController::class, 'productStore'])->name('dashboard.products.store');

});

