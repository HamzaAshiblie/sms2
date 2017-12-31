@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">

            <ol class="breadcrumb">
                <li><a href="#">الرئيسية</a></li>
                <li>التقارير</li>
                <li class="active">الفاوتير</li>
            </ol>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> الفواتير</div>
                </div> <!-- /panel-heading -->
                <div class="panel-body div-body-modal">
    <form class="form-horizontal" id="reportInvoiceForm">
        @include('includes.message-block')
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
                </div>
            </div>
        </div>
    </div>
    <script>
        var token = '{{ Session::token() }}';
        var urlReportInvoice = '{{ route('postReportInvoice') }}';
    </script>
@endsection