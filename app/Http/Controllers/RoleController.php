<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(Role $role){
        $roles = Role::orderBy('id')->paginate(5);
        return view('pages.erp.role.index', compact('roles','role'));
    }

    function create(){
        return view('pages.erp.role.index');
    }

    function edit(Request $request){
        if ($request->id) {
            $role=Role::find($request->id);
             return view('pages.erp.role.index', compact('role'));
        }
        return view('pages.erp.role.index');
    }


    function delete($id)
    {
        Role::find($id)->delete();
        return redirect("role");
    }
}
