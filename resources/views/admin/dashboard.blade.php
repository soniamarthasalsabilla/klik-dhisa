@extends('layouts.admin')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

{{-- Stat Cards --}}
<div class="row g-3 mb-4">

    @php
    $cards = [
        ['label' => 'UMKM Terdaftar',    'value' => $total_umkm,      'icon' => 'fa-store',        'color' => 'var(--color-5)', 'route' => route('admin.umkm')],
        ['label' => 'Berita & Artikel',   'value' => $total_artikel,   'icon' => 'fa-newspaper',    'color' => '#0d6efd',        'route' => route('admin.artikel.index')],
        ['label' => 'Galeri Foto',        'value' => $total_galeri,    'icon' => 'fa-images',       'color' => '#6f42c1',        'route' => route('admin.galeri.index')],
        ['label' => 'Perangkat Desa',     'value' => $total_pamong,    'icon' => 'fa-sitemap',      'color' => '#fd7e14',        'route' => route('admin.pamong.index')],
        ['label' => 'Agenda Mendatang',   'value' => $agenda_aktif,    'icon' => 'fa-calendar-alt', 'color' => '#20c997',        'route' => route('admin.agenda.index')],
        ['label' => 'Pengaduan Masuk',    'value' => $total_pengaduan, 'icon' => 'fa-comment-dots', 'color' => '#dc3545',        'route' => route('admin.pengaduan.index'),
         'badge' => $pengaduan_baru > 0 ? $pengaduan_baru . ' baru' : null],
    ];
    @endphp

    @foreach($cards as $card)
    <div class="col-xl-2 col-md-4 col-6">
        <a href="{{ $card['route'] }}" class="text-decoration-none">
            <div class="card border-0 shadow-sm h-100 card-stat">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="stat-icon rounded-3 d-flex align-items-center justify-content-center"
                             style="width:40px;height:40px;background:{{ $card['color'] }}20;">
                            <i class="fas {{ $card['icon'] }}" style="color:{{ $card['color'] }};font-size:1rem;"></i>
                        </div>
                        @if(!empty($card['badge']))
                            <span class="badge bg-danger" style="font-size:.65rem;">{{ $card['badge'] }}</span>
                        @endif
                    </div>
                    <div class="fw-bold fs-4 text-dark mb-0">{{ $card['value'] }}</div>
                    <div class="text-muted" style="font-size:.78rem;">{{ $card['label'] }}</div>
                </div>
            </div>
        </a>
    </div>
    @endforeach

</div>

{{-- Charts + Agenda --}}
<div class="row g-3 mb-4">

    {{-- UMKM Chart --}}
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-0 pt-3 pb-0">
                <h6 class="fw-bold mb-0 text-navy"><i class="fas fa-chart-pie me-2 text-muted"></i>Distribusi UMKM</h6>
            </div>
            <div class="card-body d-flex align-items-center justify-content-center p-3">
                @if(count($umkm_categories) > 0)
                    <canvas id="umkmChart" height="220"></canvas>
                @else
                    <div class="text-center text-muted py-4">
                        <i class="fas fa-store fa-2x opacity-25 mb-2"></i>
                        <p class="small">Belum ada data UMKM</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Agenda Mendatang --}}
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-0 pt-3 pb-0 d-flex justify-content-between align-items-center">
                <h6 class="fw-bold mb-0 text-navy"><i class="fas fa-calendar-check me-2 text-muted"></i>Agenda Mendatang</h6>
                <a href="{{ route('admin.agenda.index') }}" class="small text-muted text-decoration-none">Semua →</a>
            </div>
            <div class="card-body p-0">
                @forelse($agenda_terkini as $ag)
                <div class="d-flex align-items-center gap-3 px-3 py-2 {{ !$loop->last ? 'border-bottom' : '' }}">
                    <div class="text-center flex-shrink-0 rounded-2 py-1 px-2" style="background:var(--color-1);min-width:44px;">
                        <div class="fw-bold text-navy" style="font-size:.85rem;line-height:1;">{{ $ag->tanggal->format('d') }}</div>
                        <div class="text-muted" style="font-size:.65rem;text-transform:uppercase;">{{ $ag->tanggal->format('M') }}</div>
                    </div>
                    <div class="flex-grow-1 overflow-hidden">
                        <p class="fw-semibold mb-0 text-truncate small">{{ $ag->judul }}</p>
                        <small class="text-muted">{{ $ag->kategori }} @if($ag->lokasi) · {{ Str::limit($ag->lokasi, 20) }} @endif</small>
                    </div>
                </div>
                @empty
                <div class="text-center text-muted py-4">
                    <i class="fas fa-calendar-times fa-2x opacity-25 mb-2"></i>
                    <p class="small">Tidak ada agenda mendatang</p>
                </div>
                @endforelse
            </div>
            @if($agenda_aktif > 0)
            <div class="card-footer bg-white border-0 pt-0 pb-3 px-3">
                <a href="{{ route('admin.agenda.create') }}" class="btn btn-sm btn-outline-secondary w-100 rounded-pill">
                    <i class="fas fa-plus me-1"></i>Tambah Agenda
                </a>
            </div>
            @endif
        </div>
    </div>

    {{-- Quick Access --}}
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-0 pt-3 pb-0">
                <h6 class="fw-bold mb-0 text-navy"><i class="fas fa-bolt me-2 text-muted"></i>Akses Cepat</h6>
            </div>
            <div class="card-body p-3">
                @php
                $quicklinks = [
                    ['href' => route('admin.create'),                   'icon' => 'fa-plus-circle',      'label' => 'Tambah UMKM',       'color' => 'var(--color-5)'],
                    ['href' => route('admin.artikel.create'),           'icon' => 'fa-pen',              'label' => 'Tulis Artikel',     'color' => '#0d6efd'],
                    ['href' => route('admin.galeri.create'),            'icon' => 'fa-camera',           'label' => 'Upload Galeri',     'color' => '#6f42c1'],
                    ['href' => route('admin.agenda.create'),            'icon' => 'fa-calendar-plus',    'label' => 'Buat Agenda',       'color' => '#20c997'],
                    ['href' => route('admin.apbdes.create'),            'icon' => 'fa-coins',            'label' => 'Input APBDes',      'color' => '#ffc107'],
                    ['href' => route('admin.pengaduan.index'),          'icon' => 'fa-comment-dots',     'label' => 'Lihat Pengaduan',   'color' => '#dc3545'],
                    ['href' => route('admin.statistik'),                'icon' => 'fa-chart-bar',        'label' => 'Kelola Statistik',  'color' => '#fd7e14'],
                    ['href' => route('admin.profil_desa'),              'icon' => 'fa-landmark',         'label' => 'Profil Desa',       'color' => 'var(--color-6)'],
                ];
                @endphp
                <div class="row g-2">
                    @foreach($quicklinks as $ql)
                    <div class="col-6">
                        <a href="{{ $ql['href'] }}" class="d-flex align-items-center gap-2 p-2 rounded-3 text-decoration-none quick-link">
                            <i class="fas {{ $ql['icon'] }}" style="color:{{ $ql['color'] }};width:16px;text-align:center;"></i>
                            <span class="small text-dark">{{ $ql['label'] }}</span>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</div>

