@extends('layouts.admin')
@section('title', 'Kelola UMKM')
@section('page-title', 'Kelola UMKM')

@section('content')

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif
@if(session('warning'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <i class="fas fa-exclamation-triangle me-2"></i>{{ session('warning') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="d-flex justify-content-between align-items-center mb-4">
    <p class="text-muted mb-0">Tambah, edit, atau hapus data UMKM yang ditampilkan di peta desa.</p>
    <div class="d-flex gap-2">
        <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#modalImportCsv">
            <i class="fas fa-file-csv me-2"></i>Import CSV
        </button>
        <a href="{{ route('admin.create') }}" class="btn btn-desa-navy">
            <i class="fas fa-plus me-2"></i>Tambah UMKM
        </a>
    </div>
</div>

{{-- Modal Import CSV --}}
<div class="modal fade" id="modalImportCsv" tabindex="-1" aria-labelledby="modalImportCsvLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold" id="modalImportCsvLabel">
                    <i class="fas fa-file-csv text-success me-2"></i>Import Data UMKM dari CSV
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body pt-2">
                <div class="alert alert-info d-flex align-items-start gap-2 py-2 mb-3">
                    <i class="fas fa-info-circle mt-1 flex-shrink-0"></i>
                    <div class="small">
                        File CSV harus memiliki kolom: <strong>nama_usaha, pemilik, kategori, no_hp, alamat, dusun, latitude, longitude</strong>.
                        Kolom <em>no_hp, alamat, dusun, latitude, longitude</em> boleh dikosongkan.
                        <a href="{{ route('admin.umkm.template') }}" class="d-block mt-1 fw-semibold">
                            <i class="fas fa-download me-1"></i>Download template CSV
                        </a>
                    </div>
                </div>
                <form action="{{ route('admin.umkm.import') }}" method="POST" enctype="multipart/form-data" id="formImportCsv">
                    @csrf
                    <div class="mb-3">
                        <label for="file_csv" class="form-label fw-semibold">Pilih File CSV</label>
                        <input type="file" class="form-control @error('file_csv') is-invalid @enderror"
                               id="file_csv" name="file_csv" accept=".csv">
                        @error('file_csv')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success" id="btnImport">
                            <i class="fas fa-upload me-2"></i>Import
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-3">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th class="ps-3" style="width:80px;">Foto</th>
                    <th>Nama Usaha</th>
                    <th>Pemilik</th>
                    <th>Kategori</th>
                    <th>No. WA</th>
                    <th class="text-center" style="width:130px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($semua_umkm as $umkm)
                <tr>
                    <td class="ps-3">
                        @if($umkm->foto)
                            <img src="{{ asset('storage/' . $umkm->foto) }}" alt="{{ $umkm->nama_usaha }}"
                                 class="rounded-2" style="height:48px;width:64px;object-fit:cover;">
                        @else
                            <div class="rounded-2 bg-light d-flex align-items-center justify-content-center text-muted"
                                 style="height:48px;width:64px;">
                                <i class="fas fa-store"></i>
                            </div>
                        @endif
                    </td>
                    <td class="fw-semibold">{{ $umkm->nama_usaha }}</td>
                    <td>{{ $umkm->pemilik }}</td>
                    <td><span class="badge bg-light text-dark border">{{ $umkm->kategori }}</span></td>
                    <td>
                        @if($umkm->no_hp)
                            <a href="https://wa.me/{{ $umkm->no_hp }}" target="_blank" class="text-decoration-none small text-muted">
                                <i class="fab fa-whatsapp text-success me-1"></i>{{ $umkm->no_hp }}
                            </a>
                        @else
                            <span class="text-muted small">-</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('admin.umkm.edit', $umkm->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                            <i class="fas fa-edit me-1"></i>Edit
                        </a>
                        <form method="POST" action="{{ route('admin.destroy', $umkm->id) }}" class="d-inline"
                              onsubmit="return confirm('Hapus UMKM ini?');">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-5">
                        <i class="fas fa-store fa-2x opacity-25 mb-2 d-block"></i>
                        Belum ada data UMKM. <a href="{{ route('admin.create') }}">Tambah sekarang</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($semua_umkm->hasPages())
    <div class="card-footer bg-white border-0 py-3 d-flex justify-content-center">
        {{ $semua_umkm->links() }}
    </div>
    @endif
</div>

@push('scripts')
<script>
document.getElementById('formImportCsv')?.addEventListener('submit', function() {
    const btn = document.getElementById('btnImport');
    btn.disabled = true;
    btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Mengimport...';
});
</script>
@endpush

@endsection
