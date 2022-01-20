<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    //
    public function payment(Request $request)
    {
        $data=array();
        $data['name']=$request->name;
        $data['phone']=$request->phone;
        $data['address']=$request->address;
        $data['city']=$request->city;
        $data['payment']=$request->payment;

        if($request->payment== "strip"){

            return view('pages.payments.strip',compact('data'));
        }else if($request->payment =="paypal"){

        }else if($request->payment == "ideal"){

        }else
        echo"s";
    }
}
