@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">

            <ol class="breadcrumb">
                <li><a href="#">الرئيسية</a></li>
                <li>التقارير</li>
                <li class="active">المشتريات</li>
            </ol>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> المشتريات</div>
                </div> <!-- /panel-heading -->
                <div class="panel-body div-body-modal">
                    <form class="form-inline" action="{{ route('report.betweenProductDate') }}">
                        <div class="form-group">
                            <input type="text" class="form-control" id="datepicker" name="start" placeholder="بداية التاريخ">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="datepicker2" name="end" placeholder="نهاية التاريخ">
                        </div>
                        <button class="btn btn-default" type="submit">إرسال</button>
                    </form>
                    <div style="height: 50px">
                        @if($betweenProducts)
                            المجموع:
                            {{ $betweenProducts->sum('init_price') }}
                            ريال
                        @endif
                    </div>

                    <table class="table" id="reportSalesBetween-table">
                        <thead>
                        <tr>
                            <th  style="text-align: right">رقم المنتج</th>
                            <th  style="text-align: right">العائلة</th>
                            <th  style="text-align: right">المنتج</th>
                            <th  style="text-align: right">الكمية</th>
                            <th  style="text-align: right">الوحدة</th>
                            <th  style="text-align: right">سعر الشراء</th>
                            <th  style="text-align: right">سعر البيع</th>
                            <th style="width:15%; text-align: right">التحكم</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($betweenProducts as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->category->category_name }}</td>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ $product->product_quantity }}</td>
                                <td>{{ $product->product_unit }}</td>
                                <td>{{ $product->init_price }}</td>
                                <td>{{ $product->unit_price }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            التحكم <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a type="button" data-toggle="modal" id="import-product-modal-btn" data-productid="{{$product->id}}" > <i class="glyphicon glyphicon-plus-sign"></i> توريد</a></li>
                                            <li><a type="button" data-toggle="modal" id="edit-product-modal-btn" data-productid="{{$product->id}}" data-categoryid="{{$product->category_id}}"> <i class="glyphicon glyphicon-edit"></i> تعديل</a></li>
                                            <li><a type="button" data-toggle="modal" id="record-product-modal-btn" href="/productUpdate/{{$product->id}}"> <i class="glyphicon glyphicon-edit"></i> السجل</a></li>
                                            <li><a type="button" data-toggle="modal" data-productid="{{$product->id}}" data-target="#removeCategoriesModal" id="remove-product-modal-btn" onclick=""> <i class="glyphicon glyphicon-trash"></i> حذف</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> المبيعات</div>
                </div> <!-- /panel-heading -->
                <div class="panel-body div-body-modal">
                    <div style="height: 50px">
                        المجموع:
                        {{ $products->sum('init_price') }}
                        ريال
                    </div>

                    <table class="table" id="reportPurchases-table">
                        <thead>
                        <tr>
                            <th  style="text-align: right">رقم المنتج</th>
                            <th  style="text-align: right">العائلة</th>
                            <th  style="text-align: right">المنتج</th>
                            <th  style="text-align: right">الكمية</th>
                            <th  style="text-align: right">الوحدة</th>
                            <th  style="text-align: right">سعر الشراء</th>
                            <th  style="text-align: right">سعر البيع</th>
                            <th style="width:15%; text-align: right">التحكم</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->category->category_name }}</td>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ $product->product_quantity }}</td>
                                <td>{{ $product->product_unit }}</td>
                                <td>{{ $product->init_price }}</td>
                                <td>{{ $product->unit_price }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            التحكم <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a type="button" data-toggle="modal" id="import-product-modal-btn" data-productid="{{$product->id}}" > <i class="glyphicon glyphicon-plus-sign"></i> توريد</a></li>
                                            <li><a type="button" data-toggle="modal" id="edit-product-modal-btn" data-productid="{{$product->id}}" data-categoryid="{{$product->category_id}}"> <i class="glyphicon glyphicon-edit"></i> تعديل</a></li>
                                            <li><a type="button" data-toggle="modal" id="record-product-modal-btn" href="/productUpdate/{{$product->id}}"> <i class="glyphicon glyphicon-edit"></i> السجل</a></li>
                                            <li><a type="button" data-toggle="modal" data-productid="{{$product->id}}" data-target="#removeCategoriesModal" id="remove-product-modal-btn" onclick=""> <i class="glyphicon glyphicon-trash"></i> حذف</a></li>
                                        </ul>
                                    </div>
                                </td>
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