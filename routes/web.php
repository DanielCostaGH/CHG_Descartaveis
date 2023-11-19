<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorsController;



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


Route::get('/user/login', [UserController::class, 'showLoginForm'])->name('user.login');
Route::post('user/login', [UserController::class, 'login'])->name('user.login.post');




Route::group(['prefix' => 'user', 'middleware' => 'UserAuthMiddleware'], function () {
    Route::get('/', [UserController::class, 'index'])->name('user.name');
    Route::put('/update_basic/{id}', [UserController::class, 'updateBasic'])->name('user.update_basic');
    Route::post('/add_address/{id}', [UserController::class, 'addAddress'])->name('user.add_address');
    Route::get('/create', [UserController::class, 'create'])
        ->name('user.create');
    Route::post('/', [UserController::class, 'store'])->name('user.store');
});

Route::group(['prefix' => 'products' ], function() {
    Route::get('/', [ProductsController::class, 'index'])->name('product.name');
    Route::get('/{id}', [ProductsController::class, 'show'])->name('product.show');
});


Route::group(['prefix' => 'dashboard', 'middleware' => 'AdminAuthMiddleware'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/products', [DashboardController::class, 'showProducts'])->name('dashboard.products.index');
    Route::get('/products/edit/{id}', [DashboardController::class, 'editProduct'])->name('dashboard.products.edit');
    Route::get('/appearence', [DashboardController::class, 'appearence'])->name('dashboard.appearence.index');
    Route::get('/create', [DashboardController::class, 'createProduct'])->name('dashboard.products.create');
    Route::post('/store', [DashboardController::class, 'productStore'])->name('dashboard.products.store');
    Route::put('/update', [DashboardController::class, 'productUpdate'])->name('dashboard.products.update');
});


Route::group(['prefix' => 'api'], function(){
    Route::get('/products', [DashboardController::class, 'show']);
    Route::get('/products/active', [DashboardController::class, 'show']);
    Route::get('/products', [ProductsController::class, 'getProducts']);
    Route::get('/category', [CategoryController::class, 'index']);
    Route::get('/colors', [ColorsController::class, 'listColors']);
    Route::get('/products/search',  [ProductsController::class, 'search']);

});



