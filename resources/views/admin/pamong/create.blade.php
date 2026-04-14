@extends('layouts.admin')
@section('title', 'Tambah Pamong')
@section('page-title', 'Tambah Pamong')

@section('content')
<div class="card border-0 shadow-sm rounded-3" style="max-width:640px;">
    <div class="card-body p-4">
        @if($errors->any())
            <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{$e}}</li>@endforeach</ul></div>
        @endif
        <form action="{{ route('admin.pamong.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.pamong._form')
            <button type="submit" class="btn btn-desa-navy w-100 mt-3">
                <i class="fas fa-save me-2"></i>Simpan
            </button>
        </form>
        <a href="{{ route('admin.pamong.index') }}" class="btn btn-outline-secondary w-100 mt-2">Batal</a>
    </div>
</div>
@endsection
