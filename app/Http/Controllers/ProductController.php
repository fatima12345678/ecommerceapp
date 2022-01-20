<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function productview($id,$product_name)
    {
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

        return view('pages.product_detail',compact('product','product_color','product_size'));
    }

    public function shopview($id)
    {
        $product=DB::table('products')->where('subcategory_id',$id)->paginate(5);
        $category=DB::table('categories')->get();
        $brand=DB::table('products')->where('subcategory_id',$id)->select('brand_id')->get();
        return view('pages.shopview',compact('product','category','brand'));
    }
    public function categoryview($id)
    {
        $product=DB::table('products')->where('category_id',$id)->paginate(5);
        return view('pages.categoryview',compact('product'));
    }
}
