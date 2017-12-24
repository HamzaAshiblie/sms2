@extends('layouts.master')

@section('content')
    <form class="form-horizontal" id="reportSales">
        <table class="reportTable" id="width1">
            <tbody>
                <tr class="trReport">
                    <td class="tdTitle">
                        اجمالي المبيعات
                    </td>
                </tr>
                <tr class="trReport">
                    <td class="tdFactor">
                        <input style="width:350px;" type="text" name="from_date" value="" placeholder="ابحث برقم القطعة أو اسم المورد أو اسم العميل">
                    </td>
                    <td class="tdFactor">
                        <input style="width:150px;" type="text" name="from_date" value="" placeholder="بداية التاريخ">
                    </td>
                    <td class="tdFactor">
                        <input style="width:150px" type="text" name="to_date" value="" placeholder="نهاية التاريخ">
                    </td>
                    <td colspan="2" class="tdSearch">
                        <input style="height:29px;" type="submit" name="submit" value="إرسال">
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
@endsection