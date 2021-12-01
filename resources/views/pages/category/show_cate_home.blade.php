@extends('welcome')
@section('content')
<div class="features_items">
    <!--features_items-->
    <h2 class="title text-center">Danh mục Sản phẩm</h2>
    @foreach($category_by_id as $pro)
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">

                <div class="productinfo text-center">
                    <a href="{{asset('/chi-tiet-san-pham/' . $pro->product_id)}}">
                        <img src="{{asset('upload/products')}}/{{$pro->product_image}}" height="200px"
                            class="img img-fluid" alt="" />
                    </a>

                    <h2>{{$pro->product_price.' '.'VNĐ'}}</h2>
                    <p>{{$pro->product_name}}</p>
                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng
                    </a>

                </div>

            </div>
            <div class="choose">
                <ul class="nav nav-pills nav-justified">
                    <li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
                    <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                </ul>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection