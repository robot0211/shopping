@extends('layouts.admin')

@section('title')
<title>Order</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', [ 'name' => 'Order', 'key' => 'List'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <label for="">
                        <form action="{{ route('admin.orders.index') }}" method="GET" class="form-inline">
                            <label for="perPage" class="mr-2">Show</label>
                            <select name="perPage" id="perPage" class="form-control" onchange="this.form.submit()">
                                <option value="5" {{ request()->get('perPage') == 5 ? 'selected' : '' }}>5</option>
                                <option value="10" {{ request()->get('perPage') == 10 ? 'selected' : '' }}>10</option>
                                <option value="25" {{ request()->get('perPage') == 25 ? 'selected' : '' }}>25</option>
                                <option value="50" {{ request()->get('perPage') == 50 ? 'selected' : '' }}>50</option>
                                <option value="100" {{ request()->get('perPage') == 100 ? 'selected' : '' }}>100</option>
                            </select>
                            <label for="perPage" class="ml-2">entries</label>
                            <input type="text" name="query" value="{{ request('query') }}" class="form-control ml-3" placeholder="Search...">
                            <button type="submit" class="btn btn-primary ml-2">Search</button>
                        </form>
                    </label>
                </div>
                <div class="container mt-5">
                    <div class="col-md-12">

                        @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên khách hàng</th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th>Địa chỉ</th>
                                    <th>Tổng giá</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->customer_name }}</td>
                                    <td>{{ $order->customer_email }}</td>
                                    <td>{{ $order->customer_phone }}</td>
                                    <td>{{ $order->customer_address }}</td>
                                    <td>{{ number_format($order->total_price) }} VND</td>
                                    <td>{{ $order->status }}</td>
                                    <td>
                                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-info">Xem</a>
                                        @if($order->status == 'pending')
                                        <a href="{{ route('admin.orders.confirm', $order->id) }}" class="btn btn-success">Xác nhận</a>
                                        <a href="{{ route('admin.orders.cancel', $order->id) }}" class="btn btn-danger">Hủy</a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        {{ $orders->links('pagination::bootstrap-5') }}
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