<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes([
    'register' => true, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/', [App\Http\Controllers\HomeController::class, 'transaksi'])->name('transaksi/index');
// Route::get("/", "index")->name("transaksi.index");


Route::group(['middleware' => 'auth', 'prefix' => 'dashboard'], function () {
    Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    require_once "pages/paket.php";
    require_once "pages/tipe_pembayaran.php";
    require_once "pages/status_pesanan.php";
    require_once "pages/konsumen.php";
    require_once "pages/karyawan.php";
    require_once "pages/transaksi.php";
    require_once "pages/laporan_transaksi.php";
});
