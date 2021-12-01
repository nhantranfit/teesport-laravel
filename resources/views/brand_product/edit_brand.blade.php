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
                <b>Sửa thương hiệu sản phẩm</b>
            </header>
            <div class="panel-body">
                @foreach($edit_brand as $edit)
                <div class="position-center">
                    <form role="form" action="{{asset('/update-brand-product/' . $edit->brand_id)}}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="category_name">Tên thương hiệu: </label>
                            <input type="text" name="brand_name" class="form-control" id="brand_name" value="{{$edit->brand_name}}" placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="brand_desc">Mô tả: </label>
                            <textarea style="resize: none" class="form-control" name="brand_desc" id="brand_desc" value="{{$edit->brand_desc}}"
                                cols="80" rows="10"></textarea>
                        </div>
                
                        <button type="submit" name="add_brand" class="btn btn-info">Sửa</button>
                    </form>
                </div>
                @endforeach
            </div>
        </section>
    </div>
    @endsection