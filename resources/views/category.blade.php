@extends('layouts.master')

@section('content')
        <div class="row">
        <div class="col-md-12">

            <ol class="breadcrumb">
                <li><a href="#">الرئيسية</a></li>
                <li class="active">الأصناف</li>
            </ol>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> إدارة العائلات</div>
                </div> <!-- /panel-heading -->
                <div class="panel-body div-body-modal">

                    <div class="div-add-category-modal pull-right" style="padding-bottom:20px;">
                        @if(Auth::user()->isAdmin)
                        <button class="btn btn-default" id="add-category-modal-btn"> <i class="glyphicon glyphicon-plus-sign"></i> إضافة عائلة </button>
                        @endif
                    </div> <!-- /div-action -->


                    <table class="table" id="categories-table">
                        <thead>
                        <tr>
                            <th  style="text-align: right">الصنف</th>
                            <th  style="text-align: right">الوصف</th>
                            <th  style="text-align: right">عدد المنتجات</th>
                            <th  style="text-align: right">الكمية</th>
                            <th style="width:15%; text-align: right">التحكم</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->category_name }}</td>
                                <td>{{ $category->category_description }}</td>
                                <td>
                                    <a href="/product/{{$category->id}}">
                                        {{ count($category->products) }}
                                    </a>
                                </td>
                                <td>{{ $category->category_quantity }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            التحكم <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a type="button" data-toggle="modal" id="add-product-modal-btn2" data-categoryid="{{$category->id}}"> <i class="glyphicon glyphicon-edit"></i> إضافة منتج</a></li>
                                            <li><a type="button" data-toggle="modal" id="edit-category-modal-btn" data-categoryid="{{$category->id}}"> <i class="glyphicon glyphicon-edit"></i> تعديل</a></li>
                                            <li><a type="button" data-toggle="modal" data-categoryid="{{$category->id}}" data-target="#removeCategoriesModal" id="remove-category-modal-btn" onclick=""> <i class="glyphicon glyphicon-trash"></i> حذف</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>

                    </table>
                    <!-- /table -->

                    <!-- add products -->
                    <div class="modal fade" id="addProductsModal2" tabindex="-1" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <form class="form-horizontal" id="addProductForm2">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title"><i class="fa fa-plus"></i> إضافة منتج</h4>
                                    </div>
                                    <div class="modal-body">

                                        <div class="form-group">
                                            <label for="category_id" class="col-sm-4 control-label">العائلة </label>
                                            <label class="col-sm-1 control-label">: </label>
                                            <div class="col-sm-7" id="error_category_id">
                                                <input type="text" class="form-control" id="category_id" name="category_id" autocomplete="off" disabled="true">
                                            </div>
                                        </div> <!-- /form-group-->
                                        <div class="form-group">
                                            <label for="product_name2" class="col-sm-4 control-label">اسم المنتج </label>
                                            <label class="col-sm-1 control-label">: </label>
                                            <div class="col-sm-7" id="error_add-product_name2">
                                                <input type="text" class="form-control" id="product_name2" placeholder="اسم المنتج" name="product_name2" autocomplete="off">
                                                <h6 class="editErrorRed"></h6>
                                            </div>
                                        </div> <!-- /form-group-->
                                        <div class="form-group">
                                            <label for="product_unit2" class="col-sm-4 control-label">الوحدة </label>
                                            <label class="col-sm-1 control-label">: </label>
                                            <div class="col-sm-7" id="error_add-product_unit2">
                                                <select class="form-control" id="product_unit2" name="product_unit2">
                                                    <option value="">اختر</option>
                                                    <option value="درزن">درزن</option>
                                                    <option value="حبه">حبه</option>
                                                </select>
                                                <h6 class="editErrorRed"></h6>
                                            </div>
                                        </div> <!-- /form-group-->
                                        <div class="form-group">
                                            <label for="unit_price2" class="col-sm-4 control-label">سعر البيع </label>
                                            <label class="col-sm-1 control-label">: </label>
                                            <div class="col-sm-7" id="error_add-unit_price2">
                                                <input type="text" class="form-control" id="unit_price2" placeholder="سعر البيع" name="unit_price2" onkeyup="this.value = numInput(this.value)" autocomplete="off">
                                                <h6 class="editErrorRed"></h6>
                                            </div>
                                        </div> <!-- /form-group-->
                                        <div class="form-group">
                                            <label for="discount2" class="col-sm-4 control-label">الخصم </label>
                                            <label class="col-sm-1 control-label">: </label>
                                            <div class="col-sm-7" id="error_add-discount2">
                                                <input type="text" class="form-control" id="discount2" placeholder="الحد الأدنى للخصم" name="discount2" onkeyup="this.value = numericInput(this.value)" autocomplete="off">
                                                <h6 class="editErrorRed"></h6>
                                            </div>
                                        </div> <!-- /form-group-->
                                        <div class="form-group">
                                            <label for="limited2" class="col-sm-4 control-label">منتج محدود </label>
                                            <label class="col-sm-1 control-label">: </label>
                                            <div class="col-sm-7" id="error_add-limited2">
                                                <input type="number" class="form-control" id="limited2" placeholder="0" name="limited2" min="0" autocomplete="off">
                                                <h6 class="editErrorRed"></h6>
                                            </div>
                                        </div> <!-- /form-group-->
                                    </div> <!-- /modal-body -->

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> إغلاق</button>

                                        <button type="button" class="btn btn-primary" id="add_product_modal_save2" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> حفظ</button>
                                    </div> <!-- /modal-footer -->
                                </form> <!-- /.form -->
                            </div> <!-- /modal-content -->
                        </div> <!-- /modal-dailog -->
                    </div>
                    <!-- /add products -->

                </div> <!-- /panel-body -->
            </div> <!-- /panel -->
        </div> <!-- /col-md-12 -->
    </div> <!-- /row -->


    <!-- add category -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

                <form class="form-horizontal" id="addCategoryForm">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="fa fa-plus"></i> إضافة صنف</h4>
                    </div>
                    <div class="modal-body">

                        <div id=""></div>

                        <div class="form-group">
                            <label for="category_name" class="col-sm-4 control-label">اسم الصنف </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-7" id="error_add-category_name">
                                <input type="text" class="form-control" id="category_name" placeholder="اسم الصنف" name="category_name" autocomplete="off">
                                <h6 class="editErrorRed"></h6>
                            </div>
                        </div> <!-- /form-group-->
                        <div class="form-group">
                            <label for="category_description" class="col-sm-4 control-label">الوصف </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-7" id="error_add-category_description">
                                <input type="text" class="form-control" id="category_description" placeholder="الوصف" name="category_description" autocomplete="off">
                                <h6 class="editErrorRed"></h6>
                            </div>
                        </div> <!-- /form-group-->
                    </div> <!-- /modal-body -->

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> إغلاق</button>

                        <button type="button" class="btn btn-primary" id="add_category_modal_save" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> حفظ</button>
                    </div> <!-- /modal-footer -->
                </form> <!-- /.form -->
            </div> <!-- /modal-content -->
        </div> <!-- /modal-dialog -->
    </div>
    <!-- /add category -->


    <!-- edit category -->
    <div class="modal fade" id="edit-category-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

                <form class="form-horizontal">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="fa fa-edit"></i> تعديل بيانات الصنف</h4>
                    </div>
                    <div class="modal-body">

                        <div id="edit-categories-messages"></div>

                        <div class="edit-categories-result">
                            <div class="form-group">
                                <label for="edit-category_name" class="col-sm-4 control-label">اسم الصنف: </label>
                                <label class="col-sm-1 control-label">: </label>
                                <div class="col-sm-7" id="error_edit-category_name">
                                    <input type="text" class="form-control" id="edit-category_name" placeholder="اسم الصنف" name="edit-category_name" autocomplete="off">
                                    <h6 class="editErrorRed"></h6>
                                </div>
                            </div> <!-- /form-group-->
                            <div class="form-group">
                                <label for="edit-category_description" class="col-sm-4 control-label">الوصف: </label>
                                <label class="col-sm-1 control-label">: </label>
                                <div class="col-sm-7" id="error_edit-category_description">
                                    <input type="text" class="form-control" id="edit-category_description" placeholder="الوصف" name="edit-category_description" autocomplete="off">
                                    <h6 class="editErrorRed"></h6>
                                </div>
                            </div> <!-- /form-group-->

                        </div>
                        <!-- /edit category result -->

                    </div> <!-- /modal-body -->

                    <div class="modal-footer edit-categories-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> إغلاق</button>

                        <button type="button" class="btn btn-success" id="edit-categories-btn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> حفظ</button>
                    </div>
                    <!-- /modal-footer -->
                    <div id="edit-category-msg"></div>

                </form>
                <!-- /.form -->
            </div>
            <!-- /modal-content -->
        </div>
        <!-- /modal-dailog -->
    </div>
    <!-- /categories brand -->

    <!-- delete categories modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="delete-categories-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> حذف الصنف</h4>
                </div>
                <div class="modal-body">
                    <p>هل تريد حذف الصنف بالتأكيد؟</p>
                </div>
                <div class="modal-footer delete-categories-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> إغلاق</button>
                    <button type="button" class="btn btn-primary" id="delete-categories-btn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> حذف</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- /delete category modal -->
    <script>

        var token = '{{ Session::token() }}';
        var urlAddCategory = '{{ route('category.create') }}';
        var urlAddProduct = '{{ route('product.create') }}';
        var urlGetCategory = '{{ route('category') }}';
        var urlGetProduct = '{{ route('product') }}';
        var urlEditCategory = '{{ route('category.edit')}}';
        var urlDeleteCategory = '{{ route('category.delete')}}';

    </script>
@endsection