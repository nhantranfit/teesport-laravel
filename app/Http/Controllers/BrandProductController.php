<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;

use Illuminate\Support\Facades\Redirect;

session_start();

class BrandProductController extends Controller
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
    //Hiển thị giao diện thêm
    public function add_brand_product()
    {
        $this->AuthLogin();
        return view('brand_product.add_brand');
    }

    //Hiển thị tất cả sản phẩm
    public function list_brand_product()
    {
        $this->AuthLogin();
        $list_brand = DB::table('tbl_brand_product')->get();
        $manager_list_brand = view('brand_product.list_brand')->with('list_brand', $list_brand);
        return view('admin_layout')->with('brand_product.list_brand', $manager_list_brand);
    }

    //Lưu sản phẩm
    public function save_brand_product(Request $request)
    {
        $this->AuthLogin();
        $data = array();
        $data['brand_name'] = $request->brand_name;
        $data['brand_desc'] = $request->brand_desc;
        $data['brand_status'] = $request->brand_status;

        DB::table('tbl_brand_product')->insert($data);
        Session::put('message', 'Thêm thành công');
        return Redirect::to('list-brand');
    }

    //Hiển thị giao diện chỉnh sửa
    public function edit_brand_product($brand_id)
    {
        $this->AuthLogin();
        $edit_brand = DB::table('tbl_brand_product')->where('brand_id',$brand_id)->get();
        $manager_brand = view('brand_product.edit_brand')->with('edit_brand', $edit_brand);
        return view('admin_layout')->with('brand_product.edit_brand',  $manager_brand);
    }

    //Cập nhật dữ liệu sản phẩm
    public function update_brand_product(Request $request, $brand_id)
    {
        $this->AuthLogin();
        $data = array();
        $data['brand_name'] = $request->brand_name;
        DB::table('tbl_brand_product')->where('brand_id',$brand_id)->update($data);
        Session::put('message', 'Sửa thành công');
        return Redirect::to('list-brand');
    }

    public function active_brand_product($brand_id)
    {
        $this->AuthLogin();
        DB::table('tbl_brand_product')->where('brand_id', $brand_id)->update(['brand_status' => 0]);
        Session::put('message', 'Kích hoạt thương hiệu thành công');
        return Redirect::to('list-brand');
    }

    


    public function unactive_brand_product($category_id)
    {
        $this->AuthLogin();
        DB::table('tbl_brand_product')->where('brand_id', $category_id)->update(['brand_status' => 1]);
        Session::put('message', 'Kích hoạt thương hiệu thành công');
        return Redirect::to('list-brand');
    }


    ///xosa
    public function delete_brand_product($brand_id)
    {
        $this->AuthLogin();
        $edit_brand = DB::table('tbl_brand_product')->where('brand_id',$brand_id)->delete();
        Session::put('message', 'Xóa thành công');
        return Redirect::to('list-brand');
    }
}
