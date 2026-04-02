@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">Profil Akun</h4>
            <small class="text-muted">
                Informasi akun yang dikelola oleh pihak sekolah
            </small>
        </div>
    </div>

    <div class="row g-3">

        {{-- PROFIL UTAMA --}}
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 text-center h-100">
                <div class="card-body">

                    <img src="{{ asset('admin/assets/images/faces/face1.jpg') }}"
                         class="rounded-circle mb-3 border"
                         width="110" height="110"
                         alt="Foto Profil">

                    <h5 class="fw-bold mb-0">
                        {{ $user->name }}
                    </h5>

                    <small class="text-muted text-uppercase d-block mb-2">
                        {{ $user->peran }}
                    </small>

                    <span class="badge bg-success px-3 py-1">
                        Akun Aktif
                    </span>

                    <hr>

                    <div class="text-muted small">
                        Terdaftar sejak<br>
                        <strong>
                            {{ $user->created_at
                                ? $user->created_at->format('d M Y')
                                : '-' }}
                        </strong>
                    </div>

                </div>
            </div>
        </div>

        {{-- IDENTITAS + STATISTIK --}}
        <div class="col-lg-8">

            {{-- IDENTITAS --}}
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-body">

                    <h6 class="fw-semibold mb-3">
                        <i class="mdi mdi-account-circle-outline me-2 text-primary"></i>
                        Identitas Akun
                    </h6>

                    <div class="row mb-2">
                        <div class="col-md-4 text-muted">Nama Lengkap</div>
                        <div class="col-md-8 fw-semibold">
                            {{ $user->name }}
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-4 text-muted">Email</div>
                        <div class="col-md-8">
                            {{ $user->email }}
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-4 text-muted">Peran</div>
                        <div class="col-md-8">
                            <span class="badge bg-info text-uppercase">
                                {{ $user->peran }}
                            </span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 text-muted">Status</div>
                        <div class="col-md-8">
                            <span class="badge bg-success">
                                Aktif
                            </span>
                        </div>
                    </div>

                </div>
            </div>

            {{-- STATISTIK --}}
            <div class="card shadow-sm border-0">
                <div class="card-body">

                    <h6 class="fw-semibold mb-3">
                        <i class="mdi mdi-chart-bar me-2 text-success"></i>
                        Aktivitas Pengaduan
                    </h6>

                    <div class="row text-center">

                        <div class="col-md-3 col-6 mb-3 mb-md-0">
                            <h4 class="fw-bold">
                                {{ $totalPengaduan }}
                            </h4>
                            <small class="text-muted">
                                Total
                            </small>
                        </div>

                        <div class="col-md-3 col-6 mb-3 mb-md-0">
                            <h4 class="fw-bold text-secondary">
                                {{ $pengaduanMasuk ?? 0 }}
                            </h4>
                            <small class="text-muted">
                                Masuk
                            </small>
                        </div>

                        <div class="col-md-3 col-6">
                            <h4 class="fw-bold text-warning">
                                {{ $pengaduanProses }}
                            </h4>
                            <small class="text-muted">
                                Diproses
                            </small>
                        </div>

                        <div class="col-md-3 col-6">
                            <h4 class="fw-bold text-success">
                                {{ $pengaduanSelesai }}
                            </h4>
                            <small class="text-muted">
                                Selesai
                            </small>
                        </div>

                    </div>

                </div>
            </div>

        </div>

    </div>

</div>
@endsection
