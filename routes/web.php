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
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'prosesLogin'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



/*
|--------------------------------------------------------------------------
| Halaman Admin (Protected)
|--------------------------------------------------------------------------
*/


   Route::get('/home', function () {
    return view('home');
})->name('home');

    Route::get('/penghuni', [PenghuniController::class, 'index'])->name('penghuni');
    Route::get('/penghuni/tambah', [PenghuniController::class, 'create'])->name('penghuni.tambah');
    Route::post('/penghuni/simpan', [PenghuniController::class, 'store'])->name('penghuni.simpan');
    Route::get('/penghuni/edit/{id}', [PenghuniController::class, 'edit'])->name('penghuni.edit');
    Route::post('/penghuni/update/{id}', [PenghuniController::class, 'update'])->name('penghuni.update');
    Route::get('/penghuni/hapus/{id}', [PenghuniController::class, 'destroy'])->name('penghuni.hapus');

    Route::get('/kamar', [KamarController::class, 'index'])->name('kamar');
    Route::get('/kamar/tambah', [KamarController::class, 'create'])->name('kamar.tambah');
    Route::post('/kamar/simpan', [KamarController::class, 'store'])->name('kamar.simpan');
    Route::get('/kamar/edit/{id}', [KamarController::class, 'edit'])->name('kamar.edit');
    Route::post('/kamar/update/{id}', [KamarController::class, 'update'])->name('kamar.update');
    Route::get('/kamar/hapus/{id}', [KamarController::class, 'destroy'])->name('kamar.hapus');

    Route::get('/sewa', [SewaController::class, 'index'])->name('sewa');
    Route::get('/sewa/tambah', [SewaController::class, 'create'])->name('sewa.tambah');
    Route::post('/sewa/simpan', [SewaController::class, 'store'])->name('sewa.simpan');


    Route::get('/pemasukan', [PemasukanController::class, 'index'])->name('pemasukan');
    Route::get('/pemasukan/tambah', [PemasukanController::class, 'create'])->name('pemasukan.tambah');
    Route::post('/pemasukan/simpan', [PemasukanController::class, 'store'])->name('pemasukan.simpan');

    Route::get('/pengeluaran', [PengeluaranController::class, 'index'])->name('pengeluaran');
    Route::get('/pengeluaran/tambah', [PengeluaranController::class, 'create'])->name('pengeluaran.tambah');
    Route::post('/pengeluaran/simpan', [PengeluaranController::class, 'store'])->name('pengeluaran.simpan');

    Route::get('/laporan', [LaporanController::class, 'index']);
    Route::post('/laporan', [LaporanController::class, 'filter']);
 

