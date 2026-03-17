@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="card shadow border-0 rounded-4 p-4 mb-5">
        <h2 class="mb-4 fw-bold text-center" style="color: #002b5b;">Input Data UMKM Desa Tajungan</h2>
        
        <form action="{{ route('admin.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 text-start">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Usaha</label>
                        <input type="text" name="nama_usaha" class="form-control" value="{{ old('nama_usaha') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Pemilik</label>
                        <input type="text" name="pemilik" class="form-control" value="{{ old('pemilik') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Kategori UMKM</label>
                        <select name="kategori" class="form-select" required>
                            <option value="" selected disabled>-- Pilih Kategori --</option>
                            <option value="Makanan">Makanan</option>
                            <option value="Kerajinan">Kerajinan</option>
                            <option value="Jasa">Jasa</option>
                            <option value="Pertanian">Pertanian</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">No. WhatsApp</label>
                        <input type="text" name="no_hp" class="form-control" placeholder="628123456789">
                    </div>
                </div>
                <div class="col-md-6 text-start">
                    <label class="form-label fw-bold">Lokasi UMKM (Klik pada Peta)</label>
                    <div id="map-input" class="mb-3 shadow-sm border rounded-3" style="height: 300px;"></div>
                    <div class="row g-2">
                        <div class="col">
                            <input type="text" name="latitude" id="lat" class="form-control" placeholder="Lat" readonly required>
                        </div>
                        <div class="col">
                            <input type="text" name="longitude" id="lng" class="form-control" placeholder="Lng" readonly required>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100 py-3 mt-4 fw-bold" style="background: #002b5b; border: none;">
                <i class="fas fa-save me-2"></i> SIMPAN DATA UMKM
            </button>
        </form>
    </div>

    <div class="card shadow border-0 rounded-4 p-4">
        <h4 class="fw-bold mb-4" style="color: #002b5b;">Daftar UMKM Terdaftar</h4>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Nama Usaha</th>
                        <th>Pemilik</th>
                        <th>Kategori</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @isset($umkms)
                        @foreach($umkms as $item)
                        <tr>
                            <td>{{ $item->nama_usaha }}</td>
                            <td>{{ $item->pemilik }}</td>
                            <td><span class="badge bg-info text-dark">{{ $item->kategori }}</span></td>
                            <td class="text-center">
                                <form action="{{ route('admin.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    @endisset
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    var map = L.map('map-input').setView([-7.15539, 112.69323], 14);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
    var marker;

    map.on('click', function(e) {
        if (marker) { map.removeLayer(marker); }
        marker = L.marker(e.latlng).addTo(map);
        document.getElementById('lat').value = e.latlng.lat;
        document.getElementById('lng').value = e.latlng.lng;
    });
</script>
@endpush