<div class="form-group">
    {!! Form::label("active[]","Active:") !!}

    {!! Form::select("active[]",array(0=>'Not Active', 1=>'Active'),isset($content->active)?$content->active:0,array("class"=>"form-control")) !!}

    {!! $errors->first("active[]","<span class='input-error'>:message</span>") !!}
</div>