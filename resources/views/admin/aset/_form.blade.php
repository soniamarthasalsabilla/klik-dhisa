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
            <small class="text-muted fw-normal ms-1">(opsional — untuk menampilkan pin di Peta Tematik)</small>
        </p>
    </div>
    <div class="col-md-4">
        <label class="form-label fw-semibold">Latitude</label>
        <input type="number" name="latitude" class="form-control" step="any"
               value="{{ old('latitude', $aset->latitude ?? '') }}" placeholder="-7.1544">
        <small class="text-muted">Contoh: -7.1544</small>
    </div>
    <div class="col-md-4">
        <label class="form-label fw-semibold">Longitude</label>
        <input type="number" name="longitude" class="form-control" step="any"
               value="{{ old('longitude', $aset->longitude ?? '') }}" placeholder="112.6961">
        <small class="text-muted">Contoh: 112.6961</small>
    </div>
    <div class="col-md-4">
        <label class="form-label fw-semibold">Cari Koordinat</label>
        <a href="https://www.google.com/maps" target="_blank" class="btn btn-outline-secondary w-100">
            <i class="fas fa-map me-1"></i>Buka Google Maps
        </a>
        <small class="text-muted">Klik kanan pada peta → "Salin koordinat"</small>
    </div>
</div>
