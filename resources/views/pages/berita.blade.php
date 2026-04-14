@extends('layouts.app')

@push('styles')
<style>
    .filter-pill {
        padding: 6px 18px; border-radius: 50px;
        border: 2px solid var(--color-3); background: white;
        color: var(--color-6); font-size: .82rem; font-weight: 600;
        transition: .2s; text-decoration: none; display: inline-block;
    }
    .filter-pill:hover { border-color: var(--color-5); color: var(--color-5); }
    .filter-pill.active { background: var(--color-5); border-color: var(--color-5); color: white; }

    .artikel-card {
        border-radius: 14px; overflow: hidden;
        border: 1px solid var(--color-2); background: white;
        box-shadow: 0 2px 10px rgba(0,0,0,.05);
        transition: .25s; text-decoration: none; display: block; height: 100%;
    }
    .artikel-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 30px rgba(58,154,140,.14);
        border-color: var(--color-4);
    }
    .artikel-card .thumb {
        height: 200px; overflow: hidden;
        background: var(--color-1);
        display: flex; align-items: center; justify-content: center;
    }
    .artikel-card .thumb img {
        width: 100%; height: 100%; object-fit: cover;
        transition: .35s;
    }
    .artikel-card:hover .thumb img { transform: scale(1.05); }

    .kat-badge {
        display: inline-block; padding: 3px 10px; border-radius: 20px;
        font-size: .65rem; font-weight: 700; text-transform: uppercase;
        background: var(--color-1); color: var(--color-6);
    }

    .artikel-card .body { padding: 16px; }
    .artikel-card .judul {
        font-size: .9rem; font-weight: 700; color: var(--color-7);
        margin-bottom: 6px; line-height: 1.4;
    }
    .artikel-card .ringkasan {
        font-size: .78rem; color: #6c757d; line-height: 1.6;
        margin-bottom: 12px;
    }
    .artikel-card .meta {
        font-size: .72rem; color: #adb5bd;
        display: flex; align-items: center; gap: 8px;
    }
    .baca-link {
        font-size: .75rem; font-weight: 600; color: var(--color-5);
        text-decoration: none;
        display: flex; align-items: center; gap: 4px;
    }
    .baca-link:hover { color: var(--color-7); }
</style>
@endpush

@section('content')

{{-- Hero --}}
<section class="py-3" style="background: white; border-bottom: 3px solid var(--color-5);">
    <div class="container text-center py-4">
        <h2 class="fw-bold mb-2" style="color: var(--color-7); font-size: 2rem;">
            <i class="fas fa-newspaper me-2" style="color:var(--color-5);"></i>Berita & Artikel
        </h2>
        <p class="mb-0" style="color: var(--color-6); font-size: 1rem;">Informasi terkini seputar Desa Tajungan</p>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">

        {{-- Filter Kategori --}}
        @if($kategori->isNotEmpty())
        <div class="d-flex flex-wrap gap-2 mb-4">
            <a href="{{ route('berita.desa') }}"
               class="filter-pill {{ !request('kat') ? 'active' : '' }}">
               <i class="fas fa-th me-1"></i>Semua
            </a>
            @foreach($kategori as $kat)
            <a href="{{ route('berita.desa', ['kat'=>$kat]) }}"
               class="filter-pill {{ request('kat')==$kat ? 'active' : '' }}">{{ $kat }}</a>
            @endforeach
        </div>
        @endif

        @if($artikels->isEmpty())
        <div class="text-center py-5" style="color:#adb5bd;">
            <i class="fas fa-newspaper fa-4x mb-3 opacity-25 d-block"></i>
            <p class="mb-0 fw-semibold">Belum ada artikel yang dipublikasikan.</p>
        </div>
        @else

        <div class="row g-4">
            @foreach($artikels as $artikel)
            @php
                $src = $artikel->foto
                    ? (Str::startsWith($artikel->foto, ['http://', 'https://'])
                        ? $artikel->foto
                        : asset('storage/'.$artikel->foto))
                    : null;
            @endphp
            <div class="col-md-6 col-lg-4">
                <a href="{{ route('berita.detail', $artikel->slug) }}" class="artikel-card">
                    <div class="thumb">
                        @if($src)
                            <img src="{{ $src }}" alt="{{ $artikel->judul }}" loading="lazy">
                        @else
                            <i class="fas fa-newspaper fa-3x" style="color:var(--color-3);"></i>
                        @endif
                    </div>
                    <div class="body">
                        <div class="mb-2">
                            <span class="kat-badge">{{ $artikel->kategori }}</span>
                        </div>
                        <p class="judul">{{ $artikel->judul }}</p>
                        <p class="ringkasan">
                            {{ Str::limit($artikel->ringkasan ?: strip_tags($artikel->isi), 100) }}
                        </p>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="meta">
                                <i class="fas fa-calendar-alt"></i>
                                {{ $artikel->published_at ? $artikel->published_at->format('d M Y') : '-' }}
                            </div>
                            <span class="baca-link">
                                Baca <i class="fas fa-arrow-right"></i>
                            </span>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>

        @if($artikels->hasPages())
        <div class="mt-4 d-flex justify-content-center">{{ $artikels->links() }}</div>
        @endif

        @endif
    </div>
</section>

@endsection
