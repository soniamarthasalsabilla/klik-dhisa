@extends('layouts.app')

@push('styles')
<style>
    .stat-nav .nav-link {
        color: var(--color-6);
        background: white;
        border: 1px solid var(--color-2);
        border-radius: 12px;
        transition: .25s;
        font-size: .87rem;
    }
    .stat-nav .nav-link:hover { background: var(--color-1); border-color: var(--color-4); }
    .stat-nav .nav-link.active {
        background: var(--color-6) !important;
        color: white !important;
        border-color: var(--color-6) !important;
        transform: translateX(4px);
    }
    .stat-nav .nav-link i { color: var(--color-4); }
    .stat-nav .nav-link.active i { color: #fff; }
</style>
@endpush

@section('content')

<section class="py-3" style="background: white; border-bottom: 3px solid var(--color-5);">
    <div class="container text-center py-4">
        <h2 class="fw-bold mb-2" style="color: var(--color-7); font-size: 2rem;">
            <i class="fas fa-home me-2" style="color:var(--color-5);"></i>Statistik Keluarga
        </h2>
        <p class="mb-0" style="color: var(--color-6); font-size: 1rem;">Data terintegrasi Pemerintah Desa Tajungan</p>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">
        <div class="row">

            <div class="col-lg-3 mb-4">
                <div class="card border-0 shadow-sm rounded-4 p-3 sticky-top" style="top: 90px;">
                    <h6 class="fw-bold mb-3 px-2 text-muted" style="font-size:.7rem;text-transform:uppercase;letter-spacing:1px;">Pilih Kategori</h6>
                    <div class="nav flex-column nav-pills stat-nav gap-1" id="v-pills-tab" role="tablist">
                        <button class="nav-link active text-start py-3" data-bs-toggle="pill" data-bs-target="#content-kk" type="button">
                            <i class="fas fa-user-tie me-2"></i> Kepala Keluarga
                        </button>
                        <button class="nav-link text-start py-3" data-bs-toggle="pill" data-bs-target="#content-kesejahteraan" type="button">
                            <i class="fas fa-chart-line me-2"></i> Tingkat Kesejahteraan
                        </button>
                        <button class="nav-link text-start py-3" data-bs-toggle="pill" data-bs-target="#content-jaminan" type="button">
                            <i class="fas fa-shield-alt me-2"></i> Jaminan Kesehatan
                        </button>
                    </div>

                    <hr class="my-3">
                    <div class="row g-2 text-center px-1">
                        <div class="col-12">
                            <div class="rounded-3 py-2" style="background:var(--color-1);">
                                <div class="fw-bold" style="color:var(--color-6);font-size:1.15rem;">{{ number_format($totalKK) }}</div>
                                <div style="font-size:.62rem;color:var(--color-5);text-transform:uppercase;font-weight:600;">Total KK</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Konten --}}
            <div class="col-lg-9">
                <div class="tab-content" id="v-pills-tabContent">

                    {{-- Kepala Keluarga --}}
                    <div class="tab-pane fade show active" id="content-kk">
                        <div class="card border-0 shadow-sm rounded-4 p-4">
                            <h4 class="fw-bold mb-1" style="color:var(--color-7);">Kepala Keluarga</h4>
                            <p class="text-muted small mb-4">Distribusi kepala keluarga di Desa Tajungan</p>
                            <div id="chart-kk" class="mb-4"></div>
                            <h6 class="fw-bold mt-2 mb-3" style="color:var(--color-7);">Tabel Kepala Keluarga</h6>
                            @php $totalKKData = $kk->sum('jumlah'); @endphp
                            <div class="table-responsive">
                                <table class="table table-bordered align-middle text-center small">
                                    <thead style="background:var(--color-1);">
                                        <tr>
                                            <th>No</th>
                                            <th class="text-start">Kategori</th>
                                            <th>Jumlah (KK)</th>
                                            <th>Persentase (%)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($kk as $i => $row)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td class="text-start px-3">{{ $row->label }}</td>
                                            <td class="fw-bold" style="color:var(--color-6);">{{ number_format($row->jumlah) }}</td>
                                            <td>{{ $totalKKData > 0 ? round(($row->jumlah / $totalKKData) * 100, 1) : 0 }}%</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot style="background:var(--color-1);font-weight:700;">
                                        <tr>
                                            <td colspan="2" class="text-start px-3">TOTAL</td>
                                            <td style="color:var(--color-6);">{{ number_format($totalKKData) }}</td>
                                            <td>100%</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- Kesejahteraan --}}
                    <div class="tab-pane fade" id="content-kesejahteraan">
                        <div class="card border-0 shadow-sm rounded-4 p-4">
                            <h4 class="fw-bold mb-1" style="color:var(--color-7);">Klasifikasi Tingkat Kesejahteraan</h4>
                            <p class="text-muted small mb-4">Distribusi keluarga berdasarkan tahapan kesejahteraan</p>
                            <div id="chart-kesejahteraan" class="mb-4"></div>
                            <h6 class="fw-bold mt-2 mb-3" style="color:var(--color-7);">Tabel Tingkat Kesejahteraan</h6>
                            @php $totalSejahtera = $kesejahteraan->sum('jumlah'); @endphp
                            <div class="table-responsive">
                                <table class="table table-bordered align-middle text-center small">
                                    <thead style="background:var(--color-1);">
                                        <tr>
                                            <th>No</th>
                                            <th class="text-start">Kategori Kesejahteraan</th>
                                            <th>Jumlah (KK)</th>
                                            <th>Persentase (%)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($kesejahteraan as $i => $row)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td class="text-start px-3">{{ $row->label }}</td>
                                            <td class="fw-bold" style="color:var(--color-6);">{{ number_format($row->jumlah) }}</td>
                                            <td>{{ $totalSejahtera > 0 ? round(($row->jumlah / $totalSejahtera) * 100, 1) : 0 }}%</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot style="background:var(--color-1);font-weight:700;">
                                        <tr>
                                            <td colspan="2" class="text-start px-3">TOTAL</td>
                                            <td style="color:var(--color-6);">{{ number_format($totalSejahtera) }}</td>
                                            <td>100%</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- Jaminan Kesehatan --}}
                    <div class="tab-pane fade" id="content-jaminan">
                        <div class="card border-0 shadow-sm rounded-4 p-4">
                            <h4 class="fw-bold mb-1" style="color:var(--color-7);">Kepemilikan Jaminan Kesehatan (BPJS/KIS)</h4>
                            <p class="text-muted small mb-4">Distribusi keluarga berdasarkan kepemilikan jaminan kesehatan</p>
                            <div id="chart-jaminan" class="mb-4"></div>
                            <h6 class="fw-bold mt-2 mb-3" style="color:var(--color-7);">Tabel Jaminan Kesehatan</h6>
                            @php $totalJaminan = $jaminan->sum('jumlah'); @endphp
                            <div class="table-responsive">
                                <table class="table table-bordered align-middle text-center small">
                                    <thead style="background:var(--color-1);">
                                        <tr>
                                            <th>No</th>
                                            <th class="text-start">Status Jaminan Kesehatan</th>
                                            <th>Jumlah (KK)</th>
                                            <th>Persentase (%)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($jaminan as $i => $row)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td class="text-start px-3">{{ $row->label }}</td>
                                            <td class="fw-bold" style="color:var(--color-6);">{{ number_format($row->jumlah) }}</td>
                                            <td>{{ $totalJaminan > 0 ? round(($row->jumlah / $totalJaminan) * 100, 1) : 0 }}%</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot style="background:var(--color-1);font-weight:700;">
                                        <tr>
                                            <td colspan="2" class="text-start px-3">TOTAL</td>
                                            <td style="color:var(--color-6);">{{ number_format($totalJaminan) }}</td>
                                            <td>100%</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
