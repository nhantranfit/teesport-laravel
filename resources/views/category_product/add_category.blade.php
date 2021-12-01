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
                <b>Thêm danh mục sản phẩm</b>
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{asset('/save-category-product')}}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="category_name">Tên danh mục: </label>
                            <input type="text" name="category_name" class="form-control" id="category_name"
                                placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="category_desc">Mô tả: </label>
                            <textarea style="resize: none" class="form-control" name="category_desc" id="category_desc"
                                cols="80" rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="show">Hiển thị: </label>
                            <select class="form-control input-sm m-bot15" name="category_status" id="show">
                                <option value="1">Hiện</option>
                                <option value="0">Ẩn</option>
                            </select>
                        </div>
                        <button type="submit" name="add_category" class="btn btn-info">Thêm danh mục</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
    @endsection