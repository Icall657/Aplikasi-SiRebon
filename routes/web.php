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
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/laporan', [LaporanController::class, 'laporan'])->name('laporan');
    Route::get('/rekening-pembayaran', [RekeningController::class, 'rekening'])->name('rekening-pembayaran');
    Route::get('/wajib-retribusi', [WajibController::class, 'retribusi'])->name('wajib-retribusi');
    Route::get('/pembayaran-retribusi', [PembayaranController::class, 'pembayaran'])->name('pembayaran-retribusi');
    Route::get('/kategori-retribusi', [KategoriController::class, 'kategori'])->name('kategori-retribusi');
    Route::get('/kapal-wajib-retribusi', [KapalwajibController::class, 'kapal'])->name('kapal-wajib-retribusi');
    Route::get('/kapalku', [KapalkuController::class, 'kapalku'])->name('kapalku');
    Route::get('/konfimasipembayaran', [KonfirmasiController::class, 'konfirmasi'])->name('konfirmasi');
    Route::get('/profil', [ProfilController::class, 'profil'])->name('profil');
    Route::get('/retribusi', [RetribusiController::class, 'retribusi'])->name('retribusi');Route::get('/retribusi', [RetribusiController::class, 'retribusi'])->name('retribusi');
    Route::get('/belumretribusi', [BelumRetribusiController::class, 'belumretribusi'])->name('belum-retribusi');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/ganti-password', [ProfilController::class, 'gantiPassword'])->name('gantiPassword');
    Route::post('/ganti-password', [ProfilController::class, 'prosesGantiPassword'])->name('prosesGantiPassword');
});

Route::prefix('profil')->group(function () {
    Route::post('/update', [ProfilController::class, 'update'])->name('profil.update');
});