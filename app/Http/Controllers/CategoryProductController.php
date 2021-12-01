<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class CategoryProductController extends Controller
{
    public function AuthLogin()
    {
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    //
    public function add_category_product(){
        $this->AuthLogin();
        return view('category_product.add_category');

    }

    public function list_category_product()
    {
        $this->AuthLogin();
        $list_category = DB::table('tbl_category_product')->get();
        $manager_list_category = view('category_product.list_category')->with('list_category',$list_category);
        return view('admin_layout')->with('category_product.list_category',$manager_list_category);

    }

    public function edit_category_product($category_id){
       
        $this->AuthLogin();
        $edit_category = DB::table('tbl_category_product')->where('category_id',$category_id)->get();
        $manager_category = view('category_product.edit_category')->with('edit_category',$edit_category);
        return view('admin_layout')->with('category_product.edit_category',$manager_category);

    }

    public function update_category_product(Request $request, $category_id)
    {
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['category_desc'] = $request->category_desc;
        DB::table('tbl_category_product')->where('category_id',$category_id)->update($data);
        Session::put('message','Sửa thành công thành công');
        return Redirect::to('list-category');
    }

    public function delete_category_product($category_id)
    {
        $this->AuthLogin();
        $delete_category = DB::table('tbl_category_product')->where('category_id',$category_id)->delete();
        Session::put('message','Xóa thành công');
        return Redirect::to('list-category');
    }

    public function save_category_product(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['category_desc'] = $request->category_desc;
        $data['category_status'] = $request->category_status;

        DB::table('tbl_category_product')->insert($data);
        Session::put('message','Thêm thành công');
        return Redirect::to('/add-category');
       
    }


    public function active_category_product($category_id)
    {
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id', $category_id)->update(['category_status'=> 0]);
        Session::put('message','Kích hoạt sản phẩm thành công');
        return Redirect::to('list-category');
    }

    public function unactive_category_product($category_id)
    {
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id',$category_id)->update(['category_status' => 1]);
        Session::put('message','Kích hoạt sản phẩm thành công');
        return Redirect::to('list-category');
    }

    //Show category
    public function show_category_home($category_id)
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $category_by_id = DB::table('tbl_product')->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')->where('tbl_product.category_id',$category_id)->get();
        return view('pages.category.show_cate_home')->with('category',$cate_product)->with('brand', $brand_product)->with('category_by_id',$category_by_id);
    }
}