@extends('layouts.master')

@section('content')

    @include('includes.message-block')

    <div class="row">
    <div class="col-md-12">

        <ol class="breadcrumb">
            <li><a href="#">الرئيسية</a></li>
            <li class="active">العملاء</li>
        </ol>

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> إدارة العملاء</div>
            </div> <!-- /panel-heading -->
            <div class="panel-body div-body-modal">

                <div class="div-add-client-modal pull-right" style="padding-bottom:20px;">
                    <button class="btn btn-default" id="add-client-modal-btn"> <i class="glyphicon glyphicon-plus-sign"></i> إضافة عميل </button>
                </div> <!-- /div-action -->

                <table class="table" id="datatable">
                    <thead>
                    <tr>
                        <th  style="text-align: right">العميل</th>
                        <th  style="text-align: right">الشركة</th>
                        <th style="width:15%; text-align: right">التحكم</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($clients as $client)
                        <tr>
                            <td>{{ $client->client_name }}</td>
                            <td>{{ $client->client_company }}</td>
                            <td style="display: none">{{ $client->client_email }}</td>
                            <td style="display: none">{{ $client->client_phone }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        التحكم <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a type="button" data-toggle="modal" id="edit-client-modal-btn" data-clientid="{{$client->id}}"> <i class="glyphicon glyphicon-edit"></i> تعديل</a></li>
                                        <li><a type="button" data-toggle="modal" data-clientid="{{$client->id}}" data-target="#removeCategoriesModal" id="remove-client-modal-btn" onclick=""> <i class="glyphicon glyphicon-trash"></i> حذف</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>

                </table>
                <!-- /table -->

                <!--PAGINATION-->
                <div class="">

                    {{ $clients->links() }}

                </div>
                <!--/PAGINATION-->

            </div> <!-- /panel-body -->
        </div> <!-- /panel -->
    </div> <!-- /col-md-12 -->
</div> <!-- /row -->


<!-- add clients -->
    <div class="modal fade" id="addClientsModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

                <form class="form-horizontal">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="fa fa-plus"></i> إضافة عميل</h4>
                    </div>
                    <div class="modal-body">

                        <div id=""></div>

                        <div class="form-group">
                            <label for="client_name" class="col-sm-4 control-label">اسم العميل </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="client_name" placeholder="اسم العميل" name="client_name" autocomplete="off">
                            </div>
                        </div> <!-- /form-group-->
                        <div class="form-group">
                            <label for="client_company" class="col-sm-4 control-label">الشركة </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="client_company" placeholder="الشركة" name="client_company" autocomplete="off">
                            </div>
                        </div> <!-- /form-group-->
                        <div class="form-group">
                            <label for="client_email" class="col-sm-4 control-label">البريد الإلكتروني </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="client_email" placeholder="البريد الإلكتروني" name="client_email" autocomplete="off">
                            </div>
                        </div> <!-- /form-group-->
                        <div class="form-group">
                            <label for="client_phone" class="col-sm-4 control-label">الهاتف </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="client_phone" placeholder="الهاتف" name="client_phone" autocomplete="off">
                            </div>
                        </div> <!-- /form-group-->
                    </div> <!-- /modal-body -->

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> إغلاق</button>

                        <button type="button" class="btn btn-primary" id="add_client_modal_save" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> حفظ</button>
                    </div> <!-- /modal-footer -->
                </form> <!-- /.form -->
            </div> <!-- /modal-content -->
        </div> <!-- /modal-dailog -->
    </div>
<!-- /add clients -->


<!-- edit clients -->
<div class="modal fade" id="edit-client-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <form class="form-horizontal">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-edit"></i> تعديل بيانات العميل</h4>
                </div>
                <div class="modal-body">

                    <div id="edit-clients-messages"></div>

                    <div class="edit-clients-result">
                        <div class="form-group">
                            <label for="edit-client-name" class="col-sm-4 control-label">اسم العميل: </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="edit-client_name" placeholder="اسم العميل" name="edit-client_name" autocomplete="off">
                            </div>
                        </div> <!-- /form-group-->
                        <div class="form-group">
                            <label for="edit-client_company" class="col-sm-4 control-label">الشركة: </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="edit-client_company" placeholder="الشركة" name="edit-client_company" autocomplete="off">
                            </div>
                        </div> <!-- /form-group-->
                        <div class="form-group">
                            <label for="edit-client_email" class="col-sm-4 control-label">البريد الإلكتروني: </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="edit-client_email" placeholder="البريد الإلكتروني" name="edit-client_email" autocomplete="off">
                            </div>
                        </div> <!-- /form-group--><div class="form-group">
                            <label for="edit-client_phone" class="col-sm-4 control-label">الهاتف: </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="edit-client_phone" placeholder="الهاتف" name="edit-client_phone" autocomplete="off">
                            </div>
                        </div> <!-- /form-group-->

                    </div>
                    <!-- /edit brand result -->

                </div> <!-- /modal-body -->

                <div class="modal-footer edit-clients-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> إغلاق</button>

                    <button type="button" class="btn btn-success" id="edit-clients-btn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> حفظ</button>
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

<!-- delete clients modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="delete-clients-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> حذف العميل</h4>
            </div>
            <div class="modal-body">
                <p>هل تريد حذف العميل بالتأكيد؟</p>
            </div>
            <div class="modal-footer delete-clients-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> إغلاق</button>
                <button type="button" class="btn btn-primary" id="delete-clients-btn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> حفظ</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /delete clients modal -->

<script>

    var token = '{{ Session::token() }}';
    var urlAddClient = '{{ route('client.create') }}';
    var urlGetClient = '{{ route('client') }}';
    var urlEditClient = '{{ route('client.edit')}}';
    var urlDeleteClient = '{{ route('client.delete')}}';
</script>
@endsection