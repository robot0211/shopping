@extends('layouts.admin')

@section('title')
<title>Order Detail</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', [ 'name' => 'Order', 'key' => 'Detail'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

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
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection