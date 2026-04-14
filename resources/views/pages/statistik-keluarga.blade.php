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
            <i class="fas fa-home me-2" style="color:var(--color-5);"></i>Statistik Keluarga
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
                        <button class="nav-link active text-start py-3" data-bs-toggle="pill" data-bs-target="#content-kk-gender" type="button">
                            <i class="fas fa-user-tie me-2"></i> Kepala Keluarga
                        </button>
                        <button class="nav-link text-start py-3" data-bs-toggle="pill" data-bs-target="#content-kesejahteraan" type="button">
                            <i class="fas fa-chart-line me-2"></i> Tingkat Kesejahteraan
                        </button>
                        <button class="nav-link text-start py-3" data-bs-toggle="pill" data-bs-target="#content-asuransi" type="button">
                            <i class="fas fa-shield-alt me-2"></i> Jaminan Kesehatan
                        </button>
                    </div>

                    <hr class="my-3">
                    <div class="row g-2 text-center px-1">
                        <div class="col-6">
                            <div class="rounded-3 py-2" style="background:var(--color-1);">
                                <div class="fw-bold" style="color:var(--color-6);font-size:1.15rem;">800</div>
                                <div style="font-size:.62rem;color:var(--color-5);text-transform:uppercase;font-weight:600;">Total KK</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="rounded-3 py-2" style="background:var(--color-1);">
                                <div class="fw-bold" style="color:var(--color-6);font-size:1.15rem;">150</div>
                                <div style="font-size:.62rem;color:var(--color-5);text-transform:uppercase;font-weight:600;">KK Perempuan</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Konten --}}
            <div class="col-lg-9">
                <div class="tab-content" id="v-pills-tabContent">

                    {{-- Kepala Keluarga --}}
                    <div class="tab-pane fade show active" id="content-kk-gender">
                        <div class="card border-0 shadow-sm rounded-4 p-4">
                            <h4 class="fw-bold mb-1" style="color:var(--color-7);">Kepala Keluarga Menurut Jenis Kelamin</h4>
                            <p class="text-muted small mb-4">Distribusi kepala keluarga berdasarkan gender di Desa Tajungan</p>
                            <div id="chart-kk-gender" class="mb-4"></div>
                            <div class="table-responsive">
                                <table class="table table-bordered align-middle text-center small">
                                    <thead style="background:var(--color-1);">
                                        <tr>
                                            <th>No</th>
                                            <th class="text-start">Kategori Kepala Keluarga</th>
                                            <th>Jumlah (KK)</th>
                                            <th>Persentase (%)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td class="text-start px-3">Kepala Keluarga Laki-laki</td>
                                            <td class="fw-bold" style="color:var(--color-6);">650</td>
                                            <td>81,2%</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td class="text-start px-3">Kepala Keluarga Perempuan (Keluarga Rentan)</td>
                                            <td class="fw-bold" style="color:var(--color-6);">150</td>
                                            <td>18,8%</td>
                                        </tr>
                                    </tbody>
                                    <tfoot style="background:var(--color-1);font-weight:700;">
                                        <tr>
                                            <td colspan="2" class="text-start px-3">TOTAL</td>
                                            <td style="color:var(--color-6);">800</td>
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
                                        <tr><td>1</td><td class="text-start px-3">Keluarga Pra-Sejahtera</td><td class="fw-bold" style="color:var(--color-6);">120</td><td>15,0%</td></tr>
                                        <tr><td>2</td><td class="text-start px-3">Keluarga Sejahtera I</td><td class="fw-bold" style="color:var(--color-6);">300</td><td>37,5%</td></tr>
                                        <tr><td>3</td><td class="text-start px-3">Keluarga Sejahtera II</td><td class="fw-bold" style="color:var(--color-6);">250</td><td>31,2%</td></tr>
                                        <tr><td>4</td><td class="text-start px-3">Keluarga Sejahtera III+</td><td class="fw-bold" style="color:var(--color-6);">130</td><td>16,3%</td></tr>
                                    </tbody>
                                    <tfoot style="background:var(--color-1);font-weight:700;">
                                        <tr>
                                            <td colspan="2" class="text-start px-3">TOTAL</td>
                                            <td style="color:var(--color-6);">800</td>
                                            <td>100%</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- Jaminan Kesehatan --}}
                    <div class="tab-pane fade" id="content-asuransi">
                        <div class="card border-0 shadow-sm rounded-4 p-4">
                            <h4 class="fw-bold mb-1" style="color:var(--color-7);">Kepemilikan Jaminan Kesehatan (BPJS/KIS)</h4>
                            <p class="text-muted small mb-4">Distribusi keluarga berdasarkan kepemilikan jaminan kesehatan</p>
                            <div id="chart-asuransi" class="mb-4"></div>
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
                                        <tr><td>1</td><td class="text-start px-3">Memiliki — PBI (Gratis dari Pemerintah)</td><td class="fw-bold" style="color:var(--color-6);">500</td><td>62,5%</td></tr>
                                        <tr><td>2</td><td class="text-start px-3">Memiliki — Mandiri / Perusahaan</td><td class="fw-bold" style="color:var(--color-6);">200</td><td>25,0%</td></tr>
                                        <tr><td>3</td><td class="text-start px-3">Belum Memiliki</td><td class="fw-bold" style="color:var(--color-6);">100</td><td>12,5%</td></tr>
                                    </tbody>
                                    <tfoot style="background:var(--color-1);font-weight:700;">
                                        <tr>
                                            <td colspan="2" class="text-start px-3">TOTAL</td>
                                            <td style="color:var(--color-6);">800</td>
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
var c1 = '#3A9A8C', c2 = '#5BBFAB', c3 = '#8FD4C2', c4 = '#f9d923', c5 = '#1E5A52';

// KK Gender
new ApexCharts(document.querySelector("#chart-kk-gender"), {
    series: [650, 150],
    chart: { type: 'donut', height: 320 },
    labels: ['Laki-laki', 'Perempuan'],
    colors: [c1, c4],
    legend: { position: 'bottom' },
    plotOptions: { pie: { donut: { size: '65%', labels: { show: true, total: { show: true, label: 'Total KK', color: '#2C7A6F' } } } } },
    dataLabels: { enabled: true },
}).render();

// Kesejahteraan
new ApexCharts(document.querySelector("#chart-kesejahteraan"), {
    series: [{ name: 'Jumlah KK', data: [120, 300, 250, 130] }],
    chart: { type: 'bar', height: 320, toolbar: { show: false } },
    colors: [c1],
    xaxis: { categories: ['Pra-Sejahtera', 'Sejahtera I', 'Sejahtera II', 'Sejahtera III+'] },
    plotOptions: { bar: { borderRadius: 6, columnWidth: '45%', distributed: true } },
    colors: [c5, c1, c2, c3],
    dataLabels: { enabled: true, style: { colors: ['#fff'] } },
    legend: { show: false },
}).render();

// Asuransi
new ApexCharts(document.querySelector("#chart-asuransi"), {
    series: [500, 200, 100],
    chart: { type: 'pie', height: 320 },
    labels: ['PBI (Pemerintah)', 'Mandiri', 'Belum Ada'],
    colors: [c1, c2, '#adb5bd'],
    legend: { position: 'bottom' },
    dataLabels: { enabled: true },
}).render();
</script>
@endpush
