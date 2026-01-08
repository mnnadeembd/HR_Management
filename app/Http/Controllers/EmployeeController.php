<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Role;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with(['user', 'department', 'designation'])
            ->orderBy('id', 'asc')
            ->paginate(10);

        return view('pages.erp.employee.index', compact('employees'));
    }

    public function show($id)
    {
        $employee = Employee::with(['user', 'department', 'designation'])
            ->findOrFail($id);

        return view('pages.erp.employee.view', compact('employee'));
    }

    // ✅ FIXED CREATE METHOD
    public function create()
    {
        $roles = Role::select('id', 'name')->get();
        $departments = Department::select('id', 'name')->get();
        return view('pages.erp.employee.create', compact('roles', 'departments'));
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('pages.erp.employee.edit', compact('employee'));
    }

    public function delete($id)
    {
        Employee::findOrFail($id)->delete();
        return redirect()->route('employee.index');
    }
}
