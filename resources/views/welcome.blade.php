@extends('layouts.master')

@section('title')
    نظام إدارة المستودعات
@endsection

@section('content')
    @include('includes.message-block')
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">تسجيل مستخدم جديد</h3>
                </div>
                <div class="panel-body">
                    <div class="messages">
                        <!--//////////////////////////////////////////////////////////////////
                        ///////////TO DO LOGIN ERROR MESSAGES/////////////////////////////
                        //////////////////////////////////////////////////////////////////-->
                    </div>
                    <form class="form-horizontal" action="{{ route('signup') }}" method="post">
                        <fieldset>
                            <div class="form-group ">
                                <div class="col-sm-10 {{$errors->has('email')? 'has-error':''}}">
                                    <input class="form-control" type="text" name="email" id="email" placeholder="البريد الإلكتروني" value="{{ Request::old('email') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-10 {{$errors->has('username')? 'has-error':''}}">
                                    <input class="form-control" type="text" name="username" id="username" placeholder="اسم المستخدم" value="{{ Request::old('username') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-10 {{$errors->has('password')? 'has-error':''}}">
                                    <input class="form-control" type="password" name="password" id="passsword" placeholder="كلمة المرور">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-log-in"></i>
                                تسجيل
                            </button>
                            <input type="hidden" name="_token" value="{{ Session::token() }}">
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">تسجيل الدخول</h3>
                </div>
                <div class="panel-body">
                    <div class="messages">
                        <!--//////////////////////////////////////////////////////////////////
                        ///////////TO DO LOGIN ERROR MESSAGES/////////////////////////////
                        //////////////////////////////////////////////////////////////////-->
                    </div>
                    <form class="form-horizontal" action="{{ route('signin') }}" method="post">
                        <fieldset>
                            <div class="form-group">
                                <div class="col-sm-10 {{$errors->has('email')? 'has-error':''}}">
                                    <input class="form-control" type="text" name="email" id="email" placeholder="البريد الإلكتروني">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-10 {{$errors->has('password')? 'has-error':''}}">
                                    <input class="form-control" type="password" name="password" id="passsword" placeholder="كلمة المرور">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-log-in"></i>
                            دخول
                            </button>
                            <input type="hidden" name="_token" value="{{ Session::token() }}">
                        </fieldset>
                    </form>
                </div>
            </div>

        </div>
    </div>

@endsection
