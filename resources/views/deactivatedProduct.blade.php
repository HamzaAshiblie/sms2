@extends('layouts.master')

@section('content')
    @include('includes.message-block')
    <div class="row">
        <div class="col-md-12">

            <ol class="breadcrumb">
                <li><a href="#">الرئيسية</a></li>
                <li class="active">المنتجات الخاملة</li>
            </ol>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> إدارة المنتجات الخاملة</div>
                </div> <!-- /panel-heading -->
                <div class="panel-body div-body-modal">
                    <!--<div id="switchCategoryDiv">
                        <label for="category_id" class="col-sm-1">العائلة </label>
                        <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-3" id="switchCategory"></div>
                    </div> <!-- /form-group-->
                    <div id="test">
                    </div>

                    <table class="table" id="products-table">
                        <thead>
                        <tr>
                            <th  style="text-align: right">رقم المنتج</th>
                            <th  style="text-align: right">العائلة</th>
                            <th  style="text-align: right">المنتج</th>
                            <th  style="text-align: right">الكمية</th>
                            <th  style="text-align: right">الوحدة</th>
                            @if(Auth::user()->isAdmin)
                                <th  style="text-align: right">سعر الشراء</th>
                            @endif
                            <th  style="text-align: right">سعر البيع</th>
                            <th  style="text-align: right">الخصم</th>
                            <th  style="text-align: right">منتج محدود</th>
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
                                @if(Auth::user()->isAdmin)
                                    <td>
                                        {{ $product->init_price }}
                                    </td>
                                @endif
                                <td>{{ $product->unit_price }}</td>
                                <td>{{ $product->discount }}</td>
                                <td>{{ $product->limit }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            التحكم <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a type="button" data-toggle="modal" id="purchase-product-modal-btn" data-productid="{{$product->id}}" > <i class="glyphicon glyphicon-plus-sign"></i> شراء</a></li>
                                            <li><a type="button" data-toggle="modal" id="activate-product-modal-btn" data-productid="{{$product->id}}"> <i class="glyphicon glyphicon-edit"></i> إعادة تفعيل المنتج</a></li>
                                            <li><a type="button" data-toggle="modal" id="record-product-modal-btn" href="/productUpdate/{{$product->id}}"> <i class="glyphicon glyphicon-edit"></i> السجل</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>

                    </table>
                    <!-- /table -->

                </div> <!-- /panel-body -->
            </div> <!-- /panel -->
        </div> <!-- /col-md-12 -->
    </div> <!-- /row -->

    <!-- activate products modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="activate-products-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> تفعيل المنتج</h4>
                </div>
                <div class="modal-body">
                    <p>هل تريد تفعيل المنتج بالتأكيد؟</p>
                </div>
                <div class="modal-footer delete-products-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> إغلاق</button>
                    <button type="button" class="btn btn-primary" id="activate-products-btn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> تفعيل</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- /activate product modal -->
    <script>
        var token = '{{ Session::token() }}';
        //var urlGetProduct = '{{ route('product') }}';
        var urlGetCategoryInProduct = '{{ route('fetchCategory') }}';
        var urlActivateProduct = '{{ route('activateProduct')}}';
        var urlGetDeactivatedProduct = '{{ route('deactivatedProduct') }}';
        var categoryIdSelect = '{{Route::Input('cat_id')}}';

    </script>
@endsection