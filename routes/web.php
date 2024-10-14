<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\LapanganController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserLoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('halaman.index');
});

Route::get('/halaman/index',[LandingPageController::class,'index'])->name('halaman.index');
Route::get('/halaman/about',[LandingPageController::class,'about'])->name('halaman.about');
Route::get('/halaman/paket',[LandingPageController::class,'paket'])->name('halaman.paket');

Auth::routes();

Route::middleware(['auth', 'role:1'])->group(function () {
    Route::get('/admin/index', [HomeController::class, 'index'])->name('admin.index');

    Route::resource('/admin/lapangan',LapanganController::class);
    Route::resource('/admin/member',MemberController::class);
});

// Rute untuk kasir
Route::middleware(['auth', 'role:2'])->group(function () {
    Route::get('/kasir/index', [HomeController::class, 'index'])->name('kasir.index');

    Route::resource('/kasir/transaksi',TransaksiController::class);
});

// Rute untuk user biasa
Route::middleware(['auth', 'role:0'])->group(function () {
    Route::get('/user/index', [HomeController::class, 'index'])->name('user.index');

    Route::get('/user/index',[UserLoginController::class,'index'])->name('user.index');
    Route::get('/user/about',[UserLoginController::class,'about'])->name('user.about');
    Route::get('/user/paket',[UserLoginController::class,'paket'])->name('user.paket');

    Route::post('/user/transaksi',[TransaksiController::class,'store'])->name('user.transaksi');
});

