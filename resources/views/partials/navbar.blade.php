@php
    $navLogo     = \App\Models\DesaSetting::get('logo_desa');
    $navNamaDesa = \App\Models\DesaSetting::get('nama_navbar');
@endphp
<nav class="navbar navbar-expand-lg navbar-dark sticky-top shadow-sm py-3" style="background-color: var(--color-7) !important;">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
            {{-- Logo desa jika diupload, fallback ke ikon --}}
            @if($navLogo)
                <img src="{{ asset('storage/'.$navLogo) }}" alt="Logo Desa"
                     style="height:38px;width:auto;object-fit:contain;flex-shrink:0;">
            @else
                <i class="fas fa-landmark text-warning" style="font-size:1.7rem;flex-shrink:0;"></i>
            @endif

            {{-- "Dhisâ" permanen + nama desa sejajar di sampingnya --}}
            <span class="serif-title fw-bold" style="font-size:1.25rem;color:#fff;">Dhis&#xE2;</span>
            @if($navNamaDesa)
                <span class="serif-title" style="font-size:1.25rem;color:rgba(255,255,255,0.85);font-weight:700;">{{ $navNamaDesa }}</span>
            @endif
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center gap-2">
                <li class="nav-item"><a class="nav-link px-3 active rounded-pill" href="{{ route('home') }}">Beranda</a></li>
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle px-3 text-white" href="#" data-bs-toggle="dropdown">Profil Desa</a>
                    <ul class="dropdown-menu shadow border-0" style="background: var(--color-6);">
                        <li><a class="dropdown-item text-white hover-gold" href="{{ route('profil.desa') }}"><i class="fas fa-landmark me-2"></i> Profil & Sejarah</a></li>
                        <li><a class="dropdown-item text-white hover-gold" href="{{ route('struktur.organisasi') }}"><i class="fas fa-sitemap me-2"></i> Struktur Organisasi</a></li>
                        <li><a class="dropdown-item text-white hover-gold" href="{{ route('aset.desa') }}"><i class="fas fa-building me-2"></i> Aset Desa</a></li>
                        <li><hr class="dropdown-divider border-secondary opacity-25 my-1"></li>
                        <li><a class="dropdown-item text-white hover-gold" href="{{ route('informasi.publik') }}"><i class="fas fa-file-invoice me-2"></i> Informasi Publik</a></li>
                        <li><a class="dropdown-item text-white hover-gold" href="{{ route('arsip.artikel') }}"><i class="fas fa-archive me-2"></i> Publikasi Desa</a></li>
                        <li><a class="dropdown-item text-white hover-gold" href="{{ route('transparansi.anggaran') }}"><i class="fas fa-coins me-2"></i> Anggaran Desa</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle px-3 text-white" href="#" data-bs-toggle="dropdown">Statistik Desa</a>
                    <ul class="dropdown-menu shadow border-0" style="background: var(--color-6);">
                        <li><span class="dropdown-header text-white opacity-50" style="font-size:.65rem;letter-spacing:.8px;text-transform:uppercase;">Statistik</span></li>
                        <li><a class="dropdown-item text-white hover-gold" href="{{ route('stat.penduduk') }}"><i class="fas fa-user-friends me-2"></i> Statistik Penduduk</a></li>
                        <li><a class="dropdown-item text-white hover-gold" href="{{ route('stat.keluarga') }}"><i class="fas fa-users me-2"></i> Statistik Keluarga</a></li>
                        <li><a class="dropdown-item text-white hover-gold" href="{{ route('stat.fasilitas') }}"><i class="fas fa-building me-2"></i> Statistik Fasilitas Umum</a></li>
                        <li><hr class="dropdown-divider border-secondary opacity-25 my-1"></li>
                        <li><span class="dropdown-header text-white opacity-50" style="font-size:.65rem;letter-spacing:.8px;text-transform:uppercase;">Potensi Desa</span></li>
                        <li><a class="dropdown-item text-white hover-gold" href="{{ route('umkm.desa') }}"><i class="fas fa-store me-2"></i> UMKM Desa</a></li>
                        <li><a class="dropdown-item text-white hover-gold" href="{{ route('peta.desa') }}"><i class="fas fa-map-marked-alt me-2"></i> Peta Tematik</a></li>
                    </ul>
                </li>

                <li class="nav-item"><a class="nav-link px-3 text-white" href="{{ route('berita.desa') }}">Berita</a></li>
                <li class="nav-item"><a class="nav-link px-3 text-white" href="{{ route('galeri.desa') }}">Galeri</a></li>
                <li class="nav-item"><a class="nav-link px-3 text-white" href="{{ route('agenda.desa') }}">Agenda</a></li>
                <li class="nav-item"><a class="nav-link px-3 text-white" href="{{ route('pengaduan.form') }}">Pengaduan</a></li>
            </ul>
        </div>
    </div>
</nav>

<style>

    .navbar-dark .navbar-nav .nav-link:hover { color: var(--gold) !important; }
    .navbar-dark .navbar-nav .active { background-color: rgba(255,255,255,0.1); color: #fff !important; }
    
    .dropdown-item:hover { background-color: rgba(255,255,255,0.1) !important; }
    .dropdown-item i { color: var(--gold); }
    .op-7 { opacity: 0.7; }
</style>