@extends('layouts.app')

@push('styles')
<style>
    /* Filter pills */
    .filter-pill {
        padding: 6px 18px;
        border-radius: 50px;
        border: 2px solid var(--color-3);
        background: white;
        color: var(--color-6);
        font-size: .82rem;
        font-weight: 600;
        cursor: pointer;
        transition: .2s;
        text-decoration: none;
        display: inline-block;
    }
    .filter-pill:hover { border-color: var(--color-5); color: var(--color-5); }
    .filter-pill.active {
        background: var(--color-5);
        border-color: var(--color-5);
        color: white;
    }

    /* Photo card */
    .foto-card {
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 2px 12px rgba(0,0,0,.07);
        cursor: pointer;
        position: relative;
        background: #f8f9fa;
        transition: .25s;
    }
    .foto-card:hover { transform: translateY(-4px); box-shadow: 0 10px 30px rgba(58,154,140,.18); }
    .foto-card img {
        width: 100%; height: 210px;
        object-fit: cover;
        display: block;
        transition: .35s;
    }
    .foto-card:hover img { transform: scale(1.05); }

    /* Overlay */
    .foto-overlay {
        position: absolute; inset: 0;
        background: linear-gradient(to top, rgba(30,90,82,.75) 0%, transparent 60%);
        opacity: 0;
        transition: .3s;
        display: flex; align-items: flex-end;
        padding: 14px;
    }
    .foto-card:hover .foto-overlay { opacity: 1; }
    .foto-overlay .overlay-icon {
        width: 40px; height: 40px;
        border-radius: 50%;
        background: white;
        color: var(--color-7);
        display: flex; align-items: center; justify-content: center;
        margin-left: auto;
        font-size: .9rem;
    }

    /* Caption */
    .foto-caption {
        padding: 10px 12px 12px;
        background: white;
    }
    .foto-caption .judul { font-size: .83rem; font-weight: 700; color: var(--color-7); margin-bottom: 2px; }
    .foto-caption .kat-badge {
        font-size: .64rem; font-weight: 700;
        padding: 2px 8px; border-radius: 20px;
        background: var(--color-1); color: var(--color-6);
    }

    /* Modal lightbox */
    #lightbox-modal .modal-content { background: transparent; border: none; }
    #lightbox-modal .modal-body { padding: 0; position: relative; }
    #lightbox-modal img { width: 100%; max-height: 75vh; object-fit: contain; border-radius: 12px; }
    #lightbox-modal .lightbox-info {
        background: rgba(30,90,82,.95);
        border-radius: 0 0 12px 12px;
        padding: 14px 18px;
        color: white;
    }
    #lightbox-modal .btn-close-lb {
        position: absolute; top: -14px; right: -14px;
        width: 36px; height: 36px;
        border-radius: 50%; background: white;
        border: none; cursor: pointer;
        display: flex; align-items: center; justify-content: center;
        color: var(--color-7); font-size: .9rem;
        box-shadow: 0 2px 8px rgba(0,0,0,.2);
        z-index: 10;
    }

    /* Stats bar */
    .stat-chip {
        display: inline-flex; align-items: center; gap: 6px;
        background: white; border-radius: 50px;
        padding: 5px 14px; font-size: .8rem;
        color: var(--color-6); font-weight: 600;
        box-shadow: 0 2px 8px rgba(0,0,0,.06);
    }
    .stat-chip i { color: var(--color-5); }
</style>
@endpush

@section('content')

{{-- Hero --}}
<section class="py-3" style="background: white; border-bottom: 3px solid var(--color-5);">
    <div class="container text-center py-4">
        <h2 class="fw-bold mb-2" style="color: var(--color-7); font-size: 2rem;">
            <i class="fas fa-images me-2" style="color:var(--color-5);"></i>Galeri Foto
        </h2>
        <p class="mb-0" style="color: var(--color-6); font-size: 1rem;">Dokumentasi kegiatan dan potensi Desa Tajungan</p>
    </div>
</section>

