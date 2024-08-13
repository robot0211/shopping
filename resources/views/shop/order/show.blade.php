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

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>Chi tiết đơn hàng #{{ $order->id }}</h3>

            <table class="table">
                <thead>
                    <tr>
                        <th>Hình ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Tổng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->orderDetails as $detail)
                    <tr>
                        <td><img src="{{ $detail->product->feature_image_path }}" width="100" height="100" alt="Image"></td>
                        <td>{{ $detail->product->name }}</td>
                        <td>{{ $detail->quantity }}</td>
                        <td>{{ number_format($detail->price) }} VND</td>
                        <td>{{ number_format($detail->price * $detail->quantity) }} VND</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="text-right">
                <h4>Tổng cộng: {{ number_format($order->total_price) }} VND</h4>
            </div>
        </div>
    </div>
</div>

@endsection