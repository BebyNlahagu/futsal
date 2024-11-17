<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BayarController;
use App\Http\Controllers\DataTransaksiController;
use App\Http\Controllers\DataUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KasirKontroller;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\LapanganController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ProfileAdminController;
use App\Http\Controllers\ProfileKasirController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserLoginController;
use App\Models\ProfileKasir;
use App\Models\Rating;
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

Route::get('/', [LandingPageController::class, 'index'])->name('halaman.index');

Route::get('/halaman/about',[LandingPageController::class,'about'])->name('halaman.about');
Route::get('/halaman/paket',[LandingPageController::class,'paket'])->name('halaman.paket');

Auth::routes();

Route::middleware(['auth', 'role:1'])->group(function () {
    Route::get('/admin/index', [HomeController::class, 'index'])->name('admin.index');
    Route::get('/admin/PDF',[PdfController::class,'pdf'])->name('admin.pdf');
    Route::get('/admin/laporan', [LaporanController::class,'index'])->name('index.laporan');
    Route::get('/admin/laporan-pdf', [LaporanController::class,'pdf'])->name('admin.laporan-pdf');

    Route::resource('/admin/lapangan',LapanganController::class)->names([
        'index' => 'admin.lapangan.index',
        'store' => 'admin.lapangan.store',
        'edit' => 'admin.lapangan.edit',
        'update' => 'admin.lapangan.update',
        'destroy' => 'admin.lapangan.destroy'
    ]);

    Route::get('/admin/transaksi',[DataTransaksiController::class,'index'])->name('admin.transaksi');
    Route::resource('/admin/member',MemberController::class);
    Route::resource('/admin/casir',KasirKontroller::class);
    Route::resource('/admin/jadwal',JadwalController::class);
    Route::resource('/admin/profile',ProfileAdminController::class);

    Route::resource('/admin/paket',PaketController::class);
});

// Rute untuk kasir
Route::middleware(['auth', 'role:2'])->group(function () {
    Route::get('/kasir/index', [HomeController::class, 'index'])->name('kasir.index');

    Route::resource('/kasir/transaksi',BayarController::class);
    Route::resource('/kasir/profil',ProfileKasirController::class);
    Route::patch('/transaksi/{id}/batal', [BayarController::class, 'batal'])->name('transaksi.batal');


    Route::patch('/kasir/transaksi/{id}/update-status', [BayarController::class, 'updateStatus'])->name('bayars.updateStatus');

});

Route::middleware(['auth', 'role:0'])->group(function () {
    Route::get('/user/index', [HomeController::class, 'index'])->name('user.index');

    Route::patch('/user/transaksi/{id}/batal', [BayarController::class, 'batal'])->name('booking.batal');

    Route::get('/user/index',[UserLoginController::class,'index'])->name('user.index');
    Route::get('/user/about',[UserLoginController::class,'about'])->name('user.about');
    Route::get('/user/paket',[UserLoginController::class,'paket'])->name('user.paket');

    Route::get('/user/data',[DataUserController::class,'index'])->name('user.data.index');
    Route::put('/user/data/{id}',[DataUserController::class,'update'])->name('user.data.update');

    Route::get('/user/transaksi',[UserLoginController::class,'transaksi'])->name('user.transaksi');
    Route::post('/user/transaksi',[BayarController::class,'store'])->name('user.transaksi');
    Route::post('/user/transaksi/{id}', [BayarController::class, 'lunasi'])->name('bayar.lunasi');


    Route::post('user/index', [RatingController::class,'store'])->name('user.rating');
});

