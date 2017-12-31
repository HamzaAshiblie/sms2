@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">

            <ol class="breadcrumb">
                <li><a href="#">الرئيسية</a></li>
                <li>التقارير</li>
                <li class="active">الضريبه المضافة</li>
            </ol>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> الضريبه المضافة</div>
                </div> <!-- /panel-heading -->
                <div class="panel-body div-body-modal">
                    <form class="form-inline" action="{{ route('report.betweenVatDate') }}">
                        <div class="form-group">
                            <input type="text" class="form-control" id="datepicker" name="start" placeholder="بداية التاريخ">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="datepicker2" name="end" placeholder="نهاية التاريخ">
                        </div>
                        <button class="btn btn-default" type="submit">إرسال</button>
                    </form>
                    <table class="table" id="reportSalesBetween-table">
                        <thead>
                        <tr>
                            <th  style="text-align: right">الاجمالي</th>
                            <th  style="text-align: right">التاريخ</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($betweenVatOrders as $order)
                            <tr>
                                <td>{{ $order->vat }}</td>
                                <td>{{ $order->created_at }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> الضريبه المضافة</div>
                </div> <!-- /panel-heading -->
                <div class="panel-body div-body-modal">

                    <table class="table" id="reportSales-table">
                        <thead>
                        <tr>
                            <th  style="text-align: right">الاجمالي</th>
                            <th  style="text-align: right">التاريخ</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->vat }}</td>
                                <td>{{ $order->created_at }}</td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
        <script>
            var token = '{{ Session::token() }}';
            var urlReportSales = '{{ route('postReportSales') }}';

        </script>
@endsection
