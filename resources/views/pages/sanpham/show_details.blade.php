@extends('layout')
@section('content')
<section class="product-details spad">
        <div class="container">
        @foreach($product_details as $key => $value)
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large"
                                src="{{URL::to('/public/uploads/product/'.$value->product_image)}}" alt="">
                        </div>
                        <div class="product__details__pic__slider owl-carousel">
                            <img data-imgbigurl="img/product/details/product-details-2.jpg"
                                src="img/product/details/thumb-1.jpg" alt="">
                            <img data-imgbigurl="img/product/details/product-details-3.jpg"
                                src="img/product/details/thumb-2.jpg" alt="">
                            <img data-imgbigurl="img/product/details/product-details-5.jpg"
                                src="img/product/details/thumb-3.jpg" alt="">
                            <img data-imgbigurl="img/product/details/product-details-4.jpg"
                                src="img/product/details/thumb-4.jpg" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3>{{$value->product_name}}</h3>
                        <div class="product__details__rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>

                        </div>
                        <form action="{{URL::to('/save-cart')}}" method="post">
                            {{csrf_field()}}
                        <div class="product__details__price">{{number_format($value->product_price).' '.'VND'}}</div>
                        </div>

                        <input  name="qty" type="number" min="1" value="1">
                        <input name="productid_hidden" type="hidden" value="{{$value->product_id}}" />
                            <button type="submit" class="primary-btn">ADD TO CARD</button>
                        </form> </br>

                            <b>Availability</b> <span>In Stock</span> </br>
                            <b>Shipping</b> <span>01 day shipping. <samp>Free pickup today</samp></span></br>
                            <b>Brand</b> <span>{{$value->brand_name}}</span></br>
                            <b>Category</b> <span>{{$value->category_name}}</span></br>
                            <b>Share on</b>
                                <div class="share">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            @endforeach
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                    aria-selected="true">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                    aria-selected="false">Information</a>
                            </li>

                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">

                                    <p>{!!$value->product_desc!!}</p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <div class="product__details__tab__desc">

                                    <p>{!!$value->product_content!!}</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Related Product</h2>
                    </div>
                </div>
            </div>
            <div class="row">
            @foreach($relate as $key => $lienquan)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="{{URL::to('/public/uploads/product/'.$lienquan->product_image)}}">
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="{{URL::to('/chi-tiet-san-pham/'.$lienquan->product_id)}}"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="#">{{$lienquan->product_name}}</a></h6>
                            <h5>{{number_format($lienquan->product_price).' '.'VND'}}</h5>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </section>
@endsection
