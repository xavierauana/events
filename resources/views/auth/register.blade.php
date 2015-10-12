
@extends('front.layouts.default')

@section('meta')
    <meta name="description" content="Free Web tutorials">
    <meta name="keywords" content="HTML,CSS,XML,JavaScript">
    <meta name="author" content="Hege Refsnes">
@endsection

@section('title') Registration Page @endsection

@section('stylesheets')
    <style>
        .list-unstyled{
            margin-bottom: 20px;
        }
        li{
            margin-bottom: 5px;
        }
        .list-unstyled a{
            border-radius: 0;
            text-align: left;
        }
        #resetButton{
            margin-left: 20px;
        }
    </style>
@endsection

@section('content')
    <div class="container" style="padding-top:0">
        <div class="page-title" style="background-color: #fdd204; width: 100%; margin:0; height:130px; line-height: 130px; font-size: 5.5em; font-weight:600; text-align: right; padding-right: 15px; color: #231f20; margin-bottom: 30px">
            Register
        </div>
        <div class="content" style="margin: 0 15px">
            <h4>註冊成為會員</h4>
            <p>歡迎來到我們網站，如果您是新用戶，請填寫下面的表單進行註冊。如果您已經是本站的會員，請您直接登錄。</p>
            <div class="col-md-6">
                <ul class="list-unstyled">
                    <li><a class="btn btn-primary btn-block" href=""><i class="fa fa-facebook"></i> Registration with Facebook</a></li>
                    <li><a class="btn btn-primary btn-block" href=""><i class="fa fa-twitter"></i> Registration with Twitter</a></li>
                    <li><a class="btn btn-primary btn-block" href=""><i class="fa fa-google"></i> Registration with Google</a></li>
                </ul>

                <fieldset>
                    <legend>個人資料</legend>
                    <form method="POST" action="/auth/register">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <input class="form-control" name="name" type="text" placeholder="Name *" value="{{old("name")}}" required/>
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="email" type="email" placeholder="Email Address *" value="{{old("email")}}" required/>
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="password" type="password" placeholder="Password *" value="{{old("password")}}" required/>
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="password_confirmation" type="password" placeholder="Confirm Password *" value="{{old("password_confirmation")}}" required/>
                        </div>
                        <div>
                            <button class="btn btn-default" type="submit">Register</button>
                            <button class="btn btn-default" id="resetButton">Reset</button>
                        </div>
                        <br />
                        <p>本表格註上星號的 (*) 必須填寫，其他可以空缺不填。</p>
                        <p>按”成為用戶”時同時同意網站服務條款</p>
                        <p>如想更加清楚我們的同意網站服務條款 請到我們的 網站使用條款 及 不承擔責任的聲明</p>
                    </form>
                </fieldset>
            </div>
        </div>
    </div>
@endsection
