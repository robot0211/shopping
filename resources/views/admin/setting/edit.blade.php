@extends('layouts.admin')

@section('title')
<title>Setting Edit</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('publicAdmin/setting/index/add.css') }}">
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', ['name' => 'Setting', 'key' => 'Edit'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="container mt-5">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white text-center">
                            <h5>Cập nhật setting</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('setting.update', ['id' => $setting->id]) }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="keyName" class="form-label">Config Key</label>
                                    <input type="text" name="config_key" class="form-control @error('config_key') is-invalid @enderror" placeholder="Nhập config key" value="{{ $setting->config_key }}">
                                    @error('config_key')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                @if(request()->type === 'Text')
                                <div class="mb-3">
                                    <label for="valueName" class="form-label">Config Value</label>
                                    <input type="text" name="config_value" class="form-control @error('config_value') is-invalid @enderror" placeholder="Nhập config value" value="{{ $setting->config_value }}">
                                    @error('config_value')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                    @elseif(request()->type === 'Textarea')
                                    <div class="mb-3">
                                        <label for="valueName" class="form-label">Config Value</label>
                                        <textarea type="textarea" name="config_value" class="form-control @error('config_value') is-invalid @enderror" placeholder="Nhập config value" rows="3">{{ $setting->config_value }}</textarea>
                                    </div>
                                    @error('config_value')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                @endif

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-success">Cập nhật Setting</button>
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