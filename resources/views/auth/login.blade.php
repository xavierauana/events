@extends('front.layouts.default')

@section('meta')
    <meta name="description" content="Free Web tutorials">
    <meta name="keywords" content="HTML,CSS,XML,JavaScript">
    <meta name="author" content="Hege Refsnes">
@endsection

@section('title') Login <Page></Page> @endsection

@section('stylesheets')
    <style>
        .hidden-xs.row{
            display: table;
        }

        .hidden-xs [class*="col-"]{
            float: none;
            display: table-cell;
            vertical-align: top;
        }
        .row.hidden-xs div:first-child{
            border: 1px solid yellow;
        }
        .row.hidden-xs div:last-child{
            border: 1px solid yellow;
            border-left: 0;
        }

        #registrationButton, #submitButton{
            position:absolute;
            bottom: 10px;
            border-radius: 0;
        }

        .social-login a{
            text-align: left;
            margin-bottom: 5px;
            border-radius: 0;
        }

        ul.social-login {
            margin-bottom: 100px;
        }

    </style>
@endsection

@section('content')
    @if(count($errors)>0)
        <ul>
            @foreach($errors->all() as $message)
                <li><span class='input-error'>{{$message}}</span></li>
            @endforeach
        </ul>
    @endif
    <div class="container" style="padding-top:0">
        <div class="page-title" style="background-color: #fdd204; width: 100%; margin:0; height:130px; line-height: 130px; font-size: 5.5em; font-weight:600; text-align: right; padding-right: 15px; color: #231f20; margin-bottom: 30px">
            Login
        </div>
        <div class="content" style="margin: 0 15px">
            <div class="row hidden-xs">
                <div class="col-xs-12 col-sm-6">
                    <h4>User Login</h4>
                    <form method="POST" action="/auth/login">
                        {!! csrf_field() !!}

                        {{-- Email Form Input--}}
                        <div class="form-group">
                            {!! Form::label("email","Email:") !!}
                            {!! Form::input("email","email",null,["class"=>"form-control"]) !!}
                        </div>

                        {{-- Password Form Input--}}
                        <div class="form-group">
                            {!! Form::label("password","Password:") !!}
                            {!! Form::password("password",["class"=>"form-control"]) !!}
                        </div>

                        {!! Form::submit("User Login",["class"=>"btn btn-primary", "id"=>"submitButton"]) !!}

                    </form>

                </div>
                <div class="col-xs-12 col-sm-6">
                    <h4>註冊賬戶</h4>
                    <p>註冊一個賬戶以便您更快捷地購物，查看訂單狀態，查看訂購記錄，和更多的管理項目。</p>
                    <p>用戶註冊</p>
                    <ul class="list-unstyled social-login">
                        <li><a href="#" class="btn btn-primary btn-block"><i class="fa fa-facebook"></i> Login with Facebook</a></li>
                        <li><a href="#" class="btn btn-primary btn-block"><i class="fa fa-google"></i> Login with Google</a></li>
                        <li><a href="#" class="btn btn-primary btn-block"><i class="fa fa-twitter"></i> Login with Twitter</a></li>
                    </ul>
                    <a href="/auth/register" class="btn btn-primary" id="registrationButton">Register New Account</a>
                </div>
            </div>

            <div class="row visible-xs">
                <div class="col-xs-12 col-sm-6">
                    <h4>User Login</h4>
                    <form method="POST" action="/auth/login">
                        {!! csrf_field() !!}

                        {{-- Email Form Input--}}
                        <div class="form-group">
                            {!! Form::label("email","Email:") !!}
                            {!! Form::input("email","email",null,["class"=>"form-control"]) !!}
                        </div>

                        {{-- Password Form Input--}}
                        <div class="form-group">
                            {!! Form::label("password","Password:") !!}
                            {!! Form::password("password",["class"=>"form-control"]) !!}
                        </div>

                        {!! Form::submit("Login",["class"=>"btn btn-primary"]) !!}

                    </form>

                </div>
                <div class="col-xs-12 col-sm-6">
                    <h4>註冊賬戶</h4>
                    <p>註冊一個賬戶以便您更快捷地購物，查看訂單狀態，查看訂購記錄，和更多的管理項目。</p>
                    <p>用戶註冊</p>
                    <ul class="list-unstyled social-login">
                        <li><a href="#" class="btn btn-primary btn-block"><i class="fa fa-facebook"></i> Login with Facebook</a></li>
                        <li><a href="#" class="btn btn-primary btn-block"><i class="fa fa-google"></i> Login with Google</a></li>
                        <li><a href="#" class="btn btn-primary btn-block"><i class="fa fa-twitter"></i> Login with Twitter</a></li>
                    </ul>
                    <a href="/auth/register" class="btn btn-primary" id="registrationButton">Register New Account</a>
                </div>
            </div>

        </div>
    </div>



@endsection
