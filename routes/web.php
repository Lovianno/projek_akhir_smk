<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\barangController;
use App\Http\Controllers\kategoriController;

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
    return view('componen.admin');
});
// Route::get('/barang', function () {
//     return view('menu.dataBarang');
// });
Route::resource('/data-barang', barangController::class );
Route::resource('/data-kategori', kategoriController::class );

