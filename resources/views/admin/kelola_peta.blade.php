@extends('layouts.admin')
@section('title', 'Kelola Peta')
@section('page-title', 'Kelola Peta Tematik')

@push('styles')
<style>
    #map-admin { height: calc(100vh - 200px); min-height: 500px; border-radius: 12px; }

    .item-list { max-height: calc(100vh - 280px); overflow-y: auto; }

    .peta-item {
        display: flex; align-items: center; gap: 10px;
        padding: 10px 12px; border-radius: 8px; cursor: pointer;
        border: 1px solid transparent; transition: .15s;
        margin-bottom: 4px;
    }
    .peta-item:hover { background: var(--color-1); border-color: var(--color-3); }
    .peta-item.selected { background: var(--color-1); border-color: var(--color-5); }
    .peta-item.editing { background: #fff3cd; border-color: #ffc107; }

    .peta-item .dot {
        width: 10px; height: 10px; border-radius: 50%; flex-shrink: 0;
    }
    .peta-item .name { font-size: .83rem; font-weight: 600; color: #333; flex: 1; }
    .peta-item .status { font-size: .65rem; font-weight: 700; }

    .coord-badge {
        font-size: .65rem; padding: 2px 7px; border-radius: 10px;
        font-weight: 700;
    }
    .has-coord  { background: #d1e7dd; color: #0a3622; }
    .no-coord   { background: #f8d7da; color: #58151c; }

    .mode-banner {
        background: #fff3cd; border: 2px solid #ffc107;
        border-radius: 10px; padding: 10px 14px;
        font-size: .82rem; font-weight: 600; color: #664d03;
        display: none;
    }
    .mode-banner.show { display: flex; align-items: center; gap: 10px; }

    .nav-tabs .nav-link { font-size: .82rem; font-weight: 600; color: var(--color-6); }
    .nav-tabs .nav-link.active { color: var(--color-7); border-bottom: 2px solid var(--color-5); }
</style>
@endpush

@section('content')

<div class="row g-3" style="height:100%;">

    {{-- ===== SIDEBAR LIST ===== --}}
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-3 h-100">
            <div class="card-body p-3 d-flex flex-column gap-3">

                {{-- Mode banner --}}
                <div class="mode-banner" id="mode-banner">
                    <i class="fas fa-crosshairs fa-lg text-warning"></i>
                    <div>
                        <div>Mode Atur Koordinat aktif</div>
                        <small id="mode-label" class="fw-normal"></small>
                    </div>
                    <button class="btn btn-sm btn-outline-secondary ms-auto rounded-pill" onclick="cancelMode()">Batal</button>
                </div>

                {{-- Stats --}}
                <div class="row g-2">
                    <div class="col-6">
                        <div class="p-2 rounded-2 text-center" style="background:var(--color-1);">
                            <div class="fw-bold" style="color:var(--color-5);font-size:1.2rem;">{{ $umkms->whereNotNull('latitude')->count() }}/{{ $umkms->count() }}</div>
                            <div style="font-size:.7rem;color:#666;">UMKM berkoordinat</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-2 rounded-2 text-center" style="background:var(--color-1);">
                            <div class="fw-bold" style="color:#0d6efd;font-size:1.2rem;">{{ $asets->whereNotNull('latitude')->count() }}/{{ $asets->count() }}</div>
                            <div style="font-size:.7rem;color:#666;">Aset berkoordinat</div>
                        </div>
                    </div>
                </div>

                {{-- Tabs --}}
                <ul class="nav nav-tabs border-0" id="petaTabs">
                    <li class="nav-item">
                        <button class="nav-link active border-0 px-3 py-2" data-bs-toggle="tab" data-bs-target="#tab-umkm">
                            <i class="fas fa-store me-1"></i>UMKM ({{ $umkms->count() }})
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link border-0 px-3 py-2" data-bs-toggle="tab" data-bs-target="#tab-aset">
                            <i class="fas fa-building me-1"></i>Aset ({{ $asets->count() }})
                        </button>
                    </li>
                </ul>

                <div class="tab-content flex-grow-1" style="overflow:hidden;">

                    {{-- Tab UMKM --}}
                    <div class="tab-pane fade show active item-list" id="tab-umkm">
                        @forelse($umkms as $u)
                        <div class="peta-item"
                             data-id="{{ $u->id }}"
                             data-type="umkm"
                             data-lat="{{ $u->latitude }}"
                             data-lng="{{ $u->longitude }}"
                             data-name="{{ $u->nama_usaha }}"
                             onclick="selectItem(this)">
                            <span class="dot" style="background:#1E5A52;"></span>
                            <div class="flex-grow-1">
                                <div class="name">{{ $u->nama_usaha }}</div>
                                <div class="text-muted" style="font-size:.7rem;">{{ $u->kategori }}</div>
                            </div>
                            @if($u->latitude && $u->longitude)
                                <span class="coord-badge has-coord">Ada</span>
                            @else
                                <span class="coord-badge no-coord">Belum</span>
                            @endif
                        </div>
                        @empty
                        <p class="text-muted small text-center py-3">Belum ada data UMKM.</p>
                        @endforelse
                    </div>

                    {{-- Tab Aset --}}
                    <div class="tab-pane fade item-list" id="tab-aset">
                        @forelse($asets as $a)
                        <div class="peta-item"
                             data-id="{{ $a->id }}"
                             data-type="aset"
                             data-lat="{{ $a->latitude }}"
                             data-lng="{{ $a->longitude }}"
                             data-name="{{ $a->nama }}"
                             onclick="selectItem(this)">
                            <span class="dot" style="background:#0d6efd;"></span>
                            <div class="flex-grow-1">
                                <div class="name">{{ $a->nama }}</div>
                                <div class="text-muted" style="font-size:.7rem;">{{ $a->jenis }}</div>
                            </div>
                            @if($a->latitude && $a->longitude)
                                <span class="coord-badge has-coord">Ada</span>
                            @else
                                <span class="coord-badge no-coord">Belum</span>
                            @endif
                        </div>
                        @empty
                        <p class="text-muted small text-center py-3">Belum ada data aset.</p>
                        @endforelse
                    </div>

                </div>

                {{-- Petunjuk --}}
                <div class="p-2 rounded-2 small text-muted" style="background:#f8f9fa;font-size:.72rem;line-height:1.6;">
                    <i class="fas fa-info-circle me-1" style="color:var(--color-5);"></i>
                    Klik item → pilih → klik peta untuk atur koordinat. Tanda <span class="coord-badge has-coord" style="font-size:.6rem;">Ada</span> = sudah berkoordinat.
                </div>

            </div>
        </div>
    </div>

    {{-- ===== MAP ===== --}}
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
            <div class="card-header bg-white border-0 py-2 px-3 d-flex align-items-center justify-content-between">
                <div style="font-size:.82rem;font-weight:600;color:var(--color-7);">
                    <i class="fas fa-map-marked-alt me-2" style="color:var(--color-5);"></i>
                    Peta Tematik Desa Tajungan
                </div>
                <div class="d-flex gap-2 align-items-center" style="font-size:.72rem;">
                    <span><span style="display:inline-block;width:10px;height:10px;border-radius:50%;background:#1E5A52;"></span> UMKM</span>
                    <span><span style="display:inline-block;width:10px;height:10px;border-radius:50%;background:#0d6efd;"></span> Aset</span>
                    <span><span style="display:inline-block;width:10px;height:10px;border-radius:50%;background:#ffc107;"></span> Dipilih</span>
                </div>
            </div>
            <div id="map-admin"></div>
        </div>
    </div>

</div>

{{-- Toast notifikasi --}}
<div class="position-fixed bottom-0 end-0 p-3" style="z-index:9999;">
    <div id="saveToast" class="toast align-items-center text-white border-0" role="alert" style="background:var(--color-5);">
        <div class="d-flex">
            <div class="toast-body" id="toastMsg"><i class="fas fa-check me-2"></i>Koordinat disimpan.</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
var CSRF = '{{ csrf_token() }}';

/* ========== MAP INIT ========== */
var map = L.map('map-admin', { zoomControl: true }).setView([-7.1544, 112.6961], 15);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap', maxZoom: 19
}).addTo(map);

/* Batas wilayah */
L.geoJSON({type:'FeatureCollection',features:[{type:'Feature',geometry:{type:'Polygon',coordinates:[[[112.6720,-7.1460],[112.6810,-7.1430],[112.6900,-7.1420],[112.6980,-7.1440],[112.7040,-7.1490],[112.7060,-7.1560],[112.7050,-7.1630],[112.7000,-7.1680],[112.6920,-7.1700],[112.6830,-7.1690],[112.6750,-7.1660],[112.6690,-7.1600],[112.6680,-7.1530],[112.6700,-7.1480],[112.6720,-7.1460]]]}},{properties:{}}]},{
    style:{color:'#1E5A52',weight:2,opacity:.7,fillColor:'#3A9A8C',fillOpacity:.08,dashArray:'6,4'}
}).addTo(map);

/* ========== DATA FROM SERVER ========== */
var umkms = @json($umkms);
var asets = @json($asets);

/* ========== MARKERS ========== */
var markers = {};

function makeIcon(color, selected) {
    var size = selected ? 40 : 32;
    return L.divIcon({
        className: '',
        html: '<div style="background:'+color+';width:'+size+'px;height:'+size+'px;border-radius:50% 50% 50% 0;transform:rotate(-45deg);border:'+(selected?4:3)+'px solid '+(selected?'#ffc107':'white')+';box-shadow:0 2px 8px rgba(0,0,0,.3);"></div>',
        iconSize:[size,size], iconAnchor:[size/2,size], popupAnchor:[0,-size-4]
    });
}

function editUrl(type, id) {
    if (type === 'umkm') return '/admin/umkm/edit/' + id;
    return '/admin/aset/' + id + '/edit';
}

function addMarker(item, type) {
    if (!item.latitude || !item.longitude) return;
    var color = type === 'umkm' ? '#1E5A52' : '#0d6efd';
    var nama  = type === 'umkm' ? item.nama_usaha : item.nama;
    var m = L.marker([item.latitude, item.longitude], { icon: makeIcon(color, false) })
        .addTo(map)
        .bindPopup(
            '<div style="min-width:160px;">' +
            '<p class="fw-bold mb-1" style="color:'+color+';font-size:.85rem;">'+nama+'</p>' +
            '<small class="text-muted d-block mb-2">'+(type==='umkm'?item.kategori:item.jenis)+'</small>' +
            '<small class="text-muted d-block mb-2"><i class="fas fa-map-marker-alt me-1"></i>'+item.latitude.toFixed(5)+', '+item.longitude.toFixed(5)+'</small>' +
            '<a href="'+editUrl(type,item.id)+'" class="btn btn-sm btn-outline-primary rounded-pill w-100" style="font-size:.75rem;">Edit Detail</a>' +
            '</div>'
        );
    markers[type + '_' + item.id] = { marker: m, color: color };
}

umkms.forEach(u => addMarker(u, 'umkm'));
asets.forEach(a => addMarker(a, 'aset'));

/* ========== SELECT + EDIT MODE ========== */
var selected = null;  // { el, id, type, name }

function selectItem(el) {
    // Deselect sebelumnya
    document.querySelectorAll('.peta-item.selected, .peta-item.editing').forEach(e => {
        e.classList.remove('selected', 'editing');
    });

    // Reset marker warna sebelumnya
    if (selected) {
        var prev = markers[selected.type + '_' + selected.id];
        if (prev) prev.marker.setIcon(makeIcon(prev.color, false));
    }

    var id   = el.dataset.id;
    var type = el.dataset.type;
    var lat  = parseFloat(el.dataset.lat);
    var lng  = parseFloat(el.dataset.lng);
    var name = el.dataset.name;

    el.classList.add('selected');
    selected = { el, id, type, name };

    // Highlight marker
    var key = type + '_' + id;
    if (markers[key]) {
        markers[key].marker.setIcon(makeIcon('#ffc107', true));
        map.flyTo([lat, lng], 17, { duration: 0.8 });
        markers[key].marker.openPopup();
    } else if (lat && lng) {
        map.flyTo([lat, lng], 17, { duration: 0.8 });
    }

    // Aktifkan mode atur koordinat
    el.classList.add('editing');
    document.getElementById('mode-banner').classList.add('show');
    document.getElementById('mode-label').textContent =
        'Klik pada peta untuk set koordinat: ' + name;
}

function cancelMode() {
    if (selected) {
        selected.el.classList.remove('selected', 'editing');
        var key = selected.type + '_' + selected.id;
        if (markers[key]) markers[key].marker.setIcon(makeIcon(markers[key].color, false));
        selected = null;
    }
    document.getElementById('mode-banner').classList.remove('show');
}

/* ========== KLIK PETA → SIMPAN KOORDINAT ========== */
var tempMarker = null;

map.on('click', function(e) {
    if (!selected) return;

    var lat = e.latlng.lat.toFixed(6);
    var lng = e.latlng.lng.toFixed(6);

    // Marker sementara
    if (tempMarker) map.removeLayer(tempMarker);
    tempMarker = L.marker([lat, lng], {
        icon: makeIcon('#ffc107', true),
        zIndexOffset: 1000
    }).addTo(map).bindPopup('Menyimpan koordinat...').openPopup();

    // AJAX save
    var url = selected.type === 'umkm'
        ? '/admin/peta/umkm/' + selected.id
        : '/admin/peta/aset/' + selected.id;

    fetch(url, {
        method: 'PATCH',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
        body: JSON.stringify({ latitude: lat, longitude: lng })
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            // Update marker permanent
            var key = selected.type + '_' + selected.id;
            var color = selected.type === 'umkm' ? '#1E5A52' : '#0d6efd';
            if (markers[key]) map.removeLayer(markers[key].marker);
            var newM = L.marker([lat, lng], { icon: makeIcon(color, false) })
                .addTo(map)
                .bindPopup('<b>' + selected.name + '</b><br><small>' + lat + ', ' + lng + '</small>');
            markers[key] = { marker: newM, color: color };
            if (tempMarker) { map.removeLayer(tempMarker); tempMarker = null; }

            // Update data-lat/lng di list item
            selected.el.dataset.lat = lat;
            selected.el.dataset.lng = lng;
            selected.el.querySelector('.coord-badge').className = 'coord-badge has-coord';
            selected.el.querySelector('.coord-badge').textContent = 'Ada';

            showToast('✓ Koordinat ' + selected.name + ' disimpan!', 'var(--color-5)');
            cancelMode();
        }
    })
    .catch(() => showToast('Gagal menyimpan koordinat.', '#dc3545'));
});

function showToast(msg, bg) {
    var toast = document.getElementById('saveToast');
    toast.style.background = bg;
    document.getElementById('toastMsg').innerHTML = msg;
    new bootstrap.Toast(toast, { delay: 3000 }).show();
}
</script>
@endpush
