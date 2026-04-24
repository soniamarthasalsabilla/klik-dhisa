<div class="row g-3">
    <div class="col-md-8">
        <label class="form-label fw-semibold">Nama Aset <span class="text-danger">*</span></label>
        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
               value="{{ old('nama', $aset->nama ?? '') }}" placeholder="contoh: Kantor Desa Tajungan" required>
        @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label fw-semibold">Jenis Aset <span class="text-danger">*</span></label>
        <select name="jenis" class="form-select @error('jenis') is-invalid @enderror" required>
            <option value="" disabled {{ empty(old('jenis', $aset->jenis ?? '')) ? 'selected' : '' }}>-- Pilih --</option>
            @foreach(App\Models\AsetDesa::$jenisOptions as $j)
                <option value="{{ $j }}" {{ old('jenis', $aset->jenis ?? '') === $j ? 'selected' : '' }}>{{ $j }}</option>
            @endforeach
        </select>
        @error('jenis')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label fw-semibold">Kondisi <span class="text-danger">*</span></label>
        <select name="kondisi" class="form-select @error('kondisi') is-invalid @enderror" required>
            @foreach(App\Models\AsetDesa::$kondisiOptions as $k)
                <option value="{{ $k }}" {{ old('kondisi', $aset->kondisi ?? 'Baik') === $k ? 'selected' : '' }}>{{ $k }}</option>
            @endforeach
        </select>
        @error('kondisi')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label fw-semibold">Luas <small class="text-muted fw-normal">(m²)</small></label>
        <input type="number" name="luas" class="form-control" step="0.01" min="0"
               value="{{ old('luas', $aset->luas ?? '') }}" placeholder="opsional">
    </div>
    <div class="col-md-4">
        <label class="form-label fw-semibold">Tahun Perolehan</label>
        <input type="number" name="tahun_perolehan" class="form-control" min="1900" max="2099"
               value="{{ old('tahun_perolehan', $aset->tahun_perolehan ?? '') }}" placeholder="contoh: 2020">
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Lokasi</label>
        <input type="text" name="lokasi" class="form-control"
               value="{{ old('lokasi', $aset->lokasi ?? '') }}" placeholder="contoh: Dusun Barat RT 03">
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Nilai Perolehan <small class="text-muted fw-normal">(Rp)</small></label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="number" name="nilai_perolehan" class="form-control" min="0"
                   value="{{ old('nilai_perolehan', $aset->nilai_perolehan ?? '') }}" placeholder="0">
        </div>
    </div>
    <div class="col-12">
        <label class="form-label fw-semibold">Keterangan</label>
        <textarea name="keterangan" class="form-control" rows="3"
                  placeholder="Deskripsi singkat tentang aset...">{{ old('keterangan', $aset->keterangan ?? '') }}</textarea>
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Foto Aset <small class="text-muted fw-normal">(opsional, maks. 2MB)</small></label>
        <input type="file" name="foto" class="form-control" accept="image/*">
        @if(!empty($aset->foto ?? null))
            <div class="mt-2 d-flex align-items-center gap-2">
                <img src="{{ asset('storage/'.$aset->foto) }}" alt="Foto" class="rounded-2" style="height:60px;object-fit:cover;">
                <small class="text-muted">Foto saat ini</small>
            </div>
        @endif
    </div>
    <div class="col-md-6 d-flex align-items-end pb-1">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1"
                   {{ old('is_active', $aset->is_active ?? true) ? 'checked' : '' }}>
            <label class="form-check-label fw-semibold" for="is_active">Tampilkan di halaman publik</label>
        </div>
    </div>

    {{-- Koordinat Peta --}}
    <div class="col-12">
        <hr class="my-1">
        <p class="fw-semibold mb-2" style="font-size:.85rem;">
            <i class="fas fa-map-marker-alt me-1 text-danger"></i>Koordinat Peta
            <small class="text-muted fw-normal ms-1">(opsional — klik peta untuk menentukan lokasi, atau isi manual)</small>
        </p>
    </div>

    {{-- Koordinat input (auto-filled dari klik peta) --}}
    <div class="col-md-4">
        <label class="form-label fw-semibold">Latitude</label>
        <input type="number" id="input-latitude" name="latitude" class="form-control" step="any"
               value="{{ old('latitude', $aset->latitude ?? '') }}" placeholder="-7.1544">
    </div>
    <div class="col-md-4">
        <label class="form-label fw-semibold">Longitude</label>
        <input type="number" id="input-longitude" name="longitude" class="form-control" step="any"
               value="{{ old('longitude', $aset->longitude ?? '') }}" placeholder="112.6961">
    </div>
    <div class="col-md-4 d-flex align-items-end gap-2">
        <button type="button" id="btn-clear-coords" class="btn btn-outline-danger w-100"
                onclick="clearCoords()" title="Hapus koordinat">
            <i class="fas fa-times me-1"></i>Hapus Lokasi
        </button>
    </div>

    {{-- Map picker --}}
    <div class="col-12">
        <div class="rounded-3 overflow-hidden border" style="height:360px;position:relative;">
            <div id="map-picker" style="height:100%;width:100%;"></div>
            <div style="position:absolute;top:10px;left:50%;transform:translateX(-50%);z-index:1000;
                        background:rgba(30,90,82,.9);color:#fff;font-size:.75rem;font-weight:600;
                        padding:5px 14px;border-radius:20px;pointer-events:none;white-space:nowrap;"
                 id="map-hint">
                <i class="fas fa-crosshairs me-1"></i>Klik pada peta untuk menentukan lokasi aset
            </div>
        </div>
        <small class="text-muted mt-1 d-block">
            <i class="fas fa-info-circle me-1"></i>
            Klik peta → pin otomatis terpasang dan koordinat terisi. Drag pin untuk penyesuaian.
        </small>
    </div>
</div>

@once
@push('styles')
<style>
    #map-picker { cursor: crosshair; }
    .leaflet-container { font-family: 'Poppins', sans-serif; }
    .dusun-tooltip-mini { background: rgba(255,255,255,.85); border: none; box-shadow: none; font-size: .7rem; color: #333; padding: 2px 6px; }
    .dusun-tooltip-mini::before { display: none; }
</style>
@endpush

@push('scripts')
<script>
(function () {
    var initLat  = parseFloat(document.getElementById('input-latitude').value)  || -7.1544;
    var initLng  = parseFloat(document.getElementById('input-longitude').value) || 112.6961;
    var hasCoord = !!(parseFloat(document.getElementById('input-latitude').value));

    var map = L.map('map-picker', { zoomControl: true }).setView([initLat, initLng], hasCoord ? 17 : 15);

    var streetLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap', maxZoom: 19
    });
    var satelitLayer = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
        attribution: '© Esri World Imagery', maxZoom: 19
    });
    streetLayer.addTo(map);
    L.control.layers({ 'Peta': streetLayer, 'Satelit': satelitLayer }, {}, { position: 'topright' }).addTo(map);

    /* ── Batas Desa & Dusun ── */
    @php
        $formBatasDesa  = \App\Models\BatasDusun::where('tipe', 'desa')->first();
        $formBatasDusun = \App\Models\BatasDusun::where('tipe', 'dusun')->where('is_active', true)->orderBy('nama_dusun')->get();
    @endphp
    var batasDesaData = @json($formBatasDesa);
    if (!hasCoord && batasDesaData && batasDesaData.koordinat && batasDesaData.koordinat.length >= 3) {
        var batasLayer = L.polygon(batasDesaData.koordinat, {
            color: batasDesaData.warna || '#1E5A52', weight: 2.5, opacity: 0.8,
            fillColor: batasDesaData.warna || '#3A9A8C', fillOpacity: 0.07, dashArray: '6,4'
        }).addTo(map);
        map.fitBounds(batasLayer.getBounds(), { padding: [20, 20] });
    } else if (batasDesaData && batasDesaData.koordinat && batasDesaData.koordinat.length >= 3) {
        L.polygon(batasDesaData.koordinat, {
            color: batasDesaData.warna || '#1E5A52', weight: 2.5, opacity: 0.8,
            fillColor: batasDesaData.warna || '#3A9A8C', fillOpacity: 0.07, dashArray: '6,4'
        }).addTo(map);
    }
    @json($formBatasDusun).forEach(function(d) {
        if (!d.koordinat || d.koordinat.length < 3) return;
        L.polygon(d.koordinat, {
            color: d.warna || '#3A9A8C', weight: 1.5, opacity: 0.7,
            fillColor: d.warna || '#3A9A8C', fillOpacity: 0.08, dashArray: '4,3'
        }).bindTooltip('<b>' + d.nama_dusun + '</b>', {
            permanent: true, direction: 'center', className: 'dusun-tooltip-mini'
        }).addTo(map);
    });

    /* ---- pin aset ---- */
    function makePin(color) {
        return L.divIcon({
            className: '',
            html: '<div style="background:'+color+';width:32px;height:32px;border-radius:50% 50% 50% 0;transform:rotate(-45deg);border:3px solid white;box-shadow:0 2px 8px rgba(0,0,0,.35);"></div>',
            iconSize: [32, 32], iconAnchor: [16, 32], popupAnchor: [0, -36]
        });
    }

    var pin = null;

    function placePin(lat, lng) {
        if (pin) {
            pin.setLatLng([lat, lng]);
        } else {
            pin = L.marker([lat, lng], { icon: makePin('#0d6efd'), draggable: true }).addTo(map);
            pin.on('dragend', function (e) {
                var p = e.target.getLatLng();
                setCoords(p.lat, p.lng);
            });
        }
        document.getElementById('map-hint').style.display = 'none';
    }

    function setCoords(lat, lng) {
        document.getElementById('input-latitude').value  = lat.toFixed(7);
        document.getElementById('input-longitude').value = lng.toFixed(7);
        placePin(lat, lng);
    }

    // Initial pin if editing existing aset with coords
    if (hasCoord) {
        placePin(initLat, initLng);
    }

    // Click on map
    map.on('click', function (e) {
        setCoords(e.latlng.lat, e.latlng.lng);
        map.setView([e.latlng.lat, e.latlng.lng], Math.max(map.getZoom(), 16));
    });

    // Sync manual input → move pin
    ['input-latitude', 'input-longitude'].forEach(function (id) {
        document.getElementById(id).addEventListener('change', function () {
            var lat = parseFloat(document.getElementById('input-latitude').value);
            var lng = parseFloat(document.getElementById('input-longitude').value);
            if (lat && lng) {
                placePin(lat, lng);
                map.setView([lat, lng], Math.max(map.getZoom(), 16));
            }
        });
    });

    // Clear coords button
    window.clearCoords = function () {
        document.getElementById('input-latitude').value  = '';
        document.getElementById('input-longitude').value = '';
        if (pin) { map.removeLayer(pin); pin = null; }
        document.getElementById('map-hint').style.display = '';
    };

    // Force Leaflet to recalc size after layout renders
    setTimeout(function () { map.invalidateSize(); }, 200);
})();
</script>
@endpush
@endonce
