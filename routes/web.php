<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashBoardController;
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



Route::prefix('admin')->group(function () {

    Route::prefix('auth')->group(function () {

        Route::get('login', [AdminAuthController::class, 'index'])->name('admin.auth.login');
        Route::post('login', [AdminAuthController::class, 'checkLogin']);

    });

    Route::middleware('admin.auth.login')->group(function () {

        Route::get('/', function () { return redirect()->route('admin.dashboard'); });

        Route::get('dashboard', [DashBoardController::class, 'index'])->name('admin.dashboard');

        Route::prefix('blogs')->group(function () {

            Route::get('/', [\App\Http\Controllers\Admin\BlogController::class, 'index'])->name('admin.blogs');

            Route::get('create', [\App\Http\Controllers\Admin\BlogController::class, 'create'])->name('admin.blogs.create');
            Route::post('create', [\App\Http\Controllers\Admin\BlogController::class, 'store']);

            Route::get('active', [\App\Http\Controllers\Admin\BlogController::class, 'active'])->name('admin.blogs.active');

            Route::get('preview', [\App\Http\Controllers\Admin\BlogController::class, 'show'])->name('admin.blogs.preview');
            
            Route::get('delete', [\App\Http\Controllers\Admin\BlogController::class, 'destroy'])->name('admin.blogs.delete');

        });

        Route::prefix('categories')->group(function () {

            Route::get('/', [\App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('admin.categories');
            Route::post('create', [\App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('admin.categories.create');

            Route::get('delete', [\App\Http\Controllers\Admin\CategoryController::class, 'destroy'])->name('admin.categories.delete');
            // toi day
        });
        
        Route::prefix('events')->group(function () {

            Route::get('/', [\App\Http\Controllers\Admin\EventController::class, 'index'])->name('admin.events');

            Route::get('create', [\App\Http\Controllers\Admin\EventController::class, 'create'])->name('admin.events.create');
            Route::post('create', [\App\Http\Controllers\Admin\EventController::class, 'store']);
        });

        Route::prefix('jobs')->group(function () {

        });







        Route::get('auth/logout', [AdminAuthController::class, 'logout'])->name('admin.auth.logout');

    });


});