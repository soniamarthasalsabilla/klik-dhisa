@extends('layouts.admin')
@section('title', 'Kelola Pamong')
@section('page-title', 'Struktur Pamong Desa')
@section('breadcrumb', 'Manajemen perangkat & struktur organisasi desa')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <span class="text-muted">Total: {{ $pamongs->total() }} pamong</span>
    <a href="{{ route('admin.pamong.create') }}" class="btn btn-desa-navy">
        <i class="fas fa-plus me-1"></i> Tambah Pamong
    </a>
</div>

<div class="card border-0 shadow-sm rounded-3">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th style="width:60px">Urutan</th>
                    <th style="width:70px">Foto</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>No. HP</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pamongs as $pamong)
                <tr>
                    <td class="text-center fw-bold text-muted">{{ $pamong->urutan }}</td>
                    <td>
                        @if($pamong->foto)
                            <img src="{{ asset('storage/'.$pamong->foto) }}" class="rounded-circle" style="width:48px;height:48px;object-fit:cover;">
                        @else
                            <div class="rounded-circle bg-light d-flex align-items-center justify-content-center" style="width:48px;height:48px;">
                                <i class="fas fa-user text-muted"></i>
                            </div>
                        @endif
                    </td>
                    <td class="fw-semibold">{{ $pamong->nama }}</td>
                    <td>{{ $pamong->jabatan }}</td>
                    <td>{{ $pamong->no_hp ?? '-' }}</td>
                    <td>
                        <span class="badge {{ $pamong->is_active ? 'bg-success' : 'bg-secondary' }}">
                            {{ $pamong->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.pamong.edit', $pamong) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.pamong.destroy', $pamong) }}"
                                  onsubmit="return confirm('Yakin hapus pamong ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center text-muted py-4">Belum ada data pamong.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-3">{{ $pamongs->links() }}</div>
</div>
@endsection
