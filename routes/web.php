<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PayslipController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth');

// Employee routes
Route::middleware('auth')->prefix('employee')->name('employee.')->group(function () {
    Route::get('/', [EmployeeController::class, 'index'])->name('index');
    Route::get('/create', [EmployeeController::class, 'create'])->name('create');
    Route::post('/', [EmployeeController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [EmployeeController::class, 'edit'])->name('edit');
    Route::put('/{id}', [EmployeeController::class, 'update'])->name('update');
    Route::delete('/{id}', [EmployeeController::class, 'destroy'])->name('destroy');
});

Route::middleware('auth')->group(function () {
	Route::get('/payslip', [PayslipController::class, 'index'])->name('payslip.index');
	Route::post('/payslip/send', [PayslipController::class, 'sendPayslips'])->name('payslip.send');
	Route::post('/send-payslip-single', [PayslipController::class, 'sendPayslipSingle'])->name('send.payslip.single');
	Route::get('/baileys-status', [PayslipController::class, 'checkBaileysStatus'])->name('baileys.status');
});

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');


Route::post('/logout', function () {
    Auth::guard('employee')->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/login');
})->name('logout');

require __DIR__.'/auth.php';
