@extends('layouts.admin')
@section('title', 'Profil Desa')
@section('page-title', 'Profil Desa')
@section('breadcrumb', 'Identitas & Informasi Desa Tajungan')

@section('content')
<form action="{{ route('admin.profil_desa.update') }}" method="POST">
    @csrf
    @method('PUT')

    <div class="row g-4">
        {{-- Visi & Misi --}}
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bg-white fw-bold"><i class="fas fa-eye me-2 text-primary"></i>Visi & Misi</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Visi Desa</label>
                        <input type="text" name="visi" class="form-control" value="{{ $settings['visi'] ?? '' }}" placeholder="Visi jangka panjang desa...">
                    </div>
                    <div class="mb-0">
                        <label class="form-label fw-semibold">Misi Desa <small class="text-muted">(tiap baris = 1 poin misi)</small></label>
                        <textarea name="misi" class="form-control" rows="5" placeholder="1. Meningkatkan kualitas pelayanan...">{{ $settings['misi'] ?? '' }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sejarah --}}
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bg-white fw-bold"><i class="fas fa-book me-2 text-success"></i>Sejarah Desa</div>
                <div class="card-body">
                    <textarea name="sejarah" class="form-control" rows="8" placeholder="Tuliskan sejarah singkat desa...">{{ $settings['sejarah'] ?? '' }}</textarea>
                </div>
            </div>
        </div>

        {{-- Identitas --}}
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-3 h-100">
                <div class="card-header bg-white fw-bold"><i class="fas fa-info-circle me-2 text-info"></i>Identitas Desa</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Luas Wilayah (Ha)</label>
                        <input type="text" name="luas_wilayah" class="form-control" value="{{ $settings['luas_wilayah'] ?? '' }}" placeholder="145">
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold">Jumlah Penduduk</label>
                            <input type="number" name="jumlah_penduduk" class="form-control" value="{{ $settings['jumlah_penduduk'] ?? '' }}" placeholder="2450">
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold">Jumlah KK</label>
                            <input type="number" name="jumlah_kk" class="form-control" value="{{ $settings['jumlah_kk'] ?? '' }}" placeholder="650">
                        </div>
                        <div class="col-4">
                            <label class="form-label fw-semibold">Jumlah Dusun</label>
                            <input type="number" name="jumlah_dusun" class="form-control" value="{{ $settings['jumlah_dusun'] ?? '' }}" placeholder="2">
                        </div>
                        <div class="col-4">
                            <label class="form-label fw-semibold">Jumlah RW</label>
                            <input type="number" name="jumlah_rw" class="form-control" value="{{ $settings['jumlah_rw'] ?? '' }}" placeholder="4">
                        </div>
                        <div class="col-4">
                            <label class="form-label fw-semibold">Jumlah RT</label>
                            <input type="number" name="jumlah_rt" class="form-control" value="{{ $settings['jumlah_rt'] ?? '' }}" placeholder="12">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Tahun Berdiri</label>
                            <input type="text" name="tahun_berdiri" class="form-control" value="{{ $settings['tahun_berdiri'] ?? '' }}" placeholder="1945">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Jarak ke Kantor --}}
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-3 h-100">
                <div class="card-header bg-white fw-bold"><i class="fas fa-road me-2 text-secondary"></i>Jarak ke Kantor <small class="text-muted fw-normal">(km)</small></div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kantor Kecamatan</label>
                        <div class="input-group">
                            <input type="number" step="0.1" name="jarak_kecamatan" class="form-control" value="{{ $settings['jarak_kecamatan'] ?? '' }}" placeholder="3">
                            <span class="input-group-text">km</span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kantor Kabupaten</label>
                        <div class="input-group">
                            <input type="number" step="0.1" name="jarak_kabupaten" class="form-control" value="{{ $settings['jarak_kabupaten'] ?? '' }}" placeholder="14">
                            <span class="input-group-text">km</span>
                        </div>
                    </div>
                    <div class="mb-0">
                        <label class="form-label fw-semibold">Kantor Provinsi</label>
                        <div class="input-group">
                            <input type="number" step="0.1" name="jarak_provinsi" class="form-control" value="{{ $settings['jarak_provinsi'] ?? '' }}" placeholder="120">
                            <span class="input-group-text">km</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Batas Wilayah --}}
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-3 h-100">
                <div class="card-header bg-white fw-bold"><i class="fas fa-map-marked-alt me-2 text-warning"></i>Batas Wilayah</div>
                <div class="card-body">
                    @foreach(['utara','selatan','timur','barat'] as $arah)
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Sebelah {{ ucfirst($arah) }}</label>
                        <input type="text" name="batas_{{ $arah }}" class="form-control"
                               value="{{ $settings['batas_'.$arah] ?? '' }}"
                               placeholder="Berbatasan dengan...">
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-desa-navy px-5">
                <i class="fas fa-save me-2"></i>Simpan Profil Desa
            </button>
        </div>
    </div>
