@extends('back.layouts.default')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Create A New Role</div>
                    <div class="panel-body">

                        {{ Form::open(array('route'=>'admin.authentication.roles.store', "role"=>"form")) }}

                        @include('back.roles.partials.form',array('submitButtonText'=>'Create New User'))

                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection