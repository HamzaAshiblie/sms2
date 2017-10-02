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
            <table class="table" id="datatable">
                <thead>
                <tr>
                    <th>#</th>
                    <th>التاريخ</th>
                    <th>العميل</th>
                    <th>عدد السلع</th>
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
                        <td>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    التحكم <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a type="button" data-toggle="modal" id="edit-client-modal-btn" data-clientid="{{$order->id}}"> <i class="glyphicon glyphicon-edit"></i> تعديل</a></li>
                                    <li><a type="button" data-toggle="modal" data-clientid="{{$order->id}}" data-target="#removeCategoriesModal" id="remove-client-modal-btn" onclick=""> <i class="glyphicon glyphicon-trash"></i> حذف</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div> <!--/panel-->
    </div> <!--/panel-->
    <script src="{{URL::to('src/js/order.js')}}"></script>
@endsection

