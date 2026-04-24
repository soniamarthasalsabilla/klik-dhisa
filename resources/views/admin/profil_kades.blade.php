@extends('layouts.admin')
@section('title', 'Profil Kepala Desa')
@section('page-title', 'Profil Kepala Desa')
@section('breadcrumb', 'Data & Foto Kepala Desa')

@section('content')
<div class="row justify-content-center">
<div class="col-lg-8">

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show rounded-3 mb-4" role="alert">
    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@if($errors->any())
<div class="alert alert-danger rounded-3 mb-4 small">
    <i class="fas fa-exclamation-triangle me-2"></i>
    <ul class="mb-0 ps-3 mt-1">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
</div>
@endif

<form action="{{ route('admin.profil_kades.update') }}" method="POST" enctype="multipart/form-data">
    @csrf

    {{-- Foto Kades --}}
    <div class="card border-0 shadow-sm rounded-3 mb-4">
        <div class="card-header bg-white fw-bold">
            <i class="fas fa-camera me-2 text-primary"></i>Foto Kepala Desa
        </div>
        <div class="card-body">
            <div class="d-flex align-items-start gap-4 flex-wrap">
                <div class="text-center">
                    @if($kades->image)
                        <img src="{{ asset('storage/' . $kades->image) }}"
                             id="preview-foto"
                             alt="Foto Kades"
                             class="rounded-circle border"
                             style="width:140px;height:140px;object-fit:cover;">
                    @else
                        <img src="{{ asset('img/desa cantik.png') }}"
                             id="preview-foto"
                             alt="Foto Kades"
                             class="rounded-circle border"
                             style="width:140px;height:140px;object-fit:cover;">
                    @endif
                    <div class="small text-muted mt-2">Foto saat ini</div>
                </div>
                <div class="flex-fill">
                    <label class="form-label fw-semibold">Upload Foto Baru</label>
                    <input type="file" name="foto_kades" id="foto_kades"
                           class="form-control @error('foto_kades') is-invalid @enderror"
                           accept="image/jpeg,image/png,image/jpg">
                    @error('foto_kades')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <div class="form-text">Format: JPG, PNG. Maksimal 2MB. Disarankan foto berbentuk persegi.</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Data Kades --}}
    <div class="card border-0 shadow-sm rounded-3 mb-4">
        <div class="card-header bg-white fw-bold">
            <i class="fas fa-user-tie me-2 text-success"></i>Data Kepala Desa
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                <input type="text" name="nama_kades"
                       class="form-control @error('nama_kades') is-invalid @enderror"
                       value="{{ old('nama_kades', $kades->title) }}"
                       placeholder="cth. H. Ahmad Fauzi, S.Sos" required>
                @error('nama_kades')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Jabatan <span class="text-danger">*</span></label>
                <input type="text" name="jabatan"
                       class="form-control @error('jabatan') is-invalid @enderror"
                       value="{{ old('jabatan', $kades->body) }}"
                       placeholder="cth. Kepala Desa Tajungan" required>
                @error('jabatan')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-0">
                <label class="form-label fw-semibold">Kutipan / Sambutan Singkat</label>
                <textarea name="quote"
                          class="form-control"
                          rows="4"
                          placeholder="Pesan atau sambutan singkat dari Kepala Desa...">{{ old('quote', $kades->excerpt) }}</textarea>
                <div class="form-text">Ditampilkan di halaman utama website desa.</div>
            </div>
        </div>
    </div>

    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-desa-navy px-5">
            <i class="fas fa-save me-2"></i>Simpan Profil Kades
        </button>
    </div>
</form>

</div>
</div>

<script>
document.getElementById('foto_kades').addEventListener('change', function () {
    const file = this.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = e => document.getElementById('preview-foto').src = e.target.result;
    reader.readAsDataURL(file);
});
</script>
@endsection
