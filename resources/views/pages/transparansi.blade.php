@extends('layouts.app')

@section('content')
<section class="py-5" style="background: var(--navy); color: white;">
    <div class="container text-center pt-5">
        <h1 class="fw-bold">Transparansi Anggaran</h1>
        <p class="lead opacity-75">Laporan Pendapatan dan Belanja Desa (APBDes) Tahun Anggaran 2026</p>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">
        
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm p-4 rounded-4 border-start border-primary border-5">
                    <small class="text-muted fw-bold">TOTAL PENDAPATAN</small>
                    <h3 class="fw-bold text-primary mt-2">Rp 1.250.000.000</h3>
                    <div class="progress mt-3" style="height: 8px;">
                        <div class="progress-bar bg-primary" style="width: 100%"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm p-4 rounded-4 border-start border-success border-5">
                    <small class="text-muted fw-bold">TOTAL BELANJA (REALISASI)</small>
                    <h3 class="fw-bold text-success mt-2">Rp 850.400.000</h3>
                    <div class="progress mt-3" style="height: 8px;">
                        <div class="progress-bar bg-success" style="width: 68%"></div>
                    </div>
                    <small class="mt-2 d-block text-muted">Realisasi: 68%</small>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm p-4 rounded-4 border-start border-warning border-5">
                    <small class="text-muted fw-bold">SISA ANGGARAN (SILPA)</small>
                    <h3 class="fw-bold text-warning mt-2">Rp 399.600.000</h3>
                    <div class="progress mt-3" style="height: 8px;">
                        <div class="progress-bar bg-warning" style="width: 32%"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4 p-4">
            <h5 class="fw-bold mb-4"><i class="fas fa-list-ul me-2 text-primary"></i> Rincian Bidang Pelaksanaan</h5>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="py-3 px-3">Bidang / Kegiatan</th>
                            <th class="py-3">Anggaran (Rp)</th>
                            <th class="py-3">Realisasi (Rp)</th>
                            <th class="py-3 text-center">Persentase</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="px-3 fw-bold">Penyelenggaraan Pemerintahan Desa</td>
                            <td>450.000.000</td>
                            <td>315.000.000</td>
                            <td class="text-center">
                                <span class="badge bg-soft-primary text-primary px-3">70%</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 fw-bold">Pembangunan Desa (Infrastruktur)</td>
                            <td>550.000.000</td>
                            <td>412.500.000</td>
                            <td class="text-center">
                                <span class="badge bg-soft-success text-success px-3">75%</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 fw-bold">Pembinaan Kemasyarakatan</td>
                            <td>150.000.000</td>
                            <td>80.000.000</td>
                            <td class="text-center">
                                <span class="badge bg-soft-info text-info px-3">53%</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 fw-bold">Pemberdayaan Masyarakat (UMKM)</td>
                            <td>100.000.000</td>
                            <td>42.900.000</td>
                            <td class="text-center">
                                <span class="badge bg-soft-warning text-warning px-3">42.9%</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4 p-3 bg-light rounded-3 d-flex align-items-center">
                <i class="fas fa-info-circle text-primary me-3 fs-4"></i>
                <small class="text-muted">Data ini diperbarui secara berkala sesuai dengan laporan realisasi bulanan Bendahara Desa Tajungan.</small>
            </div>
        </div>

    </div>
</section>

<style>
    .bg-soft-primary { background-color: rgba(0, 43, 91, 0.1); }
    .bg-soft-success { background-color: rgba(25, 135, 84, 0.1); }
    .bg-soft-info { background-color: rgba(13, 202, 240, 0.1); }
    .bg-soft-warning { background-color: rgba(255, 193, 7, 0.1); }
    .table thead th { font-size: 0.85rem; letter-spacing: 0.5px; }
</style>
@endsection