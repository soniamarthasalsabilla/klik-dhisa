@extends('layouts.admin')
@section('title', 'Tulis Artikel')
@section('page-title', 'Tulis Artikel Baru')

@section('content')
<div class="card border-0 shadow-sm rounded-3">
    <div class="card-body p-4">
        @if($errors->any())
            <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{$e}}</li>@endforeach</ul></div>
        @endif
        <form action="{{ route('admin.artikel.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.artikel._form')
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-desa-navy px-4"><i class="fas fa-save me-2"></i>Simpan Artikel</button>
                <a href="{{ route('admin.artikel.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
