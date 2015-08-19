<div class="form-group">
    {!! Form::label($field->code.'[]',"$field->display:") !!}

    {!! Form::textarea($field->code.'[]', isset($content)?$content->getFieldContent($field->code):'',array(
        "class"=>"form-control",
        "rows"=>"5",
        "placeholder"=>$field->placeholder,
        "required"=>$field->required?true:false,
        "pattern"=>$field->pattern?$field->pattern:false,
        ) ) !!}

    {!! $errors->first($field->code.'[]',"<span class='input-error'>:message</span>") !!}
</div>