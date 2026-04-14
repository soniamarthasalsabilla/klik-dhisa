<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use App\Models\Statistic;
use App\Models\PageContent;
use App\Models\DesaSetting;
use App\Models\AsetDesa;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    public function dashboard() {
        $total_umkm      = Umkm::count();
        $total_artikel   = \App\Models\Artikel::where('is_active', true)->count();
        $total_galeri    = \App\Models\Galeri::where('is_active', true)->count();
        $total_pamong    = \App\Models\Pamong::where('is_active', true)->count();
        $total_pengaduan = \App\Models\Pengaduan::count();
        $pengaduan_baru  = \App\Models\Pengaduan::where('status', 'baru')->count();
        $agenda_aktif    = \App\Models\Agenda::aktif()->mendatang()->count();

        $umkm_categories = Umkm::select('kategori', \DB::raw('count(*) as total'))
            ->groupBy('kategori')
            ->pluck('total', 'kategori')
            ->toArray();

        $pengaduan_terbaru = \App\Models\Pengaduan::latest()->take(5)->get();
        $agenda_terkini    = \App\Models\Agenda::aktif()->mendatang()->take(4)->get();

        return view('admin.dashboard', compact(
            'total_umkm', 'total_artikel', 'total_galeri', 'total_pamong',
            'total_pengaduan', 'pengaduan_baru', 'agenda_aktif',
            'umkm_categories', 'pengaduan_terbaru', 'agenda_terkini'
        ));
    }

    public function index() {
        $semua_umkm = \App\Models\Umkm::all(); 
        
        return view('pages.umkm', compact('semua_umkm'));
    }

    public function create() {
        $umkms = Umkm::all(); 
        return view('admin.tambah_umkm', compact('umkms'));
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'nama_usaha' => 'required|string|max:255',
            'pemilik'    => 'required|string|max:255',
            'kategori'   => 'required|in:Makanan,Kerajinan,Jasa,Pertanian', 
            'no_hp'      => 'nullable|string|max:20',
            'latitude'   => 'required',
            'longitude'  => 'required',
            'foto'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle foto upload
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('umkm', $filename, 'public');
            $validatedData['foto'] = 'umkm/' . $filename;
        }

        Umkm::create($validatedData);

        return redirect()->route('umkm.desa')->with('success', 'Data UMKM Berhasil Ditambahkan!');
    }

    public function manage() {
    $semua_umkm = Umkm::paginate(10);
    return view('admin.kelola_umkm', compact('semua_umkm'));
    }

    public function edit($id)
    {
        $umkm = Umkm::findOrFail($id);
        return view('admin.edit_umkm', compact('umkm'));
    }

    public function update(Request $request, $id)
    {
        $umkm = Umkm::findOrFail($id);

        $validatedData = $request->validate([
            'nama_usaha' => 'required|string|max:255',
            'pemilik'    => 'required|string|max:255',
            'kategori'   => 'required|in:Makanan,Kerajinan,Jasa,Pertanian',
            'no_hp'      => 'nullable|string|max:20',
            'latitude'   => 'required',
            'longitude'  => 'required',
            'foto'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($umkm->foto) {
                \Storage::disk('public')->delete($umkm->foto);
            }
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('umkm', $filename, 'public');
            $validatedData['foto'] = 'umkm/' . $filename;
        } else {
            unset($validatedData['foto']);
        }

        $umkm->update($validatedData);

        return redirect()->route('admin.umkm')->with('success', 'Data UMKM berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $umkm = Umkm::findOrFail($id);
        if ($umkm->foto) {
            \Storage::disk('public')->delete($umkm->foto);
        }
        $umkm->delete();

        return redirect()->back()->with('success', 'Data UMKM berhasil dihapus!');
    }

    public function manageContent($section)
    {
        $allowedSections = ['informasi', 'arsip', 'layanan', 'kades'];
        if (!in_array($section, $allowedSections)) {
            abort(404);
        }

        $items = PageContent::where('section', $section)
            ->orderBy('order')
            ->paginate(10);

        return view('admin.kelola_content', compact('items', 'section'));
    }

    public function createContent($section)
    {
        $allowedSections = ['informasi', 'arsip', 'layanan'];
        if (!in_array($section, $allowedSections)) {
            abort(404);
        }

        return view('admin.tambah_content', compact('section'));
    }

    public function storeContent(Request $request, $section)
    {
        $allowedSections = ['informasi', 'arsip', 'layanan'];
        if (!in_array($section, $allowedSections)) {
            abort(404);
        }

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'body' => 'nullable|string',
            'category' => 'nullable|string|max:100',
            'year' => 'nullable|string|max:20',
            'link' => 'nullable|url',
            'image' => 'nullable|url',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:10240',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        // Handle file upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('content_files', $filename, 'public');
            $validatedData['file'] = 'content_files/' . $filename;
        }

        $validatedData['section'] = $section;
        $validatedData['is_active'] = $request->has('is_active');

        PageContent::create($validatedData);

        return redirect()->route('admin.content.manage', $section)->with('success', 'Konten berhasil ditambahkan.');
    }

    public function editContent($section, $id)
    {
        $allowedSections = ['informasi', 'arsip', 'layanan'];
        if (!in_array($section, $allowedSections)) {
            abort(404);
        }

        $item = PageContent::findOrFail($id);
        return view('admin.edit_content', compact('item', 'section'));
    }

    public function updateContent(Request $request, $section, $id)
    {
        $allowedSections = ['informasi', 'arsip', 'layanan'];
        if (!in_array($section, $allowedSections)) {
            abort(404);
        }

        $item = PageContent::findOrFail($id);
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'body' => 'nullable|string',
            'category' => 'nullable|string|max:100',
            'year' => 'nullable|string|max:20',
            'link' => 'nullable|url',
            'image' => 'nullable|url',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:10240',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        // Handle file upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('content_files', $filename, 'public');
            $validatedData['file'] = 'content_files/' . $filename;
        }

        $validatedData['is_active'] = $request->has('is_active');
        $item->update($validatedData);

        return redirect()->route('admin.content.manage', $section)->with('success', 'Konten berhasil diperbarui.');
    }

    public function destroyContent($section, $id)
    {
        $allowedSections = ['informasi', 'arsip', 'layanan'];
        if (!in_array($section, $allowedSections)) {
            abort(404);
        }

        $item = PageContent::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.content.manage', $section)->with('success', 'Konten berhasil dihapus.');
    }

    public function manageStatistics()
    {
        $query = Statistic::query();

        if (request('kategori')) {
            $query->where('kategori', request('kategori'));
        }

        $statistics = $query->orderBy('kategori')->paginate(10);
        $allStatistics = Statistic::all(); // For summary
        return view('admin.kelola_statistik', compact('statistics', 'allStatistics'));
    }

    public function createStatistic()
    {
        return view('admin.tambah_statistik');
    }

    public function storeStatistic(Request $request)
    {
        $validatedData = $request->validate([
            'kategori' => 'required|string|max:100',
            'label' => 'required|string|max:255',
            'jumlah' => 'required|integer',
        ]);

        Statistic::create($validatedData);

        return redirect()->route('admin.statistik')->with('success', 'Data statistik berhasil ditambahkan.');
    }

    public function editStatistic($id)
    {
        $statistic = Statistic::findOrFail($id);
        return view('admin.edit_statistik', compact('statistic'));
    }

    public function updateStatistic(Request $request, $id)
    {
        $statistic = Statistic::findOrFail($id);
        $validatedData = $request->validate([
            'kategori' => 'required|string|max:100',
            'label' => 'required|string|max:255',
            'jumlah' => 'required|integer',
        ]);

        $statistic->update($validatedData);

        return redirect()->route('admin.statistik')->with('success', 'Data statistik berhasil diperbarui.');
    }

    public function destroyStatistic($id)
    {
        $statistic = Statistic::findOrFail($id);
        $statistic->delete();

        return redirect()->route('admin.statistik')->with('success', 'Data statistik berhasil dihapus.');
    }

    public function updateMultipleStatistics(Request $request)
    {
        $validatedData = $request->validate([
            'stats' => 'required|array',
            'stats.*.id' => 'required|integer|exists:statistics,id',
            'stats.*.kategori' => 'required|string|max:100',
            'stats.*.label' => 'required|string|max:255',
            'stats.*.jumlah' => 'required|integer|min:0',
            'kategori' => 'required|string|max:100',
        ]);

        foreach ($validatedData['stats'] as $statData) {
            $statistic = Statistic::findOrFail($statData['id']);
            $statistic->update([
                'kategori' => $statData['kategori'],
                'label' => $statData['label'],
                'jumlah' => $statData['jumlah'],
            ]);
        }

        return redirect()->route('admin.statistik')->with('success', "Data Statistik {$validatedData['kategori']} Berhasil Diperbarui");
    }

    public function importStatistics(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt|max:2048',
        ]);

        $file = $request->file('csv_file');
        $path = $file->getRealPath();
        $data = array_map('str_getcsv', file($path));

        // Skip header if exists
        if (isset($data[0]) && strtolower($data[0][0]) === 'kategori') {
            array_shift($data);
        }

        $imported = 0;
        foreach ($data as $row) {
            if (count($row) >= 3) {
                Statistic::create([
                    'kategori' => trim($row[0]),
                    'label' => trim($row[1]),
                    'jumlah' => (int) trim($row[2]),
                ]);
                $imported++;
            }
        }

        return redirect()->route('admin.statistik')->with('success', "Berhasil mengimport {$imported} data statistik.");
    }

    public function exportStatistics($kategori)
    {
        $statistics = Statistic::where('kategori', $kategori)->get();

        if ($statistics->isEmpty()) {
            return redirect()->route('admin.statistik')->with('error', 'Tidak ada data untuk kategori ini.');
        }

        $tanggal = now()->format('d-m-Y');
        $filename = "Laporan_Statistik_{$kategori}_{$tanggal}.xlsx";

        return Excel::download(new class($statistics, $kategori) implements \Maatwebsite\Excel\Concerns\FromCollection, \Maatwebsite\Excel\Concerns\WithHeadings, \Maatwebsite\Excel\Concerns\WithTitle {
            private $statistics;
            private $kategori;

            public function __construct($statistics, $kategori)
            {
                $this->statistics = $statistics;
                $this->kategori = $kategori;
            }

            public function collection()
            {
                $total = $this->statistics->sum('jumlah');
                $data = collect([
                    ['Laporan Statistik Kependudukan Desa'],
                    ['Kategori: ' . $this->kategori],
                    [''],
                    ['No', 'Nama Label', 'Jumlah Penduduk', 'Persentase (%)'],
                ]);

                foreach ($this->statistics as $index => $stat) {
                    $persentase = $total > 0 ? round(($stat->jumlah / $total) * 100, 2) : 0;
                    $data->push([
                        $index + 1,
                        $stat->label,
                        $stat->jumlah,
                        $persentase . '%'
                    ]);
                }

                return $data;
            }

            public function headings(): array
            {
                return [];
            }

            public function title(): string
            {
                return 'Laporan Statistik';
            }
        }, $filename);
    }

    // ─── PROFIL DESA SETTINGS ───────────────────────────────────────────────

    public function profilDesa()
    {
        $settings = DesaSetting::pluck('value', 'key')->toArray();
        return view('admin.profil_desa', compact('settings'));
    }

    public function updateProfilDesa(Request $request)
    {
        $keys = [
            'visi', 'misi', 'sejarah',
            'luas_wilayah', 'jumlah_penduduk', 'jumlah_kk',
            'jumlah_rt', 'jumlah_rw', 'tahun_berdiri',
            'batas_utara', 'batas_selatan', 'batas_timur', 'batas_barat',
        ];

        foreach ($keys as $key) {
            DesaSetting::set($key, $request->input($key, ''));
        }

        return redirect()->route('admin.profil_desa')->with('success', 'Profil desa berhasil diperbarui.');
    }

    public function kelolapeta()
    {
        $umkms = Umkm::orderBy('nama_usaha')->get();
        $asets = AsetDesa::where('is_active', true)->orderBy('nama')->get();
        return view('admin.kelola_peta', compact('umkms', 'asets'));
    }

    public function updateKoordinatUmkm(Request $request, $id)
    {
        $request->validate([
            'latitude'  => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ]);
        $umkm = Umkm::findOrFail($id);
        $umkm->update(['latitude' => $request->latitude, 'longitude' => $request->longitude]);
        return response()->json(['success' => true, 'message' => 'Koordinat UMKM diperbarui.']);
    }

    public function updateKoordinatAset(Request $request, $id)
    {
        $request->validate([
            'latitude'  => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ]);
        $aset = AsetDesa::findOrFail($id);
        $aset->update(['latitude' => $request->latitude, 'longitude' => $request->longitude]);
        return response()->json(['success' => true, 'message' => 'Koordinat aset diperbarui.']);
    }
}
