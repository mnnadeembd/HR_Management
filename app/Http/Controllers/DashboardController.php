<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $activeEmployees = Employee::where('status', 'active')->count();
        $inactiveEmployees = Employee::where('status', 'inactive')->count();

        $attendanceSummary = Attendance::select('status', DB::raw('COUNT(*) as total'))->groupBy('status')->pluck('total', 'status');

        return view('pages.erp.dashboard.index', compact('activeEmployees', 'inactiveEmployees', 'attendanceSummary'));
    }
}
