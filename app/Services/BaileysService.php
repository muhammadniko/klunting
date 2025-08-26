<?php 
namespace App\Services;

use Illuminate\Support\Facades\Http;

class BaileysService
{
    public function sendPayslip($phoneNumber, $filePath, $fileName)
    {
        /*$response = Http::withHeaders([
			'Content-Type' => 'application/json'
		])->post('http://localhost:3000/send-file', [
			'number' => "082351442030",
			'filePath' => "D:/Payslip/tes.pdf",
			'caption' => "Ini Slip Gaji Anda"
		]);*/
		
		// Hilangkan spasi, tanda plus, dan karakter non-digit
        $numberclear = preg_replace('/\D/', '', $phoneNumber);

        // Kalau nomor diawali 0 → ubah jadi 62
        if (substr($numberclear, 0, 1) === '0') {
            $number = '62' . substr($phoneNumber, 1);
        }
		
		$response = Http::post('http://localhost:3000/send-file', [
            'number' => $number, // Nomor tujuan
            'filePath' => $filePath, // Path file di server bot
            'caption' => $fileName // Opsional
        ]);

        return $response->successful();
    }
	
	public function getStatus()
{
    try {
        $response = Http::timeout(2)->get('http://localhost:3000/status');

        if ($response->successful()) {
            return $response->json();
        }

        return ['connected' => false];
    } catch (\Exception $e) {
        // Bot tidak berjalan
        return ['connected' => false];
    }
}
}


