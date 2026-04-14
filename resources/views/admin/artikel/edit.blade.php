@extends('layouts.admin')
@section('title', 'Edit Artikel')
@section('page-title', 'Edit Artikel')

@section('content')
<div class="card border-0 shadow-sm rounded-3">
    <div class="card-body p-4">
        @if($errors->any())
            <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{$e}}</li>@endforeach</ul></div>
        @endif
        @if($artikel->foto)
        <div class="mb-3">
            <label class="form-label fw-semibold">Foto Cover Saat Ini</label><br>
            <img src="{{ asset('storage/'.$artikel->foto) }}" class="rounded" style="max-height:180px;object-fit:cover;">
        </div>
        @endif
        <form action="{{ route('admin.artikel.update', $artikel) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            @include('admin.artikel._form', ['artikel' => $artikel])
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-desa-navy px-4"><i class="fas fa-save me-2"></i>Simpan Perubahan</button>
                <a href="{{ route('admin.artikel.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
