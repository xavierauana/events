<div class="form-group">
    {!! Form::label($field->code.'[]',"$field->display:") !!}

    {!! Form::textarea($field->code.'[]', isset($content)?$content->getFieldContent($field->code):'',array(
        "class"=>"form-control editor",
        "required"=>$field->required?true:false,
        "placeholder"=>$field->placeholder?$field->placeholder:false,
        )) !!}

    {!! $errors->first($field->code.'[]',"<span class='input-error'>:message</span>") !!}
</div>