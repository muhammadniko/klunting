@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Mengirim Dokumen</h4>
    <p>
        Total file: {{ count($files) }}
        <span id="global-spinner" class="spinner" style="margin-left:10px;"></span>
    </p>

    <div class="progress mt-3" style="height: 30px;">
        <div id="progress-bar" class="progress-bar bg-success" style="width:0%">0%</div>
    </div>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th style="width: 50px;">No</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>WhatsApp</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody id="log-list">
        </tbody>
    </table>
</div>

<style>
/* Spinner animasi */
.spinner {
    border: 3px solid #f3f3f3;
    border-top: 3px solid #3498db;
    border-radius: 50%;
    width: 16px;
    height: 16px;
    animation: spin 1s linear infinite;
    display: inline-block;
    vertical-align: middle;
}
@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>

<script>
let files = @json($files);
let caption = @json($caption);
let total = files.length;
let sent = 0;

// ✅ Tambahkan fungsi delay
function delay(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

async function sendOne(index) {
    let file = files[index];

    let row = document.createElement('tr');
    row.innerHTML = `
        <td>${index + 1}</td>
        <td>${file.nik}</td>
        <td>${file.nama ?? 'Tidak ditemukan'}</td>
        <td>${file.whatsapp ?? 'Tidak ditemukan'}</td>
        <td id="status-${index}">Mengirim...</td>
    `;
    document.getElementById('log-list').appendChild(row);

    try {
        let res = await fetch("{{ route('send.payslip.single') }}", {
            method: 'POST',
            headers: { 
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ 
                nik: file.nik, 
                file_path: file.path,
                caption: caption
            })
        });

        let data = await res.json();

        sent++;
        let percent = Math.round((sent / total) * 100);
        document.getElementById('progress-bar').style.width = percent + '%';
        document.getElementById('progress-bar').textContent = percent + '%';

        let statusCell = document.getElementById(`status-${index}`);
        if (data.status === 'success') {
            statusCell.innerHTML = '✅ ' + data.message;
        } else {
            statusCell.innerHTML = '❌ ' + data.message;
        }

    } catch (error) {
        sent++;
        let percent = Math.round((sent / total) * 100);
        document.getElementById('progress-bar').style.width = percent + '%';
        document.getElementById('progress-bar').textContent = percent + '%';

        let statusCell = document.getElementById(`status-${index}`);
        statusCell.innerHTML = '❌ Error: ' + error.message;
		console.log(error.message);
    }
}

async function startSending() {
    // Spinner aktif saat proses berjalan
    document.getElementById('global-spinner').style.display = 'inline-block';

    for (let i = 0; i < total; i++) {
        await sendOne(i);
		await delay(5000); // jeda 5 detik sebelum kirim berikutnya
    }

    // Sembunyikan spinner setelah semua selesai
    document.getElementById('global-spinner').style.display = 'none';
}

startSending();
</script>
@endsection