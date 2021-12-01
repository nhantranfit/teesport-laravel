<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;

use Illuminate\Support\Facades\Redirect;

session_start();
class AttributeController extends Controller
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
    public function add_attribute()
    {
        $this->AuthLogin();
        $cate_attribute = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        return view('attribute.add_attribute')->with('cate_attribute',$cate_attribute);
    }

    //Hiển thị tất cả sản phẩm
    public function list_attribute()
    {
        $this->AuthLogin();
        $list_attribute = DB::table('tbl_attribute')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_attribute.category_id')->orderby('tbl_attribute.attribute_id','desc')->get();
        $manager_attribute= view('attribute.list_attribute')->with('list_attribute', $list_attribute);
        return view('admin_layout')->with('attribute.list_attribute', $manager_attribute);
    }

    //Lưu thuộc tính
    public function save_attribute(Request $request)
    {
        $this->AuthLogin();
        $data = array();
        $data['category_id'] = $request->attribute_cate;
        $data['attribute_name'] = $request->attribute_name;
        $data['attribute_desc'] = $request->attribute_desc;

        DB::table('tbl_attribute')->insert($data);
        Session::put('message', 'Thêm thành công');
        return Redirect::to('add-attribute');
    }

    //Hiển thị giao diện chỉnh sửa
    public function edit_attribute($attribute_id)
    {
        $this->AuthLogin();

        $cate_attribute = DB::table('tbl_category_attribute')->orderby('category_id','desc')->get();
        $brand_attribute = DB::table('tbl_brand_attribute')->orderby('brand_id','desc')->get();
        $edit_attribute = DB::table('tbl_attribute')->where('attribute_id',$attribute_id)->get();
        $manager_attribute = view('attribute.edit_attribute')->with('edit_attribute',$edit_attribute)->with('cate_attribute',$cate_attribute)->with('brand_attribute',$brand_attribute);
        return view('admin_layout')->with('attribute.edit_attribute', $manager_attribute);
    }

    //Cập nhật dữ liệu sản phẩm
    public function update_attribute(Request $request, $attribute_id)
    {
        $this->AuthLogin();

        $data = array();
        $data['attribute_name'] = $request->attribute_name;
        $data['attribute_desc'] = $request->attribute_desc;
        $data['attribute_content'] = $request->attribute_content;
        $data['attribute_price'] = $request->attribute_price;
        $data['attribute_size'] = $request->attribute_size;
        $data['attribute_color'] = $request->attribute_color;
        $data['category_id'] = $request->cate_attribute;
        $data['brand_id'] = $request->brand_attribute;
        $data['attribute_status'] = $request->attribute_status;
         //Kiểm tra hình ảnh
        $get_image = $request->file('attribute_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalExtension();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('upload/attributes',$new_image);
            $data['attribute_image'] = $new_image;
 
            DB::table('tbl_attribute')->where('attribute_id',$attribute_id)->update($data);
            Session::put('message', 'Cập nhật sản phẩm thành công');
            return Redirect::to('list-attribute');
        }

        DB::table('tbl_attribute')->where('attribute_id',$attribute_id)->update($data);
        Session::put('message', 'Cập nhật sản phẩm thành công');
        return Redirect::to('list-attribute');
    }

    public function active_attribute($attribute_id)
    {
        $this->AuthLogin();

        DB::table('tbl_attribute')->where('attribute_id', $attribute_id)->update(['attribute_status' => 0]);
        Session::put('message', 'Kích hoạt thương hiệu thành công');
        return Redirect::to('list-attribute');
    }

    


    public function unactive_attribute($attribute_id)
    {
        $this->AuthLogin();

        DB::table('tbl_attribute')->where('attribute_id', $attribute_id)->update(['attribute_status' => 1]);
        Session::put('message', 'Kích hoạt thương hiệu thành công');
        return Redirect::to('list-attribute');
    }


    ///xosa
    public function delete_attribute($attribute_id)
    {
        $this->AuthLogin();

        $edit_brand = DB::table('tbl_attribute')->where('attribute_id',$attribute_id)->delete();
        Session::put('message', 'Xóa thành công');
        return Redirect::to('list-attribute');
    }
}
