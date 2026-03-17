@extends('layouts.app')

@section('content')
<section class="py-5" style="background: var(--navy); color: white;">
    <div class="container text-center pt-5">
        <h1 class="fw-bold">Statistik Keluarga</h1>
        <p class="lead opacity-75">Gambaran profil rumah tangga dan tingkat kesejahteraan warga Desa Tajungan</p>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            {{-- Sidebar Navigasi --}}
            <div class="col-lg-3 mb-4">
                <div class="card border-0 shadow-sm rounded-4 p-3 sticky-top" style="top: 100px;">
                    <h6 class="fw-bold mb-3 px-3 text-muted">PILIH KATEGORI</h6>
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <button class="nav-link active text-start mb-2 py-3 shadow-sm" id="tab-kk-gender" data-bs-toggle="pill" data-bs-target="#content-kk-gender" type="button">
                            <i class="fas fa-user-tie me-2"></i> Kepala Keluarga (Gender)
                        </button>
                        <button class="nav-link text-start mb-2 py-3 shadow-sm" id="tab-kesejahteraan" data-bs-toggle="pill" data-bs-target="#content-kesejahteraan" type="button">
                            <i class="fas fa-chart-line me-2"></i> Tingkat Kesejahteraan
                        </button>
                        <button class="nav-link text-start mb-2 py-3 shadow-sm" id="tab-asuransi" data-bs-toggle="pill" data-bs-target="#content-asuransi" type="button">
                            <i class="fas fa-shield-alt me-2"></i> Jaminan Kesehatan
                        </button>
                    </div>
                </div>
            </div>

            {{-- Konten Tab --}}
            <div class="col-lg-9 text-start">
                <div class="tab-content" id="v-pills-tabContent">
                    
                    {{-- Tab Gender --}}
                    <div class="tab-pane fade show active" id="content-kk-gender">
                        <div class="card border-0 shadow-sm rounded-4 p-4">
                            <h4 class="fw-bold mb-4 text-navy">Kepala Keluarga Menurut Jenis Kelamin</h4>
                            <div id="chart-kk-gender" class="mb-4"></div>
                            <div class="table-responsive">
                                <table class="table table-bordered align-middle text-center small">
                                    <thead class="table-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Kategori Kepala Keluarga</th>
                                            <th>Jumlah (KK)</th>
                                            <th>Persentase (%)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td class="text-start px-3">Kepala Keluarga Laki-laki</td>
                                            <td class="fw-bold">650</td>
                                            <td>81.2%</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td class="text-start px-3">Kepala Keluarga Perempuan (Keluarga Rentan)</td>
                                            <td class="fw-bold">150</td>
                                            <td>18.8%</td>
                                        </tr>
                                    </tbody>
                                    <tfoot class="table-secondary fw-bold">
                                        <tr>
                                            <td colspan="2">TOTAL</td>
                                            <td>800</td>
                                            <td>100%</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- Tab Kesejahteraan --}}
                    <div class="tab-pane fade" id="content-kesejahteraan">
                        <div class="card border-0 shadow-sm rounded-4 p-4">
                            <h4 class="fw-bold mb-4 text-navy">Klasifikasi Tingkat Kesejahteraan</h4>
                            <div id="chart-kesejahteraan" class="mb-4"></div>
                            <div class="table-responsive">
                                <table class="table table-bordered align-middle text-center small">
                                    <thead class="table-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Kategori Kesejahteraan</th>
                                            <th>Jumlah (KK)</th>
                                            <th>Persentase (%)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr><td>1</td><td class="text-start px-3">Keluarga Pra-Sejahtera</td><td class="fw-bold">120</td><td>15.0%</td></tr>
                                        <tr><td>2</td><td class="text-start px-3">Keluarga Sejahtera I</td><td class="fw-bold">300</td><td>37.5%</td></tr>
                                        <tr><td>3</td><td class="text-start px-3">Keluarga Sejahtera II</td><td class="fw-bold">250</td><td>31.2%</td></tr>
                                        <tr><td>4</td><td class="text-start px-3">Keluarga Sejahtera III+</td><td class="fw-bold">130</td><td>16.3%</td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- Tab Jaminan Kesehatan --}}
                    <div class="tab-pane fade" id="content-asuransi">
                        <div class="card border-0 shadow-sm rounded-4 p-4">
                            <h4 class="fw-bold mb-4 text-navy">Kepemilikan Jaminan Kesehatan (BPJS/KIS)</h4>
                            <div id="chart-asuransi" class="mb-4"></div>
                            <div class="table-responsive">
                                <table class="table table-bordered align-middle text-center small">
                                    <thead class="table-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Status Jaminan Kesehatan</th>
                                            <th>Jumlah (KK)</th>
                                            <th>Persentase (%)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr><td>1</td><td class="text-start px-3">Memiliki (PBI - Gratis dari Pemerintah)</td><td class="fw-bold">500</td><td>62.5%</td></tr>
                                        <tr><td>2</td><td class="text-start px-3">Memiliki (Mandiri/Perusahaan)</td><td class="fw-bold">200</td><td>25.0%</td></tr>
                                        <tr><td>3</td><td class="text-start px-3">Belum Memiliki</td><td class="fw-bold">100</td><td>12.5%</td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

{{-- Penambahan Style Agar Konsisten --}}
<style>
    .nav-pills .nav-link { color: var(--navy); background: white; border: 1px solid #eee; border-radius: 12px; transition: 0.3s; }
    .nav-pills .nav-link.active { background: var(--navy) !important; color: white !important; transform: scale(1.02); }
    .text-navy { color: var(--navy); }
</style>

@push('scripts')
<script>
    // Chart KK Gender
    new ApexCharts(document.querySelector("#chart-kk-gender"), {
        series: [650, 150],
        chart: { type: 'donut', height: 350 },
        labels: ['Laki-laki', 'Perempuan'],
        colors: ['#002b5b', '#ff6b6b'],
        legend: { position: 'bottom' }
    }).render();

    // Chart Kesejahteraan
    new ApexCharts(document.querySelector("#chart-kesejahteraan"), {
        series: [{ name: 'Jumlah KK', data: [120, 300, 250, 130] }],
        chart: { type: 'bar', height: 350, toolbar: {show: false} },
        colors: ['#2b7a78'],
        xaxis: { categories: ['Pra-S', 'S I', 'S II', 'S III+'] }
    }).render();

    // Chart Asuransi
    new ApexCharts(document.querySelector("#chart-asuransi"), {
        series: [500, 200, 100],
        chart: { type: 'pie', height: 350 },
        labels: ['PBI (Pemerintah)', 'Mandiri', 'Belum Ada'],
        colors: ['#002b5b', '#2b7a78', '#6c757d'],
        legend: { position: 'bottom' }
    }).render();
</script>
@endpush
@endsection