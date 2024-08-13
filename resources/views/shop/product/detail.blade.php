@extends('layouts.home')

@section('title')
<title>Detail | NPC-Shop</title>
@endsection

@section('css')
<link href="{{ asset('shops/home/home.css') }}" rel="stylesheet">
<link href="{{ asset('shops/product/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('shops/product/css/lightbox.min.css') }}" rel="stylesheet">
@endsection

@section('js')
<link href="{{ asset('shops/home/home.js') }}" rel="stylesheet">
<script>
    function addToCart(button) {
        let productId = button.getAttribute('data-product-id');
        console.log('Đang thêm sản phẩm vào giỏ hàng:', productId);
        let quantity = document.getElementById('quantity').value;

        fetch("{{ route('cart.add') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                id: productId,
                quantity: quantity
            })
        }).then(response => {
            return response.json();
        }).then(data => {
            alert('Sản phẩm đã được thêm vào giỏ hàng!');
        }).catch(error => {
            console.error('Lỗi:', error);
        });
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const thumbnails = document.querySelectorAll('.thumbnail');
        const mainImage = document.getElementById('main-product-image');
        const zoomLink = document.querySelector('.zoom-title a');

        thumbnails.forEach(function(thumbnail) {
            thumbnail.addEventListener('click', function(event) {
                event.preventDefault();
                const newImageSrc = thumbnail.getAttribute('data-image');
                mainImage.src = newImageSrc;
                zoomLink.href = newImageSrc;
            });
        });
    });
</script>
<script>
    // Lấy ngày giờ hiện tại
    var currentDateTime = new Date();

    // Định dạng ngày giờ
    var formattedTime = currentDateTime.toLocaleTimeString('en-US', {
        hour: 'numeric',
        minute: 'numeric',
        hour12: true
    }); // Ví dụ: 12:41 PM
    var formattedDate = currentDateTime.toLocaleDateString('en-US', {
        day: 'numeric',
        month: 'short',
        year: 'numeric'
    }); // Ví dụ: 31 Dec 2014

    // Lấy khu vực của người dùng
    var userTimezone = Intl.DateTimeFormat().resolvedOptions().timeZone;

    // Đưa dữ liệu vào thẻ span
    document.getElementById('current-time').textContent = formattedTime;
    document.getElementById('current-date').textContent = formattedDate;
    document.getElementById('user-timezone').textContent = userTimezone;
</script>
<script src="{{ asset('shops/product/js/jquery-3.3.1.slim.min.js') }}"></script>
<!-- Include Popper.js -->
<script src="{{ asset('shops/product/js/popper.min.js') }}"></script>
<!-- Include Bootstrap JS -->
<script src="{{ asset('shops/product/js/bootstrap.min.js') }}"></script>
<!-- Include Lightbox JS -->
<script src="{{ asset('shops/product/js/lightbox.min.js') }}"></script>
@endsection


@section('content')



<section>
    <div class="container">

        <div class="row">
            @include('shopPartials.sidebar')

            <div class="col-sm-9 padding-right">

                <div class="product-details"><!--product-details-->
                    <h2 class="title text-center">Product Detail</h2>
                    <div class="col-sm-5">
                        <div class="view-product">
                            <a href="{{ $product->feature_image_path }}" data-lightbox="product-image">
                                <img id="main-product-image" src="{{ $product->feature_image_path }}" alt="Product Image" class="img-fluid" />
                            </a>
                            <h3 class="zoom-title"><a href="{{ $product->feature_image_path }}" data-lightbox="product-image">ZOOM</a></h3>
                        </div>

                        <div id="similar-product" class="carousel slide" data-ride="carousel">
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                                @foreach($product->images->chunk(3) as $key => $chunk)
                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                    <div class="row">
                                        @foreach($chunk as $productImageItem)
                                        <div class="col-md-4">
                                            <a href="#" class="thumbnail" data-image="{{ $productImageItem->image_path }}">
                                                <img src="{{ $productImageItem->image_path }}" class="d-block w-100" alt="Product Image">
                                            </a>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <!-- Controls -->
                            <a class="carousel-control-prev" href="#similar-product" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#similar-product" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>

                    </div>
                    <div class="col-sm-7">
                        <div class="product-information"><!--/product-information-->
                            <img src="images/product-details/new.jpg" class="newarrival" alt="" />
                            <h2>{{ $product->name }}</h2>
                            <p>Web ID: {{ $product->id }}</p>
                            <img src="images/product-details/rating.png" alt="" />
                            <span>
                                <span>{{ number_format($product->price) }}</span>
                                <label>Quantity:</label>
                                <input type="number" value="1" min="1" max="100" id="quantity" />
                                <button type="button" class="btn btn-fefault cart" data-product-id="{{ $product->id }}" onclick="addToCart(this)">
                                    <i class="fa fa-shopping-cart"></i>
                                    Add to cart
                                </button>
                            </span>
                            <p><b>Availability:</b> In Stock</p>
                            <p><b>Condition:</b> New</p>
                            <p><b>Brand:</b> NPC-SHOP</p>
                            <a href=""><img src="{{ asset('publicShop/images/product-details/share.png') }}" class="share img-responsive" alt="" /></a>
                            
                        </div><!--/product-information-->
                    </div>
                </div><!--/product-details-->

                <div class="category-tab shop-details-tab"><!--category-tab-->
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs">
                            <li><a href="#Similar" data-toggle="tab">Similar</a></li>
                            <li><a href="#detail" data-toggle="tab">Detail</a></li>
                            <li><a href="#tag" data-toggle="tab">Tag</a></li>
                            <li class="active"><a href="#reviews" data-toggle="tab">Reviews (5)</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade" id="Similar">
                            @foreach($similarProducts as $similarProductItem)
                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="{{ $similarProductItem->feature_image_path }}" alt="" />
                                            <h2>{{ number_format($similarProductItem->price) }} VNĐ</h2>
                                            <p>{{ $similarProductItem->name }}</p>
                                            <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Product Detail</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="tab-pane fade" id="detail">
                            <div class="col-md-12">
                                <h3>Mô tả sản phẩm</h3></br>
                                <h5>{!! $product->content !!}</h5>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="tag">
                            <div class="col-md-12">
                                <h3>Tags liên quan</h3></br>
                                @foreach($product->tags as $productTagItem)
                                <h5>#{{ $productTagItem->name }}</h5>
                                @endforeach
                            </div>
                        </div>

                        <div class="tab-pane fade active in" id="reviews">
                            <div class="col-sm-12">
                                <ul>
                                    <li><a href="#"><i class="fa fa-globe icon"></i><span id="user-timezone"></span></a></li>
                                    <li><a href="#"><i class="fa fa-clock-o"></i><span id="current-time"></span></a></li>
                                    <li><a href="#"><i class="fa fa-calendar-o"></i><span id="current-date"></span></a></li>

                                </ul>
                                <h4>Mỗi đánh giá không chỉ là một câu chuyện về sản phẩm, mà còn là hành trình khám phá sự thật dựa trên trải nghiệm thực tế của từng người dùng.</h5>
                                    <p><b>Write Your Review</b></p>

                                    <form action="#">
                                        <span>
                                            <input type="text" placeholder="Your Name" />
                                            <input type="email" placeholder="Email Address" />
                                        </span>
                                        <textarea name=""></textarea>
                                        <b>Rating: </b> <img src="{{ asset('publicShop/images/product-details/rating.png') }}" alt="" />
                                        <button type="button" class="btn btn-default pull-right">
                                            Submit
                                        </button>
                                    </form>
                            </div>
                        </div>

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