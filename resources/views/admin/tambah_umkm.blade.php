@extends('layouts.admin')
@section('title', 'Tambah UMKM')
@section('page-title', 'Tambah UMKM')

@section('content')

<div class="card border-0 shadow-sm rounded-3">
    <div class="card-body p-4">

        @if($errors->any())
            <div class="alert alert-danger rounded-3">
                <ul class="mb-0 small">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
        @endif

        <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-4">

                {{-- Kolom Kiri: Data UMKM --}}
                <div class="col-md-6">
                    <h6 class="fw-bold text-navy mb-3 border-bottom pb-2">Data Usaha</h6>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Usaha <span class="text-danger">*</span></label>
                        <input type="text" name="nama_usaha" class="form-control @error('nama_usaha') is-invalid @enderror"
                               value="{{ old('nama_usaha') }}" placeholder="contoh: Batik Tajungan" required>
                        @error('nama_usaha')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Pemilik <span class="text-danger">*</span></label>
                        <input type="text" name="pemilik" class="form-control @error('pemilik') is-invalid @enderror"
                               value="{{ old('pemilik') }}" required>
                        @error('pemilik')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kategori <span class="text-danger">*</span></label>
                        <select name="kategori" class="form-select @error('kategori') is-invalid @enderror" required>
                            <option value="" disabled selected>-- Pilih Kategori --</option>
                            @foreach(['Makanan','Kerajinan','Jasa','Pertanian'] as $kat)
                                <option value="{{ $kat }}" {{ old('kategori') === $kat ? 'selected' : '' }}>{{ $kat }}</option>
                            @endforeach
                        </select>
                        @error('kategori')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">No. WhatsApp</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fab fa-whatsapp text-success"></i></span>
                            <input type="text" name="no_hp" class="form-control"
                                   value="{{ old('no_hp') }}" placeholder="628123456789">
                        </div>
                        <small class="text-muted">Format internasional tanpa +, contoh: 628123456789</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Alamat</label>
                        <input type="text" name="alamat" class="form-control"
                               value="{{ old('alamat') }}" placeholder="contoh: RT 03 RW 01">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Dusun</label>
                        <input type="text" name="dusun" class="form-control"
                               value="{{ old('dusun') }}" placeholder="contoh: Dusun Barat">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Foto Usaha</label>
                        <input type="file" name="foto" class="form-control" accept="image/*" id="fotoInput">
                        <small class="text-muted">JPG, PNG (Maks. 2MB)</small>
                    </div>
                    <div id="fotoPreview" class="d-none mt-2">
                        <img id="previewImg" src="" alt="Preview" class="img-fluid rounded-3" style="max-height:180px;object-fit:cover;">
                    </div>
                </div>

                {{-- Kolom Kanan: Peta --}}
                <div class="col-md-6">
                    <h6 class="fw-bold text-navy mb-3 border-bottom pb-2">Lokasi di Peta <span class="text-danger">*</span></h6>
                    <p class="small text-muted mb-2">Klik pada peta untuk menentukan lokasi UMKM.</p>
                    <div id="map-input" class="border rounded-3 mb-3" style="height:320px;"></div>
                    <div class="row g-2">
                        <div class="col">
                            <label class="form-label small fw-semibold">Latitude</label>
                            <input type="text" name="latitude" id="lat" class="form-control form-control-sm"
                                   placeholder="Klik peta" readonly required>
                        </div>
                        <div class="col">
                            <label class="form-label small fw-semibold">Longitude</label>
                            <input type="text" name="longitude" id="lng" class="form-control form-control-sm"
                                   placeholder="Klik peta" readonly required>
                        </div>
                    </div>
                    <p class="small text-muted mt-2 mb-0"><i class="fas fa-info-circle me-1"></i>Koordinat diisi otomatis setelah klik peta.</p>
                </div>

            </div>

            <hr class="my-4">
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-desa-navy px-5">
                    <i class="fas fa-save me-2"></i>Simpan UMKM
                </button>
                <a href="{{ route('admin.umkm') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

@push('styles')
<style>.text-navy { color: var(--color-6) !important; }</style>
@endpush

@push('scripts')
<script>
    var map = L.map('map-input').setView([-7.15539, 112.69323], 14);
    var streetLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap', maxZoom: 19
    });
    var satelitLayer = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
        attribution: '© Esri World Imagery', maxZoom: 19
    });
    streetLayer.addTo(map);
    L.control.layers({ 'Peta': streetLayer, 'Satelit': satelitLayer }, {}, { position: 'topright' }).addTo(map);
    var marker;

    map.on('click', function(e) {
        if (marker) map.removeLayer(marker);
        marker = L.marker(e.latlng).addTo(map);
        document.getElementById('lat').value = e.latlng.lat.toFixed(7);
        document.getElementById('lng').value = e.latlng.lng.toFixed(7);
    });

    document.getElementById('fotoInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = ev => {
                document.getElementById('previewImg').src = ev.target.result;
                document.getElementById('fotoPreview').classList.remove('d-none');
            };
            reader.readAsDataURL(file);
        } else {
            document.getElementById('fotoPreview').classList.add('d-none');
        }
    });
</script>
@endpush

@endsection
