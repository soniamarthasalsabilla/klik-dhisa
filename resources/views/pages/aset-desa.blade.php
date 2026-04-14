@extends('layouts.app')

@push('styles')
<style>
    .filter-pill {
        padding: 6px 18px; border-radius: 50px;
        border: 2px solid var(--color-3); background: white;
        color: var(--color-6); font-size: .82rem; font-weight: 600;
        cursor: pointer; transition: .2s; text-decoration: none; display: inline-block;
    }
    .filter-pill:hover { border-color: var(--color-5); color: var(--color-5); }
    .filter-pill.active { background: var(--color-5); border-color: var(--color-5); color: white; }

    .rekap-card {
        background: white; border-radius: 14px;
        border: 1px solid var(--color-2);
        padding: 20px 16px; text-align: center;
        transition: .2s; text-decoration: none; display: block;
        border-top: 4px solid transparent;
    }
    .rekap-card:hover { transform: translateY(-3px); box-shadow: 0 8px 24px rgba(0,0,0,.1); }

    .aset-table thead th {
        background: var(--color-1);
        color: var(--color-7);
        font-size: .78rem; font-weight: 700;
        text-transform: uppercase; letter-spacing: .4px;
        padding: 10px 12px; border-bottom: 2px solid var(--color-2);
    }
    .aset-table tbody tr:hover { background: var(--color-1); }
    .aset-table td { font-size: .84rem; padding: 10px 12px; vertical-align: middle; }

    .kat-header {
        border-left: 4px solid var(--color-5);
        padding-left: 12px; margin-bottom: 14px;
    }
</style>
@endpush

@section('content')

{{-- Hero --}}
<section class="py-3" style="background: white; border-bottom: 3px solid var(--color-5);">
    <div class="container text-center py-4">
        <h2 class="fw-bold mb-2" style="color: var(--color-7); font-size: 2rem;">
            <i class="fas fa-warehouse me-2" style="color:var(--color-5);"></i>Aset Desa Tajungan
        </h2>
        <p class="mb-0" style="color: var(--color-6); font-size: 1rem;">Inventaris kekayaan milik Desa Tajungan</p>
    </div>
</section>

@php
$jenisConfig = [
    'Tanah'              => ['icon' => 'fa-map',        'color' => '#198754', 'bg' => '#d1e7dd'],
    'Bangunan'           => ['icon' => 'fa-building',   'color' => '#0d6efd', 'bg' => '#cfe2ff'],
    'Kendaraan'          => ['icon' => 'fa-motorcycle', 'color' => '#fd7e14', 'bg' => '#ffe5d0'],
    'Peralatan & Mesin'  => ['icon' => 'fa-tools',      'color' => '#6f42c1', 'bg' => '#e8d5ff'],
    'Infrastruktur'      => ['icon' => 'fa-road',       'color' => '#1E5A52', 'bg' => '#E8F5F0'],
    'Aset Tetap Lainnya' => ['icon' => 'fa-box',        'color' => '#6c757d', 'bg' => '#e9ecef'],
];
@endphp