</form>

{{-- ===== KONTAK DARURAT (terpisah dari form profil) ===== --}}
<div class="d-flex justify-content-between align-items-center mt-5 mb-3">
    <div>
        <h6 class="fw-bold mb-0" style="color:var(--color-7);">
            <i class="fas fa-phone-alt me-2 text-danger"></i>Kontak Darurat
        </h6>
        <small class="text-muted">Ditampilkan di bagian bawah halaman beranda publik.</small>
    </div>
    <button class="btn btn-desa-navy btn-sm px-3" data-bs-toggle="modal" data-bs-target="#modalKontak">
        <i class="fas fa-plus me-1"></i>Tambah
    </button>
</div>

{{-- Preview --}}
<div class="card border-0 shadow-sm rounded-3 mb-3">
    <div class="card-header bg-white border-bottom py-2 px-3">
        <span style="font-size:.78rem;font-weight:600;color:var(--color-6);"><i class="fas fa-eye me-1"></i>Preview</span>
    </div>
    <div class="card-body py-3">
        <div class="row g-2">
            @forelse($kontaks->where('is_active', true) as $k)
            <div class="col-6 col-md-3 col-lg-2">
                <div class="text-center p-2 rounded-3" style="background:{{ $k->warna_bg }};">
                    <i class="fas {{ $k->icon }}" style="color:{{ $k->warna_teks }};font-size:1.1rem;"></i>
                    <div style="font-size:1rem;font-weight:800;color:{{ $k->warna_teks }};">{{ $k->nomor }}</div>
                    <div style="font-size:.7rem;font-weight:600;color:#444;">{{ $k->nama }}</div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center text-muted small py-2">Belum ada kontak aktif.</div>
            @endforelse
        </div>
    </div>
</div>

