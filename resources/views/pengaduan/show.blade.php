@extends('layouts.admin')

@section('content')

@php
$isOrangtua = auth()->user()->peran === 'orangtua';
@endphp

<div class="container-fluid py-3">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4 p-3 bg-white rounded shadow-sm">
        <div>
            <h4 class="fw-bold mb-0">Detail Pengaduan</h4>
            <small class="text-muted">Pengaduan / Detail</small>
        </div>

        <a href="{{ route(auth()->user()->peran . '.pengaduan.index') }}"
            class="btn btn-outline-secondary btn-sm">
            <i class="ti ti-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="row">

        {{-- KONTEN UTAMA --}}
        <div class="{{ $isOrangtua ? 'col-12' : 'col-lg-8' }}">

            {{-- CARD DETAIL --}}
            <div class="card detail-card border-0 mb-4">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h5 class="fw-semibold mb-0">{{ $pengaduan->judul }}</h5>

                        @php
                        $statusColor = match($pengaduan->status) {
                        'tertunda' => 'warning',
                        'dalam_proses' => 'info',
                        'selesai' => 'success',
                        default => 'secondary'
                        };
                        @endphp

                        <span class="badge bg-{{ $statusColor }}">
                            {{ ucwords(str_replace('_',' ', $pengaduan->status)) }}
                        </span>
                    </div>

                    <hr>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <small class="text-muted">Kategori</small>
                            <div class="fw-semibold">
                                {{ $pengaduan->kategori->nama_kategori ?? '-' }}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <small class="text-muted">Tanggal Pengaduan</small>
                            <div class="fw-semibold">
                                {{ \Carbon\Carbon::parse($pengaduan->tanggal_dibuat)->format('d M Y H:i') }}
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted">Deskripsi</small>
                        <div class="description-box">
                            {{ $pengaduan->deskripsi }}
                        </div>
                    </div>

                    <div>
                        <small class="text-muted">Lampiran</small><br>

                        @if($pengaduan->lampiran)
                        <button class="btn btn-primary btn-sm mt-2 shadow-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#lampiranModal">
                            <i class="ti ti-eye"></i> Lihat Lampiran
                        </button>
                        @else
                        <span class="text-muted">Tidak ada lampiran</span>
                        @endif
                    </div>

                </div>
            </div>

            {{-- TANGGAPAN --}}
            <div class="card ui-card border-0 mb-4">
                <div class="card-header bg-white fw-semibold">
                    <i class="ti ti-message-dots"></i> Tanggapan
                </div>
                <div class="card-body">
                    @include('tanggapan._list')

                    @if(auth()->user()->role !== 'siswa')
                    <hr>
                    @include('tanggapan._form')
                    @endif
                </div>
                @if($pengaduan->status == 'selesai' && $pengaduan->konfirmasi_orangtua == 'menunggu')

                <div class="card mt-4">
                    <div class="card-body">
                        <h5>Konfirmasi Pengaduan</h5>
                        <p>Apakah hasil pengaduan sudah sesuai?</p>

                        <form action="{{ route('pengaduan.konfirmasi', $pengaduan->pengaduan_id) }}" method="POST">
                            @csrf

                            <button name="konfirmasi" value="sesuai" class="btn btn-success">
                                ✔️ Sesuai
                            </button>

                            <button name="konfirmasi" value="tidak_sesuai" class="btn btn-danger">
                                ❌ Tidak Sesuai
                            </button>
                        </form>
                    </div>
                </div>

                @endif
                @if($pengaduan->konfirmasi_orangtua == 'sesuai')

                <div class="card mt-4">
                    <div class="card-body">
                        <h5>Beri Penilaian</h5>

                        <form action="{{ route('rating.store', $pengaduan->pengaduan_id) }}" method="POST">
                            @csrf

                            <div class="mb-2">
                                <label>Rating</label>
                                <select name="rating" class="form-control">
                                    <option value="">Pilih</option>
                                    <option value="5">⭐⭐⭐⭐⭐</option>
                                    <option value="4">⭐⭐⭐⭐</option>
                                    <option value="3">⭐⭐⭐</option>
                                    <option value="2">⭐⭐</option>
                                    <option value="1">⭐</option>
                                </select>
                            </div>

                            <div class="mb-2">
                                <label>Komentar</label>
                                <textarea name="komentar" class="form-control"></textarea>
                            </div>

                            <button class="btn btn-primary">Kirim Rating</button>
                        </form>
                    </div>
                </div>

                @endif
            </div>

            {{-- RIWAYAT STATUS --}}
            <div class="card ui-card border-0">
                <div class="card-header bg-white fw-semibold">
                    <i class="ti ti-history"></i> Riwayat Status
                </div>
                <div class="card-body">
                    @include('riwayat_statuses._list')
                </div>
            </div>

        </div>

        {{-- SIDEBAR (HANYA ADMIN & PETUGAS) --}}
        @if(!$isOrangtua)
        <div class="col-lg-4">

            {{-- UPDATE STATUS --}}
            @if(in_array(auth()->user()->peran, ['admin','petugas']))
            <div class="card ui-card border-0 mb-4">
                <div class="card-header bg-white fw-semibold">
                    <i class="ti ti-settings"></i> Update Status
                </div>
                <div class="card-body">
                    <form action="{{ route(auth()->user()->peran.'.pengaduan.status', $pengaduan->pengaduan_id) }}"
                        method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Status Pengaduan</label>
                            <select name="status" class="form-select">
                                <option value="tertunda" {{ $pengaduan->status == 'tertunda' ? 'selected' : '' }}>
                                    Tertunda
                                </option>
                                <option value="dalam_proses" {{ $pengaduan->status == 'dalam_proses' ? 'selected' : '' }}>
                                    Dalam Proses
                                </option>
                                <option value="selesai" {{ $pengaduan->status == 'selesai' ? 'selected' : '' }}>
                                    Selesai
                                </option>
                            </select>
                        </div>

                        <button class="btn btn-primary w-100">
                            <i class="ti ti-refresh"></i> Update Status
                        </button>
                    </form>
                </div>
            </div>
            @endif

        </div>
        @endif

    </div>
</div>

{{-- MODAL LAMPIRAN --}}
@if($pengaduan->lampiran)
<div class="modal fade" id="lampiranModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title fw-semibold">
                    <i class="ti ti-paperclip"></i> Lampiran Pengaduan
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body text-center">

                @php
                $ext = pathinfo($pengaduan->lampiran, PATHINFO_EXTENSION);
                @endphp

                @if(in_array(strtolower($ext), ['jpg','jpeg','png','webp']))
                <img src="{{ asset('storage/'.$pengaduan->lampiran) }}"
                    class="img-fluid rounded shadow"
                    alt="Lampiran">
                @else
                <p class="mb-3">Lampiran bukan berupa gambar</p>
                <a href="{{ asset('storage/'.$pengaduan->lampiran) }}"
                    target="_blank"
                    class="btn btn-primary">
                    <i class="ti ti-download"></i> Download Lampiran
                </a>
                @endif

            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">
                    Tutup
                </button>
            </div>

        </div>
    </div>
</div>
@endif

@endsection