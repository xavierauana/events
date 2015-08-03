@extends('back.layouts.default')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Setting - {{$setting->display}} </div>
                    <div class="panel-body">
                        {{ Form::model($setting, array("route"=>array('admin.settings.update', $setting->id), "role"=>"form", "method"=>"PATCH")) }}
                        <input type="hidden" name="code" value="{{$setting->code}}" />
                        {{-- URL Form Input--}}
                        <div class="form-group">
                            {{ Form::label("display","Display:") }}
                            {{ Form::text("display",null,array("class"=>"form-control")) }}
                            {{ $errors->first('display',"<span class='input-error'>:message</span>") }}
                        </div>

                        {{-- Active Form Input--}}
                        <div class="form-group">
                            {{ Form::label("value","Value:") }}
                            @if($setting->input_type == 'select')
                            {{ Form::select("value",$roleList,null,array("class"=>"form-control")) }}
                            @else
                            {{ Form::text("value",null,array("class"=>"form-control")) }}
                            @endif
                            {{ $errors->first('value',"<span class='input-error'>:message</span>") }}
                        </div>



                        {{ Form::submit("Update", array('class'=>'btn btn-success')) }}


                        <a class="btn btn-info" href="{{route('admin.settings.index')}}" >Back</a>
                        {{ Form::close() }}


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection