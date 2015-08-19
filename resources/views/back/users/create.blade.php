@extends('back.layouts.default')

@section('stylesheets')
    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create A new User</div>
                    <div class="panel-body">
                        @include('back.users.partials.error')
                        {!! Form::open(array('route'=>array('admin.users.store'), "role"=>"form", 'method'=>'POST', 'class'=>'form-horizontal')) !!}
                            @include('back.users.partials.form',array('submitButtonText'=>'Create New User'))
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
