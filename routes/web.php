<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AdminController;
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

Route::get('/', function () {
    return view('home');
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login/{id}', [AdminController::class, 'login']);

    Route::middleware(['AdminAuthMiddleware'])->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin.index');
        Route::post('/', [AdminController::class, 'store'])->name('admin.store');
    });

    Route::middleware(['AdminAuthMiddleware', 'checkAdminEmail'])->group(function () {
        Route::get('/create', [AdminController::class, 'create'])->name('admin.create');
    });
});


Route::group(['prefix' => 'user'], function () {
    Route::get('/', [UserController::class, 'index'])->name('user.name');
    Route::get('/login', [UserController::class, 'showLoginForm'])->name('user.login');
    Route::post('/login/{id}', [UserController::class, 'login']);
    Route::get('/create', [UserController::class, 'create'])
        ->name('user.create');
    Route::post('/', [UserController::class, 'store'])->name('user.store');
});

Route::group(['prefix' => 'product' ], function() {
    Route::get('/', [ProductsController::class, 'index'])->name('product.name');
    Route::get('/details/{id}', [ProductsController::class, 'show'])->name('product.show');
});