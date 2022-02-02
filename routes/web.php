<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PelangganController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\TahunController;
use App\Http\Controllers\Admin\TransaksiController;
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
    return redirect()->route('login');
});

Route::prefix('admin')
->middleware('auth')
->controller(DashboardController::class)
->group(function(){
    Route::get('/', 'dashboard_admin')->name('dashboard_admin');
});

Route::prefix('admin')
->middleware('auth')
->controller(ProdukController::class)
->group(function(){
    Route::get('/data-produk', 'data')->name('halaman.data.produk.admin');
    Route::get('/halaman-tambah-data-produk', 'halaman_tambah')->name('halaman.tambah.data.produk.admin');
    Route::post('/proses-tambah-data-produk', 'proses_tambah')->name('proses.tambah.data.produk.admin');
    Route::get('/halaman-ubah/data-produk/{id}', 'ubah')->name('halaman.ubah.data.produk.admin');
    Route::put('/proses-ubah/data-produk/{id}', 'proses_ubah')->name('proses.ubah.data.produk.admin');
    Route::get('/proses-hapus-data-produk/{id}', 'proses_hapus')->name('proses.hapus.data.produk.admin');
});

Route::prefix('admin')
->middleware('auth')
->controller(TransaksiController::class)
->group(function(){
    Route::get('/halaman-transaksi/{slug}', 'halaman_tambah_transaksi')->name('halaman.transaksi');
    Route::post('/proses-transaksi', 'proses_transaksi')->name('proses_transaksi');
    Route::get('/data-keseluruhan-transaksi', 'keseluruhan_transaksi')->name('keseluruhan_transaksi');
    Route::get('/opsi-laporan-transaksi-pertahun', 'opsi_laporan_pertahun')->name('opsi_laporan_pertahun');
    Route::post('/data-laporan-transaksi-pertahun', 'proses_laporan_pertahun')->name('proses_laporan_pertahun');
    Route::get('/opsi-laporan-transaksi-perhari', 'opsi_laporan_perhari')->name('opsi_laporan_perhari');
    Route::post('/data-laporan-transaksi-perhari', 'proses_laporan_perhari')->name('proses_laporan_perhari');
    Route::get('/opsi-laporan-transaksi-perbulan', 'opsi_laporan_perbulan')->name('opsi_laporan_perbulan');
    Route::post('/data-laporan-transaksi-perbulan', 'proses_laporan_perbulan')->name('proses_laporan_perbulan');
    Route::get('/proses-hapus/transaksi/{id}', 'proses_hapus')->name('hapus.transaksi');
    Route::get('/input-pembayaran-transaksi', 'input_pembayaran')->name('input_pembayaran');
    Route::post('/proses-pembayaran-transaksi', 'proses_pembayaran')->name('proses_pembayaran');
    Route::get('/selsai', 'selsai_transaksi')->name('selsai_transaksi');
    Route::get('/cancel', 'cancel')->name('cancel');
    Route::post('/produk-yang-akan-dibeli', 'cari')->name('cari-data-produk');

});

Route::prefix('admin')
->middleware('auth')
->controller(PelangganController::class)
->group(function(){
    Route::get('/data-pelanggan', 'data')->name('data.pelanggan.admin');
    Route::get('/halaman-tambah-data-pelanggan', 'tambah')->name('tambah.data.pelanggan.admin');
    Route::post('/proses-tambah-data-pelanggan', 'proses_tambah')->name('proses.tambah.pelanggan.admin');
    Route::get('/halaman-ubah-data-pelanggan/{id}', 'ubah')->name('ubah.pelanggan.admin');
    Route::put('/proses-ubah-data-pelanggan/{id}', 'proses_ubah')->name('prosesubah.pelanggan.admin');
    Route::get('/proses-hapus-data-pelanggan/{id}', 'proses_hapus')->name('proseshapus.pelanggan.admin');

});



Auth::routes([
    'register' => false
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
