@extends('layouts.admin')

@section('title', 'Log & Riwayat')
@section('page-title', 'Log & Riwayat')
@section('breadcrumb', 'Pantau kunjungan website dan aktivitas admin')

@push('styles')
<style>
    .stat-card { border-radius: 12px; border: none; box-shadow: 0 2px 8px rgba(0,0,0,0.07); }
    .stat-card .icon-box { width: 48px; height: 48px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; }
    .tab-nav .nav-link { color: #6c757d; border-radius: 8px; padding: 8px 18px; font-size: 0.9rem; }
    .tab-nav .nav-link.active { background: var(--color-7); color: #fff; }
    .log-table th { font-size: 0.78rem; text-transform: uppercase; letter-spacing: 0.5px; color: #6c757d; background: #f8f9fa; }
    .log-table td { font-size: 0.88rem; vertical-align: middle; }
    .badge-type { font-size: 0.75rem; padding: 4px 10px; border-radius: 20px; }
    .change-row td { cursor: pointer; }
    .change-detail { background: #f8f9fa; font-size: 0.82rem; }
    .field-diff { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; }
    .field-old { background: #fff3cd; padding: 4px 8px; border-radius: 4px; border-left: 3px solid #ffc107; }
    .field-new { background: #d1e7dd; padding: 4px 8px; border-radius: 4px; border-left: 3px solid #198754; }
    .chart-bar-wrap { display: flex; align-items: flex-end; gap: 6px; height: 80px; }
    .chart-bar { flex: 1; background: var(--color-4); border-radius: 4px 4px 0 0; min-height: 4px; transition: 0.3s; cursor: default; position: relative; }
    .chart-bar:hover { background: var(--color-6); }
    .chart-bar .tooltip-val { display: none; position: absolute; top: -22px; left: 50%; transform: translateX(-50%); background: #333; color: #fff; font-size: 0.7rem; padding: 2px 5px; border-radius: 3px; white-space: nowrap; }
    .chart-bar:hover .tooltip-val { display: block; }
    .chart-labels { display: flex; gap: 6px; font-size: 0.68rem; color: #999; margin-top: 4px; }
    .chart-labels span { flex: 1; text-align: center; }
</style>
@endpush

@section('content')

{{-- ─── Stat Cards ─────────────────────────────────────────────────── --}}
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="card stat-card p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="icon-box" style="background:#e8f5f0; color:var(--color-6)">
                    <i class="fas fa-eye"></i>
                </div>
                <div>
                    <div class="fw-bold fs-5">{{ number_format($stats['kunjungan_hari_ini']) }}</div>
                    <div class="text-muted" style="font-size:0.78rem">Kunjungan Hari Ini</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card stat-card p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="icon-box" style="background:#e3f2fd; color:#1565c0">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div>
                    <div class="fw-bold fs-5">{{ number_format($stats['kunjungan_bulan_ini']) }}</div>
                    <div class="text-muted" style="font-size:0.78rem">Kunjungan Bulan Ini</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card stat-card p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="icon-box" style="background:#fff3e0; color:#e65100">
                    <i class="fas fa-bolt"></i>
                </div>
                <div>
                    <div class="fw-bold fs-5">{{ number_format($stats['aktivitas_hari_ini']) }}</div>
                    <div class="text-muted" style="font-size:0.78rem">Aktivitas Hari Ini</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card stat-card p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="icon-box" style="background:#fce4ec; color:#c62828">
                    <i class="fas fa-database"></i>
                </div>
                <div>
                    <div class="fw-bold fs-5">{{ number_format($stats['perubahan_data_hari_ini']) }}</div>
                    <div class="text-muted" style="font-size:0.78rem">Perubahan Data Hari Ini</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ─── Tab Nav ──────────────────────────────────────────────────────── --}}
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-bottom py-3">
        <ul class="nav tab-nav gap-1">
            <li class="nav-item">
                <a class="nav-link {{ $tab === 'kunjungan' ? 'active' : '' }}"
                   href="{{ route('admin.log.index', ['tab' => 'kunjungan']) }}">
                    <i class="fas fa-users me-1"></i> Riwayat Berkunjung
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $tab === 'aktivitas' ? 'active' : '' }}"
                   href="{{ route('admin.log.index', ['tab' => 'aktivitas']) }}">
                    <i class="fas fa-list-alt me-1"></i> Log Aktivitas
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $tab === 'perubahan' ? 'active' : '' }}"
                   href="{{ route('admin.log.index', ['tab' => 'perubahan']) }}">
                    <i class="fas fa-exchange-alt me-1"></i> Perubahan Data
                </a>
            </li>
        </ul>
    </div>

    <div class="card-body p-4">

        {{-- ══════════════════════════════════════════════════════════════════
             TAB 1 – RIWAYAT BERKUNJUNG
        ══════════════════════════════════════════════════════════════════ --}}
        @if($tab === 'kunjungan')

            {{-- Mini chart --}}
            @if(count($visitorChart))
            @php $maxVal = max(array_column($visitorChart, 'count')) ?: 1; @endphp
            <div class="mb-4">
                <div class="text-muted mb-2" style="font-size:0.8rem; font-weight:600">KUNJUNGAN 7 HARI TERAKHIR</div>
                <div class="chart-bar-wrap">
                    @foreach($visitorChart as $point)
                    <div class="chart-bar" style="height:{{ max(4, round($point['count'] / $maxVal * 80)) }}px">
                        <span class="tooltip-val">{{ $point['count'] }} kunjungan</span>
                    </div>
                    @endforeach
                </div>
                <div class="chart-labels">
                    @foreach($visitorChart as $point)
                    <span>{{ $point['date'] }}</span>
                    @endforeach
                </div>
            </div>
            @endif

            <div class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted" style="font-size:0.85rem">
                    Total: <strong>{{ $visitors->total() }}</strong> kunjungan tercatat
                </span>
                <form method="POST" action="{{ route('admin.log.clearVisitors') }}"
                      onsubmit="return confirm('Hapus semua riwayat kunjungan?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger">
                        <i class="fas fa-trash-alt me-1"></i> Bersihkan Riwayat
                    </button>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table log-table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Waktu</th>
                            <th>IP Address</th>
                            <th>Halaman</th>
                            <th>Browser</th>
                            <th>OS</th>
                            <th>Perangkat</th>
                            <th>Referer</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($visitors as $v)
                        <tr>
                            <td class="text-muted">{{ $visitors->firstItem() + $loop->index }}</td>
                            <td>
                                <div>{{ $v->visited_at->format('d M Y') }}</div>
                                <small class="text-muted">{{ $v->visited_at->format('H:i:s') }}</small>
                            </td>
                            <td><code>{{ $v->ip_address }}</code></td>
                            <td>
                                <div class="fw-semibold">
                                    {{ $v->route_name ? \App\Models\VisitorLog::routeLabel($v->route_name) : $v->page_url }}
                                </div>
                                <small class="text-muted">{{ $v->page_url }}</small>
                            </td>
                            <td>
                                @php
                                    $browserIcons = ['Chrome'=>'fab fa-chrome','Firefox'=>'fab fa-firefox','Safari'=>'fab fa-safari','Edge'=>'fab fa-edge','Opera'=>'fab fa-opera'];
                                    $icon = $browserIcons[$v->browser] ?? 'fas fa-globe';
                                @endphp
                                <i class="{{ $icon }} me-1 text-muted"></i>{{ $v->browser }}
                            </td>
                            <td>{{ $v->os }}</td>
                            <td>
                                @if($v->device === 'Mobile')
                                    <i class="fas fa-mobile-alt text-primary me-1"></i>
                                @elseif($v->device === 'Tablet')
                                    <i class="fas fa-tablet-alt text-warning me-1"></i>
                                @else
                                    <i class="fas fa-desktop text-secondary me-1"></i>
                                @endif
                                {{ $v->device }}
                            </td>
                            <td>
                                @if($v->referer)
                                    <small class="text-muted" title="{{ $v->referer }}">{{ Str::limit($v->referer, 40) }}</small>
                                @else
                                    <small class="text-muted">–</small>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">
                                <i class="fas fa-eye-slash fa-2x mb-2 d-block opacity-25"></i>
                                Belum ada data kunjungan
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($visitors->hasPages())
            <div class="mt-3 d-flex justify-content-center">
                {{ $visitors->links() }}
            </div>
            @endif

        @endif

        {{-- ══════════════════════════════════════════════════════════════════
             TAB 2 – LOG AKTIVITAS
        ══════════════════════════════════════════════════════════════════ --}}
        @if($tab === 'aktivitas')

            <form method="GET" action="{{ route('admin.log.index') }}" class="row g-2 mb-3">
                <input type="hidden" name="tab" value="aktivitas">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control form-control-sm"
                           placeholder="Cari deskripsi atau nama data…" value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="type" class="form-select form-select-sm">
                        <option value="">Semua Tipe</option>
                        @foreach(['login','logout','created','updated','deleted','imported','exported'] as $t)
                        <option value="{{ $t }}" {{ request('type') === $t ? 'selected' : '' }}>
                            {{ \App\Models\ActivityLog::typeLabel($t) }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-auto">
                    <button class="btn btn-sm btn-desa-navy">Filter</button>
                    <a href="{{ route('admin.log.index', ['tab' => 'aktivitas']) }}" class="btn btn-sm btn-outline-secondary ms-1">Reset</a>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table log-table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Waktu</th>
                            <th>Admin</th>
                            <th>Tipe</th>
                            <th>Keterangan</th>
                            <th>Data</th>
                            <th>IP</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($activities as $log)
                        <tr>
                            <td class="text-muted">{{ $activities->firstItem() + $loop->index }}</td>
                            <td>
                                <div>{{ $log->created_at->format('d M Y') }}</div>
                                <small class="text-muted">{{ $log->created_at->format('H:i:s') }}</small>
                            </td>
                            <td>
                                <div class="fw-semibold">{{ $log->user?->name ?? '–' }}</div>
                                <small class="text-muted">{{ $log->user?->email }}</small>
                            </td>
                            <td>
                                <span class="badge badge-type bg-{{ \App\Models\ActivityLog::typeBadgeColor($log->type) }} text-{{ in_array($log->type, ['viewed']) ? 'dark' : 'white' }}">
                                    {{ \App\Models\ActivityLog::typeLabel($log->type) }}
                                </span>
                            </td>
                            <td>{{ $log->description }}</td>
                            <td>
                                @if($log->subject_label)
                                    <div class="fw-semibold">{{ $log->subject_label }}</div>
                                    <small class="text-muted">{{ $log->subject_type }}</small>
                                @else
                                    <span class="text-muted">–</span>
                                @endif
                            </td>
                            <td><code class="text-muted">{{ $log->ip_address }}</code></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                <i class="fas fa-history fa-2x mb-2 d-block opacity-25"></i>
                                Belum ada log aktivitas
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($activities->hasPages())
            <div class="mt-3 d-flex justify-content-center">
                {{ $activities->links() }}
            </div>
            @endif

        @endif

        {{-- ══════════════════════════════════════════════════════════════════
             TAB 3 – PERUBAHAN DATA
        ══════════════════════════════════════════════════════════════════ --}}
        @if($tab === 'perubahan')
        @php
            // Helper aman: konversi nilai apapun (array, bool, null) ke string tampilan
            $safeVal = function($v): string {
                if ($v === null || $v === '') return '(kosong)';
                if (is_bool($v)) return $v ? 'Ya' : 'Tidak';
                if (is_array($v) || is_object($v)) {
                    $s = json_encode($v, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                    return mb_strlen($s) > 150 ? mb_substr($s, 0, 150) . '…' : $s;
                }
                return (string) $v;
            };
        @endphp

            <form method="GET" action="{{ route('admin.log.index') }}" class="row g-2 mb-3">
                <input type="hidden" name="tab" value="perubahan">
                <div class="col-md-3">
                    <select name="type" class="form-select form-select-sm">
                        <option value="">Semua Aksi</option>
                        @foreach(['created','updated','deleted'] as $t)
                        <option value="{{ $t }}" {{ request('type') === $t ? 'selected' : '' }}>
                            {{ \App\Models\ActivityLog::typeLabel($t) }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="subject_type" class="form-select form-select-sm">
                        <option value="">Semua Modul</option>
                        @foreach($subjectTypes as $st)
                        <option value="{{ $st }}" {{ request('subject_type') === $st ? 'selected' : '' }}>{{ $st }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-auto">
                    <button class="btn btn-sm btn-desa-navy">Filter</button>
                    <a href="{{ route('admin.log.index', ['tab' => 'perubahan']) }}" class="btn btn-sm btn-outline-secondary ms-1">Reset</a>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table log-table table-hover mb-0" id="changeTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Waktu</th>
                            <th>Admin</th>
                            <th>Aksi</th>
                            <th>Modul</th>
                            <th>Nama Data</th>
                            <th style="width:36px"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($changes as $log)
                        @php
                            $hasDetail = ($log->old_values || $log->new_values);
                            $rowId = 'detail-' . $log->id;
                        @endphp
                        <tr class="change-row {{ $hasDetail ? '' : '' }}"
                            @if($hasDetail) onclick="toggleDetail('{{ $rowId }}')" @endif>
                            <td class="text-muted">{{ $changes->firstItem() + $loop->index }}</td>
                            <td>
                                <div>{{ $log->created_at->format('d M Y') }}</div>
                                <small class="text-muted">{{ $log->created_at->format('H:i:s') }}</small>
                            </td>
                            <td>{{ $log->user?->name ?? '–' }}</td>
                            <td>
                                <span class="badge badge-type bg-{{ \App\Models\ActivityLog::typeBadgeColor($log->type) }}">
                                    {{ \App\Models\ActivityLog::typeLabel($log->type) }}
                                </span>
                            </td>
                            <td><span class="badge bg-light text-dark border">{{ $log->subject_type }}</span></td>
                            <td class="fw-semibold">{{ $log->subject_label ?? '–' }}</td>
                            <td>
                                @if($hasDetail)
                                <i class="fas fa-chevron-down text-muted" id="icon-{{ $rowId }}" style="font-size:0.75rem; transition:0.2s"></i>
                                @endif
                            </td>
                        </tr>

                        {{-- Detail row dengan diff --}}
                        @if($hasDetail)
                        <tr id="{{ $rowId }}" style="display:none">
                            <td colspan="7" class="change-detail p-0">
                                <div class="p-3">
                                    @if($log->type === 'updated' && $log->old_values && $log->new_values)
                                        <div class="mb-2 fw-semibold text-muted" style="font-size:0.78rem">PERUBAHAN FIELD</div>
                                        <div class="row g-2">
                                            @foreach($log->new_values as $field => $newVal)
                                            @php $oldVal = is_array($log->old_values) ? ($log->old_values[$field] ?? null) : null; @endphp
                                            <div class="col-md-6">
                                                <div class="mb-1 text-muted" style="font-size:0.75rem; font-weight:600">{{ strtoupper($field) }}</div>
                                                <div class="field-diff">
                                                    <div class="field-old">
                                                        <span style="font-size:0.7rem; color:#856404; display:block; margin-bottom:2px">SEBELUM</span>
                                                        {{ $safeVal($oldVal) }}
                                                    </div>
                                                    <div class="field-new">
                                                        <span style="font-size:0.7rem; color:#0a3622; display:block; margin-bottom:2px">SESUDAH</span>
                                                        {{ $safeVal($newVal) }}
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>

                                    @elseif($log->type === 'created' && $log->new_values)
                                        <div class="mb-2 fw-semibold text-muted" style="font-size:0.78rem">DATA DITAMBAHKAN</div>
                                        <div class="row g-2">
                                            @foreach($log->new_values as $field => $val)
                                            @if($val !== null && $val !== '' && $val !== [])
                                            <div class="col-md-4">
                                                <div class="field-new">
                                                    <span style="font-size:0.7rem; font-weight:600; color:#0a3622">{{ strtoupper($field) }}</span>
                                                    <div>{{ $safeVal($val) }}</div>
                                                </div>
                                            </div>
                                            @endif
                                            @endforeach
                                        </div>

                                    @elseif($log->type === 'deleted' && $log->old_values)
                                        <div class="mb-2 fw-semibold text-muted" style="font-size:0.78rem">DATA DIHAPUS</div>
                                        <div class="row g-2">
                                            @foreach($log->old_values as $field => $val)
                                            @if($val !== null && $val !== '' && $val !== [])
                                            <div class="col-md-4">
                                                <div class="field-old">
                                                    <span style="font-size:0.7rem; font-weight:600; color:#856404">{{ strtoupper($field) }}</span>
                                                    <div>{{ $safeVal($val) }}</div>
                                                </div>
                                            </div>
                                            @endif
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endif

                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                <i class="fas fa-database fa-2x mb-2 d-block opacity-25"></i>
                                Belum ada perubahan data tercatat
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($changes->hasPages())
            <div class="mt-3 d-flex justify-content-center">
                {{ $changes->links() }}
            </div>
            @endif

        @endif

    </div>{{-- card-body --}}
</div>{{-- card --}}

@endsection

@push('scripts')
<script>
function toggleDetail(rowId) {
    const row = document.getElementById(rowId);
    const icon = document.getElementById('icon-' + rowId);
    if (!row) return;
    const visible = row.style.display !== 'none';
    row.style.display = visible ? 'none' : 'table-row';
    if (icon) icon.style.transform = visible ? '' : 'rotate(180deg)';
}
</script>
@endpush
