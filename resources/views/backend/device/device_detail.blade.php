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
                <h1>Qurilma</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Asosiy</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('all.device') }}">Qurilma</a></li>
                    <li class="breadcrumb-item active">Qurilma</li>
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
                        <h3 class="card-title">Qurilma haqida</h3>
                    </div>
                    <div class="card-body box-profile">

                        <h3 class="profile-username text-center">{{ $device->name }}</h3>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b><i class="fas fa-list-ol mr-1"></i>ID :</b> <a class="float-right">{{ $device->id
                                    }}</a>
                            </li>
                            <li class="list-group-item">
                                <b><i class="fas fa-user mr-1"></i>Nomi :</b> <a class="float-right">{{
                                    $device->name }}</a>
                            </li>
                        </ul>

                        <a href="{{ route('device.delete', $device->id) }}" class="btn btn-danger btn-block mt-2" id="delete"><b>O'chirish</b></a>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="secton1">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <form method="POST" action="{{ route('device_login.update', $device->id) }}" enctype="multipart/form-data">
                                                @csrf
                                                <div class="card-body">
                                                    <div class="col-md-12">
                                                        <div class="row">
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
    $(document).ready(function() {
        $('select[name="region_id"]').on('change', function() {
            var region_id = $(this).val();
            if (region_id) {
                $.ajax({
                    url: "{{  url('/brands/branches/region/district/ajax') }}/" + region_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        var d = $('select[name="district_id"]').empty();
                        $.each(data, function(key, value) {
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

@endsection