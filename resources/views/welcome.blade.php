@extends('layouts.app')

@push('styles')
<style>
/* ============================================================
   HERO
   ============================================================ */
.hero-section {
    position: relative;
    min-height: 88vh;
    display: flex; align-items: center;
    background:
        linear-gradient(135deg, rgba(30,90,82,.72) 0%, rgba(58,154,140,.55) 100%),
        var(--hero-bg-url, url('https://images.unsplash.com/photo-1500382017468-9049fed747ef?auto=format&fit=crop&w=1600&q=80'))
        center/cover no-repeat;
    color: white;
    overflow: hidden;
}
.hero-section::after {
    content: '';
    position: absolute; bottom: 0; left: 0; right: 0;
    height: 90px;
    background: linear-gradient(to top, #f8f9fa 0%, transparent 100%);
    pointer-events: none;
}
.hero-badge {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(255,255,255,.18);
    backdrop-filter: blur(6px);
    border: 1px solid rgba(255,255,255,.3);
    border-radius: 50px; padding: 6px 18px;
    font-size: .8rem; font-weight: 600; letter-spacing: .5px;
    margin-bottom: 18px;
}
.hero-title {
    font-size: clamp(2rem, 5vw, 3.5rem);
    font-weight: 800; line-height: 1.15;
    text-shadow: 0 2px 20px rgba(0,0,0,.2);
    margin-bottom: 16px;
}
.hero-subtitle {
    font-size: 1.1rem; opacity: .88; line-height: 1.7;
    max-width: 520px; margin-bottom: 32px;
}
.hero-cta-primary {
    background: white; color: var(--color-7);
    border: none; border-radius: 50px;
    padding: 12px 28px; font-weight: 700; font-size: .9rem;
    text-decoration: none; display: inline-flex; align-items: center; gap: 8px;
    transition: .2s; box-shadow: 0 4px 16px rgba(0,0,0,.15);
}
.hero-cta-primary:hover { background: var(--color-1); color: var(--color-7); transform: translateY(-2px); }
.hero-cta-secondary {
    border: 2px solid rgba(255,255,255,.7); color: white;
    border-radius: 50px;
    padding: 12px 28px; font-weight: 700; font-size: .9rem;
    text-decoration: none; display: inline-flex; align-items: center; gap: 8px;
    transition: .2s;
}
.hero-cta-secondary:hover { background: rgba(255,255,255,.15); color: white; }

/* ============================================================
   STATS STRIP
   ============================================================ */
.stat-strip {
    background: white;
    border-radius: 20px;
    box-shadow: 0 12px 40px rgba(0,0,0,.1);
    padding: 28px 10px;
    margin-top: -50px;
    position: relative; z-index: 10;
}
.stat-item { text-align: center; padding: 0 12px; }
.stat-item .icon {
    width: 46px; height: 46px; border-radius: 12px;
    background: var(--color-1); color: var(--color-5);
    display: flex; align-items: center; justify-content: center;
    font-size: 1.1rem; margin: 0 auto 8px;
}
.stat-item .val {
    font-size: 1.6rem; font-weight: 800;
    color: var(--color-7); line-height: 1;
}
.stat-item .lbl { font-size: .72rem; color: #6c757d; margin-top: 4px; }
.stat-divider { width: 1px; background: var(--color-2); }

/* ============================================================
   QUICK ACTIONS
   ============================================================ */
.qa-card {
    background: white; border-radius: 16px;
    border: 2px solid var(--color-2);
    padding: 24px 20px; text-align: center;
    text-decoration: none; display: block;
    transition: .25s;
}
.qa-card:hover {
    border-color: var(--color-5);
    box-shadow: 0 10px 30px rgba(58,154,140,.15);
    transform: translateY(-4px);
}
.qa-icon {
    width: 58px; height: 58px; border-radius: 16px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.4rem; margin: 0 auto 12px;
}
.qa-title { font-size: .9rem; font-weight: 700; color: var(--color-7); margin-bottom: 4px; }
.qa-desc  { font-size: .75rem; color: #6c757d; line-height: 1.4; margin: 0; }

/* ============================================================
   SECTION LABELS
   ============================================================ */
.section-label {
    display: inline-flex; align-items: center; gap: 8px;
    font-size: .7rem; font-weight: 700; text-transform: uppercase;
    letter-spacing: 1px; color: var(--color-5);
    background: var(--color-1); border-radius: 50px;
    padding: 4px 14px; margin-bottom: 10px;
}
.section-title {
    font-size: 1.6rem; font-weight: 800; color: var(--color-7);
    line-height: 1.3; margin-bottom: 6px;
}
.section-sub { font-size: .88rem; color: #6c757d; }

/* ============================================================
   SAMBUTAN KADES
   ============================================================ */
.kades-img {
    width: 260px; height: 260px; object-fit: cover;
    border-radius: 50%; border: 6px solid white;
    box-shadow: 0 12px 40px rgba(30,90,82,.2);
}
.kades-quote {
    border-left: 4px solid var(--color-5);
    padding: 14px 18px; background: var(--color-1);
    border-radius: 0 12px 12px 0;
    font-style: italic; color: var(--color-7);
    font-size: .93rem; line-height: 1.7;
    margin: 16px 0 20px;
}
.value-chip {
    display: inline-flex; align-items: center; gap: 8px;
    background: var(--color-1); border-radius: 10px;
    padding: 10px 14px; font-size: .82rem; font-weight: 600;
    color: var(--color-7);
}
.value-chip i { color: var(--color-5); }

/* ============================================================
   LAYANAN CARDS
   ============================================================ */
.layanan-highlight {
    background: white; border-radius: 16px;
    border: 1px solid var(--color-2);
    padding: 22px 18px; text-align: center;
    text-decoration: none; display: block;
    transition: .25s;
}
.layanan-highlight:hover {
    border-color: var(--color-4);
    box-shadow: 0 8px 24px rgba(58,154,140,.12);
    transform: translateY(-3px);
}
.lh-icon {
    width: 54px; height: 54px; border-radius: 14px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.3rem; margin: 0 auto 12px;
}
.lh-title { font-size: .86rem; font-weight: 700; color: var(--color-7); margin-bottom: 4px; }
.lh-desc  { font-size: .72rem; color: #6c757d; line-height: 1.4; margin: 0; }
.lh-arrow { font-size: .7rem; color: var(--color-5); font-weight: 700; margin-top: 10px; display: block; }

/* ============================================================
   BERITA
   ============================================================ */
.berita-card {
    border-radius: 14px; overflow: hidden;
    border: 1px solid var(--color-2); background: white;
    transition: .25s; text-decoration: none; display: block;
}
.berita-card:hover { transform: translateY(-3px); box-shadow: 0 10px 28px rgba(58,154,140,.13); border-color: var(--color-4); }
.berita-card .thumb { height: 180px; overflow: hidden; background: var(--color-1); display:flex; align-items:center; justify-content:center; }
.berita-card .thumb img { width:100%; height:100%; object-fit:cover; transition:.3s; }
.berita-card:hover .thumb img { transform: scale(1.05); }
.berita-card .body { padding: 14px 16px; }
.berita-kat { font-size:.65rem; font-weight:700; text-transform:uppercase; padding:3px 10px; border-radius:20px; background:var(--color-1); color:var(--color-6); display:inline-block; margin-bottom:6px; }
.berita-judul { font-size:.88rem; font-weight:700; color:var(--color-7); line-height:1.4; margin-bottom:6px; }
.berita-meta { font-size:.72rem; color:#adb5bd; }

/* ============================================================
   AGENDA
   ============================================================ */
.agenda-item {
    display: flex; gap: 14px; padding: 14px 0;
    border-bottom: 1px solid var(--color-2);
}
.agenda-item:last-child { border-bottom: none; }
.agenda-date {
    min-width: 50px; text-align: center;
    background: var(--color-1); border-radius: 10px;
    padding: 8px 6px; flex-shrink: 0;
}
.agenda-date .day  { font-size: 1.3rem; font-weight: 800; color: var(--color-6); line-height: 1; }
.agenda-date .mon  { font-size: .6rem; color: var(--color-5); text-transform: uppercase; font-weight: 700; }
.agenda-judul { font-size: .85rem; font-weight: 700; color: var(--color-7); margin-bottom: 3px; }
.agenda-meta  { font-size: .72rem; color: #adb5bd; }

/* ============================================================
   UMKM
   ============================================================ */
.umkm-card {
    border-radius: 14px; overflow: hidden; background: white;
    border: 1px solid var(--color-2);
    transition: .25s;
}
.umkm-card:hover { transform: translateY(-3px); box-shadow: 0 10px 28px rgba(0,0,0,.1); }
.umkm-card .thumb { height: 190px; overflow: hidden; }
.umkm-card .thumb img { width:100%; height:100%; object-fit:cover; transition:.3s; }
.umkm-card:hover .thumb img { transform: scale(1.05); }
.umkm-kat  { font-size:.65rem; font-weight:700; text-transform:uppercase; padding:3px 10px; border-radius:20px; background:var(--color-1); color:var(--color-6); display:inline-block; margin-bottom:6px; }
.umkm-nama { font-size:.9rem; font-weight:700; color:var(--color-7); margin-bottom:4px; }
.umkm-meta { font-size:.75rem; color:#6c757d; }

/* ============================================================
   TRANSPARANSI PREVIEW
   ============================================================ */
.apb-bar-wrap { margin-bottom: 14px; }
.apb-bar-label { font-size: .8rem; font-weight: 600; color: var(--color-7); margin-bottom: 4px; display: flex; justify-content: space-between; }
.apb-bar-track { height: 8px; border-radius: 10px; background: var(--color-2); overflow: hidden; }
.apb-bar-fill  { height: 100%; border-radius: 10px; }

/* ============================================================
   DARURAT
   ============================================================ */
.darurat-card {
    background: white; border-radius: 14px;
    border: 1px solid var(--color-2);
    padding: 20px 16px; text-align: center;
    text-decoration: none; display: block; transition: .2s;
}
.darurat-card:hover { transform: translateY(-3px); box-shadow: 0 8px 24px rgba(0,0,0,.1); }
.darurat-num { font-size: 1.4rem; font-weight: 800; margin-top: 6px; }

/* ============================================================
   HELPERS
   ============================================================ */
.wave-sep svg { display: block; width: 100%; }

/* Tooltip nama dusun di peta mini beranda */
.dusun-tooltip-mini {
    background: rgba(30,90,82,.85) !important;
    border: none !important;
    color: #fff !important;
    font-size: .7rem !important;
    font-weight: 700 !important;
    padding: 3px 8px !important;
    border-radius: 6px !important;
    box-shadow: 0 1px 5px rgba(0,0,0,.2) !important;
}
.dusun-tooltip-mini::before { display: none !important; }
</style>
@endpush

@section('content')

{{-- ===============================================================
     HERO
     =============================================================== --}}
@php
    $heroBg    = $kontak['hero_bg_foto'] ?? '';
    $heroBadge = $kontak['hero_badge']   ?? 'Kec. Kamal · Kab. Bangkalan · Madura';
    $heroJudul = $kontak['hero_judul']   ?? 'Desa Tajungan';
    $heroDesc  = $kontak['hero_deskripsi'] ?? 'Desa Cantik (Cinta Statistik) — mewujudkan pemerintahan yang transparan, digital, dan berpihak pada warga.';
@endphp
<section class="hero-section" @if($heroBg) style="--hero-bg-url: url('{{ asset('storage/'.$heroBg) }}')" @endif>
    <div class="container py-5" style="position:relative;z-index:1;">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="hero-badge">
                    <i class="fas fa-map-marker-alt"></i>
                    {{ $heroBadge }}
                </div>
                <h1 class="hero-title">
                    Selamat Datang di<br>
                    <span style="color:var(--gold,#f9d923);">{{ $heroJudul }}</span>
                </h1>
                <p class="hero-subtitle">
                    {{ $heroDesc }}
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('profil.desa') }}" class="hero-cta-primary">
                        <i class="fas fa-landmark"></i>Profil Desa
                    </a>
                    <a href="{{ route('layanan.desa') }}" class="hero-cta-secondary">
                        <i class="fas fa-headset"></i>Info Layanan
                    </a>
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-block text-center">
                {{-- Floating stat cards --}}
                <div class="d-flex flex-column gap-3 ps-4">
                    @foreach([['fa-users','2.450','Jiwa','Jumlah Penduduk'],['fa-home','650','KK','Kepala Keluarga'],['fa-store','45','+','UMKM Aktif']] as [$ic,$val,$sat,$lbl])
                    <div class="d-flex align-items-center gap-3 px-4 py-3 rounded-3"
                         style="background:rgba(255,255,255,.14);backdrop-filter:blur(8px);border:1px solid rgba(255,255,255,.2);">
                        <div style="width:42px;height:42px;border-radius:10px;background:rgba(255,255,255,.2);display:flex;align-items:center;justify-content:center;">
                            <i class="fas {{ $ic }}" style="color:white;font-size:1.1rem;"></i>
                        </div>
                        <div>
                            <div style="font-size:1.3rem;font-weight:800;line-height:1;">{{ $val }}<span style="font-size:.75rem;font-weight:400;margin-left:2px;">{{ $sat }}</span></div>
                            <div style="font-size:.72rem;opacity:.8;">{{ $lbl }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===============================================================
     STATS STRIP
     =============================================================== --}}
<section class="py-4 bg-light">
    <div class="container">
        <div class="stat-strip">
            <div class="row g-0 align-items-center">
                @php $stats = [
                    ['fa-users',          '2.450', 'Jiwa', 'Total Penduduk'],
                    ['fa-ruler-combined', '145',   'Ha',   'Luas Wilayah'],
                    ['fa-map-signs',      '12/4',  '',     'RT / RW'],
                    ['fa-store',          '45',    '+',    'UMKM'],
                    ['fa-calendar-check', '1945',  '',     'Tahun Berdiri'],
                ]; @endphp
                @foreach($stats as $i => [$ic, $val, $sat, $lbl])
                <div class="col">
                    <div class="stat-item">
                        <div class="icon"><i class="fas {{ $ic }}"></i></div>
                        <div class="val">{{ $val }}<span style="font-size:.65rem;font-weight:400;color:#888;"> {{ $sat }}</span></div>
                        <div class="lbl">{{ $lbl }}</div>
                    </div>
                </div>
                @if($i < count($stats)-1)
                <div class="col-auto d-none d-md-block" style="padding:0;"><div class="stat-divider" style="height:60px;"></div></div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ===============================================================
     QUICK ACTIONS
     =============================================================== --}}
<section class="py-5" style="background: var(--color-1);">
    <div class="container">
        <div class="text-center mb-4">
            <span class="section-label"><i class="fas fa-bolt"></i>Akses Cepat</span>
            <h2 class="section-title">Ada yang Bisa Kami Bantu?</h2>
            <p class="section-sub">Akses layanan desa langsung dari sini</p>
        </div>
        <div class="row g-3 justify-content-center">
            <div class="col-md-3 col-6">
                <a href="{{ route('layanan.desa') }}" class="qa-card">
                    <div class="qa-icon" style="background:#E8F5F0;"><i class="fas fa-headset" style="color:#1E5A52;"></i></div>
                    <div class="qa-title">Info Layanan</div>
                    <p class="qa-desc">Syarat & prosedur layanan administrasi desa</p>
                </a>
            </div>
            <div class="col-md-3 col-6">
                <a href="{{ route('pengaduan.form') }}" class="qa-card">
                    <div class="qa-icon" style="background:#e8f0fe;"><i class="fas fa-comment-dots" style="color:#0d6efd;"></i></div>
                    <div class="qa-title">Laporan Warga</div>
                    <p class="qa-desc">Sampaikan pengaduan atau aspirasi Anda</p>
                </a>
            </div>
            <div class="col-md-3 col-6">
                <a href="{{ route('agenda.desa') }}" class="qa-card">
                    <div class="qa-icon" style="background:#fff3e0;"><i class="fas fa-calendar-check" style="color:#fd7e14;"></i></div>
                    <div class="qa-title">Jadwal Kegiatan</div>
                    <p class="qa-desc">Kalender kegiatan dan acara desa terkini</p>
                </a>
            </div>
            <div class="col-md-3 col-6">
                <a href="{{ route('transparansi.anggaran') }}" class="qa-card">
                    <div class="qa-icon" style="background:#e8f5e9;"><i class="fas fa-chart-pie" style="color:#198754;"></i></div>
                    <div class="qa-title">Transparansi</div>
                    <p class="qa-desc">Laporan APBDes dan keuangan desa</p>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ===============================================================
     SAMBUTAN KADES
     =============================================================== --}}
<section class="py-5 bg-white">
    <div class="container py-2">
        <div class="row align-items-center g-5">
            <div class="col-lg-4 text-center">
                @if($kades?->image)
                    <img src="{{ asset("storage/{$kades->image}") }}" class="kades-img" alt="Kepala Desa">
                @else
                    <img src="{{ asset('img/desa cantik.png') }}" class="kades-img" alt="Kepala Desa"
                         onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
                    <div style="display:none;width:260px;height:260px;border-radius:50%;background:var(--color-1);border:6px solid white;box-shadow:0 12px 40px rgba(30,90,82,.2);margin:0 auto;align-items:center;justify-content:center;">
                        <i class="fas fa-user fa-5x" style="color:var(--color-4);"></i>
                    </div>
                @endif
                <div class="mt-3">
                    <div class="fw-bold" style="color:var(--color-7);font-size:.95rem;">{{ $kades->title ?? 'H. Ahmad Fauzi, S.Sos' }}</div>
                    <div class="text-muted" style="font-size:.78rem;">{{ $kades->body ?? 'Kepala Desa Tajungan' }}</div>
                </div>
            </div>
            <div class="col-lg-8">
                <span class="section-label"><i class="fas fa-user-tie"></i>Sambutan</span>
                <h2 class="section-title">Sambutan Kepala Desa</h2>
                <div class="kades-quote">
                    "{{ $kades->excerpt ?? 'Mewujudkan Desa Tajungan yang transparan dan berbasis digital melalui program Desa Cantik (Cinta Statistik). Kami berkomitmen melayani warga dengan data yang akurat dan pelayanan yang tulus.' }}"
                </div>
                <div class="row g-3 mb-4">
                    @foreach([
                        ['fa-chart-line', 'Data Akurat',     'Pengelolaan data berbasis statistik'],
                        ['fa-shield-alt', 'Transparansi',    'Anggaran terbuka untuk semua warga'],
                        ['fa-hands-helping','Gotong Royong',  'Bersama membangun desa'],
                        ['fa-seedling',  'Berkelanjutan',    'Program jangka panjang terencana'],
                    ] as [$ic, $title, $desc])
                    <div class="col-sm-6">
                        <div class="value-chip gap-3 w-100">
                            <i class="fas {{ $ic }}"></i>
                            <div>
                                <div style="font-size:.8rem;font-weight:700;color:var(--color-7);">{{ $title }}</div>
                                <div style="font-size:.7rem;color:#6c757d;font-weight:400;">{{ $desc }}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <a href="{{ route('profil.desa') }}" style="background:var(--color-5);color:white;border:none;border-radius:50px;padding:10px 24px;font-weight:700;font-size:.85rem;text-decoration:none;display:inline-flex;align-items:center;gap:8px;">
                    <i class="fas fa-arrow-right"></i>Selengkapnya
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ===============================================================
     LAYANAN HIGHLIGHTS
     =============================================================== --}}
