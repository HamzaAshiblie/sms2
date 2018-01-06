@extends('layouts.master')

@section('content')

    @include('includes.message-block')
    <div id="switchUpdateDiv">
        <label for="product_update_select" class="col-sm-1">تفاصيل العملية </label>
        <label class="col-sm-1 control-label">: </label>
        <div class="col-sm-3" id="switchPU">
            <select class="form-control" id="product_update_select" name="product_update_select">
                <option value="">اختر</option>
                <option value="all">الكل</option>
                <option value="مشتريات">مشتريات</option>
                <option value="مبيعات">مبيعات</option>
                <option value="مرتجع">مرتجع</option>
            </select>
        </div>
    </div> <!-- /form-group-->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="page-heading"> <i class="glyphicon glyphicon-edit"></i>سجل المنتج</div>
                </div> <!-- /panel-heading -->
                <div class="panel-body div-body-modal">

                    <table class="table" id="product-updates-table">
                        <thead>
                        <tr>
                            <th  style="text-align: right">رقم السجل</th>
                            <th  style="text-align: right">المنتج</th>
                            <th  style="text-align: right">الكمية</th>
                            <th  style="text-align: right">العملية</th>
                            <th  style="text-align: right">المورد</th>
                            <th  style="text-align: right">بلد الصنع</th>
                            <th  style="text-align: right">المبلغ</th>
                            <th  style="text-align: right">التاريخ</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($product_updates as $product_update)
                            <tr>
                                <td>{{ $product_update->id }}</td>
                                <td>{{ $product_update->product->product_name }}</td>
                                <td>{{ $product_update->product_quantity }}</td>
                                <td>{{ $product_update->operation }}</td>
                                <td>{{ $product_update->supplier }}</td>
                                <td>{{ $product_update->country }}</td>
                                <td>{{ $product_update->amount }}</td>
                                <td>{{ $product_update->created_at->format('Y-m-d') }}</td>
                            </tr>
                        @endforeach

                        </tbody>

                    </table>
                    <!-- /table -->

                </div> <!-- /panel-body -->
            </div> <!-- /panel -->
        </div> <!-- /col-md-12 -->
    </div> <!-- /row -->
    <script>
        var product_id = '{{Route::Input('product_id')}}';
    </script>

@endsection