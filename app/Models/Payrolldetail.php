<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payrolldetail extends Model
{
    protected $table = 'payroll_details';


    public function payrollItem()
    {
        return $this->belongsTo(PayrollItem::class, 'payroll_item_id');
    }
}