{{-- Tabel --}}
<div class="card border-0 shadow-sm rounded-3">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead style="background:var(--color-1);">
                <tr>
                    <th class="ps-3" style="width:40px;color:var(--color-7);">#</th>
                    <th style="color:var(--color-7);">Nama</th>
                    <th style="color:var(--color-7);">Nomor</th>
                    <th style="color:var(--color-7);">Ikon &amp; Warna</th>
                    <th class="text-center" style="width:60px;color:var(--color-7);">Urutan</th>
                    <th class="text-center" style="color:var(--color-7);">Status</th>
                    <th class="text-center" style="width:120px;color:var(--color-7);">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kontaks as $k)
                <tr class="{{ $k->is_active ? '' : 'opacity-50' }}">
                    <td class="ps-3 text-muted small">{{ $loop->iteration }}</td>
                    <td class="fw-semibold">{{ $k->nama }}</td>
                    <td><code>{{ $k->nomor }}</code></td>
                    <td>
                        <span style="background:{{ $k->warna_bg }};padding:4px 10px;border-radius:8px;display:inline-flex;align-items:center;gap:6px;">
                            <i class="fas {{ $k->icon }}" style="color:{{ $k->warna_teks }};"></i>
                            <small style="color:#888;font-size:.68rem;">{{ $k->icon }}</small>
                        </span>
                    </td>
                    <td class="text-center text-muted small">{{ $k->urutan }}</td>
                    <td class="text-center">
                        <form method="POST" action="{{ route('admin.kontak_darurat.toggle', $k) }}" class="d-inline">
                            @csrf @method('PATCH')
                            <button class="badge border-0 {{ $k->is_active ? 'bg-success' : 'bg-secondary' }}" style="cursor:pointer;font-size:.72rem;">
                                {{ $k->is_active ? 'Aktif' : 'Nonaktif' }}
                            </button>
                        </form>
                    </td>
                    <td class="text-center">
                        <button class="btn btn-sm btn-outline-primary rounded-pill px-2 me-1"
                                onclick="editKontak({{ $k->id }},'{{ addslashes($k->nama) }}','{{ addslashes($k->nomor) }}','{{ $k->icon }}','{{ $k->warna_bg }}','{{ $k->warna_teks }}',{{ $k->urutan }})">
                            <i class="fas fa-edit"></i>
                        </button>
                        <form method="POST" action="{{ route('admin.kontak_darurat.destroy', $k) }}" class="d-inline"
                              onsubmit="return confirm('Hapus {{ $k->nama }}?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger rounded-pill px-2"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center text-muted py-4">Belum ada kontak darurat.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-2 text-muted" style="font-size:.72rem;">
    <i class="fas fa-info-circle me-1 text-primary"></i>
    Contoh ikon: <code>fa-ambulance</code>, <code>fa-fire</code>, <code>fa-shield-alt</code>, <code>fa-hospital</code>, <code>fa-phone-alt</code>, <code>fa-car</code>
</div>

{{-- Modal Tambah/Edit --}}
<div class="modal fade" id="modalKontak" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold">
                    <i class="fas fa-phone-alt me-2 text-danger"></i>
                    <span id="modalKontakTitle">Tambah Kontak Darurat</span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formKontak" method="POST" action="{{ route('admin.kontak_darurat.store') }}">
                    @csrf
                    <span id="methodField"></span>

                    <div class="row g-3 mb-3">
                        <div class="col-8">
                            <label class="form-label fw-semibold">Nama <span class="text-danger">*</span></label>
                            <input type="text" name="nama" id="kNama" class="form-control" placeholder="contoh: Ambulans" required>
                        </div>
                        <div class="col-4">
                            <label class="form-label fw-semibold">Urutan</label>
                            <input type="number" name="urutan" id="kUrutan" class="form-control" min="0" value="0">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nomor Telepon <span class="text-danger">*</span></label>
                        <input type="text" name="nomor" id="kNomor" class="form-control" placeholder="118" required>
                    </div>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <label class="form-label fw-semibold mb-0">Ikon <span class="text-danger">*</span></label>
                            <a href="https://fontawesome.com/icons?d=gallery&s=solid&m=free" target="_blank"
                               class="text-decoration-none" style="font-size:.75rem;color:var(--color-5);">
                                <i class="fas fa-external-link-alt me-1"></i>Lihat semua ikon tersedia
                            </a>
                        </div>
                        <div class="input-group">
                            <span class="input-group-text" style="min-width:40px;justify-content:center;">
                                <i class="fas fa-phone-alt" id="kIconPreview"></i>
                            </span>
                            <input type="text" name="icon" id="kIcon" class="form-control"
                                   placeholder="fa-ambulance" required oninput="kUpdateIcon(this.value)">
                        </div>
                        <small class="text-muted">Contoh: <code>fa-ambulance</code>, <code>fa-fire</code>, <code>fa-shield-alt</code>, <code>fa-hospital</code> — salin nama kelas dari situs FontAwesome lalu tempel di sini.</small>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold">Warna Background</label>
                            <div class="input-group">
                                <input type="color" name="warna_bg" id="kBg" class="form-control form-control-color" value="#E8F5F0"
                                       oninput="document.getElementById('kBgTxt').value=this.value; kUpdatePreview()">
                                <input type="text" id="kBgTxt" class="form-control" value="#E8F5F0"
                                       oninput="document.getElementById('kBg').value=this.value; kUpdatePreview()">
                            </div>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold">Warna Teks/Ikon</label>
                            <div class="input-group">
                                <input type="color" name="warna_teks" id="kTeks" class="form-control form-control-color" value="#1E5A52"
                                       oninput="document.getElementById('kTeksTxt').value=this.value; kUpdatePreview()">
                                <input type="text" id="kTeksTxt" class="form-control" value="#1E5A52"
                                       oninput="document.getElementById('kTeks').value=this.value; kUpdatePreview()">
                            </div>
                        </div>
                    </div>

                    {{-- Mini preview --}}
                    <div class="d-flex justify-content-center mb-3">
                        <div id="kPreviewCard" class="text-center p-3 rounded-3" style="background:#E8F5F0;min-width:110px;">
                            <i class="fas fa-phone-alt" id="kPreviewIcon" style="color:#1E5A52;font-size:1.3rem;"></i>
                            <div id="kPreviewNomor" style="font-size:1.2rem;font-weight:800;color:#1E5A52;">—</div>
                            <div id="kPreviewNama" style="font-size:.75rem;font-weight:600;color:#444;">Nama</div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-desa-navy"><i class="fas fa-save me-1"></i>Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function kUpdateIcon(v) {
    document.getElementById('kIconPreview').className = 'fas ' + v.trim();
    document.getElementById('kPreviewIcon').className = 'fas ' + v.trim();
    document.getElementById('kPreviewIcon').style.fontSize = '1.3rem';
    kUpdatePreview();
}
function kUpdatePreview() {
    var bg   = document.getElementById('kBg').value;
    var teks = document.getElementById('kTeks').value;
    document.getElementById('kPreviewCard').style.background = bg;
    document.getElementById('kPreviewIcon').style.color      = teks;
    document.getElementById('kPreviewNomor').style.color     = teks;
    document.getElementById('kPreviewNomor').textContent = document.getElementById('kNomor').value || '—';
    document.getElementById('kPreviewNama').textContent  = document.getElementById('kNama').value  || 'Nama';
}
document.getElementById('kNomor').addEventListener('input', kUpdatePreview);
document.getElementById('kNama').addEventListener('input', kUpdatePreview);

