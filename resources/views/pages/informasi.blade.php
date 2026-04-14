@extends('layouts.app')

@push('styles')
<style>
    /* Category filter pills */
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
    }
    .filter-pill:hover,
    .filter-pill.active {
        background: var(--color-5);
        border-color: var(--color-5);
        color: white;
    }

    /* Document card */
    .doc-card {
        border: 1px solid var(--color-2);
        border-radius: 12px;
        background: white;
        padding: 16px 18px;
        transition: .2s;
        display: flex;
        align-items: flex-start;
        gap: 14px;
    }
    .doc-card:hover {
        border-color: var(--color-4);
        box-shadow: 0 6px 20px rgba(58,154,140,.12);
        transform: translateY(-2px);
    }
    .doc-icon {
        width: 46px; height: 46px;
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.1rem;
        flex-shrink: 0;
    }
    .doc-year {
        display: inline-block;
        font-size: .68rem;
        font-weight: 700;
        padding: 2px 8px;
        border-radius: 20px;
        background: var(--color-1);
        color: var(--color-6);
    }
    .btn-unduh {
        background: var(--color-5);
        color: white;
        border: none;
        border-radius: 20px;
        padding: 4px 14px;
        font-size: .75rem;
        font-weight: 600;
        white-space: nowrap;
        transition: .2s;
    }
    .btn-unduh:hover { background: var(--color-7); color: white; }

    /* Category section header */
    .kat-header {
        border-left: 4px solid var(--color-5);
        padding-left: 12px;
        margin-bottom: 14px;
    }

    /* Search box */
    #search-input {
        border: 2px solid var(--color-2);
        border-radius: 50px;
        padding: 8px 18px;
        font-size: .88rem;
        outline: none;
        transition: .2s;
        width: 100%;
        max-width: 340px;
    }
    #search-input:focus { border-color: var(--color-4); }

    .empty-doc {
        text-align: center;
        padding: 40px;
        color: #adb5bd;
    }
</style>
@endpush

@section('content')

{{-- Hero --}}
<section class="py-3" style="background: white; border-bottom: 3px solid var(--color-5);">
    <div class="container text-center py-4">
        <h2 class="fw-bold mb-2" style="color: var(--color-7); font-size: 2rem;">
            <i class="fas fa-folder-open me-2" style="color:var(--color-5);"></i>Informasi Publik
        </h2>
        <p class="mb-0" style="color: var(--color-6); font-size: 1rem;">Transparansi dokumen dan produk hukum Desa Tajungan</p>
    </div>
</section>

