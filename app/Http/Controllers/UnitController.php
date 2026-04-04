<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit;

class UnitController extends Controller
{
    
    public function index(){
        return view('admin.category.index');
    }

    public function add(){
        return view('admin.unit.add');
    }

    public function manage() {
        $units = Unit::all(); 
        return view('admin.unit.manage', compact('units'));
    }

    public function create(Request $request){
        Unit::newUnit($request);
        return redirect()->back()->with('message', 'Unit created successfully!');
    }

    public function edit($id){
        $unit = Unit::find($id);
        return view('admin.unit.edit', compact('unit'));
    }

   public function update(Request $request, $id){
    Unit::updatedUnit($request, $id);
    return redirect()->route('unit.manage')->with('message', 'Unit updated successfully');
}
    public function delete($id)
{
    Unit::deleteUnit($id);
    return redirect()->back()->with('message', 'Unit deleted successfully!');
}
    //end function
}
