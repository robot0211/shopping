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
            <h3>Đơn hàng của tôi</h3>

            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            @if($orders->isEmpty())
                <p>Bạn chưa có đơn hàng nào.</p>
            @else
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tổng giá</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ number_format($order->total_price) }} VND</td>
                        <td>{{ $order->status }}</td>
                        <td>
                            <a href="{{ route('customer.orders.show', $order->id) }}" class="btn btn-info">Xem</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
</div>

@endsection