{{-- Info strip --}}
<section class="py-3" style="background: var(--color-1); border-bottom: 1px solid var(--color-2);">
    <div class="container">
        <div class="row g-2 justify-content-center text-center">
            <div class="col-md-4 col-12">
                <small style="color:var(--color-6);">
                    <i class="fas fa-info-circle me-1" style="color:var(--color-5);"></i>
                    Semua dokumen tersedia untuk diunduh oleh masyarakat
                </small>
            </div>
            <div class="col-md-4 col-12">
                <small style="color:var(--color-6);">
                    <i class="fas fa-phone-alt me-1" style="color:var(--color-5);"></i>
                    Informasi lebih lanjut: (031) 3014567
                </small>
            </div>
            <div class="col-md-4 col-12">
                <small style="color:var(--color-6);">
                    <i class="fas fa-clock me-1" style="color:var(--color-5);"></i>
                    Pembaruan terakhir: {{ now()->format('d/m/Y') }}
                </small>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">

        @php
        $katConfig = [
            'Peraturan Desa'     => ['icon' => 'fa-gavel',        'color' => '#1E5A52', 'bg' => '#E8F5F0'],
            'Dokumen Perencanaan'=> ['icon' => 'fa-map',          'color' => '#0d6efd', 'bg' => '#e8f0fe'],
            'Laporan Keuangan'   => ['icon' => 'fa-chart-bar',    'color' => '#198754', 'bg' => '#e8f5e9'],
            'SK & Berita Acara'  => ['icon' => 'fa-file-signature','color' => '#fd7e14', 'bg' => '#fff3e0'],
            'Lainnya'            => ['icon' => 'fa-file-alt',     'color' => '#6c757d', 'bg' => '#f8f9fa'],
        ];

        $grouped = $items->groupBy(fn($i) => $i->category ?? 'Lainnya');
        $categories = $grouped->keys()->toArray();
        @endphp

        {{-- Toolbar: filter + search --}}
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
            <div class="d-flex flex-wrap gap-2" id="filter-pills">
                <button class="filter-pill active" data-kat="semua">Semua ({{ $items->count() }})</button>
                @foreach($categories as $kat)
                    <button class="filter-pill" data-kat="{{ $kat }}">
                        {{ $kat }} ({{ $grouped[$kat]->count() }})
                    </button>
                @endforeach
            </div>
            <input type="text" id="search-input" placeholder="&#xf002;  Cari dokumen..." style="font-family:'Poppins', FontAwesome, sans-serif;">
        </div>

        {{-- Document list grouped by category --}}
        @forelse($grouped as $kat => $docs)
        @php $cfg = $katConfig[$kat] ?? $katConfig['Lainnya']; @endphp
        <div class="mb-5 kat-section" data-kat="{{ $kat }}">
            <div class="kat-header">
                <div class="d-flex align-items-center gap-2">
                    <div style="width:34px;height:34px;border-radius:8px;background:{{ $cfg['bg'] }};display:flex;align-items:center;justify-content:center;">
                        <i class="fas {{ $cfg['icon'] }}" style="color:{{ $cfg['color'] }};font-size:.85rem;"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0" style="color:var(--color-7);">{{ $kat }}</h6>
                        <small class="text-muted">{{ $docs->count() }} dokumen</small>
                    </div>
                </div>
            </div>

            <div class="row g-3 doc-grid">
                @foreach($docs as $doc)
                <div class="col-12 doc-item" data-title="{{ strtolower($doc->title) }}" data-kat="{{ $kat }}">
                    <div class="doc-card">
                        <div class="doc-icon" style="background:{{ $cfg['bg'] }};">
                            <i class="fas {{ $cfg['icon'] }}" style="color:{{ $cfg['color'] }};"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex flex-wrap align-items-start justify-content-between gap-2">
                                <div>
                                    <p class="fw-bold mb-1" style="font-size:.9rem;color:var(--color-7);">{{ $doc->title }}</p>
                                    @if($doc->excerpt)
                                    <p class="text-muted mb-2" style="font-size:.78rem;line-height:1.5;">{{ $doc->excerpt }}</p>
                                    @endif
                                    <div class="d-flex flex-wrap gap-2 align-items-center">
                                        @if($doc->year)
                                        <span class="doc-year"><i class="fas fa-calendar me-1"></i>{{ $doc->year }}</span>
                                        @endif
                                        <span class="badge rounded-pill" style="background:{{ $cfg['bg'] }};color:{{ $cfg['color'] }};font-size:.65rem;">{{ $kat }}</span>
                                    </div>
                                </div>
                                <div class="flex-shrink-0">
                                    @if($doc->link)
                                        <a href="{{ $doc->link }}" target="_blank" class="btn-unduh">
                                            <i class="fas fa-download me-1"></i>Unduh
                                        </a>
                                    @elseif($doc->file)
                                        <a href="{{ asset('storage/'.$doc->file) }}" target="_blank" class="btn-unduh">
                                            <i class="fas fa-download me-1"></i>Unduh
                                        </a>
                                    @else
                                        <span class="text-muted" style="font-size:.75rem;"><i class="fas fa-clock me-1"></i>Segera tersedia</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @empty
        <div class="empty-doc">
            <i class="fas fa-folder-open fa-3x mb-3 opacity-25 d-block"></i>
            <p class="mb-0">Belum ada dokumen yang dipublikasikan.</p>
            <small>Hubungi kantor desa untuk informasi lebih lanjut.</small>
        </div>
        @endforelse

        {{-- No results message --}}
        <div id="no-result" class="empty-doc" style="display:none;">
            <i class="fas fa-search fa-3x mb-3 opacity-25 d-block"></i>
            <p class="mb-0">Dokumen tidak ditemukan.</p>
            <small>Coba kata kunci lain.</small>
        </div>

        {{-- CTA --}}
        @if($items->isNotEmpty())
        <div class="card border-0 rounded-4 mt-4" style="background: linear-gradient(135deg, var(--color-7), var(--color-6));">
            <div class="card-body p-4 d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">
                <div class="text-white">
                    <h5 class="fw-bold mb-1"><i class="fas fa-question-circle me-2" style="color:var(--gold);"></i>Butuh Dokumen Lain?</h5>
                    <p class="mb-0 opacity-75" style="font-size:.88rem;">Tidak menemukan dokumen yang dicari? Hubungi kantor desa atau ajukan permohonan informasi.</p>
                </div>
                <a href="{{ route('pengaduan.form') }}" class="btn rounded-pill fw-bold px-4 flex-shrink-0" style="background:var(--gold);color:var(--color-7);">
                    <i class="fas fa-paper-plane me-1"></i>Ajukan Permohonan
                </a>
            </div>
        </div>
        @endif

    </div>
</section>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const pills   = document.querySelectorAll('.filter-pill');
    const items   = document.querySelectorAll('.doc-item');
    const sections= document.querySelectorAll('.kat-section');
    const noResult= document.getElementById('no-result');
    const search  = document.getElementById('search-input');

    let activeKat = 'semua';
    let searchQ   = '';

    function applyFilter() {
        let visible = 0;
        sections.forEach(sec => {
            const secKat = sec.dataset.kat;
            const secItems = sec.querySelectorAll('.doc-item');
            let secVisible = 0;

            secItems.forEach(item => {
                const matchKat   = activeKat === 'semua' || item.dataset.kat === activeKat;
                const matchSearch= !searchQ || item.dataset.title.includes(searchQ);
                if (matchKat && matchSearch) {
                    item.style.display = '';
                    secVisible++;
                    visible++;
                } else {
                    item.style.display = 'none';
                }
            });

            sec.style.display = secVisible > 0 ? '' : 'none';
        });

        noResult.style.display = visible === 0 ? 'block' : 'none';
    }

    pills.forEach(pill => {
        pill.addEventListener('click', function () {
            pills.forEach(p => p.classList.remove('active'));
            this.classList.add('active');
            activeKat = this.dataset.kat;
            applyFilter();
        });
    });

    search.addEventListener('input', function () {
        searchQ = this.value.toLowerCase().trim();
        applyFilter();
    });
});
</script>
@endpush
