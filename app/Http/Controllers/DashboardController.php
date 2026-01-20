<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
{
    $today = Carbon::today()->toDateString();
    $currentYear = Carbon::now()->year;

    // Attendance summary (existing code)
    $attendances = Attendance::where('date', $today)->get();
    $presentCount = $attendances->where('status', 'Present')->count();
    $lateCount = $attendances->where('status', 'Late')->count();

    $permissions = Leave::where('status', 'Approved')
        ->where('start_date', '<=', $today)
        ->where('end_date', '>=', $today)
        ->pluck('employee_id')
        ->toArray();
    $permissionCount = count($permissions);

    $attendedEmployeeIds = $attendances->pluck('employee_id')->toArray();
    $absentCount = Employee::where('status', 'Active')
        ->whereNotIn('id', array_merge($attendedEmployeeIds, $permissions))
        ->count();

    $activeEmployees = Employee::where('status', 'Active')->count();
    $inactiveEmployees = Employee::where('status', 'Inactive')->count();

    // 5️⃣ New employees joined this year
    $newEmployeesCount = Employee::whereYear('joining_date', $currentYear)
        ->where('status', 'Active')
        ->count();

    return view('pages.erp.dashboard.index', compact(
        'activeEmployees',
        'inactiveEmployees',
        'presentCount',
        'lateCount',
        'permissionCount',
        'absentCount',
        'newEmployeesCount' // Pass this to blade
    ));
}










}