<section class="py-5" style="background: var(--color-7);">
    <div class="container">
        <div class="text-center mb-4">
            <span class="section-label" style="background:rgba(255,255,255,.1);color:rgba(255,255,255,.8);">
                <i class="fas fa-concierge-bell"></i>Layanan Desa
            </span>
            <h2 class="section-title text-white">Layanan Administrasi Desa</h2>
            <p class="section-sub" style="color:rgba(255,255,255,.65);">Urus dokumen dan keperluan administrasi dengan mudah</p>
        </div>
        <div class="row g-3">
            @foreach([
                ['fa-id-card',           '#cfe2ff','#0d6efd', 'Administrasi',   'KTP, KK, Akta, Surat Domisili'],
                ['fa-file-alt',          '#d1e7dd','#198754', 'Keterangan',     'SKTM, SKU, SKP, Keterangan Warga'],
                ['fa-stamp',             '#fff3cd','#856404', 'Perizinan',      'IMB, Izin Usaha, Izin Keramaian'],
                ['fa-hand-holding-heart','#f8d7da','#842029', 'Bantuan Sosial', 'PKH, BPNT, BLT Dana Desa'],
            ] as [$ic, $bg, $col, $title, $desc])
            <div class="col-md-6 col-lg-3">
                <a href="{{ route('layanan.desa') }}" class="layanan-highlight">
                    <div class="lh-icon" style="background:{{ $bg }};"><i class="fas {{ $ic }}" style="color:{{ $col }};"></i></div>
                    <div class="lh-title">{{ $title }}</div>
                    <p class="lh-desc">{{ $desc }}</p>
                    <span class="lh-arrow"><i class="fas fa-arrow-right me-1"></i>Lihat layanan</span>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===============================================================
     BERITA + AGENDA
     =============================================================== --}}
