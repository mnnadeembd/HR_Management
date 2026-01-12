<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PayrollitemController extends Controller
{
    public function index(){
        return view('pages.erp.payrollitem.index');
    }
}
