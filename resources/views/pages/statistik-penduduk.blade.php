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
    .stat-card-title { color: var(--color-7); }
</style>
@endpush

@section('content')

{{-- Hero --}}
<section class="py-3" style="background: white; border-bottom: 3px solid var(--color-5);">
    <div class="container text-center py-4">
        <h2 class="fw-bold mb-2" style="color: var(--color-7); font-size: 2rem;">
            <i class="fas fa-users me-2" style="color:var(--color-5);"></i>Statistik Kependudukan
        </h2>
        <p class="mb-0" style="color: var(--color-6); font-size: 1rem;">Data terintegrasi Pemerintah Desa Tajungan</p>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">
        <div class="row">

            {{-- Sidebar --}}
            <div class="col-lg-3 mb-4">
                <div class="card border-0 shadow-sm rounded-4 p-3 sticky-top" style="top: 90px;">
                    <h6 class="fw-bold mb-3 px-2 text-muted" style="font-size:.7rem;text-transform:uppercase;letter-spacing:1px;">Pilih Kategori</h6>
                    <div class="nav flex-column nav-pills stat-nav gap-1" id="v-pills-tab" role="tablist">
                        <button class="nav-link active text-start py-3" data-bs-toggle="pill" data-bs-target="#content-umur" type="button">
                            <i class="fas fa-hourglass-half me-2"></i> Rentang Umur
                        </button>
                        <button class="nav-link text-start py-3" data-bs-toggle="pill" data-bs-target="#content-pendidikan" type="button">
                            <i class="fas fa-graduation-cap me-2"></i> Pendidikan
                        </button>
                        <button class="nav-link text-start py-3" data-bs-toggle="pill" data-bs-target="#content-pekerjaan" type="button">
                            <i class="fas fa-briefcase me-2"></i> Pekerjaan
                        </button>
                        <button class="nav-link text-start py-3" data-bs-toggle="pill" data-bs-target="#content-agama" type="button">
                            <i class="fas fa-pray me-2"></i> Agama
                        </button>
                        <button class="nav-link text-start py-3" data-bs-toggle="pill" data-bs-target="#content-status" type="button">
                            <i class="fas fa-heart me-2"></i> Status Perkawinan
                        </button>
                    </div>

                    <hr class="my-3">
                    <div class="row g-2 text-center px-1">
                        <div class="col-6">
                            <div class="rounded-3 py-2" style="background:var(--color-1);">
                                <div class="fw-bold" style="color:var(--color-6);font-size:1.15rem;">{{ number_format($totalJiwa) }}</div>
                                <div style="font-size:.62rem;color:var(--color-5);text-transform:uppercase;font-weight:600;">Total Jiwa</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="rounded-3 py-2" style="background:var(--color-1);">
                                <div class="fw-bold" style="color:var(--color-6);font-size:1.15rem;">{{ $pendidikan->count() }}</div>
                                <div style="font-size:.62rem;color:var(--color-5);text-transform:uppercase;font-weight:600;">Kat. Pendidikan</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Konten --}}
            <div class="col-lg-9">
                <div class="tab-content" id="v-pills-tabContent">

                    {{-- Rentang Umur --}}
                    <div class="tab-pane fade show active" id="content-umur">
                        <div class="card border-0 shadow-sm rounded-4 p-4">
                            <h4 class="fw-bold mb-1 stat-card-title">Statistik Rentang Umur</h4>
                            <p class="text-muted small mb-4">Distribusi penduduk berdasarkan kelompok usia</p>
                            <div id="chart-umur" class="mb-4"></div>
                            <h6 class="fw-bold mt-2 mb-3" style="color:var(--color-7);">Tabel Rentang Umur</h6>
                            @php $totalUmur = $umur->sum('jumlah'); @endphp
                            <div class="table-responsive">
                                <table class="table table-bordered align-middle text-center small">
                                    <thead style="background:var(--color-1);">
                                        <tr>
                                            <th>No</th>
                                            <th class="text-start">Kelompok Umur</th>
                                            <th>Jumlah (Jiwa)</th>
                                            <th>Persentase (%)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($umur as $i => $row)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td class="text-start px-3">{{ $row->label }}</td>
                                            <td class="fw-bold" style="color:var(--color-6);">{{ number_format($row->jumlah) }}</td>
                                            <td>{{ $totalUmur > 0 ? round(($row->jumlah / $totalUmur) * 100, 1) : 0 }}%</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot style="background:var(--color-1);font-weight:700;">
                                        <tr>
                                            <td colspan="2" class="text-start px-3">TOTAL</td>
                                            <td style="color:var(--color-6);">{{ number_format($totalUmur) }}</td>
                                            <td>100%</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- Pendidikan --}}
                    <div class="tab-pane fade" id="content-pendidikan">
                        <div class="card border-0 shadow-sm rounded-4 p-4">
                            <h4 class="fw-bold mb-1 stat-card-title">Tingkat Pendidikan</h4>
                            <p class="text-muted small mb-4">Distribusi penduduk berdasarkan jenjang pendidikan terakhir</p>
                            <div id="chart-pendidikan" class="mb-4"></div>
                            <h6 class="fw-bold mt-2 mb-3" style="color:var(--color-7);">Tabel Tingkat Pendidikan</h6>
                            @php $totalPend = $pendidikan->sum('jumlah'); @endphp
                            <div class="table-responsive">
                                <table class="table table-bordered align-middle text-center small">
                                    <thead style="background:var(--color-1);">
                                        <tr>
                                            <th>No</th>
                                            <th class="text-start">Jenjang Pendidikan</th>
                                            <th>Jumlah (Jiwa)</th>
                                            <th>Persentase (%)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pendidikan as $i => $row)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td class="text-start px-3">{{ $row->label }}</td>
                                            <td class="fw-bold" style="color:var(--color-6);">{{ number_format($row->jumlah) }}</td>
                                            <td>{{ $totalPend > 0 ? round(($row->jumlah / $totalPend) * 100, 1) : 0 }}%</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot style="background:var(--color-1);font-weight:700;">
                                        <tr>
                                            <td colspan="2" class="text-start px-3">TOTAL</td>
                                            <td style="color:var(--color-6);">{{ number_format($totalPend) }}</td>
                                            <td>100%</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- Pekerjaan --}}
                    <div class="tab-pane fade" id="content-pekerjaan">
                        <div class="card border-0 shadow-sm rounded-4 p-4">
                            <h4 class="fw-bold mb-1 stat-card-title">Mata Pencaharian</h4>
                            <p class="text-muted small mb-4">Distribusi penduduk berdasarkan jenis pekerjaan</p>
                            <div id="chart-pekerjaan" class="mb-4"></div>
                            <h6 class="fw-bold mt-2 mb-3" style="color:var(--color-7);">Tabel Mata Pencaharian</h6>
                            @php $totalPek = $pekerjaan->sum('jumlah'); @endphp
                            <div class="table-responsive">
                                <table class="table table-bordered align-middle text-center small">
                                    <thead style="background:var(--color-1);">
                                        <tr>
                                            <th>No</th>
                                            <th class="text-start">Jenis Pekerjaan</th>
                                            <th>Jumlah (Jiwa)</th>
                                            <th>Persentase (%)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pekerjaan as $i => $row)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td class="text-start px-3">{{ $row->label }}</td>
                                            <td class="fw-bold" style="color:var(--color-6);">{{ number_format($row->jumlah) }}</td>
                                            <td>{{ $totalPek > 0 ? round(($row->jumlah / $totalPek) * 100, 1) : 0 }}%</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot style="background:var(--color-1);font-weight:700;">
                                        <tr>
                                            <td colspan="2" class="text-start px-3">TOTAL</td>
                                            <td style="color:var(--color-6);">{{ number_format($totalPek) }}</td>
                                            <td>100%</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- Agama --}}
                    <div class="tab-pane fade" id="content-agama">
                        <div class="card border-0 shadow-sm rounded-4 p-4">
                            <h4 class="fw-bold mb-1 stat-card-title">Pemeluk Agama</h4>
                            <p class="text-muted small mb-4">Distribusi penduduk berdasarkan keyakinan agama</p>
                            <div id="chart-agama" class="mb-4"></div>
                            <h6 class="fw-bold mt-2 mb-3" style="color:var(--color-7);">Tabel Pemeluk Agama</h6>
                            @php $totalAgama = $agama->sum('jumlah'); @endphp
                            <div class="table-responsive">
                                <table class="table table-bordered align-middle text-center small">
                                    <thead style="background:var(--color-1);">
                                        <tr>
                                            <th>No</th>
                                            <th class="text-start">Agama</th>
                                            <th>Jumlah (Jiwa)</th>
                                            <th>Persentase (%)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($agama as $i => $row)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td class="text-start px-3">{{ $row->label }}</td>
                                            <td class="fw-bold" style="color:var(--color-6);">{{ number_format($row->jumlah) }}</td>
                                            <td>{{ $totalAgama > 0 ? round(($row->jumlah / $totalAgama) * 100, 1) : 0 }}%</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot style="background:var(--color-1);font-weight:700;">
                                        <tr>
                                            <td colspan="2" class="text-start px-3">TOTAL</td>
                                            <td style="color:var(--color-6);">{{ number_format($totalAgama) }}</td>
                                            <td>100%</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- Status Perkawinan --}}
                    <div class="tab-pane fade" id="content-status">
                        <div class="card border-0 shadow-sm rounded-4 p-4">
                            <h4 class="fw-bold mb-1 stat-card-title">Status Perkawinan</h4>
                            <p class="text-muted small mb-4">Distribusi penduduk berdasarkan status perkawinan</p>
                            <div id="chart-status" class="mb-4"></div>
                            <h6 class="fw-bold mt-2 mb-3" style="color:var(--color-7);">Tabel Status Perkawinan</h6>
                            @php $totalStatus = $status->sum('jumlah'); @endphp
                            <div class="table-responsive">
                                <table class="table table-bordered align-middle text-center small">
                                    <thead style="background:var(--color-1);">
                                        <tr>
                                            <th>No</th>
                                            <th class="text-start">Status</th>
                                            <th>Jumlah (Jiwa)</th>
                                            <th>Persentase (%)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($status as $i => $row)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td class="text-start px-3">{{ $row->label }}</td>
                                            <td class="fw-bold" style="color:var(--color-6);">{{ number_format($row->jumlah) }}</td>
                                            <td>{{ $totalStatus > 0 ? round(($row->jumlah / $totalStatus) * 100, 1) : 0 }}%</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot style="background:var(--color-1);font-weight:700;">
                                        <tr>
                                            <td colspan="2" class="text-start px-3">TOTAL</td>
                                            <td style="color:var(--color-6);">{{ number_format($totalStatus) }}</td>
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
var palette = [c5, c6, c1, c2, c3, c4, '#fd7e14', '#6f42c1', '#dc3545', '#0d6efd', '#20c997', '#adb5bd',
               '#e83e8c', '#17a2b8', '#ffc107', '#6c757d'];

