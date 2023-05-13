@extends('admin.admin_master')

@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Sabablar</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Asosiy</a></li>
                        <li class="breadcrumb-item active">Sabablar</li>
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
                            <table id="example0" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Sabab</th>
                                    <th>Boshqarish</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($purposes as $item)
                                    <tr>
                                        <td width="1%">{{ $item->id }}</td>
                                        <td>{{ $item->purpose }}</td>
                                        <td width="12%">
                                            <a href="{{ route('purpose.edit', $item->id) }}" class="btn btn-info" title="O'zgartirish"><i class="fas fa-edit"></i></a>
                                            <a href="{{ route('purpose.delete', $item->id) }}" class="btn btn-danger" title="O'chirish" id="delete"><i class="fas fa-trash"></i></a>
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
                <div class="col-md-4">
                    <!-- general form elements -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Sabab qo'shish</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ route('purpose.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Nomi</label>
                                                <input type="text" name="purpose" class="form-control">
                                                @error('purpose')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <input type="submit" class="btn btn-rounded btn-primary" value="Qo'shish">
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->



    <script type="text/javascript">
        $(document).ready(function () {
            $('a[name="center_id"]').on('change', function () {
                var center_id = $(this).val();
                if (center_id) {
                    $.ajax({
                        url: "{{  url('/training/center/image/ajax') }}/" + center_id,
                        type: "GET",
                        dataType: "json",
                    });
                } else {
                    alert('danger');
                }
            });
        });
    </script>

@endsection

