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

Route::get('/', [\App\Http\Controllers\RuanganController::class, 'ruangan'])->name('ruangan');

/*
|--------------------------------------------------------------------------
| Parrent Data
|--------------------------------------------------------------------------
*/
Route::get('/konfig-ruangan', [\App\Http\Controllers\RuanganController::class, 'konfig_ruangan'])->name('konfig.ruangan');

Route::get('/tambah-ruangan', [\App\Http\Controllers\RuanganController::class, 'tambah_ruangan'])->name('tambah.ruangan');
Route::post('/unggah-ruangan', [\App\Http\Controllers\DBrequest::class, 'unggah_ruangan'])->name('unggah.ruangan');

Route::get('/edit-ruangan/{id}', [\App\Http\Controllers\RuanganController::class, 'edit_ruangan'])->name('edit.ruangan');

Route::post('/perbarui-ruangan/{id}', [\App\Http\Controllers\DBrequest::class, 'perbarui_ruangan'])->name('perbarui.ruangan');

Route::get('/hapus-ruangan/{id}', [\App\Http\Controllers\DBrequest::class, 'hapus_ruangan'])->name('hapus.ruangan');

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
Route::get('/ruangan', [\App\Http\Controllers\RuanganController::class, 'ruangan'])->name('ruangan');
Route::name('detail')->get('/ruangan/{id}', [\App\Http\Controllers\RuanganController::class, 'detail']);
Route::get('/ruangan/ambil/{id}', [\App\Http\Controllers\RuanganController::class, 'ambil'])->name('ruangan.ambil');
Route::post('/ruangan/ambil-aset/{id}', [\App\Http\Controllers\DBrequest::class, 'ambil_aset'])->name('ambil_aset');
Route::post('/aset/ruangan/detail/akomodasi/{id}/barang/{id_brg}', [\App\Http\Controllers\DBrequest::class, 'akomodasi_aset'])->name('akomodasi.aset');
Route::get('/aset/ruangan/detail/akomodasi-aset/{id}/barang/{id_brg}', [\App\Http\Controllers\RuanganController::class, 'akomodasi'])->name('akomodasi');
Route::get('/aset/ruangan/detail/kembalikan-aset/{id}/barang/{id_brg}', [\App\Http\Controllers\RuanganController::class, 'kembalikan'])->name('kembalikan');
Route::post('/aset/ruangan/detail/kembalikan/{id}/barang/{id_brg}', [\App\Http\Controllers\DBrequest::class, 'kembalikan_aset'])->name('kembalikan.aset');

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