// Rentang Umur
var umurLabels = @json($umur->pluck('label'));
var umurData   = @json($umur->pluck('jumlah'));
new ApexCharts(document.querySelector("#chart-umur"), {
    series: [{ name: 'Jiwa', data: umurData }],
    chart: { type: 'bar', height: 360, toolbar: { show: false } },
    colors: [c1],
    xaxis: { categories: umurLabels, labels: { rotate: -35, style: { fontSize: '11px' } } },
    plotOptions: { bar: { borderRadius: 4, columnWidth: '60%' } },
    dataLabels: { enabled: false },
    tooltip: { y: { formatter: v => v.toLocaleString('id-ID') + ' jiwa' } },
}).render();

// Pendidikan
var pendLabels = @json($pendidikan->pluck('label'));
var pendData   = @json($pendidikan->pluck('jumlah'));
new ApexCharts(document.querySelector("#chart-pendidikan"), {
    series: pendData,
    chart: { type: 'donut', height: 340 },
    labels: pendLabels,
    colors: palette.slice(0, pendLabels.length),
    legend: { position: 'bottom' },
    dataLabels: { enabled: true },
    plotOptions: { pie: { donut: { size: '65%' } } },
    tooltip: { y: { formatter: v => v.toLocaleString('id-ID') + ' jiwa' } },
}).render();

