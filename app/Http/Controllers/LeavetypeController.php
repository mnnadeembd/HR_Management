<?php

namespace App\Http\Controllers;

use App\Models\Leavetype;
use Illuminate\Http\Request;

class LeavetypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leavetypes = Leavetype::orderBy('id')->paginate(5);
        return view('pages.erp.leave_type.index', compact('leavetypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.erp.leave_type.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $leavetype = new Leavetype();
        $leavetype->name = $request->name;

        $leavetype->save();
        return redirect('/leave_type')->with('success', 'Save successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Leavetype $leavetype)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $leavetype = Leavetype::find($id);
        return view('pages.erp.leave_type.edit', compact('leavetype'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $leavetype = Leavetype::find($id);
        $leavetype->name = $request->name;

        $leavetype->update();
        return redirect("leave_type");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $leavetype = Leavetype::findOrFail($id);
        $leavetype->delete();

        return redirect()->route('leavetype.index')->with('success', 'Deleted successfully');
    }










}
