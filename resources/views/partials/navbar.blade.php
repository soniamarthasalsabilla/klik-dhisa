<nav class="navbar navbar-expand-lg navbar-dark sticky-top shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/"><i class="fas fa-landmark me-2"></i> DESA TAJUNGAN</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item"><a class="nav-link px-3 active" href="/">Beranda</a></li>
                
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
                        <li><a class="dropdown-item" href="{{ route('stat.penduduk') }}"><i class="fas fa-user-friends"></i> Statistik Penduduk</a></li>
                        <li><a class="dropdown-item" href="{{ route('stat.keluarga') }}"><i class="fas fa-users"></i> Statistik Keluarga</a></li>
                        <li><a class="dropdown-item" href="{{ route('stat.bantuan') }}"><i class="fas fa-hand-holding-heart"></i> Statistik Bantuan</a></li>
                    </ul>
                </li>

                <li class="nav-item"><a class="nav-link px-3" href="{{ route('umkm.desa') }}">UMKM Desa</a></li>

                <li class="nav-item ms-lg-3">
                    <a class="nav-link btn-admin-custom px-4" href="/admin">
                        <i class="fas fa-user-shield me-2"></i> Admin
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>