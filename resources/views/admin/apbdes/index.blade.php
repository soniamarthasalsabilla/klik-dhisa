@extends('layouts.admin')
@section('title', 'Kelola APBDes')
@section('page-title', 'APBDes')
@section('breadcrumb', 'Anggaran Pendapatan & Belanja Desa')

@section('content')
{{-- Filter Tahun --}}
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <form class="d-flex gap-2 align-items-center">
        <label class="fw-semibold mb-0">Tahun:</label>
        <select name="tahun" class="form-select form-select-sm" style="width:120px;" onchange="this.form.submit()">
            @foreach($tahunList as $t)
                <option value="{{ $t }}" {{ $t == $tahun ? 'selected' : '' }}>{{ $t }}</option>
            @endforeach
            <option value="{{ date('Y') }}" {{ !in_array(date('Y'), $tahunList->toArray()) ? 'selected' : '' }}>{{ date('Y') }} (Baru)</option>
        </select>
    </form>
    <a href="{{ route('admin.apbdes.create') }}" class="btn btn-desa-navy">
        <i class="fas fa-plus me-1"></i> Tambah Item
    </a>
</div>

{{-- Ringkasan --}}
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-3 p-3" style="border-left:5px solid #0d6efd!important;">
            <small class="text-muted fw-bold text-uppercase">Total Pendapatan</small>
            <h4 class="fw-bold text-primary mt-1 mb-0">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h4>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-3 p-3" style="border-left:5px solid #198754!important;">
            <small class="text-muted fw-bold text-uppercase">Total Anggaran Belanja</small>
            <h4 class="fw-bold text-success mt-1 mb-0">Rp {{ number_format($totalAnggaran, 0, ',', '.') }}</h4>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-3 p-3" style="border-left:5px solid #ffc107!important;">
            <small class="text-muted fw-bold text-uppercase">Total Realisasi</small>
            <h4 class="fw-bold text-warning mt-1 mb-0">Rp {{ number_format($totalRealisasi, 0, ',', '.') }}</h4>
            @if($totalAnggaran > 0)
            <small class="text-muted">{{ round(($totalRealisasi/$totalAnggaran)*100,1) }}% terealisasi</small>
            @endif
        </div>
    </div>
</div>

{{-- Tabel --}}
<div class="card border-0 shadow-sm rounded-3">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Jenis</th>
                    <th>Bidang / Kegiatan</th>
                    <th class="text-end">Anggaran (Rp)</th>
                    <th class="text-end">Realisasi (Rp)</th>
                    <th class="text-center">%</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                <tr>
                    <td>
                        <span class="badge {{ $item->jenis === 'pendapatan' ? 'bg-primary' : 'bg-success' }}">
                            {{ ucfirst($item->jenis) }}
                        </span>
                    </td>
                    <td>
                        <p class="fw-semibold mb-0">{{ $item->bidang }}</p>
                        @if($item->kegiatan)<small class="text-muted">{{ $item->kegiatan }}</small>@endif
                    </td>
                    <td class="text-end">{{ number_format($item->anggaran, 0, ',', '.') }}</td>
                    <td class="text-end">{{ number_format($item->realisasi, 0, ',', '.') }}</td>
                    <td class="text-center">
                        @php $pct = $item->persentase; @endphp
                        <span class="badge {{ $pct >= 75 ? 'bg-success' : ($pct >= 50 ? 'bg-warning text-dark' : 'bg-danger') }}">
                            {{ $pct }}%
                        </span>
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.apbdes.edit', $item) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.apbdes.destroy', $item) }}"
                                  onsubmit="return confirm('Hapus data ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted py-4">Belum ada data APBDes untuk tahun {{ $tahun }}.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
