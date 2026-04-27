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

{{-- Hero --}}
<section class="py-3" style="background: white; border-bottom: 3px solid var(--color-5);">
    <div class="container text-center py-4">
        <h2 class="fw-bold mb-2" style="color: var(--color-7); font-size: 2rem;">
            <i class="fas fa-building me-2" style="color:var(--color-5);"></i>Statistik Fasilitas Umum
        </h2>
        <p class="mb-0" style="color: var(--color-6); font-size: 1rem;">Data Fasilitas Umum Desa Tajungan · Tahun 2026</p>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">
        <div class="row">

            {{-- Sidebar --}}
            <div class="col-lg-3 mb-4">
                <div class="card border-0 shadow-sm rounded-4 p-3 sticky-top" style="top: 90px;">
                    <h6 class="fw-bold mb-3 px-2 text-muted" style="font-size:.7rem;text-transform:uppercase;letter-spacing:1px;">Jenis Fasilitas</h6>
                    <div class="nav flex-column nav-pills stat-nav gap-1" role="tablist">
                        <button class="nav-link active text-start py-3" data-bs-toggle="pill" data-bs-target="#content-ibadah" type="button">
                            <i class="fas fa-mosque me-2"></i> Tempat Ibadah
                        </button>
                        <button class="nav-link text-start py-3" data-bs-toggle="pill" data-bs-target="#content-pendidikan" type="button">
                            <i class="fas fa-school me-2"></i> Pendidikan
                        </button>
                        <button class="nav-link text-start py-3" data-bs-toggle="pill" data-bs-target="#content-kesehatan" type="button">
                            <i class="fas fa-clinic-medical me-2"></i> Kesehatan
                        </button>
                        <button class="nav-link text-start py-3" data-bs-toggle="pill" data-bs-target="#content-olahraga" type="button">
                            <i class="fas fa-running me-2"></i> Sarana Olahraga
                        </button>
                    </div>

                    <hr class="my-3">
                    <div class="row g-2 text-center px-1">
                        <div class="col-6">
                            <div class="rounded-3 py-2" style="background:var(--color-1);">
                                <div class="fw-bold" style="color:var(--color-6);font-size:1.1rem;">{{ $ibadah->sum('jumlah') }}</div>
                                <div style="font-size:.6rem;color:var(--color-5);text-transform:uppercase;font-weight:600;">Ibadah</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="rounded-3 py-2" style="background:var(--color-1);">
                                <div class="fw-bold" style="color:var(--color-6);font-size:1.1rem;">{{ $pendidikan->sum('jumlah') }}</div>
                                <div style="font-size:.6rem;color:var(--color-5);text-transform:uppercase;font-weight:600;">Pendidikan</div>
                            </div>
                        </div>
                        <div class="col-6 mt-1">
                            <div class="rounded-3 py-2" style="background:var(--color-1);">
                                <div class="fw-bold" style="color:var(--color-6);font-size:1.1rem;">{{ $kesehatan->sum('jumlah') }}</div>
                                <div style="font-size:.6rem;color:var(--color-5);text-transform:uppercase;font-weight:600;">Kesehatan</div>
                            </div>
                        </div>
                        <div class="col-6 mt-1">
                            <div class="rounded-3 py-2" style="background:var(--color-1);">
                                <div class="fw-bold" style="color:var(--color-6);font-size:1.1rem;">{{ $olahraga->sum('jumlah') }}</div>
                                <div style="font-size:.6rem;color:var(--color-5);text-transform:uppercase;font-weight:600;">Olahraga</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Konten --}}
            <div class="col-lg-9">
                <div class="tab-content">

                    {{-- ===== TEMPAT IBADAH ===== --}}
                    <div class="tab-pane fade show active" id="content-ibadah">
                        <div class="card border-0 shadow-sm rounded-4 p-4">
                            <div class="d-flex justify-content-between align-items-start mb-1">
                                <h4 class="fw-bold mb-0" style="color:var(--color-7);">Tempat Ibadah</h4>
                                <span class="badge rounded-pill px-3" style="background:var(--color-5);">{{ $ibadah->sum('jumlah') }} Unit</span>
                            </div>
                            <p class="text-muted small mb-4">Sarana ibadah yang tersedia di Desa Tajungan untuk mendukung kehidupan keagamaan warga.</p>

                            <div id="chart-ibadah" class="mb-4"></div>

                            <div class="table-responsive">
                                <table class="table table-bordered align-middle text-center small">
                                    <thead style="background:var(--color-1);">
                                        <tr>
                                            <th>No</th>
                                            <th class="text-start">Jenis</th>
                                            <th>Jumlah (Unit)</th>
                                            <th>Persentase</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $totalIbadah = $ibadah->sum('jumlah'); @endphp
                                        @foreach($ibadah as $i => $row)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td class="text-start px-3">{{ $row->label }}</td>
                                            <td class="fw-bold" style="color:var(--color-6);">{{ number_format($row->jumlah) }}</td>
                                            <td>{{ $totalIbadah > 0 ? round(($row->jumlah / $totalIbadah) * 100, 1) : 0 }}%</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot style="background:var(--color-1);font-weight:700;">
                                        <tr>
                                            <td colspan="2" class="text-start px-3">TOTAL</td>
                                            <td style="color:var(--color-6);">{{ number_format($totalIbadah) }}</td>
                                            <td>100%</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- ===== PENDIDIKAN ===== --}}
                    <div class="tab-pane fade" id="content-pendidikan">
                        <div class="card border-0 shadow-sm rounded-4 p-4">
                            <div class="d-flex justify-content-between align-items-start mb-1">
                                <h4 class="fw-bold mb-0" style="color:var(--color-7);">Fasilitas Pendidikan</h4>
                                <span class="badge rounded-pill px-3" style="background:var(--color-5);">{{ $pendidikan->sum('jumlah') }} Unit</span>
                            </div>
                            <p class="text-muted small mb-4">Lembaga pendidikan formal dan non-formal yang ada di Desa Tajungan.</p>

                            <div id="chart-pendidikan" class="mb-4"></div>

                            <div class="row g-3">
                                @foreach($pendidikan as $row)
                                <div class="col-md-6">
                                    <div class="card border-0 rounded-3 text-center py-3 px-2" style="background:var(--color-1);">
                                        <div class="fw-bold" style="color:var(--color-6);font-size:1.8rem;">{{ $row->jumlah }}</div>
                                        <div class="small fw-semibold" style="color:var(--color-7);">{{ $row->label }}</div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- ===== KESEHATAN ===== --}}
                    <div class="tab-pane fade" id="content-kesehatan">
                        <div class="card border-0 shadow-sm rounded-4 p-4">
                            <div class="d-flex justify-content-between align-items-start mb-1">
                                <h4 class="fw-bold mb-0" style="color:var(--color-7);">Fasilitas Kesehatan</h4>
                                <span class="badge rounded-pill px-3" style="background:var(--color-5);">{{ $kesehatan->sum('jumlah') }} Unit</span>
                            </div>
                            <p class="text-muted small mb-4">Sarana kesehatan yang melayani warga Desa Tajungan.</p>

                            <div id="chart-kesehatan" class="mb-4"></div>

                            <div class="table-responsive">
                                <table class="table table-bordered align-middle text-center small">
                                    <thead style="background:var(--color-1);">
                                        <tr>
                                            <th>No</th>
                                            <th class="text-start">Jenis</th>
                                            <th>Jumlah (Unit)</th>
                                            <th>Persentase</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $totalKesehatan = $kesehatan->sum('jumlah'); @endphp
                                        @foreach($kesehatan as $i => $row)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td class="text-start px-3">{{ $row->label }}</td>
                                            <td class="fw-bold" style="color:var(--color-6);">{{ number_format($row->jumlah) }}</td>
                                            <td>{{ $totalKesehatan > 0 ? round(($row->jumlah / $totalKesehatan) * 100, 1) : 0 }}%</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot style="background:var(--color-1);font-weight:700;">
                                        <tr>
                                            <td colspan="2" class="text-start px-3">TOTAL</td>
                                            <td style="color:var(--color-6);">{{ number_format($totalKesehatan) }}</td>
                                            <td>100%</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- ===== SARANA OLAHRAGA ===== --}}
                    <div class="tab-pane fade" id="content-olahraga">
                        <div class="card border-0 shadow-sm rounded-4 p-4">
                            <div class="d-flex justify-content-between align-items-start mb-1">
                                <h4 class="fw-bold mb-0" style="color:var(--color-7);">Sarana Olahraga</h4>
                                <span class="badge rounded-pill px-3" style="background:var(--color-5);">{{ $olahraga->sum('jumlah') }} Unit</span>
                            </div>
                            <p class="text-muted small mb-4">Fasilitas olahraga dan rekreasi yang tersedia untuk warga Desa Tajungan.</p>

                            <div id="chart-olahraga" class="mb-4"></div>

                            <div class="row g-3">
                                @foreach($olahraga as $row)
                                <div class="col-md-4">
                                    <div class="card border-0 rounded-3 text-center py-3 px-2" style="background:var(--color-1);">
                                        <div class="fw-bold" style="color:var(--color-6);font-size:1.8rem;">{{ $row->jumlah }}</div>
                                        <div class="small fw-semibold" style="color:var(--color-7);">{{ $row->label }}</div>
                                    </div>
                                </div>
                                @endforeach
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

