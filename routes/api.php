<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PengaduanController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\InboxController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/pengaduan', [PengaduanController::class, 'index']);
});

Route::middleware('auth:sanctum')->get('/dashboard', [DashboardController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/inbox',                        [InboxController::class, 'index']);
    Route::get('/inbox/{pengaduan_id}',         [InboxController::class, 'show']);
    Route::post('/inbox/{pengaduan_id}/kirim',  [InboxController::class, 'kirim']);
    Route::delete('/inbox/pesan/{tanggapan_id}',[InboxController::class, 'hapusPesan']);
});