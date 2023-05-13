@extends('admin.admin_master')

@section('admin')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Davomat</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Asosiy</a></li>
                    <li class="breadcrumb-item active">Davomat</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
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
                                    <th>Rasmi</th>
                                    <th>Holati</th>
                                    <th>Vaqti</th>
                                    <th>Hodim</th>
                                    <th>Qurilma</th>
                                    <th>Sabab</th>
                                    <th>Boshqarish</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($attendances as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>
                                        <a href="{{ asset($item->image) }}" target="_blank"><img src="{{ asset($item->image) }}" width="50"></a>
                                    </td>
                                    <td>{{ $item->type }}</td>
                                    <td>{{ $item->date }}</td>
                                    <td>{{ $item->employee->name }}</td>
                                    <td>{{ $item->device->name }}</td>
                                    <td>{{ $item->purpose_id == null ? "" : $item->purpose->purpose }}</td>
                                    <td width="10%">
                                        <a href="{{ route('attendance.delete', $item->id) }}" class="btn btn-danger" title="O'chirish" id="delete"><i class="fas fa-trash"></i></a>
                                    </td>
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
