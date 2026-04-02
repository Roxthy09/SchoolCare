@extends('layouts.admin')

@section('content')
<div class="container">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0 fw-semibold">
            <i class="ti ti-user-plus"></i> Tambah Data Orangtua
        </h4>

        <a href="{{ route('orangtua.index') }}"
           class="btn btn-outline-secondary btn-sm">
            <i class="ti ti-arrow-left"></i> Kembali
        </a>
    </div>

    {{-- CARD --}}
    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('orangtua.store') }}" method="POST">
                @csrf

                <div class="row">

                    {{-- USER --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">User ID</label>
                        <input type="number"
                               name="user_id"
                               class="form-control @error('user_id') is-invalid @enderror"
                               value="{{ old('user_id') }}"
                               placeholder="ID akun login orangtua">
                        @error('user_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- NAMA ORANGTUA --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Orangtua</label>
                        <input type="text"
                               name="nama_orangtua"
                               class="form-control @error('nama_orangtua') is-invalid @enderror"
                               value="{{ old('nama_orangtua') }}"
                               placeholder="Nama lengkap orangtua">
                        @error('nama_orangtua')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- NAMA SISWA --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Siswa</label>
                        <input type="text"
                               name="nama_siswa"
                               class="form-control @error('nama_siswa') is-invalid @enderror"
                               value="{{ old('nama_siswa') }}"
                               placeholder="Nama siswa">
                        @error('nama_siswa')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- KELAS --}}
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Kelas Siswa</label>
                        <input type="text"
                               name="kelas_siswa"
                               class="form-control @error('kelas_siswa') is-invalid @enderror"
                               value="{{ old('kelas_siswa') }}"
                               placeholder="Contoh: 9A">
                        @error('kelas_siswa')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- NO KONTAK --}}
                    <div class="col-md-3 mb-3">
                        <label class="form-label">No Kontak</label>
                        <input type="text"
                               name="no_kontak"
                               class="form-control @error('no_kontak') is-invalid @enderror"
                               value="{{ old('no_kontak') }}"
                               placeholder="08xxxxxxxx">
                        @error('no_kontak')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                {{-- ACTION --}}
                <div class="d-flex justify-content-end gap-2 mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-device-floppy"></i> Simpan
                    </button>
                    <a href="{{ route('orangtua.index') }}" class="btn btn-light">
                        Batal
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection
