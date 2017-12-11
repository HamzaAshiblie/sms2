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
                    <div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> إدارة الأصناف</div>
                </div> <!-- /panel-heading -->
                <div class="panel-body div-body-modal">

                    <div class="div-add-category-modal pull-right" style="padding-bottom:20px;">
                        <button class="btn btn-default" id="add-category-modal-btn"> <i class="glyphicon glyphicon-plus-sign"></i> إضافة صنف </button>
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
                                <td>{{ count($category->products) }}</td>
                                <td>{{ $category->category_quantity }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            التحكم <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
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
        var urlGetCategory = '{{ route('category') }}';
        var urlEditCategory = '{{ route('category.edit')}}';
        var urlDeleteCategory = '{{ route('category.delete')}}';

    </script>
@endsection