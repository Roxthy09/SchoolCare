@extends('layouts.admin')
@section('title', 'Profil Admin')
@section('content')
<div class="container-fluid">

    {{-- HEADER --}}
    <div class="mb-4">
        <h4 class="fw-bold mb-1">Profil Akun</h4>
        <small class="text-muted">
            Informasi akun yang dikelola oleh pihak sekolah
        </small>
    </div>

    <div class="row g-3">

        {{-- PROFIL UTAMA --}}
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 text-center h-100">
                <div class="card-body">

                    <img src="{{ asset('admin/assets/images/faces/face1.jpg') }}"
                         class="rounded-circle mb-3"
                         width="100" height="100">

                    <h5 class="fw-bold mb-0">{{ auth()->user()->name }}</h5>
                    <small class="text-muted text-uppercase">
                        {{ auth()->user()->peran }}
                    </small>

                    <hr>

                    <span class="badge bg-success">
                        Akun Aktif
                    </span>

                </div>
            </div>
        </div>

        {{-- IDENTITAS --}}
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-body">

                    <h6 class="fw-semibold mb-3">
                        <i class="mdi mdi-account-box me-2 text-primary"></i>
                        Identitas Akun
                    </h6>

                    <div class="row mb-2">
                        <div class="col-md-4 text-muted">Nama</div>
                        <div class="col-md-8">{{ auth()->user()->name }}</div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-4 text-muted">Email</div>
                        <div class="col-md-8">{{ auth()->user()->email }}</div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-4 text-muted">Sebagai</div>
                        <div class="col-md-8">
                            <span class="badge bg-info">
                                {{ ucfirst(auth()->user()->peran) }}
                            </span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 text-muted">Terdaftar</div>
                        <div class="col-md-8">
                            {{ auth()->user()->created_at
                                ? auth()->user()->created_at->format('d M Y')
                                : '-' }}
                        </div>
                    </div>

                </div>
            </div>

            {{-- STATISTIK --}}
            <div class="card shadow-sm border-0">
                <div class="card-body">

                    <h6 class="fw-semibold mb-3">
                        <i class="mdi mdi-chart-box me-2 text-success"></i>
                        Aktivitas Akun
                    </h6>

                    <div class="row text-center">
                        <div class="col-md-4">
                            <h4 class="fw-bold">{{ $totalPengaduan }}</h4>
                            <small class="text-muted">Total Pengaduan</small>
                        </div>
                        <div class="col-md-4">
                            <h4 class="fw-bold text-warning">{{ $pengaduanProses }}</h4>
                            <small class="text-muted">Diproses</small>
                        </div>
                        <div class="col-md-4">
                            <h4 class="fw-bold text-success">{{ $pengaduanSelesai }}</h4>
                            <small class="text-muted">Selesai</small>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>

</div>
@push('styles')
<style>
  /* Pagination wrapper */
  .pagination {
    gap: 4px;
    flex-wrap: wrap;
  }

  /* Setiap item */
  .pagination .page-item .page-link {
    border-radius: 8px !important;
    border: 0.5px solid #e0e0e0;
    color: #444;
    font-size: 13px;
    font-weight: 500;
    min-width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0 10px;
    transition: all 0.15s ease;
    background: #fff;
    box-shadow: none;
  }

  /* Hover */
  .pagination .page-item .page-link:hover {
    background: #f0f4ff;
    border-color: #4f6ef7;
    color: #4f6ef7;
  }

  /* Halaman aktif */
  .pagination .page-item.active .page-link {
    background: #4f6ef7;
    border-color: #4f6ef7;
    color: #fff;
    box-shadow: 0 2px 8px rgba(79, 110, 247, 0.3);
  }

  /* Disabled (prev/next nonaktif) */
  .pagination .page-item.disabled .page-link {
    background: #f8f8f8;
    border-color: #eee;
    color: #bbb;
  }
</style>
@endpush
@endsection
