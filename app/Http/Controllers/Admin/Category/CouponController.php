<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CouponController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function coupon(){
        $coupon=DB::table('coupons')->get();
        return view('admin.coupon.coupon',compact('coupon'));
    }
    public function storecoupon(Request $request){

        $data=array();
        $data['coupon']=$request->coupon;
        $data['discount']=$request->discount;
        DB::table('coupons')->insert($data);

        $notification=array(
            'messege'=>'coupon Added Successfully ',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
    public function deletecoupon($id){
        DB::table('coupons')->where('id',$id)->delete();
        $notification=array(
            'messege'=>'coupon Deleted Successfully ',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
    public function editcoupon($id){
        $coupon=DB::table('coupons')->where('id',$id)->first();
        return view('admin.coupon.edit_coupon',compact('coupon'));
    }
    public function updatesubcoupon(Request $request,$id){
        $data=array();
        $data['coupon']=$request->coupon;
        $data['discount']=$request->discount;
        DB::table('coupons')->where('id',$id)->update($data);

        $notification=array(
            'messege'=>'coupon Updated Successfully ',
            'alert-type'=>'success'
        );
        return Redirect()->route('coupons')->with($notification);
    }

    public function newslater(){
        $newslater=DB::table('newslaters')->get();
        return view('admin.newslater',compact('newslater'));
    }

    public function deletenewslater($id){
        DB::table('newslaters')->where('id',$id)->delete();
        $notification=array(
            'messege'=>'Subscribs Deleted Successfully ',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);

    }
}
