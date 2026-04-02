@extends('layouts.admin')

@section('content')
<div class="container">
    <h4>Edit Pengaduan</h4>

    <form action="{{ route(auth()->user()->peran.'.pengaduan.update', $pengaduan->pengaduan_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control"
                   value="{{ $pengaduan->judul }}">
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control">{{ $pengaduan->deskripsi }}</textarea>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route(auth()->user()->peran.'.pengaduan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
