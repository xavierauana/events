@inject("template", "App\Template")
@extends('back.layouts.default')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Create A New Page </div>
                    <div class="panel-body">
                        {!! Form::open(array("route"=>array('admin.pages.store'), "role"=>"form")) !!}
                        
                        {{-- URL Form Input--}}
                        <div class="form-group">
                            {!! Form::label("url","URL:") !!}
                            {!! Form::text("url",null,array("class"=>"form-control")) !!}
                            {!! $errors->first('url',"<span class='input-error'>:message</span>") !!}
                        </div>
                        
                        {{-- Active Form Input--}}
                        <div class="form-group">
                            {!! Form::label("active","Active:") !!}
                            {!! Form::select("active",array(0=>"Not Active", 1=>"Active"),null,array("class"=>"form-control")) !!}
                            {!! $errors->first('active',"<span class='input-error'>:message</span>") !!}
                        </div>
                        
                        {{-- Layout Form Input--}}
                        <div class="form-group">
                            {!! Form::label("template_id","Layout:") !!}
                            {!! Form::select("template_id",$template->lists("display", "id"),null,array("class"=>"form-control")) !!}
                            {!! $errors->first('template_id',"<span class='input-error'>:message</span>") !!}
                        </div>

                        {!! Form::submit("Create", array('class'=>'btn btn-success')) !!}


                        <a class="btn btn-info" href="{{route('admin.pages.index')}}" >Back</a>
                        {!! Form::close() !!}

                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection