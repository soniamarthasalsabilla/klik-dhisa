@extends('layouts.app')

@section('content')
<section class="py-5" style="background: var(--navy); color: white;">
    <div class="container text-center pt-5">
        <h1 class="fw-bold">Informasi Publik</h1>
        <p class="lead opacity-75">Transparansi dokumen dan produk hukum Desa Tajungan</p>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">
        <div class="card border-0 shadow-sm rounded-4 p-4">
            
            <div class="table-responsive">
                {{-- ID 'table-informasi' digunakan untuk inisialisasi DataTables --}}
                <table id="table-informasi" class="table table-hover align-middle w-100">
                    <thead class="table-light">
                        <tr>
                            <th class="py-3 px-3">No</th>
                            <th class="py-3">Judul Informasi</th>
                            <th class="py-3 text-center">Tahun</th>
                            <th class="py-3">Kategori</th>
                            <th class="py-3 text-center">Tanggal Upload</th>
                            <th class="py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="px-3">1</td>
                            <td class="fw-bold">RPJM Desa Tajungan 2024-2030</td>
                            <td class="text-center">2024</td>
                            <td><span class="badge bg-soft-primary text-primary px-3">Perencanaan</span></td>
                            <td class="text-center">15 Jan 2026</td>
                            <td class="text-center">
                                <a href="#" class="btn btn-navy btn-sm text-white" style="background: var(--navy);">
                                    <i class="fas fa-download me-1"></i> Unduh
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3">2</td>
                            <td class="fw-bold">Laporan Realisasi APBDes Semester 1</td>
                            <td class="text-center">2025</td>
                            <td><span class="badge bg-soft-success text-success px-3">Keuangan</span></td>
                            <td class="text-center">02 Mar 2026</td>
                            <td class="text-center">
                                <a href="#" class="btn btn-navy btn-sm text-white" style="background: var(--navy);">
                                    <i class="fas fa-eye me-1"></i> Lihat
                                </a>
                            </td>
                        </tr>
                        {{-- Tambahkan data lainnya di sini --}}
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</section>

{{-- Pastikan CSS & JS DataTables tersedia --}}
@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<style>
    .bg-soft-primary { background-color: rgba(0, 43, 91, 0.1); }
    .bg-soft-success { background-color: rgba(25, 135, 84, 0.1); }
    .table thead th { font-weight: 600; font-size: 0.85rem; text-transform: uppercase; }
    
    /* Kostumisasi tampilan search box DataTables agar sesuai tema */
    .dataTables_filter input {
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 6px 12px;
    }
    .dataTables_length select {
        border-radius: 8px;
    }
    .page-item.active .page-link {
        background-color: var(--navy) !important;
        border-color: var(--navy) !important;
    }
</style>
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#table-informasi').DataTable({
            "language": {
                "lengthMenu": "Tampilkan _MENU_ entri",
                "zeroRecords": "Dokumen tidak ditemukan",
                "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                "infoEmpty": "Data tidak tersedia",
                "infoFiltered": "(disaring dari _MAX_ total data)",
                "search": "Cari:",
                "paginate": {
                    "previous": "Sebelumnya",
                    "next": "Selanjutnya"
                }
            },
            "pageLength": 10,
            "ordering": true,
            "responsive": true
        });
    });
</script>
@endpush
@endsection