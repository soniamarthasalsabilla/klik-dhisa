<div class="mb-3">
    <label class="form-label fw-semibold">Judul Kegiatan <span class="text-danger">*</span></label>
    <input type="text" name="judul" class="form-control" value="{{ old('judul', $agenda->judul ?? '') }}" required>
</div>
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label fw-semibold">Tanggal <span class="text-danger">*</span></label>
        <input type="date" name="tanggal" class="form-control"
               value="{{ old('tanggal', isset($agenda) ? $agenda->tanggal->format('Y-m-d') : '') }}" required>
    </div>
    <div class="col-md-3">
        <label class="form-label fw-semibold">Waktu Mulai</label>
        <input type="time" name="waktu_mulai" class="form-control" value="{{ old('waktu_mulai', $agenda->waktu_mulai ?? '') }}">
    </div>
    <div class="col-md-3">
        <label class="form-label fw-semibold">Waktu Selesai</label>
        <input type="time" name="waktu_selesai" class="form-control" value="{{ old('waktu_selesai', $agenda->waktu_selesai ?? '') }}">
    </div>
</div>
<div class="mb-3 mt-3">
    <label class="form-label fw-semibold">Lokasi</label>
    <input type="text" name="lokasi" class="form-control" value="{{ old('lokasi', $agenda->lokasi ?? '') }}" placeholder="Balai Desa, Lapangan, dll">
</div>
<div class="mb-3">
    <label class="form-label fw-semibold">Kategori</label>
    <input type="text" name="kategori" class="form-control" value="{{ old('kategori', $agenda->kategori ?? 'Umum') }}"
           list="kat-list" placeholder="Rapat, Kesehatan, Sosial...">
    <datalist id="kat-list">
        <option value="Umum"><option value="Rapat Desa"><option value="Kesehatan">
        <option value="Pendidikan"><option value="Ekonomi"><option value="Sosial"><option value="Budaya">
    </datalist>
</div>
<div class="mb-3">
    <label class="form-label fw-semibold">Deskripsi</label>
    <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi', $agenda->deskripsi ?? '') }}</textarea>
</div>
<div class="form-check form-switch">
    <input class="form-check-input" type="checkbox" name="is_active" id="is_active"
           {{ old('is_active', $agenda->is_active ?? true) ? 'checked' : '' }}>
    <label class="form-check-label" for="is_active">Tampilkan di website</label>
</div>
