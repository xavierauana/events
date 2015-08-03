@extends('back.layouts.default')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                @include('back.partials.message')
                <div class="panel panel-default">
                    <div class="panel-heading">Upload Users CSV file </div>
                    <div class="panel-body">
                        {{ Form::open(array('action'=>'UsersController@UploadCSV', "role"=>"form", 'files'=>true)) }}
                        {{--  Form Input--}}
                        <div class="form-group">
                            {{ Form::label("csv","CSV file:") }}
                            {{ Form::file("csv",array("class"=>"form-control")) }}
                            {{ $errors->first('csv',"<span class='input-error'>:message</span>") }}
                        </div>
                        <a href="{{route('admin.users.index')}}" class="btn btn-info" data-dismiss="modal">Back</a>
                        <input type="submit" class="btn btn-success" value="Upload">
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
