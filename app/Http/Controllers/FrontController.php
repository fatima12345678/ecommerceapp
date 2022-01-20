<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{
    //
    public function newslater(Request $request){
        $request->validate([
            'email'=>'required|unique:newslaters|max:255'
        ]);
        $data=array();
        $data['email']=$request->email;
        DB::table('newslaters')->insert($data);
        $notification=array(
            'messege'=>'Thanks For Subscribing ',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
}
