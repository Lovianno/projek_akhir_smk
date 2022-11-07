<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\barangController;
use App\Http\Controllers\kategoriController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\userController;
use App\Http\Controllers\laporanController;
use App\Http\Controllers\kasirController;
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


// Route::get('/barang', function () {
//     return view('menu.dataBarang');
// });
Route::middleware('auth')->group(function(){
Route::resource('/data-barang', barangController::class )->middleware('auth');
Route::get('data-barang/{id_siswa}/hapus', [barangController::class, 'hapus'])->name('data-barang.hapus');
Route::resource('/data-kategori', kategoriController::class );
Route::resource('/data-user', userController::class );
Route::get('data-kategori/{id_kategori}/hapus', [kategoriController::class, 'hapus'])->name('data-kategori.hapus');
Route::get('data-barang/tambahstok/{id_barang}', [barangController::class, 'tambahStok'])->name('data-barang.tambahstok');
Route::post('data-barang/{id_barang}', [barangController::class, 'storeStok'])->name('data-barang.storestok');
Route::post('/logout', [loginController::class, 'logout']);

// Laporan
Route::get('/laporandatabarang', [laporanController::class, 'index'])->name('laporan.index');
Route::get('/laporandatabarang/cetak_pdf', [laporanController::class, 'cetak_pdf']);

// kasir
Route::get('/kasir', [kasirController::class, 'index'])->name('kasir.index');

});
// login




Route:: middleware('guest')->group(function(){

    Route::get('/', [loginController::class, 'index']);
    Route::get('/login', [loginController::class, 'index'])->name('login');
    Route::post('login', [loginController::class, 'authenticate']);
    
});