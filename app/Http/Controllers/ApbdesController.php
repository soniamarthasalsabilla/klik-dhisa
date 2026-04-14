<?php

namespace App\Http\Controllers;

use App\Models\Apbdes;
use Illuminate\Http\Request;

class ApbdesController extends Controller
{
    public function index()
    {
        $tahunList = Apbdes::select('tahun')->distinct()->orderByDesc('tahun')->pluck('tahun');
        $tahun     = request('tahun', $tahunList->first() ?? date('Y'));
        $items     = Apbdes::where('tahun', $tahun)->orderBy('jenis')->orderBy('urutan')->get();

        $totalAnggaran   = $items->where('jenis', 'belanja')->sum('anggaran');
        $totalRealisasi  = $items->where('jenis', 'belanja')->sum('realisasi');
        $totalPendapatan = $items->where('jenis', 'pendapatan')->sum('anggaran');

        return view('admin.apbdes.index', compact('items', 'tahun', 'tahunList', 'totalAnggaran', 'totalRealisasi', 'totalPendapatan'));
    }

    public function create()
    {
        $tahunList = Apbdes::select('tahun')->distinct()->orderByDesc('tahun')->pluck('tahun');
        return view('admin.apbdes.create', compact('tahunList'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'tahun'     => 'required|integer|min:2000|max:2099',
            'jenis'     => 'required|in:pendapatan,belanja',
            'bidang'    => 'required|string|max:255',
            'kegiatan'  => 'nullable|string|max:255',
            'anggaran'  => 'required|integer|min:0',
            'realisasi' => 'required|integer|min:0',
            'urutan'    => 'nullable|integer',
        ]);
        $data['urutan'] = $data['urutan'] ?? 0;
        Apbdes::create($data);

        return redirect()->route('admin.apbdes.index', ['tahun' => $data['tahun']])->with('success', 'Data APBDes berhasil ditambahkan.');
    }

    public function edit(Apbdes $apbde)
    {
        $tahunList = Apbdes::select('tahun')->distinct()->orderByDesc('tahun')->pluck('tahun');
        return view('admin.apbdes.edit', compact('apbde', 'tahunList'));
    }

    public function update(Request $request, Apbdes $apbde)
    {
        $data = $request->validate([
            'tahun'     => 'required|integer|min:2000|max:2099',
            'jenis'     => 'required|in:pendapatan,belanja',
            'bidang'    => 'required|string|max:255',
            'kegiatan'  => 'nullable|string|max:255',
            'anggaran'  => 'required|integer|min:0',
            'realisasi' => 'required|integer|min:0',
            'urutan'    => 'nullable|integer',
        ]);
        $data['urutan'] = $data['urutan'] ?? $apbde->urutan;
        $apbde->update($data);

        return redirect()->route('admin.apbdes.index', ['tahun' => $apbde->tahun])->with('success', 'Data APBDes berhasil diperbarui.');
    }

    public function destroy(Apbdes $apbde)
    {
        $tahun = $apbde->tahun;
        $apbde->delete();
        return redirect()->route('admin.apbdes.index', ['tahun' => $tahun])->with('success', 'Data berhasil dihapus.');
    }
}
