@extends('layouts.admin')

@section('title')
<title>Trang chủ</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', ['name' => 'Menu', 'key' => 'Add'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="container mt-5">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white text-center">
                            <h5>Thêm Menu Mới</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('menus.store') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="categoryName" class="form-label">Tên Menu</label>
                                    <input type="text" name="name" class="form-control" placeholder="Nhập tên menu">
                                </div>
                                <div class="mb-3">
                                    <label for="parentCategory" class="form-label">Chọn Menu Cha</label>
                                    <select name="parent_id" class="form-select">
                                        <option value="0">Chọn menu cha</option>
                                        {{!! $optionSelect !!}}
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Url</label>
                                    <input type="text" name="url" class="form-control" placeholder="Nhập url">
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-success">Thêm Menu</button>
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