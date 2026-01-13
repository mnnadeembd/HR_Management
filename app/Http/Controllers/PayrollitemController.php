<?php

namespace App\Http\Controllers;

use App\Models\Payrollitem;
use Illuminate\Http\Request;

class PayrollitemController extends Controller
{
    public function index()
    {

        $payrollitems = Payrollitem::orderBy('id', 'asc')->paginate(10);
        return view('pages.erp.payrollitem.index', compact('payrollitems'));
    }

    public function create()
    {
        return view('pages.erp.payrollitem.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'payroll_type' => 'required|in:1,2',
            'title'        => 'required|string|max:255',
            'amount'       => 'required|numeric|min:0',
        ]);

        Payrollitem::create([
            'payroll_id' => $request->payroll_type,
            'type' => $request->payroll_type == 1 ? 'Allowance' : 'Deduction',
            'title' => $request->title,
            'amount' => $request->amount,
        ]);

        return redirect()->route('payrollitem.index')->with('success', 'Payroll item created successfully');
    }

    public function edit($id)
    {
        $payrollitem = Payrollitem::findOrFail($id);
        return view('pages.erp.payrollitem.edit', compact('payrollitem'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'payroll_type' => 'required|in:1,2',
            'title'        => 'required|string|max:255',
            'amount'       => 'required|numeric|min:0',
        ]);

        $payrollitem = Payrollitem::findOrFail($id);

        $payrollitem->update([
            'payroll_id' => $request->payroll_type,
            'type' => $request->payroll_type == 1 ? 'Allowance' : 'Deduction',
            'title' => $request->title,
            'amount' => $request->amount,
        ]);

        return redirect()->route('payrollitem.index')->with('success', 'Payroll item updated successfully');
    }

    public function destroy($id)
    {
        $payrollitem = Payrollitem::findOrFail($id);
        $payrollitem->delete();

        return redirect()->route('payrollitem.index')->with('success', 'Payroll item deleted successfully');
    }



}
