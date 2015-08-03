<div class="well well-sm">
    <div class="row">
        <div class="col-md-6">
            Current {{$field}} file:
            <div class="file-container">
                @if(isset($content) and $content->$field)
                    <p><strong>{{$content->$field}}</strong></p>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <br />
            <button class=" btn btn-primary btn-lg file-upload-button" data-lang_id="{{$language->id}}" data-field="{{$field}}" >Upload File</button>
            <button class=" btn btn-danger btn-lg file-remove-button" data-lang_id="{{$language->id}}" data-field="{{$field}}" >Remove File</button>
            {!! Form::file($field."[]",array("class"=>"hidden", "data-lang_id"=>$language->id, "data-field"=>$field, "data-type"=>"file", 'accept'=>"*")) !!}
            {!! Form::select($field."_remove[]",array(0=>0, 1=>1),0,array("class"=>"hidden")) !!}
            {!! $errors->first($field."[]","<span class='input-error'>:message</span>") !!}
        </div>
    </div>
</div>