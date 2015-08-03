<div class="form-group">
    {!! Form::label($field."[]","$field:") !!}

    {!! Form::text($field."[]",isset($content)?$content->$field:'',array("class"=>"form-control datepicker")) !!}

    {!! $errors->first($field."[]","<span class='input-error'>:message</span>") !!}
</div>