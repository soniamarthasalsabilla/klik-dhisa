@extends('layouts.app')

@push('styles')
<style>
    .layanan-card {
        border-radius: 14px;
        border: 1px solid var(--color-2);
        transition: .25s;
        cursor: pointer;
        background: white;
    }
    .layanan-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 30px rgba(58,154,140,.15) !important;
        border-color: var(--color-4);
    }
    .layanan-icon {
        width: 56px; height: 56px;
        border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.3rem;
        flex-shrink: 0;
    }
    .step-number {
        width: 36px; height: 36px;
        border-radius: 50%;
        background: var(--color-5);
        color: white;
        font-weight: 700;
        display: flex; align-items: center; justify-content: center;
        font-size: .9rem;
        flex-shrink: 0;
    }
    .kat-badge {
        display: inline-block;
        padding: 3px 10px;
        border-radius: 20px;
        font-size: .67rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .5px;
    }

    /* Modal */
    .modal-header { background: var(--color-7); color: white; }
    .modal-header .btn-close { filter: invert(1); }
    .syarat-list li { padding: 4px 0; font-size: .88rem; }
    .syarat-list li::marker { color: var(--color-5); }
</style>
@endpush

@section('content')

{{-- Hero --}}
<section class="py-3" style="background: white; border-bottom: 3px solid var(--color-5);">
    <div class="container text-center py-4">
        <h2 class="fw-bold mb-2" style="color: var(--color-7); font-size: 2rem;">
            <i class="fas fa-headset me-2" style="color:var(--color-5);"></i>Layanan Desa Digital
        </h2>
        <p class="mb-0" style="color: var(--color-6); font-size: 1rem;">Layanan administrasi dan sosial warga Desa Tajungan</p>
    </div>
</section>

{{-- Prosedur Pengajuan --}}
<section class="py-4" style="background: var(--color-7);">
    <div class="container">
        <h6 class="text-center text-white fw-bold mb-4" style="letter-spacing:1px;text-transform:uppercase;font-size:.78rem;opacity:.8;">
            <i class="fas fa-route me-2"></i>Prosedur Pengajuan Layanan
        </h6>
        <div class="row g-3 justify-content-center text-center">
            @foreach([
                ['1', 'fa-user-check',     'Siapkan Syarat',      'Siapkan dokumen sesuai layanan yang dibutuhkan'],
                ['2', 'fa-map-marker-alt', 'Ke RT / RW',          'Minta surat pengantar dari Ketua RT dan RW setempat'],
                ['3', 'fa-landmark',       'Datang ke Kantor Desa','Kunjungi kantor desa pada jam kerja dengan membawa semua dokumen'],
                ['4', 'fa-file-signature', 'Proses Surat',        'Petugas memproses dan menandatangani surat, selesai hari itu'],
            ] as [$n, $ic, $title, $desc])
            <div class="col-md-3 col-6">
                <div class="d-flex flex-column align-items-center gap-2">
                    <div class="step-number">{{ $n }}</div>
                    <i class="fas {{ $ic }}" style="color:var(--gold);font-size:1.4rem;"></i>
                    <div class="fw-bold text-white" style="font-size:.85rem;">{{ $title }}</div>
                    <div style="font-size:.73rem;color:rgba(255,255,255,.6);line-height:1.4;">{{ $desc }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Info Jam Kerja --}}
<section class="py-3" style="background: var(--color-1);">
    <div class="container">
        <div class="row g-3 justify-content-center text-center">
            <div class="col-md-4 col-12">
                <i class="fas fa-clock me-2" style="color:var(--color-5);"></i>
                <strong style="color:var(--color-7);">Jam Layanan:</strong>
                <span style="color:var(--color-6);font-size:.9rem;"> Senin – Jumat, 08.00 – 15.00 WIB</span>
            </div>
            <div class="col-md-4 col-12">
                <i class="fas fa-phone-alt me-2" style="color:var(--color-5);"></i>
                <strong style="color:var(--color-7);">Telepon:</strong>
                <span style="color:var(--color-6);font-size:.9rem;"> (031) 3014567</span>
            </div>
            <div class="col-md-4 col-12">
                <i class="fas fa-map-marker-alt me-2" style="color:var(--color-5);"></i>
                <strong style="color:var(--color-7);">Lokasi:</strong>
                <span style="color:var(--color-6);font-size:.9rem;"> Jl. Raya Tajungan, Kec. Kamal</span>
            </div>
        </div>
    </div>
