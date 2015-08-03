@extends('back.layouts.default')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Update the Permission</div>
                    <div class="panel-body">
                        {{ Form::model($permission, array('route'=>array('admin.authentication.permissions.update',$permission->id), "role"=>"form", 'method'=>'PATCH')) }}
                            @include('back.permissions.partials.form',array('submitButtonText'=>'Update Permission'))
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection