<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Unit;
use App\Models\Brand;
use App\Models\Type;
use App\Models\Vattype;
use Auth;
use Illuminate\Support\Carbon;
use Image;


class ProductController extends Controller
{
    public function ProductAll(){

        $product = Product::latest()->get();
        return view('backend.product.product_all',compact('product'));

    } // End Method


    public function ProductAdd(){

        $supplier = Supplier::all();
        $category = Category::all();
        $unit = Unit::all();
        $brand = Brand::all();
        $type = Type::all();
        $vattype = Vattype::all();
        $pdate = date('Y-m-d');
        return view('backend.product.product_add',compact('supplier','category','unit','brand','type','vattype','pdate'));
    } // End Method


    public function ProductStore(Request $request){

        if ($request->file('product_image')) {

            $image = $request->file('product_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension(); // 343434.png
            // Image::make($image)->resize(200,200)->save('upload/product/'.$name_gen);
            Image::make($image)->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save('upload/product/'.$name_gen);
            $save_url = 'upload/product/'.$name_gen;

            $pdate = date('Y-m-d',strtotime($request->pdate));

            Product::insert([
                'name' => $request->name,
                'supplier_id' => $request->supplier_id,
                'unit_id' => $request->unit_id,
                'category_id' => $request->category_id,
                'quantity' => $request->quantity,
                'item_desc' => $request->item_desc,
                'dimension' => $request->dimension,
                'stn_desc' => $request->stn_desc,
                'item_set' => $request->item_set,
                'brand_id' => $request->brand_id,
                'type_id' => $request->type_id,
                'cost' => $request->cost,
                'price' => $request->price,
                'price_baht' => $request->price_baht,
                'price_range' => $request->price_range,
                'vattype_id' => $request->vattype_id,
                'metal_wgt' => $request->metal_wgt,
                'gold_wgt' => $request->gold_wgt,
                'net_wgt' => $request->net_wgt,
                'date' => $pdate,
                'note' => $request->note,
                'product_image' => $save_url,
                'status' => $request->stat,
                'created_by' => Auth::user()->id,
                'created_at' => Carbon::now()
            ]);

            $notification = array(
                'message' => 'Product Inserted with Image Successfully',
                'alert-type' => 'success'
            );

        } else {

            $pdate = date('Y-m-d',strtotime($request->pdate));

            Product::insert([
                'name' => $request->name,
                'supplier_id' => $request->supplier_id,
                'unit_id' => $request->unit_id,
                'category_id' => $request->category_id,
                'quantity' => $request->quantity,
                'item_desc' => $request->item_desc,
                'dimension' => $request->dimension,
                'stn_desc' => $request->stn_desc,
                'item_set' => $request->item_set,
                'brand_id' => $request->brand_id,
                'type_id' => $request->type_id,
                'cost' => $request->cost,
                'price' => $request->price,
                'price_baht' => $request->price_baht,
                'price_range' => $request->price_range,
                'vattype_id' => $request->vattype_id,
                'metal_wgt' => $request->metal_wgt,
                'gold_wgt' => $request->gold_wgt,
                'net_wgt' => $request->net_wgt,
                'date' => $pdate,
                'note' => $request->note,
                'product_image' => $request->product_image,
                'status' => $request->stat,
                'created_by' => Auth::user()->id,
                'created_at' => Carbon::now()
            ]);

            $notification = array(
                'message' => 'Product Inserted without Image Successfully',
                'alert-type' => 'success'
            );

        } // end else

        return redirect()->route('product.all')->with($notification);

    } // End Method


    public function ProductEdit($id){

        $supplier = Supplier::all();
        $category = Category::all();
        $unit = Unit::all();
        $brand = Brand::all();
        $type = Type::all();
        $vattype = Vattype::all();
        $product = Product::findOrFail($id);
        $pdate = date('Y-m-d',strtotime($product->date));
        return view('backend.product.product_edit',compact('product','supplier','category','unit','brand','type','vattype','pdate'));
    } // End Method


    public function ProductUpdate(Request $request){

        $product_id = $request->id;
        if ($request->file('product_image')) {

            $image = $request->file('product_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension(); // 343434.png
            // Image::make($image)->resize(200,200)->save('upload/product/'.$name_gen);
            Image::make($image)->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save('upload/product/'.$name_gen);
            $save_url = 'upload/product/'.$name_gen;

            $products = Product::findOrFail($product_id);
            $img = $products->product_image;
            if (file_exists($img)) {
                unlink($img);
            }

            $pdate = date('Y-m-d',strtotime($request->pdate));

            Product::findOrFail($product_id)->update([
                'name' => $request->name,
                'supplier_id' => $request->supplier_id,
                'unit_id' => $request->unit_id,
                'category_id' => $request->category_id,
                'quantity' => $request->quantity,
                'item_desc' => $request->item_desc,
                'dimension' => $request->dimension,
                'stn_desc' => $request->stn_desc,
                'item_set' => $request->item_set,
                'brand_id' => $request->brand_id,
                'type_id' => $request->type_id,
                'cost' => $request->cost,
                'price' => $request->price,
                'price_baht' => $request->price_baht,
                'price_range' => $request->price_range,
                'vattype_id' => $request->vattype_id,
                'metal_wgt' => $request->metal_wgt,
                'gold_wgt' => $request->gold_wgt,
                'net_wgt' => $request->net_wgt,
                'date' => $pdate,
                'note' => $request->note,
                'product_image' => $save_url,
                'status' => $request->stat,
                'updated_by' => Auth::user()->id,
                'updated_at' => Carbon::now()
            ]);

            $notification = array(
                'message' => 'Product Updated with Image Successfully',
                'alert-type' => 'success'
            );

        } else {

            $products = Product::findOrFail($product_id);
            $img = $products->product_image;
            if (file_exists($img)) {
                unlink($img);
            }

            $pdate = date('Y-m-d',strtotime($request->pdate));

            Product::findOrFail($product_id)->update([
                'name' => $request->name,
                'supplier_id' => $request->supplier_id,
                'unit_id' => $request->unit_id,
                'category_id' => $request->category_id,
                'quantity' => $request->quantity,
                'item_desc' => $request->item_desc,
                'dimension' => $request->dimension,
                'stn_desc' => $request->stn_desc,
                'item_set' => $request->item_set,
                'brand_id' => $request->brand_id,
                'type_id' => $request->type_id,
                'cost' => $request->cost,
                'price' => $request->price,
                'price_baht' => $request->price_baht,
                'price_range' => $request->price_range,
                'vattype_id' => $request->vattype_id,
                'metal_wgt' => $request->metal_wgt,
                'gold_wgt' => $request->gold_wgt,
                'net_wgt' => $request->net_wgt,
                'date' => $pdate,
                'note' => $request->note,
                'product_image' => $request->product_image,
                'status' => $request->stat,
                'updated_by' => Auth::user()->id,
                'updated_at' => Carbon::now()
            ]);

            $notification = array(
                'message' => 'Product Updated without Image Successfully',
                'alert-type' => 'success'
            );

        } // end else

        return redirect()->route('product.all')->with($notification);

    } // End Method


    public function ProductDelete($id){

        $products = Product::findOrFail($id);
        $img = $products->product_image;
        if (file_exists($img)) {
            unlink($img);
        }

        Product::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Product Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // End Method

}
