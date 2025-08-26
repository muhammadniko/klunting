@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <h1 class="m-0">Employee</h1>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

        <!-- Tambah Data Button -->
        <div class="mb-3">
            <a href="{{ route('employee.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle"></i> Tambah Karyawan
            </a>
        </div>

        <!-- Table -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Karyawan</h3>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>No. WhatsApp</th>
                            <th width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($employees as $employee)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $employee->nik }}</td>
                                <td>{{ $employee->nama }}</td>
                                <td>{{ $employee->whatsapp }}</td>
                                <td>
                                    <a href="{{ route('employee.edit', $employee->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('employee.destroy', $employee->id) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Belum ada data karyawan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</section>
@endsection