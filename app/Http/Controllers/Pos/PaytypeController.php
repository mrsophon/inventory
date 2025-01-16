<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Paytype;
use Auth;
use Illuminate\Support\Carbon;

class PaytypeController extends Controller
{
    public function PaytypeAll(){

        $paytypes = Paytype::latest()->get();
        return view('backend.paytype.paytype_all',compact('paytypes'));

    } // End Mehtod


    public function PaytypeAdd(){
        return view('backend.paytype.paytype_add');
    } // End Mehtod


    public function PaytypeStore(Request $request){

        Paytype::insert([
            'name' => $request->name,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Payment Type Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('paytype.all')->with($notification);

    } // End Method


    public function PaytypeEdit($id){

        $paytype = Paytype::findOrFail($id);
        return view('backend.paytype.paytype_edit',compact('paytype'));

    } // End Method


    public function PaytypeUpdate(Request $request){

        $paytype_id = $request->id;

        Paytype::findOrFail($paytype_id)->update([
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


    public function PaytypeDelete($id){

        Paytype::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Payment Type Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // End Method
}
