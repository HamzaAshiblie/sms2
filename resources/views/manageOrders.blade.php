@extends('layouts.master')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}">الرئيسية</a></li>
                <li>الطلبات</li>
                <li class="active">
                    إضافة طلب
                </li>
            </ol>
            <div class="panel panel-default">
                <div class="panel-heading">

                    <i class="glyphicon glyphicon-plus-sign"></i>	إضافة طلب


                </div> <!--/panel-->
                <div class="panel-body">

                    <div class="success-messages">
                        @include('includes.message-block')
                    </div> <!--/success-messages-->
                    <table class="table" id="datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>التاريخ</th>
                            <th>العميل</th>
                            <th>عدد السلع</th>
                            <th>المجموع الكلي</th>
                            <th>الخصم</th>
                            <th>القيمة المضافة</th>
                            <th>المجموع النهائي</th>
                            <th>المدفوع</th>
                            <th>الباقي</th>
                            <th>طريقة الدفع</th>
                            <th>التحكم</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->order_date }}</td>
                                <td>{{ $order->client->client_name }}</td>
                                <td>{{ $order_items->has($order->id) ? count($order_items[$order->id]) : 0 }}</td>
                                <td>{{ $order->total_amount }}</td>
                                <td>{{ $order->discount }}</td>
                                <td>{{ $order->vat }}</td>
                                <td>{{ $order->grand_total }}</td>
                                <td>{{ $order->paid }}</td>
                                <td>{{ $order->due }}</td>
                                <td>{{ $order->payment_type }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            التحكم <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a type="button" data-toggle="modal" id="edit-payment-modal-btn" data-orderid="{{$order->id}}"> <i class="glyphicon glyphicon-edit"></i> تحديث المدفوعات</a></li>
                                            <li><a type="button" data-toggle="modal" id="remove-order-items-modal-btn" href="/removeOrderItem/{{$order->id}}"> <i class="glyphicon glyphicon-trash"></i> ترجيع السلع</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div> <!--/panel-->
            </div> <!--/panel-->
        </div> <!-- /col-md-12 -->
    </div> <!-- /row -->

    <!-- edit payments -->
    <div class="modal fade" id="edit-payment-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

                <form class="form-horizontal" id="editPaymentForm">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="fa fa-edit"></i> تحديث المدفوعات</h4>
                    </div>
                    <div class="modal-body">

                        <div id="edit-payments-messages"></div>

                        <div class="edit-payments-result">
                            <div class="form-group">
                                <label for="edit-total_amount" class="col-sm-4 control-label">المجموع الكلي: </label>
                                <label class="col-sm-1 control-label">: </label>
                                <div class="col-sm-7" id="error_edit-total_amount">
                                    <input type="text" class="form-control" id="edit-total_amount" placeholder="المجوع الكلي" name="edit-total_amount" autocomplete="off" disabled="true">
                                    <h6 class="editErrorRed"></h6>
                                </div>
                            </div> <!-- /form-group-->
                            <div class="form-group">
                                <label for="edit-discount" class="col-sm-4 control-label">الخصم: </label>
                                <label class="col-sm-1 control-label">: </label>
                                <div class="col-sm-7" id="error_edit-discount">
                                    <input type="text" class="form-control" id="edit-discount" placeholder="الخصم" name="edit-discount" autocomplete="off" disabled="true">
                                    <h6 class="editErrorRed"></h6>
                                </div>
                            </div> <!-- /form-group-->
                            <div class="form-group">
                                <label for="edit-vat" class="col-sm-4 control-label">القيمة المضافة: </label>
                                <label class="col-sm-1 control-label">: </label>
                                <div class="col-sm-7" id="error_edit-vat">
                                    <input type="text" class="form-control" id="edit-vat" placeholder="" name="edit-vat" autocomplete="off" disabled="true">
                                    <h6 class="editErrorRed"></h6>
                                </div>
                            </div> <!-- /form-group-->
                            <div class="form-group">
                                <label for="edit-grand_total" class="col-sm-4 control-label">المجموع النهائي: </label>
                                <label class="col-sm-1 control-label">: </label>
                                <div class="col-sm-7" id="error_edit-grand_total">
                                    <input type="text" class="form-control" id="edit-grand_total" placeholder="المجموع النهائي" name="edit-grand_total" autocomplete="off" disabled="true">
                                    <h6 class="editErrorRed"></h6>
                                </div>
                            </div> <!-- /form-group-->
                            <div class="form-group">
                                <label for="edit-paid" class="col-sm-4 control-label">المدفوع: </label>
                                <label class="col-sm-1 control-label">: </label>
                                <div class="col-sm-7" id="error_edit-paid">
                                    <input type="text" class="form-control" id="edit-paid" placeholder="المدفوع" name="edit-paid" autocomplete="off" disabled="true">
                                    <h6 class="editErrorRed"></h6>
                                </div>
                            </div> <!-- /form-group-->
                            <div class="form-group">
                                <label for="edit-due" class="col-sm-4 control-label">الباقي: </label>
                                <label class="col-sm-1 control-label">: </label>
                                <div class="col-sm-7" id="error_edit-due">
                                    <input type="text" class="form-control" id="edit-due" placeholder="الباقي" name="edit-due" autocomplete="off" disabled="true">
                                    <h6 class="editErrorRed"></h6>
                                </div>
                            </div> <!-- /form-group-->
                            <div class="form-group">
                                <label for="edit-pay" class="col-sm-4 control-label">دفع: </label>
                                <label class="col-sm-1 control-label">: </label>
                                <div class="col-sm-7" id="error_edit-pay">
                                    <input type="text" class="form-control" id="edit-pay" placeholder="0" name="edit-pay" autocomplete="off" onkeyup="this.value=minMax2(this.value)">
                                    <h6 class="editErrorRed"></h6>
                                </div>
                            </div> <!-- /form-group-->
                            <div class="form-group">
                                <label for="edit-payment_type" class="col-sm-4 control-label">طريقة الدفع: </label>
                                <label class="col-sm-1 control-label">: </label>
                                <div class="col-sm-7" id="error_edit-payment_type">
                                    <select class="form-control" name="edit-payment_type" id="edit-payment_type">
                                        <option value="">~~اختر~~</option>
                                        <option value="آجل">آجل</option>
                                        <option value="نقدي">نقدي</option>
                                    </select>
                                    <h6 class="editErrorRed"></h6>
                                </div>
                            </div> <!--/form-group-->

                        </div>
                        <!-- /edit brand result -->

                    </div> <!-- /modal-body -->

                    <div class="modal-footer edit-payment-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> إغلاق</button>

                        <button type="button" class="btn btn-success" id="edit-payment-btn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> حفظ</button>
                    </div>
                    <!-- /modal-footer -->
                    <div id="edit-payment-msg"></div>
                </form>
                <!-- /.form -->
            </div>
            <!-- /modal-content -->
        </div>
        <!-- /modal-dailog -->
    </div>
    <!-- /payments brand -->

    <!--  remove order items modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="remove-order-items-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="form-horizontal">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> ترجيع السلع</h4>
                    </div>
                    <div class="modal-body">
                        <div class="edit-clients-result">
                            <div class="form-group">
                                <label for="remove-product_name" class="col-sm-5 control-label">المنتج: </label>
                                <label class="col-sm-1 control-label">: </label>
                                <label id="remove-product_name"></label>
                            </div> <!-- /form-group-->
                            <div class="form-group">
                                <label for="remove-item" class="col-sm-5 control-label">الكمية: </label>
                                <label class="col-sm-1 control-label">: </label>
                                <div class="col-sm-5" id="div-remove-item">
                                    <input type="number" class="form-control" max="100" min="0" class="form-control" id="remove-item" placeholder="الباقي" name="remove-item" autocomplete="off">
                                </div>
                            </div> <!-- /form-group-->

                        </div>
                    </div><!-- /.modal-body -->
                    <div class="modal-footer remove-order-items-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> إغلاق</button>
                        <button type="button" class="btn btn-primary" id="remove-order-items-btn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> حفظ</button>
                    </div>
                </form>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!--  remove order items modal -->

    <script rel="stylesheet">
        var token = '{{ Session::token() }}';
        var urlEditPayment = '{{ route('updatePayment') }}';
        var urlFetchOrderItems = '{{ route('fetchOrderItems') }}';
        function minMax2(value)
        {
            var paid = $("#edit-due").val();
            console.log(paid);
            console.log(value);
            if(parseInt(value) < 0 || isNaN(value) || parseInt(paid) < value){
                return 0;
            } else {
                return value;
            }
        }
    </script>
@endsection