<section class="py-5 bg-light">
    <div class="container">

        {{-- Rekap per Jenis --}}
        @if($rekapJenis->isNotEmpty())
        <div class="row g-3 mb-4">
            @foreach($rekapJenis as $jenis => $jumlah)
            @php $cfg = $jenisConfig[$jenis] ?? ['icon'=>'fa-box','color'=>'#666','bg'=>'#eee']; @endphp
            <div class="col-6 col-md-4 col-lg-2">
                <a href="#{{ Str::slug($jenis) }}" class="rekap-card" style="border-top-color:{{ $cfg['color'] }};">
                    <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center mb-2"
                         style="width:48px;height:48px;background:{{ $cfg['bg'] }};">
                        <i class="fas {{ $cfg['icon'] }}" style="color:{{ $cfg['color'] }};font-size:.95rem;"></i>
                    </div>
                    <div class="fw-bold" style="font-size:1.5rem;color:var(--color-7);line-height:1;">{{ $jumlah }}</div>
                    <div class="text-muted" style="font-size:.72rem;margin-top:4px;">{{ $jenis }}</div>
                </a>
            </div>
            @endforeach
        </div>
        @endif

        {{-- Filter --}}
        <div class="d-flex flex-wrap gap-2 mb-4 align-items-center">
            <a href="{{ route('aset.desa') }}" class="filter-pill {{ !request('jenis') ? 'active' : '' }}">
                <i class="fas fa-th me-1"></i>Semua
            </a>
            @foreach(array_keys($jenisConfig) as $j)
            @if(isset($rekapJenis[$j]))
            <a href="{{ route('aset.desa', ['jenis' => $j]) }}"
               class="filter-pill {{ request('jenis') === $j ? 'active' : '' }}">{{ $j }}</a>
            @endif
            @endforeach
        </div>

        {{-- Daftar Aset per Jenis --}}
        @forelse($asetPerJenis as $jenis => $items)
        @php $cfg = $jenisConfig[$jenis] ?? ['icon'=>'fa-box','color'=>'#666','bg'=>'#eee']; @endphp
        <div class="mb-5" id="{{ Str::slug($jenis) }}">
            <div class="kat-header">
                <div class="d-flex align-items-center gap-2">
                    <div style="width:34px;height:34px;border-radius:8px;background:{{ $cfg['bg'] }};display:flex;align-items:center;justify-content:center;">
                        <i class="fas {{ $cfg['icon'] }}" style="color:{{ $cfg['color'] }};font-size:.85rem;"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0" style="color:var(--color-7);">{{ $jenis }}</h6>
                        <small class="text-muted">{{ $items->count() }} item terdaftar</small>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="table-responsive">
                    <table class="table aset-table mb-0">
                        <thead>
                            <tr>
                                <th style="width:36px;">#</th>
                                <th>Nama Aset</th>
                                <th>Kondisi</th>
                                <th>Lokasi</th>
                                <th>Luas</th>
                                <th>Nilai Perolehan</th>
                                <th>Tahun</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $i => $aset)
                            <tr>
                                <td class="text-muted">{{ $i + 1 }}</td>
                                <td>
                                    <div class="fw-semibold" style="color:var(--color-7);">{{ $aset->nama }}</div>
                                    @if($aset->keterangan)
                                        <small class="text-muted">{{ $aset->keterangan }}</small>
                                    @endif
                                </td>
                                <td>
                                    @php
                                    $kBadge = match($aset->kondisi) {
                                        'Baik'         => ['bg-success',              'white'],
                                        'Rusak Ringan' => ['bg-warning',              'dark'],
                                        'Rusak Sedang' => ['bg-warning',              'dark'],
                                        'Rusak Berat'  => ['bg-danger',               'white'],
                                        default        => ['bg-secondary',            'white'],
                                    };
                                    @endphp
                                    <span class="badge {{ $kBadge[0] }} {{ $kBadge[1]==='dark'?'text-dark':'' }} rounded-pill">
                                        {{ $aset->kondisi }}
                                    </span>
                                </td>
                                <td class="text-muted">{{ $aset->lokasi ?? '-' }}</td>
                                <td class="text-muted text-end">
                                    {{ $aset->luas ? number_format($aset->luas, 0, ',', '.') . ' m²' : '-' }}
                                </td>
                                <td class="text-end" style="white-space:nowrap;">
                                    @if($aset->nilai_perolehan > 0)
                                        <span style="color:var(--color-7);font-weight:600;">
                                            Rp {{ number_format($aset->nilai_perolehan, 0, ',', '.') }}
                                        </span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="text-muted">{{ $aset->tahun_perolehan ?? '-' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center py-5" style="color:#adb5bd;">
            <i class="fas fa-warehouse fa-4x mb-3 opacity-25 d-block"></i>
            <p class="mb-0 fw-semibold">Data aset belum tersedia.</p>
        </div>
        @endforelse

        {{-- Footer Note --}}
        @if($asetPerJenis->isNotEmpty())
        <div class="p-3 rounded-3 d-flex align-items-start gap-3 mt-2" style="background:var(--color-1);border:1px solid var(--color-2);">
            <i class="fas fa-info-circle mt-1" style="color:var(--color-5);"></i>
            <small style="color:var(--color-6);line-height:1.6;">
                Data inventaris aset desa diperbarui setiap tahun anggaran. Sumber: Laporan Kekayaan Milik Desa (LKMD) Tajungan {{ date('Y') }}.
            </small>
        </div>
        @endif

    </div>
</section>

@endsection
