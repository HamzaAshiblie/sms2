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
                        @if(Auth::user()->isAdmin)
                        <button class="btn btn-default" id="add-product-modal-btn"> <i class="glyphicon glyphicon-plus-sign"></i> إضافة منتج </button>
                        @endif
                    </div> <!-- /div-action -->
                    <div id="switchCategoryDiv">
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
                                            <li><a type="button" data-toggle="modal" id="edit-product-modal-btn" data-productid="{{$product->id}}" data-categoryid="{{$product->category_id}}"> <i class="glyphicon glyphicon-edit"></i> تعديل</a></li>
                                            <li><a type="button" data-toggle="modal" id="record-product-modal-btn" href="/sms2/public/productUpdate/{{$product->id}}"> <i class="glyphicon glyphicon-edit"></i> السجل</a></li>
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

                        <div class="form-group">
                            <label for="add-category_id" class="col-sm-4 control-label">الصنف </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-7" id="error_add-category_id"></div>
                        </div> <!-- /form-group-->
                        <div class="form-group">
                            <label for="product_name" class="col-sm-4 control-label">اسم المنتج </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-7" id="error_add-product_name">
                                <input type="text" class="form-control" id="product_name" placeholder="اسم المنتج" name="product_name" autocomplete="off">
                                <h6 class="editErrorRed"></h6>
                            </div>
                        </div> <!-- /form-group-->
                        <div class="form-group">
                            <label for="product_unit" class="col-sm-4 control-label">الوحدة </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-7" id="error_add-product_unit">
                                <select class="form-control" id="product_unit" name="product_unit">
                                    <option value="">اختر</option>
                                    <option value="درزن">درزن</option>
                                    <option value="حبه">حبه</option>
                                </select>
                                <h6 class="editErrorRed"></h6>
                            </div>
                        </div> <!-- /form-group-->
                        <div class="form-group">
                            <label for="unit_price" class="col-sm-4 control-label">سعر البيع </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-7" id="error_add-unit_price">
                                <input type="text" class="form-control" id="unit_price" placeholder="سعر البيع" name="unit_price" onkeyup="this.value = numInput(this.value)" autocomplete="off">
                                <h6 class="editErrorRed"></h6>
                            </div>
                        </div> <!-- /form-group-->
                        <div class="form-group">
                            <label for="discount" class="col-sm-4 control-label">الخصم </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-7" id="error_add-discount">
                                <input type="text" class="form-control" id="discount" placeholder="الحد الأدنى للخصم" name="discount" onkeyup="this.value = numericInput(this.value)" autocomplete="off">
                                <h6 class="editErrorRed"></h6>
                            </div>
                        </div> <!-- /form-group-->
                        <div class="form-group">
                            <label for="limited" class="col-sm-4 control-label">منتج محدود </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-7" id="error_add-limited">
                                <input type="number" class="form-control" id="limited" placeholder="0" name="limited" min="0" autocomplete="off">
                                <h6 class="editErrorRed"></h6>
                            </div>
                        </div> <!-- /form-group-->
                    </div> <!-- /modal-body -->

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> إغلاق</button>

                        <button type="button" class="btn btn-primary" id="add_product_modal_save" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> حفظ</button>
                    </div> <!-- /modal-footer -->
                </form> <!-- /.form -->
            </div> <!-- /modal-content -->
        </div> <!-- /modal-dialog -->
    </div>
    <!-- /add products -->

    <!-- purchase products -->
    <div class="modal fade" id="purchaseProductsModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

                <form class="form-horizontal" id="purchaseProductForm">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="fa fa-plus"></i> شراء</h4>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="supplier" class="col-sm-4 control-label">المورد </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-7" id="error_purchase-supplier">
                                <input type="text" class="form-control" id="purchase-supplier" placeholder="اسم المورد" name="supplier" autocomplete="off">
                                <h6 class="editErrorRed"></h6>
                            </div>
                        </div> <!-- /form-group-->
                        <div class="form-group">
                            <label for="country" class="col-sm-4 control-label">بلد الصنع </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-7" id="error_purchase-country">
                                <input type="text" class="form-control" id="purchase-country" placeholder="بلد الصنع" name="country" autocomplete="off">
                                <h6 class="editErrorRed"></h6>
                            </div>
                        </div> <!-- /form-group-->
                        <div class="form-group">
                            <label for="product_quantity" class="col-sm-4 control-label">الكمية </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-7" id="error_purchase-product_quantity">
                                <input type="number" class="form-control" id="purchase-product_quantity" min="0" onkeyup="updateVat()" placeholder="الكمية" name="product_quantity" autocomplete="off">
                                <h6 class="editErrorRed"></h6>
                            </div>
                        </div> <!-- /form-group-->
                        <div class="form-group">
                            <label for="init_price" class="col-sm-4 control-label">سعر الشراء </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-7" id="error_purchase-init_price">
                                <input type="text" class="form-control" id="purchase-init_price" name="purchase-init_price" onkeyup="this.value = numInput(this.value); updateVat()" autocomplete="off">
                                <h6 class="editErrorRed"></h6>
                            </div>
                        </div> <!-- /form-group-->
                        <div class="form-group">
                            <label for="total_vat" class="col-sm-4 control-label">اجمالي القيمة المضافة </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-7" id="error_purchase-total_vat">
                                <input type="number" class="form-control" id="purchase-total_vat" name="purchase-total_vat" disabled="true" />
                                <h6 class="editErrorRed"></h6>
                            </div>
                        </div> <!--/form-group-->
                    </div> <!-- /modal-body -->

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> إغلاق</button>

                        <button type="button" class="btn btn-primary" id="purchase_product_btn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> حفظ</button>
                    </div> <!-- /modal-footer -->
                </form> <!-- /.form -->
            </div> <!-- /modal-content -->
        </div> <!-- /modal-dailog -->
    </div>
    <!-- /purchase products -->


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
                                <label for="edit-category_id" class="col-sm-4 control-label">العائلة: </label>
                                <label class="col-sm-1 control-label">: </label>
                                <div class="col-sm-7" id="error_edit-category_id"></div>
                            </div> <!-- /form-group-->
                            <div class="form-group">
                                <label for="edit-product_name" class="col-sm-4 control-label">اسم المنتج: </label>
                                <label class="col-sm-1 control-label">: </label>
                                <div class="col-sm-7" id="error_edit-product_name">
                                    <input type="text" class="form-control" id="edit-product_name" placeholder="اسم المنتج" name="edit-product_name" autocomplete="off">
                                    <h6 class="editErrorRed"></h6>
                                </div>
                            </div> <!-- /form-group-->
                            <div class="form-group">
                                <label for="edit-product_quantity" class="col-sm-4 control-label">الكمية: </label>
                                <label class="col-sm-1 control-label">: </label>
                                <div class="col-sm-7" id="error_edit-product_quantity">
                                    <input type="text" class="form-control" id="edit-product_quantity" placeholder="الكمية" name="edit-product_quantity" autocomplete="off">
                                    <h6 class="editErrorRed"></h6>
                                </div>
                            </div> <!-- /form-group-->
                            <div class="form-group">
                                <label for="edit-product_unit" class="col-sm-4 control-label">الوحدة: </label>
                                <label class="col-sm-1 control-label">: </label>
                                <div class="col-sm-7" id="error_edit-product_unit">
                                    <select class="form-control" id="edit-product_unit" name="edit-product_unit">
                                        <option value="">اختر</option>
                                        <option value="درزن">درزن</option>
                                        <option value="حبه">حبه</option>
                                    </select>
                                    <h6 class="editErrorRed"></h6>
                                </div>
                            </div> <!-- /form-group-->
                            <!--<div class="form-group">
                                <label for="edit-init_price" class="col-sm-4 control-label">سعر الشراء: </label>
                                <label class="col-sm-1 control-label">: </label>
                                <div class="col-sm-7" id="error_edit-init_price">
                                    <input type="text" class="form-control" id="edit-init_price" placeholder="سعر الشراء" name="edit-init_price" autocomplete="off">
                                    <h6 class="editErrorRed"></h6>
                                </div>
                            </div>  /form-group-->
                            <div class="form-group">
                                <label for="edit-unit_price" class="col-sm-4 control-label">سعر البيع: </label>
                                <label class="col-sm-1 control-label">: </label>
                                <div class="col-sm-7" id="error_edit-unit_price">
                                    <input type="text" class="form-control" id="edit-unit_price" placeholder="سعر البيع" name="edit-unit_price" autocomplete="off">
                                    <h6 class="editErrorRed"></h6>
                                </div>
                            </div> <!-- /form-group-->
                            <div class="form-group">
                                <label for="edit-discount" class="col-sm-4 control-label">الخصم: </label>
                                <label class="col-sm-1 control-label">: </label>
                                <div class="col-sm-7" id="error_edit-discount">
                                    <input type="text" class="form-control" id="edit-discount" placeholder="الحد الأعلى للخصم" name="edit-discount" autocomplete="off">
                                    <h6 class="editErrorRed"></h6>
                                </div>
                            </div> <!-- /form-group-->
                            <div class="form-group">
                                <label for="edit-limit" class="col-sm-4 control-label">منتج محدود: </label>
                                <label class="col-sm-1 control-label">: </label>
                                <div class="col-sm-7" id="error_edit-limit">
                                    <input type="text" class="form-control" id="edit-limit" placeholder="منتج محدود" name="edit-limit" autocomplete="off">
                                    <h6 class="editErrorRed"></h6>
                                </div>
                            </div> <!-- /form-group-->

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
    <!-- /modal-dialog -->
    </div>
    <!-- /products -->

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
                    <button type="button" class="btn btn-primary" id="delete-products-btn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> حذف</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- /delete product modal -->
    <script>
        var token = '{{ Session::token() }}';
        var urlAddProduct = '{{ route('product.create') }}';
        var urlPurchaseProduct = '{{ route('purchaseProduct') }}';
        var urlGetProduct = '{{ route('product') }}';
        var urlGetCategoryInProduct = '{{ route('fetchCategory') }}';
        var urlEditProduct = '{{ route('product.edit')}}';
        var urlDeleteProduct = '{{ route('product.delete')}}';
        var categoryIdSelect = '{{Route::Input('cat_id')}}';

        function updateVat() {
            var initPrice = Number($("#purchase-init_price").val());
            var quantity = Number($("#purchase-product_quantity").val());
            var totalVat = Number(initPrice*quantity*5)/100;
            $("#purchase-total_vat").val(totalVat);
        }
        function newCat(checkboxElem) {
            if (checkboxElem.checked) {
                $("#check-category").val('yes');
                console.log('checked');
                console.log($("#check-category").val());
                $("#add-category_id").val('');
                $("#add-category_id").attr("disabled",true);
                $("#new-category").attr("disabled",false);
            } else {
                $("#check-category").val('');
                console.log('unChecked');
                console.log($("#check-category").val());
                $("#add-category_id").attr("disabled",false);
                $("#new-category").val('');
                $("#new-category").attr("disabled",true);
            }
        }
    </script>
@endsection