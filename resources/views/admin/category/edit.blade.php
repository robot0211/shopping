@extends('layouts.admin')

@section('title')
<title>Trang chủ</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', ['name' => 'Category', 'key' => 'Edit'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="container mt-5">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white text-center">
                            <h5>Chỉnh sửa danh mục</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('categories.update', ['id' => $category->id]) }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="categoryName" class="form-label">Tên Danh Mục</label>
                                    <input type="text" name="name" value="{{ $category->name }}" class="form-control" placeholder="Nhập tên danh mục">
                                </div>
                                <div class="mb-3">
                                    <label for="parentCategory" class="form-label">Chọn Danh Mục Cha</label>
                                    <select name="parent_id" class="form-select">
                                        <option value="0">Chọn danh mục cha</option>
                                        {!! $htmlOption !!}
                                    </select>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-success">Cập nhật</button>
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