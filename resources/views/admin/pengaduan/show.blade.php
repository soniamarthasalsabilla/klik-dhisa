@extends('layouts.admin')
@section('title', 'Detail Pengaduan')
@section('page-title', 'Detail Pengaduan')

@section('content')
<div class="row g-4">
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm rounded-3 mb-4">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h6 class="fw-bold mb-0">Isi Pengaduan</h6>
                {!! $pengaduan->status_badge !!}
            </div>
            <div class="card-body p-4">
                <h5 class="fw-bold mb-3">{{ $pengaduan->judul }}</h5>
                <div class="d-flex flex-wrap gap-3 mb-4 text-muted small">
                    <span><i class="fas fa-user me-1"></i>{{ $pengaduan->nama }}</span>
                    @if($pengaduan->email)<span><i class="fas fa-envelope me-1"></i>{{ $pengaduan->email }}</span>@endif
                    @if($pengaduan->no_hp)<span><i class="fas fa-phone me-1"></i>{{ $pengaduan->no_hp }}</span>@endif
                    <span><i class="fas fa-tag me-1"></i>{{ $pengaduan->kategori }}</span>
                    <span><i class="fas fa-calendar me-1"></i>{{ $pengaduan->created_at->format('d M Y, H:i') }}</span>
                </div>
                <div class="p-3 bg-light rounded-3 lh-lg" style="white-space:pre-line;">{{ $pengaduan->isi }}</div>
            </div>
        </div>

        @if($pengaduan->catatan_admin)
        <div class="card border-0 shadow-sm rounded-3 border-start border-info border-3">
            <div class="card-body p-4">
                <h6 class="fw-bold text-info mb-2"><i class="fas fa-comment-dots me-2"></i>Catatan Admin</h6>
                <p class="mb-0 lh-lg">{{ $pengaduan->catatan_admin }}</p>
            </div>
        </div>
        @endif
    </div>

    <div class="col-lg-5">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-white fw-bold">Update Status Pengaduan</div>
            <div class="card-body p-4">
                <form action="{{ route('admin.pengaduan.update', $pengaduan) }}" method="POST">
                    @csrf @method('PATCH')
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Status</label>
                        <select name="status" class="form-select" required>
                            @foreach(\App\Models\Pengaduan::$statusLabels as $val => $info)
                            <option value="{{ $val }}" {{ $pengaduan->status === $val ? 'selected' : '' }}>
                                {{ $info['label'] }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Catatan Admin</label>
                        <textarea name="catatan_admin" class="form-control" rows="4"
                                  placeholder="Tanggapan atau informasi untuk pelapor...">{{ $pengaduan->catatan_admin }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-desa-navy w-100">
                        <i class="fas fa-save me-2"></i>Perbarui Status
                    </button>
                </form>
                <a href="{{ route('admin.pengaduan.index') }}" class="btn btn-outline-secondary w-100 mt-2">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