function editKontak(id, nama, nomor, icon, bg, teks, urutan) {
    document.getElementById('modalKontakTitle').textContent = 'Edit Kontak Darurat';
    var form = document.getElementById('formKontak');
    form.action = '/admin/kontak-darurat/' + id;
    document.getElementById('methodField').innerHTML = '<input type="hidden" name="_method" value="PUT">';
    document.getElementById('kNama').value    = nama;
    document.getElementById('kNomor').value   = nomor;
    document.getElementById('kIcon').value    = icon;
    document.getElementById('kUrutan').value  = urutan;
    document.getElementById('kBg').value      = bg;
    document.getElementById('kBgTxt').value   = bg;
    document.getElementById('kTeks').value    = teks;
    document.getElementById('kTeksTxt').value = teks;
    kUpdateIcon(icon);
    kUpdatePreview();
    new bootstrap.Modal(document.getElementById('modalKontak')).show();
}

document.getElementById('modalKontak').addEventListener('show.bs.modal', function(e) {
    if (e.relatedTarget) {
        document.getElementById('modalKontakTitle').textContent = 'Tambah Kontak Darurat';
        document.getElementById('formKontak').action = '{{ route('admin.kontak_darurat.store') }}';
        document.getElementById('methodField').innerHTML = '';
        ['kNama','kNomor'].forEach(function(id) { document.getElementById(id).value = ''; });
        document.getElementById('kIcon').value    = 'fa-phone-alt';
        document.getElementById('kUrutan').value  = '0';
        document.getElementById('kBg').value      = '#E8F5F0';
        document.getElementById('kBgTxt').value   = '#E8F5F0';
        document.getElementById('kTeks').value    = '#1E5A52';
        document.getElementById('kTeksTxt').value = '#1E5A52';
        kUpdateIcon('fa-phone-alt');
        kUpdatePreview();
    }
});
</script>
@endpush
@endsection
