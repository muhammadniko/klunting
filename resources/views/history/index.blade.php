@extends('layouts.app')

@section('title', 'History Pengiriman')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <h1 class="m-0">Riwayat Pengiriman</h1>
    </div>
</div>
<div class="container-fluid">
	<div class="card">
            
            <div class="card-body table-responsive p-0">
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>WhatsApp</th>
                <th>File</th>
				<th>Status</th>
                <th>Waktu</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($histories as $index => $h)
                <tr>
                    <td>{{ $histories->firstItem() + $index }}</td>
                    <td>{{ $h->nik }}</td>
                    <td>{{ $h->nama }}</td>
                    <td>{{ $h->whatsapp }}</td>
                    <td>{{ basename($h->file_path) }}</td>
					<td>{{ $h->status }}</td>
                    <td>{{ $h->created_at->format('d-m-Y H:i') }}</td>
                </tr>
            @empty
                <tr><td colspan="8" class="text-center">Belum ada riwayat</td></tr>
            @endforelse
        </tbody>
    </table>
	</div>
	</div>

    {{ $histories->links() }}
</div>
@endsection