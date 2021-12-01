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
                <b>Sản phẩm</b>
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{asset('/save-product')}}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="product_name">Tên sản phẩm: </label>
                            <input type="text" name="product_name" class="form-control" id="product_name" placeholder="Tên sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="product_desc">Mô tả sản phẩm: </label>
                            <textarea style="resize: none" class="form-control" name="product_desc" id="product_desc" cols="80" rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="product_content">Nội dung sản phẩm: </label>
                            <textarea style="resize: none" class="form-control" name="product_content" id="product_content" cols="80" rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="product_price">Giá: </label>
                            <input type="text" name="product_price" class="form-control" id="product_price" placeholder="Giá">
                        </div>
                        <div class="form-group">
                            <label for="product_image">Hình ảnh </label>
                            <input type="file" name="product_image" class="form-control" id="product_image">
                        </div>

                        <div class="form-group">
                            <label for="product_color">Màu: </label>
                            <select class="form-control input-sm m-bot15" name="product_color" id="product_color">
                                <option value="Đỏ">Đỏ</option>
                                <option value="Vàng">Vàng</option>
                                <option value="Xanh">Xanh</option>
                                <option value="Đen">Đen</option>
                                <option value="Cam">Cam</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cate_product">Danh mục sản phẩm: </label>
                            <select class="form-control input-sm m-bot15" name="cate_product" id="cate_product">
                                @foreach($cate_product as $cate)
                                <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="product_att">Thuộc tính: </label>
                            <select class="form-control input-sm m-bot15" name="product_att" id="product_att">

                                @foreach($att_product as $att)
                                <option value="{{$att->attribute_id}}">{{$att->attribute_desc}}</option>
                                @endforeach

                            </select>
                        </div>


                        <div class="form-group">
                            <label for="brand_product">Nhãn hàng: </label>
                            <select class="form-control input-sm m-bot15" name="brand_product" id="brand_product">
                                @foreach($brand_product as $brand)
                                <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="product_status">Hiển thị: </label>
                            <select class="form-control input-sm m-bot15" name="product_status" id="product_status">
                                <option value="1">Hiện</option>
                                <option value="0">Ẩn</option>
                            </select>
                        </div>

                        <button type="submit" name="add_brand" class="btn btn-info">Thêm sản phẩm</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection