@extends('layouts.home')

@section('title')
<title>Cart | NPC-Shop</title>
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

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>Shopping Cart</h3>

            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif

            @if(session('cart'))
            <table class="table">
                <thead>
                    <tr>
                        <th>Hình ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Tổng</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0 @endphp
                    @foreach(session('cart') as $id => $details)
                    @php $total += $details['price'] * $details['quantity'] @endphp
                    <tr>
                        <td><img src="{{ $details['image'] }}" width="100" height="100" alt="Image"></td>
                        <td>{{ $details['name'] }}</td>
                        <td>
                            <form action="{{ route('cart.update') }}" method="POST" style="display: flex;">
                                @csrf
                                <input type="hidden" name="id" value="{{ $id }}">
                                <input type="number" name="quantity" value="{{ $details['quantity'] }}" class="form-control" min="1">
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </form>
                        </td>
                        <td>{{ number_format($details['price']) }} VND</td>
                        <td>{{ number_format($details['price'] * $details['quantity']) }} VND</td>
                        <td>
                            <form action="{{ route('cart.remove') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $id }}">
                                <button type="submit" class="btn btn-danger">Xóa</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="text-right">
                <h4>Tổng cộng: {{ number_format($total) }} VND</h4>
                <form action="{{ route('checkout.view') }}" method="GET">
                    @csrf
                    <button type="submit" class="btn btn-success">Thanh toán</button>
                </form>
            </div>
            @else
            <p>Giỏ hàng của bạn đang trống.</p>
            @endif
        </div>
    </div>
</div>

@endsection