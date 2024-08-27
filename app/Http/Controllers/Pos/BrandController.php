<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Auth;
use Illuminate\Support\Carbon;


class BrandController extends Controller
{
    public function BrandAll(){

        $brands = Brand::latest()->get();
        return view('backend.brand.brand_all',compact('brands'));

    } // End Mehtod


    public function BrandAdd(){
        return view('backend.brand.brand_add');
    } // End Mehtod


    public function BrandStore(Request $request){

        Brand::insert([
            'name' => $request->name,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Brand Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('brand.all')->with($notification);

    } // End Method


    public function BrandEdit($id){

        $brand = Brand::findOrFail($id);
        return view('backend.brand.brand_edit',compact('brand'));

    } // End Method


    public function BrandUpdate(Request $request){

        $brand_id = $request->id;

        Brand::findOrFail($brand_id)->update([
            'name' => $request->name,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Brand Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('brand.all')->with($notification);

    } // End Method


    public function BrandDelete($id){

        Brand::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Brand Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // End Method

}
