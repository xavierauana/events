@extends('front.layouts.default')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <br />
            <div class="panel panel-default">
                <div class="panel-heading">Reset Password</div>
                <div class="panel-body">
                    {{ Form::open(array('url'=>'auth/password/reset?token='.$token, "role"=>"form")) }}

                        {{-- Password  Form Input--}}
                        <div class="form-group">
                            {{ Form::label("password","Password:") }}
                            {{ Form::password("password",array("class"=>"form-control")) }}
                            {{ $errors->first('password',"<span class='input-error'>:message</span>") }}
                        </div>

                        {{-- Confirm Password Form Input--}}
                        <div class="form-group">
                            {{ Form::label("password_confirmation","Confirm Password:") }}
                            {{ Form::password("password_confirmation",array("class"=>"form-control")) }}
                            {{ $errors->first('password_confirmation',"<span class='input-error'>:message</span>") }}
                        </div>

                    {{ Form::submit("Update Password", array('class'=>'btn btn-default')) }}


                    {{ Form::close() }}

                </div>

            </div>
        </div>
    </div>
</div>
@endsection