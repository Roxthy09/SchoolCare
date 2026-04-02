@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-0">Tambah Kategori</h4>
            <small class="text-muted">Master Data / Kategori</small>
        </div>
        <a href="{{ route('kategori.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="ti ti-arrow-left"></i> Kembali
        </a>
    </div>

    {{-- Card --}}
    <div class="card shadow-sm border-0">
        <div class="card-body">

            <form action="{{ route('kategori.store') }}" method="POST" id="formKategori">
                @csrf

                {{-- Input --}}
                <div class="mb-4">
                    <label class="form-label fw-semibold">
                        Nama Kategori <span class="text-danger">*</span>
                    </label>

                    <input type="text"
                           name="nama_kategori"
                           class="form-control form-control-lg @error('nama_kategori') is-invalid @enderror"
                           placeholder="Contoh: Administrasi"
                           value="{{ old('nama_kategori') }}"
                           autofocus>

                    @error('nama_kategori')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Action --}}
                <div class="d-flex justify-content-end gap-2">
                    <button type="reset" class="btn btn-light">
                        Reset
                    </button>

                    <button type="submit" class="btn btn-primary" id="btnSimpan">
                        <span class="btn-text">
                            <i class="ti ti-device-floppy"></i> Simpan
                        </span>
                        <span class="spinner-border spinner-border-sm d-none" role="status"></span>
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

{{-- Script Loading Button --}}
<script>
    document.getElementById('formKategori').addEventListener('submit', function () {
        const btn = document.getElementById('btnSimpan');
        btn.disabled = true;
        btn.querySelector('.btn-text').classList.add('d-none');
        btn.querySelector('.spinner-border').classList.remove('d-none');
    });
</script>
@endsection
