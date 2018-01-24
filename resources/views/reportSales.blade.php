@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">

            <ol class="breadcrumb">
                <li><a href="#">الرئيسية</a></li>
                <li>التقارير</li>
                <li class="active">المبيعات</li>
            </ol>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> المبيعات</div>
                </div> <!-- /panel-heading -->
                <div class="panel-body div-body-modal">
                    <form class="form-inline" action="{{ route('report.betweenDate') }}">
                        <div class="form-group">
                            <input type="text" class="form-control" id="datepicker" name="start" placeholder="بداية التاريخ">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="datepicker2" name="end" placeholder="نهاية التاريخ">
                        </div>
                        <button class="btn btn-default" type="submit">إرسال</button>
                    </form>
                    <div style="height: 50px">
                             @if($betweenOrders)
                                المجموع:
                              {{ $betweenOrders->sum('total_amount') }}
                                ريال
                            @endif
                    </div>

                    <table class="table" id="reportSalesBetween-table">
                        <thead>
                        <tr>
                            <th  style="text-align: right">رقم الطلب</th>
                            <th  style="text-align: right">تاريخ الطلب</th>
                            <th  style="text-align: right">العميل</th>
                            <th  style="text-align: right">عدد السلع</th>
                            <th  style="text-align: right">السعر الإجمالي</th>
                            <th  style="text-align: right">الخصم</th>
                            <th  style="text-align: right">القيمة المضافة</th>
                            <th  style="text-align: right">السعر النهائي</th>
                            <th  style="text-align: right">المدفوع</th>
                            <th  style="text-align: right">المتبقي</th>
                            <th  style="text-align: right">طريقة الدفع</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($betweenOrders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->order_date }}</td>
                                <td>{{ $order->client->client_name }}</td>
                                <td>{{ $order_items->has($order->id) ? count($order_items[$order->id]) : 0 }}</td>
                                <td>{{ $order->total_amount }}</td>
                                <td>{{ $order->discount }}</td>
                                <td>{{ $order->vat }}</td>
                                <td>{{ $order->grand_total }}</td>
                                <td>{{ $order->paid }}</td>
                                <td>{{ $order->due }}</td>
                                <td>{{ $order->payment_type }}</td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                    @if($start)
                        <button type="button" class="btn btn-success" id="printDatedSales" data-loading-text="Loading..." autocomplete="off"><i class="glyphicon glyphicon-ok-sign"></i>
                            <a style="color: white" href="{{ route('printDatedSales', ['start'=>$start, 'end'=>$end]) }}">
                                طباعة
                            </a>
                        </button>
                    @endif
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> المبيعات</div>
                </div> <!-- /panel-heading -->
                <div class="panel-body div-body-modal">
                <div style="height: 50px">
                    المجموع:
                       {{ $orders->sum('total_amount') }}
                    ريال
                </div>

    <table class="table" id="reportSales-table">
        <thead>
        <tr>
            <th  style="text-align: right">رقم الطلب</th>
            <th  style="text-align: right">تاريخ الطلب</th>
            <th  style="text-align: right">العميل</th>
            <th  style="text-align: right">عدد السلع</th>
            <th  style="text-align: right">السعر الإجمالي</th>
            <th  style="text-align: right">الخصم</th>
            <th  style="text-align: right">القيمة المضافة</th>
            <th  style="text-align: right">السعر النهائي</th>
            <th  style="text-align: right">المدفوع</th>
            <th  style="text-align: right">المتبقي</th>
            <th  style="text-align: right">طريقة الدفع</th>
        </tr>
        </thead>
        <tbody>
     @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->order_date }}</td>
                <td>{{ $order->client->client_name }}</td>
                <td>{{ $order_items->has($order->id) ? count($order_items[$order->id]) : 0 }}</td>
                <td>{{ $order->total_amount }}</td>
                <td>{{ $order->discount }}</td>
                <td>{{ $order->vat }}</td>
                <td>{{ $order->grand_total }}</td>
                <td>{{ $order->paid }}</td>
                <td>{{ $order->due }}</td>
                <td>{{ $order->payment_type }}</td>
            </tr>

        @endforeach
        </tbody>
    </table>
                    <button type="button" class="btn btn-success" id="printSales" data-loading-text="Loading..." autocomplete="off"><i class="glyphicon glyphicon-ok-sign"></i>
                        <a style="color: white" href="{{ route('printSales') }}">
                            طباعة
                        </a>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script>
        var token = '{{ Session::token() }}';
        var urlReportSales = '{{ route('postReportSales') }}';

    </script>
@endsection