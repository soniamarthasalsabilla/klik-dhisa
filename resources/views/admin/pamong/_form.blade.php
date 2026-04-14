<div class="mb-3">
    <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
    <input type="text" name="nama" class="form-control" value="{{ old('nama', $pamong->nama ?? '') }}" required>
</div>
<div class="mb-3">
    <label class="form-label fw-semibold">Jabatan <span class="text-danger">*</span></label>
    <input type="text" name="jabatan" class="form-control" value="{{ old('jabatan', $pamong->jabatan ?? '') }}" placeholder="Kepala Desa, Sekretaris, dll" required>
</div>
<div class="mb-3">
    <label class="form-label fw-semibold">No. HP / WhatsApp</label>
    <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $pamong->no_hp ?? '') }}" placeholder="628xxx">
</div>
<div class="mb-3">
    <label class="form-label fw-semibold">Urutan Tampil</label>
    <input type="number" name="urutan" class="form-control" value="{{ old('urutan', $pamong->urutan ?? 0) }}" min="0">
    <small class="text-muted">Angka kecil tampil lebih dulu</small>
</div>
<div class="mb-3">
    <label class="form-label fw-semibold">Foto</label>
    <input type="file" name="foto" class="form-control" accept="image/jpeg,image/png,image/jpg">
    <small class="text-muted">Format: JPG, PNG (Max. 2MB)</small>
</div>
<div class="form-check form-switch mb-0">
    <input class="form-check-input" type="checkbox" name="is_active" id="is_active"
           {{ old('is_active', $pamong->is_active ?? true) ? 'checked' : '' }}>
    <label class="form-check-label" for="is_active">Tampilkan di website</label>
</div>
