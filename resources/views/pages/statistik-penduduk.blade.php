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

                    {{-- Summary Stat --}}
                    <hr class="my-3">
                    <div class="row g-2 text-center px-1">
                        <div class="col-6">
                            <div class="rounded-3 py-2" style="background:var(--color-1);">
                                <div class="fw-bold" style="color:var(--color-6);font-size:1.15rem;">2.450</div>
                                <div style="font-size:.62rem;color:var(--color-5);text-transform:uppercase;font-weight:600;">Total Jiwa</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="rounded-3 py-2" style="background:var(--color-1);">
                                <div class="fw-bold" style="color:var(--color-6);font-size:1.15rem;">800</div>
                                <div style="font-size:.62rem;color:var(--color-5);text-transform:uppercase;font-weight:600;">Total KK</div>
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
                            @include('pages.partials_statistik.table_template', ['title' => 'Tabel Rentang Umur', 'data' => [
                                ['Balita (0–4 tahun)',       150,  80,  70],
                                ['Anak-anak (5–14 tahun)',   400, 210, 190],
                                ['Produktif (15–64 tahun)', 1600, 820, 780],
                                ['Lansia (65+ tahun)',        300, 140, 160],
                            ]])
                        </div>
                    </div>

                    {{-- Pendidikan --}}
                    <div class="tab-pane fade" id="content-pendidikan">
                        <div class="card border-0 shadow-sm rounded-4 p-4">
                            <h4 class="fw-bold mb-1 stat-card-title">Tingkat Pendidikan</h4>
                            <p class="text-muted small mb-4">Distribusi penduduk berdasarkan jenjang pendidikan terakhir</p>
                            <div id="chart-pendidikan" class="mb-4"></div>
                            @include('pages.partials_statistik.table_template', ['title' => 'Tabel Tingkat Pendidikan', 'data' => [
                                ['Tidak / Belum Sekolah',   200, 100, 100],
                                ['SD / Sederajat',          500, 260, 240],
                                ['SMP / Sederajat',         700, 360, 340],
                                ['SMA / Sederajat',         700, 360, 340],
                                ['Diploma / Sarjana',       350, 170, 180],
                            ]])
                        </div>
                    </div>

                    {{-- Pekerjaan --}}
                    <div class="tab-pane fade" id="content-pekerjaan">
                        <div class="card border-0 shadow-sm rounded-4 p-4">
                            <h4 class="fw-bold mb-1 stat-card-title">Mata Pencaharian</h4>
                            <p class="text-muted small mb-4">Distribusi penduduk berdasarkan jenis pekerjaan</p>
                            <div id="chart-pekerjaan" class="mb-4"></div>
                            @include('pages.partials_statistik.table_template', ['title' => 'Tabel Mata Pencaharian', 'data' => [
                                ['Petani',           800, 500, 300],
                                ['Nelayan',          300, 250,  50],
                                ['Wiraswasta',       450, 230, 220],
                                ['PNS / TNI / Polri',150,  80,  70],
                                ['Buruh',            350, 200, 150],
                                ['Lainnya',          400, 180, 220],
                            ]])
                        </div>
                    </div>

                    {{-- Agama --}}
                    <div class="tab-pane fade" id="content-agama">
                        <div class="card border-0 shadow-sm rounded-4 p-4">
                            <h4 class="fw-bold mb-1 stat-card-title">Pemeluk Agama</h4>
                            <p class="text-muted small mb-4">Distribusi penduduk berdasarkan keyakinan agama</p>
                            <div id="chart-agama" class="mb-4"></div>
                            @include('pages.partials_statistik.table_template', ['title' => 'Tabel Pemeluk Agama', 'data' => [
                                ['Islam',    2400, 1230, 1170],
                                ['Kristen',    30,   15,   15],
                                ['Lainnya',    20,   10,   10],
                            ]])
                        </div>
                    </div>

                    {{-- Status Perkawinan --}}
                    <div class="tab-pane fade" id="content-status">
                        <div class="card border-0 shadow-sm rounded-4 p-4">
                            <h4 class="fw-bold mb-1 stat-card-title">Status Perkawinan</h4>
                            <p class="text-muted small mb-4">Distribusi penduduk berdasarkan status perkawinan</p>
                            <div id="chart-status" class="mb-4"></div>
                            @include('pages.partials_statistik.table_template', ['title' => 'Tabel Status Perkawinan', 'data' => [
                                ['Belum Kawin', 1000, 550, 450],
                                ['Kawin',       1300, 650, 650],
                                ['Cerai Hidup',  100,  30,  70],
                                ['Cerai Mati',    50,  10,  40],
                            ]])
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

// Rentang Umur
new ApexCharts(document.querySelector("#chart-umur"), {
    series: [{ name: 'Laki-laki', data: [80, 210, 820, 140] }, { name: 'Perempuan', data: [70, 190, 780, 160] }],
    chart: { type: 'bar', height: 320, toolbar: { show: false }, stacked: false },
    colors: [c1, c4],
    xaxis: { categories: ['Balita (0–4)', 'Anak (5–14)', 'Produktif (15–64)', 'Lansia (65+)'] },
    plotOptions: { bar: { borderRadius: 6, columnWidth: '55%' } },
    legend: { position: 'top' },
    dataLabels: { enabled: false },
}).render();

// Pendidikan
new ApexCharts(document.querySelector("#chart-pendidikan"), {
    series: [200, 500, 700, 700, 350],
    chart: { type: 'donut', height: 320 },
    labels: ['Tdk Sekolah', 'SD', 'SMP', 'SMA', 'Diploma/S1'],
    colors: [c5, c1, c2, c3, c4],
    legend: { position: 'bottom' },
    dataLabels: { enabled: true },
    plotOptions: { pie: { donut: { size: '65%' } } },
}).render();

// Pekerjaan
new ApexCharts(document.querySelector("#chart-pekerjaan"), {
    series: [{ name: 'Jiwa', data: [800, 300, 450, 150, 350, 400] }],
    chart: { type: 'bar', height: 320, toolbar: { show: false } },
    colors: [c1],
    xaxis: { categories: ['Petani', 'Nelayan', 'Wiraswasta', 'PNS/TNI', 'Buruh', 'Lainnya'] },
    plotOptions: { bar: { borderRadius: 6, horizontal: true } },
    dataLabels: { enabled: false },
}).render();

// Agama
new ApexCharts(document.querySelector("#chart-agama"), {
    series: [2400, 30, 20],
    chart: { type: 'pie', height: 320 },
    labels: ['Islam', 'Kristen', 'Lainnya'],
    colors: [c1, c4, '#6c757d'],
    legend: { position: 'bottom' },
}).render();

// Status Perkawinan
new ApexCharts(document.querySelector("#chart-status"), {
    series: [{ name: 'Laki-laki', data: [550, 650, 30, 10] }, { name: 'Perempuan', data: [450, 650, 70, 40] }],
    chart: { type: 'bar', height: 320, toolbar: { show: false }, stacked: true },
    colors: [c1, c4],
    xaxis: { categories: ['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati'] },
    plotOptions: { bar: { borderRadius: 4, columnWidth: '45%' } },
    legend: { position: 'top' },
    dataLabels: { enabled: false },
}).render();
</script>
@endpush
