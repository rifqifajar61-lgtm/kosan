<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PenghuniApiController;
use App\Http\Controllers\Api\KamarApiController;
use App\Http\Controllers\Api\SewaApiController;
use App\Http\Controllers\Api\PemasukanApiController;
use App\Http\Controllers\Api\PengeluaranApiController;
use App\Http\Controllers\Api\LaporanApiController;
use App\Http\Controllers\Api\LoginApiController;


Route::post('/login', [LoginApiController::class, 'login']);

/*
|--------------------------------------------------------------------------
| API PENGHUNI
|--------------------------------------------------------------------------
*/
Route::get('/penghuni', [PenghuniApiController::class, 'index']);
Route::get('/penghuni/{id}', [PenghuniApiController::class, 'show']);
Route::post('/penghuni', [PenghuniApiController::class, 'store']);
Route::put('/penghuni/{id}', [PenghuniApiController::class, 'update']);
Route::delete('/penghuni/{id}', [PenghuniApiController::class, 'destroy']);


/*
|--------------------------------------------------------------------------
| API KAMAR
|--------------------------------------------------------------------------
*/
Route::get('/kamar', [KamarApiController::class, 'index']);
Route::get('/kamar/{id}', [KamarApiController::class, 'show']);
Route::post('/kamar', [KamarApiController::class, 'store']);
Route::put('/kamar/{id}', [KamarApiController::class, 'update']);
Route::delete('/kamar/{id}', [KamarApiController::class, 'destroy']);


/*
|--------------------------------------------------------------------------
| API SEWA
|--------------------------------------------------------------------------
*/
Route::get('/sewa', [SewaApiController::class, 'index']);
Route::get('/sewa/{id}', [SewaApiController::class, 'show']);
Route::post('/sewa', [SewaApiController::class, 'store']);
Route::put('/sewa/{id}', [SewaApiController::class, 'update']);
Route::delete('/sewa/{id}', [SewaApiController::class, 'destroy']);


/*
|--------------------------------------------------------------------------
| API PEMASUKAN
|--------------------------------------------------------------------------
*/
Route::get('/pemasukan', [PemasukanApiController::class, 'index']);
Route::get('/pemasukan/{id}', [PemasukanApiController::class, 'show']);
Route::post('/pemasukan', [PemasukanApiController::class, 'store']);
Route::put('/pemasukan/{id}', [PemasukanApiController::class, 'update']);
Route::delete('/pemasukan/{id}', [PemasukanApiController::class, 'destroy']);


/*
|--------------------------------------------------------------------------
| API PENGELUARAN
|--------------------------------------------------------------------------
*/
Route::get('/pengeluaran', [PengeluaranApiController::class, 'index']);
Route::get('/pengeluaran/{id}', [PengeluaranApiController::class, 'show']);
Route::post('/pengeluaran', [PengeluaranApiController::class, 'store']);
Route::put('/pengeluaran/{id}', [PengeluaranApiController::class, 'update']);
Route::delete('/pengeluaran/{id}', [PengeluaranApiController::class, 'destroy']);


/*
|--------------------------------------------------------------------------
| API LAPORAN
|--------------------------------------------------------------------------
*/
Route::get('/laporan', [LaporanApiController::class, 'index']);
Route::post('/laporan/filter', [LaporanApiController::class, 'filter']);