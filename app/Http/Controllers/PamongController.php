<?php

namespace App\Http\Controllers;

use App\Models\Pamong;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PamongController extends Controller
{
    public function index()
    {
        $pamongs = Pamong::orderBy('urutan')->paginate(15);
        return view('admin.pamong.index', compact('pamongs'));
    }

    public function create()
    {
        return view('admin.pamong.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'      => 'required|string|max:255',
            'jabatan'   => 'required|string|max:255',
            'foto'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'no_hp'     => 'nullable|string|max:20',
            'urutan'    => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('pamong', $filename, 'public');
            $data['foto'] = 'pamong/' . $filename;
        }

        $data['is_active'] = $request->has('is_active');
        $data['urutan'] = $data['urutan'] ?? 0;

        Pamong::create($data);

        return redirect()->route('admin.pamong.index')->with('success', 'Data pamong berhasil ditambahkan.');
    }

    public function edit(Pamong $pamong)
    {
        return view('admin.pamong.edit', compact('pamong'));
    }

    public function update(Request $request, Pamong $pamong)
    {
        $data = $request->validate([
            'nama'      => 'required|string|max:255',
            'jabatan'   => 'required|string|max:255',
            'foto'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'no_hp'     => 'nullable|string|max:20',
            'urutan'    => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('foto')) {
            if ($pamong->foto) Storage::disk('public')->delete($pamong->foto);
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('pamong', $filename, 'public');
            $data['foto'] = 'pamong/' . $filename;
        } else {
            unset($data['foto']);
        }

        $data['is_active'] = $request->has('is_active');
        $data['urutan'] = $data['urutan'] ?? $pamong->urutan;

        $pamong->update($data);

        return redirect()->route('admin.pamong.index')->with('success', 'Data pamong berhasil diperbarui.');
    }

    public function destroy(Pamong $pamong)
    {
        if ($pamong->foto) Storage::disk('public')->delete($pamong->foto);
        $pamong->delete();
        return redirect()->route('admin.pamong.index')->with('success', 'Data pamong berhasil dihapus.');
    }
}
