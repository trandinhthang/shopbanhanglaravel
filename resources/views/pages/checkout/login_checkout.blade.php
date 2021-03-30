

@extends('layout')
@section('content')
    <!-- Checkout Section End -->
    <section id=""><!--form-->
	<div style="padding-left:200px;padding-bottom:50px" class="">

		<div class="row">
			<div class="col-sm-4 col-sm-offset-1">
            <h4 style="font-weight:bold">Đăng nhập</h4>
            <form action="{{URL::to('/login-customer')}}" method="post">
            {{csrf_field()}}
            <div style="padding-top:20px" class="checkout__input">
                        <p>Email<span>*</span></p>
                        <input name="email_account" type="email">
                    </div>
                    <div class="checkout__input">
                        <p>Mật khẩu<span>*</span></p>
                        <input name="password_account" type="password">
                    </div>
                    <button type="submit" class="site-btn">Đăng nhập</button>
                    </form>
			</div>



			<div style="padding-left:50px" class="col-sm-1">
				<h2 class="or">HOẶC</h2>
			</div>




			<div style="padding-left:50px" class="col-sm-5">
				<div class="signup-form"><!--sign up form-->
                <div class="checkout__order">
                <form action="{{URL::to('/add-customer')}}" method="post">
                 {{csrf_field()}}
                    <h4>Đăng kí</h4>
                    <div class="checkout__input">
                        <p>Name<span>*</span></p>
                        <input name="customer_name" type="text">
                    </div>
                    <div class="checkout__input">
                        <p>Email<span>*</span></p>
                        <input name="customer_email" type="email">
                    </div>
                    <div class="checkout__input">
                        <p>Pasword<span>*</span></p>
                        <input name="customer_password" type="password">
                    </div>

                    <button type="submit" class="site-btn">Đăng kí</button>
                    </form>
                </div>

				</div><!--/sign up form-->
			</div>
		</div>
	</div>
</section><!--/form-->

@endsection()
