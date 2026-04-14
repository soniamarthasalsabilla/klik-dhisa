@extends('layouts.app')

@push('styles')
<style>
    .pamong-card {
        background: white;
        border-radius: 14px;
        border: 1px solid var(--color-2);
        padding: 24px 18px;
        text-align: center;
        transition: .2s;
        box-shadow: 0 2px 10px rgba(0,0,0,.05);
    }
    .pamong-card:hover {
        border-color: var(--color-4);
        box-shadow: 0 8px 24px rgba(58,154,140,.14);
        transform: translateY(-3px);
    }
    .pamong-card.pimpinan {
        border-top: 5px solid var(--color-5);
        padding: 28px 24px;
    }
    .pamong-avatar {
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid var(--color-2);
        display: block;
        margin: 0 auto 14px;
    }
    .pamong-avatar-placeholder {
        border-radius: 50%;
        background: var(--color-1);
        border: 4px solid var(--color-2);
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 14px;
    }
    .jabatan-badge {
        display: inline-block;
        padding: 4px 14px; border-radius: 20px;
        font-size: .72rem; font-weight: 700;
        background: var(--color-5); color: white;
    }
    .jabatan-badge.secondary {
        background: var(--color-1); color: var(--color-6);
    }
    .wa-btn {
        display: inline-flex; align-items: center; gap: 6px;
        background: #25D366; color: white;
        border: none; border-radius: 20px;
        padding: 4px 14px; font-size: .75rem; font-weight: 600;
        text-decoration: none; margin-top: 10px;
        transition: .2s;
    }
    .wa-btn:hover { background: #1da851; color: white; }

    /* Divider connector */
    .org-connector {
        text-align: center;
        margin: 0 auto;
        border-left: 2px dashed var(--color-3);
        height: 32px;
        width: 0;
    }
</style>
@endpush

@section('content')

{{-- Hero --}}
<section class="py-3" style="background: white; border-bottom: 3px solid var(--color-5);">
    <div class="container text-center py-4">
        <h2 class="fw-bold mb-2" style="color: var(--color-7); font-size: 2rem;">
            <i class="fas fa-sitemap me-2" style="color:var(--color-5);"></i>Struktur Organisasi
        </h2>
        <p class="mb-0" style="color: var(--color-6); font-size: 1rem;">Pemerintah Desa Tajungan – Periode 2021–2027</p>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">

        @if($pamongs->isEmpty())
        <div class="text-center py-5" style="color:#adb5bd;">
            <i class="fas fa-sitemap fa-4x mb-3 opacity-25 d-block"></i>
            <p class="mb-0 fw-semibold">Data struktur organisasi belum tersedia.</p>
        </div>
        @else

        @php
            $pimpinan  = $pamongs->take(2);   // Kepala Desa + Sekdes
            $staf      = $pamongs->skip(2);
        @endphp

        {{-- Pimpinan (Kades & Sekdes) --}}
        @if($pimpinan->isNotEmpty())
        <div class="row justify-content-center mb-2">
            @foreach($pimpinan as $idx => $p)
            <div class="{{ $idx === 0 ? 'col-md-4 col-lg-3' : 'col-md-4 col-lg-3 mt-4 mt-md-0' }}">
                <div class="pamong-card {{ $idx === 0 ? 'pimpinan' : '' }} h-100">
                    @if($p->foto)
                        <img src="{{ asset('storage/'.$p->foto) }}" class="pamong-avatar"
                             width="{{ $idx===0 ? 110 : 90 }}" height="{{ $idx===0 ? 110 : 90 }}" alt="{{ $p->nama }}">
                    @else
                        <div class="pamong-avatar-placeholder" style="width:{{ $idx===0 ? 110 : 90 }}px;height:{{ $idx===0 ? 110 : 90 }}px;">
                            <i class="fas fa-user fa-{{ $idx===0 ? '3x' : '2x' }}" style="color:var(--color-4);"></i>
                        </div>
                    @endif
                    <h6 class="fw-bold mb-1" style="font-size:{{ $idx===0 ? '.95rem' : '.88rem' }};color:var(--color-7);">{{ $p->nama }}</h6>
                    <span class="jabatan-badge {{ $idx===0 ? '' : 'secondary' }}">{{ $p->jabatan }}</span>
                    @if($p->no_hp)
                    <div>
                        <a href="https://wa.me/{{ $p->no_hp }}" class="wa-btn" target="_blank">
                            <i class="fab fa-whatsapp"></i>Hubungi
                        </a>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @endif

        {{-- Connector --}}
        @if($staf->isNotEmpty())
        <div class="d-flex justify-content-center my-1">
            <div class="org-connector"></div>
        </div>
        @endif

        {{-- Staf / Perangkat --}}
        @if($staf->isNotEmpty())
        <div class="row g-3 justify-content-center">
            @foreach($staf as $p)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="pamong-card h-100">
                    @if($p->foto)
                        <img src="{{ asset('storage/'.$p->foto) }}" class="pamong-avatar"
                             width="80" height="80" alt="{{ $p->nama }}">
                    @else
                        <div class="pamong-avatar-placeholder" style="width:80px;height:80px;">
                            <i class="fas fa-user fa-2x" style="color:var(--color-4);"></i>
                        </div>
                    @endif
                    <h6 class="fw-bold mb-1" style="font-size:.83rem;color:var(--color-7);">{{ $p->nama }}</h6>
                    <span class="jabatan-badge secondary" style="font-size:.65rem;">{{ $p->jabatan }}</span>
                    @if($p->no_hp)
                    <div>
                        <a href="https://wa.me/{{ $p->no_hp }}" class="wa-btn" target="_blank"
                           style="padding:3px 10px;font-size:.7rem;">
                            <i class="fab fa-whatsapp"></i>WA
                        </a>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @endif

        {{-- Info --}}
        <div class="mt-5 p-3 rounded-3 d-flex align-items-start gap-3" style="background:var(--color-1);border:1px solid var(--color-2);">
            <i class="fas fa-info-circle mt-1" style="color:var(--color-5);"></i>
            <small style="color:var(--color-6);line-height:1.6;">
                Struktur organisasi Pemerintah Desa Tajungan terdiri dari Kepala Desa, Sekretaris Desa, dan perangkat desa lainnya sesuai Peraturan Menteri Dalam Negeri No. 84 Tahun 2015. Untuk informasi lebih lanjut, kunjungi Kantor Desa Tajungan pada jam pelayanan.
            </small>
        </div>

        @endif
    </div>
</section>

@endsection
