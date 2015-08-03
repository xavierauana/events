@extends('front.layouts.default')

@section('content')
    <br />
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1 col-xs-12">
                <div class="col-sm-6 col-xs-12">
                    @include('back.partials.message')
                    <form class="form-horizontal" role="form" method="POST" action="{{route('login')}}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label class="control-label">E-Mail Address</label>

                            <input type="email" class="form-control" name="email" value="">
                        </div>

                        <div class="form-group">
                            <label class="control-label">Password</label>
                            <input type="password" class="form-control" name="password">
                        </div>

                        {{--<div class="form-group">--}}
                            {{--<div class="col-md-6 col-md-offset-4">--}}
                                {{--<div class="checkbox">--}}
                                    {{--<label>--}}
                                        {{--<input type="checkbox" name="remember"> Remember Me--}}
                                    {{--</label>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        <div class="form-group">
                                <button type="submit" class="btn btn-primary" style="margin-right: 15px;">
                                    Login
                                </button>

                                <a href="/auth/password/email">Forgot Your Password?</a>
                        </div>
                    </form>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <p>註冊賬戶</p>
                    <p> 註冊一個賬戶以便您更快捷地購物，查看訂單狀態，</p>
                    <p>查看訂購記錄，和更多的管理項目。</p>

                    <p>用戶註冊</p>
                    <br />
                    <br />
                    <a class="btn btn-primary" href="#">成為 ETV 會員</a>
                </div>

            </div>
        </div>
    </div>
@endsection
