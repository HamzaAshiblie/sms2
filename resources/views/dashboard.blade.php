@extends('layouts.master')

@section('content')

<div class="row">

    <div class="col-md-4">
        <div class="panel panel-success">
            <div class="panel-heading">

                <a href="#" style="text-decoration:none;color:black;">
                    إجمال المنتجات
                    <span class="badge pull pull-right">100</span>
                </a>

            </div> <!--/panel-hdeaing-->
        </div> <!--/panel-->
    </div> <!--/col-md-4-->

    <div class="col-md-4">
        <div class="panel panel-info">
            <div class="panel-heading">
                <a href="#" style="text-decoration:none;color:black;">
                    إجمال الطلبات
                    <span class="badge pull pull-right">200</span>
                </a>

            </div> <!--/panel-heading-->
        </div> <!--/panel-->
    </div> <!--/col-md-4-->

    <div class="col-md-4">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <a href="#" style="text-decoration:none;color:black;">
                    منتجات محدودة
                    <span class="badge pull pull-right">5</span>
                </a>

            </div> <!--/panel-heading-->
        </div> <!--/panel-->
    </div> <!--/col-md-4-->

    <div class="col-md-4">
        <div class="card">
            <div class="cardHeader">
                <h1><?php echo date('d'); ?></h1>
            </div>

            <div class="cardContainer">
                <p><?php echo date('l') .' '.date('d').', '.date('Y'); ?></p>
            </div>
        </div>
        <br/>

        <div class="card">
            <div class="cardHeader" style="background-color:#245580;">
                <h1>1000000</h1>
            </div>

            <div class="cardContainer">
                <p> <i class="glyphicon glyphicon-usd"></i>الإيرادات</p>
            </div>
        </div>

    </div>

    <div class="col-md-8">
        <div class="panel panel-default">
            @include('includes.calender')
        </div>

    </div>


</div> <!--/row-->
@endsection