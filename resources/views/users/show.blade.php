@extends('layouts.admin')

@section('content')
<div class="container">
    <h4>Detail User</h4>

    <table class="table">
        <tr>
            <th>Nama</th>
            <td>{{ $user->name }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <th>Peran</th>
            <td>{{ ucfirst($user->peran) }}</td>
        </tr>
    </table>

    <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
