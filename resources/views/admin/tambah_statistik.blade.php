@extends('layouts.admin')
@section('title', 'Tambah Data Statistik')
@section('page-title', 'Tambah Data Statistik')

@section('content')
<div class="card border-0 shadow-sm rounded-3" style="max-width:560px;">
    <div class="card-body p-4">
        @if($errors->any())
            <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
        @endif
        <form action="{{ route('admin.statistik.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-semibold">Kategori <span class="text-danger">*</span></label>
                <input type="text" name="kategori" class="form-control @error('kategori') is-invalid @enderror"
                       value="{{ old('kategori') }}" placeholder="contoh: Pendidikan" required>
                @error('kategori')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Label <span class="text-danger">*</span></label>
                <input type="text" name="label" class="form-control @error('label') is-invalid @enderror"
                       value="{{ old('label') }}" placeholder="contoh: SD" required>
                @error('label')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-4">
                <label class="form-label fw-semibold">Jumlah <span class="text-danger">*</span></label>
                <input type="number" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror"
                       value="{{ old('jumlah', 0) }}" min="0" required>
                @error('jumlah')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-desa-navy px-4"><i class="fas fa-save me-2"></i>Simpan</button>
                <a href="{{ route('admin.statistik') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
