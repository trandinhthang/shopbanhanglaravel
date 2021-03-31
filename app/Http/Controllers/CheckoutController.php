<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Cart;
session_start();

class CheckoutController extends Controller
{
    public function login_checkout(){
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();

        return view('pages.checkout.login_checkout')->with('category',$cate_product)->with('brand',$brand_product);
    }
    public function add_customer(Request $request) {
        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_email'] = $request->customer_email;
        $data['customer_pass'] = $request->customer_password;

        $customer_id= DB::table('tbl_customer')->insertGetId($data);
        Session::put('customer_id',$customer_id);
        Session::put('customer_name',$request->customer_name);

        return Redirect::to('/checkout');
    }

    public function checkout() {
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();

        return view('pages.checkout.show_checkout')->with('category',$cate_product)->with('brand',$brand_product);
    }

    public function save_checkout_customer(Request $request) {
        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_address'] = $request->shipping_address;

        $shipping_id= DB::table('tbl_shipping')->insertGetId($data);

        Session::put('shipping_id',$shipping_id);

        return Redirect::to('/payment');
    }

    public function payment() {
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();

        return view('pages.checkout.payment')->with('category',$cate_product)->with('brand',$brand_product);
    }

    public function logout_checkout() {
        Session::flush();
        return Redirect::to('/login-checkout');
    }

    public function login_customer(Request $request) {
        $email = $request->email_account;
        $password = $request->password_account;

        $result = DB::table('tbl_customer')->where('customer_email', $email)->where('customer_pass',$password)->first();

        if($result){
            Session::put('customer_id',$result->customer_id);
            return Redirect::to('/checkout');
        } else {
            return Redirect::to('/login-checkout');
        }

    }

    public function order_place(Request $request) {

        // insert payment method
        $data = array();
        $data['payment_method'] = $request->payment_option;
        $data['payment_status'] = 'Dang cho xu ly';

        $payment_id =DB::table('tbl_payment')->insertGetId($data);

        // insert order method
        $order_data = array();
        $order_data['customer_id'] = Session::get('customer_id');
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = Cart::total();
        $order_data['order_status'] = 'Dang cho xu ly';

        $order_id =DB::table('tbl_order')->insertGetId($order_data);

        $content= Cart::content();
        // insert order detail method
        foreach( $content as $v_content){
            $order_d_data = array();
            $order_d_data['order_id'] = $order_id;
            $order_d_data['product_id'] = $v_content->id;
            $order_d_data['product_name'] =$v_content->name;
            $order_d_data['product_price'] = $v_content->price;
            $order_d_data['product_quantity'] = $v_content->qty;
            DB::table('tbl_order_detail')->insertGetId($order_d_data);
        }

        if($data['payment_method']==1){
            $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
            $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();

            Cart::destroy();
            return view('pages.checkout.handcash')->with('category',$cate_product)->with('brand',$brand_product);
        } else {
            $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
            $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();

            Cart::destroy();
            return view('pages.checkout.paypal')->with('category',$cate_product)->with('brand',$brand_product);
        }
    }
}
