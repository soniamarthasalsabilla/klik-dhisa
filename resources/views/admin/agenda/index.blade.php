@extends('layouts.admin')
@section('title', 'Kelola Agenda')
@section('page-title', 'Agenda Kegiatan Desa')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <span class="text-muted">Total: {{ $agendas->total() }} kegiatan</span>
    <a href="{{ route('admin.agenda.create') }}" class="btn btn-desa-navy">
        <i class="fas fa-plus me-1"></i> Tambah Agenda
    </a>
</div>

<div class="card border-0 shadow-sm rounded-3">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Judul</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Lokasi</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($agendas as $agenda)
                <tr class="{{ $agenda->tanggal->isPast() ? 'text-muted' : '' }}">
                    <td class="fw-semibold">{{ $agenda->judul }}</td>
                    <td>
                        <span class="{{ $agenda->tanggal->isFuture() ? 'fw-bold text-success' : '' }}">
                            {{ $agenda->tanggal->translatedFormat('d M Y') }}
                        </span>
                        @if($agenda->tanggal->isToday())<span class="badge bg-warning text-dark ms-1">Hari ini</span>@endif
                    </td>
                    <td>
                        @if($agenda->waktu_mulai)
                            {{ substr($agenda->waktu_mulai, 0, 5) }}
                            @if($agenda->waktu_selesai) – {{ substr($agenda->waktu_selesai, 0, 5) }} @endif
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>{{ $agenda->lokasi ?? '-' }}</td>
                    <td><span class="badge bg-light text-dark border">{{ $agenda->kategori }}</span></td>
                    <td>
                        <span class="badge {{ $agenda->is_active ? 'bg-success' : 'bg-secondary' }}">
                            {{ $agenda->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.agenda.edit', $agenda) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.agenda.destroy', $agenda) }}"
                                  onsubmit="return confirm('Hapus agenda ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center text-muted py-4">Belum ada agenda.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-3">{{ $agendas->links() }}</div>
</div>
@endsection
