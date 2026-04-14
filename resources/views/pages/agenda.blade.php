@extends('layouts.app')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css" rel="stylesheet">
<style>
    /* FullCalendar overrides */
    .fc { font-family: 'Poppins', sans-serif; }
    .fc-toolbar-title { font-size: 1.1rem !important; font-weight: 700; color: var(--color-7); }
    .fc-button-primary {
        background-color: var(--color-6) !important;
        border-color: var(--color-6) !important;
        font-size: .78rem !important;
        padding: 5px 12px !important;
    }
    .fc-button-primary:hover { background-color: var(--color-7) !important; border-color: var(--color-7) !important; }
    .fc-button-primary:disabled { background-color: var(--color-4) !important; border-color: var(--color-4) !important; }
    .fc-day-today { background: var(--color-1) !important; }
    .fc-event { cursor: pointer; font-size: .72rem !important; border-radius: 4px !important; padding: 1px 4px !important; }
    .fc-daygrid-event-dot { display: none; }
    .fc-col-header-cell { background: var(--color-1); }
    .fc-col-header-cell-cushion { color: var(--color-7) !important; font-weight: 600; font-size: .8rem; }

    /* Agenda card */
    .agenda-card {
        border-left: 4px solid var(--color-5);
        border-radius: 0 12px 12px 0;
        background: white;
        padding: 14px 16px;
        margin-bottom: 10px;
        transition: .2s;
        box-shadow: 0 2px 8px rgba(0,0,0,.05);
    }
    .agenda-card:hover { transform: translateX(4px); box-shadow: 0 4px 16px rgba(58,154,140,.12); }
    .agenda-card.past { border-left-color: #adb5bd; opacity: .75; }

    .date-box {
        min-width: 52px; text-align: center;
        background: var(--color-1);
        border-radius: 10px;
        padding: 6px 8px;
    }
    .date-box .day  { font-size: 1.4rem; font-weight: 700; color: var(--color-6); line-height: 1; }
    .date-box .month{ font-size: .62rem; color: var(--color-5); text-transform: uppercase; font-weight: 600; }

    /* Modal */
    #agenda-modal .modal-header { background: var(--color-7); color: white; }
    #agenda-modal .btn-close { filter: invert(1); }
</style>
@endpush

@section('content')

{{-- Hero --}}
<section class="py-3" style="background: white; border-bottom: 3px solid var(--color-5);">
    <div class="container text-center py-4">
        <h2 class="fw-bold mb-2" style="color: var(--color-7); font-size: 2rem;">
            <i class="fas fa-calendar-alt me-2" style="color:var(--color-5);"></i>Agenda Kegiatan Desa
        </h2>
        <p class="mb-0" style="color: var(--color-6); font-size: 1rem;">Jadwal kegiatan dan acara Desa Tajungan</p>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">
        <div class="row g-4">

            {{-- ===== KALENDER ===== --}}
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="fw-bold mb-0" style="color:var(--color-7);">
                            <i class="fas fa-calendar me-2" style="color:var(--color-5);"></i>Kalender Kegiatan
                        </h5>
                        {{-- Legenda --}}
                        <div class="d-flex flex-wrap gap-2">
                            @foreach(['Rapat'=>'#1E5A52','Penyuluhan'=>'#0d6efd','Keagamaan'=>'#fd7e14','Olahraga'=>'#198754','Sosial'=>'#6f42c1','Pembangunan'=>'#dc3545'] as $kat => $col)
                            <span class="d-flex align-items-center gap-1" style="font-size:.65rem;color:#555;">
                                <span style="width:10px;height:10px;border-radius:3px;background:{{ $col }};display:inline-block;"></span>
                                {{ $kat }}
                            </span>
                            @endforeach
                        </div>
                    </div>
                    <div id="kalender"></div>
                </div>
            </div>

            {{-- ===== SIDEBAR MENDATANG ===== --}}
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 sticky-top" style="top:90px;">
                    <h6 class="fw-bold mb-3" style="color:var(--color-7);">
                        <i class="fas fa-calendar-check me-2" style="color:var(--color-5);"></i>Kegiatan Mendatang
                    </h6>

                    @forelse($mendatang as $agenda)
                    <div class="agenda-card">
                        <div class="d-flex gap-3 align-items-start">
                            <div class="date-box flex-shrink-0">
                                <div class="day">{{ $agenda->tanggal->format('d') }}</div>
                                <div class="month">{{ $agenda->tanggal->format('M Y') }}</div>
                            </div>
                            <div class="flex-grow-1">
                                <p class="fw-bold mb-1" style="font-size:.85rem;color:var(--color-7);">{{ $agenda->judul }}</p>
                                <div class="d-flex flex-wrap gap-1 mb-1">
                                    <span class="badge rounded-pill" style="background:var(--color-1);color:var(--color-6);font-size:.65rem;">
                                        {{ $agenda->kategori }}
                                    </span>
                                    @if($agenda->tanggal->isToday())
                                        <span class="badge bg-warning text-dark" style="font-size:.65rem;">Hari ini</span>
                                    @endif
                                </div>
                                @if($agenda->lokasi)
                                <small class="text-muted d-block"><i class="fas fa-map-marker-alt me-1"></i>{{ $agenda->lokasi }}</small>
                                @endif
                                @if($agenda->waktu_mulai)
                                <small class="text-muted"><i class="fas fa-clock me-1"></i>{{ substr($agenda->waktu_mulai,0,5) }}{{ $agenda->waktu_selesai ? ' – '.substr($agenda->waktu_selesai,0,5) : '' }}</small>
                                @endif
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-3 text-muted small">
                        <i class="fas fa-calendar-times fa-2x mb-2 opacity-25 d-block"></i>
                        Tidak ada kegiatan mendatang
                    </div>
                    @endforelse

                    @if($mendatang->hasPages())
                    <div class="mt-2" style="font-size:.75rem;">{{ $mendatang->links() }}</div>
                    @endif
                </div>
            </div>

        </div>

        {{-- ===== KEGIATAN LALU ===== --}}
        @if($lalu->isNotEmpty())
        <div class="mt-5">
            <h5 class="fw-bold mb-3" style="color:var(--color-7);">
                <i class="fas fa-history me-2" style="color:#adb5bd;"></i>Kegiatan Sebelumnya
            </h5>
            <div class="card border-0 shadow-sm rounded-4">
                <div class="list-group list-group-flush rounded-4">
                    @foreach($lalu as $agenda)
                    <div class="list-group-item border-0 py-3 px-4">
                        <div class="d-flex align-items-center gap-3">
                            <div class="date-box flex-shrink-0" style="background:#f8f9fa;">
                                <div class="day" style="color:#adb5bd;">{{ $agenda->tanggal->format('d') }}</div>
                                <div class="month" style="color:#adb5bd;">{{ $agenda->tanggal->format('M Y') }}</div>
                            </div>
                            <div class="flex-grow-1">
                                <p class="fw-semibold mb-0 text-muted">{{ $agenda->judul }}</p>
                                <small class="text-muted">
                                    @if($agenda->lokasi)<i class="fas fa-map-marker-alt me-1"></i>{{ $agenda->lokasi }} · @endif
                                    {{ $agenda->kategori }}
                                </small>
                            </div>
                            <span class="badge bg-secondary rounded-pill">Selesai</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @if($lalu->hasPages())
            <div class="mt-3">{{ $lalu->links() }}</div>
            @endif
        </div>
        @endif

    </div>
</section>

{{-- Modal Detail Agenda --}}
<div class="modal fade" id="agenda-modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header">
                <h6 class="modal-title fw-bold mb-0" id="modal-judul">—</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <span class="badge rounded-pill mb-3" id="modal-kategori" style="background:var(--color-5);">—</span>
                <div class="row g-3 mb-3">
                    <div class="col-6">
                        <div class="p-3 rounded-3" style="background:var(--color-1);">
                            <small class="text-muted d-block mb-1"><i class="fas fa-calendar me-1"></i>Tanggal</small>
                            <span class="fw-bold" style="color:var(--color-7);font-size:.9rem;" id="modal-tanggal">—</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-3 rounded-3" style="background:var(--color-1);">
                            <small class="text-muted d-block mb-1"><i class="fas fa-clock me-1"></i>Waktu</small>
                            <span class="fw-bold" style="color:var(--color-7);font-size:.9rem;" id="modal-waktu">—</span>
                        </div>
                    </div>
                </div>
                <div class="p-3 rounded-3 mb-3" style="background:var(--color-1);" id="modal-lokasi-wrap">
                    <small class="text-muted d-block mb-1"><i class="fas fa-map-marker-alt me-1"></i>Lokasi</small>
                    <span class="fw-bold" style="color:var(--color-7);font-size:.9rem;" id="modal-lokasi">—</span>
                </div>
                <p class="text-muted small mb-0" id="modal-deskripsi"></p>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/locales/id.global.min.js"></script>
<script>
var agendaData = @json($kalender);
var modal      = new bootstrap.Modal(document.getElementById('agenda-modal'));

document.addEventListener('DOMContentLoaded', function () {
    var cal = new FullCalendar.Calendar(document.getElementById('kalender'), {
        locale: 'id',
        initialView: 'dayGridMonth',
        headerToolbar: {
            left:   'prev,next today',
            center: 'title',
            right:  'dayGridMonth,listMonth'
        },
        buttonText: { today: 'Hari Ini', month: 'Bulan', list: 'Daftar' },
        events: agendaData,
        eventClick: function (info) {
            var e  = info.event;
            var ep = e.extendedProps;

            document.getElementById('modal-judul').textContent    = e.title;
            document.getElementById('modal-kategori').textContent = ep.kategori || '—';
            document.getElementById('modal-tanggal').textContent  =
                e.start.toLocaleDateString('id-ID', { weekday:'long', day:'numeric', month:'long', year:'numeric' });
            document.getElementById('modal-waktu').textContent    = ep.waktu || 'Sepanjang hari';
            document.getElementById('modal-lokasi').textContent   = ep.lokasi || '—';
            document.getElementById('modal-lokasi-wrap').style.display = ep.lokasi ? '' : 'none';
            document.getElementById('modal-deskripsi').textContent = ep.deskripsi || '';

            modal.show();
        },
        eventDidMount: function (info) {
            info.el.title = info.event.title;
        },
        height: 'auto',
        fixedWeekCount: false,
    });
    cal.render();
});
</script>
@endpush
