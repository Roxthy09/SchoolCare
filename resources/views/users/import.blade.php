@extends('layouts.admin')

@section('content')
<div class="container">
    <h4>Import User dari Excel</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.import') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>File Excel</label>
            <input type="file" name="file" class="form-control" required>
        </div>

        <button class="btn btn-primary">Import</button>
    </form>
</div>
@endsection
