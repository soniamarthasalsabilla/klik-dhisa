<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label fw-semibold">Tahun Anggaran <span class="text-danger">*</span></label>
        <input type="number" name="tahun" class="form-control" value="{{ old('tahun', $apbde->tahun ?? date('Y')) }}" min="2000" max="2099" required>
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Jenis <span class="text-danger">*</span></label>
        <select name="jenis" class="form-select" required>
            <option value="pendapatan" {{ old('jenis', $apbde->jenis ?? '') === 'pendapatan' ? 'selected' : '' }}>Pendapatan</option>
            <option value="belanja"    {{ old('jenis', $apbde->jenis ?? 'belanja') === 'belanja'    ? 'selected' : '' }}>Belanja</option>
        </select>
    </div>
    <div class="col-12">
        <label class="form-label fw-semibold">Bidang <span class="text-danger">*</span></label>
        <input type="text" name="bidang" class="form-control" value="{{ old('bidang', $apbde->bidang ?? '') }}"
               placeholder="Penyelenggaraan Pemerintahan Desa" required>
    </div>
    <div class="col-12">
        <label class="form-label fw-semibold">Kegiatan <small class="text-muted">(opsional, sub-item bidang)</small></label>
        <input type="text" name="kegiatan" class="form-control" value="{{ old('kegiatan', $apbde->kegiatan ?? '') }}"
               placeholder="Penghasilan Tetap Kades & Perangkat">
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Anggaran (Rp) <span class="text-danger">*</span></label>
        <input type="number" name="anggaran" class="form-control" value="{{ old('anggaran', $apbde->anggaran ?? 0) }}" min="0" required>
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Realisasi (Rp) <span class="text-danger">*</span></label>
        <input type="number" name="realisasi" class="form-control" value="{{ old('realisasi', $apbde->realisasi ?? 0) }}" min="0" required>
    </div>
    <div class="col-md-4">
        <label class="form-label fw-semibold">Urutan Tampil</label>
        <input type="number" name="urutan" class="form-control" value="{{ old('urutan', $apbde->urutan ?? 0) }}" min="0">
    </div>
</div>
