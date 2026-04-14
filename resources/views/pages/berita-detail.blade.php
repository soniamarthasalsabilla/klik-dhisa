@extends('layouts.app')

@push('styles')
<style>
    .artikel-body {
        font-size: .93rem;
        line-height: 1.9;
        color: #333;
        white-space: pre-line;
    }
    .artikel-body p { margin-bottom: 1rem; }

    .terkait-card {
        display: flex; gap: 12px; padding: 10px 0;
        border-bottom: 1px solid var(--color-2);
        text-decoration: none;
        transition: .15s;
    }
    .terkait-card:last-child { border-bottom: none; }
    .terkait-card:hover .terkait-judul { color: var(--color-5); }
    .terkait-thumb {
        width: 72px; height: 56px; border-radius: 8px;
        object-fit: cover; flex-shrink: 0;
    }
    .terkait-thumb-placeholder {
        width: 72px; height: 56px; border-radius: 8px;
        background: var(--color-1); display: flex; align-items: center;
        justify-content: center; flex-shrink: 0;
    }
    .terkait-judul { font-size: .8rem; font-weight: 600; color: var(--color-7); line-height: 1.4; margin-bottom: 3px; }
    .terkait-date  { font-size: .7rem; color: #adb5bd; }

    .kat-badge {
        display: inline-block; padding: 4px 12px; border-radius: 20px;
        font-size: .7rem; font-weight: 700; text-transform: uppercase;
        background: var(--color-1); color: var(--color-6);
    }
</style>
@endpush

@section('content')

{{-- Mini hero / breadcrumb bar --}}
<section class="py-3" style="background: white; border-bottom: 3px solid var(--color-5);">
    <div class="container py-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0" style="font-size:.82rem;">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}" style="color:var(--color-5);text-decoration:none;">
                        <i class="fas fa-home me-1"></i>Beranda
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('berita.desa') }}" style="color:var(--color-5);text-decoration:none;">Berita</a>
                </li>
                <li class="breadcrumb-item active text-truncate" style="max-width:260px;color:var(--color-7);">
                    {{ $artikel->judul }}
                </li>
            </ol>
        </nav>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">
        <div class="row g-4">

            {{-- Artikel Utama --}}
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

                    {{-- Gambar Utama --}}
                    @if($artikel->foto)
                    @php
                        $src = Str::startsWith($artikel->foto, ['http://', 'https://'])
                            ? $artikel->foto
                            : asset('storage/'.$artikel->foto);
                    @endphp
                    <img src="{{ $src }}" alt="{{ $artikel->judul }}"
                         class="w-100" style="max-height:420px;object-fit:cover;">
                    @else
                    <div class="d-flex align-items-center justify-content-center" style="height:200px;background:var(--color-1);">
                        <i class="fas fa-newspaper fa-4x" style="color:var(--color-3);"></i>
                    </div>
                    @endif

                    <div class="p-4 p-md-5">
                        {{-- Meta --}}
                        <div class="d-flex flex-wrap gap-2 align-items-center mb-3">
                            <span class="kat-badge">{{ $artikel->kategori }}</span>
                            <span class="text-muted" style="font-size:.75rem;">
                                <i class="fas fa-calendar-alt me-1"></i>
                                {{ $artikel->published_at ? $artikel->published_at->format('d M Y') : '-' }}
                            </span>
                        </div>

                        {{-- Judul --}}
                        <h1 class="fw-bold mb-3" style="color:var(--color-7);font-size:1.5rem;line-height:1.4;">
                            {{ $artikel->judul }}
                        </h1>

                        {{-- Ringkasan --}}
                        @if($artikel->ringkasan)
                        <div class="mb-4 p-3 rounded-3" style="background:var(--color-1);border-left:4px solid var(--color-5);">
                            <p class="mb-0 fst-italic" style="color:var(--color-6);font-size:.9rem;line-height:1.7;">
                                {{ $artikel->ringkasan }}
                            </p>
                        </div>
                        @endif

                        {{-- Isi --}}
                        <div class="artikel-body">{{ $artikel->isi }}</div>

                        {{-- Footer artikel --}}
                        <hr class="my-4" style="border-color:var(--color-2);">
                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                            <small class="text-muted">
                                <i class="fas fa-pen me-1" style="color:var(--color-5);"></i>
                                Pemerintah Desa Tajungan
                            </small>
                            <a href="{{ route('berita.desa') }}"
                               class="btn btn-sm rounded-pill px-4"
                               style="border:2px solid var(--color-5);color:var(--color-5);font-weight:600;font-size:.78rem;">
                                <i class="fas fa-arrow-left me-1"></i>Kembali ke Berita
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 sticky-top" style="top:90px;">

                    {{-- Artikel Terkait --}}
                    <h6 class="fw-bold mb-3" style="color:var(--color-7);">
                        <i class="fas fa-layer-group me-2" style="color:var(--color-5);"></i>Artikel Terkait
                    </h6>

                    @forelse($terkait as $t)
                    @php
                        $tSrc = $t->foto
                            ? (Str::startsWith($t->foto, ['http://', 'https://'])
                                ? $t->foto
                                : asset('storage/'.$t->foto))
                            : null;
                    @endphp
                    <a href="{{ route('berita.detail', $t->slug) }}" class="terkait-card">
                        @if($tSrc)
                            <img src="{{ $tSrc }}" class="terkait-thumb" alt="{{ $t->judul }}">
                        @else
                            <div class="terkait-thumb-placeholder">
                                <i class="fas fa-newspaper" style="color:var(--color-4);"></i>
                            </div>
                        @endif
                        <div>
                            <p class="terkait-judul">{{ Str::limit($t->judul, 60) }}</p>
                            <div class="terkait-date">
                                <i class="fas fa-calendar-alt me-1"></i>
                                {{ $t->published_at ? $t->published_at->format('d M Y') : '' }}
                            </div>
                        </div>
                    </a>
                    @empty
                    <p class="text-muted small mb-0">Tidak ada artikel terkait.</p>
                    @endforelse

                    {{-- Kategori badge --}}
                    <div class="mt-4 pt-3" style="border-top:1px solid var(--color-2);">
                        <small class="text-muted d-block mb-2" style="font-size:.72rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;">Kategori</small>
                        <span class="kat-badge">{{ $artikel->kategori }}</span>
                    </div>

                    <a href="{{ route('berita.desa') }}"
                       class="btn btn-sm w-100 rounded-pill mt-4"
                       style="border:2px solid var(--color-5);color:var(--color-5);font-weight:600;font-size:.78rem;">
                        <i class="fas fa-th me-1"></i>Semua Berita
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection
