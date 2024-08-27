<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Type;
use Auth;
use Illuminate\Support\Carbon;


class TypeController extends Controller
{
    public function TypeAll(){

        $types = Type::latest()->get();
        return view('backend.type.type_all',compact('types'));

    } // End Mehtod


    public function TypeAdd(){
        return view('backend.type.type_add');
    } // End Mehtod


    public function TypeStore(Request $request){

        Type::insert([
            'name' => $request->name,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Type Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('type.all')->with($notification);

    } // End Method


    public function TypeEdit($id){

        $type = Type::findOrFail($id);
        return view('backend.type.type_edit',compact('type'));

    } // End Method


    public function TypeUpdate(Request $request){

        $type_id = $request->id;

        Type::findOrFail($type_id)->update([
            'name' => $request->name,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Type Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('type.all')->with($notification);

    } // End Method


    public function TypeDelete($id){

        Type::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Type Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // End Method

}
