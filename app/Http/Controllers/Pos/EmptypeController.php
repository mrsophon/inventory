<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Emptype;
use Auth;
use Illuminate\Support\Carbon;

class EmptypeController extends Controller
{
    public function EmptypeAll(){

        $emptypes = Emptype::latest()->get();
        return view('backend.emptype.emptype_all',compact('emptypes'));

    } // End Mehtod


    public function EmptypeAdd(){
        return view('backend.emptype.emptype_add');
    } // End Mehtod


    public function EmptypeStore(Request $request){

        Emptype::insert([
            'name' => $request->name,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Payment Type Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('emptype.all')->with($notification);

    } // End Method


    public function EmptypeEdit($id){

        $emptype = Emptype::findOrFail($id);
        return view('backend.emptype.emptype_edit',compact('emptype'));

    } // End Method


    public function EmptypeUpdate(Request $request){

        $emptype_id = $request->id;

        Emptype::findOrFail($paytype_id)->update([
            'name' => $request->name,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Payment Type Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('paytype.all')->with($notification);

    } // End Method


    public function EmptypeDelete($id){

        Emptype::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Payment Type Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // End Method
}
