<?php

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

Route::get('/', [\App\Http\Controllers\GudangController::class, 'dasbor'])->name('dasbor');

/*
|--------------------------------------------------------------------------
| Parrent Data
|--------------------------------------------------------------------------
*/
Route::get('/data-konfig', [\App\Http\Controllers\KelasController::class, 'data_konfig'])->name('data.kelas');
Route::get('/konfig-kelas', [\App\Http\Controllers\KelasController::class, 'konfig_kelas'])->name('konfig.kelas');

Route::get('/tambah-kelas', [\App\Http\Controllers\KelasController::class, 'tambah_kelas'])->name('tambah.kelas');
Route::get('/unggah-kelas', [\App\Http\Controllers\DBrequest::class, 'unggah_kelas'])->name('unggah.kelas');

Route::post('/perbarui-kelas', [\App\Http\Controllers\DBrequest::class, 'perbarui_kelas'])->name('perbarui.kelas');

Route::post('/hapus-kelas', [\App\Http\Controllers\DBrequest::class, 'hapus_kelas'])->name('hapus.kelas');

/*
|--------------------------------------------------------------------------
| gudang
|--------------------------------------------------------------------------
*/
Route::post('/unggah',[\App\Http\Controllers\DBrequest::class, 'unggah'])->name('unggah');
Route::get('/data', [\App\Http\Controllers\GudangController::class, 'data'])->name('data');
Route::get('/gudang', [\App\Http\Controllers\GudangController::class, 'gudang'])->name('gudang');
Route::post('/perbarui', [\App\Http\Controllers\DBrequest::class, 'perbarui'])->name('perbarui.aset');
Route::post('/hapus', [\App\Http\Controllers\DBrequest::class, 'hapus_aset_gudang'])->name('hapus.aset');
Route::delete('multiple-delete', [\App\Http\Controllers\DBrequest::class, 'multiple_delete'])->name('multiple.delete');

/*
|--------------------------------------------------------------------------
| Kelas
|--------------------------------------------------------------------------
*/
Route::get('/kelas', [\App\Http\Controllers\KelasController::class, 'kelas'])->name('kelas');
Route::name('detail')->get('/kelas/{id}', [\App\Http\Controllers\KelasController::class, 'detail']);
Route::get('/kelas/ambil/{id}', [\App\Http\Controllers\KelasController::class, 'ambil'])->name('kelas.ambil');
Route::post('/kelas/ambil-aset/{id}', [\App\Http\Controllers\DBrequest::class, 'ambil_aset'])->name('ambil_aset');
Route::post('/aset/kelas/detail/akomodasi/{id}/barang/{id_brg}', [\App\Http\Controllers\DBrequest::class, 'akomodasi_aset'])->name('akomodasi.aset');
Route::get('/aset/kelas/detail/akomodasi-aset/{id}/barang/{id_brg}', [\App\Http\Controllers\KelasController::class, 'akomodasi'])->name('akomodasi');
Route::get('/aset/kelas/detail/kembalikan-aset/{id}/barang/{id_brg}', [\App\Http\Controllers\KelasController::class, 'kembalikan'])->name('kembalikan');
Route::post('/aset/kelas/detail/kembalikan/{id}/barang/{id_brg}', [\App\Http\Controllers\DBrequest::class, 'kembalikan_aset'])->name('kembalikan.aset');

/*
|--------------------------------------------------------------------------
| Soft Delete
|--------------------------------------------------------------------------
*/

Route::get('/gudang/sampah', [\App\Http\Controllers\GudangController::class, 'sampah'])->name('sampah');
Route::get('data-sampah', [\App\Http\Controllers\GudangController::class, 'data_sampah'])->name('data.sampah');

Route::post('/pulihkan', [\App\Http\Controllers\SoftDelete::class, 'pulihkan'])->name('pulihkan');
Route::post('/multi-recovery', [\App\Http\Controllers\SoftDelete::class, 'multi_recovery'])->name('multi.recovery');
Route::post('/pulihkan-semua', [\App\Http\Controllers\SoftDelete::class, 'pulihkan_semua'])->name('pulihkan.semua');

Route::post('/hapus', [\App\Http\Controllers\SoftDelete::class, 'hapus'])->name('hapus');
Route::post('/hapus-permanen', [\App\Http\Controllers\SoftDelete::class, 'hapus_permanen'])->name('hapus.permanen');
Route::post('/hapus-semua', [\App\Http\Controllers\SoftDelete::class, 'hapus_semua'])->name('hapus.semua');

Route::delete('sampah_hapus_multi', [\App\Http\Controllers\SoftDelete::class, 'sampah_hapus_multi'])->name('sampah.hapus.multi');

// Auth
Auth::routes();
