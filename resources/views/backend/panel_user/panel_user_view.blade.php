@extends('admin.admin_master')

@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Panel foydalanuvchilari</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Asosiy</a></li>
                        <li class="breadcrumb-item active">Panel foydalanuvchilari</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            @if($admins->count() > 0)
                                <div name="center" class="row">

                                    @foreach ($admins as $item)
                                        <div class="col-12 col-sm-6 col-md-6 d-flex align-items-stretch flex-column">
                                            <div class="card bg-light d-flex flex-fill">
                                                <div class="card-body pt-0">
                                                    <div class="row">
                                                        <div class="col-7">
                                                            <h2 class="lead"><b>{{ $item->name }}</b></h2>
                                                            <ul class="ml-4 mb-0 fa-ul text-muted">
                                                                <li class="small pb-1"><span class="fa-li"><i
                                                                            class="fas fa-lg fa-envelope"></i></span>
                                                                    <b>Email</b>
                                                                    : {{ $item->email }}</li>
                                                                <li class="small">
                                                                    <span class="fa-li"><i
                                                                            class="fas fa-lg fa-link"></i></span>
                                                                    <b>Bot ID</b>
                                                                    : {{ $item->bot_chat_id }}
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-5 text-center">
                                                            <img
                                                                src="{{ asset('/backend/dist/img/admin.jpg') }}"
                                                                style="width: 100px; height: 100px;" alt="image"
                                                                class="profile-user-img img-fluid img-circle">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <div class="text-right">
                                                        <a href="{{ route('panel_user.edit', $item->id) }}"
                                                           class="btn btn-sm btn-primary">
                                                            <i class="fas fa-edit"></i> O'zgartirish
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center">
                                    <h5 class="mb-0">Panel foydalanuvchilari mavjud emas!</h5>
                                </div>
                            @endif
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-4">
                    <!-- general form elements -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Panel foydalanuvchi qo'shish</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ route('panel_user.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Ism-familiya</label>
                                                <input type="text" name="name" class="form-control">
                                                @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Bot ID</label>
                                                <input type="number" name="bot_chat_id" class="form-control">
                                                @error('bot_chat_id')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Email(Login)</label>
                                                <input type="email" name="email" class="form-control">
                                                @error('email')
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
                                            <div class="form-group">
                                                <div class="custom-control custom-switch">
                                                    <input name="channel" type="checkbox"
                                                           class="custom-control-input" id="customSwitch1">
                                                    <label class="custom-control-label"
                                                           for="customSwitch1">Telegram kanal</label>
                                                </div>
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

