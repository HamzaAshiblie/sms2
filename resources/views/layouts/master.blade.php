<!DOCTYPE html>
<html dir="rtl">
<head>
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{URL::to('src/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{URL::to('src/css/bootstrap-theme.min.css')}}" rel="stylesheet">
    <link href="{{URL::to('src/plugins/datatables/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::to('src/plugins/fullcalendar/fullcalendar.min.css')}}" rel="stylesheet">
    <link href="{{URL::to('src/plugins/fullcalendar/fullcalendar.print.css'),array('media' => 'print')}}" rel="stylesheet">
    <link href="{{URL::to('src/font-awesome/css/font-awesome.css') }}" rel='stylesheet' media='all' />
    <link href="{{URL::to('src/css/app.css')}}" rel="stylesheet">
    <link href="{{URL::to('src/css/rtl.css')}}" rel="stylesheet">
</head>
<body>
@section('header')
    @include('includes.header')
@show

    <div class="container">
        @yield('content')
    </div>
    <link rel="stylesheet" href="{{URL::to('src/plugins/moment/moment.min.js')}}">
    <link rel="stylesheet" href="{{URL::to('src/plugins/fullcalendar/fullcalendar.min.js')}}">
    <script  src="{{URL::to('src/js/jquery-2.2.4.js')}}"> </script>
    <script  src="{{URL::to('src/js/bootstrap.min.js')}}"> </script>

    <script  src="{{URL::to('src/js/app.js')}}"> </script>
    <!-- DataTables -->
    <script src="{{URL::to('src/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::to('src/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>

    <script>
        var atable;
        $(document).ready(function() {
             atable = $('#datatable').DataTable({
                "language": {
                    "sProcessing":   "جارٍ التحميل...",
                    "sLengthMenu":   "أظهر _MENU_ مدخلات",
                    "sZeroRecords":  "لم يعثر على أية سجلات",
                    "sInfo":         "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
                    "sInfoEmpty":    "يعرض 0 إلى 0 من أصل 0 سجل",
                    "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
                    "sInfoPostFix":  "",
                    "sSearch":       "ابحث:",
                    "sUrl":          "",
                    "oPaginate": {
                        "sFirst":    "الأول",
                        "sPrevious": "السابق",
                        "sNext":     "التالي",
                        "sLast":     "الأخير"
                    }
                }
            } );
        } );
    </script>


    <!--Jquery Redirect-->

</body>
</html>
