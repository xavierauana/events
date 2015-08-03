@extends('back.layouts.default')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Create A New Menu Item </div>
                    {!!  Form::model($menuItem, array("route"=>array('admin.menus.item.update', $menuItem->id), "role"=>"form", 'method'=>'PATCH')) !!}

                    <div class="panel-body">
                        @include("back.menus.partials.formItem")
                    </div>
                    {!!  Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection