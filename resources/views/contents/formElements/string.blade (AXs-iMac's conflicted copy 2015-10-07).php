<div class="form-group">
    {!! Form::label($field->code."[]","$field->display:") !!}

    {!! Form::text($field->code."[]", isset($content)?$content->getFieldContent($field->code):'',array(
        "class"=>"form-control",
        "placeholder"=>$field->placeholder?$field->placeholder:"",
        "pattern"=>$field->pattern?$field->pattern:false
        )) !!}

    {!! $errors->first($field->code."[]","<span class='input-error'>:message</span>") !!}
</div>