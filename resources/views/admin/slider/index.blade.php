@extends('layouts.admin')

@section('title')
<title>Slider</title>
@endsection

@section('css')
<link href="{{ asset('publicAdmin/slider/index/index.css') }}" rel="stylesheet" />
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', [ 'name' => 'Slider', 'key' => 'List'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <label for="">
                        <form action="{{ route('slider.index') }}" method="GET" class="form-inline">
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
                    <a href="{{ route('slider.create') }}" class="btn btn-success float-right m-2">Add</a>
                </div>
                <div class="container mt-5">
                    <div class="col-md-12">

                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Tên Slider</th>
                                        <th scope="col">Mô tả</th>
                                        <th scope="col">Hình ảnh</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($sliders as $slider)
                                    <tr>
                                        <th scope="row">{{ $slider->id }}</th>
                                        <td>{{ $slider->name }}</td>
                                        <td>{{ $slider->description }}</td>
                                        <td>
                                            <img class="image_slider" src="{{ $slider->image_path }}" alt="">
                                        </td>
                                        <td>
                                            <a href="{{ route('slider.edit', ['id' => $slider->id]) }}" class="btn btn-default">Edit</a>
                                            <a href="" data-url="{{ route('slider.delete', ['id' => $slider->id]) }}" class="btn btn-danger action_delete">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-12">
                        {{ $sliders->links('pagination::bootstrap-5') }}
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