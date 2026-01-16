<?php

namespace App\Http\Controllers;

use App\Models\Department;
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

    // public function create()
    // {
    //     $employees = Employee::with('user')->get();
    //     $payrollItems = PayrollItem::all();
    //     return view('pages.erp.payroll.create', compact('employees', 'payrollItems'));
    // }





    public function create()
    {
        $departments = Department::select('id', 'name')->get();

        $employees = Employee::with([
            'user.role.salary'
        ])->get();

        $allowances = PayrollItem::where('type', 'Allowance')->get();
        $deductions = PayrollItem::where('type', 'Deduction')->get();

        return view('pages.erp.payroll.create', compact(
            'departments',
            'employees',
            'allowances',
            'deductions'
        ));
    }


    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            // 1️⃣ Create payroll with ZERO values
            $payroll = Payroll::create([
                'employee_id'     => $request->employee_id,
                'salary_month'    => $request->salary_month,
                'gross_salary'    => 0,
                'total_deduction' => 0,
                'net_salary'      => 0,
                'payment_status'  => 'Pending',
            ]);

            $gross = 0;
            $deduction = 0;

            // 2️⃣ Allowances
            if ($request->has('allowance_title')) {
                foreach ($request->allowance_title as $key => $title) {
                    $amount = $request->allowance_amount[$key];

                    PayrollDetail::create([
                        'payroll_id' => $payroll->id,
                        'employee_id' => $request->employee_id,
                        'type' => 'Allowance',
                        'title' => $title,
                        'amount' => $amount,
                    ]);

                    $gross += $amount;
                }
            }

            // 3️⃣ Deductions
            if ($request->has('deduction_title')) {
                foreach ($request->deduction_title as $key => $title) {
                    $amount = $request->deduction_amount[$key];

                    PayrollDetail::create([
                        'payroll_id' => $payroll->id,
                        'employee_id' => $request->employee_id,
                        'type' => 'Deduction',
                        'title' => $title,
                        'amount' => $amount,
                    ]);

                    $deduction += $amount;
                }
            }

            // 4️⃣ Add basic salary
            PayrollDetail::create([
                'payroll_id' => $payroll->id,
                'employee_id' => $request->employee_id,
                'type' => 'Allowance',
                'title' => 'Basic Salary',
                'amount' => $request->basic_salary,
            ]);

            $gross += $request->basic_salary;

            // 5️⃣ Update totals
            $payroll->update([
                'gross_salary' => $gross,
                'total_deduction' => $deduction,
                'net_salary' => $gross - $deduction,
            ]);

            DB::commit();

            return redirect()->route('payroll.index')->with('success', 'Payroll created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
}
