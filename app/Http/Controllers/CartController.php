<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Cart;
use Response;
use Session;
class CartController extends Controller
{
    //
    public function addcart($id){
        $product=DB::table('products')->where('id',$id)->first();

        $data=array();
        if($product->discount_price == Null){

            $data['id']=$product->id;
            $data['name']=$product->product_name;
            $data['qty']=1;
            $data['price']=$product->selling_price;
            $data['weight']=1;
            $data['options']['image']=$product->image_one;
            $data['options']['size']='';
            $data['options']['color']='';
            Cart::add($data);

            $notification=array(
                'messege'=>'Product Add In Your Cart',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);

        }else{

            $data['id']=$product->id;
            $data['name']=$product->product_name;
            $data['qty']=1;
            $data['price']=$product->discount_price;
            $data['weight']=1;
            $data['options']['image']=$product->image_one;
            $data['options']['size']='';
            $data['options']['color']='';
            Cart::add($data);

            $notification=array(
                'messege'=>'Product Add In Your Cart',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }
    }
    
    public function check()
    {
        $contant=Cart::content();
    }
    public function Add(Request $request,$id)
    {
        $product=DB::table('products')->where('id',$id)->first();
        $data=array();
        if($product->discount_price == Null){

            $data['id']=$product->id;
            $data['name']=$product->product_name;
            $data['qty']=$request->qty;
            $data['price']=$product->selling_price;
            $data['weight']=1;
            $data['options']['image']=$product->image_one;
            $data['options']['size']=$request->size;
            $data['options']['color']=$request->color;
            Cart::add($data);

            $notification=array(
                'messege'=>'Product Add In Your Cart',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);

        }else{

            $data['id']=$product->id;
            $data['name']=$product->product_name;
            $data['qty']=$request->qty;
            $data['price']=$product->selling_price;
            $data['weight']=1;
            $data['options']['image']=$product->image_one;
            $data['options']['size']=$request->size;
            $data['options']['color']=$request->color;
            Cart::add($data);

            $notification=array(
                'messege'=>'Product Add In Your Cart',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }
    }
    public function Show()
    {
       $cart=Cart::content();

       return view('pages.showcart',compact('cart'));
    }
    public function remove($rowId)
    {
        Cart::remove($rowId);
        $notification=array(
            'messege'=>'Product Deleted In Your Cart',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
    public function update(Request $request,$rowId){

        Cart::update($rowId,$request->qty);

        $notification=array(
            'messege'=>'Product Updated In Your Cart',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    function viewproduct($id){
        $product = DB::table('products')
        ->join('categories','products.category_id','categories.id')
        ->join('subcategories','products.subcategory_id','subcategories.id')
        ->join('brands','products.brand_id','brands.id')
        ->select('products.*','categories.category_name','subcategories.subcategory_name','brands.brand_name')
        ->where('products.id',$id)
        ->first();

        $color = $product->product_color;
        $product_color = explode(',', $color);

        $size = $product->product_size;
        $product_size = explode(',', $size);	

        return response::json(array(
        'product' => $product,
        'color' => $product_color,
        'size' => $product_size,
        ));
    }

    public function insert(Request $request)
    {
        $product=DB::table('products')->where('id',$request->product_id)->first();
        $data=array();
        if($product->discount_price == Null){

            $data['id']=$product->id;
            $data['name']=$product->product_name;
            $data['qty']=$request->qty;
            $data['price']=$product->selling_price;
            $data['weight']=1;
            $data['options']['image']=$product->image_one;
            $data['options']['size']=$request->size;
            $data['options']['color']=$request->color;
            Cart::add($data);

            $notification=array(
                'messege'=>'Product Add In Your Cart',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);

        }else{

            $data['id']=$product->id;
            $data['name']=$product->product_name;
            $data['qty']=$request->qty;
            $data['price']=$product->selling_price;
            $data['weight']=1;
            $data['options']['image']=$product->image_one;
            $data['options']['size']=$request->size;
            $data['options']['color']=$request->color;
            Cart::add($data);

            $notification=array(
                'messege'=>'Product Add In Your Cart',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }
    }

    public function checkout()
    {
       if(Auth::check()){
        $cart=Cart::content();

        return view('pages.checkout',compact('cart'));
       }else{
        $notification=array(
            'messege'=>'Must Login First',
            'alert-type'=>'error'
        );
        return Redirect()->route('login')->with($notification);
       }
    }
    public function wishlist()
    {
        $userid=Auth::id();

        $product=DB::table('wishlists')
        ->join('products','wishlists.product_id','products.id')
        ->select('products.*','wishlists.user_id')
        ->where('wishlists.user_id',$userid)
        ->get();
        return view('pages.wishlist',compact('product'));
    }
    public function coupon(Request $request)
    {
     
        $coupon=$request->coupon;

        $check=DB::table('coupons')->where('coupon',$coupon)->first();

        if($check){

            Session::put('coupon',[
                'name'=>$check->coupon,
                'discount'=>$check->discount,
                'blance'=>Cart::Subtotal()-$check->discount
            ]);
            $notification=array(
                'messege'=>'Successfuly Coupon Applied',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'Coupon Invaild',
                'alert-type'=>'error'
            );
            return Redirect()->back()->with($notification);
        }
    }
    public function couponremove()
    {
        Session::forget('coupon');
        $notification=array(
            'messege'=>'Successfuly Coupon remove',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
    public function payment()
    {
        $cart=Cart::content();
        return view('pages.payment',compact('cart'));
    }
   
}
