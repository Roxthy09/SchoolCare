@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">Data User</h4>
            <small class="text-muted">Kelola akun pengguna sistem</small>
        </div>

        <div class="d-flex gap-2">
            {{-- IMPORT --}}
            <form action="{{ route('users.import') }}"
                method="POST"
                enctype="multipart/form-data"
                id="importForm">
                @csrf

                <input type="file"
                    name="file"
                    id="fileInput"
                    accept=".xls,.xlsx,.csv"
                    hidden
                    onchange="
                const btn = document.getElementById('importBtn');
                btn.innerHTML = '<span class=\'spinner-border spinner-border-sm me-2\'></span>Mengimpor...';
                btn.disabled = true;
                this.form.submit();
           ">

                <button type="button"
                    id="importBtn"
                    class="btn btn-success"
                    onclick="document.getElementById('fileInput').click()">
                    <i class="bi bi-upload"></i> Import User
                </button>
            </form>

            {{-- TAMBAH --}}
            <a href="{{ route('users.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Tambah User
            </a>
        </div>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        <i class="bi bi-check-circle"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    {{-- CARD TABLE --}}
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Peran</th>
                            <th width="25%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="fw-semibold">{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="badge bg-info text-white">
                                    {{ ucfirst($user->peran) }}
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('users.show', $user) }}"
                                    class="btn btn-info btn-sm">
                                    <i class="bi bi-eye"></i>
                                </a>

                                <a href="{{ route('users.edit', $user) }}"
                                    class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <form action="{{ route('users.destroy', $user) }}"
                                    method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Hapus user ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                <i class="bi bi-inbox fs-4 d-block mb-2"></i>
                                Data user belum tersedia
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>

        {{-- PAGINATION --}}
        <div class="card-footer bg-white">
            {{ $users->links() }}
        </div>
    </div>

</div>
@endsection