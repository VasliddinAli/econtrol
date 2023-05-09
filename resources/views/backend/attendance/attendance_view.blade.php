@extends('admin.admin_master')

@section('admin')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Kategoriyalar</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Asosiy</a></li>
                    <li class="breadcrumb-item active">Kategoriyalar</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <!-- <div class="card-header">
                        <h3 class="card-title">Categories</h3>
                    </div> -->
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Type</th>
                                    <th>Date</th>
                                    <th>Employee_id</th>
                                    <th>Device_id</th>
                                    <th>Purpose_id</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($attendances as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>
                                        <img src="{{ asset($item->image) }}" style="width: 100px;">
                                    </td>
                                    <td>{{ $item->type }}</td>
                                    <td>{{ $item->date }}</td>
                                    <td>{{ $item->employee_id }}</td>
                                    <td>{{ $item->device_id }}</td>
                                    <td>{{ $item->purpose_id }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection
