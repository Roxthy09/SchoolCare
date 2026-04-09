@extends('layouts.admin')
@section('title', 'Dashboard Orang Tua')
@section('content')

<div class="container-fluid py-4">

    {{-- CARD WRAPPER --}}
    <div class="card main-card shadow-sm border-0">
        <div class="card-body p-7">

            <h4 class="fw-bold">Dashboard Orang Tua</h4>
            <small class="text-muted">Halo, {{ auth()->user()->name }}</small>

            {{-- ================= CARD STAT ================= --}}
            <div class="row g-4 mt-3">
                @foreach([
                ['Total Pengaduan',$totalPengaduan,'primary','bi-chat-dots'],
                ['Pengaduan Baru',$pengaduanBaru,'danger','bi-bell'],
                ['Dalam Proses',$pengaduanProses,'warning','bi-arrow-repeat'],
                ['Selesai',$pengaduanSelesai,'success','bi-check-circle']
                ] as $c)

                <div class="col-md-3">
                    <div class="card dashboard-card shadow-sm border-0 h-100">
                        <div class="card-body d-flex justify-content-between align-items-center">

                            <div>
                                <p class="text-muted mb-1 small">{{ $c[0] }}</p>
                                <h2 class="fw-bold mb-0 count-up" data-count="{{ $c[1] }}">0</h2>
                            </div>

                            <div class="icon-box bg-{{ $c[2] }} bg-opacity-10 text-{{ $c[2] }}">
                                <i class="bi {{ $c[3] }}"></i>
                            </div>

                        </div>
                    </div>
                </div>

                @endforeach
            </div>

            {{-- ================= TABEL ================= --}}
            <div class="card mt-4 shadow-sm border-0">
                <div class="card-header bg-white fw-semibold">
                    Pengaduan Terbaru Saya
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Judul</th>
                                <th>Status</th>
                                <th>Progress</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($pengaduanTerbaru as $p)

                            @php
                            $progress = match($p->status) {
                            'tertunda' => 25,
                            'dalam_proses' => 60,
                            'selesai' => 100,
                            'dibatalkan' => 100,
                            default => 0
                            };

                            $progressColor = match($p->status) {
                            'tertunda' => 'secondary',
                            'dalam_proses' => 'warning',
                            'selesai' => 'success',
                            'dibatalkan' => 'danger',
                            default => 'secondary'
                            };

                            $statusMap = [
                            'tertunda' => ['color' => 'secondary', 'label' => 'Tertunda'],
                            'dalam_proses' => ['color' => 'warning', 'label' => 'Dalam Proses'],
                            'selesai' => ['color' => 'success', 'label' => 'Selesai'],
                            'dibatalkan' => ['color' => 'danger', 'label' => 'Dibatalkan'],
                            ];
                            @endphp

                            <tr>
                                <td class="fw-semibold">{{ $p->judul }}</td>

                                <td>
                                    <span class="badge bg-{{ $statusMap[$p->status]['color'] ?? 'secondary' }}">
                                        {{ $statusMap[$p->status]['label'] ?? ucfirst($p->status) }}
                                    </span>
                                </td>

                                <td style="width:200px">
                                    <div class="progress">
                                        <div class="progress-bar bg-{{ $progressColor }}" style="width: {{ $progress }}%">
                                        </div>
                                    </div>
                                </td>

                                <td>{{ \Carbon\Carbon::parse($p->tanggal_dibuat)->translatedFormat('d M Y') }}</td>
                            </tr>

                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-3">
                                    Belum ada pengaduan
                                </td>
                            </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>
            </div>

        </div>
    </div>

</div>

@endsection
<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.count-up').forEach(el => {
        let target = parseInt(el.dataset.count) || 0;
        let current = 0;

        if (target === 0) {
            el.innerText = 0;
            return;
        }

        let step = target / 40;

        let interval = setInterval(() => {
            current += step;

            if (current >= target) {
                el.innerText = target;
                clearInterval(interval);
            } else {
                el.innerText = Math.floor(current);
            }
        }, 20);
    });
});
</script>