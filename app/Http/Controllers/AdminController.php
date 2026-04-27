<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use App\Models\Statistic;
use App\Models\PageContent;
use App\Models\DesaSetting;
use App\Models\AsetDesa;
use App\Models\BatasDusun;
use Illuminate\Http\Request;

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
        $batasDesa   = BatasDusun::where('tipe', 'desa')->first();
        $batasDusun  = BatasDusun::where('tipe', 'dusun')->where('is_active', true)->orderBy('nama_dusun')->get();
        return view('pages.umkm', compact('semua_umkm', 'batasDesa', 'batasDusun'));
    }

    public function create() {
        $umkms = Umkm::all(); 
        return view('admin.tambah_umkm', compact('umkms'));
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'nama_usaha' => 'required|string|max:255',
            'pemilik'    => 'required|string|max:255',
            'kategori'   => 'required|string|max:100',
            'no_hp'      => 'nullable|string|max:20',
            'alamat'     => 'nullable|string|max:255',
            'dusun'      => 'nullable|string|max:100',
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
            'alamat'     => 'nullable|string|max:255',
            'dusun'      => 'nullable|string|max:100',
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

    public function importCsv(Request $request)
    {
        $request->validate([
            'file_csv' => 'required|file|mimes:csv,txt|max:2048',
        ], [
            'file_csv.required' => 'File CSV wajib dipilih.',
            'file_csv.mimes'    => 'File harus berformat CSV.',
            'file_csv.max'      => 'Ukuran file maksimal 2MB.',
        ]);

        $path = $request->file('file_csv')->getRealPath();

        // Hapus BOM (dari file Excel CSV) lalu deteksi delimiter ; atau ,
        $raw = file_get_contents($path);
        $raw = preg_replace('/^\xEF\xBB\xBF/', '', $raw);
        file_put_contents($path, $raw);

        $firstLine = strtok($raw, "\n");
        $delimiter = substr_count($firstLine, ';') >= substr_count($firstLine, ',') ? ';' : ',';

        $handle = fopen($path, 'r');

        $header = fgetcsv($handle, 0, $delimiter);
        if (!$header) {
            fclose($handle);
            return redirect()->route('admin.umkm')->with('warning', 'File CSV kosong atau tidak valid.');
        }
        $header = array_map(fn($h) => strtolower(trim($h)), $header);

        $required = ['nama_usaha', 'pemilik', 'kategori'];
        $missing  = array_diff($required, $header);
        if ($missing) {
            fclose($handle);
            return redirect()->route('admin.umkm')->with('warning', 'Kolom wajib tidak ditemukan: ' . implode(', ', $missing));
        }

        $inserted  = 0;
        $errors    = [];
        $rowNumber = 1;

        while (($cols = fgetcsv($handle, 0, $delimiter)) !== false) {
            $rowNumber++;

            if (count($cols) !== count($header)) {
                $errors[] = "Baris $rowNumber: jumlah kolom tidak sesuai header";
                continue;
            }

            $row = array_combine($header, $cols);

            if (empty(trim($row['nama_usaha'])) || empty(trim($row['pemilik'])) || empty(trim($row['kategori']))) {
                $errors[] = "Baris $rowNumber: nama_usaha, pemilik, kategori wajib diisi";
                continue;
            }

            $lat = isset($row['latitude']) && trim($row['latitude']) !== ''
                ? $this->normalizeCoord((float) str_replace(',', '.', $row['latitude']), -90, 90)
                : null;
            $lng = isset($row['longitude']) && trim($row['longitude']) !== ''
                ? $this->normalizeCoord((float) str_replace(',', '.', $row['longitude']), -180, 180)
                : null;

            Umkm::create([
                'nama_usaha' => trim($row['nama_usaha']),
                'pemilik'    => trim($row['pemilik']),
                'kategori'   => trim($row['kategori']),
                'no_hp'      => isset($row['no_hp']) && trim($row['no_hp']) !== '' ? trim($row['no_hp']) : null,
                'latitude'   => $lat,
                'longitude'  => $lng,
                'foto'       => null,
            ]);
            $inserted++;
        }

        fclose($handle);

        $message = "Berhasil mengimport $inserted data UMKM.";
        if ($errors) {
            $message .= ' Gagal: ' . implode(' | ', $errors);
            return redirect()->route('admin.umkm')->with('warning', $message);
        }

        return redirect()->route('admin.umkm')->with('success', $message);
    }

    public function downloadTemplateCsv()
    {
        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="template_umkm.csv"',
        ];

        $callback = function () {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['nama_usaha', 'pemilik', 'kategori', 'no_hp', 'alamat', 'dusun', 'latitude', 'longitude']);
            fputcsv($file, ['Warung Makan Bu Sari', 'Sari', 'Makanan', '6281234567890', 'RT 03 RW 01', 'Dusun Barat', '-7.0123', '112.5678']);
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
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
        $allowedSections = ['informasi', 'arsip', 'layanan', 'kades'];
        if (!in_array($section, $allowedSections)) {
            abort(404);
        }

        return view('admin.tambah_content', compact('section'));
    }

    public function storeContent(Request $request, $section)
    {
        $allowedSections = ['informasi', 'arsip', 'layanan', 'kades'];
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
        $allowedSections = ['informasi', 'arsip', 'layanan', 'kades'];
        if (!in_array($section, $allowedSections)) {
            abort(404);
        }

        $item = PageContent::findOrFail($id);
        return view('admin.edit_content', compact('item', 'section'));
    }

    public function updateContent(Request $request, $section, $id)
    {
        $allowedSections = ['informasi', 'arsip', 'layanan', 'kades'];
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
        $allowedSections = ['informasi', 'arsip', 'layanan', 'kades'];
        if (!in_array($section, $allowedSections)) {
            abort(404);
        }

        $item = PageContent::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.content.manage', $section)->with('success', 'Konten berhasil dihapus.');
    }

    // ── Kontak Darurat (dikelola dari halaman Identitas & Profil) ──────────────

    public function storeKontak(Request $request)
    {
        $request->validate([
            'nama'       => 'required|string|max:100',
            'nomor'      => 'required|string|max:30',
            'icon'       => 'required|string|max:60',
            'warna_bg'   => 'required|string|max:20',
            'warna_teks' => 'required|string|max:20',
            'urutan'     => 'nullable|integer|min:0',
        ]);
        \App\Models\KontakDarurat::create($request->only('nama','nomor','icon','warna_bg','warna_teks') + ['urutan' => $request->urutan ?? 0]);
        return redirect()->route('admin.profil_desa')->with('success', 'Kontak darurat berhasil ditambahkan.');
    }

    public function updateKontak(Request $request, \App\Models\KontakDarurat $kontak)
    {
        $request->validate([
            'nama'       => 'required|string|max:100',
            'nomor'      => 'required|string|max:30',
            'icon'       => 'required|string|max:60',
            'warna_bg'   => 'required|string|max:20',
            'warna_teks' => 'required|string|max:20',
            'urutan'     => 'nullable|integer|min:0',
        ]);
        $kontak->update($request->only('nama','nomor','icon','warna_bg','warna_teks','urutan'));
        return redirect()->route('admin.profil_desa')->with('success', 'Kontak darurat berhasil diperbarui.');
    }

    public function toggleKontak(\App\Models\KontakDarurat $kontak)
    {
        $kontak->update(['is_active' => !$kontak->is_active]);
        return back()->with('success', 'Status kontak diperbarui.');
    }

    public function destroyKontak(\App\Models\KontakDarurat $kontak)
    {
        $kontak->delete();
        return back()->with('success', 'Kontak darurat berhasil dihapus.');
    }

    public function manageStatistics()
    {
        $query = Statistic::query();

        if (request('kategori')) {
            $query->where('kategori', request('kategori'));
        }

        $statistics    = $query->orderBy('kategori')->paginate(10);
        $allStatistics = Statistic::all();
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
        $request->validate([
            'stats'          => 'required|array',
            'stats.*.id'     => 'required|integer|exists:statistics,id',
            'stats.*.jumlah' => 'required|integer|min:0',
            'kategori'       => 'required|string|max:100',
        ]);

        foreach ($request->input('stats') as $statData) {
            Statistic::where('id', $statData['id'])->update(['jumlah' => $statData['jumlah']]);
        }

        $kategori = $request->input('kategori');
        return redirect()->route('admin.statistik')->with('success', "Data Statistik {$kategori} berhasil diperbarui.");
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

    // ─── PROFIL KADES ───────────────────────────────────────────────────────

    public function profilKades()
    {
        $kades = \App\Models\PageContent::where('section', 'kades')->first()
            ?? new \App\Models\PageContent(['section' => 'kades', 'is_active' => true]);
        return view('admin.profil_kades', compact('kades'));
    }

    public function updateProfilKades(Request $request)
    {
        $request->validate([
            'nama_kades'  => 'required|string|max:255',
            'jabatan'     => 'required|string|max:255',
            'quote'       => 'nullable|string',
            'foto_kades'  => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $kades = \App\Models\PageContent::firstOrNew(['section' => 'kades']);
        $kades->title     = $request->nama_kades;
        $kades->body      = $request->jabatan;
        $kades->excerpt   = $request->quote;
        $kades->is_active = true;

        if ($request->hasFile('foto_kades')) {
            if ($kades->image && \Storage::disk('public')->exists($kades->image)) {
                \Storage::disk('public')->delete($kades->image);
            }
            $file     = $request->file('foto_kades');
            $filename = 'kades_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('kades', $filename, 'public');
            $kades->image = 'kades/' . $filename;
        }

        $kades->save();

        return redirect()->route('admin.profil_kades')->with('success', 'Profil Kepala Desa berhasil diperbarui.');
    }

    // ─── TAMPILAN BERANDA ───────────────────────────────────────────────────

    public function tampilanBeranda()
    {
        $settings = DesaSetting::pluck('value', 'key')->toArray();
        return view('admin.tampilan_beranda', compact('settings'));
    }

    public function updateTampilanBeranda(Request $request)
    {
        $request->validate([
            'hero_badge'       => 'nullable|string|max:255',
            'hero_judul'       => 'nullable|string|max:255',
            'hero_deskripsi'   => 'nullable|string|max:500',
            'nama_navbar'      => 'nullable|string|max:50',
            'hero_bg_foto'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'logo_desa'        => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
        ]);

        $textKeys = ['hero_badge', 'hero_judul', 'hero_deskripsi', 'nama_navbar'];
        foreach ($textKeys as $key) {
            if ($request->has($key)) {
                DesaSetting::set($key, $request->input($key, ''));
            }
        }

        if ($request->hasFile('hero_bg_foto')) {
            $old = DesaSetting::get('hero_bg_foto');
            if ($old && \Storage::disk('public')->exists($old)) {
                \Storage::disk('public')->delete($old);
            }
            $file     = $request->file('hero_bg_foto');
            $filename = 'hero_bg_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('beranda', $filename, 'public');
            DesaSetting::set('hero_bg_foto', 'beranda/' . $filename);
        } elseif ($request->boolean('hapus_bg')) {
            $old = DesaSetting::get('hero_bg_foto');
            if ($old && \Storage::disk('public')->exists($old)) {
                \Storage::disk('public')->delete($old);
            }
            DesaSetting::set('hero_bg_foto', '');
        }

        if ($request->hasFile('logo_desa')) {
            $old = DesaSetting::get('logo_desa');
            if ($old && \Storage::disk('public')->exists($old)) {
                \Storage::disk('public')->delete($old);
            }
            $file     = $request->file('logo_desa');
            $filename = 'logo_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('beranda', $filename, 'public');
            DesaSetting::set('logo_desa', 'beranda/' . $filename);
        } elseif ($request->boolean('hapus_logo')) {
            $old = DesaSetting::get('logo_desa');
            if ($old && \Storage::disk('public')->exists($old)) {
                \Storage::disk('public')->delete($old);
            }
            DesaSetting::set('logo_desa', '');
        }

        return redirect()->route('admin.tampilan_beranda')->with('success', 'Tampilan beranda berhasil diperbarui.');
    }

    // ─── PROFIL DESA SETTINGS ───────────────────────────────────────────────

    public function profilDesa()
    {
        $settings = DesaSetting::pluck('value', 'key')->toArray();
        $kontaks  = \App\Models\KontakDarurat::orderBy('urutan')->orderBy('id')->get();
        return view('admin.profil_desa', compact('settings', 'kontaks'));
    }

    public function updateProfilDesa(Request $request)
    {
        $keys = [
            'visi', 'misi', 'sejarah',
            'luas_wilayah', 'jumlah_penduduk', 'jumlah_kk',
            'jumlah_dusun', 'jumlah_rt', 'jumlah_rw', 'tahun_berdiri',
            'batas_utara', 'batas_selatan', 'batas_timur', 'batas_barat',
            'jarak_kecamatan', 'jarak_kabupaten', 'jarak_provinsi',
        ];

        foreach ($keys as $key) {
            DesaSetting::set($key, $request->input($key, ''));
        }

        return redirect()->route('admin.profil_desa')->with('success', 'Profil desa berhasil diperbarui.');
    }

    public function kelolapeta()
    {
        $umkms      = Umkm::orderBy('nama_usaha')->get();
        $asets      = AsetDesa::where('is_active', true)->orderBy('nama')->get();
        $batasDesa  = BatasDusun::where('tipe', 'desa')->first();
        $batasDusun = BatasDusun::where('tipe', 'dusun')->where('is_active', true)->orderBy('nama_dusun')->get();
        return view('admin.kelola_peta', compact('umkms', 'asets', 'batasDesa', 'batasDusun'));
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

    // ─── BATAS DUSUN ────────────────────────────────────────────────────────

    public function batasDusunIndex()
    {
        $batasDesa  = BatasDusun::where('tipe', 'desa')->first();
        $batasList  = BatasDusun::where('tipe', 'dusun')->orderBy('nama_dusun')->get();
        return view('admin.batas_dusun', compact('batasDesa', 'batasList'));
    }

    public function batasDusunStore(Request $request)
    {
        $request->validate([
            'nama_dusun' => 'required|string|max:100',
            'tipe'       => 'required|in:desa,dusun',
            'warna'      => 'required|string|max:20',
            'koordinat'  => 'required|json',
        ]);

        $koordinat = json_decode($request->koordinat, true);
        if (!is_array($koordinat) || count($koordinat) < 3) {
            return response()->json(['success' => false, 'message' => 'Minimal 3 titik koordinat diperlukan.'], 422);
        }

        // Batas desa hanya boleh 1 — update jika sudah ada
        if ($request->tipe === 'desa') {
            $batas = BatasDusun::updateOrCreate(
                ['tipe' => 'desa'],
                ['nama_dusun' => $request->nama_dusun, 'warna' => $request->warna, 'koordinat' => $koordinat, 'is_active' => true]
            );
        } else {
            $batas = BatasDusun::create([
                'nama_dusun' => $request->nama_dusun,
                'tipe'       => 'dusun',
                'warna'      => $request->warna,
                'koordinat'  => $koordinat,
                'is_active'  => true,
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Berhasil disimpan.', 'id' => $batas->id]);
    }

    public function batasDusunUpdate(Request $request, $id)
    {
        $request->validate([
            'nama_dusun' => 'required|string|max:100',
            'warna'      => 'required|string|max:20',
            'koordinat'  => 'required|json',
            'is_active'  => 'boolean',
        ]);

        $koordinat = json_decode($request->koordinat, true);
        if (!is_array($koordinat) || count($koordinat) < 3) {
            return response()->json(['success' => false, 'message' => 'Minimal 3 titik koordinat diperlukan.'], 422);
        }

        $batas = BatasDusun::findOrFail($id);
        $batas->update([
            'nama_dusun' => $request->nama_dusun,
            'warna'      => $request->warna,
            'koordinat'  => $koordinat,
            'is_active'  => $request->boolean('is_active', true),
        ]);

        return response()->json(['success' => true, 'message' => 'Berhasil diperbarui.']);
    }

    public function batasDusunDestroy($id)
    {
        BatasDusun::findOrFail($id)->delete();
        return response()->json(['success' => true, 'message' => 'Batas dusun berhasil dihapus.']);
    }

    // Jika nilai koordinat di luar range (misal -7046738 dari Excel tanpa desimal),
    // bagi terus dengan 10 sampai masuk range yang valid.
    private function normalizeCoord(float $value, float $min, float $max): ?float
    {
        if ($value >= $min && $value <= $max) {
            return $value;
        }
        $v = $value;
        for ($i = 0; $i < 10; $i++) {
            $v /= 10;
            if ($v >= $min && $v <= $max) {
                return round($v, 8);
            }
        }
        return null; // tetap tidak valid, simpan sebagai null
    }
}
