{{-- URL Form Input--}}
<div class="form-group">
    {!! Form::label('display') !!}
    {!! Form::text('display', null, ["class"=>"form-control", "placeholder"=>"", "required"]) !!}
    {!! $errors->first('display',"<span class='input-error'>:message</span>") !!}
</div>

@if(!isset($language))
    @include('back.languages.partials.code_input')
@endif

{{--  Form Input--}}
<div class="form-group">
    {!! Form::label('active') !!}
    {!! Form::select('active', ["NOT Active", "Active"], null, ["class"=>"form-control"]) !!}
    {!! $errors->first('active',"<span class='input-error'>:message</span>") !!}
</div>

{{-- Default Form Input--}}
<div class="form-group">
    {!! Form::label('default') !!}
    {!! Form::select('default', ["NOT Default", "Default"], null, ["class"=>"form-control"]) !!}
    {!! $errors->first('default',"<span class='input-error'>:message</span>") !!}
</div>

<input type="submit" value="{{$submitButtonText}}" class="btn btn-success">

<a class="btn btn-info" href="{{route('admin.languages.index')}}" >Back</a>