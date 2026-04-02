@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    {{-- HEADER --}}
    <div class="mb-4">
        <h4 class="fw-bold mb-1">Tambah User</h4>
        <small class="text-muted">Buat akun pengguna baru</small>
    </div>

    {{-- CARD FORM --}}
    <div class="card shadow-sm border-0">
        <div class="card-body">

            <form action="{{ route('users.store') }}" method="POST">
                @csrf

                <div class="row">

                    {{-- NAMA --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">
                            Nama Lengkap
                        </label>
                        <input type="text"
                               name="name"
                               value="{{ old('name') }}"
                               class="form-control @error('name') is-invalid @enderror"
                               placeholder="Masukkan nama lengkap">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- EMAIL --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">
                            Email
                        </label>
                        <input type="email"
                               name="email"
                               value="{{ old('email') }}"
                               class="form-control @error('email') is-invalid @enderror"
                               placeholder="contoh@email.com">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- PASSWORD --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">
                            Password
                        </label>
                        <input type="password"
                               name="password"
                               class="form-control @error('password') is-invalid @enderror"
                               placeholder="Minimal 8 karakter">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- PERAN --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">
                            Peran User
                        </label>
                        <select name="peran"
                                class="form-select @error('peran') is-invalid @enderror">
                            <option value="">-- Pilih Peran --</option>
                            <option value="admin" {{ old('peran') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="petugas" {{ old('peran') == 'petugas' ? 'selected' : '' }}>Petugas</option>
                            <option value="orangtua" {{ old('peran') == 'orangtua' ? 'selected' : '' }}>Orangtua</option>
                        </select>
                        @error('peran')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                {{-- BUTTON --}}
                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <button class="btn btn-primary">
                        <i class="bi bi-save"></i> Simpan User
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection
