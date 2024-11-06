<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\WajibController;
use App\Http\Controllers\KapalkuController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\RekeningController;
use App\Http\Controllers\KapalwajibController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\KonfirmasiController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\RetribusiController;
use App\Http\Controllers\BelumRetribusiController;

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
Route::get('/login', [LoginController::class, 'halamanlogin'])->name('login');
route::post('/postlogin', [LoginController::class, 'postlogin'])->name('postlogin');
route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('home', HomeController::class);
    Route::resource('laporan', LaporanController::class);
    Route::resource('rekening', RekeningController::class);
    Route::resource('wajib-retribusi', WajibController::class);
    Route::resource('pembayaran-retribusi', PembayaranController::class);
    Route::resource('kategori-retribusi', KategoriController::class);
    Route::resource('kapal-wajib-retribusi', KapalwajibController::class);
    Route::resource('kapalku', KapalkuController::class);
    Route::resource('konfirmasi', KonfirmasiController::class);
    Route::resource('profil', ProfilController::class);
    Route::resource('retribusi', RetribusiController::class);
    Route::resource('belum-retribusi', BelumRetribusiController::class);
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/ganti-password', [ProfilController::class, 'gantiPassword'])->name('gantiPassword');
    Route::post('/ganti-password', [ProfilController::class, 'prosesGantiPassword'])->name('prosesGantiPassword');
});