new ApexCharts(document.querySelector("#chart-ibadah"), {
    series: @json($ibadah->pluck('jumlah')),
    chart: { type: 'donut', height: 260 },
    labels: @json($ibadah->pluck('label')),
    colors: [c5, c1, c2, c4],
    legend: { position: 'bottom' },
    plotOptions: { pie: { donut: { size: '65%', labels: { show: true, total: { show: true, label: 'Total', color: c6 } } } } },
    dataLabels: { enabled: true },
}).render();

new ApexCharts(document.querySelector("#chart-pendidikan"), {
    series: [{ name: 'Unit', data: @json($pendidikan->pluck('jumlah')) }],
    chart: { type: 'bar', height: 240, toolbar: { show: false } },
    plotOptions: { bar: { borderRadius: 6, distributed: true } },
    colors: [c5, c1, c2, c4],
    xaxis: { categories: @json($pendidikan->pluck('label')) },
    dataLabels: { enabled: true, style: { colors: ['#fff'] } },
    legend: { show: false },
    tooltip: { y: { formatter: v => v + ' unit' } },
}).render();

new ApexCharts(document.querySelector("#chart-kesehatan"), {
    series: @json($kesehatan->pluck('jumlah')),
    chart: { type: 'donut', height: 260 },
    labels: @json($kesehatan->pluck('label')),
    colors: ['#198754', c1, c4],
    legend: { position: 'bottom' },
    plotOptions: { pie: { donut: { size: '65%', labels: { show: true, total: { show: true, label: 'Total', color: c6 } } } } },
    dataLabels: { enabled: true },
}).render();

new ApexCharts(document.querySelector("#chart-olahraga"), {
    series: [{ name: 'Unit', data: @json($olahraga->pluck('jumlah')) }],
    chart: { type: 'bar', height: 240, toolbar: { show: false } },
    plotOptions: { bar: { borderRadius: 6, distributed: true } },
    colors: [c5, c1, c2],
    xaxis: { categories: @json($olahraga->pluck('label')) },
    dataLabels: { enabled: true, style: { colors: ['#fff'] } },
    legend: { show: false },
    tooltip: { y: { formatter: v => v + ' unit' } },
}).render();
</script>
@endpush
