@extends('back.layouts.default')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Common Entries </div>
                    <div class="panel-body">
                        @foreach($contents as $partial => $DBContents)
                        {{Form::open(array('route'=>array('admin.partials.update',$partial), 'files'=>true, 'method'=>'PATCH'))}}
                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$partial}}" aria-expanded="true" aria-controls="collapseOne">
                                            {{$partial}}
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse{{$partial}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                    <div class="panel-body">
                                        <div role="tabpanel">
                                            <!-- Nav tabs -->
                                            <ul class="nav nav-tabs" role="tablist">
                                                @foreach($activeLanguages as $language)
                                                    <li role="presentation" class="{{$language->id == $defaultLanguage->id ? 'active':''}}"><a href="#{{$partial.'_'.$language->code}}" aria-controls="home" role="tab" data-toggle="tab">{{$language->display}}</a></li>
                                                @endforeach
                                            </ul>
                                            <div class="tab-content">
                                                @foreach($activeLanguages as $language)
                                                    @foreach($DBContents as $content)
                                                        @if($language->id == $content->lang_id)
                                                            <div role="tabpanel" class="tab-pane {{$language->id == $defaultLanguage->id ? 'active':''}}" id="{{$partial.'_'.$language->code}}">
                                                                <br />
                                                                @foreach($fields[$partial]['layout-content'] as $index => $field)
                                                                    @if(!preg_match('/^meta_/i', $field))
                                                                         @include("contents.formElements.{$fields[$partial]['content-type'][$index]}")
                                                                    @endif
                                                                @endforeach
                                                                @include("contents.formElements.active")
                                                                {{Form::hidden('content_id[]',$content->id)}}
                                                                {{Form::hidden('lang_id[]',$language->id)}}
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            </div>
                                        </div>
                                        <!--End tab panel-->
                                    </div>
                                    <div class="panel-footer">
                                        {{Form::submit('Update',array('class'=>'btn btn-block btn-success'))}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{Form::close()}}
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
