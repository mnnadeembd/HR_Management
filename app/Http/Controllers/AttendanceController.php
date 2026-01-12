<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attendances = Attendance::with(['employee'])->orderBy('id', 'asc')->paginate(5);
        return view("pages.erp.attendance.index", compact("attendances"));
    }


    /**
     * Display the specified resource.
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance)
    {
        //
    }

    public function create()
    {
        $departments = Department::select('id', 'name')->get();

        return view('pages.erp.attendance.create', compact('departments'));
    }

    // AJAX
    public function getEmployeesByDepartment($department_id)
    {
        $employees = Employee::where('department_id', $department_id)
            ->with('user:id,name')
            ->get();

        return response()->json($employees);
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'type' => 'required|in:check_in,check_out',
            'employees' => 'required|array',
        ]);

        foreach ($request->employees as $employee_id) {

            $attendance = Attendance::where('employee_id', $employee_id)
                ->where('date', $request->date)
                ->first();

            if ($request->type === 'check_in') {

                Attendance::updateOrCreate(
                    [
                        'employee_id' => $employee_id,
                        'date' => $request->date,
                    ],
                    [
                        'check_in' => Carbon::now()->format('H:i:s'),
                        'status' => Carbon::now()->format('H:i:s') > '09:00:00'
                            ? 'Late'
                            : 'Present',
                    ]
                );

            } else { // checkout

                if ($attendance) {
                    $attendance->update([
                        'check_out' => Carbon::now()->format('H:i:s'),
                    ]);
                }
            }
        }

        return redirect()->back()->with('success', 'Attendance saved successfully');
    }




}
