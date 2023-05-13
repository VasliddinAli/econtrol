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
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Sanalar bo'yicha filter:</label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <input type="text" value="{{ $start_date == null ? '' : $full_date }}" class="form-control float-right" id="reservation">
                                </div>
                                <!-- /.input group -->
                            </div>

                            <div class="col-md-6 form-group">
                                <label>Holat bo'yicha filter:</label>

                                <select onchange="filterStatusAttendance()" id="attendance_type" name="status" class="form-control select2" style="width: 100%;">
                                    <option {{ $attendance_type == 'all' ? 'selected' : '' }} value="all">Hammasi</option>
                                    <option {{ $attendance_type == 'input' ? 'selected' : '' }} value="input">Keldi</option>
                                    <option {{ $attendance_type == 'output' ? 'selected' : '' }} value="output">Ketdi</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" name="attendances">

                        <table id="example3" class="table table-bordered table-striped attendances">
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
<script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>

<script>
    let ids = [];

    function getItem(id) {


        let check_item = ids.filter(item => item === id).length
        if (check_item > 0) {
            let item = ids.indexOf(id);
            ids.splice(item, 1);
        } else {
            ids.push(id);
        }
        if (ids.length > 0) {
            $(".get_order").show();
        } else {
            $('.get_order').hide();
        }
        // console.log(ids.sort());
    }

    function getOrders() {
        location.href = "{{ url('/order/order_table?order_ids=') }}" + ids.sort();
    }

    //Enable check and uncheck all functionality
    $('.checkbox-toggle').click(function() {
        var clicks = $(this).data('clicks')
        if (clicks) {
            ids = [];
            //Uncheck all checkboxes
            $('.attendances input[type=\'checkbox\']').prop('checked', false)
            $('.checkbox-toggle .far.fa-check-square').removeClass('fa-check-square').addClass('fa-square')
        } else {
            //Check all checkboxes
            $('.attendances input[type=\'checkbox\']').each(function() {
                var input_id = $(this).attr("id");

                ids.push(input_id);
            });

            // console.log(ids)
            // console.log(checks)
            $('.attendances input[type=\'checkbox\']').prop('checked', true)
            $('.checkbox-toggle .far.fa-square').removeClass('fa-square').addClass('fa-check-square')
        }

        if (ids.length > 0) {
            $(".get_order").show();
        } else {
            $('.get_order').hide();
        }
        $(this).data('clicks', !clicks)
    });
</script>
@endsection