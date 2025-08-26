<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Services\BaileysService;
use App\Models\Employee;


class PayslipController extends Controller
{
	
	function generateCaption($template, $employeeName) {
		return str_replace("<<NAMA>>", $employeeName, $template);
	}
	
    public function index()
    {
		//$folderPath = $request->folder_path;
		$folderPath = 'D:/Payslip';

    if (!File::exists($folderPath) || !File::isDirectory($folderPath)) {
        return back()->with('error', 'Folder tidak ditemukan.');
    }

    $files = File::files($folderPath);
    $data = [];

    foreach ($files as $file) {
        if ($file->getExtension() !== 'pdf') continue;

        $filename = $file->getFilename();
        $filenameNoExt = $file->getFilenameWithoutExtension();
        $nik = trim(explode('-', $filenameNoExt)[0]);

        $employee = \App\Models\Employee::where('nik', $nik)->first();

        $data[] = [
            'filename' => $filename,
            'nik' => $nik,
            'nama' => $employee ? $employee->nama : null,
            'whatsapp' => $employee ? $employee->whatsapp : null,
            'status' => $employee ? 'Cocok' : 'Karyawan Belum Terdaftar',
        ];
    }

    return view('payslip.index', [
        'data' => $data,
        'folder_path' => $folderPath
    ]);
    }
	

public function sendPayslips(Request $request)
    {
        $folderPath = $request->input('folder_path');
        $fileCaption = $request->input('caption');

        if (!File::exists($folderPath)) {
            return back()->with('error', 'Folder tidak ditemukan.');
        }

        $files = File::files($folderPath);
        $fileList = [];

        foreach ($files as $file) {
            /*$fileName = $file->getFilename();
            $nik = explode(' ', $fileName)[0];
            $fileList[] = [
                'nik' => $nik,
                'path' => $file->getPathname(),
                'name' => $fileName
            ];*/
			
			$fileName = $file->getFilename();
        $nik = explode(' ', $fileName)[0];

        $employee = Employee::where('nik', $nik)->first();
        if ($employee) {
            $fileList[] = [
                'nik' => $nik,
				'nama' => $employee->nama,
				'whatsapp' => $employee->whatsapp,
                'path' => $file->getPathname(),
                'name' => $fileName            ];
		}
			
        } // ini foreach

        return view('payslip.send', [
            'files' => $fileList,
            'caption' => $fileCaption
        ]);
    }

    public function sendPayslipSingle(Request $request, BaileysService $baileys)
    {
        $nik = $request->nik;
        $filePath = $request->file_path;
        $caption = $request->caption;

        $employee = Employee::where('nik', $nik)->first();
        if (!$employee || !File::exists($filePath)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tidak ditemukan atau file tidak ada'
            ]);
        }
		
		$captionFinal = $this->generateCaption($caption, $employee->nama);

        $success = $baileys->sendPayslip($employee->whatsapp, $filePath, $captionFinal);

        return response()->json([
            'status' => $success ? 'success' : 'error',
            'nik' => $nik,
            'nama' => $employee->nama,
			'whatsapp' => $employee->whatsapp,
            'message' => $success ? 'Terkirim' : 'Gagal'
        ]);
    }
	
	public function checkBaileysStatus(BaileysService $baileys)
	{
		return response()->json($baileys->getStatus());
	}

}