@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <h1 class="m-0">Tambah Employee</h1>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Form Tambah Employee</h3>
            </div>
            <form action="{{ route('employee.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="text" class="form-control" id="nik" name="nik" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="whatsapp">Nomor WhatsApp</label>
                        <input type="text" class="form-control" id="whatsapp" name="whatsapp" placeholder="08xxxx" required>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('employee.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary float-right">Simpan</button>
                </div>
            </form>
        </div>

    </div>
</section>
@endsection