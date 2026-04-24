@extends('layouts.admin')
@section('title', 'Batas Dusun')
@section('page-title', 'Batas Dusun')
@section('breadcrumb', 'Atur polygon batas wilayah desa dan dusun di peta')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
    #map-draw { height: 500px; }

    /* Step badge */
    .step-badge {
        width: 28px; height: 28px; border-radius: 50%;
        display: inline-flex; align-items: center; justify-content: center;
        font-size: .75rem; font-weight: 800; flex-shrink: 0;
    }
    .step-badge.done  { background: #198754; color: white; }
    .step-badge.active{ background: #0d6efd; color: white; }
    .step-badge.locked{ background: #e2e8f0; color: #94a3b8; }

    /* Locked overlay */
    .locked-overlay {
        position: absolute; inset: 0; z-index: 5;
        background: rgba(248,249,250,.82);
        backdrop-filter: blur(2px);
        border-radius: 12px;
        display: flex; flex-direction: column;
        align-items: center; justify-content: center;
        gap: 8px; text-align: center; padding: 20px;
    }

    /* Layer toggle */
    .map-layer-toggle {
        position: absolute; top: 12px; right: 12px; z-index: 1000;
        display: flex; gap: 4px;
        background: white; border-radius: 10px;
        padding: 4px; box-shadow: 0 2px 12px rgba(0,0,0,.18);
    }
    .layer-btn {
        padding: 5px 12px; border-radius: 7px; border: none;
        font-size: .72rem; font-weight: 700; cursor: pointer;
        transition: .15s; color: #64748b; background: transparent;
    }
    .layer-btn.active { background: #1E5A52; color: white; }

    .color-dot { width: 18px; height: 18px; border-radius: 50%; display: inline-block; border: 2px solid rgba(0,0,0,.15); flex-shrink: 0; cursor: pointer; }
    .batas-row:hover { background: #f8f9fa; }
    .batas-row { transition: .2s; }

    /* Mode tab */
    .mode-tab {
        padding: 10px 18px; border-radius: 10px; border: 2px solid transparent;
        cursor: pointer; transition: .18s; font-size: .82rem; font-weight: 700;
        display: flex; align-items: center; gap: 8px;
    }
    .mode-tab.active-tab { border-color: #1E5A52; background: #E8F5F0; color: #1E5A52; }
    .mode-tab:not(.active-tab) { color: #64748b; }
    .mode-tab:not(.active-tab):hover { background: #f1f5f9; }
    .mode-tab.disabled-tab { opacity: .45; cursor: not-allowed; pointer-events: none; }
</style>
@endpush

@section('content')

{{-- ── STEP INDICATOR ── --}}
<div class="d-flex align-items-center gap-3 mb-4 p-3 bg-white rounded-3 shadow-sm">
    <div class="d-flex align-items-center gap-2">
        <span class="step-badge {{ $batasDesa ? 'done' : 'active' }}">
            {{ $batasDesa ? '✓' : '1' }}
        </span>
        <div>
            <div style="font-size:.78rem;font-weight:700;color:#1E5A52;">Batas Desa</div>
            <div style="font-size:.67rem;color:#94a3b8;">
                {{ $batasDesa ? 'Sudah digambar' : 'Belum digambar' }}
            </div>
        </div>
    </div>
    <div style="flex:1;height:2px;background:{{ $batasDesa ? '#198754' : '#e2e8f0' }};border-radius:2px;"></div>
    <div class="d-flex align-items-center gap-2">
        <span class="step-badge {{ $batasDesa ? 'active' : 'locked' }}">2</span>
        <div>
            <div style="font-size:.78rem;font-weight:700;color:{{ $batasDesa ? '#1E5A52' : '#94a3b8' }};">Batas Dusun</div>
            <div style="font-size:.67rem;color:#94a3b8;">
                {{ $batasList->count() }} dusun ditambahkan
            </div>
        </div>
    </div>
</div>

<div class="row g-4">

    {{-- ── PETA ── --}}
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-white d-flex justify-content-between align-items-center flex-wrap gap-2">
                <span class="fw-bold">
                    <i class="fas fa-draw-polygon me-2 text-success"></i>
                    <span id="map-title">Gambar Batas Desa</span>
                </span>
                <div class="d-flex gap-2 align-items-center flex-wrap">
                    <button id="btn-start-draw" class="btn btn-sm btn-success rounded-pill px-3">
                        <i class="fas fa-pen me-1"></i>Mulai Gambar
                    </button>
                    <button id="btn-cancel-draw" class="btn btn-sm btn-outline-secondary rounded-pill px-3" style="display:none;">
                        <i class="fas fa-times me-1"></i>Batal
                    </button>
                    <button id="btn-undo" class="btn btn-sm btn-outline-warning rounded-pill px-3" style="display:none;">
                        <i class="fas fa-undo me-1"></i>Undo
                    </button>
                    <button id="btn-finish" class="btn btn-sm btn-primary rounded-pill px-3" style="display:none;">
                        <i class="fas fa-check me-1"></i>Selesai
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <div id="map-draw"></div>
            </div>
            <div class="card-footer bg-white border-top">
                <small class="text-muted">
                    <i class="fas fa-info-circle me-1 text-primary"></i>
                    Klik <strong>Mulai Gambar</strong> → klik titik di peta → klik <strong>Selesai</strong>.
                    Mode: <strong id="mode-label" class="text-success">Batas Desa</strong>
                </small>
            </div>
        </div>
    </div>

    {{-- ── PANEL KANAN ── --}}
    <div class="col-lg-5 d-flex flex-column gap-4">

        {{-- ── MODE SWITCH ── --}}
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body p-3">
                <div class="d-flex gap-2">
                    <div class="mode-tab {{ !$batasDesa ? 'active-tab' : '' }}" id="tab-desa" onclick="switchMode('desa')">
                        <i class="fas fa-map"></i>
                        <span>Batas Desa</span>
                    </div>
                    <div class="mode-tab {{ $batasDesa ? '' : 'disabled-tab' }} {{ $batasDesa ? 'active-tab' : '' }}"
                         id="tab-dusun" onclick="{{ $batasDesa ? 'switchMode(\'dusun\')' : '' }}">
                        <i class="fas fa-draw-polygon"></i>
                        <span>Batas Dusun</span>
                        @if(!$batasDesa)
                        <i class="fas fa-lock ms-1 text-muted" style="font-size:.7rem;"></i>
                        @endif
                    </div>
                </div>
                @if(!$batasDesa)
                <div class="alert alert-warning mb-0 mt-3 py-2" style="font-size:.78rem;">
                    <i class="fas fa-exclamation-triangle me-1"></i>
                    Gambar <strong>Batas Desa</strong> terlebih dahulu sebelum menambahkan batas dusun.
                </div>
                @endif
            </div>
        </div>

        {{-- ── FORM SIMPAN ── --}}
        <div class="card border-0 shadow-sm rounded-3 position-relative">
            <div class="card-header bg-white fw-bold">
                <i class="fas fa-plus-circle me-2 text-primary"></i>
                <span id="form-title">Simpan Batas Desa</span>
            </div>
            <div class="card-body">

                {{-- Nama field (dusun only) --}}
                <div class="mb-3" id="field-nama" style="{{ $batasDesa ? '' : 'display:none;' }}">
                    <label class="form-label fw-semibold">Nama Dusun <span class="text-danger">*</span></label>
                    <input type="text" id="inp-nama" class="form-control" placeholder="Dusun Barat, Dusun Timur...">
                </div>

                {{-- Warna --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Warna Batas</label>
                    <div class="d-flex gap-2 flex-wrap" id="color-picker">
                        @foreach(['#1E5A52','#3A9A8C','#0d6efd','#198754','#dc3545','#fd7e14','#6f42c1','#ffc107'] as $c)
                        <div class="color-dot" data-color="{{ $c }}" style="background:{{ $c }};"
                             onclick="selectColor('{{ $c }}')"></div>
                        @endforeach
                    </div>
                    <input type="hidden" id="inp-warna" value="#1E5A52">
                    <small class="text-muted">Warna terpilih: <span id="warna-label" style="font-weight:600;">#1E5A52</span></small>
                </div>

                {{-- Koordinat --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Koordinat</label>
                    <textarea id="inp-koordinat" class="form-control font-monospace" rows="3"
                              placeholder="Gambar polygon di peta..." style="font-size:.73rem;resize:none;"></textarea>
                    <small class="text-muted">Terisi otomatis saat menggambar di peta.</small>
                </div>

                <div id="save-alert" class="alert alert-danger d-none py-2 mb-3" style="font-size:.82rem;"></div>

                <button id="btn-save" class="btn btn-desa-navy w-100">
                    <i class="fas fa-save me-1"></i><span id="save-label">Simpan Batas Desa</span>
                </button>

                {{-- Status batas desa --}}
                <div id="desa-status" class="mt-3 {{ $batasDesa ? '' : 'd-none' }}">
                    <div class="alert alert-success py-2 mb-0 d-flex align-items-center gap-2" style="font-size:.8rem;">
                        <i class="fas fa-check-circle"></i>
                        <span>Batas desa sudah tersimpan.
                            <a href="#" onclick="gambarUlangDesa();return false;" style="font-size:.75rem;"><i class="fas fa-redo me-1"></i>Gambar ulang</a>
                        </span>
                    </div>
                </div>
            </div>

            {{-- Locked overlay (jika mode dusun tapi belum ada batas desa) --}}
            @if(!$batasDesa)
            <div class="locked-overlay" id="locked-overlay">
                <i class="fas fa-lock fa-2x text-secondary opacity-50"></i>
                <div style="font-size:.82rem;font-weight:700;color:#64748b;">Batas Dusun Terkunci</div>
                <div style="font-size:.74rem;color:#94a3b8;max-width:200px;">
                    Selesaikan penggambaran batas desa terlebih dahulu.
                </div>
            </div>
            @endif
        </div>

        {{-- ── DAFTAR BATAS DUSUN ── --}}
        @if($batasDesa)
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-white fw-bold d-flex justify-content-between align-items-center">
                <span><i class="fas fa-list me-2"></i>Daftar Batas Dusun</span>
                <span class="badge bg-primary rounded-pill">{{ $batasList->count() }}</span>
            </div>
            @if($batasList->isEmpty())
            <div class="card-body text-center py-4 text-muted small">
                <i class="fas fa-draw-polygon fa-2x mb-2 d-block opacity-25"></i>
                Belum ada batas dusun.
            </div>
            @else
            <div class="table-responsive">
                <table class="table table-sm mb-0 align-middle">
                    <thead><tr style="font-size:.73rem;background:#f8fafc;">
                        <th class="ps-3">Nama Dusun</th>
                        <th>Titik</th>
                        <th>Status</th>
                        <th></th>
                    </tr></thead>
                    <tbody>
                    @foreach($batasList as $b)
                    <tr class="batas-row" data-id="{{ $b->id }}">
                        <td class="ps-3">
                            <div class="d-flex align-items-center gap-2">
                                <span class="color-dot" style="background:{{ $b->warna }};cursor:default;"></span>
                                <span style="font-size:.84rem;font-weight:600;">{{ $b->nama_dusun }}</span>
                            </div>
                        </td>
                        <td><small class="text-muted">{{ count($b->koordinat) }} titik</small></td>
                        <td>
                            <span class="badge rounded-pill {{ $b->is_active ? 'bg-success' : 'bg-secondary' }}" style="font-size:.65rem;">
                                {{ $b->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td class="pe-3 text-end">
                            <button class="btn btn-xs btn-outline-primary py-0 px-2 me-1" style="font-size:.7rem;"
                                    onclick="editBatas({{ $b->id }}, '{{ $b->nama_dusun }}', '{{ $b->warna }}', {{ json_encode($b->koordinat) }})">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-xs btn-outline-danger py-0 px-2" style="font-size:.7rem;"
                                    onclick="hapusBatas({{ $b->id }}, '{{ $b->nama_dusun }}')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
        @endif

    </div>{{-- /col-lg-5 --}}
</div>

{{-- Modal Edit --}}
<div class="modal fade" id="modal-edit" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header">
                <h6 class="modal-title fw-bold">Edit Batas Dusun</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="edit-id">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Dusun</label>
                    <input type="text" id="edit-nama" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Warna</label>
                    <input type="color" id="edit-warna" class="form-control form-control-color">
                </div>
                <div class="mb-0">
                    <label class="form-label fw-semibold">Koordinat (JSON)</label>
                    <textarea id="edit-koordinat" class="form-control font-monospace" rows="5" style="font-size:.72rem;"></textarea>
                    <small class="text-muted">Format: [[lat,lng],[lat,lng],...]</small>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button class="btn btn-desa-navy px-4" onclick="simpanEdit()">
                    <i class="fas fa-save me-1"></i>Simpan
                </button>
                <button class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
// ─── DATA SERVER ──────────────────────────────────────────────────────────────
const batasDesa  = @json($batasDesa);
const batasList  = @json($batasList);
const hasDesa    = !!batasDesa;

// ─── MAP & TILE LAYERS ────────────────────────────────────────────────────────
const defaultCenter = [-7.1544, 112.6961];
const map = L.map('map-draw', { zoomControl: true }).setView(defaultCenter, 14);

const streetLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19, attribution: '© OpenStreetMap'
});
const satelitLayer = L.tileLayer(
    'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
    maxZoom: 19, attribution: '© Esri World Imagery'
});
const labelLayer = L.tileLayer(
    'https://server.arcgisonline.com/ArcGIS/rest/services/Reference/World_Boundaries_and_Places/MapServer/tile/{z}/{y}/{x}', {
    maxZoom: 19, opacity: 0.85
});

streetLayer.addTo(map);
let currentLayer = 'street';

// Tombol layer toggle sebagai Leaflet custom control
// (disableClickPropagation agar klik tombol TIDAK sampai ke map)
const LayerToggle = L.Control.extend({
    options: { position: 'topright' },
    onAdd: function () {
        const wrap = L.DomUtil.create('div', 'map-layer-toggle');
        wrap.innerHTML =
            `<button class="layer-btn active" id="btn-street">
                <i class="fas fa-road"></i> Street
             </button>
             <button class="layer-btn" id="btn-satelit">
                <i class="fas fa-satellite"></i> Satelit
             </button>`;
        L.DomEvent.disableClickPropagation(wrap);
        L.DomEvent.disableScrollPropagation(wrap);
        wrap.querySelector('#btn-street').addEventListener('click', () => switchLayer('street'));
        wrap.querySelector('#btn-satelit').addEventListener('click', () => switchLayer('satelit'));
        return wrap;
    }
});
new LayerToggle().addTo(map);

function switchLayer(type) {
    if (type === currentLayer) return;
    if (type === 'satelit') {
        map.removeLayer(streetLayer);
        satelitLayer.addTo(map);
        labelLayer.addTo(map);
        document.getElementById('btn-street').classList.remove('active');
        document.getElementById('btn-satelit').classList.add('active');
    } else {
        map.removeLayer(satelitLayer);
        try { map.removeLayer(labelLayer); } catch(e) {}
        streetLayer.addTo(map);
        document.getElementById('btn-satelit').classList.remove('active');
        document.getElementById('btn-street').classList.add('active');
    }
    currentLayer = type;
}

// ─── RENDER SAVED POLYGONS ────────────────────────────────────────────────────
let desaPolygon = null;

if (batasDesa && batasDesa.koordinat && batasDesa.koordinat.length > 0) {
    desaPolygon = L.polygon(batasDesa.koordinat, {
        color: batasDesa.warna, fillColor: batasDesa.warna,
        fillOpacity: 0.08, weight: 3, dashArray: '8,4'
    }).addTo(map);
    desaPolygon.bindTooltip('Batas Desa', {
        permanent: true, direction: 'center',
        className: 'fw-bold', style: 'font-size:.72rem;'
    });
    map.fitBounds(desaPolygon.getBounds().pad(0.1));
}

batasList.forEach(b => {
    if (b.is_active && b.koordinat && b.koordinat.length > 0) {
        const poly = L.polygon(b.koordinat, {
            color: b.warna, fillColor: b.warna, fillOpacity: 0.2, weight: 2
        }).addTo(map);
        poly.bindTooltip(b.nama_dusun, {
            permanent: true, direction: 'center',
            className: 'fw-bold', style: 'font-size:.72rem;'
        });
    }
});

// ─── DRAW STATE — deklarasi dulu sebelum switchMode dipanggil ────────────────
let drawing = false, points = [], markers = [], polyLine = null, previewPoly = null;

// ─── MODE (desa / dusun) ──────────────────────────────────────────────────────
let currentMode = hasDesa ? 'dusun' : 'desa';

function switchMode(mode) {
    if (mode === 'dusun' && !hasDesa) return;
    currentMode = mode;
    const isDesa = mode === 'desa';

    document.getElementById('tab-desa').classList.toggle('active-tab', isDesa);
    document.getElementById('tab-dusun').classList.toggle('active-tab', !isDesa);
    document.getElementById('map-title').textContent  = isDesa ? 'Gambar Batas Desa' : 'Gambar Batas Dusun';
    document.getElementById('mode-label').textContent = isDesa ? 'Batas Desa' : 'Batas Dusun';
    document.getElementById('form-title').textContent = isDesa ? 'Simpan Batas Desa' : 'Simpan Batas Dusun';
    document.getElementById('save-label').textContent = isDesa ? 'Simpan Batas Desa' : 'Simpan Batas Dusun';
    document.getElementById('field-nama').style.display = isDesa ? 'none' : '';
    document.getElementById('desa-status').classList.toggle('d-none', !hasDesa || !isDesa);

    // Overlay hanya tampil saat mode dusun DAN belum ada batas desa
    const overlay = document.getElementById('locked-overlay');
    if (overlay) overlay.style.display = (!isDesa && !hasDesa) ? 'flex' : 'none';

    cancelDraw();
    document.getElementById('inp-koordinat').value = '';
    document.getElementById('inp-nama').value = '';
}

function gambarUlangDesa() {
    switchMode('desa');   // reset form & cancel draw aktif
    // hapus preview polygon desa lama di peta agar tidak membingungkan
    if (desaPolygon) { map.removeLayer(desaPolygon); desaPolygon = null; }
    startDraw();           // langsung masuk mode menggambar
    // scroll ke peta
    document.getElementById('map-draw').scrollIntoView({ behavior: 'smooth', block: 'center' });
}

// Init awal
switchMode(currentMode);

// ─── DRAW EVENT LISTENERS ─────────────────────────────────────────────────────
document.getElementById('btn-start-draw').addEventListener('click', startDraw);
document.getElementById('btn-cancel-draw').addEventListener('click', cancelDraw);
document.getElementById('btn-undo').addEventListener('click', undoPoint);
document.getElementById('btn-finish').addEventListener('click', finishDraw);

function startDraw() {
    drawing = true; points = []; markers = [];
    map.getContainer().style.cursor = 'crosshair';
    toggleDrawButtons(true);
    if (polyLine)    { map.removeLayer(polyLine); polyLine = null; }
    if (previewPoly) { map.removeLayer(previewPoly); previewPoly = null; }
}
function cancelDraw() {
    drawing = false;
    map.getContainer().style.cursor = '';
    markers.forEach(m => map.removeLayer(m));
    if (polyLine)    map.removeLayer(polyLine);
    if (previewPoly) map.removeLayer(previewPoly);
    points = []; markers = []; polyLine = null; previewPoly = null;
    toggleDrawButtons(false);
}
function undoPoint() {
    if (!points.length) return;
    points.pop();
    const m = markers.pop(); if (m) map.removeLayer(m);
    refreshPreview();
}
function finishDraw() {
    if (points.length < 3) { alert('Minimal 3 titik diperlukan.'); return; }
    drawing = false;
    map.getContainer().style.cursor = '';
    toggleDrawButtons(false);
    document.getElementById('inp-koordinat').value = JSON.stringify(points);
    if (polyLine) { map.removeLayer(polyLine); polyLine = null; }
    if (previewPoly) map.removeLayer(previewPoly);
    const color = document.getElementById('inp-warna').value;
    previewPoly = L.polygon(points, {
        color, fillColor: color, fillOpacity: 0.2, weight: 2, dashArray: '5,5'
    }).addTo(map);
    map.fitBounds(previewPoly.getBounds().pad(0.1));
}
function refreshPreview() {
    if (polyLine) { map.removeLayer(polyLine); polyLine = null; }
    if (points.length >= 2) {
        polyLine = L.polyline(points, { color: '#3A9A8C', weight: 2, dashArray: '4,4' }).addTo(map);
    }
}
map.on('click', function(e) {
    if (!drawing) return;
    const latlng = [e.latlng.lat, e.latlng.lng];
    points.push(latlng);
    markers.push(L.circleMarker(latlng, {
        radius: 5, fillColor: '#fff', color: '#1E5A52', weight: 2, fillOpacity: 1
    }).addTo(map));
    refreshPreview();
});
function toggleDrawButtons(on) {
    document.getElementById('btn-start-draw').style.display  = on ? 'none' : '';
    document.getElementById('btn-cancel-draw').style.display = on ? '' : 'none';
    document.getElementById('btn-undo').style.display        = on ? '' : 'none';
    document.getElementById('btn-finish').style.display      = on ? '' : 'none';
}

// ─── COLOR PICKER ─────────────────────────────────────────────────────────────
function selectColor(c) {
    document.getElementById('inp-warna').value = c;
    document.getElementById('warna-label').textContent = c;
    document.querySelectorAll('#color-picker .color-dot').forEach(d => {
        d.style.outline = d.dataset.color === c ? '3px solid #333' : 'none';
    });
}
selectColor('#1E5A52');

// ─── SAVE ─────────────────────────────────────────────────────────────────────
document.getElementById('btn-save').addEventListener('click', async function() {
    const isDesa    = currentMode === 'desa';
    const nama      = isDesa ? 'Batas Desa' : document.getElementById('inp-nama').value.trim();
    const warna     = document.getElementById('inp-warna').value;
    const koordinat = document.getElementById('inp-koordinat').value.trim();

    if (!isDesa && !nama) { showAlert('Nama dusun wajib diisi.'); return; }
    if (!koordinat)       { showAlert('Gambar polygon di peta terlebih dahulu.'); return; }

    try {
        const res = await fetch('{{ route("admin.batas_dusun.store") }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: JSON.stringify({ nama_dusun: nama, tipe: currentMode, warna, koordinat })
        });
        const data = await res.json();
        if (data.success) location.reload();
        else showAlert(data.message || 'Gagal menyimpan.');
    } catch(e) { showAlert('Terjadi kesalahan. Coba lagi.'); }
});

function showAlert(msg) {
    const el = document.getElementById('save-alert');
    el.textContent = msg; el.classList.remove('d-none');
    setTimeout(() => el.classList.add('d-none'), 4000);
}

// ─── EDIT ─────────────────────────────────────────────────────────────────────
const editModal = new bootstrap.Modal(document.getElementById('modal-edit'));
function editBatas(id, nama, warna, koordinat) {
    document.getElementById('edit-id').value        = id;
    document.getElementById('edit-nama').value      = nama;
    document.getElementById('edit-warna').value     = warna;
    document.getElementById('edit-koordinat').value = JSON.stringify(koordinat);
    editModal.show();
}
async function simpanEdit() {
    const id = document.getElementById('edit-id').value;
    const nama = document.getElementById('edit-nama').value.trim();
    const warna = document.getElementById('edit-warna').value;
    const koordinat = document.getElementById('edit-koordinat').value.trim();
    if (!nama || !koordinat) { alert('Nama dan koordinat wajib diisi.'); return; }
    const res = await fetch(`/admin/batas-dusun/${id}`, {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        body: JSON.stringify({ nama_dusun: nama, warna, koordinat, is_active: true })
    });
    const data = await res.json();
    if (data.success) location.reload();
    else alert(data.message || 'Gagal memperbarui.');
}

// ─── DELETE ───────────────────────────────────────────────────────────────────
async function hapusBatas(id, nama) {
    if (!confirm(`Hapus batas dusun "${nama}"?`)) return;
    const res = await fetch(`/admin/batas-dusun/${id}`, {
        method: 'DELETE',
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
    });
    const data = await res.json();
    if (data.success) location.reload();
    else alert(data.message || 'Gagal menghapus.');
}
</script>
@endpush
