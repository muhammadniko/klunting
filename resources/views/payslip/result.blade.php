@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Hasil Pengiriman Payslip</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>NIK</th>
                <th>Nama</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
            <tr>
                <td>{{ $log['nik'] }}</td>
                <td>{{ $log['nama'] }}</td>
                <td>{!! $log['status'] !!}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection