<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Statistic;
use App\Models\Umkm;
use App\Models\PageContent;
use App\Models\DesaSetting;
use App\Models\Pamong;
use App\Models\Galeri;
use App\Models\Artikel;
use App\Models\Apbdes;
use App\Models\Agenda;
use App\Models\AsetDesa;
use App\Models\BatasDusun;

class DesaController extends Controller
{
    // --- KELOMPOK TENTANG DESA ---

    public function informasi() 
    {
        $items = PageContent::where('section', 'informasi')
            ->where('is_active', true)
            ->orderBy('order')
            ->get();

        return view('pages.informasi', compact('items'));
    }

    public function transparansi()
    {
        $tahunList = Apbdes::select('tahun')->distinct()
            ->where('tahun', '<', date('Y'))
            ->orderByDesc('tahun')->pluck('tahun');
        $tahun = request('tahun', $tahunList->first());
        $items = $tahun
            ? Apbdes::where('tahun', $tahun)->orderBy('jenis')->orderBy('urutan')->get()
            : collect();

        $totalPendapatan = $items->where('jenis', 'pendapatan')->sum('anggaran');
        $totalAnggaran   = $items->where('jenis', 'belanja')->sum('anggaran');
        $totalRealisasi  = $items->where('jenis', 'belanja')->sum('realisasi');
        $silpa           = $totalPendapatan - $totalRealisasi;
        $pctRealisasi    = $totalAnggaran > 0 ? round(($totalRealisasi / $totalAnggaran) * 100, 1) : 0;

        $pendapatan = $items->where('jenis', 'pendapatan');
        $belanja    = $items->where('jenis', 'belanja');

        // Group belanja by bidang for simplified display
        $belanjaByBidang = $belanja->groupBy('bidang')->map(fn($rows) => [
            'anggaran'  => $rows->sum('anggaran'),
            'realisasi' => $rows->sum('realisasi'),
        ]);

        $chartLabels = $belanjaByBidang->keys()->toJson();
        $chartData   = $belanjaByBidang->map(fn($r) => $r['anggaran'])->values()->toJson();

        return view('pages.transparansi', compact(
            'tahun', 'tahunList', 'pendapatan', 'belanja', 'belanjaByBidang',
            'totalPendapatan', 'totalAnggaran', 'totalRealisasi', 'silpa', 'pctRealisasi',
            'chartLabels', 'chartData'
        ));
    }

    public function arsip() 
    {
        $items = PageContent::where('section', 'arsip')
            ->where('is_active', true)
            ->orderBy('order')
            ->get();

        return view('pages.arsip', compact('items'));
    }

    public function layanan()
    {
        $items = PageContent::where('section', 'layanan')
            ->where('is_active', true)
            ->orderBy('order')
            ->get()
            ->groupBy('category');

        return view('pages.layanan', compact('items'));
    }

    // --- KELOMPOK STATISTIK ---

    public function statPenduduk()
    {
        $umur       = Statistic::where('kategori', 'Rentang Umur')->orderBy('id')->get();
        $pendidikan = Statistic::where('kategori', 'Pendidikan')->orderBy('id')->get();
        $pekerjaan  = Statistic::where('kategori', 'Pekerjaan')->orderBy('id')->get();
        $agama      = Statistic::where('kategori', 'Agama')->orderBy('id')->get();
        $status     = Statistic::where('kategori', 'Status Perkawinan')->orderBy('id')->get();
        $totalJiwa  = $umur->sum('jumlah');
        return view('pages.statistik-penduduk', compact('umur', 'pendidikan', 'pekerjaan', 'agama', 'status', 'totalJiwa'));
    }

    public function statKeluarga()
    {
        $kk            = Statistic::where('kategori', 'Kepala Keluarga')->orderBy('id')->get();
        $kesejahteraan = Statistic::where('kategori', 'Kesejahteraan')->orderBy('id')->get();
        $jaminan       = Statistic::where('kategori', 'Jaminan Kesehatan')->orderBy('id')->get();
        $totalKK       = $kk->sum('jumlah');
        return view('pages.statistik-keluarga', compact('kk', 'kesejahteraan', 'jaminan', 'totalKK'));
    }

    public function statFasilitasUmum()
    {
        $ibadah     = Statistic::where('kategori', 'Tempat Ibadah')->orderBy('id')->get();
        $pendidikan = Statistic::where('kategori', 'Fasilitas Pendidikan')->orderBy('id')->get();
        $kesehatan  = Statistic::where('kategori', 'Fasilitas Kesehatan')->orderBy('id')->get();
        $olahraga   = Statistic::where('kategori', 'Sarana Olahraga')->orderBy('id')->get();

        return view('pages.statistik-fasilitas-umum', compact('ibadah', 'pendidikan', 'kesehatan', 'olahraga'));
    }

    public function umkm()
    {
        $semua_umkm = Umkm::all();
        return view('pages.umkm', compact('semua_umkm'));
    }

    // ─── FASE 2 ────────────────────────────────────────────────────────────

