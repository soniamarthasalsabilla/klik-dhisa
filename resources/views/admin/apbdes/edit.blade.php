@extends('layouts.admin')
@section('title', 'Edit APBDes')
@section('page-title', 'Edit Data APBDes')

@section('content')
<div class="card border-0 shadow-sm rounded-3" style="max-width:700px;">
    <div class="card-body p-4">
        @if($errors->any())
            <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{$e}}</li>@endforeach</ul></div>
        @endif
        <form action="{{ route('admin.apbdes.update', $apbde) }}" method="POST">
            @csrf @method('PUT')
            @include('admin.apbdes._form', ['apbde' => $apbde])
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-desa-navy px-4"><i class="fas fa-save me-2"></i>Simpan Perubahan</button>
                <a href="{{ route('admin.apbdes.index', ['tahun' => $apbde->tahun]) }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
