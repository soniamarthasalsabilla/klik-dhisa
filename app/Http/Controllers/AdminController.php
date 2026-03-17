<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use Illuminate\Http\Request;

class AdminController extends Controller
{


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
        ]);

        Umkm::create($validatedData);

        return redirect()->route('umkm.desa')->with('success', 'Data UMKM Berhasil Ditambahkan!');
    }

    public function manage() {
    $semua_umkm = Umkm::all();
    return view('admin.kelola_umkm', compact('semua_umkm'));
    }

    public function destroy($id)
    {
        $umkm = Umkm::findOrFail($id);
        $umkm->delete();

        return redirect()->back()->with('success', 'Data UMKM berhasil dihapus!');
    }
}