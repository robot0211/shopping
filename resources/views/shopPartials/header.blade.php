<header id="header"><!--header-->
	<div class="header_top"><!--header_top-->
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<div class="contactinfo">
						<ul class="nav nav-pills">
							<li><a href="#"><i class="fa fa-phone"></i>{{ getConfigValueSettingTable('contact_phone') }}</a></li>
							<li><a href="#"><i class="fa fa-envelope"></i>{{ getConfigValueSettingTable('email') }}</a></li>
						</ul>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="social-icons pull-right">
						<ul class="nav navbar-nav">
							<li><a href="{{ getConfigValueSettingTable('facebook_link') }}"><i class="fa fa-facebook"></i></a></li>
							<li><a href="{{ getConfigValueSettingTable('twitter_link') }}"><i class="fa fa-twitter"></i></a></li>
							<li><a href="{{ getConfigValueSettingTable('linkedin_link') }}"><i class="fa fa-linkedin"></i></a></li>
							<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
							<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div><!--/header_top-->

	<div class="header-middle"><!--header-middle-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4">
					<div class="logo pull-left">
						<a href="index.html"><img src="{{ asset('publicShop/images/home/NPC.png') }}" alt="" /></a>
					</div>
				</div>
				<div class="col-sm-8">
					<div class="shop-menu pull-right">
						<ul class="nav navbar-nav">
							<li><a href="{{ route('infoUser') }}"><i class="fa fa-user"></i> Account</a></li>
							<li><a href="{{ route('wishlist.index') }}"><i class="fa fa-star"></i> Wishlist</a></li>
							<li><a href="{{ route('checkout.view') }}"><i class="fa fa-crosshairs"></i> Checkout</a></li>
							<li><a href="{{ route('cart.view') }}"><i class="fa fa-shopping-cart"></i> Cart</a></li>
							@if(Auth::guard('cus')->check())
							<li><a href="{{ route('customer.orders.index') }}"><i class="fa fa-shopping-cart"></i>Order</a></li>
							<li>
								<a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
									<i class="fa fa-sign-out"></i> Logout
								</a>
								<form id="logout-form" action="{{ route('logoutCustomer') }}" method="POST" style="display: none;">
									@csrf
								</form>
							</li>
							@else
							<li><a href="{{ route('customer.login') }}"><i class="fa fa-lock"></i> Login</a></li>
							<li><a href="{{ route('customer.register') }}"><i class="fa fa-lock"></i> Register</a></li>
							@endif
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div><!--/header-middle-->

	<div class="header-bottom"><!--header-bottom-->
		<div class="container">
			<div class="row">
				<div class="col-sm-9">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>
					@include('shopPartials.main_menu')
				</div>
				<div class="container mt-5 search_box">
					<form action="{{ route('productList') }}" method="GET" class="mb-4">
						<div class="input-group">
							<input type="hidden" name="perPage" value="{{ request()->get('perPage') }}">
							<input type="hidden" name="category_id" value="{{ request()->get('category_id') }}">
							<input type="search" name="query" class="form-control" placeholder="Nhập từ khóa tìm kiếm..." value="{{ $query }}">
							<div class="input-group-append">
								<button type="submit" class="btn btn-primary">Tìm kiếm</button>
							</div>
						</div>
					</form>

					@if(isset($query))
					@if(!$products->isEmpty())
					<div class="alert alert-success">
						<h3>Kết quả tìm kiếm cho: {{ $query }}</h3>
						<p>Có {{$products->total()}} sản phẩm được tìm thấy.</p>
					</div>
					@else
					<div class="alert alert-warning">
						<h3>Sản phẩm không tồn tại</h3>
					</div>
					@endif
					@endif

				</div>
			</div>
		</div>
	</div><!--/header-bottom-->
</header><!--/header-->