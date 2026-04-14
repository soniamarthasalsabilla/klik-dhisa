<?php

namespace App\Http\Controllers;

use App\Models\AsetDesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AsetDesaController extends Controller
{
    public function index(Request $request)
    {
        $query = AsetDesa::orderBy('jenis')->orderBy('nama');
        if ($request->filled('jenis')) {
            $query->where('jenis', $request->jenis);
        }
        $asets = $query->paginate(20)->withQueryString();

        $totals = AsetDesa::selectRaw('jenis, count(*) as jumlah')
            ->groupBy('jenis')
            ->pluck('jumlah', 'jenis');

        return view('admin.aset.index', compact('asets', 'totals'));
    }

    public function create()
    {
        return view('admin.aset.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'            => 'required|string|max:255',
            'jenis'           => 'required|string',
            'kondisi'         => 'required|string',
            'lokasi'          => 'nullable|string|max:255',
            'luas'            => 'nullable|numeric|min:0',
            'tahun_perolehan' => 'nullable|integer|min:1900|max:2099',
            'nilai_perolehan' => 'nullable|integer|min:0',
            'keterangan'      => 'nullable|string',
            'foto'            => 'nullable|image|max:2048',
            'latitude'        => 'nullable|numeric|between:-90,90',
            'longitude'       => 'nullable|numeric|between:-180,180',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('aset', 'public');
        }
        $validated['is_active'] = $request->boolean('is_active', true);

        AsetDesa::create($validated);

        return redirect()->route('admin.aset.index')
            ->with('success', 'Aset berhasil ditambahkan.');
    }

    public function edit(AsetDesa $aset)
    {
        return view('admin.aset.edit', compact('aset'));
    }

    public function update(Request $request, AsetDesa $aset)
    {
        $validated = $request->validate([
            'nama'            => 'required|string|max:255',
            'jenis'           => 'required|string',
            'kondisi'         => 'required|string',
            'lokasi'          => 'nullable|string|max:255',
            'luas'            => 'nullable|numeric|min:0',
            'tahun_perolehan' => 'nullable|integer|min:1900|max:2099',
            'nilai_perolehan' => 'nullable|integer|min:0',
            'keterangan'      => 'nullable|string',
            'foto'            => 'nullable|image|max:2048',
            'latitude'        => 'nullable|numeric|between:-90,90',
            'longitude'       => 'nullable|numeric|between:-180,180',
        ]);

        if ($request->hasFile('foto')) {
            if ($aset->foto) Storage::disk('public')->delete($aset->foto);
            $validated['foto'] = $request->file('foto')->store('aset', 'public');
        }
        $validated['is_active'] = $request->boolean('is_active', true);

        $aset->update($validated);

        return redirect()->route('admin.aset.index')
            ->with('success', 'Aset berhasil diperbarui.');
    }

    public function destroy(AsetDesa $aset)
    {
        if ($aset->foto) Storage::disk('public')->delete($aset->foto);
        $aset->delete();
        return back()->with('success', 'Aset berhasil dihapus.');
    }
}
