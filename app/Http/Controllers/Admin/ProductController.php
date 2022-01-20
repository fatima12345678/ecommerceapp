<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;


class ProductController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(){

        $product=DB::table('products')
            ->join('categories','products.category_id','categories.id')
            ->join('brands','products.brand_id','brands.id')
            ->select('products.*','categories.category_name','brands.brand_name')->get();
        return view('admin.product.index',compact('product'));
    }
    public function create(){
        $category=DB::table('categories')->get();
        $brand=DB::table('brands')->get();

        return view('admin.product.create',compact('category','brand'));
    }
    public function getsubcat ($category_id){
        $cat=DB::table('subcategories')->where('category_id',$category_id)->get();
        return json_encode($cat);
    }
    public function storeproduct(Request $request){
        $data=array();

        $data['product_name']=$request->product_name;
        $data['product_code']=$request->product_code;
        $data['product_quantity']=$request->quantity;
        $data['category_id']=$request->category_id;
        $data['subcategory_id']=$request->subcategory_id;
        $data['brand_id']=$request->brand_id;
        $data['product_size']=$request->product_size;
        $data['product_color']=$request->product_color;
        $data['selling_price']=$request->selling_price;
        $data['product_details']=$request->product_detail;
        $data['video_link']=$request->viedo_link;
        $data['hot_deal']=$request->hot_deal;
        $data['best_rated']=$request->best_rated;
        $data['trend']=$request->trend_product;
        $data['mid_slider']=$request->mid_slider;
        $data['hot_new']=$request->hot_new;
        $data['buyone_getone']=$request->buyone_getone;

        $image_one=$request->image_one;
        $image_tow=$request->image_tow;
        $image_three=$request->image_three;


        if($image_one && $image_tow && $image_three){
            $image_one_name=hexdec(uniqid()).'.'.$image_one->getClientOriginalExtension();
            Image::make($image_one)->resize(300,300)->save('media/product/'.$image_one_name);
            $data['image_one']='media/product/'.$image_one_name;

            $image_tow_name=hexdec(uniqid()).'.'.$image_tow->getClientOriginalExtension();
            Image::make($image_tow)->resize(300,300)->save('media/product/'.$image_tow_name);
            $data['image_tow']='media/product/'.$image_tow_name;

            $image_three_name=hexdec(uniqid()).'.'.$image_three->getClientOriginalExtension();
            Image::make($image_three)->resize(300,300)->save('media/product/'.$image_three_name);
            $data['image_three']='media/product/'.$image_three_name;

            DB::table('products')->insert($data);
            $notification=array(
                'messege'=>'Product Added Successfully ',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }
    }
    public function active($id){
        DB::table('products')->where('id',$id)->update(['status'=>1]);
        $notification=array(
            'messege'=>'products Successfully Active',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);


    }
    public function inactive($id){
        DB::table('products')->where('id',$id)->update(['status'=>0]);
        $notification=array(
            'messege'=>'products Successfully Inactive',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
    public function delete($id){
        $product= DB::table('products')->where('id',$id)->first();
        $imageone=$product->image_one;
        $imagetow=$product->image_tow;
        $imagethree=$product->image_three;
        unlink($imagethree);
        unlink($imageone);
        unlink($imagetow);


        DB::table('products')->where('id',$id)->delete();
        $notification=array(
            'messege'=>'products Deleted Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
    public function view($id){
        $product=DB::table('products')
            ->join('categories','products.category_id','categories.id')
            ->join('subcategories','products.subcategory_id','subcategories.id')
            ->join('brands','products.brand_id','brands.id')
            ->select('products.*','categories.category_name','brands.brand_name','subcategories.subcategory_name')
            ->where('products.id',$id)->first();

        return view('admin.product.show',compact('product'));
    }
    public function edit($id){
        $category=DB::table('categories')->get();
        $brand=DB::table('brands')->get();
        $subcategory=DB::table('subcategories')->get();
        $product=DB::table('products')->where('id',$id)->first();

        return view('admin.product.edit',compact('category','brand','subcategory','product'));
    }
    public function withoutimage(Request $request,$id){

        $data=array();
        $data['product_name']=$request->product_name;
        $data['product_code']=$request->product_code;
        $data['discount_price']=$request->discount_price;
        $data['product_quantity']=$request->quantity;
        $data['category_id']=$request->category_id;
        $data['subcategory_id']=$request->subcategory_id;
        $data['brand_id']=$request->brand_id;
        $data['product_size']=$request->product_size;
        $data['product_color']=$request->product_color;
        $data['selling_price']=$request->selling_price;
        $data['product_details']=$request->product_detail;
        $data['video_link']=$request->viedo_link;
        $data['hot_deal']=$request->hot_deal;
        $data['best_rated']=$request->best_rated;
        $data['trend']=$request->trend_product;
        $data['mid_slider']=$request->mid_slider;
        $data['hot_new']=$request->hot_new;
        $data['buyone_getone']=$request->buyone_getone;

        $update=DB::table('products')->where('id',$id)->update($data);
        if($update){
            $notification=array(
                'messege'=>'products Updeted Successfully',
                'alert-type'=>'success'
            );
            return Redirect()->route('all.product')->with($notification);
        }else{
            $notification=array(
                'messege'=>'products Nothing Update',
                'alert-type'=>'success'
            );
            return Redirect()->route('all.product')->with($notification);
        }

    }
    public function image(Request $request,$id){
        $old_one=$request->old_one;
        $old_tow=$request->old_tow;
        $old_three=$request->old_three;

        $image_one=$request->file('image_one');
        $image_tow=$request->file('image_tow');
        $image_three=$request->file('image_three');

        if($image_one){
            unlink($old_one);
            $image_name=date('dmy_H_s_i');

            $ext=strtolower($image_one->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $uploadpath='media/product/';
            $image_url=$uploadpath.$image_full_name;
            $success=$image_one->move($uploadpath,$image_full_name);
       DB::table('products')->where('id',$id)->update(['image_one'=>$image_url]);
            $notification=array(
                'messege'=>'Image one  Updated Successfully ',
                'alert-type'=>'success'
            );
            return Redirect()->route('all.product')->with($notification);
        }
        if($image_tow){
            unlink($old_tow);
            $image_name=date('dmy_H_s_i');
            $ext=strtolower($image_tow->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $uploadpath='media/product/';
            $image_url=$uploadpath.$image_full_name;
            $success=$image_tow->move($uploadpath,$image_full_name);
            DB::table('products')->where('id',$id)->update(['image_tow'=>$image_url]);
            $notification=array(
                'messege'=>'Image tow  Updated Successfully ',
                'alert-type'=>'success'
            );
            return Redirect()->route('all.product')->with($notification);
        }
        if($image_three){
            unlink($old_three);
            $image_name=date('dmy_H_s_i');
            $ext=strtolower($image_three->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $uploadpath='media/product/';
            $image_url=$uploadpath.$image_full_name;
            $success=$image_three->move($uploadpath,$image_full_name);
            DB::table('products')->where('id',$id)->update(['image_three'=>$image_url]);
            $notification=array(
                'messege'=>'Image three  Updated Successfully ',
                'alert-type'=>'success'
            );
            return Redirect()->route('all.product')->with($notification);
        }
    }
}
