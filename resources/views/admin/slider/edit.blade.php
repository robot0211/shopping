@extends('layouts.admin')

@section('title')
<title>Slider Edit</title>
@endsection

@section('css')
<link href="{{ asset('publicAdmin/slider/edit/edit.css') }}" rel="stylesheet" />
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', ['name' => 'Slider', 'key' => 'Edit'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="container mt-5">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white text-center">
                            <h5>Thêm Slider Mới</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('slider.update', ['id' => $slider->id]) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="sliderName" class="form-label">Tên Slider</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nhập tên slider" value="{{ $slider->name }}">
                                    @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="sliderDecription" class="form-label">Mô tả slider</label>
                                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3">{{ $slider->description }}</textarea>
                                    @error('description')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="sliderImage" class="form-label">Hình ảnh</label>
                                    <input type="file" name="image_path" class="form-control-file @error('image_path') is-invalid @enderror">

                                    <div class="mb-3 container_image_path">
                                        <div class="row">
                                            <img class="image" src="{{ $slider->image_path }}" alt="">
                                        </div>
                                    </div>
                                    @error('image_path')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-success">Cập nhật Slider</button>
                                </div>
                            </form>
                        </div>
                    </div>
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