</section>

{{-- Daftar Layanan per Kategori --}}
<section class="py-5 bg-light">
    <div class="container">

        @php
        $katConfig = [
            'Administrasi'       => ['icon' => 'fa-id-card',          'color' => '#0d6efd', 'bg' => '#e8f0fe'],
            'Keterangan'         => ['icon' => 'fa-file-alt',          'color' => '#198754', 'bg' => '#e8f5e9'],
            'Perizinan'          => ['icon' => 'fa-stamp',             'color' => '#fd7e14', 'bg' => '#fff3e0'],
            'Pemutakhiran DTSEN' => ['icon' => 'fa-database',          'color' => '#6f42c1', 'bg' => '#f0ebff'],
        ];
        @endphp

        @forelse($items as $kategori => $layananList)
        @php $cfg = $katConfig[$kategori] ?? ['icon'=>'fa-cogs','color'=>'#6c757d','bg'=>'#f8f9fa']; @endphp

        <div class="mb-5">
            {{-- Kategori Header --}}
            <div class="d-flex align-items-center gap-3 mb-3">
                <div class="layanan-icon" style="background:{{ $cfg['bg'] }};">
                    <i class="fas {{ $cfg['icon'] }}" style="color:{{ $cfg['color'] }};"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-0" style="color:var(--color-7);">{{ $kategori }}</h5>
                    <small class="text-muted">{{ $layananList->count() }} jenis layanan</small>
                </div>
            </div>

            {{-- Kartu Layanan --}}
            <div class="row g-3">
                @foreach($layananList as $item)
                <div class="col-md-6 col-lg-4">
                    <div class="layanan-card p-4 h-100 d-flex flex-column shadow-sm"
                         data-bs-toggle="modal" data-bs-target="#modal-{{ $item->id }}">
                        <div class="d-flex align-items-start gap-3 mb-3">
                            <div class="layanan-icon flex-shrink-0" style="background:{{ $cfg['bg'] }};width:44px;height:44px;border-radius:10px;font-size:1rem;">
                                <i class="fas {{ $cfg['icon'] }}" style="color:{{ $cfg['color'] }};"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1" style="color:var(--color-7);font-size:.9rem;">{{ $item->title }}</h6>
                                <span class="kat-badge" style="background:{{ $cfg['bg'] }};color:{{ $cfg['color'] }};">{{ $kategori }}</span>
                            </div>
                        </div>
                        <p class="text-muted small mb-3 flex-grow-1" style="font-size:.8rem;line-height:1.5;">
                            {{ $item->excerpt }}
                        </p>
                        <div class="d-flex align-items-center justify-content-between mt-auto flex-wrap gap-2">
                            <div class="d-flex align-items-center gap-1" style="color:var(--color-5);font-size:.78rem;font-weight:600;">
                                <i class="fas fa-info-circle"></i>
                                <span>Lihat syarat &amp; prosedur</span>
                            </div>
                            <a href="https://forms.gle/6yRkiPhwBz3dVktG6" target="_blank"
                               class="btn btn-sm rounded-pill fw-bold px-3"
                               style="background:var(--color-5);color:white;font-size:.72rem;"
                               onclick="event.stopPropagation();">
                                <i class="fas fa-file-signature me-1"></i>Ajukan Surat
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
        @empty
        <div class="text-center py-5">
            <i class="fas fa-tools fa-3x mb-3" style="color:var(--color-3);"></i>
            <p class="text-muted">Belum ada layanan yang tersedia. Hubungi kantor desa untuk informasi lebih lanjut.</p>
        </div>
        @endforelse

        {{-- CTA Pengaduan --}}
        <div class="card border-0 rounded-4 mt-3" style="background: linear-gradient(135deg, var(--color-7), var(--color-6));">
            <div class="card-body p-4 d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">
                <div class="text-white">
                    <h5 class="fw-bold mb-1"><i class="fas fa-comment-dots me-2" style="color:var(--gold);"></i>Butuh Bantuan Lainnya?</h5>
                    <p class="mb-0 opacity-75" style="font-size:.88rem;">Tidak menemukan layanan yang dicari? Sampaikan langsung melalui form pengaduan atau kunjungi kantor desa.</p>
                </div>
                <div class="d-flex gap-2 flex-shrink-0">
                    <a href="{{ route('pengaduan.form') }}" class="btn rounded-pill fw-bold px-4" style="background:var(--gold);color:var(--color-7);">
                        <i class="fas fa-paper-plane me-1"></i>Kirim Pengaduan
                    </a>
                </div>
            </div>
        </div>

    </div>
