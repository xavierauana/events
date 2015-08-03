<div class="form-group">
    {!! Form::label('content_identifier',"content identifier:") !!}

    {!! Form::text('content_identifier', isset($contents)?$contents->first()->content_identifier:'',array("class"=>"form-control",'required','pattern'=>'[a-zA-Z0-9\_]+')) !!}
    <p class="help-block hidden-xs">Only allow Alpha Numeric with Underscore as input. Example: sample_1</p>

    {!! $errors->first('content_identifier',"<span class='input-error'>:message</span>") !!}
</div>