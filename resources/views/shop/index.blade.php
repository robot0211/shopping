@extends('layouts.home')

@section('title')
<title>Home | NPC-Shop</title>
@endsection

@section('css')
<link href="{{ asset('shops/home/home.css') }}" rel="stylesheet">
@endsection

@section('js')
<link href="{{ asset('shops/home/home.js') }}" rel="stylesheet">

@endsection


@section('content')

<section id="slider"><!--slider-->
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div id="slider-carousel" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
						<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
						<li data-target="#slider-carousel" data-slide-to="1"></li>
						<li data-target="#slider-carousel" data-slide-to="2"></li>
					</ol>

					<div class="carousel-inner">

						@foreach($sliders as $key => $slider)
						<div class="item {{ $key == 1 ? 'active' : '' }}">
							<div class="col-sm-6 content-section">
								<h1><span>NPC</span>-SHOP</h1>
								<h2>{{ $slider->name }}</h2>
								<p>{{ $slider->description }}</p>
								<button type="button" class="btn btn-default get">Get it now</button>
							</div>
							<div class="col-sm-6 image-section">
								<img src="{{ $slider->image_path }}" class="girl img-responsive" alt="" />
								<img src="" class="pricing" alt="" />
							</div>

						</div>
						@endforeach

					</div>

					<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
						<i class="fa fa-angle-left"></i>
					</a>
					<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
						<i class="fa fa-angle-right"></i>
					</a>
				</div>

			</div>
		</div>
	</div>
</section><!--/slider-->

<section>
	<div class="container">
		<div class="row">
			@include('shopPartials.sidebar')

			<div class="col-sm-9 padding-right">
				<div class="features_items"><!--features_items-->
					<h2 class="title text-center">Features Items</h2>
					@foreach($featureProducts as $featureProductItem)
					<div class="col-sm-4 product-item">
						<div class="product-image-wrapper">
							<div class="single-products">
								<div class="productinfo text-center">
									<img src="{{ $featureProductItem->feature_image_path }}" alt="" />
									<h2>{{ number_format($featureProductItem->price) }} VNĐ</h2>
									<p>{{ $featureProductItem->name }}</p>
									<a href="{{ route('productDetail', ['product_id' => $featureProductItem->id]) }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Product Detail</a>
								</div>
								<div class="product-overlay">
									<div class="overlay-content">
										<h2>{{ number_format($featureProductItem->price) }} VNĐ</h2>
										<p>{{ $featureProductItem->name }}</p>
										<a href="{{ route('productDetail', ['product_id' => $featureProductItem->id]) }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Product Detail</a>
									</div>
								</div>
							</div>
							<div class="choose">
								<ul class="nav nav-pills nav-justified">
									<li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
									<li><a href="#"><i class="fa fa-plus-square"></i>Add to cart</a></li>
								</ul>
							</div>
						</div>
					</div>
					@endforeach

				</div><!--features_items-->

				<div class="category-tab"><!--category-tab-->
					<div class="col-sm-12">
						<ul class="nav nav-tabs">
							@foreach($featureCategories as $key => $featureCaregoryItem)
							<li class="{{ $key == 0 ? 'active' : '' }}"><a href="#{{ $featureCaregoryItem->id }}" data-toggle="tab">{{ $featureCaregoryItem->name }}</a></li>
							@endforeach
						</ul>
					</div>
					<div class="tab-content">
						@foreach($featureCategories as $key => $featureCaregoryItem)

						<div class="tab-pane fade {{ $key == 0 ? 'active' : '' }} in" id="{{ $featureCaregoryItem->id }}">
							@foreach($featureCaregoryItem->products->take(4) as $productItem)
							<div class="col-sm-3">
								<div class="product-image-wrapper">
									<div class="single-products">
										<div class="productinfo text-center">
											<img src="{{ $productItem->feature_image_path }}" alt="" />
											<h2>{{ number_format($productItem->price) }} VNĐ</h2>
											<p>{{ $productItem->name }}</p>
											<a href="{{ route('productDetail', ['product_id' => $productItem->id]) }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Product Detail</a>
										</div>

									</div>
								</div>
							</div>
							@endforeach
						</div>

						@endforeach
					</div>
				</div><!--/category-tab-->

				<div class="recommended_items"><!--recommended_items-->
					<h2 class="title text-center">recommended items</h2>

					<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner">
							<div class="item active">
								@foreach($featureProducts->take(3) as $featureProductItem)
								<div class="col-sm-4">
									<div class="product-image-wrapper recommended-products">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="{{ $featureProductItem->feature_image_path }}" alt="" />
												<h2>{{ number_format($featureProductItem->price) }} VNĐ</h2>
												<p>{{ $featureProductItem->name }}</p>
												<a href="{{ route('productDetail', ['product_id' => $featureProductItem->id]) }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Product Detail</a>
											</div>

										</div>
									</div>

								</div>
								@endforeach
							</div>
							<div class="item">
								@foreach($featureProducts->slice(3,3) as $featureProductItem)
								<div class="col-sm-4">
									<div class="product-image-wrapper recommended-products">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="{{ $featureProductItem->feature_image_path }}" alt="" />
												<h2>{{ number_format($featureProductItem->price) }} VNĐ</h2>
												<p>{{ $featureProductItem->name }}</p>
												<a href="{{ route('productDetail', ['product_id' => $featureProductItem->id]) }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Product Detail</a>
											</div>

										</div>
									</div>
								</div>
								@endforeach
							</div>
						</div>
						<a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
				</div><!--/recommended_items-->

			</div>
		</div>
	</div>
</section>


@endsection