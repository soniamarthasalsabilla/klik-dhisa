@extends('layouts.admin')
@section('title', 'Tampilan Beranda')
@section('page-title', 'Tampilan Beranda')
@section('breadcrumb', 'Kelola Hero, Background & Logo Navbar')

@section('content')

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<form action="{{ route('admin.tampilan_beranda.update') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="row g-4">

        {{-- Logo Navbar --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-3 h-100">
                <div class="card-header bg-white fw-bold">
                    <i class="fas fa-image me-2 text-primary"></i>Logo & Nama Navbar
                </div>
                <div class="card-body d-flex flex-column gap-3">

                    {{-- Live Preview Navbar --}}
                    <div class="rounded-3 px-3 py-2 d-flex align-items-center gap-2" style="background:#1E5A52;">
                        {{-- Logo atau ikon --}}
                        @if(!empty($settings['logo_desa']))
                            <img id="preview-logo"
                                 src="{{ asset('storage/' . $settings['logo_desa']) }}"
                                 alt="Logo Desa"
                                 style="height:34px;width:auto;object-fit:contain;flex-shrink:0;">
                            <i id="preview-logo-icon" class="fas fa-landmark text-warning"
                               style="font-size:1.5rem;flex-shrink:0;display:none;"></i>
                        @else
                            <i id="preview-logo-icon" class="fas fa-landmark text-warning"
                               style="font-size:1.5rem;flex-shrink:0;"></i>
                            <img id="preview-logo" src="" alt=""
                                 style="height:34px;width:auto;object-fit:contain;flex-shrink:0;display:none;">
                        @endif
                        <span style="font-size:1.05rem;font-weight:700;color:#fff;font-family:'Playfair Display',serif;">Dhis&#xE2;</span>
                        <span id="preview-nama-desa"
                              style="font-size:1.05rem;font-weight:700;color:rgba(255,255,255,0.85);font-family:'Playfair Display',serif;">{{ $settings['nama_navbar'] ?? '' }}</span>
                        <small class="ms-auto text-white opacity-40" style="font-size:0.6rem;">Preview</small>
                    </div>

                    {{-- Nama Desa di Navbar --}}
                    <div>
                        <label class="form-label fw-semibold">Nama Desa di Navbar</label>
                        <input type="text" name="nama_navbar" id="input-nama-navbar" class="form-control"
                               value="{{ $settings['nama_navbar'] ?? '' }}"
                               placeholder="contoh: Tajungan"
                               maxlength="50">
                        <small class="text-muted">Teks kecil yang tampil di bawah "Dhisâ" pada navbar.</small>
                    </div>

                    {{-- Upload Logo --}}
                    <div>
                        <label class="form-label fw-semibold">Upload Logo PNG/JPG</label>
                        <input type="file" name="logo_desa" id="input-logo" class="form-control"
                               accept="image/png,image/jpeg,image/jpg,image/webp"
                               onchange="previewLogoAndText(this)">
                        <small class="text-muted">Gunakan PNG transparan untuk hasil terbaik. Maks 2MB.</small>
                    </div>

                    @if(!empty($settings['logo_desa']))
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="hapus_logo" id="hapus_logo" value="1"
                               onchange="handleHapusLogo(this)">
                        <label class="form-check-label text-danger" for="hapus_logo">Hapus logo & kembali ke ikon default</label>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Preview Footer --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-3 h-100">
                <div class="card-header bg-white fw-bold">
                    <i class="fas fa-shoe-prints me-2 text-secondary"></i>Preview Footer
                </div>
                <div class="card-body d-flex flex-column gap-3">
                    {{-- Live Preview Footer --}}
                    <div class="rounded-3 px-3 py-2 d-flex align-items-center gap-2 flex-wrap" style="background:#1E5A52;">
                        <img src="{{ asset('img/logo-pemda.png') }}" alt="Pemda" style="height:20px;width:auto;object-fit:contain;opacity:.9;">
                        <img src="{{ asset('img/logo-bps.png') }}" alt="BPS" style="height:20px;width:auto;object-fit:contain;opacity:.9;">
                        <img src="{{ asset('img/desa-cantik.png') }}" alt="Desa Cantik" style="height:20px;width:auto;object-fit:contain;opacity:.9;">
                        <span style="width:1px;height:20px;background:rgba(255,255,255,.3);flex-shrink:0;"></span>
                        @if(!empty($settings['logo_desa']))
                            <img id="preview-footer-logo"
                                 src="{{ asset('storage/' . $settings['logo_desa']) }}"
                                 alt="Logo Desa"
                                 style="height:24px;width:auto;object-fit:contain;flex-shrink:0;">
                            <i id="preview-footer-icon" class="fas fa-landmark text-warning"
                               style="font-size:1rem;flex-shrink:0;display:none;"></i>
                        @else
                            <i id="preview-footer-icon" class="fas fa-landmark text-warning"
                               style="font-size:1rem;flex-shrink:0;"></i>
                            <img id="preview-footer-logo" src="" alt=""
                                 style="height:24px;width:auto;object-fit:contain;flex-shrink:0;display:none;">
                        @endif
                        <span style="font-size:.85rem;font-weight:700;color:#fff;font-family:'Playfair Display',serif;">Dhis&#xE2;</span>
                        <span id="preview-footer-nama"
                              style="font-size:.85rem;font-weight:700;color:rgba(255,255,255,.85);font-family:'Playfair Display',serif;">{{ $settings['nama_navbar'] ?? '' }}</span>
                        <small class="ms-auto text-white opacity-40" style="font-size:0.6rem;">Footer</small>
                    </div>
                    <p class="text-muted small mb-0">
                        <i class="fas fa-info-circle me-1 text-primary"></i>
                        Footer menggunakan logo dan nama desa yang sama dengan Navbar. Edit di kartu sebelah kiri.
                    </p>
                </div>
            </div>
        </div>

        {{-- Teks Hero --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bg-white fw-bold">
                    <i class="fas fa-heading me-2 text-success"></i>Teks Hero Beranda
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Badge Lokasi <small class="text-muted">(teks kecil di atas judul)</small></label>
                        <input type="text" name="hero_badge" class="form-control"
                               value="{{ $settings['hero_badge'] ?? 'Kec. Kamal · Kab. Bangkalan · Madura' }}"
                               placeholder="Kec. Kamal · Kab. Bangkalan · Madura">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama / Judul Utama <small class="text-muted">(nama desa yang tampil kuning)</small></label>
                        <input type="text" name="hero_judul" class="form-control"
                               value="{{ $settings['hero_judul'] ?? 'Desa Tajungan' }}"
                               placeholder="Desa Tajungan">
                    </div>
                    <div class="mb-0">
                        <label class="form-label fw-semibold">Deskripsi Hero</label>
                        <textarea name="hero_deskripsi" class="form-control" rows="3"
                                  placeholder="Desa Cantik (Cinta Statistik) — ...">{{ $settings['hero_deskripsi'] ?? 'Desa Cantik (Cinta Statistik) — mewujudkan pemerintahan yang transparan, digital, dan berpihak pada warga.' }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        {{-- Background Hero --}}
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bg-white fw-bold">
                    <i class="fas fa-panorama me-2 text-warning"></i>Foto Background Hero
                </div>
                <div class="card-body">
                    <div class="row g-4 align-items-center">
                        <div class="col-lg-5">
                            <div id="bg-preview-wrap" style="height:180px;border-radius:12px;overflow:hidden;background:#eee;position:relative;">
                                @if(!empty($settings['hero_bg_foto']))
                                    <img id="preview-bg"
                                         src="{{ asset('storage/' . $settings['hero_bg_foto']) }}"
                                         style="width:100%;height:100%;object-fit:cover;">
                                @else
                                    <img id="preview-bg" src="" style="width:100%;height:100%;object-fit:cover;display:none;">
                                    <div id="preview-bg-placeholder" class="d-flex align-items-center justify-content-center h-100 text-muted">
                                        <div class="text-center">
                                            <i class="fas fa-image fs-2 mb-2"></i>
                                            <p class="mb-0 small">Belum ada foto background</p>
                                        </div>
                                    </div>
                                @endif
                                <div style="position:absolute;inset:0;background:linear-gradient(135deg,rgba(30,90,82,.55),rgba(58,154,140,.4));border-radius:12px;display:flex;align-items:center;justify-content:center;">
                                    <span class="text-white fw-bold" style="font-size:.85rem;text-shadow:0 1px 4px rgba(0,0,0,.5);">Preview Overlay</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <label class="form-label fw-semibold">Upload Foto Background</label>
                            <input type="file" name="hero_bg_foto" class="form-control mb-2"
                                   accept="image/jpeg,image/png,image/jpg,image/webp"
                                   onchange="previewImg(this,'preview-bg','preview-bg-placeholder')">
                            <small class="text-muted">Foto landscape resolusi tinggi (≥1600px lebar). JPG/PNG/WebP, maks 5MB.</small>
                            @if(!empty($settings['hero_bg_foto']))
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" name="hapus_bg" id="hapus_bg" value="1">
                                <label class="form-check-label text-danger" for="hapus_bg">Hapus foto & kembali ke foto default</label>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 text-end">
            <button type="submit" class="btn btn-desa-navy px-5">
                <i class="fas fa-save me-2"></i>Simpan Perubahan
            </button>
        </div>

    </div>
</form>

@endsection

@push('scripts')
<script>
function previewImg(input, imgId, placeholderId) {
    var file = input.files[0];
    if (!file) return;
    var reader = new FileReader();
    reader.onload = function(e) {
        var img = document.getElementById(imgId);
        img.src = e.target.result;
        img.style.display = '';
        if (placeholderId) {
            var ph = document.getElementById(placeholderId);
            if (ph) ph.style.display = 'none';
        }
    };
    reader.readAsDataURL(file);
}

// Preview logo (navbar + footer) saat logo diupload
function previewLogoAndText(input) {
    var file = input.files[0];
    if (!file) return;
    var reader = new FileReader();
    reader.onload = function(e) {
        ['preview-logo', 'preview-footer-logo'].forEach(function(id) {
            var img = document.getElementById(id);
            if (img) { img.src = e.target.result; img.style.display = ''; }
        });
        ['preview-logo-icon', 'preview-footer-icon'].forEach(function(id) {
            var icon = document.getElementById(id);
            if (icon) icon.style.display = 'none';
        });
        var hapus = document.getElementById('hapus_logo');
        if (hapus) hapus.checked = false;
    };
    reader.readAsDataURL(file);
}

// Saat checkbox hapus logo dicentang → tampilkan kembali ikon
function handleHapusLogo(checkbox) {
    var imgs  = ['preview-logo', 'preview-footer-logo'];
    var icons = ['preview-logo-icon', 'preview-footer-icon'];
    if (checkbox.checked) {
        imgs.forEach(id => { var el = document.getElementById(id); if(el) el.style.display = 'none'; });
        icons.forEach(id => { var el = document.getElementById(id); if(el) el.style.display = ''; });
    } else {
        imgs.forEach(id => { var el = document.getElementById(id); if(el && el.src && el.src !== window.location.href) el.style.display = ''; });
        icons.forEach(id => { var el = document.getElementById(id); if(el) el.style.display = 'none'; });
    }
}

// Live preview nama desa di navbar & footer preview
document.addEventListener('DOMContentLoaded', function () {
    var input = document.getElementById('input-nama-navbar');
    if (input) {
        input.addEventListener('input', function () {
            ['preview-nama-desa', 'preview-footer-nama'].forEach(function(id) {
                var el = document.getElementById(id);
                if (el) el.textContent = input.value;
            });
        });
    }
});
</script>
@endpush
