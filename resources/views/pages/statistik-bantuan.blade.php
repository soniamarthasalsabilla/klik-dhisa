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
    .syarat-item {
        display: flex; align-items: flex-start; gap: 10px;
        padding: 8px 0; border-bottom: 1px solid var(--color-1);
        font-size: .83rem; color: var(--color-7);
    }
    .syarat-item:last-child { border-bottom: none; }
    .syarat-item i { color: var(--color-5); margin-top: 2px; flex-shrink: 0; }
</style>
@endpush

@section('content')

{{-- Hero --}}
<section class="py-3" style="background: white; border-bottom: 3px solid var(--color-5);">
    <div class="container text-center py-4">
        <h2 class="fw-bold mb-2" style="color: var(--color-7); font-size: 2rem;">
            <i class="fas fa-hand-holding-heart me-2" style="color:var(--color-5);"></i>Statistik Bantuan Sosial
        </h2>
        <p class="mb-0" style="color: var(--color-6); font-size: 1rem;">Data Penerima Manfaat Program Bantuan Desa Tajungan · Tahun 2026</p>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">
        <div class="row">

            {{-- Sidebar --}}
            <div class="col-lg-3 mb-4">
                <div class="card border-0 shadow-sm rounded-4 p-3 sticky-top" style="top: 90px;">
                    <h6 class="fw-bold mb-3 px-2 text-muted" style="font-size:.7rem;text-transform:uppercase;letter-spacing:1px;">Program Bantuan</h6>
                    <div class="nav flex-column nav-pills stat-nav gap-1" role="tablist">
                        <button class="nav-link active text-start py-3" data-bs-toggle="pill" data-bs-target="#content-pkh" type="button">
                            <i class="fas fa-hand-holding-heart me-2"></i> PKH
                        </button>
                        <button class="nav-link text-start py-3" data-bs-toggle="pill" data-bs-target="#content-bpnt" type="button">
                            <i class="fas fa-shopping-basket me-2"></i> BPNT (Sembako)
                        </button>
                        <button class="nav-link text-start py-3" data-bs-toggle="pill" data-bs-target="#content-blt" type="button">
                            <i class="fas fa-money-bill-wave me-2"></i> BLT Dana Desa
                        </button>
                    </div>

                    <hr class="my-3">
                    <div class="row g-2 text-center px-1">
                        <div class="col-6">
                            <div class="rounded-3 py-2" style="background:var(--color-1);">
                                <div class="fw-bold" style="color:var(--color-6);font-size:1.1rem;">{{ $pkh->sum('jumlah') }}</div>
                                <div style="font-size:.6rem;color:var(--color-5);text-transform:uppercase;font-weight:600;">PKH</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="rounded-3 py-2" style="background:var(--color-1);">
                                <div class="fw-bold" style="color:var(--color-6);font-size:1.1rem;">{{ $bpnt->sum('jumlah') }}</div>
                                <div style="font-size:.6rem;color:var(--color-5);text-transform:uppercase;font-weight:600;">BPNT</div>
                            </div>
                        </div>
                        <div class="col-12 mt-1">
                            <div class="rounded-3 py-2" style="background:var(--color-1);">
                                <div class="fw-bold" style="color:var(--color-6);font-size:1.1rem;">{{ $blt->sum('jumlah') }}</div>
                                <div style="font-size:.6rem;color:var(--color-5);text-transform:uppercase;font-weight:600;">BLT Dana Desa</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Konten --}}
            <div class="col-lg-9">
                <div class="tab-content">

                    {{-- ===== PKH ===== --}}
                    <div class="tab-pane fade show active" id="content-pkh">
                        <div class="card border-0 shadow-sm rounded-4 p-4">
                            <div class="d-flex justify-content-between align-items-start mb-1">
                                <h4 class="fw-bold mb-0" style="color:var(--color-7);">Program Keluarga Harapan (PKH)</h4>
                                <span class="badge rounded-pill px-3" style="background:var(--color-5);">{{ $pkh->sum('jumlah') }} KPM</span>
                            </div>
                            <p class="text-muted small mb-4">Bantuan sosial bersyarat dari Kemensos bagi keluarga miskin yang memiliki anggota keluarga sesuai komponen.</p>

                            <div id="chart-pkh" class="mb-4"></div>

                            <h6 class="fw-bold mb-3" style="color:var(--color-7);">Rincian per Komponen</h6>
                            @php
                            $pkhBantuan = [
                                'Ibu Hamil / Nifas'             => 'Rp 3.000.000',
                                'Anak Usia Dini (0-6 tahun)'    => 'Rp 3.000.000',
                                'Anak SD / Sederajat'           => 'Rp 900.000',
                                'Anak SMP / Sederajat'          => 'Rp 1.500.000',
                                'Anak SMA / Sederajat'          => 'Rp 2.000.000',
                                'Lansia (70+ tahun)'            => 'Rp 2.400.000',
                                'Disabilitas Berat'             => 'Rp 2.400.000',
                            ];
                            $pkhTotal = $pkh->sum('jumlah');
                            @endphp
                            <div class="table-responsive">
                                <table class="table table-bordered align-middle text-center small">
                                    <thead style="background:var(--color-1);">
                                        <tr>
                                            <th>No</th>
                                            <th class="text-start">Komponen Penerima</th>
                                            <th>Jumlah (jiwa)</th>
                                            <th>Bantuan / Tahun</th>
                                            <th>Persentase</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pkh as $i => $row)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td class="text-start px-3">{{ $row->label }}</td>
                                            <td class="fw-bold" style="color:var(--color-6);">{{ number_format($row->jumlah) }}</td>
                                            <td>{{ $pkhBantuan[$row->label] ?? '—' }}</td>
                                            <td>{{ $pkhTotal > 0 ? round(($row->jumlah / $pkhTotal) * 100, 1) : 0 }}%</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot style="background:var(--color-1);font-weight:700;">
                                        <tr>
                                            <td colspan="2" class="text-start px-3">TOTAL</td>
                                            <td style="color:var(--color-6);">{{ number_format($pkhTotal) }}</td>
                                            <td>—</td>
                                            <td>100%</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <div class="alert border-0 rounded-3 mt-3 d-flex align-items-start gap-3" style="background:var(--color-1);">
                                <i class="fas fa-info-circle mt-1" style="color:var(--color-5);"></i>
                                <div class="small" style="color:var(--color-7);">Satu keluarga penerima PKH dapat memiliki lebih dari satu komponen. Bantuan dasar keluarga sebesar <strong>Rp 500.000/tahun</strong> diterima oleh seluruh KPM.</div>
                            </div>
                        </div>
                    </div>

                    {{-- ===== BPNT ===== --}}
                    <div class="tab-pane fade" id="content-bpnt">
                        <div class="card border-0 shadow-sm rounded-4 p-4">
                            <div class="d-flex justify-content-between align-items-start mb-1">
                                <h4 class="fw-bold mb-0" style="color:var(--color-7);">Bantuan Pangan Non Tunai (BPNT)</h4>
                                <span class="badge rounded-pill px-3" style="background:var(--color-5);">{{ $bpnt->sum('jumlah') }} KPM</span>
                            </div>
                            <p class="text-muted small mb-4">Bantuan pangan berupa sembako senilai <strong>Rp 200.000 / bulan</strong> yang disalurkan melalui e-warong.</p>

                            <div id="chart-bpnt" class="mb-4"></div>

                            <h6 class="fw-bold mb-3" style="color:var(--color-7);">Rekap Status Penerima</h6>
                            @php
                            $bpntIcons  = ['Aktif Menerima' => ['#198754','fa-check-circle'], 'Dalam Verifikasi' => ['#fd7e14','fa-clock'], 'Diusulkan Hapus' => ['#dc3545','fa-times-circle']];
                            $bpntTotal  = $bpnt->sum('jumlah');
                            @endphp
                            <div class="row g-3 mb-4">
                                @foreach($bpnt as $row)
                                @php [$bc, $bi] = $bpntIcons[$row->label] ?? ['#6c757d','fa-circle']; @endphp
                                <div class="col-md-4">
                                    <div class="card border-0 rounded-3 text-center py-3" style="background:var(--color-1);">
                                        <i class="fas {{ $bi }} mb-2" style="color:{{ $bc }};font-size:1.4rem;"></i>
                                        <div class="fw-bold" style="color:var(--color-7);font-size:1.5rem;">{{ number_format($row->jumlah) }}</div>
                                        <div class="small text-muted">{{ $row->label }}</div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <h6 class="fw-bold mb-3" style="color:var(--color-7);">Kriteria Penerima BPNT</h6>
                            <div class="mb-3">
                                <div class="syarat-item"><i class="fas fa-check-circle"></i><span>Terdaftar dalam Data Terpadu Kesejahteraan Sosial (DTKS)</span></div>
                                <div class="syarat-item"><i class="fas fa-check-circle"></i><span>Keluarga miskin atau rentan miskin yang belum mendapatkan bantuan pangan lain</span></div>
                                <div class="syarat-item"><i class="fas fa-check-circle"></i><span>Memiliki Kartu Keluarga Sejahtera (KKS) yang aktif</span></div>
                                <div class="syarat-item"><i class="fas fa-check-circle"></i><span>Berdomisili dan tercatat di administrasi Desa Tajungan</span></div>
                            </div>
                            <div class="alert border-0 rounded-3 d-flex align-items-start gap-3" style="background:var(--color-1);">
                                <i class="fas fa-store mt-1" style="color:var(--color-5);"></i>
                                <div class="small" style="color:var(--color-7);">Bantuan dapat dicairkan di <strong>e-Warong</strong> terdekat menggunakan Kartu Keluarga Sejahtera (KKS) / KTP.</div>
                            </div>
                        </div>
                    </div>

                    {{-- ===== BLT ===== --}}
                    <div class="tab-pane fade" id="content-blt">
                        <div class="card border-0 shadow-sm rounded-4 p-4">
                            <div class="d-flex justify-content-between align-items-start mb-1">
                                <h4 class="fw-bold mb-0" style="color:var(--color-7);">BLT Dana Desa</h4>
                                <span class="badge rounded-pill px-3" style="background:var(--color-5);">{{ $blt->sum('jumlah') }} KPM</span>
                            </div>
                            <p class="text-muted small mb-4">Bantuan Langsung Tunai sebesar <strong>Rp 300.000 / bulan</strong>, diprioritaskan bagi keluarga miskin ekstrem yang belum dapat PKH maupun BPNT.</p>

                            <div id="chart-blt" class="mb-4"></div>

                            <h6 class="fw-bold mb-3" style="color:var(--color-7);">Rincian per Kategori Penerima</h6>
                            @php $bltTotal = $blt->sum('jumlah'); @endphp
                            <div class="table-responsive">
                                <table class="table table-bordered align-middle text-center small">
                                    <thead style="background:var(--color-1);">
                                        <tr>
                                            <th>No</th>
                                            <th class="text-start">Kategori Penerima</th>
                                            <th>Jumlah (KK)</th>
                                            <th>Persentase</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($blt as $i => $row)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td class="text-start px-3">{{ $row->label }}</td>
                                            <td class="fw-bold" style="color:var(--color-6);">{{ number_format($row->jumlah) }}</td>
                                            <td>{{ $bltTotal > 0 ? round(($row->jumlah / $bltTotal) * 100, 1) : 0 }}%</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot style="background:var(--color-1);font-weight:700;">
                                        <tr>
                                            <td colspan="2" class="text-start px-3">TOTAL</td>
                                            <td style="color:var(--color-6);">{{ number_format($bltTotal) }}</td>
                                            <td>100%</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <h6 class="fw-bold mb-3 mt-4" style="color:var(--color-7);">Syarat Penerima BLT Dana Desa</h6>
                            <div>
                                <div class="syarat-item"><i class="fas fa-check-circle"></i><span>Keluarga miskin yang <strong>tidak</strong> terdaftar dalam penerima PKH maupun BPNT</span></div>
                                <div class="syarat-item"><i class="fas fa-check-circle"></i><span>Kehilangan mata pencaharian akibat kondisi ekonomi atau bencana</span></div>
                                <div class="syarat-item"><i class="fas fa-check-circle"></i><span>Mempunyai anggota keluarga yang rentan sakit kronis atau disabilitas</span></div>
                                <div class="syarat-item"><i class="fas fa-check-circle"></i><span>Diusulkan oleh RT/RW dan diverifikasi oleh perangkat desa</span></div>
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

