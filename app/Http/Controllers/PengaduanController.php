<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    // ── Public ──────────────────────────────────────────────────────────────

    public function form()
    {
        return view('pages.pengaduan');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'nama'     => 'required|string|max:255',
            'email'    => 'nullable|email|max:255',
            'no_hp'    => 'nullable|string|max:20',
            'kategori' => 'required|string|max:100',
            'judul'    => 'required|string|max:255',
            'isi'      => 'required|string|min:20',
        ]);

        Pengaduan::create($request->only('nama', 'email', 'no_hp', 'kategori', 'judul', 'isi'));

        return redirect()->route('pengaduan.form')->with('success', 'Pengaduan Anda telah diterima. Kami akan segera menindaklanjuti.');
    }

    // ── Admin ────────────────────────────────────────────────────────────────

    public function adminIndex()
    {
        $status    = request('status');
        $query     = Pengaduan::orderByDesc('created_at');
        if ($status) $query->where('status', $status);
        $pengaduans = $query->paginate(15)->withQueryString();
        $counts = [
            'menunggu' => Pengaduan::where('status', 'menunggu')->count(),
            'diproses' => Pengaduan::where('status', 'diproses')->count(),
            'selesai'  => Pengaduan::where('status', 'selesai')->count(),
            'ditolak'  => Pengaduan::where('status', 'ditolak')->count(),
        ];
        return view('admin.pengaduan.index', compact('pengaduans', 'counts', 'status'));
    }

    public function adminShow(Pengaduan $pengaduan)
    {
        return view('admin.pengaduan.show', compact('pengaduan'));
    }

    public function adminUpdate(Request $request, Pengaduan $pengaduan)
    {
        $request->validate([
            'status'        => 'required|in:menunggu,diproses,selesai,ditolak',
            'catatan_admin' => 'nullable|string',
        ]);

        $pengaduan->update([
            'status'        => $request->status,
            'catatan_admin' => $request->catatan_admin,
        ]);

        return redirect()->route('admin.pengaduan.show', $pengaduan)->with('success', 'Status pengaduan berhasil diperbarui.');
    }

    public function adminDestroy(Pengaduan $pengaduan)
    {
        $pengaduan->delete();
        return redirect()->route('admin.pengaduan.index')->with('success', 'Pengaduan dihapus.');
    }
}
