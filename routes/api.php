<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\DocumentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('events/gets/{role}', [EventController::class, 'get']);

Route::post('blogs/gets', [BlogController::class, 'get']);

Route::post('files/gets/danh-sach', [FileController::class, 'getDanhSach']);
Route::post('files/gets/van-ban', [FileController::class, 'getVanBan']);
Route::post('files/gets/all', [FileController::class, 'getAll']);

Route::post('upload', [UploadController::class, 'upload']);
Route::delete('upload', [UploadController::class, 'delete']);

Route::get('documents', [DocumentController::class, 'get']);