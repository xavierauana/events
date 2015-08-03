@extends('back.layouts.default')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Create A New Menu Group </div>
                    {!!  Form::open(array('route'=>array('admin.menus.group.store'), "role"=>"form")) !!}
                        <div class="panel-body">
                            @include("back.menus.partials.formGroup")
                        </div>
                        <div class="panel-footer">
                            {!!  Form::submit("Create Group", array('class'=>'btn btn-success btn-block')) !!}
                            <a href="{{route('admin.menus.index')}}" class="btn btn-info btn-block">back</a>
                        </div>
                    {!!  Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection