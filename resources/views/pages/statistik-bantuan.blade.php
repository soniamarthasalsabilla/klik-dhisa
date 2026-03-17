@extends('layouts.app')

@section('content')
<section class="py-5" style="background: var(--navy); color: white;">
    <div class="container text-center pt-5">
        <h1 class="fw-bold">Statistik Bantuan Sosial</h1>
        <p class="lead opacity-75">Data penerima manfaat berbagai program bantuan pemerintah di Desa Tajungan</p>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 mb-4">
                <div class="card border-0 shadow-sm rounded-4 p-3 sticky-top" style="top: 100px;">
                    <h6 class="fw-bold mb-3 px-3 text-muted">JENIS BANTUAN</h6>
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <button class="nav-link active text-start mb-2 py-3 shadow-sm" id="tab-pkh" data-bs-toggle="pill" data-bs-target="#content-pkh" type="button">
                            <i class="fas fa-hand-holding-heart me-2"></i> PKH (Keluarga Harapan)
                        </button>
                        <button class="nav-link text-start mb-2 py-3 shadow-sm" id="tab-bpnt" data-bs-toggle="pill" data-bs-target="#content-bpnt" type="button">
                            <i class="fas fa-shopping-basket me-2"></i> BPNT (Sembako)
                        </button>
                        <button class="nav-link text-start mb-2 py-3 shadow-sm" id="tab-blt" data-bs-toggle="pill" data-bs-target="#content-blt" type="button">
                            <i class="fas fa-money-bill-wave me-2"></i> BLT Dana Desa
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-lg-9 text-start">
                <div class="tab-content" id="v-pills-tabContent">
                    
                    <div class="tab-pane fade show active" id="content-pkh">
                        <div class="card border-0 shadow-sm rounded-4 p-4">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h4 class="fw-bold text-navy mb-0">Program Keluarga Harapan (PKH)</h4>
                                <span class="badge bg-primary px-3 py-2 rounded-pill">Tahun 2026</span>
                            </div>
                            <div id="chart-pkh" class="mb-4"></div>
                            
                            <h6 class="fw-bold mb-3">Rincian Penerima PKH per Wilayah</h6>
                            <div class="table-responsive">
                                <table class="table table-bordered align-middle text-center small">
                                    <thead class="table-light">
                                        <tr>
                                            <th rowspan="2" class="align-middle">No</th>
                                            <th rowspan="2" class="align-middle">Wilayah Dusun</th>
                                            <th colspan="2" class="bg-soft-primary">Total Penerima</th>
                                            <th colspan="2">Laki-laki (KK)</th>
                                            <th colspan="2">Perempuan (KK)</th>
                                        </tr>
                                        <tr>
                                            <th>n</th><th>%</th><th>n</th><th>%</th><th>n</th><th>%</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td><td class="text-start px-3">Dusun Timur</td><td>45</td><td>30%</td><td>10</td><td>6.6%</td><td>35</td><td>23.3%</td>
                                        </tr>
                                        <tr>
                                            <td>2</td><td class="text-start px-3">Dusun Barat</td><td>55</td><td>36.7%</td><td>15</td><td>10%</td><td>40</td><td>26.7%</td>
                                        </tr>
                                        <tr>
                                            <td>3</td><td class="text-start px-3">Dusun Pesisir</td><td>50</td><td>33.3%</td><td>12</td><td>8%</td><td>38</td><td>25.3%</td>
                                        </tr>
                                    </tbody>
                                    <tfoot class="table-secondary fw-bold">
                                        <tr>
                                            <td colspan="2">TOTAL</td><td>150</td><td>100%</td><td>37</td><td>24.6%</td><td>113</td><td>75.4%</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="content-bpnt">
                        <div class="card border-0 shadow-sm rounded-4 p-4">
                            <h4 class="fw-bold mb-4 text-navy">Bantuan Pangan Non Tunai (BPNT)</h4>
                            <div id="chart-bpnt" class="mb-4"></div>
                            <p class="text-muted small mb-4">*Data mencakup Keluarga Penerima Manfaat (KPM) yang menerima bantuan sembako setiap bulan.</p>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="content-blt">
                        <div class="card border-0 shadow-sm rounded-4 p-4">
                            <h4 class="fw-bold mb-4 text-navy">BLT Dana Desa</h4>
                            <div id="chart-blt" class="mb-4"></div>
                            <div class="alert alert-info border-0 rounded-4 d-flex align-items-center">
                                <i class="fas fa-info-circle me-3 fs-4"></i>
                                <div>BLT Dana Desa difokuskan untuk keluarga miskin ekstrem yang belum tersentuh bantuan PKH maupun BPNT.</div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .nav-pills .nav-link { color: var(--navy); background: white; border: 1px solid #eee; border-radius: 12px; transition: 0.3s; }
    .nav-pills .nav-link.active { background: var(--navy) !important; color: white !important; transform: scale(1.02); }
    .bg-soft-primary { background-color: rgba(0, 43, 91, 0.05); }
    .text-navy { color: var(--navy); }
</style>

@push('scripts')
<script>
    new ApexCharts(document.querySelector("#chart-pkh"), {
        series: [{ name: 'KPM', data: [45, 55, 50] }],
        chart: { type: 'bar', height: 350, toolbar: {show: false} },
        colors: ['#002b5b'],
        xaxis: { categories: ['Dusun Timur', 'Dusun Barat', 'Dusun Pesisir'] }
    }).render();

    new ApexCharts(document.querySelector("#chart-bpnt"), {
        series: [90, 85, 95],
        chart: { type: 'donut', height: 350 },
        labels: ['Dusun Timur', 'Dusun Barat', 'Dusun Pesisir'],
        colors: ['#002b5b', '#f9d923', '#2b7a78'],
        legend: { position: 'bottom' }
    }).render();

    new ApexCharts(document.querySelector("#chart-blt"), {
        series: [{ name: 'Jiwa', data: [20, 15, 25] }],
        chart: { type: 'area', height: 350, toolbar: {show: false} },
        colors: ['#ff6b6b'],
        xaxis: { categories: ['Dusun Timur', 'Dusun Barat', 'Dusun Pesisir'] },
        stroke: { curve: 'smooth' }
    }).render();
</script>
@endpush
@endsection