<section class="py-5 bg-light">
    <div class="container">
        <div class="row g-4">

            {{-- Berita --}}
            <div class="col-lg-8">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div>
                        <span class="section-label" style="margin-bottom:6px;"><i class="fas fa-newspaper"></i>Berita</span>
                        <h3 class="section-title mb-0" style="font-size:1.3rem;">Berita Terkini</h3>
                    </div>
                    <a href="{{ route('berita.desa') }}" style="font-size:.82rem;font-weight:700;color:var(--color-5);text-decoration:none;">
                        Lihat Semua <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
                <div class="row g-3">
                    @forelse($berita_terkini as $idx => $berita)
                    @php
                        $bSrc = $berita->foto
                            ? (Str::startsWith($berita->foto, ['http://','https://']) ? $berita->foto : asset("storage/{$berita->foto}"))
                            : null;
                    @endphp
                    @if($idx === 0)
                    {{-- Featured berita --}}
                    <div class="col-12">
                        <a href="{{ route('berita.detail', $berita->slug) }}" class="berita-card d-flex flex-column flex-md-row" style="border-radius:16px;">
                            <div style="width:100%;max-width:280px;height:185px;overflow:hidden;flex-shrink:0;border-radius:14px 0 0 14px;background:var(--color-1);display:flex;align-items:center;justify-content:center;">
                                @if($bSrc)
                                    <img src="{{ $bSrc }}" alt="{{ $berita->judul }}" style="width:100%;height:100%;object-fit:cover;">
                                @else
                                    <i class="fas fa-newspaper fa-3x" style="color:var(--color-3);"></i>
                                @endif
                            </div>
                            <div class="body p-4 d-flex flex-column justify-content-center">
                                <span class="berita-kat">{{ $berita->kategori }}</span>
                                <div class="berita-judul" style="font-size:1rem;">{{ $berita->judul }}</div>
                                <p class="berita-meta mb-2">{{ Str::limit($berita->ringkasan ?: strip_tags($berita->isi), 100) }}</p>
                                <div class="berita-meta"><i class="fas fa-calendar-alt me-1"></i>{{ $berita->published_at?->format('d M Y') }}</div>
                            </div>
                        </a>
                    </div>
                    @else
                    <div class="col-md-6">
                        <a href="{{ route('berita.detail', $berita->slug) }}" class="berita-card h-100">
                            <div class="thumb">
                                @if($bSrc)
                                    <img src="{{ $bSrc }}" alt="{{ $berita->judul }}" loading="lazy">
                                @else
                                    <i class="fas fa-newspaper fa-3x" style="color:var(--color-3);"></i>
                                @endif
                            </div>
                            <div class="body">
                                <span class="berita-kat">{{ $berita->kategori }}</span>
                                <div class="berita-judul">{{ Str::limit($berita->judul, 65) }}</div>
                                <div class="berita-meta"><i class="fas fa-calendar-alt me-1"></i>{{ $berita->published_at?->format('d M Y') }}</div>
                            </div>
                        </a>
                    </div>
                    @endif
                    @empty
                    <div class="col-12 text-center py-5" style="color:#adb5bd;">
                        <i class="fas fa-newspaper fa-3x mb-2 opacity-25 d-block"></i>
                        <p class="small mb-0">Belum ada berita.</p>
                    </div>
                    @endforelse
                </div>
            </div>

            {{-- Agenda --}}
            <div class="col-lg-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div>
                        <span class="section-label" style="margin-bottom:6px;"><i class="fas fa-calendar-alt"></i>Agenda</span>
                        <h3 class="section-title mb-0" style="font-size:1.3rem;">Kegiatan Mendatang</h3>
                    </div>
                    <a href="{{ route('agenda.desa') }}" style="font-size:.82rem;font-weight:700;color:var(--color-5);text-decoration:none;">
                        Semua <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
                <div class="card border-0 rounded-4 p-3" style="background:white;border:1px solid var(--color-2) !important;box-shadow:0 2px 12px rgba(0,0,0,.05);">
                    @forelse($agenda_terkini as $agenda)
                    <div class="agenda-item">
                        <div class="agenda-date">
                            <div class="day">{{ $agenda->tanggal->format('d') }}</div>
                            <div class="mon">{{ $agenda->tanggal->format('M') }}</div>
                        </div>
                        <div>
                            <div class="agenda-judul">{{ Str::limit($agenda->judul, 55) }}</div>
                            <div class="agenda-meta">
                                @if($agenda->lokasi)<i class="fas fa-map-marker-alt me-1"></i>{{ $agenda->lokasi }}<br>@endif
                                @if($agenda->waktu_mulai)<i class="fas fa-clock me-1"></i>{{ substr($agenda->waktu_mulai,0,5) }}@endif
                                @if($agenda->tanggal->isToday()) <span class="badge bg-warning text-dark ms-1" style="font-size:.6rem;">Hari ini</span>@endif
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-4" style="color:#adb5bd;">
                        <i class="fas fa-calendar-times fa-2x mb-2 opacity-25 d-block"></i>
                        <small>Tidak ada agenda mendatang.</small>
                    </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ===============================================================
     UMKM
     =============================================================== --}}
