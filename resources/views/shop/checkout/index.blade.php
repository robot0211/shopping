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
            <h3>Checkout</h3>

            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif

            <form action="{{ route('checkout.place') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="customer_name">Tên khách hàng:</label>
                    <input type="text" class="form-control" id="customer_name" name="customer_name" required>
                </div>
                <div class="form-group">
                    <label for="customer_email">Email:</label>
                    <input type="email" class="form-control" id="customer_email" name="customer_email" required>
                </div>
                <div class="form-group">
                    <label for="customer_phone">Số điện thoại:</label>
                    <input type="text" class="form-control" id="customer_phone" name="customer_phone" required>
                </div>
                <div class="form-group">
                    <label for="customer_address">Địa chỉ:</label>
                    <textarea class="form-control" id="customer_address" name="customer_address" required></textarea>
                </div>

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
                        @php $total = 0 @endphp
                        @foreach($cart as $id => $details)
                        @php $total += $details['price'] * $details['quantity'] @endphp
                        <tr>
                            <td><img src="{{ $details['image'] }}" width="100" height="100" alt="Image"></td>
                            <td>{{ $details['name'] }}</td>
                            <td>{{ $details['quantity'] }}</td>
                            <td>{{ number_format($details['price']) }} VND</td>
                            <td>{{ number_format($details['price'] * $details['quantity']) }} VND</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-right">
                    <h4>Tổng cộng: {{ number_format($total) }} VND</h4>
                    <button type="submit" class="btn btn-success">Đặt hàng</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection