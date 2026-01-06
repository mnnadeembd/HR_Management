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
}
