@extends('layouts.app')

@section('content')
<section class="py-5" style="background: var(--navy); color: white;">
    <div class="container text-center pt-5">
        <h1 class="fw-bold">Layanan Desa Digital</h1>
        <p class="lead opacity-75">Akses cepat layanan sosial dan administrasi untuk warga Desa Tajungan</p>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-navy">Pusat Bantuan & Layanan</h2>
            <p class="text-muted">Silakan pilih layanan yang ingin Anda akses di bawah ini</p>
        </div>

        <div class="row g-4 justify-content-center text-start">
            <div class="col-md-4 col-lg-3">
                <div class="card border-0 shadow-sm h-100 rounded-4 p-4 card-layanan text-center">
                    <div class="icon-box bg-soft-primary text-primary mb-4 mx-auto">
                        <i class="fas fa-hand-holding-heart fa-2x"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Cek Bansos</h5>
                    <p class="text-muted small mb-4">Cek status bantuan sosial (PKH, BPNT, BST) dari Kemensos RI.</p>
                    <a href="https://cekbansos.kemensos.go.id/" target="_blank" class="btn btn-navy btn-sm w-100 rounded-pill py-2 text-white" style="background: var(--navy);">Buka Layanan</a>
                </div>
            </div>

            <div class="col-md-4 col-lg-3">
                <div class="card border-0 shadow-sm h-100 rounded-4 p-4 card-layanan text-center">
                    <div class="icon-box bg-soft-warning text-warning mb-4 mx-auto">
                        <i class="fas fa-user-graduate fa-2x"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Cek PIP</h5>
                    <p class="text-muted small mb-4">Pantau status bantuan Program Indonesia Pintar untuk pelajar.</p>
                    <a href="https://pip.kemdikbud.go.id/" target="_blank" class="btn btn-navy btn-sm w-100 rounded-pill py-2 text-white" style="background: var(--navy);">Buka Layanan</a>
                </div>
            </div>

            <div class="col-md-4 col-lg-3">
                <div class="card border-0 shadow-sm h-100 rounded-4 p-4 card-layanan text-center">
                    <div class="icon-box bg-soft-success text-success mb-4 mx-auto">
                        <i class="fas fa-file-medical-alt fa-2x"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Cek BPJS</h5>
                    <p class="text-muted small mb-4">Layanan cek status kepesertaan dan iuran BPJS Kesehatan.</p>
                    <a href="https://www.bpjs-kesehatan.go.id/" target="_blank" class="btn btn-navy btn-sm w-100 rounded-pill py-2 text-white" style="background: var(--navy);">Buka Layanan</a>
                </div>
            </div>

            <div class="col-md-4 col-lg-3">
                <div class="card border-0 shadow-sm h-100 rounded-4 p-4 card-layanan text-center">
                    <div class="icon-box bg-soft-danger text-danger mb-4 mx-auto">
                        <i class="fas fa-id-card fa-2x"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Administrasi</h5>
                    <p class="text-muted small mb-4">Persyaratan pembuatan KK, KTP, dan surat pengantar desa.</p>
                    <a href="#" class="btn btn-navy btn-sm w-100 rounded-pill py-2 text-white" style="background: var(--navy);">Lihat Info</a>
                </div>
            </div>

            <div class="col-md-4 col-lg-3">
                <div class="card border-0 shadow-sm h-100 rounded-4 p-4 card-layanan text-center">
                    <div class="icon-box bg-soft-info text-info mb-4 mx-auto">
                        <i class="fas fa-bullhorn fa-2x"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Lapor Desa</h5>
                    <p class="text-muted small mb-4">Sampaikan keluhan atau aspirasi langsung ke pemerintah desa.</p>
                    <a href="https://wa.me/6281234567890" target="_blank" class="btn btn-success btn-sm w-100 rounded-pill py-2"><i class="fab fa-whatsapp me-2"></i>Hubungi Kami</a>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-lg-8 mx-auto text-center">
                <div class="p-4 bg-white rounded-4 shadow-sm">
                    <h6 class="fw-bold"><i class="fas fa-info-circle text-primary me-2"></i>Butuh Bantuan Lainnya?</h6>
                    <p class="text-muted mb-0">Jika layanan yang Anda cari tidak tersedia, silakan datang langsung ke Kantor Desa Tajungan pada jam kerja (Senin - Jumat, 08.00 - 15.00 WIB).</p>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .bg-soft-primary { background-color: rgba(0, 43, 91, 0.1); }
    .bg-soft-warning { background-color: rgba(249, 217, 35, 0.1); }
    .bg-soft-success { background-color: rgba(43, 122, 120, 0.1); }
    .bg-soft-danger { background-color: rgba(220, 53, 69, 0.1); }
    .bg-soft-info { background-color: rgba(13, 202, 240, 0.1); }

    .icon-box {
        width: 70px;
        height: 70px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 20px;
    }

    .card-layanan {
        transition: all 0.3s ease;
    }

    .card-layanan:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
    }

    .text-navy { color: var(--navy); }
</style>
@endsection