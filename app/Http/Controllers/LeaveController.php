<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Leave;
use App\Models\Leavetype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{


    public function index()
    {
        $leaves = Leave::with(['employee', 'leaveType', 'role'])->orderBy('id', 'asc')->paginate(5);
        return view("pages.erp.leave.index", compact("leaves"));
    }
    // Employee leave form
    public function form()
{
    // Employees table এর department_id আছে, কিন্তু নাম কোথা থেকে আসবে?
    // যদি আলাদা departments table থাকে:
    $departments = Department::select('id', 'name')->get();

    $leaveTypes = LeaveType::all();

    return view('pages.erp.leave.form', compact('departments','leaveTypes'));
}

    // Employee submit leave
    public function submit(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'leave_type_id' => 'required|exists:leave_types,id',
            'reason' => 'required|string|max:300',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        Leave::create([
            'employee_id' => $request->employee_id,
            'leave_type_id' => $request->leave_type_id,
            'reason' => $request->reason,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => 'Pending',
            'approved_by' => null,
        ]);

        return redirect()->back()->with('success','Leave applied successfully');
    }

    // Admin: pending leave list
    public function pending()
    {
        if (!in_array(Auth::id(), [1,2, 11])) abort(403);

        $leaves = Leave::with(['employee.user','leaveType'])->where('status','Pending')->get();

        return view('pages.erp.leave.pending', compact('leaves'));
    }


    // Admin approve
    public function approve($id)
    {
        if (!in_array(Auth::id(), [1,2, 11])) abort(403);

        $leave = Leave::findOrFail($id);
        $leave->update([
            'status' => 'Approved',
            'approved_by' => Auth::id()
        ]);

        //return back()->with('success','Leave approved');
        return redirect()->route('/leave')->with('success','Leave applied successfully');
    }

    // Admin reject
    public function reject($id)
    {
        if (!in_array(Auth::id(), [1,2, 11])) abort(403);

        $leave = Leave::findOrFail($id);
        $leave->update([
            'status' => 'Rejected',
            'approved_by' => Auth::id()
        ]);

        return back()->with('success','Leave rejected');
    }

    // AJAX: department → employees
    public function getEmployeesByDepartment($department_id)
    {
        $employees = Employee::where('department_id', $department_id)->with('user:id,name')->get();
        return response()->json($employees);
    }
}
