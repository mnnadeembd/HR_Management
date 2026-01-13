<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payrollitem extends Model
{
    protected $fillable = [
        'payroll_id',
        'type',
        'title',
        'amount',
    ];
}
