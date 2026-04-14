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

    .summary-card {
        background: white; border-radius: 14px;
        border: 1px solid var(--color-2);
        border-left: 5px solid transparent;
        padding: 20px 22px;
        box-shadow: 0 2px 10px rgba(0,0,0,.05);
    }
    .summary-card .lbl { font-size: .72rem; font-weight: 700; text-transform: uppercase; letter-spacing: .5px; color: #6c757d; }
    .summary-card .amount { font-size: 1.4rem; font-weight: 800; line-height: 1.2; margin: 4px 0; }
    .summary-card .pct { font-size: .78rem; color: #6c757d; }

    .apb-table thead th {
        background: var(--color-1); color: var(--color-7);
        font-size: .75rem; font-weight: 700; text-transform: uppercase;
        letter-spacing: .4px; padding: 10px 14px; border-bottom: 2px solid var(--color-2);
    }
    .apb-table tbody td { font-size: .84rem; padding: 10px 14px; vertical-align: middle; }
    .apb-table tbody tr:hover { background: var(--color-1); }
    .apb-table tfoot td {
        font-weight: 700; font-size: .84rem;
        background: var(--color-1); border-top: 2px solid var(--color-2);
        padding: 10px 14px;
    }

    .jenis-pendapatan { border-left: 3px solid #0d6efd; }
    .jenis-belanja    { border-left: 3px solid var(--color-5); }

    .progress-bar-teal { background: var(--color-5); }
</style>
@endpush

@section('content')

{{-- Hero --}}
<section class="py-3" style="background: white; border-bottom: 3px solid var(--color-5);">
    <div class="container text-center py-4">
        <h2 class="fw-bold mb-2" style="color: var(--color-7); font-size: 2rem;">
            <i class="fas fa-chart-pie me-2" style="color:var(--color-5);"></i>Transparansi Anggaran
        </h2>
        <p class="mb-0" style="color: var(--color-6); font-size: 1rem;">Laporan Anggaran Pendapatan dan Belanja Desa (APBDes)</p>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">

        {{-- Filter Tahun --}}
        <div class="d-flex align-items-center gap-3 mb-4 flex-wrap">
            <span class="fw-semibold" style="color:var(--color-7);font-size:.88rem;">Tahun Anggaran:</span>
            @if($tahunList->isNotEmpty())
                @foreach($tahunList as $t)
                <a href="{{ route('transparansi.anggaran', ['tahun'=>$t]) }}"
                   class="filter-pill {{ $t==$tahun ? 'active' : '' }}">{{ $t }}</a>
                @endforeach
            @else
                <span class="text-muted small">Data belum tersedia</span>
            @endif
        </div>

        @if($items->isEmpty())
        <div class="text-center py-5" style="color:#adb5bd;">
            <i class="fas fa-file-invoice-dollar fa-4x mb-3 opacity-25 d-block"></i>
            <p class="mb-0 fw-semibold">Data APBDes tahun {{ $tahun }} belum tersedia.</p>
        </div>
        @else

        {{-- Ringkasan --}}
        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="summary-card" style="border-left-color:#0d6efd;">
                    <div class="lbl">Total Pendapatan</div>
                    <div class="amount" style="color:#0d6efd;">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
                    <div class="progress mt-2" style="height:6px;border-radius:10px;">
                        <div class="progress-bar" style="width:100%;background:#0d6efd;border-radius:10px;"></div>
                    </div>
                    <div class="pct mt-1">Target Pendapatan {{ $tahun }}</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="summary-card" style="border-left-color:var(--color-5);">
                    <div class="lbl">Realisasi Belanja</div>
                    <div class="amount" style="color:var(--color-5);">Rp {{ number_format($totalRealisasi, 0, ',', '.') }}</div>
                    <div class="progress mt-2" style="height:6px;border-radius:10px;background:#e9ecef;">
                        <div class="progress-bar progress-bar-teal" style="width:{{ min($pctRealisasi,100) }}%;border-radius:10px;"></div>
                    </div>
                    <div class="pct mt-1">{{ $pctRealisasi }}% dari anggaran belanja</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="summary-card" style="border-left-color:var(--gold,#f9d923);">
                    <div class="lbl">Sisa Anggaran (SiLPA)</div>
                    @php $siLPApos = max(0, $silpa); @endphp
                    <div class="amount" style="color:var(--color-7);">Rp {{ number_format($siLPApos, 0, ',', '.') }}</div>
                    <div class="progress mt-2" style="height:6px;border-radius:10px;background:#e9ecef;">
                        @php $pctSilpa = $totalPendapatan > 0 ? round(($siLPApos/$totalPendapatan)*100,1) : 0; @endphp
                        <div class="progress-bar" style="width:{{ min($pctSilpa,100) }}%;background:#f9d923;border-radius:10px;"></div>
                    </div>
                    <div class="pct mt-1">{{ $pctSilpa }}% dari total pendapatan</div>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-4">
            {{-- Grafik Distribusi Belanja --}}
            @if($belanja->isNotEmpty())
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-header bg-white border-0 pt-3 pb-0 px-4">
                        <h6 class="fw-bold mb-0" style="color:var(--color-7);">
                            <i class="fas fa-chart-donut me-2" style="color:var(--color-5);"></i>Distribusi Belanja
                        </h6>
                    </div>
                    <div class="card-body p-3">
                        <canvas id="apbdesChart" style="max-height:260px;"></canvas>
                    </div>
                </div>
            </div>
            @endif

            {{-- Tabel Rincian --}}
            <div class="col-lg-{{ $belanja->isNotEmpty() ? '7' : '12' }}">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-header bg-white border-0 pt-3 pb-0 px-4">
                        <h6 class="fw-bold mb-0" style="color:var(--color-7);">
                            <i class="fas fa-table me-2" style="color:var(--color-5);"></i>Rincian Anggaran {{ $tahun }}
                        </h6>
                    </div>
                    <div class="table-responsive mt-2">
                        <table class="table apb-table mb-0">
                            <thead>
                                <tr>
                                    <th>Bidang / Kegiatan</th>
                                    <th>Jenis</th>
                                    <th class="text-end">Anggaran (Rp)</th>
                                    <th class="text-end">Realisasi (Rp)</th>
                                    <th class="text-center">%</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($items->sortBy('jenis') as $item)
                                <tr class="{{ $item->jenis==='pendapatan' ? 'jenis-pendapatan' : 'jenis-belanja' }}">
                                    <td>
                                        <div class="fw-semibold" style="color:var(--color-7);">{{ $item->bidang }}</div>
                                        @if($item->kegiatan)<small class="text-muted">{{ $item->kegiatan }}</small>@endif
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill"
                                              style="background:{{ $item->jenis==='pendapatan' ? '#cfe2ff' : '#E8F5F0' }};
                                                     color:{{ $item->jenis==='pendapatan' ? '#0d6efd' : 'var(--color-7)' }};
                                                     font-size:.65rem;">
                                            {{ ucfirst($item->jenis) }}
                                        </span>
                                    </td>
                                    <td class="text-end">{{ number_format($item->anggaran, 0, ',', '.') }}</td>
                                    <td class="text-end">{{ number_format($item->realisasi, 0, ',', '.') }}</td>
                                    <td class="text-center">
                                        @php $pct = $item->persentase; @endphp
                                        <span class="badge rounded-pill"
                                              style="background:{{ $pct>=75?'#d1e7dd':($pct>=50?'#fff3cd':'#f8d7da') }};
                                                     color:{{ $pct>=75?'#146c43':($pct>=50?'#664d03':'#842029') }};
                                                     font-size:.7rem;">
                                            {{ $pct }}%
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2" style="color:var(--color-7);">Total Anggaran</td>
                                    <td class="text-end" style="color:var(--color-7);">{{ number_format($totalAnggaran + $totalPendapatan, 0, ',', '.') }}</td>
                                    <td class="text-end" style="color:var(--color-5);">{{ number_format($totalRealisasi, 0, ',', '.') }}</td>
                                    <td class="text-center" style="color:var(--color-5);">{{ $pctRealisasi }}%</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Footer Note --}}
        <div class="p-3 rounded-3 d-flex align-items-start gap-3" style="background:var(--color-1);border:1px solid var(--color-2);">
            <i class="fas fa-info-circle mt-1" style="color:var(--color-5);"></i>
            <small style="color:var(--color-6);line-height:1.6;">
                Data diperbarui secara berkala sesuai laporan realisasi Bendahara Desa Tajungan. Tahun Anggaran {{ $tahun }}.
                Untuk pertanyaan, hubungi Kaur Keuangan Desa Tajungan.
            </small>
        </div>

        @endif
    </div>
</section>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@if($belanja->isNotEmpty())
<script>
var tealColors = ['#1E5A52','#3A9A8C','#5BBFAB','#8FD4C2','#B5E3DA','#0d6efd','#6f42c1','#fd7e14'];
new Chart(document.getElementById('apbdesChart').getContext('2d'), {
    type: 'doughnut',
    data: {
        labels: {!! $chartLabels !!},
        datasets: [{
            data: {!! $chartData !!},
            backgroundColor: tealColors,
            borderWidth: 2,
            borderColor: '#fff'
        }]
    },
    options: {
        responsive: true,
        cutout: '60%',
        plugins: {
            legend: { position: 'bottom', labels: { font: { size: 11, family: 'Poppins' }, padding: 10 } },
            tooltip: {
                callbacks: {
                    label: function(ctx) {
                        var val = ctx.raw;
                        return ' Rp ' + val.toLocaleString('id-ID');
                    }
                }
            }
        }
    }
});
</script>
@endif
@endpush

@endsection
