<div class="form-group">
    {!! Form::label("meta_title[]","Meta Title:") !!}

    {!! Form::text("meta_title[]", isset($content)?$content->meta_title:'',array("class"=>"form-control")) !!}

    {!! $errors->first("meta_title[]","<span class='input-error'>:message</span>") !!}
</div>


<div class="form-group">
    {!! Form::label("meta_description[]","Meta Description:") !!}

    {!! Form::textarea("meta_description[]", isset($content)?$content->meta_description:'',array(
        "class"=>"form-control",
        "rows"=>"5",
        ) ) !!}

    {!! $errors->first("meta_description[]","<span class='input-error'>:message</span>") !!}
</div>