</section>

{{-- ============================================================
     SEMUA MODAL DI LUAR <section>
     Mencegah z-index stacking context dari "section { z-index:1 }"
     di app.blade.php yang membuat backdrop menimpa tombol modal.
     ============================================================ --}}
@php
$katConfig2 = [
    'Administrasi'       => ['icon' => 'fa-id-card', 'color' => '#0d6efd', 'bg' => '#e8f0fe'],
    'Keterangan'         => ['icon' => 'fa-file-alt', 'color' => '#198754', 'bg' => '#e8f5e9'],
    'Perizinan'          => ['icon' => 'fa-stamp',    'color' => '#fd7e14', 'bg' => '#fff3e0'],
    'Pemutakhiran DTSEN' => ['icon' => 'fa-database', 'color' => '#6f42c1', 'bg' => '#f0ebff'],
];
@endphp

@foreach($items as $kat => $layananList2)
@php $cfg2 = $katConfig2[$kat] ?? ['icon'=>'fa-cogs','color'=>'#6c757d','bg'=>'#f8f9fa']; @endphp
@foreach($layananList2 as $item)
<div class="modal fade" id="modal-{{ $item->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header">
                <div>
                    <h6 class="modal-title fw-bold mb-0">{{ $item->title }}</h6>
                    <small style="opacity:.75;">{{ $kat }}</small>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body p-4">
                <p class="text-muted small mb-3">{{ $item->excerpt }}</p>

                @if($item->body)
                <div class="p-3 rounded-3 mb-3" style="background:var(--color-1);">
                    <h6 class="fw-bold mb-2" style="color:var(--color-7);font-size:.82rem;">
                        <i class="fas fa-list-check me-1" style="color:var(--color-5);"></i>Persyaratan Dokumen
                    </h6>
                    @php
                        $syarat = array_filter(array_map('trim', explode(',', str_replace('Syarat: ', '', $item->body))));
                    @endphp
                    <ul class="syarat-list ps-3 mb-0">
                        @foreach($syarat as $s)
                            <li>{{ $s }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="p-3 rounded-3" style="background:#fff3cd;border-left:3px solid #ffc107;">
                    <small class="fw-semibold" style="color:#856404;">
                        <i class="fas fa-clock me-1"></i>Jam Layanan: Senin – Jumat, 08.00 – 15.00 WIB
                    </small>
                </div>
            </div>
            <div class="modal-footer border-0 pt-0 gap-2 flex-wrap">
                <a href="https://forms.gle/6yRkiPhwBz3dVktG6" target="_blank"
                   class="btn btn-sm rounded-pill px-3 fw-bold" style="background:var(--gold);color:var(--color-7);">
                    <i class="fas fa-file-signature me-1"></i>Ajukan via Google Form
                </a>
                <a href="{{ route('pengaduan.form') }}" class="btn btn-sm rounded-pill px-3" style="background:var(--color-5);color:white;">
                    <i class="fas fa-comment-dots me-1"></i>Butuh Bantuan?
                </a>
                <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endforeach
@endforeach

@endsection
