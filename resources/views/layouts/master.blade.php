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
    <link href="{{ URL::to('src/font-awesome/css/font-awesome.css') }}" rel='stylesheet' media='all' />
    <link href="{{URL::to('src/css/app.css')}}" rel="stylesheet">
    <link href="{{URL::to('src/css/rtl.css')}}" rel="stylesheet">
</head>
<body>
    @include('includes.header')
    <div class="container">
        @yield('content')
    </div>
    <link rel="stylesheet" href="{{URL::to('src/plugins/moment/moment.min.js')}}">
    <link rel="stylesheet" href="{{URL::to('src/plugins/fullcalendar/fullcalendar.min.js')}}">
    <script  src="//code.jquery.com/jquery-2.2.4.js"> </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <script  src="{{URL::to('src/js/app.js')}}"> </script>
    <!-- DataTables -->
    <script src="{{URL::to('src/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::to('https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js')}}"></script>

    <script>

        var datax = [
            [ "1", "حمزه", "فرد", "05050505"],
            [ "1", "حمزه", "فرد", "05050505"],
            [ "1", "حمزه", "فرد", "05050505"],
            [ "1", "حمزه", "فرد", "05050505"],
            [ "1", "حمزه", "فرد", "05050505"]
        ];


        $(document).ready(function() {
            $('#example').DataTable( {
                data: datax,
                columns: [
                    { title: "Id" },
                    { title: "Name" },
                    { title: "Company" },
                    { title: "Phone" }
                ]
            } );
        } );

    </script>


    <!--Jquery Redirect-->

</body>
</html>
