@extends('layouts.admin')
@section('title', 'Edit UMKM')
@section('page-title', 'Edit UMKM')

@section('content')

<div class="card border-0 shadow-sm rounded-3">
    <div class="card-body p-4">

        @if($errors->any())
            <div class="alert alert-danger rounded-3">
                <ul class="mb-0 small">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
        @endif

        <form action="{{ route('admin.umkm.update', $umkm->id) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="row g-4">

                {{-- Kolom Kiri: Data UMKM --}}
                <div class="col-md-6">
                    <h6 class="fw-bold text-navy mb-3 border-bottom pb-2">Data Usaha</h6>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Usaha <span class="text-danger">*</span></label>
                        <input type="text" name="nama_usaha" class="form-control @error('nama_usaha') is-invalid @enderror"
                               value="{{ old('nama_usaha', $umkm->nama_usaha) }}" required>
                        @error('nama_usaha')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Pemilik <span class="text-danger">*</span></label>
                        <input type="text" name="pemilik" class="form-control @error('pemilik') is-invalid @enderror"
                               value="{{ old('pemilik', $umkm->pemilik) }}" required>
                        @error('pemilik')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kategori <span class="text-danger">*</span></label>
                        <select name="kategori" class="form-select @error('kategori') is-invalid @enderror" required>
                            <option value="" disabled>-- Pilih Kategori --</option>
                            @foreach(['Makanan','Kerajinan','Jasa','Pertanian'] as $kat)
                                <option value="{{ $kat }}" {{ old('kategori', $umkm->kategori) === $kat ? 'selected' : '' }}>{{ $kat }}</option>
                            @endforeach
                        </select>
                        @error('kategori')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">No. WhatsApp</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fab fa-whatsapp text-success"></i></span>
                            <input type="text" name="no_hp" class="form-control"
                                   value="{{ old('no_hp', $umkm->no_hp) }}" placeholder="628123456789">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Ganti Foto <small class="text-muted fw-normal">(kosongkan jika tidak diganti)</small></label>
                        <input type="file" name="foto" class="form-control" accept="image/*" id="fotoInput">
                        <small class="text-muted">JPG, PNG (Maks. 2MB)</small>
                    </div>

                    {{-- Foto saat ini --}}
                    <div id="fotoPreview" class="{{ $umkm->foto ? '' : 'd-none' }} mt-2">
                        <label class="form-label small text-muted">Foto saat ini:</label><br>
                        <img id="previewImg" src="{{ $umkm->foto ? asset('storage/'.$umkm->foto) : '' }}"
                             alt="Foto UMKM" class="img-fluid rounded-3" style="max-height:180px;object-fit:cover;">
                    </div>
                </div>

                {{-- Kolom Kanan: Peta --}}
                <div class="col-md-6">
                    <h6 class="fw-bold text-navy mb-3 border-bottom pb-2">Lokasi di Peta</h6>
                    <p class="small text-muted mb-2">Klik peta untuk memindahkan lokasi.</p>
                    <div id="map-input" class="border rounded-3 mb-3" style="height:320px;"></div>
                    <div class="row g-2">
                        <div class="col">
                            <label class="form-label small fw-semibold">Latitude</label>
                            <input type="text" name="latitude" id="lat" class="form-control form-control-sm"
                                   value="{{ old('latitude', $umkm->latitude) }}" required>
                        </div>
                        <div class="col">
                            <label class="form-label small fw-semibold">Longitude</label>
                            <input type="text" name="longitude" id="lng" class="form-control form-control-sm"
                                   value="{{ old('longitude', $umkm->longitude) }}" required>
                        </div>
                    </div>
                </div>

            </div>

            <hr class="my-4">
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-desa-navy px-5">
                    <i class="fas fa-save me-2"></i>Simpan Perubahan
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
    var lat = {{ $umkm->latitude ?? -7.15539 }};
    var lng = {{ $umkm->longitude ?? 112.69323 }};

    var map = L.map('map-input').setView([lat, lng], 15);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap'
    }).addTo(map);

    var marker = L.marker([lat, lng]).addTo(map);

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
        }
    });
</script>
@endpush

@endsection