<section class="py-5 bg-white">
    <div class="container">
        <div class="d-flex align-items-end justify-content-between mb-4">
            <div>
                <span class="section-label"><i class="fas fa-store"></i>UMKM</span>
                <h2 class="section-title mb-0">UMKM Unggulan Desa</h2>
            </div>
            <a href="{{ route('umkm.desa') }}" style="font-size:.82rem;font-weight:700;color:var(--color-5);text-decoration:none;">
                Lihat Semua <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>
        <div class="row g-3">
            @forelse($semua_umkm->take(3) as $umkm)
            @php
                $uSrc = $umkm->foto
                    ? (Str::startsWith($umkm->foto, ['http://','https://']) ? $umkm->foto : asset("storage/{$umkm->foto}"))
                    : 'https://images.unsplash.com/photo-1558618047-3c8c76ca7d13?w=600&q=80';
            @endphp
            <div class="col-md-4">
                <div class="umkm-card">
                    <div class="thumb">
                        <img src="{{ $uSrc }}" alt="{{ $umkm->nama_usaha }}" loading="lazy">
                    </div>
                    <div class="p-3">
                        <span class="umkm-kat">{{ $umkm->kategori }}</span>
                        <div class="umkm-nama">{{ $umkm->nama_usaha }}</div>
                        <div class="umkm-meta mb-3">
                            <i class="fas fa-user me-1"></i>{{ $umkm->pemilik }}
                            <span class="ms-2"><i class="fas fa-map-marker-alt me-1"></i>Desa Tajungan</span>
                        </div>
                        <div class="d-flex gap-2">
                            @if($umkm->latitude && $umkm->longitude)
                            <a href="https://www.google.com/maps?q={{ $umkm->latitude }},{{ $umkm->longitude }}"
                               target="_blank"
                               class="btn btn-sm flex-fill rounded-pill"
                               style="border:1px solid var(--color-3);color:var(--color-6);font-size:.75rem;font-weight:600;">
                               <i class="fas fa-map-marker-alt me-1"></i>Peta
                            </a>
                            @endif
                            @if($umkm->no_hp)
                            <a href="https://wa.me/{{ $umkm->no_hp }}"
                               target="_blank"
                               class="btn btn-sm flex-fill rounded-pill"
                               style="background:#25D366;color:white;font-size:.75rem;font-weight:600;">
                               <i class="fab fa-whatsapp me-1"></i>WA
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-4" style="color:#adb5bd;">
                <i class="fas fa-store fa-3x mb-2 opacity-25 d-block"></i>
                <small>Belum ada data UMKM.</small>
            </div>
            @endforelse
        </div>
    </div>
