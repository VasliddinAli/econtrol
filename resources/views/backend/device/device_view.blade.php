@extends('admin.admin_master')

@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Qurilmalar</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Asosiy</a></li>
                    <li class="breadcrumb-item active">Qurilmalar</li>
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
                                    <th>Nomi</th>
                                    <th>Boshqarish</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($devices as $item)
                                <tr>
                                    <td width="1%">{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td width="12%">
                                        <a href="{{ route('device.show', $item->id) }}" class="btn btn-primary" title="Ko'rish"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('device.edit', $item->id) }}" class="btn btn-info" title="O'zgartirish"><i class="fas fa-edit"></i></a>
                                        <a href="{{ route('device.delete', $item->id) }}" class="btn btn-danger" title="O'chirish" id="delete"><i class="fas fa-trash"></i></a>
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
                        <h3 class="card-title">Qurilma qo'shish</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="POST" action="{{ route('device.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Nomi</label>
                                            <input type="text" name="name" class="form-control">
                                            @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Parol</label>
                                            <input type="text" name="password" class="form-control">
                                            @error('password')
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
    $(document).ready(function() {
        $('a[name="center_id"]').on('change', function() {
            var center_id = $(this).val();
            if (center_id) {
                $.ajax({
                    url: "{{  url('/training/center/image/ajax') }}/" + center_id,
                    type: "GET",
                    dataType: "json",
                    // success: function (data) {
                    //     var d = $('select[name="district_id"]').empty();
                    //     $.each(data, function (key, value) {
                    //         $('select[name="district_id"]').append('<option value="' + value.id + '">' + value.name_uz + '</option>');
                    //     });
                    // },
                });
            } else {
                alert('danger');
            }
        });
    });
</script>

@endsection