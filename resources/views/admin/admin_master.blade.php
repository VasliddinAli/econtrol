<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>E-Controller | Admin Panel</title>


    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('backend/dist/css/adminlte.min.css') }}">
    <!-- input style -->
    <link rel="stylesheet" href="{{ asset('backend/input/style.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/summernote/summernote-bs4.min.css') }}">
    <!-- CodeMirror -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/codemirror/codemirror.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/codemirror/theme/monokai.css') }}">
    <!-- SimpleMDE -->
    <!-- <link rel="stylesheet" href="{{ asset('backend/plugins/simplemde/simplemde.min.css') }}"> -->
    <!-- Toastr -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" />

    <!-- <link rel="icon" href="{{ asset('backend/dist/img/uzb_icon.png') }}"> -->
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('backend/dist/img/logo.png') }}" alt="logo" height="100" width="100">
        </div>

        @include('admin.body.header')

        @include('admin.body.sidebar')


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            @yield('admin')

        </div>
        <!-- /.content-wrapper -->
        <!-- @include('admin.body.footer') -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->


    </div>
    <!-- ./wrapper -->


    <!-- jQuery -->
    <script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('backend/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('backend/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('backend/plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('backend/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('backend/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('backend/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- InputMask -->
    <script src="{{ asset('backend/plugins/moment/moment.min.js') }}></script>
<script src=" {{ asset('backend/plugins/inputmask/jquery.inputmask.min.js') }}></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('backend/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- CodeMirror -->
    <script src="{{ asset('backend/plugins/codemirror/codemirror.js') }}"></script>
    <script src="{{ asset('backend/plugins/codemirror/mode/css/css.js') }}"></script>
    <script src="{{ asset('backend/plugins/codemirror/mode/xml/xml.js') }}"></script>
    <script src="{{ asset('backend/plugins/codemirror/mode/htmlmixed/htmlmixed.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('backend/dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('backend/dist/js/demo.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('backend/dist/js/pages/dashboard.js') }}"></script>
    <!-- input app.js -->
    <script src="{{ asset('backend/input/app.js') }}"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    {{-- Toastr --}}
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        @if(Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}"
        switch (type) {
            case 'info':
                toastr.info("{{ Session::get('message') }}");
                break;
            case 'success':
                toastr.success("{{ Session::get('message') }}");
                break;
            case 'warning':
                toastr.warning("{{ Session::get('message') }}");
                break;
            case 'error':
                toastr.error("{{ Session::get('message') }}");
                break;
        }
        @endif
    </script>
    {{-- Sweetalert --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('backend/js/code.js')}}"></script>

    <!-- Page specific script -->

    <script>
        $(function() {
            //Date range picker
            $('#reservation').daterangepicker({
                // opens: 'left'
                locale: {
                    cancelLabel: 'Bekor qilish',
                    applyLabel: 'Tanlash',
                    format: 'YYYY-MM-DD'
                }
            }, function(start, end, label) {
                var first_type = 'date';
                var startDate = start.format('YYYY-MM-DD');
                var endDate = end.format('YYYY-MM-DD');

                var attendance_type = $('select[id="attendance_type"]').val();
                var attendance_device = $('select[id="attendance_device"]').val();
                var attendance_purpose_id = $('select[id="attendance_purpose_id"]').val();
                var startDate = $('#reservation').data('daterangepicker').startDate.format('YYYY-MM-DD');
                var endDate = $('#reservation').data('daterangepicker').endDate.format('YYYY-MM-DD');
                if (startDate != endDate) {
                    first_type = 'date';
                }

                var params = "first_type=" + first_type + "&attendance_type=" + attendance_type + "&attendance_device=" + attendance_device + "&attendance_purpose_id=" + attendance_purpose_id + "&start_date=" + startDate + "&end_date=" + endDate;
                location.href = "{{ url('/attendance/view?') }}" + params;
            });
        });

        function filterAttendance() {
            var attendance_type = $('select[id="attendance_type"]').val();
            var attendance_device = $('select[id="attendance_device"]').val();
            var attendance_purpose_id = $('select[id="attendance_purpose_id"]').val();
            var startDate = $('#reservation').data('daterangepicker').startDate.format('YYYY-MM-DD');
            var endDate = $('#reservation').data('daterangepicker').endDate.format('YYYY-MM-DD');
            var first_type = 'status';
            if (startDate != endDate) {
                first_type = 'date';
            }

            var params = "first_type=" + first_type + "&attendance_type=" + attendance_type + "&attendance_device=" + attendance_device + "&attendance_purpose_id=" + attendance_purpose_id + "&start_date=" + startDate + "&end_date=" + endDate;
            location.href = "{{ url('/attendance/view?') }}" + params;
        }

        // function filterDeviceAttendance() {
        //     var attendance_type = $('select[id="attendance_type"]').val();
        //     var attendance_device = $('select[id="attendance_device"]').val();
        //     var startDate = $('#reservation').data('daterangepicker').startDate.format('YYYY-MM-DD');
        //     var endDate = $('#reservation').data('daterangepicker').endDate.format('YYYY-MM-DD');
        //     var first_type = 'status';
        //     if (startDate != endDate) {
        //         first_type = 'date';
        //     }

        //     var params = "first_type=" + first_type + "&attendance_type=" + attendance_type + "&attendance_device=" + attendance_device + "&start_date=" + startDate + "&end_date=" + endDate;
        //     location.href = "{{ url('/attendance/view?') }}" + params;
        // }
    </script>

    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": [{
                    extend: 'copy',
                    text: 'Nusxa olish'
                }, "excel", "pdf"],
                "oLanguage": {
                    "sSearch": "Qidirish:"
                },
                "language": {
                    "info": "_TOTAL_ ta elementdan _START_ dan _END_ gacha ko'rsatilmoqda",
                    "infoEmpty": "0 ta elementdan 0 dan 0 gacha ko'rsatilmoqda",
                    emptyTable: "Jadvalda ma'lumotlar mavjud emas",
                    "paginate": {
                        "previous": "Oldingi",
                        "next": "Keyingi",
                    }
                }
                // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $("#example0").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": false,
                "oLanguage": {
                    "sSearch": "Qidirish:"
                },
                "language": {
                    "info": "_TOTAL_ ta elementdan _START_ dan _END_ gacha ko'rsatilmoqda",
                    "infoEmpty": "0 ta elementdan 0 dan 0 gacha ko'rsatilmoqda",
                    emptyTable: "Jadvalda ma'lumotlar mavjud emas",
                    "paginate": {
                        "previous": "Oldingi",
                        "next": "Keyingi",
                    }
                }
                // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            $("#example3").DataTable({
                "responsive": true,
                "paging": false,
                "info": false,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": [{
                    extend: 'copy',
                    text: 'Nusxa olish'
                }, "excel", "pdf"],
                "oLanguage": {
                    "sSearch": "Qidirish:"
                },
                "language": {
                    "info": "_TOTAL_ ta elementdan _START_ dan _END_ gacha ko'rsatilmoqda",
                    "infoEmpty": "0 ta elementdan 0 dan 0 gacha ko'rsatilmoqda",
                    emptyTable: "Jadvalda ma'lumotlar mavjud emas",
                    "paginate": {
                        "previous": "Oldingi",
                        "next": "Keyingi",
                    }
                }
                // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>

    <script>
        $(function() {
            // Summernote
            $('#summernote').summernote()
            $('#summernote1').summernote()
            $('#summernote2').summernote()

            // CodeMirror
            CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
                mode: "htmlmixed",
                theme: "monokai"
            });

        })
    </script>

    <script>
        $(function() {
            //Date picker
            $('#reservationdate').datetimepicker({
                format: 'DD-MM-YYYY'
            });
            $('#reservationdate1').datetimepicker({
                format: 'DD-MM-YYYY'
            });
        });

        $(document).ready(function() {
            $('.product-image-thumb').on('click', function() {
                var $image_element = $(this).find('img')
                $('.product-image').prop('src', $image_element.attr('src'))
                $('.product-image-thumb.active').removeClass('active')
                $(this).addClass('active')
            })
        })
    </script>
</body>

</html>