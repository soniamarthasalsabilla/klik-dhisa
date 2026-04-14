<div class="mb-3">
    <label class="form-label fw-semibold">Judul Foto <span class="text-danger">*</span></label>
    <input type="text" name="judul" class="form-control" value="{{ old('judul', $galeri->judul ?? '') }}" required>
</div>
<div class="mb-3">
    <label class="form-label fw-semibold">Kategori</label>
    <input type="text" name="kategori" class="form-control" value="{{ old('kategori', $galeri->kategori ?? 'Umum') }}"
           list="kategori-list" placeholder="Kegiatan, Infrastruktur, Budaya...">
    <datalist id="kategori-list">
        <option value="Umum"><option value="Kegiatan"><option value="Infrastruktur">
        <option value="Budaya"><option value="Pendidikan"><option value="Kesehatan">
    </datalist>
</div>
<div class="mb-3">
    <label class="form-label fw-semibold">Deskripsi</label>
    <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi', $galeri->deskripsi ?? '') }}</textarea>
</div>
<div class="mb-3">
    <label class="form-label fw-semibold">File Foto {{ isset($galeri) ? '(kosongkan jika tidak ganti)' : '' }} <span class="text-danger">{{ isset($galeri) ? '' : '*' }}</span></label>
    <input type="file" name="foto" class="form-control" accept="image/jpeg,image/png,image/jpg" id="fotoInput" {{ isset($galeri) ? '' : 'required' }}>
    <small class="text-muted">Format: JPG, PNG (Max. 4MB)</small>
    <div id="preview" class="mt-2 d-none">
        <img id="previewImg" class="img-fluid rounded" style="max-height:150px;">
    </div>
</div>
<div class="form-check form-switch">
    <input class="form-check-input" type="checkbox" name="is_active" id="is_active"
           {{ old('is_active', $galeri->is_active ?? true) ? 'checked' : '' }}>
    <label class="form-check-label" for="is_active">Tampilkan di website</label>
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
