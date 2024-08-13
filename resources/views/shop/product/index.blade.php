@extends('layouts.home')

@section('title')
<title>Products | NPC-Shop</title>
@endsection

@section('css')
<link href="{{ asset('shops/home/home.css') }}" rel="stylesheet">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
@endsection

@section('js')
<link href="{{ asset('shops/home/home.js') }}" rel="stylesheet">
@endsection


@section('content')


<section>
	<div class="container">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
				<li><a href="#">Home</a></li>
				<li class="active">Products</li>
			</ol>
		</div><!--/breadcrums-->
		<div class="row">
			@include('shopPartials.sidebar')

			<div class="col-sm-9 padding-right">
				<div class="features_items"><!--features_items-->
					<div class="col md-12">
						<label for="">
							<form action="{{ route('productList') }}" method="GET" class="form-inline">
								<label for="perPage" class="mr-2">Show</label>
								<input type="hidden" name="query" value="{{ request()->get('query') }}">
								<input type="hidden" name="category_id" value="{{ request()->get('category_id') }}">
								<select name="perPage" id="perPage" class="form-control" onchange="this.form.submit()">
									<option value="5" {{ request()->get('perPage') == 5 ? 'selected' : '' }}>5</option>
									<option value="10" {{ request()->get('perPage') == 10 ? 'selected' : '' }}>10</option>
									<option value="25" {{ request()->get('perPage') == 25 ? 'selected' : '' }}>25</option>
									<option value="50" {{ request()->get('perPage') == 50 ? 'selected' : '' }}>50</option>
									<option value="100" {{ request()->get('perPage') == 100 ? 'selected' : '' }}>100</option>
								</select>
								<label for="perPage" class="ml-2">entries</label>
							</form>
						</label>
					</div>
					<h2 class="title text-center">Product List</h2>
					@foreach($products as $product)
					<div class="col-sm-4">
						<div class="product-image-wrapper">
							<div class="single-products">
								<div class="productinfo text-center">
									<img src="{{ $product->feature_image_path }}" alt="" />
									<h2>{{ number_format($product->price) }} VNĐ</h2>
									<p>{{ $product->name }}</p>
									<a href="{{ route('productDetail', ['product_id' => $product->id]) }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Product Detail</a>
								</div>
								<div class="product-overlay">
									<div class="overlay-content">
										<h2>{{ number_format($product->price) }} VNĐ</h2>
										<p>{{ $product->name }}</p>
										<a href="{{ route('productDetail', ['product_id' => $product->id]) }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Product Detail</a>
									</div>
								</div>
							</div>
							<div class="choose">
								<ul class="nav nav-pills nav-justified">
									<li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
									<li><a href=""><i class="fa fa-plus-square"></i>Add to cart</a></li>
								</ul>
							</div>
						</div>
					</div>
					@endforeach
				</div><!--features_items-->
				{{ $products->links('pagination::bootstrap-5') }}

			</div>
		</div>
	</div>
</section>


@endsection