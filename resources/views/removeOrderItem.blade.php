@extends('layouts.master')

@section('content')

    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">الرئيسية</a></li>
        <li>الطلبات</li>
        <li class="active">
            ترجيع السلع
        </li>
    </ol>
    <div class="panel panel-default">
        <div class="panel-heading">


            <i class="glyphicon glyphicon-plus-sign"></i>	ترجيع السلع


        </div> <!--/panel-->
        <div class="panel-body">
            <div class="success-messages">
                @include('includes.message-block')
            </div> <!--/success-messages-->
            <form class="form-horizontal" method="POST" action="" id="removeOrderItemForm">

                <div class="form-group">
                    <label for="client_ame" class="col-sm-2 control-label">اسم العميل </label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" value="{{ $order->client->client_name }}" id="clientName" name="client_name" autocomplete="off" disabled="true"/>
                    </div>
                    <label for="order_date" class="col-sm-2 control-label">تاريخ الطلب </label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="order_date" name="order_date" value="{{ $order->order_date }}" autocomplete="off" disabled="true"/>
                    </div>
                </div> <!--/form-group-->
                <table class="table" id="removedItemTable">
                    <thead>
                    <tr>
                        <th style="width:10%;">#رقم المنتج </th>
                        <th style="width:20%;">المنتج </th>
                        <th style="width:10%;">السعر </th>
                        <th style="width:10%;">الخصم </th>
                        <th style="width:10%;">الكمية </th>
                        <th style="width:10%;">الكمية المرتجعة </th>
                        <th style="width:10%;">المجموع </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $row = 1;?>
                    @foreach($order_items as $order_item)
                        <tr id="row<?php echo $row; ?>" class="">
                            <td style="padding-left:20px;">
                                <input type="text" value="{{ $order_item->product_id }}" name="product_id[]" id="product_id" autocomplete="off" disabled="true" class="form-control" />
                                <input type="hidden" value="{{ $order_item->id }}" name="order_item_id[]" id="order_item_id" />
                            </td>
                            <td style="margin-left:20px;">
                                <input type="text" value="{{ $order_item->product->product_name }}" name="product_name" id="product_name" autocomplete="off" disabled="true" class="form-control" />
                            </td>
                            <td style="padding-left:20px;">
                                <input type="text" value="{{ $order_item->rate }}" name="unit_price[]" id="unit_price<?=$row?>" autocomplete="off" disabled="true" class="form-control" />
                            </td>
                            <td style="padding-left:20px;">
                                <input type="text" value="{{ $order_item->item_discount }}" name="item_discount[]" id="item_discount<?=$row?>" autocomplete="off" disabled="true" class="form-control" />
                            </td>
                            <td style="padding-left:20px;">
                                <div class="form-group">
                                    <input type="number" value="{{ $order_item->quantity }}" name="quantity[]" id="quantity<?=$row?>"  autocomplete="off" disabled="true" class="form-control" />
                                </div>
                            </td>
                            <td style="padding-left:20px;">
                                <input type="number" value="0" min="0" max="{{ $order_item->quantity }}" name="removed_quantity[]" id="removed_quantity<?=$row?>" data-quantity="1" onkeyup="setQuantity(<?php echo $row; ?>)" autocomplete="off" class="form-control" />
                            </td>
                            <td style="padding-left:1px;">
                                <input type="text" name="total[]" id="total<?=$row?>" value="0" autocomplete="off" class="form-control" disabled="true" />
                            </td>
                        </tr>
                        <?php $row++?>
                    @endforeach
                    </tbody>
                </table>

                <div class="form-group">
                    <label for="grand_total" class="col-sm-2 control-label">المجموع الأولي </label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="grand_total" name="grand_total" value="{{ $order->grand_total }}" autocomplete="off" disabled="true"/>
                    </div>
                    <label for="removed_total" class="col-sm-2 control-label">المجموع المرتجع </label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" value="0" id="removed_total" name="removed_total" autocomplete="off" disabled="true"/>
                        <input type="hidden" value="{{ Route::current()->getParameter('order_id') }}" name="order_id" id="order_id" />

                    </div>
                    <label for="removed_discount" class="col-sm-2 control-label">الخصم المرتجع </label>
                    <div class="col-sm-3">
                        <input type="number" class="form-control" value="0" id="removed_discount" name="removed_discount" autocomplete="off" disabled="true"/>
                    </div>
                </div> <!--/form-group-->

                <div class="form-group submitButtonFooter">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" id="createOrderBtn" data-loading-text="Loading..." class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i>ترجيع السلع</button>
                        <button type="reset" class="btn btn-default" onclick="resetOrderForm()"><i class="glyphicon glyphicon-erase"></i> مسح</button>
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                    </div>
                </div>
            </form>
            <div id="success-order"></div>
        </div> <!--/panel-->
    </div> <!--/panel-->

    <script>
        var token = '{{ Session::token() }}';
        var urlRemoveOrderItem = '{{ route('removeItem') }}';
    </script>


@endsection

