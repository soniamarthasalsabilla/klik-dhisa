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
                        <div class="col-6">
                            <label class="form-label fw-semibold">Jumlah RT</label>
                            <input type="number" name="jumlah_rt" class="form-control" value="{{ $settings['jumlah_rt'] ?? '' }}" placeholder="12">
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold">Jumlah RW</label>
                            <input type="number" name="jumlah_rw" class="form-control" value="{{ $settings['jumlah_rw'] ?? '' }}" placeholder="4">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Tahun Berdiri</label>
                            <input type="text" name="tahun_berdiri" class="form-control" value="{{ $settings['tahun_berdiri'] ?? '' }}" placeholder="1945">
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
@endsection
