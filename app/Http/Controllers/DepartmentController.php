<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::orderBy('id')->paginate(5);
        return view('pages.erp.department.index', compact('departments'));
    }

    public function edit($id)
    {
        $department = Department::findOrFail($id);
        return view('pages.erp.department.edit', compact('department'));
    }

    function delete($id)
    {
        Department::find($id)->delete();
        return redirect("department");
    }

    public function create()
    {
        return view('pages.erp.department.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
           
        ]);

        Department::create([
            'name' => $request->name,
            
        ]);

        return redirect()->route('department.index')
                 ->with('success', 'Department created successfully');
    }

    public function update(Request $request, $id)
    {
        $department = Department::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:100',
            
        ]);

        $department->update([
            'name' => $request->name,
            
        ]);

       return redirect()->route('department.index')
                 ->with('success', 'Department created successfully');
    }
}
