@extends('back.layouts.default')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Create A New Menu Item </div>
                    {!!  Form::open(array("route"=>array('admin.menus.item.store', $menuGroupId), "role"=>"form")) !!}

                    <div class="panel-body">
                        @include("back.menus.partials.formItem")
                    </div>
                    {!!  Form::close() !!}

                </div>
            </div>
        </div>
    </div>
@endsection