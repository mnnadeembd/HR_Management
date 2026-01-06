<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    protected $table = 'leaves';
    public function employee()
    {
        return $this->belongsTo(Employee::class, "employee_id");
    }
    public function leaveType()
    {
        return $this->belongsTo(Leavetype::class, "leave_type_id");
    }
    public function role()
    {
        return $this->belongsTo(Role::class, "approved_by");
    }


    //This functon calculate total leave days
    public function getTotalLeavesAttribute()
    {
        return \Carbon\Carbon::parse($this->start_date)->diffInDays(\Carbon\Carbon::parse($this->end_date)) + 1;
    }
}
