<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function index()
    {
        $agendas = Agenda::orderByDesc('tanggal')->paginate(15);
        return view('admin.agenda.index', compact('agendas'));
    }

    public function create()
    {
        return view('admin.agenda.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul'        => 'required|string|max:255',
            'deskripsi'    => 'nullable|string',
            'lokasi'       => 'nullable|string|max:255',
            'tanggal'      => 'required|date',
            'waktu_mulai'  => 'nullable|date_format:H:i',
            'waktu_selesai'=> 'nullable|date_format:H:i',
            'kategori'     => 'nullable|string|max:100',
            'is_active'    => 'nullable|boolean',
        ]);
        $data['is_active'] = $request->has('is_active');
        Agenda::create($data);

        return redirect()->route('admin.agenda.index')->with('success', 'Agenda berhasil ditambahkan.');
    }

    public function edit(Agenda $agenda)
    {
        return view('admin.agenda.edit', compact('agenda'));
    }

    public function update(Request $request, Agenda $agenda)
    {
        $data = $request->validate([
            'judul'        => 'required|string|max:255',
            'deskripsi'    => 'nullable|string',
            'lokasi'       => 'nullable|string|max:255',
            'tanggal'      => 'required|date',
            'waktu_mulai'  => 'nullable|date_format:H:i',
            'waktu_selesai'=> 'nullable|date_format:H:i',
            'kategori'     => 'nullable|string|max:100',
            'is_active'    => 'nullable|boolean',
        ]);
        $data['is_active'] = $request->has('is_active');
        $agenda->update($data);

        return redirect()->route('admin.agenda.index')->with('success', 'Agenda berhasil diperbarui.');
    }

    public function destroy(Agenda $agenda)
    {
        $agenda->delete();
        return redirect()->route('admin.agenda.index')->with('success', 'Agenda berhasil dihapus.');
    }
}
