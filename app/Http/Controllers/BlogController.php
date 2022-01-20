<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class BlogController extends Controller
{
    //
    public function blog()
    {
        $blog=DB::table('posts')
        ->join('post_category','posts.category_id','post_category.id')
        ->select('posts.*','post_category.category_name_en','post_category.category_name_ar')
        ->get();

        return view('pages.blog',compact('blog'));
        
    }

    public function english()
    {
        Session::get('lang');
        Session::forget('lang');
        Session::put('lang','english');
        return redirect()->back();
    }
    public function arbic()
    {
        Session::get('lang');
        Session::forget('lang');
        Session::put('lang','arbic');
        return redirect()->back();
    }

    public function blogsingle($id)
    {
        $post=DB::table('posts')->where('id',$id)->get();

        return view('pages.blogsingle',compact('post'));
    }
}
