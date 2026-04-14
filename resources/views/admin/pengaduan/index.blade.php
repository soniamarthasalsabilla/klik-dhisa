@extends('layouts.admin')
@section('title', 'Kelola Pengaduan')
@section('page-title', 'Pengaduan & Aspirasi Warga')

@section('content')
{{-- Status Counter --}}
<div class="row g-3 mb-4">
    @foreach(['menunggu'=>['warning','clock'],'diproses'=>['info','spinner'],'selesai'=>['success','check-circle'],'ditolak'=>['danger','times-circle']] as $s=>[$color,$icon])
    <div class="col-6 col-md-3">
        <a href="{{ route('admin.pengaduan.index', ['status'=>$s]) }}" class="text-decoration-none">
            <div class="card border-0 shadow-sm rounded-3 p-3 text-center {{ $status==$s ? 'border border-'.$color.' border-2' : '' }}">
                <i class="fas fa-{{ $icon }} fa-lg text-{{ $color }} mb-1"></i>
                <h4 class="fw-bold mb-0">{{ $counts[$s] }}</h4>
                <small class="text-muted text-capitalize">{{ $s }}</small>
            </div>
        </a>
    </div>
    @endforeach
</div>

@if($status)
<div class="mb-3">
    <a href="{{ route('admin.pengaduan.index') }}" class="btn btn-sm btn-outline-secondary">
        <i class="fas fa-times me-1"></i> Hapus Filter
    </a>
</div>
@endif

<div class="card border-0 shadow-sm rounded-3">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Nama / Kontak</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengaduans as $p)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <p class="fw-semibold mb-0">{{ $p->nama }}</p>
                        <small class="text-muted">{{ $p->no_hp ?? $p->email ?? '-' }}</small>
                    </td>
                    <td>{{ Str::limit($p->judul, 50) }}</td>
                    <td><span class="badge bg-light text-dark border">{{ $p->kategori }}</span></td>
                    <td>{!! $p->status_badge !!}</td>
                    <td><small>{{ $p->created_at->format('d M Y') }}</small></td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.pengaduan.show', $p) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.pengaduan.destroy', $p) }}"
                                  onsubmit="return confirm('Hapus pengaduan ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center text-muted py-4">Belum ada pengaduan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-3">{{ $pengaduans->links() }}</div>
</div>
@endsection
