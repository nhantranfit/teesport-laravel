<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Redirect;
session_start();

class CartController extends Controller
{
    //
    public function save_cart(Request $request){
        $productID = $request->productid_hidden;
        $quantity = $request->quantity; 
       
        $product_infor = DB::table('tbl_product')->where('tbl_product.product_id',$productID)->first();


        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();

        $data['id'] = $product_infor->product_id;
        $data['qty'] = $quantity;
        $data['name'] = $product_infor->product_name;
        $data['price'] = $product_infor->product_price;
        $data['weight'] = $product_infor->product_price;
        $data['options']['images'] = $product_infor->product_image;
        Cart::setGlobalTax(21);
        Cart::add($data);
       
        return Redirect::to('/show-cart');

    
    }

    public function show_cart()
    {
        
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();

        return view('pages.cart.show_cart')->with('category',$cate_product)->with('brand', $brand_product);

    }
      
    public function delete_to_cart($rowID)
    {
        Cart::remove($rowID);
        return Redirect::to('/show-cart');

    }

    public function update_to_cart(Request $request)
    {
        $rowId = $request->rowId;
        $qty = $request->quantity;
        Cart::update($rowId,$qty);
        return Redirect::to('/show-cart');
    }

    
}