var c1 = '#3A9A8C', c2 = '#5BBFAB', c3 = '#8FD4C2', c4 = '#f9d923', c5 = '#1E5A52', c6 = '#2C7A6F';
var palette = [c5, c1, c2, c3, c4, '#6c757d', '#fd7e14'];

// Kepala Keluarga
var kkLabels = @json($kk->pluck('label'));
var kkData   = @json($kk->pluck('jumlah'));
new ApexCharts(document.querySelector("#chart-kk"), {
    series: kkData,
    chart: { type: 'donut', height: 320 },
    labels: kkLabels,
    colors: [c1, c4],
    legend: { position: 'bottom' },
    plotOptions: { pie: { donut: { size: '65%', labels: { show: true, total: { show: true, label: 'Total KK', color: c6 } } } } },
    dataLabels: { enabled: true },
    tooltip: { y: { formatter: v => v.toLocaleString('id-ID') + ' KK' } },
}).render();

// Kesejahteraan
var sejahteraLabels = @json($kesejahteraan->pluck('label'));
var sejahteraData   = @json($kesejahteraan->pluck('jumlah'));
new ApexCharts(document.querySelector("#chart-kesejahteraan"), {
    series: [{ name: 'Jumlah KK', data: sejahteraData }],
    chart: { type: 'bar', height: 320, toolbar: { show: false } },
    xaxis: { categories: sejahteraLabels },
    plotOptions: { bar: { borderRadius: 6, columnWidth: '45%', distributed: true } },
    colors: palette.slice(0, sejahteraLabels.length),
    dataLabels: { enabled: true, style: { colors: ['#fff'] } },
    legend: { show: false },
    tooltip: { y: { formatter: v => v.toLocaleString('id-ID') + ' KK' } },
}).render();

// Jaminan Kesehatan
var jaminanLabels = @json($jaminan->pluck('label'));
var jaminanData   = @json($jaminan->pluck('jumlah'));
new ApexCharts(document.querySelector("#chart-jaminan"), {
    series: jaminanData,
    chart: { type: 'pie', height: 320 },
    labels: jaminanLabels,
    colors: palette.slice(0, jaminanLabels.length),
    legend: { position: 'bottom' },
    dataLabels: { enabled: true },
    tooltip: { y: { formatter: v => v.toLocaleString('id-ID') + ' KK' } },
}).render();
</script>
@endpush
