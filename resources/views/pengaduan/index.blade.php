@extends('layouts.admin')
@section('title', 'Data Pengaduan')
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
                <h4 class="mb-0">Data Pengaduan</h4>

                @if(auth()->user()->peran == 'orangtua')
                <a href="{{ route(auth()->user()->peran.'.pengaduan.create') }}"
                    class="btn btn-primary">
                    + Buat Pengaduan
                </a>
                @endif
            </div>

            <table class="table table-striped align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="5%" class="text-center">No</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Tanggal</th>
                        <th class="text-center">Lampiran</th>
                        <th class="text-center">Rating</th>
                        <th width="15%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengaduans as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $item->judul }}</td>
                        <td>{{ $item->kategori->nama_kategori ?? '-' }}</td>

                        <td class="text-center">
                            @php
                            $statusMap = [
                            'tertunda' => ['label' => 'Tertunda', 'color' => 'secondary'],
                            'dalam_proses' => ['label' => 'Dalam Proses', 'color' => 'warning'],
                            'selesai' => ['label' => 'Selesai', 'color' => 'success'],
                            'dibatalkan' => ['label' => 'Dibatalkan', 'color' => 'dark'],
                            ];
                            @endphp

                            <span class="badge bg-{{ $statusMap[$item->status]['color'] ?? 'secondary' }}">
                                {{ $statusMap[$item->status]['label'] ?? ucfirst($item->status) }}
                            </span>
                        </td>

                        <td class="text-center">
                            {{ \Carbon\Carbon::parse($item->tanggal_dibuat)->format('d M Y') }}
                        </td>

                        <td class="text-center">
                            @if($item->lampiran)
                            <img src="{{ asset('storage/'.$item->lampiran) }}"
                                alt="Lampiran"
                                class="rounded"
                                style="width:60px;height:60px;object-fit:cover;cursor:pointer"
                                data-bs-toggle="modal"
                                data-bs-target="#lampiranModal{{ $item->pengaduan_id }}">

                            <!-- Modal -->
                            <div class="modal fade"
                                id="lampiranModal{{ $item->pengaduan_id }}"
                                tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">
                                                Lampiran Pengaduan
                                            </h5>
                                            <button type="button"
                                                class="btn-close"
                                                data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <img src="{{ asset('storage/'.$item->lampiran) }}"
                                                class="img-fluid rounded"
                                                style="height:400px; width:400px;object-fit:contain">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @else
                            <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($item->rating)
                            <div>
                                <p class="mb-1">{{ str_repeat('⭐', $item->rating->rating) }}</p>
                                <small class="text-muted">{{ $item->rating->komentar }}</small>
                            </div>
                            @else
                            <span class="text-muted">-</span>
                            @endif
                        </td>

                        <td class="text-center text-nowrap">
                            <a href="{{ route(auth()->user()->peran.'.pengaduan.show', $item->pengaduan_id) }}"
                                class="btn btn-sm btn-info"
                                title="Detail">
                                <i class="bi bi-eye"></i>
                            </a>

                            @if(in_array(auth()->user()->peran, ['admin','petugas']))
                            <form action="{{ route('pengaduan.destroy', $item->pengaduan_id) }}"
                                method="POST"
                                class="d-inline"
                                onsubmit="return confirm('Hapus pengaduan?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger"
                                    title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                            @elseif(auth()->user()->peran == 'orangtua' && $item->status == 'tertunda')
                            <form action="{{ route(auth()->user()->peran . '.pengaduan.destroy', $item->pengaduan_id) }}"
                                method="POST"
                                class="d-inline"
                                onsubmit="return confirm('Batalkan pengaduan ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-warning" title="Batal Lapor">
                                    <i class="bi bi-x-circle"></i>
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">
                            Data kosong
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>

    <div class="mt-3">
        {{ $pengaduans->links() }}
    </div>

</div>
@endsection