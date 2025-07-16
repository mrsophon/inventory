<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vattype;
use Auth;
use Illuminate\Support\Carbon;

class VattypeController extends Controller
{
    public function VattypeAll(){

        $vattypes = Vattype::latest()->get();
        return view('backend.vattype.vattype_all',compact('vattypes'));

    } // End Mehtod


    public function VattypeAdd(){
        return view('backend.vattype.vattype_add');
    } // End Mehtod


    public function VattypeStore(Request $request){

        Vattype::insert([
            'name' => $request->name,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Vat Type Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('vattype.all')->with($notification);

    } // End Method


    public function VattypeEdit($id){

        $vattype = Vattype::findOrFail($id);
        return view('backend.vattype.vattype_edit',compact('vattype'));

    } // End Method


    public function VattypeUpdate(Request $request){

        $vattype_id = $request->id;

        Vattype::findOrFail($vattype_id)->update([
            'name' => $request->name,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Vat Type Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('vattype.all')->with($notification);

    } // End Method


    public function VattypeDelete($id){

        Vattype::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Vat Type Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // End Method
}
