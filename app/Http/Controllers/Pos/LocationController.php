<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;
use Auth;
use Illuminate\Support\Carbon;

class LocationController extends Controller
{
    public function LocationAll(){

        $locations = Location::latest()->get();
        return view('backend.location.location_all',compact('locations'));

    } // End Mehtod


    public function LocationAdd(){
        return view('backend.location.location_add');
    } // End Mehtod


    public function LocationStore(Request $request){

        Location::insert([
            'name' => $request->name,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Location Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('location.all')->with($notification);

    } // End Method


    public function LocationEdit($id){

        $location = Location::findOrFail($id);
        return view('backend.location.location_edit',compact('location'));

    } // End Method


    public function LocationUpdate(Request $request){

        $location_id = $request->id;

        Location::findOrFail($location_id)->update([
            'name' => $request->name,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Location Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('location.all')->with($notification);

    } // End Method


    public function LocationDelete($id){

        Location::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Location Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // End Method
}