    public function profilDesa()
    {
        $settings    = DesaSetting::pluck('value', 'key')->toArray();
        $jumlahDusun = BatasDusun::where('tipe', 'dusun')->where('is_active', true)->count();
        return view('pages.profil-desa', compact('settings', 'jumlahDusun'));
    }

    public function strukturOrganisasi()
    {
        $pamongs = Pamong::where('is_active', true)->orderBy('urutan')->get();
        return view('pages.struktur-organisasi', compact('pamongs'));
    }

    public function galeri()
    {
        $query = Galeri::where('is_active', true);
        if (request('kat')) $query->where('kategori', request('kat'));
        $galeris = $query->orderByDesc('created_at')->paginate(12)->withQueryString();
        $kategori = Galeri::where('is_active', true)->distinct()->pluck('kategori');
        return view('pages.galeri', compact('galeris', 'kategori'));
    }

    public function berita()
    {
        $query = Artikel::where('is_active', true);
        if (request('kat')) $query->where('kategori', request('kat'));
        $artikels = $query->orderByDesc('published_at')->paginate(9)->withQueryString();
        $kategori = Artikel::where('is_active', true)->distinct()->pluck('kategori');
        return view('pages.berita', compact('artikels', 'kategori'));
    }

    public function agenda()
    {
        $mendatang = Agenda::aktif()->mendatang()->paginate(6, ['*'], 'mendatang');
        $lalu      = Agenda::aktif()->where('tanggal', '<', now())->orderByDesc('tanggal')->paginate(6, ['*'], 'lalu');

        // Semua agenda untuk kalender (tanpa pagination)
        $kalender = Agenda::aktif()->get()->map(function ($a) {
            $colors = [
                'Rapat'        => ['#1E5A52', '#E8F5F0'],
                'Penyuluhan'   => ['#0d6efd', '#e8f0fe'],
                'Keagamaan'    => ['#fd7e14', '#fff3e0'],
                'Olahraga'     => ['#198754', '#e8f5e9'],
                'Sosial'       => ['#6f42c1', '#f3e8ff'],
                'Pembangunan'  => ['#dc3545', '#fce4e4'],
            ];
            [$bg, $border] = $colors[$a->kategori] ?? ['#3A9A8C', '#E8F5F0'];
            return [
                'id'              => $a->id,
                'title'           => $a->judul,
                'start'           => $a->tanggal->format('Y-m-d')
                                    . ($a->waktu_mulai ? 'T' . $a->waktu_mulai : ''),
                'end'             => $a->waktu_selesai
                                    ? $a->tanggal->format('Y-m-d') . 'T' . $a->waktu_selesai
                                    : null,
                'backgroundColor' => $bg,
                'borderColor'     => $bg,
                'extendedProps'   => [
                    'kategori'  => $a->kategori,
                    'lokasi'    => $a->lokasi,
                    'deskripsi' => $a->deskripsi,
                    'waktu'     => $a->waktu_mulai
                                    ? substr($a->waktu_mulai, 0, 5)
                                      . ($a->waktu_selesai ? ' – '.substr($a->waktu_selesai,0,5) : '')
                                    : null,
                ],
            ];
        });

        return view('pages.agenda', compact('mendatang', 'lalu', 'kalender'));
    }

    public function petaDesa()
    {
        $umkms = Umkm::whereNotNull('latitude')->whereNotNull('longitude')->get();
        $asets = AsetDesa::where('is_active', true)
            ->whereNotNull('latitude')->whereNotNull('longitude')
            ->get();

        $totalUmkm    = Umkm::count();
        $totalAset    = AsetDesa::where('is_active', true)->count();
        $umkmKategori = Umkm::distinct()->pluck('kategori');
        $batasDesa    = BatasDusun::where('tipe', 'desa')->first();
        $batasDusun   = BatasDusun::where('tipe', 'dusun')->where('is_active', true)->orderBy('nama_dusun')->get();

        return view('pages.peta-desa', compact('umkms', 'asets', 'totalUmkm', 'totalAset', 'umkmKategori', 'batasDesa', 'batasDusun'));
    }

    public function asetDesa(Request $request)
    {
        $query = AsetDesa::where('is_active', true)->orderBy('nama');
        if ($request->filled('jenis')) {
            $query->where('jenis', $request->jenis);
        }

        $asetPerJenis = $query->get()->groupBy('jenis');
        $rekapJenis   = AsetDesa::where('is_active', true)
            ->selectRaw('jenis, count(*) as jumlah')
            ->groupBy('jenis')
            ->pluck('jumlah', 'jenis');

        return view('pages.aset-desa', compact('asetPerJenis', 'rekapJenis'));
    }

    public function beritaDetail(Artikel $artikel)
    {
        if (!$artikel->is_active) abort(404);
        $terkait = Artikel::where('is_active', true)
            ->where('id', '!=', $artikel->id)
            ->where('kategori', $artikel->kategori)
            ->orderByDesc('published_at')
            ->take(3)
            ->get();
        return view('pages.berita-detail', compact('artikel', 'terkait'));
    }
}