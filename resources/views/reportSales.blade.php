@extends('layouts.master')

@section('content')
    <form class="form-horizontal" id="reportSalesForm">
        <table class="reportTable" id="width1">
            <tbody>
                <tr class="trReport">
                    <td class="tdTitle">
                        اجمالي المبيعات
                    </td>
                </tr>
                <tr class="trReport">
                    <td class="tdFactor">
                        <input style="width:350px;" type="text" name="condition1" id="condition1" value="" placeholder="ابحث برقم القطعة أو اسم المورد أو اسم العميل">
                    </td>
                    <td class="tdFactor">
                        <input style="width:150px;" type="text" name="from_date" id="from_date" value="" placeholder="بداية التاريخ">
                    </td>
                    <td class="tdFactor">
                        <input style="width:150px" type="text" name="to_date" id="to_date" value="" placeholder="نهاية التاريخ">
                    </td>
                    <td colspan="2" class="tdSearch">
                        <button type="button" class="btn btn-primary" id="showReportSales" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> إرسال</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </form> <!-- /.form -->

    <div style="height: 50px"></div>
    <table class="table" id="reportSales-table">
        <thead>
        <tr>
            <th  style="text-align: right">رقم المنتج</th>
            <th  style="text-align: right">العائلة</th>
            <th  style="text-align: right">المنتج</th>
            <th  style="text-align: right">الكمية</th>
            <th  style="text-align: right">سعر البيع</th>
            <th  style="text-align: right">العميل</th>
            <th  style="text-align: right">التاريخ</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

    <script>
        var token = '{{ Session::token() }}';
        var urlReportSales = '{{ route('postReportSales') }}';
    </script>
@endsection