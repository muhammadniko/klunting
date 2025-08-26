@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <h1 class="m-0">Edit Employee</h1>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Form Edit Employee</h3>
            </div>
            <form action="{{ route('employee.update', $employee->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="text" class="form-control" id="nik" name="nik" value="{{ $employee->nik }}" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" name="nama" value="{{ $employee->nama }}" required>
                    </div>
                    <div class="form-group">
                        <label for="whatsapp">Nomor WhatsApp</label>
                        <input type="text" class="form-control" id="whatsapp" name="whatsapp" value="{{ $employee->whatsapp }}" required>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('employee.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-warning float-right">Update</button>
                </div>
            </form>
        </div>

    </div>
</section>
@endsection