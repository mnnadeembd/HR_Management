<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model {
    protected $fillable = [
        'employee_id', 'salary_month', 'gross_salary', 'total_deduction', 'net_salary', 'payment_status'
    ];

    public function details() {
        return $this->hasMany(PayrollDetail::class, 'payroll_id');
    }

    public function employee() {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}

class PayrollDetail extends Model {
    protected $fillable = [
        'payroll_id', 'employee_id', 'payroll_item_id', 'type', 'title', 'amount'
    ];
}



