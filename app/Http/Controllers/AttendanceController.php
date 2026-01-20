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



    protected $table = 'attendances';

    // either add these
    protected $fillable = [
        'employee_id',
        'date',
        'check_in',
        'check_out',
        'status',
    ];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attendances = Attendance::with(['employee'])->orderBy('id', 'desc')->paginate(5);
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
            'time' => 'required|date_format:H:i',
            'type' => 'required|in:check_in,check_out',
            'employees' => 'required|array',
        ]);

        $time = \Carbon\Carbon::createFromFormat('H:i', $request->time)->format('H:i:s');

        foreach ($request->employees as $employee_id) {

            $attendance = Attendance::firstOrNew([
                'employee_id' => $employee_id,
                'date' => $request->date,
            ]);

            $attendance->status = 'Pending';

            if ($request->type === 'check_in') {
                // Only set check-in if empty
                if (!$attendance->check_in) {
                    $attendance->check_in = $time;
                }
            } else { // check_out
                // Always set check-out (even if check-in null)
                $attendance->check_out = $time;
            }

            $attendance->save();
        }

        return redirect()->route('attendance.index')->with('success', 'Attendance submitted and waiting for approval');
    }




    public function pending()
    {
        $attendances = Attendance::where('status', 'Pending')
            ->with('employee.user')
            ->get();

        return view('pages.erp.attendance.pending', compact('attendances'));
    }



    public function approve($id)
    {
        $user = auth()->user();
        $employee = $user->employee;
        $allowedDepartments = [1, 7];

        // Authorization
        if (!in_array($user->role_id, [1, 2]) && (! $employee || ! in_array($employee->department_id, $allowedDepartments))) {
            abort(403, 'Unauthorized action.');
        }

        $attendance = Attendance::findOrFail($id);

        $attendance->status = ($attendance->check_in > '09:00:00') ? 'Late' : 'Present';
        $attendance->save();

        return redirect()->back()->with('success', 'Attendance approved successfully');
    }
}
