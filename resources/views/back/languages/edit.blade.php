@extends('back.layouts.default')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit language code ( {{$language->code}} ) </div>
                    <div class="panel-body">
                        {!!  Form::model($language, array("route"=>array('admin.languages.update', $language->id), "role"=>"form", "method"=>"PATCH")) !!}
                            @include('back.languages.partials.form',array('submitButtonText'=>'Update'))
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection