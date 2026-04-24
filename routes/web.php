<?php

use Illuminate\Support\Facades\Route;
use App\Models\Umkm;
use App\Models\Statistic;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PamongController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\ApbdesController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\AsetDesaController;
use App\Http\Controllers\PortalController;
use App\Http\Controllers\LogController;

// Portal Satu Pintu
Route::get('/portal', [PortalController::class, 'index'])->name('portal');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Admin Routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/umkm', [AdminController::class, 'manage'])->name('admin.umkm');
    Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/admin/simpan', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/admin/umkm/edit/{id}', [AdminController::class, 'edit'])->name('admin.umkm.edit');
    Route::put('/admin/umkm/update/{id}', [AdminController::class, 'update'])->name('admin.umkm.update');
    Route::delete('/admin/hapus/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
    Route::post('/admin/umkm/import', [AdminController::class, 'importCsv'])->name('admin.umkm.import');
    Route::get('/admin/umkm/template', [AdminController::class, 'downloadTemplateCsv'])->name('admin.umkm.template');

    Route::get('/admin/content/{section}', [AdminController::class, 'manageContent'])->name('admin.content.manage');
    Route::get('/admin/content/{section}/tambah', [AdminController::class, 'createContent'])->name('admin.content.create');
    Route::post('/admin/content/{section}/simpan', [AdminController::class, 'storeContent'])->name('admin.content.store');
    Route::get('/admin/content/{section}/edit/{id}', [AdminController::class, 'editContent'])->name('admin.content.edit');
    Route::put('/admin/content/{section}/update/{id}', [AdminController::class, 'updateContent'])->name('admin.content.update');
    Route::delete('/admin/content/{section}/hapus/{id}', [AdminController::class, 'destroyContent'])->name('admin.content.destroy');

    Route::get('/admin/statistik', [AdminController::class, 'manageStatistics'])->name('admin.statistik');
    Route::get('/admin/statistik/tambah', [AdminController::class, 'createStatistic'])->name('admin.statistik.create');
    Route::post('/admin/statistik/simpan', [AdminController::class, 'storeStatistic'])->name('admin.statistik.store');
    Route::get('/admin/statistik/edit/{id}', [AdminController::class, 'editStatistic'])->name('admin.statistik.edit');
    Route::put('/admin/statistik/update/{id}', [AdminController::class, 'updateStatistic'])->name('admin.statistik.update');
    Route::delete('/admin/statistik/hapus/{id}', [AdminController::class, 'destroyStatistic'])->name('admin.statistik.destroy');
    Route::post('/admin/statistik/import', [AdminController::class, 'importStatistics'])->name('admin.statistik.import');
    Route::put('/admin/statistik/update-multiple', [AdminController::class, 'updateMultipleStatistics'])->name('admin.statistik.updateMultiple');
    Route::get('/admin/statistik/export/{kategori}', [AdminController::class, 'exportStatistics'])->name('admin.statistik.export');

    // Tampilan Beranda
    Route::get('/admin/tampilan-beranda', [AdminController::class, 'tampilanBeranda'])->name('admin.tampilan_beranda');
    Route::post('/admin/tampilan-beranda/update', [AdminController::class, 'updateTampilanBeranda'])->name('admin.tampilan_beranda.update');

    // Profil Desa Settings
    Route::get('/admin/profil-desa', [AdminController::class, 'profilDesa'])->name('admin.profil_desa');
    Route::put('/admin/profil-desa/update', [AdminController::class, 'updateProfilDesa'])->name('admin.profil_desa.update');

    // Profil Kades
    Route::get('/admin/profil-kades', [AdminController::class, 'profilKades'])->name('admin.profil_kades');
    Route::post('/admin/profil-kades/update', [AdminController::class, 'updateProfilKades'])->name('admin.profil_kades.update');

    // Pamong
    Route::resource('/admin/pamong', PamongController::class, ['as' => 'admin'])->except(['show']);

    // Galeri
    Route::resource('/admin/galeri', GaleriController::class, ['as' => 'admin'])->except(['show']);

    // Artikel
    Route::resource('/admin/artikel', ArtikelController::class, ['as' => 'admin'])->except(['show']);

    // APBDes
    Route::resource('/admin/apbdes', ApbdesController::class, ['as' => 'admin'])->except(['show']);

    // Agenda
    Route::resource('/admin/agenda', AgendaController::class, ['as' => 'admin'])->except(['show']);

    // Aset Desa
    Route::resource('/admin/aset', AsetDesaController::class, ['as' => 'admin'])->except(['show']);

    // Kelola Peta
    Route::get('/admin/peta', [AdminController::class, 'kelolapeta'])->name('admin.peta');
    Route::patch('/admin/peta/umkm/{id}', [AdminController::class, 'updateKoordinatUmkm'])->name('admin.peta.umkm');
    Route::patch('/admin/peta/aset/{id}', [AdminController::class, 'updateKoordinatAset'])->name('admin.peta.aset');

    // Batas Dusun
    Route::get('/admin/batas-dusun', [AdminController::class, 'batasDusunIndex'])->name('admin.batas_dusun.index');
    Route::post('/admin/batas-dusun', [AdminController::class, 'batasDusunStore'])->name('admin.batas_dusun.store');
    Route::put('/admin/batas-dusun/{id}', [AdminController::class, 'batasDusunUpdate'])->name('admin.batas_dusun.update');
    Route::delete('/admin/batas-dusun/{id}', [AdminController::class, 'batasDusunDestroy'])->name('admin.batas_dusun.destroy');

    // Pengaduan
    Route::get('/admin/pengaduan', [PengaduanController::class, 'adminIndex'])->name('admin.pengaduan.index');
    Route::get('/admin/pengaduan/{pengaduan}', [PengaduanController::class, 'adminShow'])->name('admin.pengaduan.show');
    Route::patch('/admin/pengaduan/{pengaduan}', [PengaduanController::class, 'adminUpdate'])->name('admin.pengaduan.update');
    Route::delete('/admin/pengaduan/{pengaduan}', [PengaduanController::class, 'adminDestroy'])->name('admin.pengaduan.destroy');

    // Log & Riwayat
    Route::get('/admin/log', [LogController::class, 'index'])->name('admin.log.index');
    Route::delete('/admin/log/visitors', [LogController::class, 'clearVisitors'])->name('admin.log.clearVisitors');
    Route::delete('/admin/log/activities', [LogController::class, 'clearActivities'])->name('admin.log.clearActivities');

    // Kontak Darurat (dikelola dari halaman Informasi Publik)
    Route::post('/admin/kontak-darurat',                  [AdminController::class, 'storeKontak'])->name('admin.kontak_darurat.store');
    Route::put('/admin/kontak-darurat/{kontak}',          [AdminController::class, 'updateKontak'])->name('admin.kontak_darurat.update');
    Route::patch('/admin/kontak-darurat/{kontak}/toggle', [AdminController::class, 'toggleKontak'])->name('admin.kontak_darurat.toggle');
    Route::delete('/admin/kontak-darurat/{kontak}',       [AdminController::class, 'destroyKontak'])->name('admin.kontak_darurat.destroy');
});

