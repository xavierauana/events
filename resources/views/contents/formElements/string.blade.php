<div class="form-group">
    {!! Form::label($field->code."[]","$field->display:") !!}

    <?php
        $constraints = [
            "class"=>"form-control",
            "placeholder"=>$field->placeholder?$field->placeholder:"",
        ];
        if($field->pattern){
            $constraints["pattern"] = $field->pattern;
        }
    ?>
    {!! Form::text($field->code."[]", isset($content)?$content->getFieldContent($field->code):'', $constraints) !!}

    {!! $errors->first($field->code."[]","<span class='input-error'>:message</span>") !!}
</div>