@extends('layouts.admin')
@section('title', 'Edit – ' . ucfirst($section))
@section('page-title', 'Edit ' . ($section === 'layanan' ? 'Layanan Desa' : ($section === 'arsip' ? 'Publikasi Desa' : ($section === 'informasi' ? 'Informasi Publik' : 'Konten'))))
@section('breadcrumb', 'Kelola ' . ucfirst($section) . ' → Edit')

@section('content')

<div class="row justify-content-center">
<div class="col-lg-8">

<div class="card border-0 shadow-sm rounded-3">
    <div class="card-header border-0 py-3 px-4" style="background: var(--color-1);">
        <h6 class="mb-0 fw-bold" style="color:var(--color-7);">
            <i class="fas fa-edit me-2" style="color:var(--color-5);"></i>
            @if($section === 'layanan')    Edit Layanan
            @elseif($section === 'arsip')  Edit Publikasi Desa
            @elseif($section === 'informasi') Edit Informasi Publik
            @else Edit Konten
            @endif
            — <span class="fw-normal opacity-75">{{ $item->title }}</span>
        </h6>
    </div>

    <div class="card-body p-4">

        @if($errors->any())
        <div class="alert alert-danger rounded-3 small">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <ul class="mb-0 ps-3 mt-1">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
        @endif

        <form action="{{ route('admin.content.update', ['section' => $section, 'id' => $item->id]) }}"
              method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')

            {{-- ========== LAYANAN ========== --}}
            @if($section === 'layanan')

            <div class="mb-3">
                <label class="form-label fw-semibold" style="color:var(--color-7);">
                    Nama Layanan <span class="text-danger">*</span>
                </label>
                <input type="text" name="title"
                       class="form-control @error('title') is-invalid @enderror"
                       value="{{ old('title', $item->title) }}" required>
                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold" style="color:var(--color-7);">Kategori <span class="text-danger">*</span></label>
                <select name="category" class="form-select @error('category') is-invalid @enderror" required>
                    <option value="">— Pilih Kategori —</option>
                    @foreach(['Administrasi','Keterangan','Perizinan','Bantuan Sosial'] as $kat)
                    <option value="{{ $kat }}" {{ old('category', $item->category) === $kat ? 'selected' : '' }}>{{ $kat }}</option>
                    @endforeach
                </select>
                @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold" style="color:var(--color-7);">Deskripsi Singkat</label>
                <textarea name="excerpt" class="form-control" rows="2"
                          placeholder="cth. Surat keterangan tempat tinggal resmi dari desa">{{ old('excerpt', $item->excerpt) }}</textarea>
                <div class="form-text">Ditampilkan di kartu layanan utama.</div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold" style="color:var(--color-7);">Persyaratan Dokumen</label>
                <textarea name="body" class="form-control" rows="4"
                          placeholder="KTP, Kartu Keluarga, Surat Pengantar RT/RW">{{ old('body', $item->body) }}</textarea>
                <div class="form-text">
                    <i class="fas fa-info-circle me-1" style="color:var(--color-5);"></i>
                    Pisahkan setiap syarat dengan <strong>koma (,)</strong>.
                    cth: <em>KTP, Kartu Keluarga, Surat Pengantar RT/RW</em>
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="form-label fw-semibold" style="color:var(--color-7);">Urutan Tampil</label>
                    <input type="number" name="order" class="form-control"
                           value="{{ old('order', $item->order) }}" min="0">
                    <div class="form-text">Angka lebih kecil tampil lebih awal.</div>
                </div>
                <div class="col-md-6 d-flex align-items-end pb-1">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active"
                               {{ old('is_active', $item->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label fw-semibold" for="is_active" style="color:var(--color-7);">
                            Tampilkan di halaman publik
                        </label>
                    </div>
                </div>
            </div>

            {{-- ========== ARSIP ========== --}}
            @elseif($section === 'arsip')

            <div class="mb-3">
                <label class="form-label fw-semibold" style="color:var(--color-7);">Judul Dokumen <span class="text-danger">*</span></label>
                <input type="text" name="title"
                       class="form-control @error('title') is-invalid @enderror"
                       value="{{ old('title', $item->title) }}" required>
                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold" style="color:var(--color-7);">Kategori</label>
                    <input type="text" name="category" class="form-control"
                           value="{{ old('category', $item->category) }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold" style="color:var(--color-7);">Tahun</label>
                    <input type="text" name="year" class="form-control"
                           value="{{ old('year', $item->year) }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold" style="color:var(--color-7);">Urutan</label>
                    <input type="number" name="order" class="form-control"
                           value="{{ old('order', $item->order) }}" min="0">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold" style="color:var(--color-7);">Deskripsi</label>
                <textarea name="excerpt" class="form-control" rows="2">{{ old('excerpt', $item->excerpt) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold" style="color:var(--color-7);">Link Dokumen <small class="text-muted fw-normal">(opsional)</small></label>
                <input type="url" name="link" class="form-control"
                       value="{{ old('link', $item->link) }}" placeholder="https://...">
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold" style="color:var(--color-7);">Ganti File <small class="text-muted fw-normal">(kosongkan jika tidak diganti)</small></label>
                <input type="file" name="file" class="form-control" accept=".pdf,.doc,.docx,.xls,.xlsx">
                @if($item->file)
                <div class="mt-2 small">
                    <i class="fas fa-paperclip me-1" style="color:var(--color-5);"></i>File saat ini:
                    <a href="{{ asset('storage/' . $item->file) }}" target="_blank" class="text-primary">{{ basename($item->file) }}</a>
                </div>
                @endif
            </div>

            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" name="is_active" id="is_active"
                       {{ old('is_active', $item->is_active) ? 'checked' : '' }}>
                <label class="form-check-label fw-semibold" for="is_active" style="color:var(--color-7);">Tampilkan di halaman publik</label>
            </div>

            {{-- ========== INFORMASI / LAINNYA ========== --}}
            @else

            <div class="mb-3">
                <label class="form-label fw-semibold" style="color:var(--color-7);">Judul <span class="text-danger">*</span></label>
                <input type="text" name="title"
                       class="form-control @error('title') is-invalid @enderror"
                       value="{{ old('title', $item->title) }}" required>
                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold" style="color:var(--color-7);">Ringkasan</label>
                <textarea name="excerpt" class="form-control" rows="2">{{ old('excerpt', $item->excerpt) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold" style="color:var(--color-7);">Isi Konten</label>
                <textarea name="body" class="form-control" rows="5">{{ old('body', $item->body) }}</textarea>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <label class="form-label fw-semibold" style="color:var(--color-7);">Kategori</label>
                    <input type="text" name="category" class="form-control"
                           value="{{ old('category', $item->category) }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold" style="color:var(--color-7);">Tahun</label>
                    <input type="text" name="year" class="form-control"
                           value="{{ old('year', $item->year) }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold" style="color:var(--color-7);">Urutan</label>
                    <input type="number" name="order" class="form-control"
                           value="{{ old('order', $item->order) }}" min="0">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold" style="color:var(--color-7);">Link <small class="text-muted fw-normal">(opsional)</small></label>
                <input type="url" name="link" class="form-control"
                       value="{{ old('link', $item->link) }}" placeholder="https://...">
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold" style="color:var(--color-7);">URL Gambar <small class="text-muted fw-normal">(opsional)</small></label>
                <input type="url" name="image" class="form-control"
                       value="{{ old('image', $item->image) }}" placeholder="https://...">
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold" style="color:var(--color-7);">Ganti File <small class="text-muted fw-normal">(kosongkan jika tidak diganti)</small></label>
                <input type="file" name="file" class="form-control" accept=".pdf,.doc,.docx,.xls,.xlsx">
                @if($item->file)
                <div class="mt-2 small">
                    <i class="fas fa-paperclip me-1" style="color:var(--color-5);"></i>File saat ini:
                    <a href="{{ asset('storage/' . $item->file) }}" target="_blank" class="text-primary">{{ basename($item->file) }}</a>
                </div>
                @endif
            </div>

            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" name="is_active" id="is_active"
                       {{ old('is_active', $item->is_active) ? 'checked' : '' }}>
                <label class="form-check-label fw-semibold" for="is_active" style="color:var(--color-7);">Aktifkan konten ini</label>
            </div>

            @endif

            {{-- Tombol Submit --}}
            <div class="d-flex gap-2 pt-2 border-top">
                <button type="submit" class="btn btn-desa-navy px-4">
                    <i class="fas fa-save me-2"></i>Simpan Perubahan
                </button>
                <a href="{{ route('admin.content.manage', $section) }}" class="btn btn-outline-secondary px-3">
                    <i class="fas fa-arrow-left me-1"></i>Kembali
                </a>
            </div>
        </form>
    </div>
</div>

</div>
</div>

@endsection
