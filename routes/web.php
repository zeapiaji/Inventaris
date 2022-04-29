<?php

use App\Http\Controllers\DBrequest;
use App\Http\Controllers\GudangController;
use App\Http\Livewire\Post\Index;
use App\Models\Akomodasi;
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
Route::get('/tambah-kelas', [\App\Http\Controllers\KelasController::class, 'tambah_kelas'])->name('tambah.kelas');
Route::post('/tambah-kelas/unggah', [\App\Http\Controllers\DBrequest::class, 'tambah_kelas_unggah'])->name('tambah.kelas.unggah');

/*
|--------------------------------------------------------------------------
| gudang
|--------------------------------------------------------------------------
*/
Route::post('/unggah',[\App\Http\Controllers\DBrequest::class, 'unggah'])->name('unggah_aset');
Route::get('/gudang', [\App\Http\Controllers\GudangController::class, 'gudang'])->name('gudang');
Route::get('/data', [\App\Http\Controllers\GudangController::class, 'data'])->name('data');
Route::post('/perbarui/{id}', [\App\Http\Controllers\DBrequest::class, 'perbarui'])->name('perbarui.aset');
Route::get('/gudang/registrasi', [\App\Http\Controllers\GudangController::class, 'registrasi_aset'])->name('registrasi.aset');
Route::get('/gudang/hapus-aset/{id}', [\App\Http\Controllers\DBrequest::class, 'hapus_aset_gudang'])->name('hapus.aset');
Route::get('/gudang/sunting-aset/{id}', [\App\Http\Controllers\GudangController::class, 'sunting_aset_gudang'])->name('sunting.aset.gudang');

/*
|--------------------------------------------------------------------------
| Kelas
|--------------------------------------------------------------------------
*/
Route::get('/kelas', [\App\Http\Controllers\KelasController::class, 'kelas'])->name('kelas');
Route::get('/kelas/{id}', [\App\Http\Controllers\KelasController::class, 'detail'])->name('detail');
Route::get('/kelas/ambil/{id}', [\App\Http\Controllers\KelasController::class, 'ambil'])->name('ambil');
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
Route::get('/gudang/sampah/pulihkan/{id}',[\App\Http\Controllers\DBrequest::class, 'pulihkan'])->name('pulihkan');
Route::get('/gudang/sampah/hapus-permanen/{id}', [\App\Http\Controllers\DBrequest::class, 'hapus'])->name('hapus');
Route::get('/gudang/sampah/pulihkan-semua', [\App\Http\Controllers\DBrequest::class, 'pulihkan_semua'])->name('pulihkan.semua');
Route::get('/gudang/sampah/hapus-permanen-semua', [\App\Http\Controllers\DBrequest::class, 'hapus_semua'])->name('hapus.semua');

Auth::routes();
