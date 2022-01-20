<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Model\Admin\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubCategoryController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function subcategory(){

        $category=DB::table('categories')->get();
        $subcat=DB::table('subcategories')->
                join('categories','subcategories.category_id','categories.id')->
            select('subcategories.*','categories.category_name')->get();

        return view('admin.category.subcategories',compact('category','subcat'));
    }
    public function storesubcategory(Request $request){

        $request->validate([
            'category_id'=>'required',
              'subcategory_name'=>'required'
        ]);
    ;
        $data=array();
        $data['category_id']=$request->category_id;
        $data['subcategory_name']=$request->subcategory_name;
        DB::table('subcategories')->insert($data);

        $notification=array(
            'messege'=>'Sub Category Added Successfully ',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
    public function deletesubcategory($id){
        DB::table('subcategories')->where('id',$id)->delete();
        $notification=array(
            'messege'=>'Sub Category Deleted Successfully ',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);

    }
    public function editsubcategory($id){
        $subcat=DB::table('subcategories')->where('id',$id)->first();
        $category=DB::table('categories')->get();

        return view('admin.category.edit_subcategory',compact('subcat','category'));
    }
    public function updatesubcategory (Request $request,$id){

        $data=array();
        $data['subcategory_name']=$request->subcategory_name;
         $data['category_id']=$request->category_id;
         DB::table('subcategories')->where('id',$id)->update($data);
                 $notification=array(
                     'messege'=>'Sub Category Updated Successfully ',
                     'alert-type'=>'success'
                 );
        return Redirect()->route('subcategories')->with($notification);

    }
}
