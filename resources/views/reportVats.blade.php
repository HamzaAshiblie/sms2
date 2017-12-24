@extends('layouts.master')

@section('content')
    <form class="form-horizontal" id="reportVats">
        <table class="reportTable" id="width1">
            <tbody>
            <tr class="trReport">
                <td class="tdTitle">
                    اجمالي القيمة المضافة
                </td>
            </tr>
            <tr class="trReport">
                <td class="tdFactor">
                    <input style="width:150px;" type="text" name="from_date" value="" placeholder="بداية التاريخ">
                </td>
                <td class="tdFactor">
                    <input style="width:150px" type="text" name="to_date" value="" placeholder="نهاية التاريخ">
                </td>
                <td colspan="2" class="tdSearch">
                    <input style="height:30px;" type="submit" name="submit" value="إرسال">
                </td>
            </tr>
            </tbody>
        </table>
    </form> <!-- /.form -->

    <div style="height: 50px"></div>
    <table class="table" id="reportVats-table">
        <thead>
        <tr>
            <th  style="text-align: right">الاجمالي</th>
            <th  style="text-align: right">التاريخ</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
@endsection