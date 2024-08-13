@extends('layouts.admin')

@section('title')
<title>Edit Product</title>
@endsection

@section('css')
<link href="{{ asset('vendors/select2/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('publicAdmin/product/edit/edit.css') }}" rel="stylesheet" />
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', ['name' => 'Product', 'key' => 'Edit'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="container mt-5">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white text-center">
                            <h5>Sửa sản phẩm</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('product.update', ['id' => $product->id]) }} " method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="productName" class="form-label">Tên sản phẩm</label>
                                    <input type="text" name="name" class="form-control" placeholder="Nhập tên sản phẩm" value="{{ $product->name }}">
                                </div>

                                <div class="mb-3">
                                    <label for="productPrice" class="form-label">Giá sản phẩm</label>
                                    <input type="text" name="price" class="form-control" placeholder="Nhập giá" value="{{ $product->price }}">
                                </div>

                                <div class="mb-3">
                                    <label for="productImg" class="form-label">Ảnh đại diện</label>
                                    <input type="file" name="feature_image_path" class="form-control-file">

                                    <div class="mb-3 container_avatar">
                                        <div class="row">
                                            <img class="avatar" src="{{ $product->feature_image_path }}" alt="">
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="productImg" class="form-label">Ảnh chi tiết</label>
                                    <input type="file" multiple name="image_path[]" class="form-control-file">

                                    <div class="mb-3 container_image_detail">
                                        <div class="row">
                                            @foreach($product->images as $productImageItem)
                                            <div class="mb-3">
                                                <img class="image_detail" src="{{ $productImageItem->image_path }}" alt="">
                                            </div>
                                            @endforeach()
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="parentCategory" class="form-label">Tên Danh Mục</label>
                                    <select name="category_id" class="form-select select2_init">
                                        <option value="">Chọn danh mục</option>
                                        {!! $htmlOption !!}
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="tag" class="form-label">Nhập tags cho sản phẩm</label>
                                    <select name="tags[]" class="form-control tags_select_choose" multiple="multiple">
                                        @foreach($product->tags as $productTag)
                                        <option value="{{ $productTag->name }}" selected>{{ $productTag->name }}></option>
                                        @endforeach()
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="productContent">Nội dụng sản phẩm</label>
                                    <textarea name="content" class="form-control tinymce_editor_init" rows="4">{{ $product->content }}</textarea>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-success">Cập nhật sản phẩm</button>
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

@section('js')
<script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
<script src="https://cdn.tiny.cloud/1/21u5151zmcok922dg251b2d9lanqe7jayxbzjvu01kwu8in5/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script src="{{ asset('publicAdmin/product/add/add.js') }}"></script>
@endsection