@extends('layouts.admin')
@section('title', 'Kelola Konten – ' . ucfirst($section))
@section('page-title', 'Kelola Konten – ' . ucfirst($section))

@php
$sectionLabels = [
    'layanan'   => 'Layanan Desa',
    'informasi' => 'Informasi Publik',
    'arsip'     => 'Publikasi Desa',
    'kades'     => 'Profil Kepala Desa',
];
$sectionLabel = $sectionLabels[$section] ?? ucfirst($section);

$katWarna = [
    'Administrasi'   => ['bg' => '#e8f0fe', 'color' => '#0d6efd'],
    'Keterangan'     => ['bg' => '#e8f5e9', 'color' => '#198754'],
    'Perizinan'      => ['bg' => '#fff3e0', 'color' => '#fd7e14'],
    'Bantuan Sosial' => ['bg' => '#fce4e4', 'color' => '#dc3545'],
];
@endphp

@section('content')

{{-- Header Bar --}}
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <p class="text-muted mb-0 small">
            <i class="fas fa-layer-group me-1"></i>
            Mengelola <strong>{{ $sectionLabel }}</strong> — {{ $items->total() }} entri
        </p>
    </div>
    @if($section !== 'kades' || $items->total() === 0)
    <a href="{{ route('admin.content.create', $section) }}" class="btn btn-desa-navy btn-sm px-3">
        <i class="fas fa-plus me-1"></i>Tambah
        @if($section === 'layanan') Layanan @elseif($section === 'informasi') Informasi @elseif($section === 'arsip') Dokumen @else Konten @endif
    </a>
    @endif
</div>

{{-- Tabel --}}
<div class="card border-0 shadow-sm rounded-3">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead style="background: var(--color-1);">
                <tr>
                    <th class="ps-3" style="width:40px; color:var(--color-7);">#</th>
                    <th style="color:var(--color-7);">
                        @if($section === 'layanan') Nama Layanan
                        @elseif($section === 'arsip') Judul Dokumen
                        @else Judul @endif
                    </th>
                    @if($section === 'layanan')
                        <th style="color:var(--color-7);">Kategori</th>
                        <th style="color:var(--color-7);">Deskripsi Singkat</th>
                    @elseif($section === 'arsip')
                        <th style="color:var(--color-7);">Kategori</th>
                        <th style="color:var(--color-7);">Tahun</th>
                    @elseif($section === 'informasi')
                        <th style="color:var(--color-7);">Kategori</th>
                        <th style="color:var(--color-7);">Link/File</th>
                    @else
                        <th style="color:var(--color-7);">Ringkasan</th>
                    @endif
                    <th style="color:var(--color-7);">Status</th>
                    <th class="text-center" style="width:130px; color:var(--color-7);">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                <tr>
                    <td class="ps-3 text-muted small">{{ $loop->iteration }}</td>
                    <td>
                        <span class="fw-semibold" style="color:var(--color-7); font-size:.9rem;">{{ $item->title }}</span>
                        @if($section === 'layanan' && $item->body)
                            <br><small class="text-muted" style="font-size:.73rem;">
                                <i class="fas fa-list-check me-1" style="color:var(--color-4);"></i>{{ Str::limit($item->body, 50) }}
                            </small>
                        @endif
                    </td>

                    @if($section === 'layanan')
                        <td>
                            @php $kw = $katWarna[$item->category] ?? ['bg'=>'#f0f0f0','color'=>'#666']; @endphp
                            @if($item->category)
                                <span class="badge rounded-pill px-2 py-1" style="background:{{ $kw['bg'] }};color:{{ $kw['color'] }};font-size:.73rem;font-weight:600;">
                                    {{ $item->category }}
                                </span>
                            @else
                                <span class="text-muted small">-</span>
                            @endif
                        </td>
                        <td>
                            <span class="text-muted small" style="font-size:.8rem;">{{ Str::limit($item->excerpt, 60) ?? '-' }}</span>
                        </td>
                    @elseif($section === 'arsip')
                        <td>
                            @if($item->category)
                                <span class="badge bg-light text-dark border" style="font-size:.73rem;">{{ $item->category }}</span>
                            @else
                                <span class="text-muted small">-</span>
                            @endif
                        </td>
                        <td><span class="text-muted small">{{ $item->year ?? '-' }}</span></td>
                    @elseif($section === 'informasi')
                        <td>
                            @if($item->category)
                                <span class="badge bg-light text-dark border" style="font-size:.73rem;">{{ $item->category }}</span>
                            @else
                                <span class="text-muted small">-</span>
                            @endif
                        </td>
                        <td>
                            @if($item->link)
                                <a href="{{ $item->link }}" target="_blank" class="small text-primary"><i class="fas fa-link me-1"></i>Tautan</a>
                            @elseif($item->file)
                                <span class="small text-success"><i class="fas fa-file me-1"></i>File</span>
                            @else
                                <span class="text-muted small">-</span>
                            @endif
                        </td>
                    @else
                        <td><span class="text-muted small">{{ Str::limit($item->excerpt, 70) ?? '-' }}</span></td>
                    @endif

                    <td>
                        @if($item->is_active)
                            <span class="badge rounded-pill" style="background:var(--color-1);color:var(--color-6);font-size:.73rem;">
                                <i class="fas fa-circle me-1" style="font-size:.4rem;vertical-align:middle;"></i>Aktif
                            </span>
                        @else
                            <span class="badge bg-light text-secondary rounded-pill" style="font-size:.73rem;">Nonaktif</span>
                        @endif
                    </td>

                    <td class="text-center">
                        <a href="{{ route('admin.content.edit', ['section' => $section, 'id' => $item->id]) }}"
                           class="btn btn-sm btn-outline-primary rounded-pill px-3 me-1" style="font-size:.78rem;">
                            <i class="fas fa-edit me-1"></i>Edit
                        </a>
                        <form action="{{ route('admin.content.destroy', ['section' => $section, 'id' => $item->id]) }}"
                              method="POST" class="d-inline"
                              onsubmit="return confirm('Hapus \'{{ addslashes($item->title) }}\'? Tindakan ini tidak dapat dibatalkan.');">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger rounded-pill px-2" style="font-size:.78rem;" title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-5">
                        <i class="fas fa-inbox fa-2x mb-3 d-block" style="color:var(--color-3);"></i>
                        <p class="text-muted mb-2">Belum ada data untuk bagian ini.</p>
                        <a href="{{ route('admin.content.create', $section) }}" class="btn btn-sm btn-desa-navy rounded-pill px-3">
                            <i class="fas fa-plus me-1"></i>Tambah Sekarang
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($items->hasPages())
    <div class="card-footer bg-white border-top py-3 px-4">
        {{ $items->links() }}
    </div>
    @endif
</div>


@endsection