</section>

{{-- ===============================================================
     TRANSPARANSI PREVIEW
     =============================================================== --}}
<section class="py-5" style="background:var(--color-1);">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-5">
                <span class="section-label"><i class="fas fa-chart-pie"></i>APBDes 2026</span>
                <h2 class="section-title">Transparansi Anggaran Desa</h2>
                <p class="section-sub mb-4">Desa Tajungan berkomitmen mengelola keuangan secara transparan dan akuntabel untuk kepentingan seluruh warga.</p>
                <div class="apb-bar-wrap">
                    <div class="apb-bar-label"><span>Bidang Pembangunan</span><span style="color:var(--color-5);">Rp 470 Jt</span></div>
                    <div class="apb-bar-track"><div class="apb-bar-fill" style="width:42%;background:var(--color-5);"></div></div>
                </div>
                <div class="apb-bar-wrap">
                    <div class="apb-bar-label"><span>Bidang Pemerintahan</span><span style="color:var(--color-6);">Rp 280 Jt</span></div>
                    <div class="apb-bar-track"><div class="apb-bar-fill" style="width:25%;background:var(--color-6);"></div></div>
                </div>
                <div class="apb-bar-wrap">
                    <div class="apb-bar-label"><span>Bidang Kemasyarakatan</span><span style="color:#0d6efd;">Rp 145 Jt</span></div>
                    <div class="apb-bar-track"><div class="apb-bar-fill" style="width:13%;background:#0d6efd;"></div></div>
                </div>
                <div class="apb-bar-wrap">
                    <div class="apb-bar-label"><span>Bidang Pemberdayaan</span><span style="color:#fd7e14;">Rp 65 Jt</span></div>
                    <div class="apb-bar-track"><div class="apb-bar-fill" style="width:6%;background:#fd7e14;"></div></div>
                </div>
                <a href="{{ route('transparansi.anggaran') }}"
                   style="display:inline-flex;align-items:center;gap:8px;background:var(--color-5);color:white;border:none;border-radius:50px;padding:10px 24px;font-weight:700;font-size:.85rem;text-decoration:none;margin-top:10px;">
                    <i class="fas fa-chart-pie"></i>Lihat Laporan Lengkap
                </a>
            </div>
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden p-3">
                    <canvas id="budgetChart" style="max-height:280px;"></canvas>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===============================================================
     PETA MINI
     =============================================================== --}}
