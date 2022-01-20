<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;
class PostController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function blog(){

        $blogcat=DB::table('post_category')->get();
        return view('admin.blog.category.index',compact('blogcat'));
    }
    public function storeblogcategory(Request $request){
        $request->validate([
           'category_name_en'=>'required|max:255',
            'category_name_ar'=>'required|max:255',
        ]);
        $data=array();
        $data['category_name_en']=$request->category_name_en;
        $data['category_name_ar']=$request->category_name_ar;

        DB::table('post_category')->insert($data);
        $notification=array(
            'messege'=>'Blog ADD Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
    public function delete($id){

        DB::table('post_category')->where('id',$id)->delete();
        $notification=array(
            'messege'=>'Blog Deleted Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
    public function edit($id){
        $blogcat=DB::table('post_category')->where('id',$id)->first();
        return view('admin.blog.category.edit',compact('blogcat'));
    }
    public function update(Request $request,$id){
        $data=array();
        $data['category_name_en']=$request->category_name_en;
        $data['category_name_ar']=$request->category_name_ar;

        DB::table('post_category')->where('id',$id)->update($data);
        $notification=array(
            'messege'=>'Blog Update Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('add.blog.categorylist')->with($notification);
    }
    public function create(){
        $blogcat=DB::table('post_category')->get();
        return view('admin.blog.create',compact('blogcat'));
    }
    public function index(){
        $post=DB::table('posts')
            ->join('post_category','posts.category_id','post_category.id')
               ->select('posts.*','post_category.category_name_en')
            ->get();
        return view('admin.blog.index',compact('post'));
    }
    public function store(Request  $request){

        $data=array();
        $data['details_en']=$request->details_en;
        $data['details_ar']=$request->details_ar;
        $data['post_title_en']=$request->post_title_en;
        $data['post_title_ar']=$request->post_title_ar;
        $data['category_id']=$request->category_id;

        $image=$request->post_image;


        if($image) {
            if($image->getClientOriginalExtension()!='png'){
                $image_one_name = hexdec(uniqid()) . '.' .'png';
            }else{
                $image_one_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            }

            Image::make($image)->resize(300, 300)->save('media/post/' . $image_one_name);
            $data['post_image'] = 'media/post/' . $image_one_name;
            DB::table('posts')->insert($data);
            $notification=array(
                'messege'=>'Post ADD Successfully',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }else{
            $data['post_image'] = '';
            DB::table('posts')->insert($data);
            $notification=array(
                'messege'=>'Post ADD Successfully Without Image',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }

    }
    public function deletepost($id){


       $post= DB::table('posts')->where('id',$id)->first();
       $image=$post->post_image;
        unlink($image);
          DB::table('posts')->where('id',$id)->delete();
        $notification=array(
            'messege'=>'Post Deleted Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);

    }
    public function editpost($id){
        $post=DB::table('posts')->where('id',$id)->first();
        $blogcat=DB::table('post_category')->get();
        return view('admin.blog.edit',compact('post','blogcat'));
    }
    public function updatepost(Request $request,$id){

        $old_image=$request->old_image;
        $data=array();
        $data['details_en']=$request->details_en;
        $data['details_ar']=$request->details_ar;
        $data['post_title_en']=$request->post_title_en;
        $data['post_title_ar']=$request->post_title_ar;
        $data['category_id']=$request->category_id;

        $image=$request->file('post_image');

        if($image) {
            unlink($old_image);

            if($image->getClientOriginalExtension()!='png'){
                $image_one_name = hexdec(uniqid()) . '.' .'png';
            }else{
                $image_one_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            }

            Image::make($image)->resize(300, 300)->save('media/post/' . $image_one_name);
            $data['post_image'] = 'media/post/' . $image_one_name;
            DB::table('posts')->where('id',$id)->update($data);
            $notification=array(
                'messege'=>'Post Updated Successfully',
                'alert-type'=>'success'
            );
            return Redirect()->route('all.blogpost')->with($notification);
        }else{
            $data['post_image'] = $old_image;
            DB::table('posts')->where('id',$id)->update($data);
            $notification=array(
                'messege'=>'Post Updated Successfully Without Image',
                'alert-type'=>'success'
            );
            return Redirect()->route('all.blogpost')->with($notification);
        }
    }

}
