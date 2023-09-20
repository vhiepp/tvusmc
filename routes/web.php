<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashBoardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\IntroduceController;
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

Route::get('test', function () {
    return redirect()->back();
});

Route::get('/', [HomeController::class, 'index'])->name('client.home');
Route::get('/gioi-thieu-ve-clb', [IntroduceController::class, 'show'])->name('client.introduces');

Route::get('/bai-viet/{slug}', [BlogController::class, 'show'])->name('client.blogs');

Route::get('/su-kien/{slug}', [EventController::class, 'show'])->name('client.events');
Route::get('/su-kien', [EventController::class, 'index'])->name('client.events.list');

Route::get('/van-ban', [DocumentController::class, 'index'])->name('client.documents.list');

Route::get('/van-ban/{slug}', [DocumentController::class, 'show'])->name('client.documents');

Route::get('van-ban/download', [FileController::class, 'download'])->name('client.files.download');

Route::prefix('auth')->group(function () {

    Route::middleware('login.false')->prefix('login')->group(function () {

        Route::get('/', [AuthController::class, 'index'])->name('auth.login');


        Route::get('/microsoft', [AuthController::class, 'microsoftLogin'])->name('auth.login.microsoft');
        Route::get('/microsoft/callback', [AuthController::class, 'callbackMicrosoftLogin']);

        Route::get('/google', [AuthController::class, 'googleLogin'])->name('auth.login.google');
        Route::get('/google/callback', [AuthController::class, 'callbackGoogleLogin']);

    });

    Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');

});

Route::middleware('login.true')->group(function () {

    Route::prefix('jobs')->group(function () {
        Route::get('sub', [JobController::class, 'userSub'])->name('jobs.sub');

        Route::post('proof', [FileController::class, 'uploadProofForJob'])->name('jobs.proof');
    });

    Route::prefix('thong-tin-ca-nhan')->group(function () {

        Route::get('/', [UserController::class, 'index'])->name('profile.view');

        Route::get('chinh-sua', [UserController::class, 'edit'])->name('profile.edit');
        Route::post('chinh-sua', [UserController::class, 'update']);

    });

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

            Route::get('edit', [\App\Http\Controllers\Admin\BlogController::class, 'edit'])->name('admin.blogs.edit');
            Route::post('edit', [\App\Http\Controllers\Admin\BlogController::class, 'update']);

            Route::get('delete', [\App\Http\Controllers\Admin\BlogController::class, 'destroy'])->name('admin.blogs.delete');

        });

        Route::prefix('categories')->group(function () {

            Route::get('/', [\App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('admin.categories');
            Route::post('create', [\App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('admin.categories.create');

            Route::get('delete', [\App\Http\Controllers\Admin\CategoryController::class, 'destroy'])->name('admin.categories.delete');

        });

        Route::prefix('events')->group(function () {

            Route::get('/', [\App\Http\Controllers\Admin\EventController::class, 'index'])->name('admin.events');

            Route::get('create', [\App\Http\Controllers\Admin\EventController::class, 'create'])->name('admin.events.create');
            Route::post('create', [\App\Http\Controllers\Admin\EventController::class, 'store']);

            Route::get('active', [\App\Http\Controllers\Admin\EventController::class, 'active'])->name('admin.events.active');

            Route::get('preview', [\App\Http\Controllers\Admin\EventController::class, 'show'])->name('admin.events.preview');

            Route::get('edit', [\App\Http\Controllers\Admin\EventController::class, 'edit'])->name('admin.events.edit');
            Route::post('edit', [\App\Http\Controllers\Admin\EventController::class, 'update']);

            Route::get('delete', [\App\Http\Controllers\Admin\EventController::class, 'destroy'])->name('admin.events.delete');
        });

        Route::prefix('documents')->group(function () {

            Route::get('/', [\App\Http\Controllers\Admin\DocumentController::class, 'index'])->name('admin.documents');

            Route::get('create', [\App\Http\Controllers\Admin\DocumentController::class, 'create'])->name('admin.documents.create');
            Route::post('create', [\App\Http\Controllers\Admin\DocumentController::class, 'store']);

            // Route::get('active', [\App\Http\Controllers\Admin\DocumentController::class, 'active'])->name('admin.documents.active');

            Route::get('preview', [\App\Http\Controllers\Admin\DocumentController::class, 'show'])->name('admin.documents.preview');

            Route::get('edit', [\App\Http\Controllers\Admin\DocumentController::class, 'edit'])->name('admin.documents.edit');
            Route::post('edit', [\App\Http\Controllers\Admin\DocumentController::class, 'update']);

            Route::get('delete', [\App\Http\Controllers\Admin\DocumentController::class, 'destroy'])->name('admin.documents.delete');
        });

        Route::prefix('introduces')->group(function () {
            Route::get('/', [\App\Http\Controllers\Admin\IntroduceController::class, 'show'])->name('admin.introduces');

            Route::get('edit', [\App\Http\Controllers\Admin\IntroduceController::class, 'edit'])->name('admin.introduces.edit');
            Route::post('edit', [\App\Http\Controllers\Admin\IntroduceController::class, 'update']);
        });


        Route::prefix('jobs')->group(function () {

            Route::post('create/{event}', [\App\Http\Controllers\Admin\JobController::class, 'storeForEvent'])->name('admin.jobs.store.event');

            Route::get('delete/{id}', [\App\Http\Controllers\Admin\JobController::class, 'destroy'])->name('admin.jobs.delete');
            Route::get('delete', [\App\Http\Controllers\Admin\JobController::class, 'destroyUser'])->name('admin.jobs.delete.user');

            Route::get('edit/{id}', [\App\Http\Controllers\Admin\JobController::class, 'edit'])->name('admin.jobs.edit');
            Route::post('edit/{id}', [\App\Http\Controllers\Admin\JobController::class, 'update']);

            Route::get('preview', [\App\Http\Controllers\Admin\JobController::class, 'show'])->name('admin.jobs.preview');

        });

        Route::prefix('users')->group(function () {

            Route::get('/', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users');

            Route::post('edit', [\App\Http\Controllers\Admin\UserController::class, 'update'])->name('admin.users.edit');
            
            Route::get('delete/{id}', [\App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('admin.users.delete');
        });




        Route::get('auth/logout', [AdminAuthController::class, 'logout'])->name('admin.auth.logout');

        Route::prefix('files')->group(function () {

            Route::get('/', [\App\Http\Controllers\Admin\FileController::class, 'index'])->name('admin.files');

            Route::get('/create', [\App\Http\Controllers\Admin\FileController::class, 'create'])->name('admin.files.create');
            Route::post('/create', [\App\Http\Controllers\Admin\FileController::class, 'store']);

            Route::get('/delete', [\App\Http\Controllers\Admin\FileController::class, 'destroy'])->name('admin.files.delete');

            Route::get('/download', [\App\Http\Controllers\Admin\FileController::class, 'download'])->name('admin.files.download');

        });

    });


});

Route::prefix('files')->group(function () {

    Route::post('savepdf', function (Request $request) {

        $fileContent = $request->input('content');
        $fileName = $request->input('name') . '.pdf';

        $a2p_client = new \App\Helpers\SavePDF('4c1932dd-2b1e-4cc2-a98d-b02c8ac3c8a0');
        $api_response = $a2p_client->headless_chrome_from_html($fileContent, false, $fileName);

        $response = array();

        $response["pdfUrl"] = $api_response->pdf;

        return response()->json($response);

    });

    Route::get('download/jobuser', [FileController::class, 'downloadListJobUser'])->name('files.downoad.jobuser');
});
