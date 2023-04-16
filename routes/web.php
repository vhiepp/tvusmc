<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashBoardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use Illuminate\Http\Request;
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

Route::get('/', [HomeController::class, 'index']);

Route::get('/bai-viet/{slug}', [BlogController::class, 'index'])->name('client.blogs');




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

            Route::get('delete', [\App\Http\Controllers\Admin\EventController::class, 'destroy'])->name('admin.events.delete');
        });

        Route::prefix('jobs')->group(function () {

        });







        Route::get('auth/logout', [AdminAuthController::class, 'logout'])->name('admin.auth.logout');

    });


});

Route::post('/files/savepdf', function (Request $request) {
	
    $fileContent = $request->input('content');
    $fileName = $request->input('name') . '.pdf';

    $a2p_client = new \App\Helpers\SavePDF('4c1932dd-2b1e-4cc2-a98d-b02c8ac3c8a0');
    $api_response = $a2p_client->headless_chrome_from_html($fileContent, false, $fileName);
    		
    $response = array();

    $response["pdfUrl"] = $api_response->pdf;
    
    return response()->json($response);

});