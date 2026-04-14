@extends('layouts.admin')
@section('title', 'Kelola UMKM')
@section('page-title', 'Kelola UMKM')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <p class="text-muted mb-0">Tambah, edit, atau hapus data UMKM yang ditampilkan di peta desa.</p>
    <a href="{{ route('admin.create') }}" class="btn btn-desa-navy">
        <i class="fas fa-plus me-2"></i>Tambah UMKM
    </a>
</div>

<div class="card border-0 shadow-sm rounded-3">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th class="ps-3" style="width:80px;">Foto</th>
                    <th>Nama Usaha</th>
                    <th>Pemilik</th>
                    <th>Kategori</th>
                    <th>No. WA</th>
                    <th class="text-center" style="width:130px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($semua_umkm as $umkm)
                <tr>
                    <td class="ps-3">
                        @if($umkm->foto)
                            <img src="{{ asset('storage/' . $umkm->foto) }}" alt="{{ $umkm->nama_usaha }}"
                                 class="rounded-2" style="height:48px;width:64px;object-fit:cover;">
                        @else
                            <div class="rounded-2 bg-light d-flex align-items-center justify-content-center text-muted"
                                 style="height:48px;width:64px;">
                                <i class="fas fa-store"></i>
                            </div>
                        @endif
                    </td>
                    <td class="fw-semibold">{{ $umkm->nama_usaha }}</td>
                    <td>{{ $umkm->pemilik }}</td>
                    <td><span class="badge bg-light text-dark border">{{ $umkm->kategori }}</span></td>
                    <td>
                        @if($umkm->no_hp)
                            <a href="https://wa.me/{{ $umkm->no_hp }}" target="_blank" class="text-decoration-none small text-muted">
                                <i class="fab fa-whatsapp text-success me-1"></i>{{ $umkm->no_hp }}
                            </a>
                        @else
                            <span class="text-muted small">-</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('admin.umkm.edit', $umkm->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                            <i class="fas fa-edit me-1"></i>Edit
                        </a>
                        <form method="POST" action="{{ route('admin.destroy', $umkm->id) }}" class="d-inline"
                              onsubmit="return confirm('Hapus UMKM ini?');">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-5">
                        <i class="fas fa-store fa-2x opacity-25 mb-2 d-block"></i>
                        Belum ada data UMKM. <a href="{{ route('admin.create') }}">Tambah sekarang</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($semua_umkm->hasPages())
    <div class="card-footer bg-white border-0 py-3 d-flex justify-content-center">
        {{ $semua_umkm->links() }}
    </div>
    @endif
</div>

@endsection
