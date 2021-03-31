

@extends('layout')
@section('content')

<h2 style="margin-left:270px;color:#0c8a06"> Giỏ Hàng Của Bạn</h2>
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
                            <tr style="font-weight:bold;font-size: 25px;color:#0c8a06">
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
									<input class="cart_quantity_input" type="number" name="cart_quantity" value="{{$value_content->qty}}" >
									<input type="hidden" value="{{$value_content->rowId}} "name="rowId_cart" class="form-control">
									<input style="color:white;background-color:green" type="submit" value="Cập nhật" name="update_qty" class="btn btn-default btn-sm">
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
            <div class="row">
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>
                            <li>Tổng <span>{{(cart::subtotal())}}</span></li>
                            <li>Thuế VAT <span>{{(cart::tax())}}</span></li>
                            <li>Phí vận chuyển <span>0</span></li>
                            <li>Thành tiền <span>{{(cart::total())}}</span></li>


                        </ul>
                        <?php
                                $customer_id= Session::get('customer_id');
                                if($customer_id != NULL){
                            ?>
                               <a  class="primary-btn" href="{{URL::to('/checkout')}}">Thanh Toán</a>

                            <?php
                                } else {
                            ?>
                                <a  class="primary-btn" href="{{URL::to('/login-checkout')}}">Thanh toán</a>
                            <?php
                                }
                            ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->
@endsection()
