<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MaskapaiController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard.dashboard');
});
Route::resource('users', UserController::class);
Route::resource('maskapais', MaskapaiController::class);
Route::resource('transaksis', TransaksiController::class);

Route::get('/tiket', [MaskapaiController::class, 'tiket'])->name('tiket.index');
Route::get('/riwayat', [TransaksiController::class, 'riwayat'])->name('transaksis.riwayat');
Route::post('/transaksis/{id}/confirm', [TransaksiController::class, 'confirmTransaksi'])->name('transaksis.confirm');

Route::resource('login', LoginController::class);
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('home');  // Mengarahkan ke halaman utama menggunakan nama rute 'home'
})->name('logout');

