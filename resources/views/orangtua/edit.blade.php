@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">Edit Data Orang Tua</h4>
            <small class="text-muted">Perbarui data orang tua siswa</small>
        </div>
        <a href="{{ route('orangtua.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    {{-- CARD FORM --}}
    <div class="card shadow-sm border-0">
        <div class="card-body">

            <form action="{{ route('orangtua.update', $orangtua->orangtua_id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">

                    {{-- USER ID --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">User ID</label>
                        <input type="number"
                               name="user_id"
                               class="form-control @error('user_id') is-invalid @enderror"
                               value="{{ old('user_id', $orangtua->user_id) }}"
                               placeholder="Masukkan User ID">
                        @error('user_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- NO KONTAK --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">No Kontak</label>
                        <input type="text"
                               name="no_kontak"
                               class="form-control @error('no_kontak') is-invalid @enderror"
                               value="{{ old('no_kontak', $orangtua->no_kontak) }}"
                               placeholder="08xxxxxxxxxx">
                        @error('no_kontak')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- NAMA ORANG TUA --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Nama Orang Tua</label>
                        <input type="text"
                               name="nama_orangtua"
                               class="form-control @error('nama_orangtua') is-invalid @enderror"
                               value="{{ old('nama_orangtua', $orangtua->nama_orangtua) }}"
                               placeholder="Nama lengkap orang tua">
                        @error('nama_orangtua')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- NAMA SISWA --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Nama Siswa</label>
                        <input type="text"
                               name="nama_siswa"
                               class="form-control @error('nama_siswa') is-invalid @enderror"
                               value="{{ old('nama_siswa', $orangtua->nama_siswa) }}"
                               placeholder="Nama siswa">
                        @error('nama_siswa')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- KELAS SISWA --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Kelas Siswa</label>
                        <input type="text"
                               name="kelas_siswa"
                               class="form-control @error('kelas_siswa') is-invalid @enderror"
                               value="{{ old('kelas_siswa', $orangtua->kelas_siswa) }}"
                               placeholder="Contoh: X IPA 1">
                        @error('kelas_siswa')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                {{-- BUTTON --}}
                <div class="d-flex justify-content-end gap-2 mt-4">
                    <button class="btn btn-primary px-4">
                        <i class="bi bi-save"></i> Update Data
                    </button>
                    <a href="{{ route('orangtua.index') }}" class="btn btn-light px-4">
                        Batal
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection
