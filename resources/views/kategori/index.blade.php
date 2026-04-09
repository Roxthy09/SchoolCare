@extends('layouts.admin')
@section('title', 'Data Kategori')
@section('content')
<div class="container">

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0">Data Kategori</h4>

                <a href="{{ route('kategori.create') }}" class="btn btn-primary">
                    + Tambah Kategori
                </a>
            </div>
            <table class="table table-striped align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="5%" class="text-center">No</th>
                        <th>Nama Kategori</th>
                        <th width="25%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kategoris as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $item->nama_kategori }}</td>
                        <td class="text-center text-nowrap">
                            <a href="{{ route('kategori.show', $item) }}"
                                class="btn btn-sm btn-info"
                                title="Detail">
                                <i class="bi bi-eye"></i>
                            </a>

                            <a href="{{ route('kategori.edit', $item) }}"
                                class="btn btn-sm btn-warning"
                                title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </a>

                            <form action="{{ route('kategori.destroy', $item) }}"
                                method="POST"
                                class="d-inline"
                                onsubmit="return confirm('Yakin hapus kategori?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger"
                                    title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted">
                            Data kosong
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>

    <div class="mt-3">
        {{ $kategoris->links() }}
    </div>

</div>
@endsection