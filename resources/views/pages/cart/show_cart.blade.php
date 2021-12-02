@extends('welcome')
@section('content')
<section id="cart_items">
    <div class="breadcrumbs">
        <ol class="breadcrumb">
            <li><a href="{{asset('/')}}">Trang chủ</a></li>
            <li class="active">Giỏ hàng của bạn</li>
        </ol>
    </div>
    <div class="table-responsive cart_info">
        <table class="table table-condensed">
            <thead>
                <?php 
                    $content = Cart::content();       
                ?>
                <tr class="cart_menu">
                    <td class="image">Hình ảnh</td>
                    <td class="description">Tên sản phẩm</td>
                    <td class="price">Giá</td>
                    <td class="quantity">Số lượng</td>
                    <td class="total">Tổng</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                @foreach($content as $v_content)
                <tr>
                    <td class="cart_product">
                        <a href=""><img width="80px" src="{{asset('upload/products/' . $v_content->options->images )}}"
                                alt=""></a>
                    </td>
                    <td class="cart_description">
                        <h4><a href="">{{$v_content->name}}</a></h4>
                        <p>{{'Web ID: ' . ' ' .$v_content->id}}</p>
                    </td>
                    <td class="cart_price">
                        <p>{{number_format($v_content->price) . ' VNĐ'}}</p>
                    </td>
                    <td class="cart_quantity">
                        <div class="cart_quantity_button">
                            <form action="{{asset('/update-to-cart')}}" method="POST">
								{{csrf_field()}}
                                <input type="hidden" name="rowId" value="{{$v_content->rowId}}">
                                <input class="cart_quantity_input" type="number" name="quantity"
                                value="{{$v_content->qty}}" min="1">
                                <input type="submit" value="Cập nhật" name="update_qty" class="btn btn-default btn-sm">
                            </form>
                        </div>
                    </td>
                    <td class="cart_total">
                        <p class="cart_total_price">
                            <?php
                                        $sub_total = $v_content->price * $v_content->qty;

                                        echo number_format($sub_total) . ' VNĐ';
                                    ?>
                        </p>
                    </td>
                    <td class="cart_delete">
                        <a class="cart_quantity_delete" href="{{asset('/delete-to-cart/'.$v_content->rowId)}}"><i
                                class="fa fa-times"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
<!--/#cart_items-->
<section id="do_action">
    <!-- <div class="heading">
        <h3>What would you like to do next?</h3>
        <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery
            cost.</p>
    </div> -->
    <div class="row">
        <!-- <div class="col-sm-6">
            <div class="chose_area">
                <ul class="user_option">
                    <li>
                        <input type="checkbox">
                        <label>Use Coupon Code</label>
                    </li>
                    <li>
                        <input type="checkbox">
                        <label>Use Gift Voucher</label>
                    </li>
                    <li>
                        <input type="checkbox">
                        <label>Estimate Shipping & Taxes</label>
                    </li>
                </ul>
                <ul class="user_info">
                    <li class="single_field">
                        <label>Country:</label>
                        <select>
                            <option>United States</option>
                            <option>Bangladesh</option>
                            <option>UK</option>
                            <option>India</option>
                            <option>Pakistan</option>
                            <option>Ucrane</option>
                            <option>Canada</option>
                            <option>Dubai</option>
                        </select>

                    </li>
                    <li class="single_field">
                        <label>Region / State:</label>
                        <select>
                            <option>Select</option>
                            <option>Dhaka</option>
                            <option>London</option>
                            <option>Dillih</option>
                            <option>Lahore</option>
                            <option>Alaska</option>
                            <option>Canada</option>
                            <option>Dubai</option>
                        </select>

                    </li>
                    <li class="single_field zip-field">
                        <label>Zip Code:</label>
                        <input type="text">
                    </li>
                </ul>
                <a class="btn btn-default update" href="">Get Quotes</a>
                <a class="btn btn-default check_out" href="">Continue</a>
            </div>
        </div> -->
        <div class="col-sm-6">
            <div class="total_area">
                <ul>
                    <li>Tổng tiền
                        <span>
                            {{Cart::priceTotal(0,',','.') . ' VNĐ'}}
                        </span>
                    </li>
                    <li>Thuế <span>{{Cart::tax(0,',','.').' VNĐ'}}</span></li>
                    <li>Phí vận chuyển <span>Free</span></li>
                    <li>Thành tiền <span>{{Cart::total(0,',','.').' VNĐ'}}</span></li>
                </ul>
                
                <a class="btn btn-default check_out" href="{{asset('/login-checkout')}}">Thanh toán</a>
            </div>
        </div>
    </div>
</section>
<!--/#do_action-->
@endsection