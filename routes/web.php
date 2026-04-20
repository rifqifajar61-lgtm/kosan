<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PenghuniController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\SewaController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Redirect Awal
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect('/home');
});

Route::get('/users', function () {
    return view('users');
});

/*
|--------------------------------------------------------------------------
| Auth (PUBLIC - tanpa middleware)
|--------------------------------------------------------------------------
*/
Route::get('/login',  [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'prosesLogin'])->name('login.post');
Route::post('/logout',[AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Halaman Admin (PROTECTED - wajib login)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Penghuni
    Route::get('/penghuni',              [PenghuniController::class, 'index'])->name('penghuni');
    Route::get('/penghuni/tambah',       [PenghuniController::class, 'create'])->name('penghuni.tambah');
    Route::post('/penghuni/simpan',      [PenghuniController::class, 'store'])->name('penghuni.simpan');
    Route::get('/penghuni/edit/{id}',    [PenghuniController::class, 'edit'])->name('penghuni.edit');
    Route::put('/penghuni/update/{id}', [PenghuniController::class, 'update'])->name('penghuni.update');
    Route::get('/penghuni/hapus/{id}',   [PenghuniController::class, 'destroy'])->name('penghuni.hapus');

    // Kamar
    Route::get('/kamar',              [KamarController::class, 'index'])->name('kamar');
    Route::get('/kamar/tambah',       [KamarController::class, 'create'])->name('kamar.tambah');
    Route::post('/kamar/simpan',      [KamarController::class, 'store'])->name('kamar.simpan');
    Route::get('/kamar/edit/{id}',    [KamarController::class, 'edit'])->name('kamar.edit');
    Route::post('/kamar/update/{id}', [KamarController::class, 'update'])->name('kamar.update');
    Route::get('/kamar/hapus/{id}',   [KamarController::class, 'destroy'])->name('kamar.hapus');

    // Sewa
    Route::get('/sewa',              [SewaController::class, 'index'])->name('sewa');
    Route::get('/sewa/tambah',       [SewaController::class, 'create'])->name('sewa.tambah');
    Route::post('/sewa/simpan',      [SewaController::class, 'store'])->name('sewa.simpan');
    Route::get('/sewa/edit/{id}',    [SewaController::class, 'edit'])->name('sewa.edit');
    Route::post('/sewa/update/{id}', [SewaController::class, 'update'])->name('sewa.update');
    Route::get('/sewa/hapus/{id}',   [SewaController::class, 'destroy'])->name('sewa.hapus');
    Route::get('/sewa/{id}/detail',  [SewaController::class, 'detail'])->name('sewa.detail');
    Route::post('/sewa/{id}/tandai-bayar', [SewaController::class, 'tandaiBayar'])->name('sewa.tandai-bayar');
    Route::post('/sewa/{id}/batal-bayar', [SewaController::class, 'batalBayar'])->name('sewa.batal-bayar');

    // Pemasukan
    Route::get('/pemasukan',              [PemasukanController::class, 'index'])->name('pemasukan');
    Route::get('/pemasukan/tambah',       [PemasukanController::class, 'create'])->name('pemasukan.tambah');
    Route::post('/pemasukan/simpan',      [PemasukanController::class, 'store'])->name('pemasukan.simpan');
    Route::get('/pemasukan/sewa-info/{id}', [PemasukanController::class, 'sewaInfo'])->name('pemasukan.sewaInfo');
    Route::get('/pemasukan/{id}/edit', [PemasukanController::class, 'edit'])
    ->name('pemasukan.edit');
    Route::put('/pemasukan/{id}', [PemasukanController::class, 'update'])
    ->name('pemasukan.update');

    // Pengeluaran
    Route::get('/pengeluaran',         [PengeluaranController::class, 'index'])->name('pengeluaran');
    Route::get('/pengeluaran/tambah',  [PengeluaranController::class, 'create'])->name('pengeluaran.tambah');
    Route::post('/pengeluaran/simpan', [PengeluaranController::class, 'store'])->name('pengeluaran.simpan');
    Route::get('/pengeluaran/{id}/edit',          [PengeluaranController::class, 'edit'])->name('pengeluaran.edit');
Route::put('/pengeluaran/{id}/update',        [PengeluaranController::class, 'update'])->name('pengeluaran.update');

    // Laporan
    Route::get('/laporan',  [LaporanController::class, 'index'])->name('laporan');
    Route::post('/laporan', [LaporanController::class, 'filter'])->name('laporan.filter');

});

Route::get('/api/penghuni', function(){

return \App\Models\Penghuni::orderBy('created_at','desc')->get();

});