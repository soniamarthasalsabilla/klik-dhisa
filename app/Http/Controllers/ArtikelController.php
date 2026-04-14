<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArtikelController extends Controller
{
    public function index()
    {
        $artikels = Artikel::orderByDesc('published_at')->paginate(10);
        return view('admin.artikel.index', compact('artikels'));
    }

    public function create()
    {
        return view('admin.artikel.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul'    => 'required|string|max:255',
            'ringkasan'=> 'nullable|string',
            'isi'      => 'required|string',
            'foto'     => 'nullable|image|mimes:jpeg,png,jpg|max:4096',
            'kategori' => 'nullable|string|max:100',
            'is_active'=> 'nullable|boolean',
        ]);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('artikel', $filename, 'public');
            $data['foto'] = 'artikel/' . $filename;
        }

        $data['slug'] = Artikel::generateSlug($data['judul']);
        $data['is_active'] = $request->has('is_active');
        $data['published_at'] = $request->has('is_active') ? now() : null;

        Artikel::create($data);

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil dipublikasikan.');
    }

    public function edit(Artikel $artikel)
    {
        return view('admin.artikel.edit', compact('artikel'));
    }

    public function update(Request $request, Artikel $artikel)
    {
        $data = $request->validate([
            'judul'    => 'required|string|max:255',
            'ringkasan'=> 'nullable|string',
            'isi'      => 'required|string',
            'foto'     => 'nullable|image|mimes:jpeg,png,jpg|max:4096',
            'kategori' => 'nullable|string|max:100',
            'is_active'=> 'nullable|boolean',
        ]);

        if ($request->hasFile('foto')) {
            if ($artikel->foto) Storage::disk('public')->delete($artikel->foto);
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('artikel', $filename, 'public');
            $data['foto'] = 'artikel/' . $filename;
        } else {
            unset($data['foto']);
        }

        $data['is_active'] = $request->has('is_active');
        if ($request->has('is_active') && !$artikel->published_at) {
            $data['published_at'] = now();
        }

        $artikel->update($data);

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Artikel $artikel)
    {
        if ($artikel->foto) Storage::disk('public')->delete($artikel->foto);
        $artikel->delete();
        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil dihapus.');
    }
}
