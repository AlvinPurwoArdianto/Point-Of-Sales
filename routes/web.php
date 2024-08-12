<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\menuController;
use App\Http\Controllers\pembayaranController;
use App\Http\Controllers\RekapanController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['auth', IsAdmin::class]], function () {
    Route::get('', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('kategori', KategoriController::class);
    Route::resource('menu', menuController::class);
    Route::resource('user', UserController::class);
});

Route::resource('admin/pembayaran', pembayaranController::class);

Route::group(['prefix' => 'kasir', 'middleware' => ['auth']], function () {
    Route::get('', [KasirController::class, 'menampilkan'])->name('kasir');
    Route::get('filter', [RekapanController::class, 'filter'])->name('filter');
    Route::get('rekapan', [RekapanController::class, 'index'])->name('rekapan');
    Route::get('bayar', [KasirController::class, 'bayar'])->name('bayar');
    Route::get('cetak-struk', [RekapanController::class, 'cetakStruk'])->name('cetak-struk');

});

Auth::routes();
Route::get('auth/home', [App\Http\Controllers\Auth\HomeController::class, 'index'])->name('auth.home')->middleware('isAdmin');
Route::get('user/home', [App\Http\Controllers\User\HomeController::class, 'index'])->name('user.home');

// Route::get('/', function () {

// })->middleware('auth');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
