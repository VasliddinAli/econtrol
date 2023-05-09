@extends('admin.admin_master')

@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>
    .checked {
        color: orange;
    }
</style>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Panel foydalanuvchisi</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Asosiy</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('all.panel_user') }}">Panel foydalanuvchilari</a></li>
                    <li class="breadcrumb-item active">Panel foydalanuvchisi</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>


<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Panel foydalanuvchisi haqida</h3>
                    </div>
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user img-fluid img-circle"
                                 src="{{ asset('/backend/dist/img/admin.jpg') }}"
                                 alt="picture">
                        </div>

                        <h3 class="profile-username text-center">{{ $panel_user->name }}</h3>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b><i class="fas fa-list-ol mr-1"></i>ID :</b> <a class="float-right">{{ $panel_user->id
                                    }}</a>
                            </li>
                            <li class="list-group-item">
                                <b><i class="fas fa-user mr-1"></i>Ism-familyasi :</b> <a class="float-right">{{
                                    $panel_user->name }}</a>
                            </li>
                            <li class="list-group-item">
                                <b><i class="fab fa-buffer mr-1"></i>Holat :</b> <a class="float-right"><span
                                        class="badge badge-primary p-1">{{ $panel_user->status }}</span></a>
                            </li>
                        </ul>

                        <a href="{{ route('panel_user.delete', $panel_user->id) }}"
                                class="btn btn-danger btn-block mt-2" id="delete"><b>O'chirish</b></a>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="nav-link active" href="#secton1" data-toggle="tab">
                                    Foydalanuvchini o'zgartirish
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#secton2" data-toggle="tab">
                                    Loginni almashtirish
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="secton1">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
{{--                                            <div class="card-header">--}}
{{--                                                <h3 class="card-title">Section 1</h3>--}}
{{--                                            </div>--}}
                                            <form method="POST" action="{{ route('panel_user.update', $panel_user->id) }}" enctype="multipart/form-data">
                                                @csrf
                                                <div class="card-body">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Ism-familya</label>
                                                                    <input type="text" name="name" value="{{ $panel_user->name }}" class="form-control">
                                                                    @error('name')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Bot ID</label>
                                                                    <input type="text" name="bot_chat_id" value="{{ $panel_user->bot_chat_id }}" class="form-control">
                                                                    @error('bot_chat_id')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <div class="custom-control custom-switch">
                                                                        <input name="channel" type="checkbox"
                                                                               {{ $panel_user->type == 'channel' ? 'checked' : '' }}
                                                                               class="custom-control-input" id="customSwitch1">
                                                                        <label class="custom-control-label"
                                                                               for="customSwitch1">Telegram kanal</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex justify-content-end">
                                                            <input type="submit" class="btn btn-rounded btn-primary" value="O'zgartirish">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.card-body -->

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="secton2">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            {{--                                            <div class="card-header">--}}
                                            {{--                                                <h3 class="card-title">Section 1</h3>--}}
                                            {{--                                            </div>--}}
                                            <form method="POST" action="{{ route('panel_user_login.update', $panel_user->id) }}" enctype="multipart/form-data">
                                                @csrf
                                                <div class="card-body">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Email(Login)</label>
                                                                    <input type="text" name="email" value="{{ $panel_user->email }}" class="form-control">
                                                                    @error('email')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Yangi Parol</label>
                                                                    <input type="text" name="password" class="form-control">
                                                                    @error('password')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex justify-content-end">
                                                            <input type="submit" class="btn btn-rounded btn-primary" value="O'zgartirish">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.card-body -->

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    $(document).ready(function () {
        $('select[name="region_id"]').on('change', function () {
            var region_id = $(this).val();
            if (region_id) {
                $.ajax({
                    url: "{{  url('/training/center/region/district/ajax') }}/" + region_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        var d = $('select[name="district_id"]').empty();
                        $.each(data, function (key, value) {
                            $('select[name="district_id"]').append('<option value="' + value.id + '">' + value.name_uz + '</option>');
                        });
                    },
                });
            } else {
                alert('danger');
            }
        });
    });
</script>

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

<script type="text/javascript">


    function courseEdit(id) {
        // alert(id)
        $.ajax({
            type: 'POST',
            url: '/training/center/course/edit/' + id,
            dataType: 'json',
            success: function (data) {
                // alert(data.name)
                $('#cid').val(data.course.id);
                $('#cname').val(data.course.name);
                $('#cpay').val(data.course.monthly_payment);
            }
        })
    }


    function courseUpdate() {
        var id = $('#cid').val();
        var name = $('#cname').val();
        var monthly_payment = $('#cpay').val();
        var science_id = $('#science_id option:selected').val();
        $.ajax({
            type: "POST",
            dataType: "json",
            data: {
                name: name, monthly_payment: monthly_payment, science_id: science_id
            },
            url: "/training/center/course/update/" + id,
            success: function (data) {
                location.reload();
                toastr.info("Center Course Updated Successfully");
            }
        })
    }

</script>

<script>
    function courseTeach(id) {
        var center_id = $('#centerid').val();

        // alert(center_id)
        $.ajax({
            type: "POST",
            dataType: "json",
            data: {
                center_id: center_id
            },
            url: '/training/center/course/edit/' + id,
            success: function (data) {
                console.log(data.teachers);
                var rows = ""
                $.each(data.teachers, function (key, value) {
                    rows += `
          <div class="icheck-primary d-inline">
            <input type="checkbox" name="checked" ${value.checked != null ? 'checked' : ''} onclick="checkbox(${value.id})" id="${value.name}">
            <label for="${value.name}">
              ${value.name}
            </label>
          </div>
          `
                });
                $('#teach').html(rows);

                // alert(data.name)
                $('#courseid').val(data.course.id);
                $('#coursename').text(data.course.name);
                // $('#checked').id(data.id);
            }
        })
    }


    function checkbox(teacher_id) {
        var course_id = $('#courseid').val();
        $.ajax({
            type: "POST",
            dataType: "json",
            data: {
                teacher_id: teacher_id, course_id: course_id
            },
            url: "/training/center/course/teacher/connect",
            success: function (data) {
                // console.log(data)
                // location.reload();
                toastr.success(data.success);
            }
        })
    }
</script>

@endsection

