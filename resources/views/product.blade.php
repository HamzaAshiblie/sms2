@extends('layouts.master')

@section('content')

    @include('includes.message-block')

    <div class="row">
        <div class="col-md-12">

            <ol class="breadcrumb">
                <li><a href="#">الرئيسية</a></li>
                <li class="active">المنتجات</li>
            </ol>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> إدارة المنتجات</div>
                </div> <!-- /panel-heading -->
                <div class="panel-body div-body-modal">

                    <div class="div-add-product-modal pull-right" style="padding-bottom:20px;">
                        <button class="btn btn-default" id="add-product-modal-btn"> <i class="glyphicon glyphicon-plus-sign"></i> إضافة منتج </button>
                    </div> <!-- /div-action -->

                    <table class="table" id="datatable">
                        <thead>
                        <tr>
                            <th  style="text-align: right">المنتج</th>
                            <th  style="text-align: right">الوصف</th>
                            <th  style="text-align: right">الكمية</th>
                            <th  style="text-align: right">الوحدة</th>
                            <th  style="text-align: right">سعر البيع</th>
                            <th  style="text-align: right">سعر الشراء</th>
                            <th style="width:15%; text-align: right">التحكم</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ $product->product_description }}</td>
                                <td>{{ $product->product_quantity }}</td>
                                <td>{{ $product->product_unit }}</td>
                                <td>{{ $product->unit_price }}</td>
                                <td>{{ $product->init_price }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            التحكم <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a type="button" data-toggle="modal" id="edit-product-modal-btn" data-productid="{{$product->id}}"> <i class="glyphicon glyphicon-edit"></i> تعديل</a></li>
                                            <li><a type="button" data-toggle="modal" data-productid="{{$product->id}}" data-target="#removeCategoriesModal" id="remove-product-modal-btn" onclick=""> <i class="glyphicon glyphicon-trash"></i> حذف</a></li>
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


    <!-- add products -->
    <div class="modal fade" id="addProductsModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

                <form class="form-horizontal" id="addProductForm">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="fa fa-plus"></i> إضافة منتج</h4>
                    </div>
                    <div class="modal-body">

                        <div id=""></div>

                        <div class="form-group">
                            <label for="product_name" class="col-sm-4 control-label">اسم المنتج </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="product_name" placeholder="اسم المنتج" name="product_name" autocomplete="off">
                            </div>
                        </div> <!-- /form-group-->
                        <div class="form-group">
                            <label for="product_description" class="col-sm-4 control-label">الوصف </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="product_description" placeholder="وصف المنتج" name="product_description" autocomplete="off">
                            </div>
                        </div> <!-- /form-group-->
                        <div class="form-group">
                            <label for="product_quantity" class="col-sm-4 control-label">الكمية </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-7">
                                <input type="number" class="form-control" id="product_quantity" placeholder="الكمية" name="product_quantity" autocomplete="off">
                            </div>
                        </div> <!-- /form-group-->
                        <div class="form-group">
                            <label for="product_unit" class="col-sm-4 control-label">الوحدة </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="product_unit" placeholder="الوحدة" name="product_unit" autocomplete="off">
                            </div>
                        </div> <!-- /form-group-->
                        <div class="form-group">
                            <label for="unit_price" class="col-sm-4 control-label">سعر البيع </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="unit_price" placeholder="سعر البيع" name="unit_price" autocomplete="off">
                            </div>
                        </div> <!-- /form-group-->
                        <div class="form-group">
                            <label for="init_price" class="col-sm-4 control-label">سعر الشراء </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="init_price" placeholder="سعر الشراء" name="init_price" autocomplete="off">
                            </div>
                        </div> <!-- /form-group-->
                    </div> <!-- /modal-body -->

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> إغلاق</button>

                        <button type="button" class="btn btn-primary" id="add_product_modal_save" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> حفظ</button>
                    </div> <!-- /modal-footer -->
                </form> <!-- /.form -->
            </div> <!-- /modal-content -->
        </div> <!-- /modal-dailog -->
    </div>
    <!-- /add products -->


    <!-- edit products -->
    <div class="modal fade" id="edit-product-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

                <form class="form-horizontal">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="fa fa-edit"></i> تعديل بيانات المنتج</h4>
                    </div>
                    <div class="modal-body">

                        <div id="edit-products-messages"></div>

                        <div class="edit-products-result">
                            <div class="form-group">
                                <label for="edit-product-name" class="col-sm-4 control-label">اسم المنتج: </label>
                                <label class="col-sm-1 control-label">: </label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="edit-product_name" placeholder="اسم المنتج" name="edit-product_name" autocomplete="off">
                                </div>
                            </div> <!-- /form-group-->
                            <div class="form-group">
                                <label for="edit-product_description" class="col-sm-4 control-label">الوصف: </label>
                                <label class="col-sm-1 control-label">: </label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="edit-product_description" placeholder="الوصف" name="edit-product_description" autocomplete="off">
                                </div>
                            </div> <!-- /form-group-->
                            <div class="form-group">
                                <label for="edit-product_quantity" class="col-sm-4 control-label">الكمية: </label>
                                <label class="col-sm-1 control-label">: </label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="edit-product_quantity" placeholder="الكمية" name="edit-product_quantity" autocomplete="off">
                                </div>
                            </div> <!-- /form-group-->
                            <div class="form-group">
                                <label for="edit-product_unit" class="col-sm-4 control-label">الوحدة: </label>
                                <label class="col-sm-1 control-label">: </label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="edit-product_unit" placeholder="الوحدة" name="edit-product_unit" autocomplete="off">
                                </div>
                            </div> <!-- /form-group-->
                            <div class="form-group">
                                <label for="edit-unit-price" class="col-sm-4 control-label">سعر البيع: </label>
                                <label class="col-sm-1 control-label">: </label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="edit-unit_price" placeholder="سعر البيع" name="edit-unit_price" autocomplete="off">
                                </div>
                            </div> <!-- /form-group-->
                            <div class="form-group">
                                <label for="edit-init-price" class="col-sm-4 control-label">سعر الشراء: </label>
                                <label class="col-sm-1 control-label">: </label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="edit-init_price" placeholder="سعر الشراء" name="edit-init_price" autocomplete="off">
                                </div>
                            </div>

                        </div><!-- /edit brand result -->

                    </div> <!-- /modal-body -->

            <div class="modal-footer edit-products-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> إغلاق</button>

                <button type="button" class="btn btn-success" id="edit-products-btn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> حفظ</button>
            </div>
            <!-- /modal-footer -->
            </form>
            <!-- /.form -->
        </div>
        <!-- /modal-content -->
    </div>
    <!-- /modal-dailog -->
    </div>
    <!-- /categories brand -->

    <!-- delete products modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="delete-products-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> حذف المنتج</h4>
                </div>
                <div class="modal-body">
                    <p>هل تريد حذف المنتج بالتأكيد؟</p>
                </div>
                <div class="modal-footer delete-products-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> إغلاق</button>
                    <button type="button" class="btn btn-primary" id="delete-products-btn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> حفظ</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- /delete product modal -->

    <script>

        var token = '{{ Session::token() }}';
        var urlAddProduct = '{{ route('product.create') }}';
        var urlGetProduct = '{{ route('product') }}';
        var urlEditProduct = '{{ route('product.edit')}}';
        var urlDeleteProduct = '{{ route('product.delete')}}';
    </script>
@endsection