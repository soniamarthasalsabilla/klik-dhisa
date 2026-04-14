@extends('layouts.admin')
@section('title', 'Edit Galeri')
@section('page-title', 'Edit Foto Galeri')

@section('content')
<div class="card border-0 shadow-sm rounded-3" style="max-width:600px;">
    <div class="card-body p-4">
        @if($errors->any())
            <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{$e}}</li>@endforeach</ul></div>
        @endif
        <div class="mb-3">
            <img src="{{ asset('storage/'.$galeri->foto) }}" class="img-fluid rounded-3 w-100" style="max-height:250px;object-fit:cover;">
        </div>
        <form action="{{ route('admin.galeri.update', $galeri) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            @include('admin.galeri._form', ['galeri' => $galeri])
            <button type="submit" class="btn btn-desa-navy w-100 mt-3"><i class="fas fa-save me-2"></i>Simpan Perubahan</button>
        </form>
        <a href="{{ route('admin.galeri.index') }}" class="btn btn-outline-secondary w-100 mt-2">Batal</a>
    </div>
</div>
@endsection
