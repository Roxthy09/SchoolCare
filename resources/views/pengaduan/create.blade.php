@extends('layouts.admin')
@section('title', 'Buat Pengaduan')
@section('content')
<div class="container">
    <h4 class="mb-3">Buat Pengaduan</h4>

    <form action="{{ route(auth()->user()->peran.'.pengaduan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Kategori</label>
            <select name="kategori_id" class="form-control" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategoris as $k)
                    <option value="{{ $k->kategori_id }}">{{ $k->nama_kategori }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control"
                   value="{{ old('judul') }}" required>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="4" required>
{{ old('deskripsi') }}</textarea>
        </div>

        <div class="mb-3">
            <label>Lampiran (opsional)</label>
            <input type="file" name="lampiran" class="form-control">
        </div>

        <button class="btn btn-success">Kirim Pengaduan</button>
        <a href="{{ route(auth()->user()->peran.'.pengaduan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