<section class="py-5 bg-white">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-4">
                <span class="section-label"><i class="fas fa-map-marked-alt"></i>Lokasi</span>
                <h2 class="section-title">Letak Geografis Desa</h2>
                <p class="section-sub mb-4">Desa Tajungan terletak di pesisir barat Pulau Madura, Kecamatan Kamal, Kabupaten Bangkalan, dengan luas wilayah ± 145 Ha.</p>
                <div class="d-flex flex-column gap-2 mb-4">
                    @foreach([
                        ['arrow-up',    'Utara',   'Selat Madura'],
                        ['arrow-down',  'Selatan',  'Desa Gili Anyar'],
                        ['arrow-right', 'Timur',    'Desa Banyuajuh'],
                        ['arrow-left',  'Barat',    'Desa Kamal'],
                    ] as [$ic, $dir, $name])
                    <div class="d-flex align-items-center gap-3">
                        <div style="width:34px;height:34px;border-radius:9px;background:var(--color-1);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <i class="fas fa-{{ $ic }}" style="color:var(--color-5);font-size:.75rem;"></i>
                        </div>
                        <div>
                            <span style="font-size:.72rem;font-weight:700;color:#888;text-transform:uppercase;">{{ $dir }}</span>
                            <span class="ms-2" style="font-size:.84rem;color:var(--color-7);">{{ $name }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
                <a href="{{ route('peta.desa') }}"
                   style="display:inline-flex;align-items:center;gap:8px;background:var(--color-5);color:white;border:none;border-radius:50px;padding:10px 24px;font-weight:700;font-size:.85rem;text-decoration:none;">
                    <i class="fas fa-map-marked-alt"></i>Buka Peta Tematik
                </a>
            </div>
            <div class="col-lg-8">
                <div class="position-relative rounded-4 overflow-hidden shadow-sm" style="height:360px;border:1px solid var(--color-2);">
                    <div id="map-preview" style="height:100%;width:100%;"></div>
                    <a href="{{ route('peta.desa') }}"
                       class="position-absolute bottom-0 end-0 m-3 btn btn-sm rounded-pill shadow-sm"
                       style="z-index:500;background:white;color:var(--color-7);font-size:.75rem;font-weight:600;border:1px solid var(--color-2);">
                        <i class="fas fa-expand-arrows-alt me-1"></i>Peta Penuh
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===============================================================
     KONTAK DARURAT
     =============================================================== --}}
