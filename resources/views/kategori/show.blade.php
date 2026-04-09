@extends('layouts.admin')
@section('title', 'Detail Kategori')
@section('content')
<div class="container">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1">Detail Kategori</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 small">
                    <li class="breadcrumb-item">
                        <a href="{{ route('kategori.index') }}">Kategori</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Detail
                    </li>
                </ol>
            </nav>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('kategori.edit', $kategori) }}"
               class="btn btn-warning btn-sm">
                <i class="bi bi-pencil-square"></i> Edit
            </a>

            <a href="{{ route('kategori.index') }}"
               class="btn btn-secondary btn-sm">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <!-- Main Card -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <div class="row align-items-center">

                <!-- Icon -->
                <div class="col-md-2 text-center">
                    <div class="rounded-circle bg-primary bg-opacity-10
                                d-flex align-items-center justify-content-center
                                mx-auto"
                         style="width:80px;height:80px;">
                        <i class="bi bi-tags fs-2 text-primary"></i>
                    </div>
                </div>

                <!-- Info -->
                <div class="col-md-10">
                    <h5 class="mb-1">{{ $kategori->nama_kategori }}</h5>
                    <p class="text-muted mb-2">
                        Kategori pengaduan yang digunakan dalam sistem
                    </p>

                    <div class="d-flex flex-wrap gap-3 small">
                        <div>
                            <span class="text-muted">Status</span><br>
                            <span class="badge bg-success">Aktif</span>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- Statistics -->
    <div class="row g-3">
    <h4 class="mb-1">Pengaduan Berdasarkan Kategori {{$kategori->nama_kategori}}</h4>
        <!-- Total Pengaduan -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="icon rounded bg-info bg-opacity-10 p-3">
                        <i class="bi bi-chat-dots text-info fs-4"></i>
                    </div>
                    <div>
                        <h6 class="mb-0">Total Pengaduan Tentang</h6>
                        <h4 class="mb-0">
                            {{ $kategori->pengaduans_count }}
                        </h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pengaduan Selesai -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="icon rounded bg-success bg-opacity-10 p-3">
                        <i class="bi bi-check-circle text-success fs-4"></i>
                    </div>
                    <div>
                        <h6 class="mb-0">Pengaduan Selesai</h6>
                        <h4 class="mb-0">
                            {{ $kategori->pengaduan_selesai ?? 0 }}
                        </h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pengaduan Proses -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="icon rounded bg-warning bg-opacity-10 p-3">
                        <i class="bi bi-hourglass-split text-warning fs-4"></i>
                    </div>
                    <div>
                        <h6 class="mb-0">Dalam Proses</h6>
                        <h4 class="mb-0">
                            {{ $kategori->pengaduan_proses ?? 0 }}
                        </h4>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
