@extends('layouts.app')

@section('content')
<section class="py-3" style="background: white; border-bottom: 3px solid var(--color-5);">
    <div class="container text-center py-4">
        <h2 class="fw-bold mb-2" style="color: var(--color-7); font-size: 2rem;">Peta UMKM Desa</h2>
        <p class="mb-0" style="color: var(--color-6); font-size: 1rem;">Potensi Ekonomi Lokal Desa Tajungan</p>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 mb-4 text-start">
                <div class="card border-0 shadow-sm rounded-4 p-3 sticky-top" style="top: 100px;">
                    <h6 class="fw-bold mb-3 px-3 text-muted">CARI USAHA</h6>
                    <div class="px-3 mb-4">
                        <div class="input-group shadow-sm border rounded-pill overflow-hidden bg-white">
                            <span class="input-group-text bg-white border-0 ps-3">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" id="searchUMKM" class="form-control border-0 shadow-none" placeholder="Cari nama...">
                        </div>
                    </div>
                    <h6 class="fw-bold mb-3 px-3 text-muted text-uppercase" style="font-size: 0.75rem;">Daftar UMKM</h6>
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist">
                        @isset($semua_umkm)
                            @foreach($semua_umkm as $umkm)
                            <button onclick="focusMap({{ $umkm->latitude }}, {{ $umkm->longitude }}, '{{ addslashes($umkm->nama_usaha) }}')" 
                                    class="nav-link text-start mb-2 py-2 shadow-sm umkm-item border" 
                                    type="button" style="background: white;">
                                @if($umkm->foto)
                                    <img src="{{ asset('storage/' . $umkm->foto) }}" alt="{{ $umkm->nama_usaha }}" class="img-fluid rounded-2 mb-2" style="height: 80px; width: 100%; object-fit: cover;">
                                @else
                                    <div class="bg-light rounded-2 mb-2 d-flex align-items-center justify-content-center" style="height: 80px; font-size: 12px; color: #999;">
                                        <i class="fas fa-image me-1"></i> Tidak ada foto
                                    </div>
                                @endif
                                <i class="fas fa-store me-2"></i> {{ $umkm->nama_usaha }}
                                <div class="small opacity-50 ms-4" style="font-size: 10px;">{{ $umkm->pemilik }}</div>
                            </button>
                            @endforeach
                        @endisset
                    </div>
                </div>
            </div>

            <div class="col-lg-9 text-start">
                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <h4 class="fw-bold mb-4 text-navy">Sebaran Lokasi Usaha</h4>
                    <div id="mapUMKM" class="rounded-4 overflow-hidden shadow-sm" style="height: 550px; width: 100%; border: 1px solid rgba(0,0,0,0.05); z-index: 1;"></div>
                    <div class="mt-4 p-3 rounded-4 bg-soft-primary border">
                        <div class="row text-center small fw-bold text-navy">
                            <div class="col-md-3"><i class="fas fa-circle me-1 text-warning"></i> Makanan</div>
                            <div class="col-md-3"><i class="fas fa-circle me-1 text-primary"></i> Minuman</div>
                            <div class="col-md-3"><i class="fas fa-circle me-1 text-success"></i> Kerajinan</div>
                            <div class="col-md-3"><i class="fas fa-circle me-1 text-danger"></i> Jasa</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    :root { --navy: #002b5b; }
    .text-navy { color: var(--navy) !important; }
    .bg-soft-primary { background-color: rgba(0, 43, 91, 0.05) !important; }
    .nav-pills .nav-link { color: var(--navy) !important; border-radius: 12px !important; margin-bottom: 8px; transition: 0.3s; }
    .nav-pills .nav-link.active { background: var(--navy) !important; color: white !important; transform: scale(1.02); }
    #v-pills-tab { max-height: 500px; overflow-y: auto; }
</style>
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var map = L.map('mapUMKM').setView([-7.15539, 112.69323], 15);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
        
        var markers = {};

        function getMarkerColor(kategori) {
            if (!kategori) return '#6c757d';
            kategori = kategori.toLowerCase();
            if (kategori === 'makanan') return '#ffc107'; 
            if (kategori === 'minuman') return '#0d6efd'; 
            if (kategori === 'kerajinan') return '#198754'; 
            if (kategori === 'jasa') return '#dc3545'; 
            return '#6c757d'; 
        }

        @isset($semua_umkm)
            @foreach($semua_umkm as $umkm)
                var customIcon = L.divIcon({
                    className: "custom-marker",
                    html: `<div style="background-color: ${getMarkerColor('{{ $umkm->kategori }}')}; 
                            width: 25px; height: 25px; border-radius: 50% 50% 50% 0; 
                            transform: rotate(-45deg); border: 2px solid white; box-shadow: 0 0 5px rgba(0,0,0,0.3);">
                           </div>`,
                    iconSize: [25, 25],
                    iconAnchor: [12, 25],
                    popupAnchor: [1, -25]
                });

                var popupContent = `
                    <div style="min-width: 200px;">
                        @if($umkm->foto)
                        <img src="{{ asset('storage/' . $umkm->foto) }}" alt="{{ $umkm->nama_usaha }}" class="img-fluid rounded-2 mb-2" style="width: 100%; height: 150px; object-fit: cover;">
                        @endif
                        <h6 class="fw-bold mb-1" style="color:var(--navy);">{{ $umkm->nama_usaha }}</h6>
                        <p class="small text-muted mb-2"><i class="fas fa-tag me-1"></i> {{ $umkm->kategori }}</p>
                        <hr class="my-2">
                        <div class="small mb-1">
                            <i class="fas fa-user me-2 text-secondary"></i> <b>Pemilik:</b> {{ $umkm->pemilik }}
                        </div>
                        <div class="small mb-2">
                            <i class="fas fa-phone me-2 text-success"></i> <b>WA:</b> 
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $umkm->no_hp) }}" target="_blank" class="text-decoration-none">
                                {{ $umkm->no_hp ?? '-' }}
                            </a>
                        </div>
                        <a href="https://www.google.com/maps?q={{ $umkm->latitude }},{{ $umkm->longitude }}" 
                           target="_blank" class="btn btn-sm btn-outline-primary w-100 mt-1" style="font-size: 11px;">
                           <i class="fas fa-directions me-1"></i> Navigasi Lokasi
                        </a>
                    </div>
                `;

                markers["{{ addslashes($umkm->nama_usaha) }}"] = L.marker([{{ $umkm->latitude }}, {{ $umkm->longitude }}], {icon: customIcon})
                    .addTo(map)
                    .bindPopup(popupContent);
            @endforeach
        @endisset

        window.focusMap = function(lat, lng, name) {
            document.querySelectorAll('.umkm-item').forEach(el => el.classList.remove('active'));
            event.currentTarget.classList.add('active');
            map.flyTo([lat, lng], 18);
            setTimeout(() => { if(markers[name]) markers[name].openPopup(); }, 500);
        };

        const searchInput = document.getElementById('searchUMKM');
        searchInput.addEventListener('input', function() {
            const filter = this.value.toLowerCase();
            const items = document.querySelectorAll('.umkm-item');
            items.forEach(item => {
                const text = item.innerText.toLowerCase();
                item.style.display = text.includes(filter) ? 'block' : 'none';
            });
        });
    });
</script>
@endpush
@endsection