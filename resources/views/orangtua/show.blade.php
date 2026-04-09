@extends('layouts.admin')
@section('title', 'Detail Data Orangtua')
@section('content')
<div class="container">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0 fw-semibold">
            <i class="ti ti-user-circle"></i> Detail Data Orangtua
        </h4>

        <div>
            <a href="{{ route('orangtua.edit', $orangtua) }}"
               class="btn btn-warning btn-sm">
                <i class="ti ti-pencil"></i> Edit
            </a>
            <a href="{{ route('orangtua.index') }}"
               class="btn btn-outline-secondary btn-sm">
                <i class="ti ti-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    {{-- CARD --}}
    <div class="card shadow-sm">
        <div class="card-body">

            <div class="row">
                {{-- LEFT INFO --}}
                <div class="col-md-6">
                    <table class="table table-borderless mb-0">
                        <tr>
                            <th width="40%" class="text-muted">Nama Orangtua</th>
                            <td class="fw-semibold">{{ $orangtua->nama_orangtua }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted">No Kontak</th>
                            <td>
                                <span class="badge bg-info">
                                    <i class="ti ti-phone"></i>
                                    {{ $orangtua->no_kontak }}
                                </span>
                            </td>
                        </tr>

                        @if($orangtua->user ?? false)
                        <tr>
                            <th class="text-muted">Akun Login</th>
                            <td>
                                <span class="badge bg-success">
                                    <i class="ti ti-mail"></i>
                                    {{ $orangtua->user->email }}
                                </span>
                            </td>
                        </tr>
                        @endif
                    </table>
                </div>

                {{-- RIGHT INFO --}}
                <div class="col-md-6">
                    <table class="table table-borderless mb-0">
                        <tr>
                            <th width="40%" class="text-muted">Nama Siswa</th>
                            <td class="fw-semibold">{{ $orangtua->nama_siswa }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted">Kelas Siswa</th>
                            <td>
                                <span class="badge bg-primary">
                                    {{ $orangtua->kelas_siswa }}
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection
