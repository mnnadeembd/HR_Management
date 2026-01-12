<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    protected $table = 'leaves';

    protected $fillable = [
        'employee_id',
        'leave_type_id',
        'reason',
        'start_date',
        'end_date',
        'status',
        'approved_by',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function leaveType()
    {
        return $this->belongsTo(LeaveType::class);
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
