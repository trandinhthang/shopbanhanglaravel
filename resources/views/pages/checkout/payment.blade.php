@extends('layout')
@section('content')

<h1 style="margin-left:170px;color:#0c8a06"> Giỏ Hàng</h1>
 <section class="shoping-cart spad">
     <?php
        $content = Cart::content();
     ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                            <tr style="font-weight:bold;;color:#0c8a06">
                                <td class="image">Hình ảnh</td>
                                <td class="description">Chi tiết sản phẩm</td>
                                <td class="price">Giá (VND)</td>
                                <td class="quantity">Số lượng</td>
                                <td class="total">Tổng tiền (VND)</td>
                                <td></td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($content as $value_content)
                            <tr>
                                <td class="cart_product">
                                    <a href=""><img src="{{URL::to('/public/uploads/product/'.$value_content->options->image)}}" width="75" alt=""></a>
                                </td>
                                <td class="cart_description">
                                    <h4><a href="">{{$value_content->name}}</a></h4>

                                </td>
                                <td class="cart_price">
                                    <p>{{number_format($value_content->price)}}</p>
                                </td>
                                <td class="cart_quantity">
                                <div class="cart_quantity_button">
								<form action="{{URL::to('/update-cart')}}" method="POST">
									{{ csrf_field()}}
									<input class="cart_quantity_input" type="text" name="cart_quantity" value="{{$value_content->qty}}" >
									<input type="hidden" value="{{$value_content->rowId}} "name="rowId_cart" class="form-control">
									<input type="submit" value="Cập nhật" name="update_qty" class="btn btn-default btn-sm">
								</form>
							</div>
                                </td>
                                <td class="cart_total">
                                    <p class="cart_total_price">
                                        <?php
                                        $total=$value_content->price*$value_content->qty;
                                        echo number_format($total);
                                        ?>
                                    </p>
                                </td>
                                <td class="cart_delete">
                                    <a class="cart_quantity_delete" href="{{URL::to('/delete-cart/'.$value_content->rowId)}}"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                            @endforeach()
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="col-lg-4 col-md-6">
    <div style="margin-left:150px" class="checkout__order">
    <h4>Hình thức thanh toán</h4>
        <form action="{{URL::to('/order-place')}}" method="post">
        {{csrf_field()}}
            <div  class="checkout__input__checkbox">
            <label for="payment">
                Trực tiếp
                <input name="payment_option" value="1" type="radio" id="payment">
                <span class="checkmark"></span>
            </label>
            </div>
            <div class="checkout__input__checkbox">

                <label for="paypal">
                    Paypal
                    <input name="payment_option" value="2" type="radio" id="paypal">
                    <span class="checkmark"></span>
                </label>
            </div>
            <button type="submit" class="site-btn">Thanh toán</button>
        </form>
    </div>
    </div>

    <!-- Shoping Cart Section End -->
@endsection()
