@extends('back.layouts.default')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('back.partials.message',array('messageType'=>'alert-danger'))
            <div class="col-md-10 col-md-offset-1">
                {{Form::open(array('route'=>array('admin.contents.store',$pageId,$layoutType), 'files'=>true))}}
                @include("contents.formElements.content_identifier")
                <div class="panel panel-default">
                    <div class="panel-heading"> Structural Contents </div>
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
                                                            <div role="tabpanel" class="tab-pane {{$language->id == $defaultLanguage->id ? 'active':''}}" id="{{$language->code}}">
                                                                <br />
                                                                @foreach($fields['layout-content'] as $index => $field)
                                                                    @if(preg_match('/^meta_/i', $field))
                                                                        @include("contents.formElements.{$fields['content-type'][$index]}",array(compact('language','field')))
                                                                    @endif
                                                                @endforeach
                                                            </div>
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
                                                            <div role="tabpanel" class="tab-pane {{$language->id == $defaultLanguage->id ? 'active':''}}" id="content-{{$language->code}}">
                                                                <br />
                                                                @foreach($fields['layout-content'] as $index => $field)
                                                                    @if(!preg_match('/^meta_/i', $field))
                                                                        @include("contents.formElements.{$fields['content-type'][$index]}")
                                                                    @endif
                                                                @endforeach
                                                                @include("contents.formElements.active")
                                                                @if(isset($content))
                                                                    {{ Form::text("content_id[]",$content->id,array("class"=>"hidden")) }}
                                                                @endif
                                                                {{ Form::text("lang_id[]",$language->id,array("class"=>"hidden")) }}
                                                            </div>
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
                        <a class="btn btn-info btn-block" href="{{route("admin.pages.content",array($pageId,$layoutType))}}">Back</a>
                    </div>
                </div>
                {{Form::close()}}
            </div>
        </div>
    </div>
@endsection
