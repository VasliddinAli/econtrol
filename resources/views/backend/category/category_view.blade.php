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
                                    <th>Rasm</th>
                                    <th>Nomi(uz)</th>
                                    <th>Nomi(ru)</th>
                                    <th>Boshqarish</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $item)
                                <tr>
                                    <td width="1%">{{ $item->id }}</td>
                                    <td width="20%">
                                        <img src="{{ asset($item->icon) }}" style="width: 40px; height: 40px;">
                                    </td>
                                    <td>{{ $item->name_uz }}</td>
                                    <td>{{ $item->name_ru }}</td>
                                    <td width="10%">
                                        <a href="{{ route('category.edit', $item->id) }}" class="btn btn-info" title="O'zgartirish"><i class="fas fa-edit"></i></a>
                                        <a href="{{ route('category.delete', $item->id) }}" class="btn btn-danger" title="O'chirish" id="delete"><i class="fas fa-trash"></i></a>
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
            <div class="col-md-4">
                <!-- general form elements -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Kategory qo'shish</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="POST" action="{{ route('category.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Nomi(uz)</label>
                                            <input type="text" name="name_uz" class="form-control">
                                            @error('name_uz')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Nomi(ru)</label>
                                            <input type="text" name="name_ru" class="form-control">
                                            @error('name_ru')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Nomi(en)</label>
                                            <input type="text" name="name_en" class="form-control">
                                            @error('name_en')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlFile1">Rasm</label>
                                            <input type="file" name="icon" class="form-control-file" id="exampleFormControlFile1">
                                            @error('icon')
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

@endsection
