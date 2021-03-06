@extends('welcome')
@section('content')
<div class="product-details">
    <!--product-details-->
    <div class="col-sm-5">
        <div class="view-product">
            @foreach($product as $pro)
            <img src="{{asset('upload/products/'.$pro->product_image)}}" alt="" />
            <h3>ZOOM</h3>
            @endforeach
        </div>
        <div id="similar-product" class="carousel slide" data-ride="carousel">

            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <a href=""><img src="{{asset('frontend/images/similar1.jpg')}}" alt=""></a>
                    <a href=""><img src="{{asset('frontend/images/similar2.jpg')}}" alt=""></a>
                    <a href=""><img src="{{asset('frontend/images/similar3.jpg')}}" alt=""></a>
                </div>
                <div class="item">
                    <a href=""><img src="{{asset('frontend/images/similar1.jpg')}}" alt=""></a>
                    <a href=""><img src="{{asset('frontend/images/similar2.jpg')}}" alt=""></a>
                    <a href=""><img src="{{asset('frontend/images/similar3.jp')}}g" alt=""></a>
                </div>
                <div class="item">
                    <a href=""><img src="{{asset('frontend/images/similar1.jpg')}}" alt=""></a>
                    <a href=""><img src="{{asset('frontend/images/similar2.jpg')}}" alt=""></a>
                    <a href=""><img src="{{asset('frontend/images/similar3.jpg')}}" alt=""></a>
                </div>

            </div>

            <!-- Controls -->
            <a class="left item-control" href="#similar-product" data-slide="prev">
                <i class="fa fa-angle-left"></i>
            </a>
            <a class="right item-control" href="#similar-product" data-slide="next">
                <i class="fa fa-angle-right"></i>
            </a>
        </div>

    </div>
    <div class="col-sm-7">
        @foreach($product as $pro)
        <div class="product-information">
            <!--/product-information-->
            <img src="{{asset('frontend/images/new.jpg')}}" class="newarrival" alt="" />
            <h2>{{$pro->product_name}}</h2>
            <p>Web ID: {{$pro->product_id}}</p>
            <img src="images/product-details/rating.png" alt="" />

            <form action="{{asset('/save-cart/')}}" method="POST">
                {{csrf_field()}}
                <span>
                    <span>{{number_format($pro->product_price) . ' ' . 'VN??'}}</span>
                    <label>Quantity:</label>
                    <input name="quantity" type="number" min="1" value="1" />
                    <input name="productid_hidden" type="hidden" min="1" value="{{$pro->product_id}}" />
                    <button type="sumbit" class="btn btn-fefault cart">
                        <i class="fa fa-shopping-cart"></i>
                        Th??m gi??? h??ng
                    </button>
                </span>
            </form>

            <p><b>T??nh tr???ng:</b> C??n h??ng</p>
            <p><b>??i???u ki???n:</b> M???i 100%</p>
            <p><b>Nh??n h??ng:</b> {{$pro->brand_name}}</p>
            <p><b>Danh m???c:</b> {{$pro->category_name}}</p>

            <a href=""><img src="" class="share img-responsive" alt="" /></a>
        </div>


        <!--/product-information-->
    </div>

</div>
<div class="category-tab shop-details-tab">
    <!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#details" data-toggle="tab">Chi ti???t</a></li>
            <li><a href="#companyprofile" data-toggle="tab">Th??ng tin c??ng ty</a></li>
            <li><a href="#reviews" data-toggle="tab">????nh gi?? (5)</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade active in" id="details">
            {!!$pro->product_content!!}
        </div>
        <div class="tab-pane fade" id="companyprofile">
            {!!$pro->product_desc!!}
        </div>
        <div class="tab-pane fade" id="reviews">
            <div class="col-sm-12">
                <ul>
                    <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                    <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                    <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                </ul>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                <p><b>Write Your Review</b></p>

                <form action="#">
                    <span>
                        <input type="text" placeholder="Your Name" />
                        <input type="email" placeholder="Email Address" />
                    </span>
                    <textarea name=""></textarea>
                    <b>Rating: </b> <img src="images/product-details/rating.png" alt="" />
                    <button type="button" class="btn btn-default pull-right">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
<!--/category-tab-->

<div class="recommended_items">
    <!--recommended_items-->
    <h2 class="title text-center"> S???n ph???m li??n quan</h2>

    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="item active">
                @foreach($relate as $re)
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{asset('upload/products/'.$re->product_image)}}" height="200px" class="img img-fluid" alt="" />
                                <h2>{{number_format($re->product_price) . ' ' . 'VN??'}}</h2>
                                <p>{{$re->product_name}}</p>
                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
</div>
<!--/recommended_items-->
<!--/product-details-->
@endsection