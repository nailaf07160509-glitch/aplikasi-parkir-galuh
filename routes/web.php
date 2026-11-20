
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PenggunaController;
use App\Http\Controllers\Admin\TarifController;
use App\Http\Controllers\Admin\AreaParkirController;
use App\Http\Controllers\Admin\KendaraanController;
use App\Http\Controllers\Admin\LogAktivitasController;

use App\Http\Controllers\Petugas\TransaksiController;

use App\Http\Controllers\Owner\RekapController;


// ===================== HALAMAN AWAL =====================

Route::get('/', function () {
    return redirect()->route('login');
});


// ===================== AUTENTIKASI =====================

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.post');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');


// ===================== ADMIN =====================

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // DASHBOARD ADMIN
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');


        // USER LAMA
        Route::resource('user', UserController::class);


        // USER BARU / PENGGUNA
        Route::get('/pengguna', [PenggunaController::class, 'index'])
            ->name('pengguna.index');

        Route::get('/pengguna/create', [PenggunaController::class, 'create'])
            ->name('pengguna.create');

        Route::post('/pengguna', [PenggunaController::class, 'store'])
            ->name('pengguna.store');

        Route::get('/pengguna/{id}/edit', [PenggunaController::class, 'edit'])
            ->name('pengguna.edit');

        Route::put('/pengguna/{id}', [PenggunaController::class, 'update'])
            ->name('pengguna.update');

        Route::delete('/pengguna/{id}', [PenggunaController::class, 'destroy'])
            ->name('pengguna.destroy');


        // DATA TARIF
        Route::resource('tarif', TarifController::class);


        // DATA AREA PARKIR
        Route::resource('area', AreaParkirController::class);


        // DATA KENDARAAN
        Route::resource('kendaraan', KendaraanController::class);


        // LOG AKTIVITAS
        Route::get('/log-aktivitas', [LogAktivitasController::class, 'index'])
            ->name('log.index');

    });


// ===================== PETUGAS =====================

Route::middleware(['auth', 'role:petugas'])
    ->prefix('petugas')
    ->name('petugas.')
    ->group(function () {

        // DASHBOARD PETUGAS
        Route::get('/dashboard', function () {
            return view('petugas.dashboard');
        })->name('dashboard');


        // DAFTAR TRANSAKSI
        Route::get('/transaksi', [TransaksiController::class, 'index'])
            ->name('transaksi.index');


        // KENDARAAN MASUK
        Route::get('/transaksi/masuk', [TransaksiController::class, 'formMasuk'])
            ->name('transaksi.formMasuk');

        Route::post('/transaksi/masuk', [TransaksiController::class, 'prosesMasuk'])
            ->name('transaksi.prosesMasuk');


        // KENDARAAN KELUAR
        Route::get('/transaksi/keluar/{id}', [TransaksiController::class, 'formKeluar'])
            ->name('transaksi.formKeluar');

        Route::post('/transaksi/keluar/{id}', [TransaksiController::class, 'prosesKeluar'])
            ->name('transaksi.prosesKeluar');


        // CETAK STRUK
        Route::get('/struk/{id}', [TransaksiController::class, 'cetakStruk'])
            ->name('transaksi.struk');

    });


// ===================== OWNER =====================

Route::middleware(['auth', 'role:owner'])
    ->prefix('owner')
    ->name('owner.')
    ->group(function () {

        // DASHBOARD OWNER
        Route::get('/dashboard', [RekapController::class, 'dashboard'])
            ->name('dashboard');

    });
