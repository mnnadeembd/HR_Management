<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    public function salary(){
        return $this->belongsTo(Salary::class, 'salarie_id');
    }
}
