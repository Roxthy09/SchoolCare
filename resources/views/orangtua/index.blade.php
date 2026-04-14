@extends('layouts.admin')
section('title', 'Data Orangtua')
@section('content')
<div class="container">

    {{-- FLASH MESSAGE --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- CARD --}}
    <div class="card shadow-sm">
        <div class="card-body">

            {{-- HEADER --}}
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0 fw-semibold">
                    <i class="ti ti-users"></i> Data Orangtua
                </h4>

                <a href="{{ route('orangtua.create') }}" class="btn btn-primary btn-sm">
                    <i class="ti ti-plus"></i> Tambah Orangtua
                </a>
            </div>

            {{-- TABLE --}}
            <div class="table-responsive">
                <table class="table table-striped align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="5%" class="text-center">No</th>
                            <th>Nama Orangtua</th>
                            <th>Nama Siswa</th>
                            <th class="text-center">Kelas</th>
                            <th>No Kontak</th>
                            <th width="20%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orangtuas as $item)
                        <tr>
                            <td class="text-center">
                                {{ $loop->iteration + ($orangtuas->currentPage() - 1) * $orangtuas->perPage() }}
                            </td>
                            <td>{{ $item->nama_orangtua }}</td>
                            <td>{{ $item->nama_siswa }}</td>
                            <td class="text-center">{{ $item->kelas_siswa }}</td>
                            <td>{{ $item->no_kontak }}</td>
                            <td class="text-center">

                                <a href="{{ route('orangtua.show', $item) }}"
                                   class="btn btn-info btn-sm"
                                   title="Detail">
                                    <i class="ti ti-eye"></i>
                                </a>

                                <a href="{{ route('orangtua.edit', $item) }}"
                                   class="btn btn-warning btn-sm"
                                   title="Edit">
                                    <i class="ti ti-pencil"></i>
                                </a>

                                <form action="{{ route('orangtua.destroy', $item) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Yakin hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-danger btn-sm"
                                            title="Hapus">
                                        <i class="ti ti-trash"></i>
                                    </button>
                                </form>

                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                Data orangtua belum tersedia
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    {{-- PAGINATION --}}
    <div class="mt-3">
        {{ $orangtuas->links() }}
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
