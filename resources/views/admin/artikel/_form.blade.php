<div class="mb-3">
    <label class="form-label fw-semibold">Judul Artikel <span class="text-danger">*</span></label>
    <input type="text" name="judul" class="form-control" value="{{ old('judul', $artikel->judul ?? '') }}" required>
</div>
<div class="mb-3">
    <label class="form-label fw-semibold">Kategori</label>
    <input type="text" name="kategori" class="form-control" value="{{ old('kategori', $artikel->kategori ?? 'Umum') }}"
           list="kat-list" placeholder="Umum, Pembangunan, Kesehatan...">
    <datalist id="kat-list">
        <option value="Umum"><option value="Pembangunan"><option value="Kesehatan">
        <option value="Ekonomi"><option value="Pendidikan"><option value="Sosial"><option value="Lingkungan">
    </datalist>
</div>
<div class="mb-3">
    <label class="form-label fw-semibold">Ringkasan / Excerpt</label>
    <textarea name="ringkasan" class="form-control" rows="2" placeholder="Deskripsi singkat artikel...">{{ old('ringkasan', $artikel->ringkasan ?? '') }}</textarea>
</div>
<div class="mb-3">
    <label class="form-label fw-semibold">Isi Artikel <span class="text-danger">*</span></label>
    <textarea name="isi" class="form-control" rows="12" required>{{ old('isi', $artikel->isi ?? '') }}</textarea>
</div>
<div class="mb-3">
    <label class="form-label fw-semibold">Foto Cover {{ isset($artikel) ? '(kosongkan jika tidak ganti)' : '' }}</label>
    <input type="file" name="foto" class="form-control" accept="image/jpeg,image/png,image/jpg" id="fotoInput">
    <small class="text-muted">Format: JPG, PNG (Max. 4MB)</small>
    <div id="preview" class="mt-2 d-none">
        <img id="previewImg" class="img-fluid rounded" style="max-height:200px;">
    </div>
</div>
<div class="form-check form-switch">
    <input class="form-check-input" type="checkbox" name="is_active" id="is_active"
           {{ old('is_active', $artikel->is_active ?? true) ? 'checked' : '' }}>
    <label class="form-check-label" for="is_active">Publikasikan sekarang</label>
</div>

@push('scripts')
<script>
document.getElementById('fotoInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = ev => {
            document.getElementById('previewImg').src = ev.target.result;
            document.getElementById('preview').classList.remove('d-none');
        };
        reader.readAsDataURL(file);
    }
});
</script>
@endpush
