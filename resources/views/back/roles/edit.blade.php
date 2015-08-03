@extends('back.layouts.default')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Create A New Role</div>
                    <div class="panel-body">

                        {{ Form::model($role,array('route'=>array('admin.authentication.roles.update', $role->id), "role"=>"form", 'method'=>'PATCH')) }}
                        @include('back.roles.partials.form',array('submitButtonText'=>'Update Role'))

                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection