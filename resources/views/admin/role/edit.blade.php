@extends('layouts.admin')

@section('title')
<title>Role Edit</title>
@endsection

@section('css')
<link href="{{ asset('publicAdmin/role/add/add.css') }}" rel="stylesheet" />

@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', ['name' => 'Role', 'key' => 'Edit'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="container mt-5">
                    <form action="{{ route('roles.update', ['id' => $role->id]) }}" method="post" enctype="multipart/form-data">
                        <div class="card shadow-sm">
                            <div class="card-header-main bg-primary text-white text-center">
                                <h5>Chỉnh sửa Role</h5>
                            </div>

                            <div class="card-body">

                                @csrf
                                <div class="mb-3">
                                    <label for="roleName" class="form-label">Tên vai trò</label>
                                    <input type="text" name="name" class="form-control " placeholder="Nhập tên vai trò" value="{{ $role->name }}">

                                </div>

                                <div class="mb-3">
                                    <label for="roleDisplayName" class="form-label">Mô tả vai trò</label>
                                    <textarea name="display_name" class="form-control " rows="3">{{ $role->display_name }}</textarea>

                                </div>

                                <div class="mb-3">
                                        <label>
                                            <input type="checkbox" class="checkall">
                                            CheckAll
                                        </label>
                                    </div>
                                @foreach($permissionParent as $permissionParentItem)
                                <div class="mb-3">
                                    <div class="card_main text-dark bg-light mb-3">
                                        <div class="card-header">
                                            <label>
                                                <input type="checkbox" value="" class="checkbox_wrapper">
                                            </label>
                                            Module {{ $permissionParentItem->name }}
                                        </div>
                                        <div class="row">
                                            @foreach($permissionParentItem->permissionChildrent as $permissionChildrentItem)
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <label>
                                                        <input class="checkbox_childrent" type="checkbox" name="permission_id[]" {{ $permissionsChecked->contains('id', $permissionChildrentItem->id) ? 'checked' : '' }} value="{{ $permissionChildrentItem->id }}">
                                                    </label>
                                                    {{ $permissionChildrentItem->name }}
                                                </h5>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">Cập nhật Role</button>
                        </div>

                    </form>
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
<script src="{{ asset('publicAdmin/role/add/add.js') }} "></script>
@endsection