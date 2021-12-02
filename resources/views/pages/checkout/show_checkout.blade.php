@extends('welcome')
@section('content')
<section id="cart_items">
    <div class="breadcrumbs">
        <ol class="breadcrumb">
            <li><a href="{{asset('/')}}">Trang chủ</a></li>
            <li class="active">Thanh toán</li>
        </ol>
    </div>
    <!--/breadcrums-->

    
    <div class="register-req">
        <p>Làm ơn đăng nhập để thanh toán giỏ hàng. Xem lại lịch sử mua hàng</p>
    </div>
    <!--/register-req-->

    <div class="shopper-informations">
        <div class="row">
            <div class="col-sm-5 clearfix">
                <div class="bill-to">
                    <p>Điền thông tin gửi hàng</p>
                    <div class="form-one">
                        <form action="{{asset('/save-checkout-customer')}}" method="POST">
                            {{csrf_field()}}
                            <input type="text" name="shipping_email" placeholder="Email">
                            <input type="text" name="shipping_name" placeholder="Họ và tên*">
                            <input type="text" name="shipping_address" placeholder="Địa chỉ">
                            <input type="text" name="shipping_phone" placeholder="Phone *">
                            <input type="submit" value="Gửi" name="send_order" class="btn btn-primary btn-sm">


                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="order-message">
                    <p>Ghi chú</p>
                    <textarea name="message" placeholder="Ghi chú thông tin cần thiết để thuận tiện trong việc giao hàng!"
                        rows="16"></textarea>
                    <label><input type="checkbox"> Shipping to bill address</label>
                </div>
            </div>
        </div>
    </div>
    <div class="review-payment">
        <h2>Review & Payment</h2>
    </div>

   
    <div class="payment-options">
        <span>
            <label><input type="checkbox"> Direct Bank Transfer</label>
        </span>
        <span>
            <label><input type="checkbox"> Check Payment</label>
        </span>
        <span>
            <label><input type="checkbox"> Paypal</label>
        </span>
    </div>
</section>
<!--/#cart_items-->

@endsection