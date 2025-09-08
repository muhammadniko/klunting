@extends('layouts.app')

@section('title', 'Kirim File')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <h1 class="m-0">Kirim File</h1>
    </div>
</div>
<div class="container-fluid">
    <h1 class="mb-4"></h1>

    {{-- Alert success --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Form Upload --}}
    <div class="card card-primary">
        
		<div class="card-body">
		  <div class="mb-3">
        
    </div>
        <form action="{{ route('payslip.send') }}" method="POST" class="mb-4">
    @csrf
    <div class="form-group">
		
        <label for="folder_path">Folder File</label>
        <input type="text" name="folder_path" id="folder_path" class="form-control" value="{{$folder_path}}" required readonly>
    </div><div class="row"><br/></div>
	<h5>File Ditemukan:</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama File</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>No WhatsApp</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
		
@if(isset($data) && count($data) > 0)
            @foreach($data as $item)
                <tr>
                    <td>{{ $item['filename'] }}</td>
                    <td>{{ $item['nik'] }}</td>
                    <td>{{ $item['nama'] ?? '-' }}</td>
                    <td>{{ $item['whatsapp'] ?? '-' }}</td>
                    <td>
                        @if($item['status'] === 'Cocok')
                            <span class="badge bg-success">File Siap Kirim</span>
                        @else
                            <span class="badge bg-danger">{{ $item['status'] }}</span>
                        @endif
                    </td>
                </tr>
            @endforeach
@endif
</tbody>
    </table>
	<div class="form-group">
        <label for="caption">Caption</label>
        <textarea name="caption" id="caption" class="form-control" required>Selamat Pagi, Berikut File Payslip anda bulan ini</textarea>
    </div>
    <div class="mt-2">
         <button type="submit" class="btn btn-primary mt-2"><i class="fas fa-paper-plane"> </i> Kirim Semua</button>
    </div>
</form>
    </div>
</div>

@endsection

@push('styles')
    <!-- Bootstrap 4 (dibutuhkan Summernote) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Summernote CSS -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs4.min.css" rel="stylesheet">
@endpush

@push('scripts')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Popper + Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Summernote JS -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs4.min.js"></script>

    <script>
    $(function() {
        $('#caption').summernote({
            placeholder: 'Tulis pesan tambahan di sini...',
            tabsize: 2,
            height: 150,
            toolbar: [
                ['style', ['bold', 'italic']],
				['view', ['codeview']]
            ]
        });
    });
    </script>
@endpush