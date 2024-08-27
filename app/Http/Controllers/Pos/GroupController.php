<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Group;
use Auth;
use Illuminate\Support\Carbon;


class GroupController extends Controller
{
    public function GroupAll(){

        $groups = Group::latest()->get();
        return view('backend.group.group_all',compact('groups'));

    } // End Mehtod


    public function GroupAdd(){
        return view('backend.group.group_add');
    } // End Mehtod


    public function GroupStore(Request $request){

        Group::insert([
            'name' => $request->name,
            'hidden' => $request->hidden,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Group Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('group.all')->with($notification);

    } // End Method


    public function GroupEdit($id){

        $group = Group::findOrFail($id);
        return view('backend.group.group_edit',compact('group'));

    } // End Method


    public function GroupUpdate(Request $request){

        $group_id = $request->id;

        Group::findOrFail($group_id)->update([
            'name' => $request->name,
            'hidden' => $request->hidden,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Group Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('group.all')->with($notification);

    } // End Method


    public function GroupDelete($id){

        Group::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Group Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // End Method

}
