<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Salary;
use Illuminate\Http\Request;

class RoleController extends Controller
{


    public function index()
    {
        $roles = Role::with('salary')->orderBy('id')->paginate(5);
        return view('pages.erp.role.index', compact('roles'));
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $salaries = Salary::orderBy('basic_salary')->get();

        return view('pages.erp.role.edit', compact('role', 'salaries'));
    }

    function delete($id)
    {
        Role::find($id)->delete();
        return redirect("role");
    }

    public function create()
    {
        $salaries = Salary::orderBy('basic_salary')->get();
        return view('pages.erp.role.create', compact('salaries'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'salarie_id' => 'nullable|exists:salaries,id',
        ]);

        Role::create([
            'name' => $request->name,
            'salarie_id' => $request->salarie_id,
        ]);

        return redirect()->route('role.index')->with('success', 'Role created successfully');
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:100',
            'salarie_id' => 'nullable|exists:salaries,id',
        ]);

        $role->update([
            'name' => $request->name,
            'salarie_id' => $request->salarie_id,
        ]);

        return redirect()->route('role.index')->with('success', 'Role updated successfully');
    }
}
