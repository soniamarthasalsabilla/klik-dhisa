@extends('layouts.admin')
@section('title', 'Kelola Galeri')
@section('page-title', 'Galeri Foto')
@section('breadcrumb', 'Manajemen foto & dokumentasi kegiatan desa')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <span class="text-muted">Total: {{ $galeris->total() }} foto</span>
    <a href="{{ route('admin.galeri.create') }}" class="btn btn-desa-navy">
        <i class="fas fa-plus me-1"></i> Upload Foto
    </a>
</div>

<div class="row g-3">
    @forelse($galeris as $galeri)
    <div class="col-lg-3 col-md-4 col-6">
        <div class="card border-0 shadow-sm rounded-3 overflow-hidden h-100">
            <div style="height:180px;overflow:hidden;">
                <img src="{{ asset('storage/'.$galeri->foto) }}" class="w-100 h-100" style="object-fit:cover;">
            </div>
            <div class="card-body p-2">
                <p class="fw-semibold mb-1 small">{{ Str::limit($galeri->judul, 40) }}</p>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="badge bg-light text-dark border" style="font-size:0.7rem;">{{ $galeri->kategori }}</span>
                    <span class="badge {{ $galeri->is_active ? 'bg-success' : 'bg-secondary' }}" style="font-size:0.7rem;">
                        {{ $galeri->is_active ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </div>
            </div>
            <div class="card-footer bg-white border-top-0 p-2 d-flex gap-1">
                <a href="{{ route('admin.galeri.edit', $galeri) }}" class="btn btn-sm btn-outline-primary flex-fill">
                    <i class="fas fa-edit"></i>
                </a>
                <form method="POST" action="{{ route('admin.galeri.destroy', $galeri) }}"
                      onsubmit="return confirm('Hapus foto ini?')" class="flex-fill">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger w-100"><i class="fas fa-trash"></i></button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12 text-center text-muted py-5">
        <i class="fas fa-images fa-3x mb-3 opacity-25"></i>
        <p>Belum ada foto di galeri. Mulai upload foto kegiatan desa.</p>
    </div>
    @endforelse
</div>

<div class="mt-4">{{ $galeris->links() }}</div>
@endsection
