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
    public function AuthLogin()
    {
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    //Hiển thị giao diện thêm
    public function add_product()
    {
        $this->AuthLogin();
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->orderby('brand_id','desc')->get();
        $att_product = DB::table('tbl_attribute')->join('tbl_category_product','tbl_category_product.category_id','=','tbl_attribute.category_id')->orderby('tbl_attribute.category_id','desc')->get();

        foreach($att_product as $values){
            $category_id = $values->category_id;
        }

        $att_product2 = DB::table('tbl_attribute')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_attribute.category_id')
        ->orderby('tbl_category_product.category_id','desc')->where('tbl_category_product.category_id',$category_id)->get();

        return view('product.add_product')->with('cate_product',$cate_product)->with('brand_product',$brand_product)->with('att_product',$att_product2);
    }

    public function detail($product_id)
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $product = DB::table('tbl_product')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')->orderby('tbl_product.product_id','desc')
        ->where('product_id',$product_id)->get();

        foreach($product as $values){

            $category_id = $values->category_id;
        }   

       
        $related_product = DB::table('tbl_product')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')->orderby('tbl_product.product_id','desc')
        ->where('tbl_category_product.category_id',$category_id)->whereNotIn('tbl_product.product_id',[$product_id])->get();

        return view('product.product_detail')->with('category',$cate_product)->with('brand',$brand_product)->with('product', $product)->with('relate',$related_product);   
        
    }

    //Hiển thị tất cả sản phẩm
    public function list_product()
    {
        $this->AuthLogin();
        $list_product = DB::table('tbl_product')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')->orderby('tbl_product.product_id','desc')->get();
        return view('product.list_product')->with('list_product', $list_product);
        
    }

    //Lưu sản phẩm
    public function save_product(Request $request)
    {
        $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['product_price'] = $request->product_price;
        $data['product_image'] = $request->product_image;
        $data['product_size'] = $request->product_att;
        $data['product_color'] = $request->product_color;
        $data['category_id'] = $request->cate_product;
        $data['brand_id'] = $request->brand_product;
        $data['product_status'] = $request->product_status;

        //Kiểm tra hình ảnh
        $get_image = $request->file('product_image');
        if($get_image){
            $new_image = rand(0,99). '.' .$get_image->getClientOriginalExtension();
            $get_image->move('upload/products',$new_image);
            $data['product_image'] = $new_image;

            DB::table('tbl_product')->insert($data);
            Session::put('message', 'Thêm thành công');
            return Redirect::to('add-product');
        }

        DB::table('tbl_product')->insert($data);
        Session::put('message', 'Thêm thành công');
        return Redirect::to('add-product');
    }

    //Hiển thị giao diện chỉnh sửa
    public function edit_product($product_id)
    {
        $this->AuthLogin();

        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->orderby('brand_id','desc')->get();
        $edit_product = DB::table('tbl_product')->where('product_id',$product_id)->get();
        $manager_product = view('product.edit_product')->with('edit_product',$edit_product)->with('cate_product',$cate_product)->with('brand_product',$brand_product);
        return view('admin_layout')->with('product.edit_product', $manager_product);
    }

    //Cập nhật dữ liệu sản phẩm
    public function update_product(Request $request, $product_id)
    {
        $this->AuthLogin();

        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['product_price'] = $request->product_price;
        $data['product_size'] = $request->product_size;
        $data['product_color'] = $request->product_color;
        $data['category_id'] = $request->cate_product;
        $data['brand_id'] = $request->brand_product;
        $data['product_status'] = $request->product_status;
         //Kiểm tra hình ảnh
        $get_image = $request->file('product_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalExtension();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('upload/products',$new_image);
            $data['product_image'] = $new_image;
 
            DB::table('tbl_product')->where('product_id',$product_id)->update($data);
            Session::put('message', 'Cập nhật sản phẩm thành công');
            return Redirect::to('list-product');
        }

        DB::table('tbl_product')->where('product_id',$product_id)->update($data);
        Session::put('message', 'Cập nhật sản phẩm thành công');
        return Redirect::to('list-product');
    }

    public function active_product($product_id)
    {
        $this->AuthLogin();

        DB::table('tbl_product')->where('product_id', $product_id)->update(['product_status' => 0]);
        Session::put('message', 'Kích hoạt thương hiệu thành công');
        return Redirect::to('list-product');
    }

    


    public function unactive_product($product_id)
    {
        $this->AuthLogin();

        DB::table('tbl_product')->where('product_id', $product_id)->update(['product_status' => 1]);
        Session::put('message', 'Kích hoạt thương hiệu thành công');
        return Redirect::to('list-product');
    }


    ///xosa
    public function delete_product($product_id)
    {
        $this->AuthLogin();

        $edit_brand = DB::table('tbl_product')->where('product_id',$product_id)->delete();
        Session::put('message', 'Xóa thành công');
        return Redirect::to('list-product');
    }
}
