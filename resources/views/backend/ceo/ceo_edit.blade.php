@extends('admin.admin_master')

@section('admin')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>CEO o'zgartirish</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Asosiy</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('all.ceo') }}">CEO</a></li>
                    <li class="breadcrumb-item active">CEO o'zgartirish</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
                <!-- general form elements -->
                <div class="card">
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="POST" action="{{ route('ceo.update', $ceo->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Nomi</label>
                                            <input type="text" name="name" value="{{ $ceo->name }}" class="form-control">
                                            @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Telefon</label>
                                            <input type="text" name="phone" value="{{ $ceo->phone }}" class="form-control">
                                            @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <input type="submit" class="btn btn-rounded btn-primary" value="O'zgartirish">
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->

                    </form>
                </div>
                <!-- /.card -->
            </div>
            <!--/.col (left) -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>

@endsection
