<?php

use Illuminate\Support\Facades\Route;
use App\Models\Umkm;
use App\Models\Statistic;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DesaController;

// 1. Halaman Depan
Route::get('/', function () {
    $semua_umkm = Umkm::all();
    $data_pendidikan = Statistic::where('kategori', 'Pendidikan')->get();
    return view('welcome', compact('semua_umkm', 'data_pendidikan'));
});

// 2. Halaman Admin (UMKM)
Route::get('/admin', [AdminController::class, 'create'])->name('admin.create');
Route::post('/admin/simpan', [AdminController::class, 'store'])->name('admin.store');
Route::delete('/admin/hapus/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');

// 3. RUTE DROPDOWN
Route::get('/informasi-publik', [DesaController::class, 'informasi'])->name('informasi.publik');
Route::get('/transparansi-anggaran', [DesaController::class, 'transparansi'])->name('transparansi.anggaran');
Route::get('/arsip-artikel', [DesaController::class, 'arsip'])->name('arsip.artikel');
Route::get('/layanan-desa', [DesaController::class, 'layanan'])->name('layanan.desa');

Route::get('/statistik-penduduk', [DesaController::class, 'statPenduduk'])->name('stat.penduduk');
Route::get('/statistik-keluarga', [DesaController::class, 'statKeluarga'])->name('stat.keluarga');
Route::get('/statistik-bantuan', [DesaController::class, 'statBantuan'])->name('stat.bantuan');

// UMKM Peta (Halaman Publik)
Route::get('/umkm-desa', [AdminController::class, 'index'])->name('umkm.desa');
