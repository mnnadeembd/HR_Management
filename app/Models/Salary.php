<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $table = 'salaries';
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function roles()
    {
        return $this->hasMany(Role::class, 'salarie_id');
    }
}
