@extends('admin_layout');
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <?php
            $message = Session::get('message');
            if ($message) {
                echo '<span class = "text-alert">' . $message . '</span>';
                Session::put('message', null);
            }

            ?>
            <header class="panel-heading">
                <b>Sửa thương hiệu sản phẩm</b>
            </header>
            <div class="panel-body">
                @foreach($edit_category as $edit)
                <div class="position-center">
                    <form role="form" action="{{asset('/update-category-product/' . $edit->category_id)}}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="category_name">Tên thương hiệu: </label>
                            <input type="text" name="category_name" class="form-control" id="category_name" value="{{$edit->category_name}}" placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="category_desc">Mô tả: </label>
                            <textarea style="resize: none" class="form-control" name="category_desc" id="category_desc" cols="80" rows="10">
                            {{$edit->category_desc}}
                            </textarea>
                        </div>

                        <button type="submit" name="edit_category" class="btn btn-info">Sửa</button>
                    </form>
                </div>
                @endforeach
            </div>
        </section>
    </div>
    @endsection