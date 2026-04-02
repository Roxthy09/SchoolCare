@extends('layouts.admin')
@section('content')

<div class="container-fluid">
<h4 class="fw-bold">Dashboard Petugas</h4>

<div class="row g-3 mt-3">
@foreach([
['Total',$totalPengaduan,'primary','chat'],
['Baru',$pengaduanBaru,'danger','bell'],
['Proses',$pengaduanProses,'warning','arrow-repeat'],
['Selesai',$pengaduanSelesai,'success','check']
] as $c)
<div class="col-md-3">
<div class="card border-0 shadow-sm">
<div class="card-body d-flex justify-content-between">
<div>
<small class="text-muted">{{ $c[0] }}</small>
<h3 class="fw-bold count-up" data-count="{{ $c[1] }}">0</h3>
</div>
<i class="bi bi-{{ $c[3] }} fs-3 text-{{ $c[2] }}"></i>
</div>
</div>
</div>
@endforeach
</div>
</div>

@include('dashboard.partials.countup')
@endsection