<section class="py-5" style="background:var(--color-7);">
    <div class="container">
        <div class="text-center mb-4">
            <span class="section-label" style="background:rgba(255,255,255,.12);color:rgba(255,255,255,.8);"><i class="fas fa-phone-alt"></i>Darurat</span>
            <h2 class="section-title text-white">Kontak Darurat</h2>
            <p class="section-sub" style="color:rgba(255,255,255,.6);">Butuh bantuan segera? Hubungi layanan darurat berikut</p>
        </div>
        <div class="row g-3 justify-content-center">
            @forelse($kontakDarurat as $kd)
            @php $href = 'tel:'.preg_replace('/[^0-9+]/','',$kd->nomor); @endphp
            <div class="col-6 col-md-3">
                <a href="{{ $href }}" class="darurat-card">
                    <div style="width:50px;height:50px;border-radius:14px;background:{{ $kd->warna_bg }};display:flex;align-items:center;justify-content:center;margin:0 auto;">
                        <i class="fas {{ $kd->icon }}" style="color:{{ $kd->warna_teks }};font-size:1.2rem;"></i>
                    </div>
                    <div class="darurat-num" style="color:{{ $kd->warna_teks }};">{{ $kd->nomor }}</div>
                    <div style="font-size:.78rem;font-weight:600;color:var(--color-7);">{{ $kd->nama }}</div>
                </a>
            </div>
            @empty
            <div class="col-12 text-center" style="color:rgba(255,255,255,.5);">
                <small>Belum ada kontak darurat.</small>
            </div>
            @endforelse
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
/* ===================== BUDGET CHART ===================== */
new Chart(document.getElementById('budgetChart').getContext('2d'), {
    type: 'doughnut',
    data: {
        labels: ['Pembangunan', 'Pemerintahan', 'Kemasyarakatan', 'Pemberdayaan', 'Tak Terduga'],
        datasets: [{
            data: [470, 280, 145, 65, 30],
            backgroundColor: ['#1E5A52','#3A9A8C','#5BBFAB','#fd7e14','#adb5bd'],
            borderWidth: 3, borderColor: '#fff'
        }]
    },
    options: {
        responsive: true, cutout: '62%',
        plugins: {
            legend: { position: 'bottom', labels: { font: { size: 11, family: 'Poppins' }, padding: 12 } },
            tooltip: {
                callbacks: {
                    label: ctx => ' Rp ' + ctx.raw.toLocaleString('id-ID') + ' Jt'
                }
            }
        }
    }
});

