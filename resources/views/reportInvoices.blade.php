@extends('layouts.master')

@section('content')
    <form class="form-horizontal" id="reportInvoiceForm">
        <table class="reportTable" id="width1">
            <tbody>
            <tr class="trReport">
                <td class="tdTitle">
                    الفواتير
                </td>
            </tr>
            <tr class="trReport">
                <td class="tdFactor">
                    <input style="width:350px;" type="text" name="order_id" id="order_id" value="" placeholder="رقم الطلب">
                </td>
                <td colspan="2" class="tdSearch">
                    <button type="button" class="btn btn-primary" id="showInvoice" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> إرسال</button>
                </td>
            </tr>
            </tbody>
        </table>
    </form> <!-- /.form -->
    <script>
        var token = '{{ Session::token() }}';
        var urlReportInvoice = '{{ route('postReportInvoice') }}';
    </script>
@endsection