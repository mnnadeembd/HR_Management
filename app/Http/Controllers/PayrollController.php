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
        $departments = Department::select('id', 'name')->get();
        $payrolls = Payroll::with('employee')->orderBy('salary_month', 'asc')->paginate(7);
        return view('pages.erp.payroll.index', compact('payrolls', 'departments'));
    }


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

            //2️⃣ Allowances
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
            //return response()->json(['success' => true, 'message' => 'Payroll created successfully']);
            return redirect()->route('payroll.index')->with('success', 'Payroll created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            // return back()->with('error', $e->getMessage());

            //print_r(['success' => false, 'message' => 'Error creating payroll: ' . $e->getMessage()]);
        }
    }

    public function payslip($id)
    {
        $payroll = Payroll::with([
            'employee.user.role.salary',
            'employee.designation',
            'employee.department',
            'payroll_details.payrollItem',
        ])->findOrFail($id);

        return view('pages.erp.payroll.payslip', compact('payroll'));
    }

    public function pending()
    {
        $payrolls = Payroll::where('payment_status', 'Pending')->get();

        return view('pages.erp.payroll.pending', compact('payrolls'));
    }


    public function approve(Request $request)
    {
        $request->validate([
            'payroll_ids' => 'required|array',
            'payment_date' => 'required|date',
        ]);

        Payroll::whereIn('id', $request->payroll_ids)
            ->update([
                'payment_status' => 'Approved',
                'payment_date' => $request->payment_date,
            ]);

        return redirect()->back()->with('success', 'Payroll approved successfully');
    }


    public function destroy($id)
    {

        $payroll = Payroll::findOrFail($id);
        $payroll->delete();
        return redirect()->route('payroll.index')->with('success', 'Deleted successfully');
    }
}
