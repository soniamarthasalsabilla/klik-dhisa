@extends('layouts.admin')
@section('title', 'Kelola Artikel')
@section('page-title', 'Berita & Artikel')
@section('breadcrumb', 'Manajemen konten berita dan informasi desa')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <span class="text-muted">Total: {{ $artikels->total() }} artikel</span>
    <a href="{{ route('admin.artikel.create') }}" class="btn btn-desa-navy">
        <i class="fas fa-plus me-1"></i> Tulis Artikel
    </a>
</div>

<div class="card border-0 shadow-sm rounded-3">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th style="width:80px">Foto</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($artikels as $artikel)
                <tr>
                    <td>
                        @if($artikel->foto)
                            <img src="{{ asset('storage/'.$artikel->foto) }}" class="rounded" style="width:64px;height:48px;object-fit:cover;">
                        @else
                            <div class="rounded bg-light d-flex align-items-center justify-content-center" style="width:64px;height:48px;">
                                <i class="fas fa-newspaper text-muted"></i>
                            </div>
                        @endif
                    </td>
                    <td>
                        <p class="fw-semibold mb-0">{{ Str::limit($artikel->judul, 60) }}</p>
                        <small class="text-muted">{{ Str::limit($artikel->ringkasan, 80) }}</small>
                    </td>
                    <td><span class="badge bg-info text-dark">{{ $artikel->kategori }}</span></td>
                    <td>
                        <small>{{ $artikel->published_at ? $artikel->published_at->format('d M Y') : '-' }}</small>
                    </td>
                    <td>
                        <span class="badge {{ $artikel->is_active ? 'bg-success' : 'bg-secondary' }}">
                            {{ $artikel->is_active ? 'Publik' : 'Draft' }}
                        </span>
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.artikel.edit', $artikel) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.artikel.destroy', $artikel) }}"
                                  onsubmit="return confirm('Hapus artikel ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted py-4">Belum ada artikel.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-3">{{ $artikels->links() }}</div>
</div>
@endsection
