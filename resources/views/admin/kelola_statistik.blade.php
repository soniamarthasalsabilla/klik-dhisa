@extends('layouts.admin')
@section('title', 'Kelola Statistik')
@section('page-title', 'Manajemen Data Statistik')

@section('content')

<div class="row g-4">

    {{-- Panel Tab Kiri --}}
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-3 sticky-top" style="top: 90px;">
            <div class="card-body p-3">

                <p class="sidebar-label mb-2">Statistik Penduduk</p>
                @foreach([
                    ['cat' => 'Rentang Umur',      'icon' => 'fa-users'],
                    ['cat' => 'Pendidikan',         'icon' => 'fa-graduation-cap'],
                    ['cat' => 'Pekerjaan',          'icon' => 'fa-briefcase'],
                    ['cat' => 'Agama',              'icon' => 'fa-pray'],
                    ['cat' => 'Status Perkawinan',  'icon' => 'fa-ring'],
                ] as $item)
                <button class="tab-btn btn btn-sm w-100 text-start mb-1 rounded-2" data-category="{{ $item['cat'] }}">
                    <i class="fas {{ $item['icon'] }} me-2"></i>{{ $item['cat'] }}
                </button>
                @endforeach

                <p class="sidebar-label mb-2 mt-3">Statistik Keluarga</p>
                @foreach([
                    ['cat' => 'Kepala Keluarga',   'icon' => 'fa-home'],
                    ['cat' => 'Kesejahteraan',      'icon' => 'fa-chart-line'],
                    ['cat' => 'Jaminan Kesehatan',  'icon' => 'fa-heartbeat'],
                ] as $item)
                <button class="tab-btn btn btn-sm w-100 text-start mb-1 rounded-2" data-category="{{ $item['cat'] }}">
                    <i class="fas {{ $item['icon'] }} me-2"></i>{{ $item['cat'] }}
                </button>
                @endforeach

                <p class="sidebar-label mb-2 mt-3">Statistik Bantuan</p>
                @foreach([
                    ['cat' => 'PKH',           'icon' => 'fa-hand-holding-heart'],
                    ['cat' => 'BPNT',          'icon' => 'fa-shopping-basket'],
                    ['cat' => 'BLT Dana Desa', 'icon' => 'fa-money-bill-wave'],
                ] as $item)
                <button class="tab-btn btn btn-sm w-100 text-start mb-1 rounded-2" data-category="{{ $item['cat'] }}">
                    <i class="fas {{ $item['icon'] }} me-2"></i>{{ $item['cat'] }}
                </button>
                @endforeach

            </div>
        </div>
    </div>

    {{-- Area Konten Kanan --}}
    <div class="col-md-9">

        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body p-4">

                {{-- Empty State --}}
                <div id="empty-state" class="text-center py-5">
                    <i class="fas fa-mouse-pointer fa-3x text-muted opacity-25 mb-3"></i>
                    <p class="text-muted">Pilih kategori di sebelah kiri untuk mulai mengelola data statistik.</p>
                </div>

                {{-- Form --}}
                <form id="statistic-form" action="{{ route('admin.statistik.updateMultiple') }}" method="POST" style="display:none;">
                    @csrf @method('PUT')

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-bold mb-0 text-navy" id="form-title">Pilih Kategori</h5>
                        <div class="d-flex gap-2">
                            <button type="button" id="export-excel" class="btn btn-sm btn-outline-success rounded-pill" style="display:none;">
                                <i class="fas fa-download me-1"></i>Unduh Excel
                            </button>
                            <a href="{{ route('admin.statistik.create') }}" class="btn btn-sm btn-outline-primary rounded-pill">
                                <i class="fas fa-plus me-1"></i>Tambah Data
                            </a>
                        </div>
                    </div>

                    <div id="form-fields"></div>

                    <hr class="my-3">
                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill" onclick="resetForm()">
                            <i class="fas fa-times me-1"></i>Batal
                        </button>
                        <button type="submit" class="btn btn-desa-navy btn-sm px-4 rounded-pill">
                            <i class="fas fa-save me-1"></i>Simpan Perubahan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .tab-btn { color: rgba(255,255,255,0.75); background: transparent; border: none; transition: 0.15s; }
    .tab-btn:hover { background-color: rgba(255,255,255,0.12); color: white; }
    .tab-btn.active { background-color: rgba(255,255,255,0.2); color: white; font-weight: 600; }
    .tab-btn i { width: 16px; text-align: center; }
    /* override card background untuk tab panel agar match sidebar admin */
    .col-md-3 .card { background-color: var(--color-7) !important; }
    .col-md-3 .sidebar-label { font-size: 0.68rem; text-transform: uppercase; letter-spacing: 1px; color: rgba(255,255,255,0.4); font-weight: 600; padding: 0 4px; }
    .text-navy { color: var(--color-6) !important; }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const tabButtons  = document.querySelectorAll('.tab-btn');
    const form        = document.getElementById('statistic-form');
    const formTitle   = document.getElementById('form-title');
    const formFields  = document.getElementById('form-fields');
    const emptyState  = document.getElementById('empty-state');
    const exportBtn   = document.getElementById('export-excel');
    const allStats    = @json($allStatistics);

    tabButtons.forEach(btn => {
        btn.addEventListener('click', function () {
            tabButtons.forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            const cat = this.dataset.category;
            formTitle.textContent = 'Kelola Data: ' + cat;
            emptyState.style.display = 'none';

            // Hapus hidden input kategori lama
            form.querySelectorAll('input[name="kategori"]').forEach(el => el.remove());

            formFields.innerHTML = '';
            const filtered = allStats.filter(s => s.kategori === cat);

            if (filtered.length === 0) {
                formFields.innerHTML = '<p class="text-muted text-center py-4">Belum ada data untuk kategori ini.</p>';
            } else {
                filtered.forEach(stat => {
                    const div = document.createElement('div');
                    div.className = 'mb-3 p-3 bg-light rounded-3 border';
                    div.innerHTML = `
                        <label class="form-label fw-semibold small text-muted mb-2">${stat.label}</label>
                        <div class="row align-items-center g-2">
                            <div class="col-8">
                                <input type="text" class="form-control form-control-sm" value="${stat.label}" readonly>
                                <input type="hidden" name="stats[${stat.id}][id]" value="${stat.id}">
                            </div>
                            <div class="col-4">
                                <input type="number" name="stats[${stat.id}][jumlah]" class="form-control form-control-sm" value="${stat.jumlah}" min="0" required>
                            </div>
                        </div>`;
                    formFields.appendChild(div);
                });
            }

            const catInput = document.createElement('input');
            catInput.type  = 'hidden';
            catInput.name  = 'kategori';
            catInput.value = cat;
            form.appendChild(catInput);

            form.style.display = 'block';
            exportBtn.style.display = 'inline-block';
            exportBtn.onclick = () => {
                window.location.href = '/admin/statistik/export/' + encodeURIComponent(cat);
            };
        });
    });

    window.resetForm = function () {
        form.style.display = 'none';
        emptyState.style.display = 'block';
        formTitle.textContent = 'Pilih Kategori';
        exportBtn.style.display = 'none';
        tabButtons.forEach(b => b.classList.remove('active'));
    };
});
</script>
@endpush

@endsection
