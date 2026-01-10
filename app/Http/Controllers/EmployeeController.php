<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with(['user', 'department', 'role'])
            ->orderBy('id', 'asc')
            ->paginate(10);

        return view('pages.erp.employee.index', compact('employees'));
    }

    public function show($id)
    {
        $employee = Employee::with(['user', 'department', 'role'])
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


    public function store(Request $request)
    {
        //  Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'nullable|string|min:6', // optional
            'role_id' => 'required|integer|exists:roles,id', // assuming your Role table
            'department_id' => 'required|integer|exists:departments,id',
            'phone' => 'required|string|max:20',
            'status' => 'required|string|in:Active,Inactive',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
            'present_address' => 'required|string|max:255',
            'permanent_address' => 'required|string|max:255',
            // 'salary' => 'required|numeric',
            'joining_date' => 'required|date',
        ]);

        // dd($request->all());
        //  Use transaction to ensure both tables insert correctly
        DB::transaction(function () use ($request) {

            // Upload photo if exists
            $photoPath = null;
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('uploads/employees', 'public');
            }

            //  Insert into users table
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password ?? '123456'), // default password
                'role_id' => $request->role_id
            ]);

            // Insert into employees table
            Employee::create([
                'user_id' => $user->id,
                'department_id' => $request->department_id,
                'phone' => $request->phone,
                'photo' => $photoPath,
                'present_address' => $request->present_address,
                'permanent_address' => $request->permanent_address,
                // 'salary' => $request->salary,
                'joining_date' => $request->joining_date,
                'status' => $request->status,
            ]);
        });



        return redirect('/employee')->with('success', 'Employee and User created successfully!');
    }






    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        $roles = Role::all();
        $departments = Department::all();

        return view('pages.erp.employee.edit', compact('employee', 'roles', 'departments'));
    }


    public function delete($id)
    {
        Employee::findOrFail($id)->delete();
        return redirect()->route('employee.index');
    }
}
