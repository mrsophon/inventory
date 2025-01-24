<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vat;
use Auth;
use Illuminate\Support\Carbon;

class VatController extends Controller
{
    public function VatAll(){

        $vats = Vat::latest()->get();
        return view('backend.vat.vat_all',compact('vats'));

    } // End Mehtod


    public function VatAdd(){
        return view('backend.vat.vat_add');
    } // End Mehtod


    public function VatStore(Request $request){

        Vat::insert([
            'name' => $request->name,
            'rate' => $request->rate,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Vat Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('vat.all')->with($notification);

    } // End Method


    public function VatEdit($id){

        $vat = Vat::findOrFail($id);
        return view('backend.vat.vat_edit',compact('vat'));

    } // End Method


    public function VatUpdate(Request $request){

        $vat_id = $request->id;

        Vat::findOrFail($vat_id)->update([
            'name' => $request->name,
            'rate' => $request->rate,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Vat Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('vat.all')->with($notification);

    } // End Method


    public function VatDelete($id){

        Vat::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Vat Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // End Method
}
