<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FooterController;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\SlidesController;
use App\Http\Controllers\ShoppingCartController;



Route::get('/', function () {
    return view('home');
});

Route::group(['prefix' => 'admin'], function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
        Route::post('/login', [AdminController::class, 'login'])->name('admin.login.post');
    });

    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');

    Route::group(['middleware' => 'AdminAuthMiddleware'], function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin.index');
        Route::post('/', [AdminController::class, 'store'])->name('admin.store');
        Route::get('/create', [AdminController::class, 'create'])->name('admin.create');
    });
});


Route::get('/user/login', [UserController::class, 'showLoginForm'])->name('user.login');
Route::post('/user/login', [UserController::class, 'login'])->name('user.login.post');
Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
Route::post('/user/store', [UserController::class, 'store'])->name('user.store');




Route::group(['prefix' => 'user', 'middleware' => 'UserAuthMiddleware'], function () {
    Route::get('/', [UserController::class, 'index'])->name('user.name');
    Route::put('/update_basic/{id}', [UserController::class, 'updateBasic'])->name('user.update_basic');
    Route::post('/add_address/{id}', [UserController::class, 'addAddress'])->name('user.add_address');
    Route::get('/{id}/cart', [ShoppingCartController::class, 'index']);
});

Route::group(['prefix' => 'products'], function () {
    Route::get('/', [ProductsController::class, 'index'])->name('product.name');
    Route::get('/{id}', [ProductsController::class, 'show'])->name('product.show');
    Route::get('/filter/{id}', [ProductsController::class, 'show'])->name('product.show');
});


Route::group(['prefix' => 'dashboard', 'middleware' => 'AdminAuthMiddleware'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/products', [DashboardController::class, 'showProducts'])->name('dashboard.products.index');
    Route::get('/create', [DashboardController::class, 'createProduct'])->name('dashboard.products.create');
    Route::post('/store', [DashboardController::class, 'productStore'])->name('dashboard.products.store');
    Route::get('/products/edit/{id}', [DashboardController::class, 'editProduct'])->name('dashboard.products.edit');
    Route::post('/update/{id}', [DashboardController::class, 'productUpdate'])->name('dashboard.products.update');
    Route::delete('/delete/{id}', [DashboardController::class, 'productDelete'])->name('dashboard.products.delete');
    Route::get('/appearence', [DashboardController::class, 'appearence'])->name('dashboard.appearence.index');
    Route::get('/categories', [CategoryController::class, 'showCategories'])->name('dashboard.categories.index');
    Route::get('/categories/create', [CategoryController::class, 'createCategory'])->name('dashboard.categories.create');
    Route::post('/categories/store', [CategoryController::class, 'categoryStore'])->name('dashboard.category.store');
    Route::get('/categories/edit/{id}', [CategoryController::class, 'editCategory'])->name('dashboard.categories.edit');
    Route::post('/category/update/{id}', [CategoryController::class, 'categoryUpdate'])->name('dashboard.category.update');
    Route::delete('/category/delete/{id}', [CategoryController::class, 'categoryDelete'])->name('dashboard.category.delete');

});


Route::group(['prefix' => 'api'], function () {
    Route::get('/products', [DashboardController::class, 'show']);
    Route::get('/products/active', [DashboardController::class, 'show']);
    Route::get('/products', [ProductsController::class, 'getProducts']);
    Route::get('/category', [CategoryController::class, 'index']);
    Route::get('/colors', [GetApiDataController::class, 'listColors']);
    Route::get('/variations/{id}', [GetApiDataController::class, 'listVariations']);
    Route::get('/products/search',  [ProductsController::class, 'search']);
    Route::get('/products/count', [ProductsController::class, 'countProducts']);
    Route::get('/categories/count', [CategoryController::class, 'countCategories']);
    Route::post('/main-categories/update', [CategoryController::class, 'addMainCategories']);
    Route::get('/main-categories/get', [CategoryController::class, 'getMainCategories']);
    Route::post('/brands/update', [BrandsController::class, 'store']);
    Route::get('/brands/get', [BrandsController::class, 'getBrands']);
    Route::delete('/brands/{id}', [BrandsController::class, 'destroy']);
    Route::post('/footer', [FooterController::class, 'updateFooter']);
    Route::get('/footer/get', [FooterController::class, 'getFooter']);
    Route::post('/slides', [SlidesController::class, 'updateSlides']);
    Route::get('/slides/get', [SlidesController::class, 'getSlides']);
    Route::delete('/slides/{id}', [SlidesController::class, 'destroy']);

});

Route::middleware('auth:user')->get('/api/get', [UserController::class, 'getUser']);


Route::group(['prefix' => 'cart', 'middleware' => 'UserAuthMiddleware'], function () {
    Route::get('/{id}', [ShoppingCartController::class, 'index']);
});
