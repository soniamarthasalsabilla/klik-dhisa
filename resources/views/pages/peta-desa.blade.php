@extends('layouts.app')

@push('styles')
<style>
    /* ===== SIDEBAR ITEM LIST ===== */
    .peta-item {
        padding: 10px 14px;
        border-radius: 10px;
        cursor: pointer;
        margin-bottom: 4px;
        transition: background .15s, transform .15s;
        border: 1px solid transparent;
    }
    .peta-item:hover {
        background: var(--color-1);
        border-color: var(--color-3);
        transform: translateX(3px);
    }
    .peta-item .pi-name { font-size: .85rem; font-weight: 600; color: var(--color-7); margin-bottom: 2px; }
    .peta-item .pi-sub  { font-size: .72rem; color: #6c757d; }
    .peta-item .pi-badge {
        display: inline-block;
        padding: 2px 8px;
        border-radius: 12px;
        font-size: .65rem;
        font-weight: 600;
    }

    /* ===== LAYER TOGGLE ===== */
    .layer-row {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 7px 10px;
        border-radius: 8px;
        cursor: pointer;
        transition: background .15s;
        margin-bottom: 2px;
    }
    .layer-row:hover { background: var(--color-1); }
    .layer-dot { width: 12px; height: 12px; border-radius: 3px; flex-shrink: 0; }
    .layer-row span { font-size: .83rem; color: var(--color-7); flex: 1; }
    .layer-toggle {
        width: 34px; height: 19px;
        background: #dee2e6;
        border-radius: 10px;
        position: relative;
        transition: background .2s;
        flex-shrink: 0;
    }
    .layer-toggle::after {
        content: '';
        position: absolute;
        width: 15px; height: 15px;
        border-radius: 50%;
        background: #fff;
        top: 2px; left: 2px;
        transition: .2s;
        box-shadow: 0 1px 3px rgba(0,0,0,.2);
    }
    .layer-toggle.on { background: var(--color-5); }
    .layer-toggle.on::after { left: 17px; }

    /* ===== MAP POPUP ===== */
    .map-popup { min-width: 200px; font-family: 'Poppins', sans-serif; }
    .popup-header { margin: -1px -1px 10px; padding: 10px 14px; border-radius: 4px 4px 0 0; color: white; }
    .popup-header .ph-title { font-size: .9rem; font-weight: 700; margin: 0; }
    .popup-header .ph-sub   { font-size: .72rem; opacity: .85; margin: 2px 0 0; }
    .popup-body { padding: 0 4px; }
    .popup-row  { display: flex; gap: 8px; margin-bottom: 5px; font-size: .78rem; }
    .popup-row .pr-label { color: #888; min-width: 70px; }
    .popup-row .pr-val   { font-weight: 600; color: #222; }
    .popup-wa {
        display: block; text-align: center;
        background: #25D366; color: white;
        padding: 6px; border-radius: 6px;
        margin-top: 10px; font-size: .78rem;
        text-decoration: none; font-weight: 600;
    }
    .popup-wa:hover { background: #1da851; color: white; }
    .popup-nav {
        display: block; text-align: center;
        background: #0d6efd; color: white;
        padding: 6px; border-radius: 6px;
        margin-top: 6px; font-size: .78rem;
        text-decoration: none; font-weight: 600;
    }
    .popup-nav:hover { background: #0b5ed7; color: white; }

    /* ===== FILTER CHIPS ===== */
    .chip-group { display: flex; flex-wrap: wrap; gap: 4px; margin-bottom: 10px; }
    .chip {
        padding: 3px 11px; border-radius: 20px;
        font-size: .7rem; font-weight: 600;
        cursor: pointer;
        border: 1px solid var(--color-3);
        color: var(--color-6);
        background: transparent;
        transition: .15s;
        user-select: none;
    }
    .chip:hover { background: var(--color-1); }
    .chip.active { background: var(--color-5); color: white; border-color: var(--color-5); }

    /* ===== SCROLLABLE LIST ===== */
    .peta-list { max-height: 320px; overflow-y: auto; padding-right: 2px; }
    .peta-list::-webkit-scrollbar { width: 4px; }
    .peta-list::-webkit-scrollbar-thumb { background: var(--color-3); border-radius: 4px; }
    .peta-item.active { background: var(--color-1); border-color: var(--color-5); }

    /* ===== TABS ===== */
    .peta-tab-nav .nav-link {
        color: var(--color-6);
        font-size: .8rem;
        font-weight: 600;
        padding: 8px 12px;
        border-radius: 8px;
        margin-right: 4px;
    }
    .peta-tab-nav .nav-link.active {
        background: var(--color-5);
        color: white;
    }

    /* ===== STAT CARDS ===== */
    .peta-stat {
        background: var(--color-1);
        border-left: 3px solid var(--color-5);
        border-radius: 8px;
        padding: 8px 12px;
        text-align: center;
    }
    .peta-stat .sv { font-size: 1.3rem; font-weight: 700; color: var(--color-6); line-height: 1; }
    .peta-stat .sl { font-size: .65rem; color: var(--color-5); margin-top: 2px; text-transform: uppercase; font-weight: 600; }

    /* ===== DUSUN TOOLTIP ===== */
    .dusun-tooltip {
        background: rgba(30,90,82,.9) !important;
        border: none !important;
        color: #fff !important;
        font-size: .78rem !important;
        font-weight: 700 !important;
        padding: 4px 10px !important;
        border-radius: 8px !important;
        box-shadow: 0 2px 8px rgba(0,0,0,.2) !important;
    }
    .dusun-tooltip::before { display: none !important; }

    /* Search input */
    .peta-search {
        border: 1px solid var(--color-3);
        border-radius: 8px;
        padding: 7px 12px;
        font-size: .82rem;
        width: 100%;
        outline: none;
        color: var(--color-7);
    }
    .peta-search:focus { border-color: var(--color-5); box-shadow: 0 0 0 3px rgba(59,154,140,.15); }
</style>
@endpush

@section('content')

{{-- ===== HERO ===== --}}
<section class="py-3" style="background: white; border-bottom: 3px solid var(--color-5);">
    <div class="container text-center py-4">
        <h2 class="fw-bold mb-2" style="color: var(--color-7); font-size: 2rem;">
            <i class="fas fa-map-marked-alt me-2" style="color: var(--color-5);"></i>Peta Tematik Desa
        </h2>
        <p class="mb-0" style="color: var(--color-6); font-size: 1rem;">
            Sebaran Fasilitas, Aset, dan UMKM Desa Tajungan
        </p>
    </div>
</section>

{{-- ===== MAIN ===== --}}
<section class="py-5 bg-light">
    <div class="container-fluid px-4">

        {{-- Stat Bar --}}
        <div class="row g-3 mb-4">
            <div class="col-6 col-md-3">
                <div class="peta-stat">
                    <div class="sv">{{ $totalUmkm }}</div>
                    <div class="sl"><i class="fas fa-store me-1"></i>UMKM</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="peta-stat">
                    <div class="sv">{{ $totalAset }}</div>
                    <div class="sl"><i class="fas fa-building me-1"></i>Aset Desa</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="peta-stat">
                    <div class="sv">{{ $batasDusun->count() }}</div>
                    <div class="sl"><i class="fas fa-map me-1"></i>Dusun</div>
                </div>
            </div>
        </div>

        <div class="row g-4">

            {{-- ===== SIDEBAR KIRI ===== --}}
            <div class="col-lg-3">
                <div class="card border-0 shadow-sm rounded-4 sticky-top" style="top: 90px;">

                    {{-- Tab Nav --}}
                    <div class="card-header bg-white rounded-top-4 border-0 pt-3 pb-2 px-3">
                        <ul class="nav peta-tab-nav" id="petaTab" role="tablist">
                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#ptab-layer" type="button">
                                    <i class="fas fa-layer-group me-1"></i>Layer
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#ptab-umkm" type="button">
                                    <i class="fas fa-store me-1"></i>UMKM
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#ptab-aset" type="button">
                                    <i class="fas fa-building me-1"></i>Aset
                                </button>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body px-3 pt-2 pb-3">
                        <div class="tab-content" id="petaTabContent">

                            {{-- Tab: Layer --}}
                            <div class="tab-pane fade show active" id="ptab-layer">
                                <p class="text-muted mb-2" style="font-size:.7rem;text-transform:uppercase;font-weight:700;letter-spacing:1px;">Tampilan Peta</p>

                                <div class="layer-row" onclick="toggleLayer('dusun')">
                                    <div class="layer-dot" style="background:#5b9bd5;"></div>
                                    <span>Batas Dusun</span>
                                    <div class="layer-toggle on" id="toggle-dusun"></div>
                                </div>
                                <div class="layer-row" onclick="toggleLayer('batas')">
                                    <div class="layer-dot" style="background:var(--color-5);"></div>
                                    <span>Batas Desa</span>
                                    <div class="layer-toggle on" id="toggle-batas"></div>
                                </div>

                                <hr class="my-2">
                                <p class="text-muted mb-2" style="font-size:.7rem;text-transform:uppercase;font-weight:700;letter-spacing:1px;">Titik Lokasi</p>

                                <div class="layer-row" onclick="toggleLayer('aset')">
                                    <div class="layer-dot" style="background:#0d6efd;"></div>
                                    <span>Aset Desa</span>
                                    <div class="layer-toggle on" id="toggle-aset"></div>
                                </div>
                                <div class="layer-row" onclick="toggleLayer('umkm')">
                                    <div class="layer-dot" style="background:#fd7e14;"></div>
                                    <span>UMKM Desa</span>
                                    <div class="layer-toggle on" id="toggle-umkm"></div>
                                </div>

                                @if($batasDusun->count())
                                <hr class="my-2">
                                <p class="text-muted mb-2" style="font-size:.7rem;text-transform:uppercase;font-weight:700;letter-spacing:1px;">Legenda Dusun</p>
                                @foreach($batasDusun as $d)
                                <div class="d-flex align-items-center gap-2 mb-1 px-2" style="font-size:.78rem;color:var(--color-7);">
                                    <div class="layer-dot" style="background:{{ $d->warna }};"></div>
                                    <span>{{ $d->nama_dusun }}</span>
                                </div>
                                @endforeach
                                @endif

                                <hr class="my-2">
                                <p class="text-muted mb-2" style="font-size:.7rem;text-transform:uppercase;font-weight:700;letter-spacing:1px;">Legenda UMKM</p>
                                @foreach([['#fd7e14','Makanan'],['#6f42c1','Kerajinan'],['#0d6efd','Jasa'],['#198754','Pertanian']] as [$c,$n])
                                <div class="d-flex align-items-center gap-2 mb-1 px-2" style="font-size:.78rem;color:var(--color-7);">
                                    <div class="layer-dot" style="background:{{ $c }};"></div>
                                    <span>{{ $n }}</span>
                                </div>
                                @endforeach
                            </div>

                            {{-- Tab: UMKM --}}
                            <div class="tab-pane fade" id="ptab-umkm">
                                <input type="text" id="search-umkm" class="peta-search mb-2" placeholder="🔍 Cari UMKM...">
                                <div class="chip-group mb-2">
                                    <div class="chip active" data-kat="semua">Semua</div>
                                    @foreach($umkmKategori as $kat)
                                    <div class="chip" data-kat="{{ $kat }}">{{ $kat }}</div>
                                    @endforeach
                                </div>
                                <div class="peta-list" id="umkm-list">
                                    @forelse($umkms as $u)
                                    @php $kc = match($u->kategori) { 'Makanan'=>'#fd7e14','Kerajinan'=>'#6f42c1','Jasa'=>'#0d6efd','Pertanian'=>'#198754',default=>'#6c757d' }; @endphp
                                    <div class="peta-item umkm-item"
                                         data-kat="{{ $u->kategori }}"
                                         data-nama="{{ strtolower($u->nama_usaha) }}"
                                         onclick="flyToItem('umkm', {{ $loop->index }})">
                                        <div class="pi-name">{{ $u->nama_usaha }}</div>
                                        <div class="pi-sub">
                                            <span class="pi-badge" style="background:{{ $kc }}22;color:{{ $kc }};">{{ $u->kategori }}</span>
                                            {{ $u->pemilik }}
                                            @if($u->dusun) · {{ $u->dusun }}@endif
                                        </div>
                                    </div>
                                    @empty
                                    <p class="text-center text-muted small py-3">Belum ada data UMKM.</p>
                                    @endforelse
                                </div>
                            </div>

                            {{-- Tab: Aset --}}
                            <div class="tab-pane fade" id="ptab-aset">
                                <input type="text" id="search-aset" class="peta-search mb-2" placeholder="🔍 Cari aset...">
                                <div class="peta-list" id="aset-list">
                                    @foreach($asets as $a)
                                    @php $ac = match($a->jenis) { 'Tanah'=>'#198754','Bangunan'=>'#0d6efd','Infrastruktur'=>'#20c997',default=>'#6c757d' }; @endphp
                                    <div class="peta-item aset-item"
                                         data-nama="{{ strtolower($a->nama) }}"
                                         onclick="flyToItem('aset', {{ $loop->index }})">
                                        <div class="pi-name">{{ $a->nama }}</div>
                                        <div class="pi-sub">
                                            <span class="pi-badge" style="background:{{ $ac }}22;color:{{ $ac }};">{{ $a->jenis }}</span>
                                            {{ $a->lokasi ?? '' }}
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            {{-- ===== PETA UTAMA ===== --}}
            <div class="col-lg-9">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-header bg-white border-0 px-4 pt-3 pb-2 d-flex align-items-center justify-content-between">
                        <h5 class="fw-bold mb-0" style="color:var(--color-7);">
                            <i class="fas fa-map me-2" style="color:var(--color-5);"></i>Peta Wilayah Desa Tajungan
                        </h5>
                        <span class="badge rounded-pill" style="background:var(--color-1);color:var(--color-6);font-size:.72rem;">
                            <i class="fas fa-info-circle me-1"></i>Klik marker untuk detail
                        </span>
                    </div>
                    <div id="map" style="height: 580px; width: 100%;"></div>
                    <div class="card-footer bg-white border-0 px-4 py-3">
                        <div class="row text-center">
                            <div class="col" style="font-size:.75rem;color:#666;">
                                <i class="fas fa-building me-1" style="color:#0d6efd;"></i>Aset Bangunan
                            </div>
                            <div class="col" style="font-size:.75rem;color:#666;">
                                <i class="fas fa-road me-1" style="color:#20c997;"></i>Infrastruktur
                            </div>
                            <div class="col" style="font-size:.75rem;color:#666;">
                                <i class="fas fa-map me-1" style="color:#198754;"></i>Tanah Desa
                            </div>
                            <div class="col" style="font-size:.75rem;color:#666;">
                                <i class="fas fa-store me-1" style="color:#fd7e14;"></i>UMKM
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
// ================================================================
//  DATA DARI SERVER
// ================================================================
var umkmData = @json($umkms);
var asetData = @json($asets);

// ================================================================
//  INISIALISASI PETA
// ================================================================
var map = L.map('map', { zoomControl: true, scrollWheelZoom: true })
           .setView([-7.1560, 112.6970], 15);

L.control.scale({ imperial: false, position: 'bottomright' }).addTo(map);

var osmLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap', maxZoom: 19
});
var satelitLayer = L.tileLayer(
    'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
    attribution: '© Esri', maxZoom: 19
});
osmLayer.addTo(map);

L.control.layers({
    'Peta Jalan': osmLayer,
    'Satelit': satelitLayer
}, {}, { position: 'topright', collapsed: false }).addTo(map);

// ================================================================
//  HELPER: PIN MARKER
// ================================================================
function pin(color, faIcon, size) {
    size = size || 36;
    return L.divIcon({
        className: '',
        html: '<div style="width:'+size+'px;height:'+size+'px;background:'+color+';border-radius:50% 50% 50% 0;transform:rotate(-45deg);border:3px solid #fff;box-shadow:0 3px 10px rgba(0,0,0,.3);display:flex;align-items:center;justify-content:center;">'
            + '<i class="fas '+faIcon+'" style="transform:rotate(45deg);color:#fff;font-size:'+(size*.34)+'px;line-height:1;"></i>'
            + '</div>',
        iconSize:    [size, size],
        iconAnchor:  [size/2, size],
        popupAnchor: [0, -size-4]
    });
}

function popup(bgColor, title, subtitle, rows, waLink, navLink) {
    var rowsHtml = rows.map(function(r) {
        return '<div class="popup-row"><span class="pr-label">'+r[0]+'</span><span class="pr-val">'+r[1]+'</span></div>';
    }).join('');
    return '<div class="map-popup">'
        + '<div class="popup-header" style="background:linear-gradient(135deg,'+bgColor+','+bgColor+'cc);">'
        + '<p class="ph-title">'+title+'</p>'
        + (subtitle ? '<p class="ph-sub">'+subtitle+'</p>' : '')
        + '</div>'
        + '<div class="popup-body">'+rowsHtml
        + (waLink  ? '<a class="popup-wa"  href="'+waLink+'"  target="_blank"><i class="fab fa-whatsapp me-1"></i> Hubungi WhatsApp</a>' : '')
        + (navLink ? '<a class="popup-nav" href="'+navLink+'" target="_blank"><i class="fas fa-directions me-1"></i> Navigasi Lokasi</a>' : '')
        + '</div></div>';
}

// ================================================================
//  LAYER GROUPS
// ================================================================
var lgDusun = L.layerGroup().addTo(map);
var lgBatas = L.layerGroup().addTo(map);
var lgAset  = L.layerGroup().addTo(map);
var lgUmkm  = L.layerGroup().addTo(map);

var layerMap   = { dusun: lgDusun, batas: lgBatas, aset: lgAset, umkm: lgUmkm };
var layerState = { dusun: true, batas: true, aset: true, umkm: true };

// ================================================================
//  BATAS DESA
// ================================================================
var batasDesaData = @json($batasDesa);
if (batasDesaData && batasDesaData.koordinat && batasDesaData.koordinat.length >= 3) {
    var batasDesa = L.polygon(batasDesaData.koordinat, {
        color: batasDesaData.warna || '#3A9A8C', weight: 3, opacity: 1,
        fillColor: batasDesaData.warna || '#3A9A8C', fillOpacity: 0.05, dashArray: '10,5'
    }).addTo(lgBatas);
    batasDesa.bindPopup('<b>Wilayah Desa Tajungan</b><br><small>Kec. Kamal, Kab. Bangkalan</small>');
    map.fitBounds(batasDesa.getBounds(), { padding: [20, 20] });
}

// ================================================================
//  BATAS DUSUN (dari database)
// ================================================================
var dusunData = @json($batasDusun);
if (dusunData.length > 0) {
    dusunData.forEach(function(d) {
        if (!d.koordinat || d.koordinat.length < 3) return;
        L.polygon(d.koordinat, {
            color: d.warna, weight: 2, opacity: .9,
            fillColor: d.warna, fillOpacity: .15
        }).bindTooltip('<b>' + d.nama_dusun + '</b>', { permanent: true, direction: 'center', className: 'dusun-tooltip' })
          .addTo(lgDusun);
    });
}

// ================================================================
//  ASET DESA
// ================================================================
var asetColorMap = { 'Tanah':'#198754','Bangunan':'#0d6efd','Infrastruktur':'#20c997','Kendaraan':'#fd7e14','Peralatan & Mesin':'#6f42c1' };
var asetIconMap  = { 'Tanah':'fa-map','Bangunan':'fa-building','Infrastruktur':'fa-road','Kendaraan':'fa-motorcycle','Peralatan & Mesin':'fa-tools' };
var asetMarkers = [];
asetData.forEach(function(a) {
    var c  = asetColorMap[a.jenis]  || '#6c757d';
    var ic = asetIconMap[a.jenis]   || 'fa-box';
    var rows = [['Jenis', a.jenis], ['Kondisi', a.kondisi], ['Lokasi', a.lokasi || '-']];
    if (a.luas) rows.push(['Luas', Number(a.luas).toLocaleString('id-ID') + ' m²']);
    if (a.nilai_perolehan) rows.push(['Nilai', 'Rp ' + Number(a.nilai_perolehan).toLocaleString('id-ID')]);
    var navLink = 'https://www.google.com/maps?q=' + a.latitude + ',' + a.longitude;
    asetMarkers.push(
        L.marker([a.latitude, a.longitude], { icon: pin(c, ic, 32) })
         .bindPopup(popup(c, a.nama, a.jenis + ' · ' + a.kondisi, rows, null, navLink), { maxWidth: 260 })
         .addTo(lgAset)
    );
});

// ================================================================
//  UMKM
// ================================================================
var umkmColorMap = { 'Makanan':'#fd7e14','Kerajinan':'#6f42c1','Jasa':'#0d6efd','Pertanian':'#198754' };
var umkmMarkers = [];
umkmData.forEach(function(u) {
    var c = umkmColorMap[u.kategori] || '#6c757d';
    var rows = [['Pemilik', u.pemilik], ['Kategori', u.kategori]];
    if (u.dusun)  rows.push(['Dusun',  u.dusun]);
    if (u.alamat) rows.push(['Alamat', u.alamat]);
    if (u.no_hp)  rows.push(['No. WA', u.no_hp]);
    var waLink  = u.no_hp ? 'https://wa.me/' + u.no_hp + '?text=Halo,%20saya%20tertarik%20dengan%20' + encodeURIComponent(u.nama_usaha) : null;
    var navLink = 'https://www.google.com/maps?q=' + u.latitude + ',' + u.longitude;
    umkmMarkers.push(
        L.marker([u.latitude, u.longitude], { icon: pin(c, 'fa-store', 32) })
         .bindPopup(popup(c, u.nama_usaha, 'UMKM ' + u.kategori, rows, waLink, navLink), { maxWidth: 260 })
         .addTo(lgUmkm)
    );
});

// ================================================================
//  LAYER TOGGLE
// ================================================================
function toggleLayer(key) {
    var lg = layerMap[key];
    var toggle = document.getElementById('toggle-' + key);
    if (layerState[key]) {
        map.removeLayer(lg);
        toggle.classList.remove('on');
    } else {
        map.addLayer(lg);
        toggle.classList.add('on');
    }
    layerState[key] = !layerState[key];
}

// ================================================================
//  FLY TO ITEM (sidebar → marker + popup + highlight)
// ================================================================
function flyToItem(type, idx) {
    var markers = type === 'umkm' ? umkmMarkers : asetMarkers;
    var marker  = markers[idx];
    if (!marker) return;
    // jika layer sedang disembunyikan, tampilkan dulu
    if (!layerState[type]) toggleLayer(type);
    // highlight item di sidebar
    var all = document.querySelectorAll('.' + type + '-item');
    all.forEach(function(el) { el.classList.remove('active'); });
    if (all[idx]) {
        all[idx].classList.add('active');
        all[idx].scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }
    // terbang ke marker lalu buka popup
    map.flyTo(marker.getLatLng(), 18, { duration: 0.8 });
    setTimeout(function() { marker.openPopup(); }, 900);
}

// ================================================================
//  SEARCH UMKM
// ================================================================
document.getElementById('search-umkm').addEventListener('input', filterUmkm);
document.querySelectorAll('.chip').forEach(function(chip) {
    chip.addEventListener('click', function() {
        document.querySelectorAll('.chip').forEach(function(c) { c.classList.remove('active'); });
        chip.classList.add('active');
        filterUmkm();
    });
});
function filterUmkm() {
    var q   = document.getElementById('search-umkm').value.toLowerCase();
    var kat = document.querySelector('.chip.active') ? document.querySelector('.chip.active').dataset.kat : 'semua';
    document.querySelectorAll('.umkm-item').forEach(function(item) {
        var ok = (kat === 'semua' || item.dataset.kat === kat) && item.dataset.nama.includes(q);
        item.style.display = ok ? '' : 'none';
    });
}

// ================================================================
//  SEARCH ASET
// ================================================================
document.getElementById('search-aset').addEventListener('input', function() {
    var q = this.value.toLowerCase();
    document.querySelectorAll('.aset-item').forEach(function(item) {
        item.style.display = item.dataset.nama.includes(q) ? '' : 'none';
    });
});
</script>
@endpush
