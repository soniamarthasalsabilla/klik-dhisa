<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') – Desa Tajungan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,700&family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --color-1: #E8F5F0; --color-2: #B8E6D9; --color-3: #8FD4C2;
            --color-4: #5BBFAB; --color-5: #3A9A8C; --color-6: #2C7A6F;
            --color-7: #1E5A52; --gold: #f9d923;
        }
        body { font-family: 'Poppins', sans-serif; background-color: #f4f6f9; color: #333; overflow-x: hidden; }
        .text-navy { color: var(--color-7) !important; }
        .btn-desa-navy { background-color: var(--color-6); color: white; border-radius: 6px; border: none; transition: 0.2s; font-weight: 600; }
        .btn-desa-navy:hover { background-color: var(--color-7); color: white; }

        /* Layout */
        .admin-layout { display: flex; min-height: 100vh; }
        .admin-sidebar { width: 260px; position: fixed; height: 100vh; overflow-y: auto; background-color: var(--color-7); z-index: 1050; display: flex; flex-direction: column; }
        .admin-content { flex: 1; margin-left: 260px; display: flex; flex-direction: column; min-height: 100vh; }
        .content-header { position: sticky; top: 0; z-index: 999; background: white; border-bottom: 1px solid #e9ecef; padding: 14px 24px; display: flex; justify-content: space-between; align-items: center; }
        .content-body { flex: 1; padding: 24px; background: #f4f6f9; }

        /* Sidebar */
        .sidebar-brand { padding: 20px 20px 10px; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .sidebar-brand a { text-decoration: none; color: white; font-weight: 700; font-size: 1rem; display: flex; align-items: center; gap: 8px; }
        .sidebar-nav { padding: 12px 12px; flex: 1; }
        .sidebar-label { font-size: 0.68rem; text-transform: uppercase; letter-spacing: 1px; color: rgba(255,255,255,0.4); padding: 12px 8px 4px; font-weight: 600; }
        .sidebar-nav .nav-link { display: flex; align-items: center; gap: 10px; color: rgba(255,255,255,0.8); text-decoration: none; padding: 9px 12px; margin-bottom: 2px; border-radius: 6px; font-size: 0.88rem; transition: 0.2s; }
        .sidebar-nav .nav-link:hover, .sidebar-nav .nav-link.active { background-color: rgba(255,255,255,0.15); color: white; }
        .sidebar-nav .nav-link i { width: 18px; text-align: center; font-size: 0.85rem; }
        .sidebar-footer { padding: 12px; border-top: 1px solid rgba(255,255,255,0.1); }
    </style>
    @stack('styles')
</head>
<body>
<div class="admin-layout">

    <!-- Sidebar -->
    <div class="admin-sidebar">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}">
                <i class="fas fa-landmark" style="color: var(--gold);"></i>
                <span>Admin Desa Tajungan</span>
            </a>
            <p class="mb-0 mt-1" style="font-size: 0.72rem; color: rgba(255,255,255,0.4);">Desa Cantik Bangkalan</p>
        </div>

        <nav class="sidebar-nav">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>

            <div class="sidebar-label">UMKM</div>
            <a href="{{ route('admin.umkm') }}" class="nav-link {{ request()->routeIs('admin.umkm*') ? 'active' : '' }}">
                <i class="fas fa-store"></i> Kelola UMKM
            </a>
            <a href="{{ route('admin.create') }}" class="nav-link {{ request()->routeIs('admin.create') ? 'active' : '' }}">
                <i class="fas fa-plus-circle"></i> Tambah UMKM
            </a>

            <div class="sidebar-label">KONTEN</div>
            <a href="{{ route('admin.content.manage', 'informasi') }}" class="nav-link">
                <i class="fas fa-info-circle"></i> Informasi Publik
            </a>
            <a href="{{ route('admin.content.manage', 'arsip') }}" class="nav-link">
                <i class="fas fa-archive"></i> Arsip Dokumen
            </a>
            <a href="{{ route('admin.content.manage', 'layanan') }}" class="nav-link">
                <i class="fas fa-concierge-bell"></i> Layanan Desa
            </a>

            <div class="sidebar-label">STATISTIK</div>
            <a href="{{ route('admin.statistik') }}" class="nav-link {{ request()->routeIs('admin.statistik*') ? 'active' : '' }}">
                <i class="fas fa-chart-bar"></i> Kelola Statistik
            </a>

            <div class="sidebar-label">PROFIL DESA</div>
            <a href="{{ route('admin.profil_desa') }}" class="nav-link {{ request()->routeIs('admin.profil_desa') ? 'active' : '' }}">
                <i class="fas fa-landmark"></i> Identitas & Profil
            </a>
            <a href="{{ route('admin.content.manage', 'kades') }}" class="nav-link">
                <i class="fas fa-user-tie"></i> Profil Kades
            </a>
            <a href="{{ route('admin.pamong.index') }}" class="nav-link {{ request()->routeIs('admin.pamong*') ? 'active' : '' }}">
                <i class="fas fa-sitemap"></i> Struktur Pamong
            </a>

            <div class="sidebar-label">ASET & INVENTARIS</div>
            <a href="{{ route('admin.aset.index') }}" class="nav-link {{ request()->routeIs('admin.aset*') ? 'active' : '' }}">
                <i class="fas fa-building"></i> Aset Desa
            </a>

            <div class="sidebar-label">PETA TEMATIK</div>
            <a href="{{ route('admin.peta') }}" class="nav-link {{ request()->routeIs('admin.peta*') ? 'active' : '' }}">
                <i class="fas fa-map-marked-alt"></i> Kelola Peta
            </a>

            <div class="sidebar-label">MEDIA</div>
            <a href="{{ route('admin.galeri.index') }}" class="nav-link {{ request()->routeIs('admin.galeri*') ? 'active' : '' }}">
                <i class="fas fa-images"></i> Galeri Foto
            </a>
            <a href="{{ route('admin.artikel.index') }}" class="nav-link {{ request()->routeIs('admin.artikel*') ? 'active' : '' }}">
                <i class="fas fa-newspaper"></i> Berita & Artikel
            </a>

            <div class="sidebar-label">TRANSPARANSI</div>
            <a href="{{ route('admin.apbdes.index') }}" class="nav-link {{ request()->routeIs('admin.apbdes*') ? 'active' : '' }}">
                <i class="fas fa-coins"></i> APBDes
            </a>

            <div class="sidebar-label">PARTISIPASI</div>
            <a href="{{ route('admin.agenda.index') }}" class="nav-link {{ request()->routeIs('admin.agenda*') ? 'active' : '' }}">
                <i class="fas fa-calendar-alt"></i> Agenda Kegiatan
            </a>
            <a href="{{ route('admin.pengaduan.index') }}" class="nav-link {{ request()->routeIs('admin.pengaduan*') ? 'active' : '' }}">
                <i class="fas fa-comment-dots"></i> Pengaduan Warga
            </a>
        </nav>

        <div class="sidebar-footer">
            <a href="/" target="_blank" class="nav-link" style="color: rgba(255,255,255,0.6); font-size: 0.82rem; text-decoration: none;">
                <i class="fas fa-external-link-alt"></i> Lihat Website
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="admin-content">
        <div class="content-header">
            <div>
                <h5 class="mb-0 text-navy fw-bold">@yield('page-title', 'Panel Admin')</h5>
                @hasSection('breadcrumb')
                    <small class="text-muted">@yield('breadcrumb')</small>
                @endif
            </div>
            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-outline-danger btn-sm">
                    <i class="fas fa-sign-out-alt me-1"></i> Logout
                </button>
            </form>
        </div>

        <div class="content-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
@stack('scripts')
</body>
</html>