// 1. Halaman Depan
Route::get('/', fn() => redirect()->route('portal'));

Route::get('/home', function () {
    $semua_umkm = Umkm::all();
    $data_pendidikan = Statistic::where('kategori', 'Pendidikan')->get();
    $kades = \App\Models\PageContent::where('section', 'kades')->where('is_active', true)->first();
    $berita_terkini = \App\Models\Artikel::where('is_active', true)->orderByDesc('published_at')->take(3)->get();
    $agenda_terkini = \App\Models\Agenda::aktif()->mendatang()->take(3)->get();
    $kontak = \App\Models\DesaSetting::pluck('value', 'key');
    $batasDesa     = \App\Models\BatasDusun::where('tipe', 'desa')->first();
    $batasDusun    = \App\Models\BatasDusun::where('tipe', 'dusun')->where('is_active', true)->orderBy('nama_dusun')->get();
    $asets         = \App\Models\AsetDesa::where('is_active', true)->whereNotNull('latitude')->whereNotNull('longitude')->get();
    $kontakDarurat = \App\Models\KontakDarurat::where('is_active', true)->orderBy('urutan')->orderBy('id')->get();
    return view('welcome', compact('semua_umkm', 'data_pendidikan', 'kades', 'berita_terkini', 'agenda_terkini', 'kontak', 'batasDesa', 'batasDusun', 'asets', 'kontakDarurat'));
})->name('home');

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

// Fase 2 - Halaman Publik Baru
Route::get('/profil-desa', [DesaController::class, 'profilDesa'])->name('profil.desa');
Route::get('/struktur-organisasi', [DesaController::class, 'strukturOrganisasi'])->name('struktur.organisasi');
Route::get('/galeri-foto', [DesaController::class, 'galeri'])->name('galeri.desa');
Route::get('/berita', [DesaController::class, 'berita'])->name('berita.desa');
Route::get('/berita/{artikel:slug}', [DesaController::class, 'beritaDetail'])->name('berita.detail');

// Aset Desa Publik
Route::get('/aset-desa', [DesaController::class, 'asetDesa'])->name('aset.desa');

// Peta Tematik
Route::get('/peta-desa', [DesaController::class, 'petaDesa'])->name('peta.desa');

// API publik batas dusun (untuk peta)
Route::get('/api/batas-dusun', function () {
    return response()->json(\App\Models\BatasDusun::where('is_active', true)->get());
});

// Fase 3 - Transparansi & Partisipasi
Route::get('/agenda', [DesaController::class, 'agenda'])->name('agenda.desa');
Route::get('/pengaduan', [PengaduanController::class, 'form'])->name('pengaduan.form');
Route::post('/pengaduan/kirim', [PengaduanController::class, 'submit'])->name('pengaduan.submit');
