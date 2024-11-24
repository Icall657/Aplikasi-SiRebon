<?php

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\WajibController;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\KapalkuController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\RekeningController;
use App\Http\Controllers\RetribusiController;
use App\Http\Controllers\KapalwajibController;
use App\Http\Controllers\KonfirmasiController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\LupaPaswordController;
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
    Route::put('/update-status/{id}', [PembayaranController::class, 'updateStatus'])->name('konfirmasi-bayar.update-status');
    Route::resource('kategori-retribusi', KategoriController::class);
    Route::resource('kapal-wajib-retribusi', KapalwajibController::class);
    Route::resource('kapalku', KapalkuController::class);
    Route::resource('konfirmasi', KonfirmasiController::class);
    Route::post('/konfirmasi/confirm', [KonfirmasiController::class, 'confirm'])->name('konfirmasi.confirm');
    Route::resource('profil', ProfilController::class);
    Route::resource('retribusi', RetribusiController::class);
    Route::resource('belum-retribusi', BelumRetribusiController::class);
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/ganti-password', [ProfilController::class, 'gantiPassword'])->name('gantiPassword');
    Route::post('/ganti-password', [ProfilController::class, 'prosesGantiPassword'])->name('prosesGantiPassword');
});


Route::resource('forgot_password', LupaPaswordController::class);
// Route::get('forgot_password', function () {
//     return view('login.forgot_password');
// })->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    try {
        $status = Password::sendResetLink($request->only('email'));

    } catch (\Exception $e) {
        return back()->withErrors(['email' => 'Error: ' . $e->getMessage()]);
    }

    return $status === Password::RESET_LINK_SENT
        ? back()->with(['status' => __('Kami telah mengirimkan tautan untuk mereset kata sandi Anda')])
        : back()->withErrors(['email' => __('Gagal mengirim tautan reset kata sandi')]);

})->middleware('guest')->name('password.email');



Route::get('/reset-password/{token}', function (string $token) {
    return view('login.reset_password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => [
            'required',
            'string',
            'min:8',
            'regex:/[a-z]/',
            'regex:/[A-Z]/',
            'regex:/[0-9]/',
            'regex:/[@$!%*?&#]/',
            'confirmed',
        ],
    ], [
        'token.required' => 'Token wajib diisi.',
        'email.required' => 'Email wajib diisi.',
        'email.email' => 'Format email tidak valid.',
        'password.required' => 'Password wajib diisi.',
        'password.min' => 'Password harus memiliki minimal 8 karakter.',
        'password.regex' => 'Password harus mengandung setidaknya satu huruf besar, satu huruf kecil, satu angka, dan satu karakter spesial (@$!%*?&#).',
        'password.confirmed' => 'Konfirmasi password tidak cocok.',
    ]);
    
 
    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function (User $user, string $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));
 
            $user->save();
 
            event(new PasswordReset($user));
        }
    );
 
    return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');