@extends('layouts.admin')
@section('title', 'Aset Desa')
@section('page-title', 'Aset Desa')

@section('content')

@php
$jenisConfig = [
    'Tanah'              => ['icon' => 'fa-map',        'color' => '#198754'],
    'Bangunan'           => ['icon' => 'fa-building',   'color' => '#0d6efd'],
    'Kendaraan'          => ['icon' => 'fa-motorcycle', 'color' => '#fd7e14'],
    'Peralatan & Mesin'  => ['icon' => 'fa-tools',      'color' => '#6f42c1'],
    'Infrastruktur'      => ['icon' => 'fa-road',       'color' => '#20c997'],
    'Aset Tetap Lainnya' => ['icon' => 'fa-box',        'color' => '#6c757d'],
];
@endphp

{{-- Summary Cards --}}
@if($totals->count())
<div class="row g-3 mb-4">
    @foreach($totals as $jenis => $jumlah)
    <div class="col-xl-2 col-md-4 col-6">
        <a href="{{ route('admin.aset.index', ['jenis' => $jenis]) }}" class="text-decoration-none">
            <div class="card border-0 shadow-sm h-100 p-3" style="transition:transform .15s;"
                 onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform=''">
                <i class="fas {{ $jenisConfig[$jenis]['icon'] ?? 'fa-box' }} mb-2"
                   style="color:{{ $jenisConfig[$jenis]['color'] ?? '#666' }};font-size:1.4rem;"></i>
                <div class="fw-bold fs-5 text-dark">{{ $jumlah }}</div>
                <div class="text-muted" style="font-size:.76rem;">{{ $jenis }}</div>
            </div>
        </a>
    </div>
    @endforeach
</div>
@endif

{{-- Search & Filter Bar --}}
<div class="card border-0 shadow-sm rounded-3 mb-3 p-3">
    <form method="GET" action="{{ route('admin.aset.index') }}" class="row g-2 align-items-end">
        <div class="col-md-4">
            <label class="form-label fw-semibold mb-1" style="font-size:.8rem">Cari Aset</label>
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0">
                    <i class="fas fa-search text-muted" style="font-size:.85rem"></i>
                </span>
                <input type="text" name="search" class="form-control border-start-0 ps-0"
                       placeholder="Nama, lokasi, keterangan…"
                       value="{{ request('search') }}">
            </div>
        </div>
        <div class="col-md-3">
            <label class="form-label fw-semibold mb-1" style="font-size:.8rem">Kategori</label>
            <select name="jenis" class="form-select">
                <option value="">Semua Kategori</option>
                @foreach(App\Models\AsetDesa::$jenisOptions as $j)
                <option value="{{ $j }}" {{ request('jenis') === $j ? 'selected' : '' }}>{{ $j }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <label class="form-label fw-semibold mb-1" style="font-size:.8rem">Kondisi</label>
            <select name="kondisi" class="form-select">
                <option value="">Semua Kondisi</option>
                @foreach(App\Models\AsetDesa::$kondisiOptions as $k)
                <option value="{{ $k }}" {{ request('kondisi') === $k ? 'selected' : '' }}>{{ $k }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3 d-flex gap-2">
            <button type="submit" class="btn btn-desa-navy flex-fill">
                <i class="fas fa-filter me-1"></i>Filter
            </button>
            @if(request('search') || request('jenis') || request('kondisi'))
            <a href="{{ route('admin.aset.index') }}" class="btn btn-outline-secondary" title="Reset filter">
                <i class="fas fa-times"></i>
            </a>
            @endif
            <a href="{{ route('admin.aset.create') }}" class="btn btn-outline-success" title="Tambah Aset">
                <i class="fas fa-plus"></i>
            </a>
        </div>
    </form>
    @if(request('search') || request('jenis') || request('kondisi'))
    <div class="mt-2 d-flex gap-2 flex-wrap">
        @if(request('search'))
        <span class="badge bg-light text-dark border">
            <i class="fas fa-search me-1 text-muted" style="font-size:.7rem"></i>{{ request('search') }}
        </span>
        @endif
        @if(request('jenis'))
        <span class="badge bg-light text-dark border">
            <i class="fas fa-tag me-1 text-muted" style="font-size:.7rem"></i>{{ request('jenis') }}
        </span>
        @endif
        @if(request('kondisi'))
        <span class="badge bg-light text-dark border">
            <i class="fas fa-circle me-1 text-muted" style="font-size:.7rem"></i>{{ request('kondisi') }}
        </span>
        @endif
        <span class="text-muted" style="font-size:.8rem">— {{ $asets->total() }} aset ditemukan</span>
    </div>
    @endif
</div>

<div class="card border-0 shadow-sm rounded-3">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0 small">
            <thead class="table-light">
                <tr>
                    <th class="ps-3" style="width:40px;">#</th>
                    <th>Nama Aset</th>
                    <th>Jenis</th>
                    <th>Kondisi</th>
                    <th>Lokasi</th>
                    <th>Luas / Nilai</th>
                    <th>Tahun</th>
                    <th class="text-center" style="width:100px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($asets as $aset)
                <tr>
                    <td class="ps-3 text-muted">{{ $asets->firstItem() + $loop->index }}</td>
                    <td>
                        <div class="fw-semibold">{{ $aset->nama }}</div>
                        @if($aset->keterangan)
                            <small class="text-muted">{{ Str::limit($aset->keterangan, 55) }}</small>
                        @endif
                    </td>
                    <td>
                        @php $cfg = $jenisConfig[$aset->jenis] ?? ['icon'=>'fa-box','color'=>'#666']; @endphp
                        <span class="badge bg-light text-dark border">
                            <i class="fas {{ $cfg['icon'] }} me-1" style="color:{{ $cfg['color'] }};"></i>{{ $aset->jenis }}
                        </span>
                    </td>
                    <td>
                        @php
                        $kondisiClass = match($aset->kondisi) {
                            'Baik'         => 'bg-success',
                            'Rusak Ringan' => 'bg-warning text-dark',
                            'Rusak Sedang' => 'bg-orange',
                            'Rusak Berat'  => 'bg-danger',
                            default        => 'bg-secondary',
                        };
                        @endphp
                        <span class="badge {{ $kondisiClass }}">{{ $aset->kondisi }}</span>
                    </td>
                    <td class="text-muted">{{ $aset->lokasi ?? '-' }}</td>
                    <td>
                        @if($aset->luas)
                            <div>{{ number_format($aset->luas, 0, ',', '.') }} m²</div>
                        @endif
                        @if($aset->nilai_perolehan)
                            <div class="text-muted">Rp {{ number_format($aset->nilai_perolehan, 0, ',', '.') }}</div>
                        @endif
                        @if(!$aset->luas && !$aset->nilai_perolehan)
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td class="text-muted">{{ $aset->tahun_perolehan ?? '-' }}</td>
                    <td class="text-center">
                        <a href="{{ route('admin.aset.edit', $aset) }}"
                           class="btn btn-sm btn-outline-primary rounded-pill px-2 me-1">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.aset.destroy', $aset) }}" method="POST"
                              class="d-inline" onsubmit="return confirm('Hapus aset ini?');">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger rounded-pill px-2">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted py-5">
                        <i class="fas fa-box fa-2x opacity-25 mb-2 d-block"></i>
                        Belum ada data aset. <a href="{{ route('admin.aset.create') }}">Tambah sekarang</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($asets->hasPages())
    <div class="card-footer bg-white border-0 py-3 d-flex justify-content-center">
        {{ $asets->links() }}
    </div>
    @endif
</div>

@endsection
