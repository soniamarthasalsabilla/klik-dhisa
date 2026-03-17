<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Statistic; // Import model Statistic untuk halaman statistik
use App\Models\Umkm;      // Import model Umkm untuk halaman UMKM

class DesaController extends Controller
{
    // --- KELOMPOK TENTANG DESA ---

    public function informasi() 
    {
        return view('pages.informasi');
    }

    public function transparansi() 
    {
        return view('pages.transparansi');
    }

    public function arsip() 
    {
        return view('pages.arsip');
    }

    public function layanan() 
    {
        return view('pages.layanan');
    }

    // --- KELOMPOK STATISTIK ---

    public function statPenduduk() 
    {
        // Contoh jika ingin mengambil data khusus kependudukan
        $data_penduduk = Statistic::where('kategori', 'Kependudukan')->get();
        return view('pages.statistik-penduduk', compact('data_penduduk'));
    }

    public function statKeluarga() 
    {
        $data_keluarga = Statistic::where('kategori', 'Keluarga')->get();
        return view('pages.statistik-keluarga', compact('data_keluarga'));
    }

    public function statBantuan() 
    {
        $data_bantuan = Statistic::where('kategori', 'Bantuan')->get();
        return view('pages.statistik-bantuan', compact('data_bantuan'));
    }

    public function umkm() 
    {
        $semua_umkm = Umkm::all(); 
        
        return view('pages.umkm', compact('semua_umkm'));
    }
}