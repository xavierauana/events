
    {{-- Menu Group Name Form Input--}}
    <div class="form-group">
        {!!  Form::label("display","Menu Group Name:") !!}
        {!!  Form::text("display",null,array("class"=>"form-control")) !!}
        {{ $errors->first('display',"<span class='input-error'>:message</span>") }}
    </div>

    {{-- Menu Group Name Form Input--}}
    <div class="form-group">
        {!!  Form::label("active","Active:") !!}
        {!!  Form::select("active",["Not Active", "Active"], null,array("class"=>"form-control")) !!}
        {{ $errors->first('active',"<span class='input-error'>:message</span>") }}
    </div>
