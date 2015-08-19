<div class="well well-sm">
    <div class="row">
        <div class="col-md-4">
            {{$field->display}}:
            <?php
                $uuid = uniqid();
            ?>
            <div class="image-file-container preview"  data-uuid="{{$uuid}}">
                @if(isset($content) and $content->getFieldContent($field->code))
                    <img data-field="{{$field->code}}" data-lang_id="{{$language->id}}" class="thumbnail item" width="100%" src="{{$content->getFieldContent($field->code)}}" alt=""/>
                @endif
            </div>
        </div>
        <div class="col-md-8">
            <br />
            <button class=" btn btn-primary btn-lg image-file-upload-button" data-lang_id="{{$language->id}}" data-field="{{$field->code}}" onclick="return false;" data-toggle="modal" data-target="#mediaLibrary" data-uuid="{{$uuid}}" >Choose Image</button>
            <button class=" btn btn-danger btn-lg image-file-remove-button" data-lang_id="{{$language->id}}" data-field="{{$field->code}}" onclick="resetInput(event)" data-uuid="{{$uuid}}" >Remove Image</button>
            {!! Form::text($field->code."[]", isset($content)? $content->getFieldContent($field->code):"", array("class"=>"hidden", "data-lang_id"=>$language->id, "data-field"=>$field->code, "data-uuid"=>$uuid, 'data-type'=>'image', 'accept'=>'image/*')) !!}
            {!! $errors->first($field->code."[]","<span class='input-error'>:message</span>") !!}
        </div>
    </div>
</div>