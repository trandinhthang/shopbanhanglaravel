@extends('layout')
@section('content')

<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <form action="{{URL::to('/save-checkout-customer')}}" method="post">
            {{csrf_field()}}
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="checkout__order">
                            <h4>Thông tin giao hàng</h4>
                            <div class="col-lg-12">
                                <div class="checkout__input">
                                    <p>Họ và tên <span>*</span></p>
                                    <input name="shipping_name" type="text">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="checkout__input">
                                    <p>Email <span>*</span></p>
                                    <input name="shipping_email" type="email">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="checkout__input">
                                    <p>Số điện thoại<span>*</span></p>
                                    <input name="shipping_phone" type="text">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="checkout__input">
                                    <p>Địa chỉ<span>*</span></p>
                                    <input name="shipping_address" type="text">
                                </div>
                            </div>

                            <button type="submit" class="site-btn">Thanh toán</button>

                        </div>

                    </div>
                </div>
            </form>
        </div>

    </div>
</section>
<!-- Checkout Section End -->
@endsection()
