<div class="form-group">
    {!! Form::label($field->code.'[]',"$field->display:") !!}
    <div class='input-group date datetimepicker' data-format="{{cache("dateTimeFormat")}}" id=''>
        {!! Form::text($field->code.'[]', (isset($content)) ? convertDateTimeForBackEnd($content->getFieldContent($field->code)):'',array("class"=>"form-control")) !!}
        <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
    </div>
</div>