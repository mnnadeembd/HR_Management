<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';


    public function designation()
    {
        return $this->belongsTo(Designation::class, 'designation_id');
    }


    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function role()
    {
        return $this->hasOneThrough(
            Role::class,   // final table/model
            User::class,   // intermediate table/model
            'id',          // User.id → matches Employee.user_id
            'id',          // Role.id → matches User.role_id
            'user_id',     // Employee.user_id → local key
            'role_id'      // User.role_id → foreign key
        );
    }


    protected $fillable = [
        'user_id',
        'department_id',
        'designation_id',
        'phone',
        'photo',
        'present_address',
        'permanent_address',
        'joining_date',
        'status',
        'salary',
    ];
}
