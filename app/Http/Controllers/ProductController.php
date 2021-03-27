<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class ProductController extends Controller
{
    //
    public function add_product(){
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();
        
        return view('admin.add_product')->with('cate_product', $cate_product)->with('brand_product',$brand_product);

    }

    public function all_product(){

        $all_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->orderby('tbl_product.product_id','desc')
        ->get();
        $manager_product = view('admin.all_product')->with('all_product',$all_product);
        return view('admin_layout')->with('admin.all_product',$manager_product);

    }

    public function save_product(Request $request){
       $data = array();
       $date['product_name'] = $request->product_name;
       $date['product_price'] = $request->product_price;
       $date['product_desc'] = $request->product_desc;
       $date['product_content'] = $request->product_content;
       $date['category_id'] = $request->product_cate;
       $date['brand_id'] = $request->product_brand;
       $date['product_status'] = $request->product_status;
       $date['product_image'] = $request->product_image;
       $get_image = $request->file('product_image');

       if($get_image){
           $get_name_image = $get_image->getClientOriginalName();
           $name_image = current(explode('.',$get_name_image));
           $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
           $get_image->move('public/uploads/product',$new_image);
           $data['product_image'] = $new_image;
        DB::table('tbl_product')->insert($date);
        Session::put('message','Thêm sản phẩm thành công');
        return Redirect::to('add-product');
       }
       $data['product_image'] = '';
       DB::table('tbl_product')->insert($date);
       Session::put('message','Thêm sản phẩm thành công');
       return Redirect::to('add-product');
    }

    public function unactive_product($product_id){
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>1]);
        Session::put('message','Không kích hoạt sản phẩm thành công');
        return Redirect::to('all-product');
    }

    public function active_product($product_id){
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>0]);
        Session::put('message','Kích hoạt sản phẩm thành công');
        return Redirect::to('all-product');
    }

    public function edit_product($product_id){
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();

        $edit_product = DB::table('tbl_product')->where('product_id',$product_id)->get();
        $manager_product = view('admin.edit_product')->with('edit_product',$edit_product);
        return view('admin_layout')->with('admin.edit_product',$manager_brand_product);
    }

    public function update_brand_product(Request $request,$brand_product_id){
        $data = array();
        $date['brand_name'] = $request->brand_product_name;
        $date['brand_desc'] = $request->brand_product_desc;
        DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update($date);
        Session::put('message','Cập nhật thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');
    }

    public function delete_brand_product($brand_product_id){
        DB::table('tbl_brand')->where('brand_id',$brand_product_id)->delete();
        Session::put('message','Xóa thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');
    }
}