// Pekerjaan
var pekLabels = @json($pekerjaan->pluck('label'));
var pekData   = @json($pekerjaan->pluck('jumlah'));
new ApexCharts(document.querySelector("#chart-pekerjaan"), {
    series: [{ name: 'Jiwa', data: pekData }],
    chart: { type: 'bar', height: 360, toolbar: { show: false } },
    colors: [c1],
    xaxis: { categories: pekLabels },
    plotOptions: { bar: { borderRadius: 4, horizontal: true } },
    dataLabels: { enabled: false },
    tooltip: { x: { show: true }, y: { formatter: v => v.toLocaleString('id-ID') + ' jiwa' } },
}).render();

// Agama
var agamaLabels = @json($agama->pluck('label'));
var agamaData   = @json($agama->pluck('jumlah'));
new ApexCharts(document.querySelector("#chart-agama"), {
    series: agamaData,
    chart: { type: 'pie', height: 320 },
    labels: agamaLabels,
    colors: palette.slice(0, agamaLabels.length),
    legend: { position: 'bottom' },
    tooltip: { y: { formatter: v => v.toLocaleString('id-ID') + ' jiwa' } },
}).render();

// Status Perkawinan
var statusLabels = @json($status->pluck('label'));
var statusData   = @json($status->pluck('jumlah'));
new ApexCharts(document.querySelector("#chart-status"), {
    series: [{ name: 'Jiwa', data: statusData }],
    chart: { type: 'bar', height: 320, toolbar: { show: false } },
    colors: [c1],
    xaxis: { categories: statusLabels },
    plotOptions: { bar: { borderRadius: 6, columnWidth: '45%', distributed: true } },
    colors: palette.slice(0, statusLabels.length),
    dataLabels: { enabled: false },
    legend: { show: false },
    tooltip: { y: { formatter: v => v.toLocaleString('id-ID') + ' jiwa' } },
}).render();
</script>
@endpush
