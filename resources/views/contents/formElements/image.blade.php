<div class="well well-sm">
    <div class="row">
        <div class="col-md-4">
            Current {{$field}}:
            <div class="image-file-container">
                @if(isset($content) and $content->$field)
                    <img data-field="{{$field}}" data-lang_id="{{$language->id}}" class="thumbnail item" width="100%" src="{{$content->$field}}" alt=""/>
                @endif
            </div>
        </div>
        <div class="col-md-8">
            <br />
            <button class=" btn btn-primary btn-lg image-file-upload-button" data-lang_id="{{$language->id}}" data-field="{{$field}}" >Upload File</button>
            <button class=" btn btn-danger btn-lg image-file-remove-button" data-lang_id="{{$language->id}}" data-field="{{$field}}" >Remove File</button>
            {!! Form::file($field."[]",array("class"=>"hidden", "data-lang_id"=>$language->id, "data-field"=>$field, 'data-type'=>'image', 'accept'=>'image/*')) !!}
            {!! Form::select($field."_remove[]",array(0=>0, 1=>1),0,array("class"=>"hidden")) !!}
            {!! $errors->first($field."[]","<span class='input-error'>:message</span>") !!}
        </div>
    </div>
</div>