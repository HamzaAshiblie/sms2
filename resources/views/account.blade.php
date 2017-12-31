@extends('layouts.master')

@section('title')
    إعدادات الحسابات
@endsection

@section('content')
    <section class="row new-post">
        <div class="col-md-6 col-md-offset-3">
            <header><h3>الإعدادات</h3></header>
            <form action="#" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="username">اسم المستخدم</label>
                    <input type="text" name="username" class="form-control" value="{{ $user->name }}" id="username">
                </div>
                <div class="form-group">
                    <label for="passsword">كلمة المرور</label>
                    <input type="password" name="password" class="form-control" id="passsword">
                </div>
                <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
                <input type="hidden" value="{{ Session::token() }}" name="_token">
            </form>
        </div>
    </section>
        <section class="row new-post">
            <div class="col-md-6 col-md-offset-3">
                <img src="#" alt="" class="img-responsive">
            </div>
        </section>
    <div class="row" style="height: 10px"></div>
    <div class="row">
        <div class="col-md-3"></div>
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
        <div class="col-md-3"></div>

    </div>

@endsection