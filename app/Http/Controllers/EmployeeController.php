<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(){
         $employees = Employee::with(['user', 'department', 'designation'])->orderBy('id', 'asc')->paginate(10);
        //return $employees;

        return view('pages.erp.employee.index', compact('employees'));
    }

    public function show($id)
    {
        $employee = Employee::with(['user', 'department', 'designation'])->findOrFail($id);

        return view('pages.erp.employee.view', compact('employee'));
    }

    function create(){
        return view('pages.erp.employee.create');
    }


    function edit($id){
        $employee = Employee::find($id);
        return view("pages.erp.employee.edit", compact("employee"));
    }



    function delete($id){
        Employee::find($id)->delete();
        return redirect("employee");
    }






}
