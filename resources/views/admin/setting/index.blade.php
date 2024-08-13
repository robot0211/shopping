@extends('layouts.admin')

@section('title')
<title>Setting</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('publicAdmin/setting/index/index.css') }}">
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', [ 'name' => 'Setting', 'key' => 'List'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="mb-3">
                    <label for="">
                        <form action="{{ route('setting.index') }}" method="GET" class="form-inline">
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
                    <div class="dropdown dropdown-right">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Mode Add
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li><a class="dropdown-item" href="{{ route('setting.create') . '?type=Text' }}">Text</a></li>
                            <li><a class="dropdown-item" href="{{ route('setting.create') . '?type=Textarea' }}">Textarea</a></li>
                        </ul>
                    </div>
                </div>

            </div>
            <div class="container mt-5">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Config Key</th>
                                    <th scope="col">Config Value</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($settings as $setting)
                                <tr>
                                    <th scope="row">{{ $setting->id }}</th>
                                    <td>{{ $setting->config_key }}</td>
                                    <td>{{ $setting->config_value }}</td>
                                    <td>
                                        <a href="{{ route('setting.edit', ['id' => $setting->id]) . '?type=' . $setting->type }}" class="btn btn-default">Edit</a>
                                        <a href="" data-url="{{ route('setting.delete', ['id' => $setting->id]) }}" class="btn btn-danger action_delete">Delete</a>
                                    </td>
                                </tr>

                                @endforeach()

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-12">
                    {{ $settings->links('pagination::bootstrap-5') }}
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
<script src="{{ asset('publicAdmin/setting/index/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendors/sweetAlert2/sweetalert2@11.js') }}"></script>
<script src="{{ asset('publicAdmin/main.js') }}"></script>
@endsection