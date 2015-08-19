@extends('back.layouts.default')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                @include('back.partials.message')
                {!! Form::open(array('route'=>array('admin.contents.store',$pageId,$layoutType), 'files'=>true, "method"=>"POST")) !!}
                <div class="panel panel-default">
                    <div class="panel-heading">Contents </div>
                    <div class="panel-body">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Meta Data
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                    <div class="panel-body">
                                        <div role="tabpanel">
                                            <!-- Nav tabs -->
                                            <ul class="nav nav-tabs" role="tablist">
                                                @foreach($activeLanguages as $language)
                                                    <li role="presentation" class="{{$language->id == $defaultLanguage->id ? 'active':''}}"><a href="#{{$language->code}}" aria-controls="home" role="tab" data-toggle="tab">{{$language->display}}</a></li>
                                                @endforeach
                                            </ul>
                                            <div class="tab-content">
                                                @foreach($activeLanguages as $language)
                                                    @foreach($contents as $content)
                                                        @if($language->id == $content->lang_id)
                                                            <div role="tabpanel" class="tab-pane {{$language->id == $defaultLanguage->id ? 'active':''}}" id="{{$language->code}}">
                                                                <br />
                                                                @foreach($fields as  $field)
                                                                    @include("contents.partials.metaForm",[compact('language','field')])
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            </div>
                                        </div>
                                        <!--End tab panel-->
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                            Content
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                        <div role="tabpanel">
                                            <!-- Nav tabs -->
                                            <ul class="nav nav-tabs" role="tablist">
                                                @foreach($activeLanguages as $language)
                                                    <li role="presentation" class="{{$language->id == $defaultLanguage->id ? 'active':''}}"><a href="#content-{{$language->code}}" aria-controls="home" role="tab" data-toggle="tab">{{$language->display}}</a></li>
                                                @endforeach
                                            </ul>
                                            <div class="tab-content">
                                                @foreach($activeLanguages as $language)
                                                    @foreach($contents as $content)
                                                        @if($language->id == $content->lang_id)
                                                            <div role="tabpanel" class="tab-pane {{$language->id == $defaultLanguage->id ? 'active':''}}" id="content-{{$language->code}}">
                                                                <br />
                                                                @foreach($fields as $index => $field)
                                                                    {{--@if(!preg_match('/^meta_/i', $field))--}}
                                                                        @include("contents.formElements.{$field->type}")
                                                                    {{--@endif--}}
                                                                @endforeach
                                                                @include("contents.formElements.active")
                                                                {!! Form::text("content_id[]",$content->id,array("class"=>"hidden")) !!}
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            </div>
                                        </div>
                                        <!--End tab panel-->
                                    </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <input type="submit" class="btn btn-success btn-block" value="Update Content">
                        <a class="btn btn-info btn-block" href="/admin/pages">Back</a>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    @include("contents.partials.mediaLibaryModal")
@endsection