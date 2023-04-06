<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminAuthController;
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

        Route::get('/', function () {
            return redirect()->route('admin.dashboard');
        });

        Route::get('dashboard', function () {
            return view('admin.master', [
                'title' => 'Quản trị'
            ]);
        })->name('admin.dashboard');


        Route::get('auth/logout', [AdminAuthController::class, 'logout'])->name('admin.auth.logout');

    });


});