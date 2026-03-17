<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Resmi Desa Tajungan - Bangkalan</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        :root { 
            --navy: #002b5b; 
            --gold: #f9d923; 
            --teal: #2b7a78;
            --white-glass: rgba(255, 255, 255, 0.15); 
        }
        
        body { font-family: 'Poppins', sans-serif; background-color: #f4f7f6; scroll-behavior: smooth; overflow-x: hidden; }
        
        /* --- NAVBAR & DROPDOWN HOVER --- */
        .navbar { background: var(--navy) !important; padding: 15px 0; transition: 0.3s; }
        
        @media (min-width: 992px) {
            .navbar .nav-item.dropdown:hover .dropdown-menu {
                display: block;
                margin-top: 0; 
                opacity: 1;
                visibility: visible;
                transform: translateY(0);
            }
            .dropdown-menu {
                display: block;
                opacity: 0;
                visibility: hidden;
                transition: all 0.3s ease;
                transform: translateY(10px);
                border: none;
                border-radius: 12px;
                box-shadow: 0 10px 25px rgba(0,0,0,0.2);
                padding: 10px;
                background: rgba(0, 43, 91, 0.85);
                backdrop-filter: blur(8px);
                border: 1px solid rgba(255, 255, 255, 0.1);
            }
        }

        .dropdown-item { 
            padding: 10px 15px; 
            border-radius: 8px; 
            font-size: 0.9rem; 
            transition: 0.2s; 
            color: rgba(255, 255, 255, 0.9) !important;
        }
        .dropdown-item:hover { 
            background: rgba(255, 255, 255, 0.1); 
            color: var(--gold) !important; 
        }
        .dropdown-item i { width: 25px; color: var(--gold); }

        .btn-admin-custom {
            background: var(--white-glass);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white !important;
            border-radius: 50px;
            font-weight: 600;
            backdrop-filter: blur(5px);
            transition: 0.3s;
        }
        .btn-admin-custom:hover { background: white; color: var(--navy) !important; transform: scale(1.05); }

        /* --- SECTIONS --- */
        .hero { 
            background: linear-gradient(rgba(0,0,0,0.65), rgba(0,0,0,0.65)), 
                        url('https://images.unsplash.com/photo-1500382017468-9049fed747ef?auto=format&fit=crop&w=1600&q=80'); 
            background-size: cover; background-position: center; height: 85vh; display: flex; align-items: center; color: white;
        }

        .card-stats { border: none; border-top: 5px solid var(--navy); border-radius: 15px; transition: 0.3s; }
        .card-stats:hover { transform: translateY(-10px); box-shadow: 0 15px 30px rgba(0,0,0,0.1); }

        #map-preview { height: 400px; border-radius: 20px; border: 5px solid white; box-shadow: 0 10px 25px rgba(0,0,0,0.1); }
        
        .news-card { border: none; border-radius: 18px; overflow: hidden; transition: 0.4s; background: white; }
        .news-card:hover { transform: translateY(-8px); box-shadow: 0 12px 25px rgba(0,0,0,0.15); }

        footer { background: var(--navy); color: white; padding: 70px 0 30px; }

        /* --- LOGO DESA CANTIK FLOATING EFFECT --- */
        .floating-logo {
            animation: float 4s ease-in-out infinite;
            filter: drop-shadow(0 10px 15px rgba(0,0,0,0.1));
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark sticky-top shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#"><i class="fas fa-landmark me-2"></i> DESA TAJUNGAN</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item"><a class="nav-link px-3 active" href="#beranda">Beranda</a></li>
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle px-3" href="#">Tentang Desa</a>
                    <ul class="dropdown-menu shadow">
                        <li><a class="dropdown-item" href="{{ route('informasi.publik') }}"><i class="fas fa-file-invoice"></i> Informasi Publik</a></li>
                        <li><a class="dropdown-item" href="{{ route('transparansi.anggaran') }}"><i class="fas fa-coins"></i> Transparansi Anggaran</a></li>
                        <li><a class="dropdown-item" href="{{ route('arsip.artikel') }}"><i class="fas fa-book"></i> Arsip Artikel</a></li>
                        <li><a class="dropdown-item" href="{{ route('layanan.desa') }}"><i class="fas fa-headset"></i> Layanan Desa</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle px-3" href="#">Statistik Desa</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-user-friends"></i> Statistik Penduduk</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-users"></i> Statistik Keluarga</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-hand-holding-heart"></i> Statistik Bantuan</a></li>
                    </ul>
                </li>

                <li class="nav-item"><a class="nav-link px-3" href="/umkm-desa">UMKM Desa</a></li>

                <li class="nav-item ms-lg-3">
                    <a class="nav-link btn-admin-custom px-4" href="/admin">
                        <i class="fas fa-user-shield me-2"></i> Admin
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<section class="hero text-center" id="beranda">
    <div class="container" data-aos="fade-up">
        <h1 class="display-2 fw-bold mb-3">Selamat Datang di <br>Desa Tajungan</h1>
        <p class="lead mb-5 fs-4">Kecamatan Kamal, Kabupaten Bangkalan - Madura</p>
        <div class="d-flex justify-content-center gap-3">
            <a href="#statistik-section" class="btn btn-warning btn-lg px-5 py-3 fw-bold rounded-pill shadow">Lihat Data Desa</a>
            <a href="#map-section" class="btn btn-outline-light btn-lg px-5 py-3 rounded-pill">Lokasi Desa</a>
        </div>
    </div>
</section>

<section class="py-5 bg-white">
    <div class="container py-4">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 text-center">
                <div class="floating-logo">
                    <img src="{{ asset('img/desa cantik.png') }}" alt="Logo Desa Cantik" class="img-fluid" style="max-height: 350px;">
                </div>
            </div>
            <div class="col-lg-6 ps-lg-5">
                <h6 class="text-primary fw-bold text-uppercase tracking-widest">Program Unggulan</h6>
                <h2 class="display-5 fw-bold mb-4">Mewujudkan Desa Cantik <br>(Cinta Statistik)</h2>
                <p class="text-muted fs-5">Kami berkomitmen membangun Desa Tajungan berdasarkan data yang akurat. Dengan digitalisasi data, layanan masyarakat menjadi lebih cepat, transparan, dan tepat sasaran.</p>
                <div class="row mt-4 g-3">
                    <div class="col-6">
                        <div class="p-3 border rounded-4 text-start"><i class="fas fa-chart-line text-teal mb-2 fs-3"></i><h6 class="fw-bold">Data Akurat</h6></div>
                    </div>
                    <div class="col-6">
                        <div class="p-3 border rounded-4 text-start"><i class="fas fa-shield-alt text-teal mb-2 fs-3"></i><h6 class="fw-bold">Transparansi</h6></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light" id="statistik-section">
    <div class="container">
        <div class="row g-4 text-center">
            <div class="col-md-3">
                <div class="card p-4 card-stats shadow-sm h-100">
                    <div class="bg-light rounded-circle p-3 mx-auto mb-3" style="width: 70px;"><i class="fas fa-users fs-3 text-primary"></i></div>
                    <h3 class="fw-bold">2.450</h3>
                    <p class="text-muted mb-0">Total Penduduk</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-4 card-stats shadow-sm h-100">
                    <div class="bg-light rounded-circle p-3 mx-auto mb-3" style="width: 70px;"><i class="fas fa-ruler-combined fs-3 text-primary"></i></div>
                    <h3 class="fw-bold">145</h3>
                    <p class="text-muted mb-0">Luas Wilayah (Ha)</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-4 card-stats shadow-sm h-100">
                    <div class="bg-light rounded-circle p-3 mx-auto mb-3" style="width: 70px;"><i class="fas fa-map-signs fs-3 text-primary"></i></div>
                    <h3 class="fw-bold">12 / 04</h3>
                    <p class="text-muted mb-0">Jumlah RT / RW</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-4 card-stats shadow-sm h-100">
                    <div class="bg-light rounded-circle p-3 mx-auto mb-3" style="width: 70px;"><i class="fas fa-store-alt fs-3 text-primary"></i></div>
                    <h3 class="fw-bold">45</h3>
                    <p class="text-muted mb-0">UMKM Terdaftar</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-white" id="map-section">
    <div class="container">
        <div class="row g-4 align-items-stretch">
            <div class="col-lg-5 text-start">
                <div class="card border-0 shadow-sm p-4 rounded-4 h-100">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-bold mb-0"><i class="fas fa-chart-pie me-2 text-primary"></i> Data Pendidikan</h5>
                        <span class="badge bg-soft-primary text-primary">Update 2024</span>
                    </div>
                    <div id="chartPendidikan"></div>
                    <div class="mt-4 p-3 bg-light rounded-3">
                        <small class="text-muted">Data ini mencakup seluruh warga produktif di Desa Tajungan.</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 text-start">
                <div class="card border-0 shadow-sm p-4 rounded-4 h-100">
                    <h5 class="fw-bold mb-4"><i class="fas fa-map-marked-alt me-2 text-danger"></i> Shortcut Peta Desa Tajungan</h5>
                    <div id="map-preview"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light" id="berita">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-5 text-start">
            <div>
                <h2 class="fw-bold mb-1">Berita Terbaru</h2>
                <p class="text-muted">Informasi terkini seputar kegiatan Desa Tajungan</p>
            </div>
            <a href="#" class="btn btn-navy text-white rounded-pill px-4" style="background: var(--navy);">Lihat Semua Berita</a>
        </div>
        <div class="row g-4 text-start">
            <div class="col-md-4">
                <div class="card news-card shadow-sm h-100">
                    <img src="https://images.unsplash.com/photo-1540910419892-4a36d2c3266c?auto=format&fit=crop&w=400&q=80" class="card-img-top" alt="Berita">
                    <div class="card-body p-4">
                        <span class="badge bg-success mb-2">Ekonomi</span>
                        <h5 class="fw-bold mb-3">Pesta Rakyat & Bazaar UMKM Tajungan 2026</h5>
                        <p class="text-muted small mb-3">Meningkatkan ekonomi lokal melalui kolaborasi warga...</p>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted"><i class="far fa-calendar-alt me-1"></i> 09 Maret 2026</small>
                            <a href="#" class="text-primary fw-bold text-decoration-none small">Baca →</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card news-card shadow-sm h-100">
                    <img src="https://images.unsplash.com/photo-1531206715517-5c0ba140b2b8?auto=format&fit=crop&w=400&q=80" class="card-img-top" alt="Berita">
                    <div class="card-body p-4">
                        <span class="badge bg-primary mb-2">Kesehatan</span>
                        <h5 class="fw-bold mb-3">Jadwal Posyandu & Cek Kesehatan Gratis</h5>
                        <p class="text-muted small mb-3">Kegiatan rutin bulanan untuk menjaga kesehatan balita dan lansia...</p>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted"><i class="far fa-calendar-alt me-1"></i> 07 Maret 2026</small>
                            <a href="#" class="text-primary fw-bold text-decoration-none small">Baca →</a>
                        </div>
                    </div>
                </div>
            </div>
             <div class="col-md-4">
                <div class="card news-card shadow-sm h-100">
                    <img src="https://images.unsplash.com/photo-1526628953301-3e589a6a8b74?auto=format&fit=crop&w=400&q=80" class="card-img-top" alt="Berita">
                    <div class="card-body p-4">
                        <span class="badge bg-info mb-2">Pembangunan</span>
                        <h5 class="fw-bold mb-3">Perbaikan Drainase Dusun Pesisir</h5>
                        <p class="text-muted small mb-3">Upaya antisipasi banjir di musim hujan bagi warga pesisir...</p>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted"><i class="far fa-calendar-alt me-1"></i> 05 Maret 2026</small>
                            <a href="#" class="text-primary fw-bold text-decoration-none small">Baca →</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<footer>
    <div class="container text-start">
        <div class="row g-5">
            <div class="col-lg-4">
                <h4 class="fw-bold mb-4 text-warning">DESA TAJUNGAN</h4>
                <p class="opacity-75 lh-lg">Mewujudkan tata kelola pemerintahan desa yang bersih, transparan, dan berorientasi pada data statistik untuk kesejahteraan warga.</p>
                <div class="mt-4">
                    <h6 class="fw-bold mb-3">Kecamatan Kamal, Bangkalan</h6>
                </div>
            </div>
            <div class="col-lg-4">
                <h5 class="fw-bold mb-4 border-bottom pb-2">Kontak Kami</h5>
                <ul class="list-unstyled">
                    <li class="mb-3 d-flex align-items-start"><i class="fas fa-map-marker-alt mt-1 me-3 text-warning"></i> <span>Jl. Raya Tajungan No. 01, Kamal, Bangkalan 69162</span></li>
                    <li class="mb-3 d-flex align-items-center"><i class="fas fa-phone-alt me-3 text-warning"></i> <span>+62 812-3456-7890</span></li>
                    <li class="mb-3 d-flex align-items-center"><i class="fas fa-envelope me-3 text-warning"></i> <span>pemdes@tajungan.desa.id</span></li>
                </ul>
            </div>
            <div class="col-lg-4">
                <h5 class="fw-bold mb-4 border-bottom pb-2">Media Sosial</h5>
                <p class="small mb-4">Ikuti akun resmi kami untuk update informasi desa:</p>
                <div class="d-flex gap-3">
                    <a href="#" class="btn btn-outline-light rounded-circle" style="width: 45px; height: 45px;"><i class="fab fa-facebook-f mt-1"></i></a>
                    <a href="#" class="btn btn-outline-light rounded-circle" style="width: 45px; height: 45px;"><i class="fab fa-instagram mt-1"></i></a>
                    <a href="#" class="btn btn-outline-light rounded-circle" style="width: 45px; height: 45px;"><i class="fab fa-youtube mt-1"></i></a>
                    <a href="#" class="btn btn-outline-light rounded-circle" style="width: 45px; height: 45px;"><i class="fab fa-whatsapp mt-1"></i></a>
                </div>
            </div>
        </div>
        <hr class="mt-5 opacity-25">
        <div class="text-center small opacity-50">
            <p class="mb-0">&copy; 2026 Pemerintah Desa Tajungan. Seluruh Hak Cipta Dilindungi.</p>
            <p>Powered by <b>Desa Cantik Kamal</b></p>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
    const lat = -7.1544793;
    const lng = 112.6961147;

    var map = L.map('map-preview', {
        scrollWheelZoom: false
    }).setView([lat, lng], 16);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap'
    }).addTo(map);

    var desaIcon = L.icon({
        iconUrl: 'https://cdn-icons-png.flaticon.com/512/684/684908.png',
        iconSize: [40,40],
        iconAnchor: [20,40]
    });

    var marker = L.marker([lat, lng], { icon: desaIcon }).addTo(map);

    marker.bindPopup(`
        <b>Kantor Desa Tajungan</b><br>
        Jl Raya Gilih, Tajungan<br>
        Kec. Kamal, Kab. Bangkalan<br>
        Jawa Timur<br><br>

        <a href="https://www.google.com/maps?q=-7.1549117,112.6938156"
        target="_blank"
        style="
            background:#002b5b;
            color:white;
            padding:6px 12px;
            border-radius:6px;
            text-decoration:none;
            font-size:13px;
        ">
        Buka di Google Maps
        </a>
    `).openPopup();

    L.circle([lat, lng], {
        color: '#002b5b',
        fillColor: '#002b5b',
        fillOpacity: 0.15,
        radius: 1200
    }).addTo(map);

    setTimeout(function(){
        map.invalidateSize();
    },500);
</script>


<script>
    var options = {
        series: [{ 
            name: 'Jumlah Warga', 
            data: {!! json_encode($data_pendidikan->pluck('jumlah')) !!} 
        }],
        chart: { type: 'bar', height: 300, toolbar: { show: false } },
        plotOptions: { bar: { borderRadius: 8, distributed: true, columnWidth: '50%' } },
        colors: ['#002b5b', '#2b7a78', '#f9d923', '#17a2b8', '#6c757d'],
        xaxis: { 
            categories: {!! json_encode($data_pendidikan->pluck('label')) !!}, 
            labels: { style: { fontSize: '11px' } } 
        },
        legend: { show: false },
        dataLabels: { enabled: true }
    };
    var chart = new ApexCharts(document.querySelector("#chartPendidikan"), options);
    chart.render();
</script>

</body>
</html>