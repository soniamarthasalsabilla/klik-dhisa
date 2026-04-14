@extends('layouts.admin')
@section('title', 'Tambah Agenda')
@section('page-title', 'Tambah Agenda Kegiatan')

@section('content')
<div class="card border-0 shadow-sm rounded-3" style="max-width:660px;">
    <div class="card-body p-4">
        @if($errors->any())
            <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{$e}}</li>@endforeach</ul></div>
        @endif
        <form action="{{ route('admin.agenda.store') }}" method="POST">
            @csrf
            @include('admin.agenda._form')
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-desa-navy px-4"><i class="fas fa-save me-2"></i>Simpan</button>
                <a href="{{ route('admin.agenda.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
