<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'salarie_id'];
    public function salary(){
        return $this->belongsTo(Salary::class, 'salarie_id');
    }
}
