@extends('layouts.admin')
@section('title', 'Dashboard Admin')
@section('content')

<div class="container-fluid">

    <h4 class="fw-bold mb-1">Dashboard </h4>
    <small class="text-muted">Selamat datang, <b>{{ auth()->user()->name }}</b></small>

    {{-- STAT --}}
    <div class="row g-3 mt-3">
        @php
        $cards = [
            ['TotalPengaduan', $totalPengaduan, 'primary', 'chat-dots'],
            ['Selesai', $pengaduanSelesai, 'success', 'check-circle'],
            ['Diproses', $pengaduanProses, 'warning', 'arrow-repeat'],
            ['Total User', $totalUsers, 'info', 'people'],
        ];
        @endphp

        @foreach($cards as $c)
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">{{ $c[0] }}</small>
                        <h3 class="fw-bold count-up" data-count="{{ $c[1] }}">0</h3>
                    </div>
                    <span class="badge bg-{{ $c[2] }} bg-opacity-10 text-{{ $c[2] }} p-3">
                        <i class="bi bi-{{ $c[3] }} fs-4"></i>
                    </span>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- CHART --}}
    <div class="row g-3 mt-4">
        <div class="col-lg-5">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white fw-semibold">Status Pengaduan</div>
                <div class="card-body">
                    <canvas id="statusChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white fw-semibold">Pengaduan Berdasarkan Kategori</div>
                <div class="card-body">
                    <canvas id="kategoriChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
new Chart(statusChart,{
    type:'doughnut',
    data:{
        labels:['Selesai','Proses','Tertunda'],
        datasets:[{
            data:[{{ $pengaduanSelesai }},{{ $pengaduanProses }},{{ $pengaduanTertunda }}],
            backgroundColor:['#198754','#ffc107','#dc3545']
        }]
    }
});

new Chart(kategoriChart,{
    type:'bar',
    data:{
        labels:{!! json_encode(array_keys($chartKategori)) !!},
        datasets:[{
            data:{!! json_encode(array_values($chartKategori)) !!},
            backgroundColor:'#0d6efd'
        }]
    },
    options:{plugins:{legend:{display:false}}}
});
</script>

@include('dashboard.partials.countup')
@endsection
