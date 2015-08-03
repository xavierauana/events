<div class="checkbox">
    <label>
            @if(isset($content) && $content->$field != 0)
                {!! Form::checkbox($field, '1', array('checked')) !!} {{$field}}
            @else
                {!! Form::checkbox($field, '1', array()) !!} {{$field}}
            @endif
    </label>
    {!! $errors->first($field,"<span class='input-error'>:message</span>") !!}
</div>


