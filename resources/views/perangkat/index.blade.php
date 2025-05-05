@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3>Daftar Perangkat</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>No Referensi</th>
                <th>Status</th>
                <th>Kondisi</th>
                <th>Terdaftar Pada</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($perangkats as $p)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td>{{ $p->no_referensi }}</td>
                    <td>{{ $p->status }}</td>
                    <td>{{ $p->kondisi }}</td>
                    <td>{{ $p->created_at->format('d-m-Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
