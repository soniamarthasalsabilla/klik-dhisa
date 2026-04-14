@extends('layouts.admin')
@section('title', 'Edit Aset')
@section('page-title', 'Edit Aset – ' . $aset->nama)

@section('content')
<div class="card border-0 shadow-sm rounded-3" style="max-width:820px;">
    <div class="card-body p-4">
        @if($errors->any())
            <div class="alert alert-danger rounded-3">
                <ul class="mb-0 small">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
        @endif
        <form action="{{ route('admin.aset.update', $aset) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            @include('admin.aset._form', ['aset' => $aset])
            <hr class="mt-4">
            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-desa-navy px-4">
                    <i class="fas fa-save me-2"></i>Simpan Perubahan
                </button>
                <a href="{{ route('admin.aset.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
