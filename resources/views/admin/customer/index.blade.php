@extends('layouts.admin')

@section('title')
<title>Customer</title>
@endsection

@section('css')

@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', [ 'name' => 'Customer', 'key' => 'List'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <label for="">
                        <form action="{{ route('customers.index') }}" method="GET" class="form-inline">
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
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Tên</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Address</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($customers as $customer)
                                    <tr>
                                        <th scope="row">{{ $customer->id }}</th>
                                        <td>{{ $customer->name }}</td>
                                        <td>{{ $customer->email }}</td>
                                        <td>{{ $customer->phone }}</td>
                                        <td>{{ $customer->address }}</td>
                                    </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-12">
                        {{ $customers->links('pagination::bootstrap-5') }}
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

@section('js')
<script src="{{ asset('vendors/sweetAlert2/sweetalert2@11.js') }}"></script>
<script src="{{ asset('publicAdmin/main.js') }}"></script>
@endsection