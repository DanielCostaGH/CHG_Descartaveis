<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\AdminAuthMiddleware;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Route::get('/', function () {
//     return view('home');
// });

Route::group(['prefix' => 'admin'], function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AdminController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AdminController::class, 'login'])->name('admin.login.post');
    });
    
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');

    Route::group(['middleware' => ['auth:sanctum']], function (){
        Route::get('/', [AdminController::class, 'index'])->name('admin.index');
        Route::post('/', [AdminController::class, 'store'])->name('admin.store');
    });

    Route::middleware(['auth:sanctum', 'checkAdminEmail'])->group(function () {
        Route::get('/create', [AdminController::class, 'create'])->name('admin.create');
    });
});


Route::group(['prefix' => 'user'], function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [UserController::class, 'showLoginForm'])->name('user.login');
        Route::post('/login', [UserController::class, 'login'])->name('user.login.post');
        Route::get('/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/', [UserController::class, 'store'])->name('user.store');

    });

    Route::post('/logout', [AdminController::class, 'logout'])->name('user.logout');
    // Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::get('/', [UserController::class, 'index'])->name('user.index');
    // }); 
});

Route::group(['prefix' => 'products' ], function() {
    Route::get('/', [ProductsController::class, 'index'])->name('product.name');
    Route::get('/{id}', [ProductsController::class, 'show'])->name('product.show');
});


Route::group(['prefix' => 'dashboard', 'middleware' => ['adminAuthMiddleware']], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/products', [DashboardController::class, 'showProducts'])->name('dashboard.products.index');
    Route::get('/products/edit/{id}', [DashboardController::class, 'editProduct'])->name('dashboard.products.edit');
    Route::get('/appearence', [DashboardController::class, 'appearence'])->name('dashboard.appearence.index');
    Route::get('/create', [DashboardController::class, 'createProduct'])->name('dashboard.products.create');
    Route::post('/store', [DashboardController::class, 'productStore'])->name('dashboard.products.store');
    Route::put('/update', [DashboardController::class, 'productUpdate'])->name('dashboard.products.update');
});



Route::get('/get-csrf-token', function () {
    return response()->json(['csrfToken' => csrf_token()]);
});
