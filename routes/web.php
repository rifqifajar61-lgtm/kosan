<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PenghuniController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\SewaController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\LaporanController;
/*
|--------------------------------------------------------------------------
| Redirect Awal
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect('/login');
});

/*
|--------------------------------------------------------------------------
| Auth
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'prosesLogin']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Halaman Admin (Protected)
|--------------------------------------------------------------------------
*/
Route::middleware('auth.admin')->group(function () {

    Route::get('/home', function () {
        return view('home');
    })->name('home');

    Route::get('/penghuni', [PenghuniController::class, 'index'])->name('penghuni');
    Route::get('/penghuni/tambah', [PenghuniController::class, 'create'])->name('penghuni.tambah');
    Route::post('/penghuni/simpan', [PenghuniController::class, 'store'])->name('penghuni.simpan');

    Route::get('/kamar', [KamarController::class, 'index']);
    Route::get('/kamar/tambah', [KamarController::class, 'create']);
    Route::post('/kamar/simpan', [KamarController::class, 'store']);

    Route::get('/sewa', [SewaController::class, 'index']);
    Route::get('/sewa/tambah', [SewaController::class, 'create']);
    Route::post('/sewa/simpan', [SewaController::class, 'store']);

    Route::get('/pemasukan', [PemasukanController::class, 'index']);
    Route::get('/pemasukan/tambah', [PemasukanController::class, 'create']);
    Route::post('/pemasukan/simpan', [PemasukanController::class, 'store']);

    Route::get('/pengeluaran', [PengeluaranController::class, 'index']);
    Route::get('/pengeluaran/tambah', [PengeluaranController::class, 'create']);
    Route::post('/pengeluaran/simpan', [PengeluaranController::class, 'store']);

    Route::get('/laporan', [LaporanController::class, 'index']);
    Route::post('/laporan', [LaporanController::class, 'filter']);
 
});