{{-- Stats bar --}}
<section class="py-3" style="background: var(--color-1); border-bottom: 1px solid var(--color-2);">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-center gap-3">
            <div class="stat-chip">
                <i class="fas fa-camera"></i>
                {{ $galeris->total() }} Foto
            </div>
            @foreach($kategori as $kat)
            <div class="stat-chip">
                <i class="fas fa-tag"></i>
                {{ $kat }}
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">

        {{-- Filter Kategori --}}
        <div class="d-flex flex-wrap gap-2 mb-4 align-items-center">
            <a href="{{ route('galeri.desa') }}"
               class="filter-pill {{ !request('kat') ? 'active' : '' }}">
               <i class="fas fa-th me-1"></i>Semua
            </a>
            @foreach($kategori as $kat)
            <a href="{{ route('galeri.desa', ['kat'=>$kat]) }}"
               class="filter-pill {{ request('kat')==$kat ? 'active' : '' }}">
               {{ $kat }}
            </a>
            @endforeach
        </div>

        {{-- Grid Foto --}}
        @if($galeris->isEmpty())
        <div class="text-center py-5" style="color:#adb5bd;">
            <i class="fas fa-images fa-4x mb-3 opacity-25 d-block"></i>
            <p class="mb-0 fw-semibold">Belum ada foto di galeri.</p>
            <small>Foto akan segera ditambahkan.</small>
        </div>
        @else
        <div class="row g-3">
            @foreach($galeris as $foto)
            @php
                $src = Str::startsWith($foto->foto, ['http://', 'https://'])
                    ? $foto->foto
                    : asset('storage/'.$foto->foto);
            @endphp
            <div class="col-6 col-md-4 col-lg-3">
                <div class="foto-card"
                     data-src="{{ $src }}"
                     data-judul="{{ $foto->judul }}"
                     data-kat="{{ $foto->kategori }}"
                     data-deskripsi="{{ $foto->deskripsi }}"
                     onclick="openLightbox(this)">
                    <div style="overflow:hidden;">
                        <img src="{{ $src }}" alt="{{ $foto->judul }}" loading="lazy">
                    </div>
                    <div class="foto-overlay">
                        <div class="overlay-icon">
                            <i class="fas fa-expand"></i>
                        </div>
                    </div>
                    <div class="foto-caption">
                        <p class="judul mb-1">{{ Str::limit($foto->judul, 42) }}</p>
                        <span class="kat-badge">{{ $foto->kategori }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if($galeris->hasPages())
        <div class="mt-4 d-flex justify-content-center">
            {{ $galeris->links() }}
        </div>
        @endif
        @endif

    </div>
</section>

{{-- Lightbox Modal --}}
<div class="modal fade" id="lightbox-modal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body" style="position:relative;">
                <button class="btn-close-lb" onclick="bootstrap.Modal.getInstance(document.getElementById('lightbox-modal')).hide()">
                    <i class="fas fa-times"></i>
                </button>
                <img id="lb-img" src="" alt="" class="rounded-top-3">
                <div class="lightbox-info">
                    <div class="d-flex align-items-start justify-content-between gap-3">
                        <div>
                            <h6 class="fw-bold mb-1" id="lb-judul" style="font-size:.95rem;"></h6>
                            <p class="mb-0 opacity-75" id="lb-deskripsi" style="font-size:.8rem;line-height:1.5;"></p>
                        </div>
                        <span class="badge rounded-pill flex-shrink-0" id="lb-kat"
                              style="background:rgba(255,255,255,.15);font-size:.7rem;"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
var lbModal = null;
document.addEventListener('DOMContentLoaded', function () {
    lbModal = new bootstrap.Modal(document.getElementById('lightbox-modal'));
});

function openLightbox(el) {
    document.getElementById('lb-img').src          = el.dataset.src;
    document.getElementById('lb-judul').textContent = el.dataset.judul;
    document.getElementById('lb-deskripsi').textContent = el.dataset.deskripsi || '';
    document.getElementById('lb-kat').textContent  = el.dataset.kat || '';
    lbModal.show();
}
</script>
@endpush