var pkhLabels  = @json($pkh->pluck('label'));
var pkhJumlah  = @json($pkh->pluck('jumlah'));
var bpntLabels = @json($bpnt->pluck('label'));
var bpntJumlah = @json($bpnt->pluck('jumlah'));
var bltLabels  = @json($blt->pluck('label'));
var bltJumlah  = @json($blt->pluck('jumlah'));

// PKH
new ApexCharts(document.querySelector("#chart-pkh"), {
    series: [{ name: 'Jiwa', data: pkhJumlah }],
    chart: { type: 'bar', height: 300, toolbar: { show: false } },
    plotOptions: { bar: { borderRadius: 6, horizontal: true, distributed: true } },
    colors: [c5, c1, c2, c3, c4, '#8FD4C2', '#adb5bd'],
    xaxis: { categories: pkhLabels },
    dataLabels: { enabled: true, style: { colors: ['#fff'] } },
    legend: { show: false },
    tooltip: { y: { formatter: v => v + ' jiwa' } },
}).render();

// BPNT
new ApexCharts(document.querySelector("#chart-bpnt"), {
    series: bpntJumlah,
    chart: { type: 'donut', height: 280 },
    labels: bpntLabels,
    colors: ['#198754', '#fd7e14', '#dc3545'],
    legend: { position: 'bottom' },
    plotOptions: { pie: { donut: { size: '65%', labels: { show: true, total: { show: true, label: 'Total KPM', color: c6 } } } } },
    dataLabels: { enabled: true },
}).render();

// BLT
new ApexCharts(document.querySelector("#chart-blt"), {
    series: bltJumlah,
    chart: { type: 'pie', height: 280 },
    labels: bltLabels,
    colors: [c5, c1, c2, c4],
    legend: { position: 'bottom' },
    dataLabels: { enabled: true },
}).render();
</script>
@endpush
