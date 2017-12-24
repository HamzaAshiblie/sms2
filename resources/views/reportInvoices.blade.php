@extends('layouts.master')

@section('content')
    <form class="form-horizontal" id="reportInvoices">
        <table class="reportTable" id="width1">
            <tbody>
            <tr class="trReport">
                <td class="tdTitle">
                    الفواتير
                </td>
            </tr>
            <tr class="trReport">
                <td class="tdFactor">
                    <input style="width:350px;" type="text" name="from_date" value="" placeholder="ابحث برقم الطلب">
                </td>
                <td colspan="2" class="tdSearch">
                    <input style="height:29px;" type="submit" name="submit" value="إرسال">
                </td>
            </tr>
            </tbody>
        </table>
    </form> <!-- /.form -->

@endsection