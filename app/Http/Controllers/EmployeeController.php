<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return view('employee.index', compact('employees'));
    }

    public function create()
    {
        return view('employee.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:employees',
            'nama' => 'required',
            'whatsapp' => 'required',
        ]);

        Employee::create($request->all());
		
        return redirect()->route('employee.index')->with('success', 'Data karyawan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
		
        return view('employee.edit', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $request->validate([
            'nik' => 'required|unique:employees,nik,' . $employee->id,
            'nama' => 'required',
            'whatsapp' => 'required',
        ]);

        $employee->update($request->all());
		
        return redirect()->route('employee.index')->with('success', 'Data karyawan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
		
        $employee->delete();
		
        return redirect()->route('employee.index')->with('success', 'Data karyawan berhasil dihapus');
    }
}