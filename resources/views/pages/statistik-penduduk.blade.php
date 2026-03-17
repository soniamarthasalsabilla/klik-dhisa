@extends('layouts.app')

@section('content')
<section class="py-5" style="background: var(--navy); color: white;">
    <div class="container text-center pt-5">
        <h1 class="fw-bold">Statistik Kependudukan</h1>
        <p class="lead opacity-75">Data terintegrasi Pemerintah Desa Tajungan</p>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 mb-4">
                <div class="card border-0 shadow-sm rounded-4 p-3 sticky-top" style="top: 100px;">
                    <h6 class="fw-bold mb-3 px-3 text-muted">PILIH KATEGORI</h6>
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <button class="nav-link active text-start mb-2 py-3 shadow-sm" id="tab-umur" data-bs-toggle="pill" data-bs-target="#content-umur" type="button">
                            <i class="fas fa-hourglass-half me-2"></i> Rentang Umur
                        </button>
                        <button class="nav-link text-start mb-2 py-3 shadow-sm" id="tab-pendidikan" data-bs-toggle="pill" data-bs-target="#content-pendidikan" type="button">
                            <i class="fas fa-graduation-cap me-2"></i> Pendidikan
                        </button>
                        <button class="nav-link text-start mb-2 py-3 shadow-sm" id="tab-pekerjaan" data-bs-toggle="pill" data-bs-target="#content-pekerjaan" type="button">
                            <i class="fas fa-briefcase me-2"></i> Pekerjaan
                        </button>
                        <button class="nav-link text-start mb-2 py-3 shadow-sm" id="tab-agama" data-bs-toggle="pill" data-bs-target="#content-agama" type="button">
                            <i class="fas fa-pray me-2"></i> Agama
                        </button>
                        <button class="nav-link text-start mb-2 py-3 shadow-sm" id="tab-status" data-bs-toggle="pill" data-bs-target="#content-status" type="button">
                            <i class="fas fa-heart me-2"></i> Status Perkawinan
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-lg-9 text-start">
                <div class="tab-content" id="v-pills-tabContent">
                    
                    <div class="tab-pane fade show active" id="content-umur">
                        <div class="card border-0 shadow-sm rounded-4 p-4">
                            <h4 class="fw-bold mb-4 text-navy">Statistik Rentang Umur</h4>
                            <div id="chart-umur" class="mb-4"></div>
                            @include('pages.partials_statistik.table_template', ['title' => 'Tabel Rentang Umur', 'data' => [
                                ['Balita (0-4)', 150, 80, 70],
                                ['Anak (5-14)', 400, 210, 190],
                                ['Produktif (15-64)', 1600, 820, 780],
                                ['Lansia (65+)', 300, 140, 160],
                            ]])
                        </div>
                    </div>

                    <div class="tab-pane fade" id="content-pendidikan">
                        <div class="card border-0 shadow-sm rounded-4 p-4">
                            <h4 class="fw-bold mb-4 text-navy">Tingkat Pendidikan</h4>
                            <div id="chart-pendidikan" class="mb-4"></div>
                            @include('pages.partials_statistik.table_template', ['title' => 'Tabel Pendidikan', 'data' => [
                                ['SD / Sederajat', 500, 260, 240],
                                ['SMP / Sederajat', 700, 360, 340],
                                ['SMA / Sederajat', 900, 460, 440],
                                ['Diploma/Sarjana', 350, 170, 180],
                            ]])
                        </div>
                    </div>

                    <div class="tab-pane fade" id="content-pekerjaan">
                        <div class="card border-0 shadow-sm rounded-4 p-4">
                            <h4 class="fw-bold mb-4 text-navy">Mata Pencaharian</h4>
                            <div id="chart-pekerjaan" class="mb-4"></div>
                            @include('pages.partials_statistik.table_template', ['title' => 'Tabel Pekerjaan', 'data' => [
                                ['Petani', 800, 500, 300],
                                ['Nelayan', 300, 250, 50],
                                ['Wiraswasta', 450, 230, 220],
                                ['PNS/TNI/Polri', 150, 80, 70],
                            ]])
                        </div>
                    </div>

                    <div class="tab-pane fade" id="content-agama">
                        <div class="card border-0 shadow-sm rounded-4 p-4">
                            <h4 class="fw-bold mb-4 text-navy">Pemeluk Agama</h4>
                            <div id="chart-agama" class="mb-4"></div>
                            @include('pages.partials_statistik.table_template', ['title' => 'Tabel Agama', 'data' => [
                                ['Islam', 2400, 1230, 1170],
                                ['Kristen', 30, 15, 15],
                                ['Lainnya', 20, 10, 10],
                            ]])
                        </div>
                    </div>

                    <div class="tab-pane fade" id="content-status">
                        <div class="card border-0 shadow-sm rounded-4 p-4">
                            <h4 class="fw-bold mb-4 text-navy">Status Perkawinan</h4>
                            <div id="chart-status" class="mb-4"></div>
                            @include('pages.partials_statistik.table_template', ['title' => 'Tabel Status Perkawinan', 'data' => [
                                ['Belum Kawin', 1000, 550, 450],
                                ['Kawin', 1300, 650, 650],
                                ['Cerai Hidup', 100, 30, 70],
                                ['Cerai Mati', 50, 10, 40],
                            ]])
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
    function renderChart(id, type, labels, data, colors) {
        var options = {
            series: data,
            chart: { type: type, height: 350, toolbar: {show: false} },
            labels: labels,
            colors: colors,
            legend: { position: 'bottom' },
            dataLabels: { enabled: true }
        };
        new ApexCharts(document.querySelector(id), options).render();
    }

    // Initialize Charts
    renderChart("#chart-umur", 'bar', ['0-4', '5-14', '15-64', '65+'], [{name: 'Jiwa', data: [150, 400, 1600, 300]}], ['#002b5b']);
    renderChart("#chart-pendidikan", 'pie', ['SD', 'SMP', 'SMA', 'PT'], [500, 700, 900, 350], ['#002b5b', '#f9d923', '#2b7a78', '#ff6b6b']);
    renderChart("#chart-pekerjaan", 'donut', ['Petani', 'Nelayan', 'Wiraswasta', 'PNS'], [800, 300, 450, 150], ['#2b7a78', '#17a2b8', '#f9d923', '#002b5b']);
    renderChart("#chart-agama", 'pie', ['Islam', 'Kristen', 'Lainnya'], [2400, 30, 20], ['#002b5b', '#f9d923', '#6c757d']);
    renderChart("#chart-status", 'bar', ['Belum Kawin', 'Kawin', 'Cerai'], [{name: 'Total', data: [1000, 1300, 150]}], ['#ff6b6b']);
</script>
@endpush
@endsection