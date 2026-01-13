<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Payroll;
use App\Models\PayrollDetail;
use App\Models\PayrollItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PayrollController extends Controller
{
    public function index()
    {
        $payrolls = Payroll::with('employee')->orderBy('salary_month', 'desc')->paginate(10);
        return view('pages.erp.payroll.index', compact('payrolls'));
    }

    public function create()
    {
        $employees = Employee::with('user')->get();
        $payrollItems = PayrollItem::all();
        return view('pages.erp.payroll.create', compact('employees', 'payrollItems'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required',
            'salary_month' => 'required',
            'items.*.amount' => 'required|numeric',
        ]);

        DB::transaction(function () use ($request) {

            // Create payroll summary
            $payroll = Payroll::create([
                'employee_id' => $request->employee_id,
                'salary_month' => $request->salary_month,
                'payment_status' => 'unpaid',
            ]);

            $gross = 0;
            $deduction = 0;

            // Store payroll details
            foreach ($request->items as $item) {
                if ($item['amount'] > 0) {
                    PayrollDetail::create([
                        'payroll_id' => $payroll->id,
                        'employee_id' => $request->employee_id,
                        'payroll_item_id' => $item['id'],
                        'type' => $item['type'],
                        'title' => $item['title'],
                        'amount' => $item['amount'],
                    ]);

                    if ($item['type'] === 'Allowance') {
                        $gross += $item['amount'];
                    } else {
                        $deduction += $item['amount'];
                    }
                }
            }

            // Update payroll totals
            $payroll->update([
                'gross_salary' => $gross,
                'total_deduction' => $deduction,
                'net_salary' => $gross - $deduction,
            ]);
        });

        return redirect()->route('payroll.index')->with('success', 'Payroll created successfully.');
    }
}
