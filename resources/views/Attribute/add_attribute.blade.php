@extends('admin_layout');
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <?php 
            $message = Session::get('message');
            if($message){
                echo '<span class = "text-alert">' . $message . '</span>';
                Session::put('message',null);
            }

	?>
            <header class="panel-heading">
                <b>Attribute</b>
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{asset('/save-attribute')}}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="attribute_name">Tên thuộc tính: </label>
                            <input type="text" name="attribute_name" class="form-control" id="attribute_name"
                                placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="attribute_name">Mô tả: </label>
                            <input type="text" name="attribute_desc" class="form-control" id="attribute_desc"
                                placeholder="Mô tả thuộc tính">
                        </div>
                        <div class="form-group">
                            <label for="cate_product">Danh mục sản phẩm: </label>
                            <select class="form-control input-sm m-bot15" name="attribute_cate" id="cate_product">
                                @foreach($cate_attribute as $cate)
                                    <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="show">Hiển thị: </label>
                            <select class="form-control input-sm m-bot15" name="category_status" id="show">
                                <option value="1">Hiện</option>
                                <option value="0">Ẩn</option>
                            </select>
                        </div>
                        <button type="submit" name="add_attribute" class="btn btn-info">Thêm</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
    @endsection