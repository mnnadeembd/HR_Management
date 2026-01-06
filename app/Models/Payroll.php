<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    protected $table = "payrolls";
    public function employee(){
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
