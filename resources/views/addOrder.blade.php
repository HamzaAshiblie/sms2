@extends('layouts.master')

@section('content')

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
            <form class="form-horizontal" method="POST" action="{{ route('createOrder') }}" id="createOrderForm">

                <div class="form-group">
                    <label for="order_date" class="col-sm-2 control-label">date التاريخ</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="order_date" name="order_date" value="{{ date('Y-m-d') }}" autocomplete="off" />
                    </div>
                </div> <!--/form-group-->
                <div class="form-group">
                    <label for="clientName" class="col-sm-2 control-label">client name اسم العميل</label>
                    <div class="col-sm-10">
                        <select name="client_id" id="client_id" class="form-control">
                            <option value="">اختر</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->client_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div> <!--/form-group-->

            <table class="table" id="productTable">
                <thead>
                <tr>
                    <th style="width:10%;">#number</th>
                    <th style="width:40%;">product المنتج</th>
                    <th style="width:10%;">السعرprice</th>
                    <th style="width:10%;">الكميةquntity</th>
                    <th style="width:10%;">المتبقي</th>
                    <th style="width:10%;">المجموعtotal</th>
                    <th style="width:10%;"></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $arrayNumber = 0;
                for($x = 1; $x < 4; $x++) { ?>
                <tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">
                    <td style="padding-left:20px;">
                        <input type="text" name="product_id[]" id="product_id<?php echo $x; ?>" onkeyup="getProductDataWithId(<?php echo $x; ?>)" autocomplete="off" class="form-control" />
                    </td>
                    <td style="margin-left:20px;">
                        <div class="form-group">

                            <select class="form-control" name="product_name[]" id="product_name<?php echo $x; ?>" onchange="getProductData(<?php echo $x; ?>)" >
                                <option value="">~~إختر~~</option>
                                @foreach($products as $product)
                                <option value='{{ $product->id }}' id='changeProduct{{ $product->id }}'>{{ $product->product_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </td>
                    <td style="padding-left:20px;">
                        <input type="text" name="unit_price[]" id="unit_price<?php echo $x; ?>" autocomplete="off" disabled="true" class="form-control" />
                    </td>
                    <td style="padding-left:20px;">
                        <div class="form-group">
                            <input type="text" name="product_quantity[]" id="product_quantity<?php echo $x; ?>" onchange="getTotal(<?php echo $x ?>)" autocomplete="off" class="form-control" min="1" />
                        </div>
                    </td>
                    <td style="padding-left:20px;">
                        <input type="text" name="total_quantity" id="total_quantity<?php echo $x; ?>" autocomplete="off" class="form-control" disabled="true" />
                    </td>
                    <td style="padding-left:1px;">
                        <input type="text" name="total[]" id="total<?php echo $x; ?>" autocomplete="off" class="form-control" disabled="true" />
                        <input type="hidden" name="totalValue[]" id="totalValue<?php echo $x; ?>" autocomplete="off" class="form-control" />
                    </td>
                    <td>
                        <button class="btn btn-default removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)"><i class="glyphicon glyphicon-trash"></i></button>
                    </td>
                </tr>
                <?php
                $arrayNumber++;
                } // /for
                ?>
                </tbody>
            </table>

            <div class="col-md-6">

                <div class="form-group" style="display: none">
                    <label for="subTotal" class="col-sm-3 control-label">المجموع الكلي</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="subTotal" name="subTotal" disabled="true" />
                        <input type="hidden" class="form-control" id="subTotalValue" name="subTotalValue" />
                    </div>
                </div> <!--/form-group-->
                <div class="form-group" style="display: none">
                    <label for="vat" class="col-sm-3 control-label">VAT 13%</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="vat" name="vat" disabled="true" />
                        <input type="hidden" class="form-control" id="vatValue" name="vatValue" />
                    </div>
                </div> <!--/form-group-->
                <div class="form-group">
                    <label for="total_amount" class="col-sm-3 control-label">المجموع الكلي</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="total_amount" name="total_amount"/>
                        <input type="hidden" class="form-control" id="totalAmountValue" name="totalAmountValue" />
                    </div>
                </div> <!--/form-group-->
                <div class="form-group">
                    <label for="discount" class="col-sm-3 control-label">الخصم</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="discount" name="discount" onkeyup="discountFunc()" autocomplete="off" />
                    </div>
                </div> <!--/form-group-->
                <div class="form-group">
                    <label for="grand_total" class="col-sm-3 control-label">المجموع النهائي</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="grand_total" name="grand_total" />
                        <input type="hidden" class="form-control" id="grandTotalValue" name="grandTotalValue" />
                    </div>
                </div> <!--/form-group-->
            </div> <!--/col-md-6-->

            <div class="col-md-6">
                <div class="form-group">
                    <label for="paid" class="col-sm-3 control-label">المدفوع</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="paid" name="paid" autocomplete="off" onkeyup="paidAmount()" />
                    </div>
                </div> <!--/form-group-->
                <div class="form-group">
                    <label for="due" class="col-sm-3 control-label">الباقي</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="due" name="due" />
                        <input type="hidden" class="form-control" id="dueValue" name="dueValue" />
                    </div>
                </div> <!--/form-group-->

                <div class="form-group">
                    <label for="payment_type" class="col-sm-3 control-label">طريقة الدفع</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="payment_type" id="payment_type">
                            <option value="">~~اختر~~</option>
                            <option value="آجل">آجل</option>
                            <option value="نقدي">نقدي</option>
                        </select>
                    </div>
                </div> <!--/form-group-->
            </div> <!--/col-md-6-->


            <div class="form-group submitButtonFooter">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="button" class="btn btn-default" onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-plus-sign"></i> إضافة منتج</button>

                    <button type="submit" id="createOrderBtn" data-loading-text="Loading..." class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> حفظ الطلب</button>

                    <button type="reset" class="btn btn-default" onclick="resetOrderForm()"><i class="glyphicon glyphicon-erase"></i> مسح</button>
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                </div>
            </div>
<div class="clearfix"></div>
            </form>
            <div id="success-order"></div>
    </div> <!--/panel-->
</div> <!--/panel-->
<script>
    var token = '{{ Session::token() }}';
    var urlGetFetchProduct = '{{ route('fetchProductData') }}';
    var urlFetchSelectedProduct = '{{ route('fetchSelectedProduct') }}';
    var urlAddOrder = '{{ route('createOrder') }}';
    var urlOrder = '{{ route('addOrder') }}';
</script>

@endsection

