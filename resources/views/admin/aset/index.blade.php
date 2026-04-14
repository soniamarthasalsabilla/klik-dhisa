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

{{-- Filter & Tambah --}}
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <div class="d-flex gap-2 flex-wrap">
        <a href="{{ route('admin.aset.index') }}"
           class="btn btn-sm {{ !request('jenis') ? 'btn-desa-navy' : 'btn-outline-secondary' }} rounded-pill">
            Semua
        </a>
        @foreach(App\Models\AsetDesa::$jenisOptions as $j)
        <a href="{{ route('admin.aset.index', ['jenis' => $j]) }}"
           class="btn btn-sm {{ request('jenis') === $j ? 'btn-desa-navy' : 'btn-outline-secondary' }} rounded-pill">
            {{ $j }}
        </a>
        @endforeach
    </div>
    <a href="{{ route('admin.aset.create') }}" class="btn btn-desa-navy">
        <i class="fas fa-plus me-2"></i>Tambah Aset
    </a>
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
