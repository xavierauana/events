{{-- Display Name Form Input--}}
<div class="form-group">
    {{ Form::label("display","Display Name:") }}
    {{ Form::text("display",null,array("class"=>"form-control")) }}
    {{ $errors->first('display',"<span class='input-error'>:message</span>") }}
</div>

{{-- Permission Code Form Input--}}
<div class="form-group">
    {{ Form::label("code","Permission Code:") }}
    {{ Form::text("code",null,array("class"=>"form-control")) }}
    {{ $errors->first('code',"<span class='input-error'>:message</span>") }}
</div>

{{ Form::submit($submitButtonText, array('class'=>'btn btn-success')) }}
<a href="{{route('admin.authentication.permissions.index')}}" class="btn btn-info">back</a>