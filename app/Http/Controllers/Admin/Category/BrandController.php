<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Model\Admin\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function brand(){
        $brand=Brand::all();
        return view('admin.category.brand',compact('brand'));
    }
    public function storebrand(Request $request){
        $request->validate([
            'brand_name'=>'required|unique:brands|max:255'
        ]);
        $brand=new Brand();
        $brand->brand_name=$request->brand_name;
        $image=$request->file('brand_logo');

        if($image){
            $image_name=date('dmy_H_s_i');
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $uploadpath='media/brand/';
            $image_url=$uploadpath.$image_full_name;
            $success=$image->move($uploadpath,$image_full_name);
            $brand->brand_logo=$image_url;
            $brand->save();
            $notification=array(
                'messege'=>'Brand Added Successfully ',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }else{
            $brand->save();
            $notification=array(
                'messege'=>'Brand Name Adedd',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }

    }

    public function deletebrand($id){
        $data=DB::table('brands')->where('id',$id)->first();
        unlink($data->brand_logo);
        DB::table('brands')->where('id',$id)->delete();

        $notification=array(
            'messege'=>'Brand Deleted',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function editbrand($id){
        $brand=DB::table('brands')->where('id',$id)->first();
        return view('admin.category.edit_brand',compact('brand'));
    }

    public function updatebrand(Request $request,$id){
        $oldlogo=$request->old_logo;
        $data=array();
        $data['brand_name']=$request->brand_name;
        $image=$request->file('brand_logo');

        if($image){
            unlink($oldlogo);
            $image_name=date('dmy_H_s_i');
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $uploadpath='media/brand/';
            $image_url=$uploadpath.$image_full_name;
            $success=$image->move($uploadpath,$image_full_name);

            $data['brand_logo']=$image_url;
            DB::table('brands')->where('id',$id)->update($data);

            $notification=array(
                'messege'=>'Brand edit Successfully ',
                'alert-type'=>'success'
            );
            return Redirect()->route('brands')->with($notification);
        }else{
            DB::table('brands')->where('id',$id)->update($data);
            $notification=array(
                'messege'=>'Update Without Image',
                'alert-type'=>'success'
            );
            return Redirect()->route('brands')->with($notification);
        }
    }
}
