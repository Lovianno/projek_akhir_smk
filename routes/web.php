<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\barangController;
use App\Http\Controllers\kategoriController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\userController;
use App\Http\Controllers\laporanController;
use App\Http\Controllers\kasirController;
use App\Http\Controllers\dashboardController;
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

// Dashboard


// 
Route::middleware('auth')->group(function(){
Route::resource('/dashboard', dashboardController::class );

Route::resource('/data-barang', barangController::class )->middleware('auth');
Route::get('data-barang/{id_siswa}/hapus', [barangController::class, 'hapus'])->name('data-barang.hapus');
Route::resource('/data-kategori', kategoriController::class );
Route::get('data-kategori/{id_kategori}/hapus', [kategoriController::class, 'hapus'])->name('data-kategori.hapus');
Route::get('data-barang/tambahstok/{id_barang}', [barangController::class, 'tambahStok'])->name('data-barang.tambahstok');
Route::post('data-barang/{id_barang}', [barangController::class, 'storeStok'])->name('data-barang.storestok');
Route::post('/logout', [loginController::class, 'logout']);

// livesearch
// Route::post( 'search',[barangController::class, 'search'])->name('data-barang.search');
Route::get( 'barang/cari',[barangController::class, 'cariBarang'])->name('data-barang.cari');
Route::get( 'kategori/cari',[kategoriController::class, 'cariKategori'])->name('data-kategori.cari');
Route::get( 'laporandatabarang/sort',[laporanController::class, 'sortingKategori2'])->name('laporandatabarang.sort');
Route::get( 'laporanbaranghabis/sort',[laporanController::class, 'sortingKategori'])->name('laporanbaranghabis.sort');
Route::get( 'laporantransaksi/sort',[laporanController::class, 'sortingTanggal'])->name('laporantransaksi.sort');

// data user
Route::resource('/data-user', userController::class );
Route::get('/identitas', [userController::class, 'identitas'])->name('identitas');

// Laporan
Route::get('/laporandatabarang/cetak_pdf', [laporanController::class, 'cetak_pdf']);
Route::get('/laporantransaksi/cetak_pdf', [laporanController::class, 'cetaktrans_pdf']);
Route::get('/laporantransaksi/cetakdetail_pdf', [laporanController::class, 'cetakdetailtrans_pdf'])->name('cetakdetail.transaksi');
// barang
Route::get('/laporandatabarang', [laporanController::class, 'index'])->name('laporan.index');
Route::get('/laporanbaranghabis', [laporanController::class, 'indexBarangHabis'])->name('laporan.indexBarang');

// transaksi
Route::get('/laporantransaksi', [laporanController::class, 'indexTransaksi'])->name('laporantransaksi.index');
Route::get('/laporantransaksi/{id}', [laporanController::class, 'showTransaksi'])->name('laporantransaksi.show');

// kasir
Route::get('/kasir', [kasirController::class, 'index'])->name('kasir.index');
Route::post( '/keranjang',[kasirController::class, 'addToCart'])->name('keranjang.index');
Route::get( '/keranjang/{id_item}}',[kasirController::class, 'deleteItemKeranjang'])->name('keranjang.destroy');
Route::get( '/kasir/cari',[kasirController::class, 'cariBarang'])->name('cariBarang.index');

// update keranjang
Route::put('/updatekeranjang',[kasirController::class, 'updateKeranjang'])->name('updateKeranjang');
Route::post('/checkoutKeranjang', [kasirController::class, 'checkoutKeranjang'])->name('checkoutKeranjang');
Route::get('/resetkeranjang', [kasirController::class, 'resetKeranjang'])->name('resetKeranjang');



});
// login




Route:: middleware('guest')->group(function(){

    Route::get('/', [loginController::class, 'index']);
    Route::get('/login', [loginController::class, 'index'])->name('login');
    Route::post('login', [loginController::class, 'authenticate']);
    
});