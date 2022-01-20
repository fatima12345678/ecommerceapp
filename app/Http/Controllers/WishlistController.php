<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
class WishlistController extends Controller
{
    //
    public function addwishlist($id){
        $userid=Auth::id();
        $check=DB::table('wishlists')->where('user_id',$userid)->where('product_id',$id)->first();

        $data=array(
            
                'user_id'=>$userid,
                'product_id'=> $id,
            
        );
        if(Auth::Check()){
            if($check){

                $notification=array(
                    'messege'=>'Is alreday add ',
                    'alert-type'=>'error'
                );
                return Redirect()->back()->with($notification);
            }else{

                DB::table('wishlists')->insert($data);

                $notification=array(
                    'messege'=>'Add to Wishlist ',
                    'alert-type'=>'success'
                );
                return Redirect()->back()->with($notification);
            }

        }else{

        
            $notification=array(
                'messege'=>'Login Your Account First ',
                'alert-type'=>'warning'
            );
            return Redirect()->back()->with($notification);
        }
    }
}
