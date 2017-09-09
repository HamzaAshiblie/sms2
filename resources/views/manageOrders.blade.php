@extends('layouts.master')

@section('content')

    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">Home</a></li>
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
            <table class="table" id="manageOrderTable">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Order Date</th>
                    <th>Client Name</th>
                    <th>Contact</th>
                    <th>Total Order Item</th>
                    <th>Payment Status</th>
                    <th>Option</th>
                </tr>
                </thead>
            </table>
        </div> <!--/panel-->
    </div> <!--/panel-->
    <script src="{{URL::to('src/js/order.js')}}"></script>

@endsection