{{-- Pengaduan Terbaru --}}
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-0 pt-3 pb-0 d-flex justify-content-between align-items-center">
        <h6 class="fw-bold mb-0 text-navy"><i class="fas fa-comment-dots me-2 text-muted"></i>Pengaduan Terbaru</h6>
        <a href="{{ route('admin.pengaduan.index') }}" class="small text-muted text-decoration-none">Lihat Semua →</a>
    </div>
    <div class="card-body p-0">
        @if($pengaduan_terbaru->isEmpty())
        <div class="text-center text-muted py-4">
            <i class="fas fa-inbox fa-2x opacity-25 mb-2"></i>
            <p class="small">Belum ada pengaduan masuk</p>
        </div>
        @else
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 small">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">Nama</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pengaduan_terbaru as $p)
                    @php
                    $statusMap = [
                        'baru'       => ['label' => 'Baru',        'class' => 'bg-danger'],
                        'diproses'   => ['label' => 'Diproses',    'class' => 'bg-warning text-dark'],
                        'selesai'    => ['label' => 'Selesai',     'class' => 'bg-success'],
                        'ditolak'    => ['label' => 'Ditolak',     'class' => 'bg-secondary'],
                    ];
                    $st = $statusMap[$p->status] ?? ['label' => $p->status, 'class' => 'bg-secondary'];
                    @endphp
                    <tr>
                        <td class="ps-3 fw-semibold">{{ $p->nama }}</td>
                        <td class="text-truncate" style="max-width:200px;">{{ $p->judul }}</td>
                        <td><span class="badge bg-light text-dark border">{{ $p->kategori }}</span></td>
                        <td><span class="badge {{ $st['class'] }}">{{ $st['label'] }}</span></td>
                        <td class="text-muted">{{ $p->created_at->format('d M Y') }}</td>
                        <td>
                            <a href="{{ route('admin.pengaduan.show', $p) }}" class="btn btn-sm btn-outline-secondary rounded-pill py-0 px-2">Detail</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>

@push('styles')
<style>
    .card-stat { transition: transform 0.15s, box-shadow 0.15s; }
    .card-stat:hover { transform: translateY(-3px); box-shadow: 0 6px 20px rgba(0,0,0,0.1) !important; }
    .quick-link { transition: background 0.15s; }
    .quick-link:hover { background: var(--color-1) !important; }
    .text-navy { color: var(--color-6) !important; }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@if(count($umkm_categories) > 0)
<script>
new Chart(document.getElementById('umkmChart').getContext('2d'), {
    type: 'doughnut',
    data: {
        labels: {!! json_encode(array_keys($umkm_categories)) !!},
        datasets: [{
            data: {!! json_encode(array_values($umkm_categories)) !!},
            backgroundColor: ['#3A9A8C','#0d6efd','#ffc107','#dc3545','#6f42c1','#fd7e14','#20c997','#0dcaf0'],
            borderWidth: 2,
            borderColor: '#fff',
        }]
    },
    options: {
        responsive: true,
        cutout: '60%',
        plugins: {
            legend: { position: 'bottom', labels: { font: { size: 11 }, padding: 10, boxWidth: 12 } }
        }
    }
});
</script>
@endif
@endpush

@endsection