/* ===================== PETA MINI ===================== */
var map = L.map('map-preview', { zoomControl: true, scrollWheelZoom: false }).setView([-7.1544, 112.6961], 15);
var streetLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
    maxZoom: 19
});
var satelitLayer = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
    attribution: '© Esri World Imagery', maxZoom: 19
});
streetLayer.addTo(map);
L.control.layers({ 'Peta': streetLayer, 'Satelit': satelitLayer }, {}, { position: 'topright' }).addTo(map);

// Batas Desa dari database
var batasDesaData = @json($batasDesa);
if (batasDesaData && batasDesaData.koordinat && batasDesaData.koordinat.length >= 3) {
    var batasLayer = L.polygon(batasDesaData.koordinat, {
        color: batasDesaData.warna || '#1E5A52', weight: 3, opacity: 1,
        fillColor: batasDesaData.warna || '#3A9A8C', fillOpacity: 0.08, dashArray: '8,4'
    }).addTo(map);
    batasLayer.bindPopup('<b>Wilayah Desa Tajungan</b><br><small>Kec. Kamal, Kab. Bangkalan</small>');
    map.fitBounds(batasLayer.getBounds(), { padding: [20, 20] });
}

// Batas Dusun dari database
var batasDusunData = @json($batasDusun);
batasDusunData.forEach(function(d) {
    if (!d.koordinat || d.koordinat.length < 3) return;
    L.polygon(d.koordinat, {
        color: d.warna, weight: 2, opacity: .8,
        fillColor: d.warna, fillOpacity: .12
    }).bindTooltip('<b>' + d.nama_dusun + '</b>', {
        permanent: true, direction: 'center',
        className: 'dusun-tooltip-mini'
    }).addTo(map);
});

function makeIcon(color, icon) {
    return L.divIcon({
        className: '',
        html: '<div style="background:'+color+';width:32px;height:32px;border-radius:50% 50% 50% 0;transform:rotate(-45deg);border:3px solid white;box-shadow:0 2px 6px rgba(0,0,0,.3);display:flex;align-items:center;justify-content:center;"><i class="fas '+icon+'" style="transform:rotate(45deg);color:white;font-size:12px;"></i></div>',
        iconSize:[32,32], iconAnchor:[16,32], popupAnchor:[0,-34]
    });
}

var asetColorMap = { 'Tanah':'#198754','Bangunan':'#0d6efd','Infrastruktur':'#20c997','Kendaraan':'#fd7e14','Peralatan & Mesin':'#6f42c1' };
var asetIconMap  = { 'Tanah':'fa-map','Bangunan':'fa-building','Infrastruktur':'fa-road','Kendaraan':'fa-motorcycle','Peralatan & Mesin':'fa-tools' };
var asetsMini = @json($asets);
asetsMini.forEach(function(a) {
    var c  = asetColorMap[a.jenis]  || '#6c757d';
    var ic = asetIconMap[a.jenis]   || 'fa-box';
    L.marker([a.latitude, a.longitude], { icon: makeIcon(c, ic) })
     .addTo(map)
     .bindPopup('<b style="color:'+c+'">'+a.nama+'</b><br><small>'+a.jenis+' · '+a.kondisi+'</small>', { maxWidth: 180 });
});
map.on('click', function() { map.scrollWheelZoom.enable(); });
</script>
@endpush
