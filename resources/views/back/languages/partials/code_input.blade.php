{{-- Code Form Input--}}
<div class="form-group">
    <label for="code">Code</label>
    <input type="text" name="code" class="form-control" placeholder="" required>
    {!! $errors->first('code',"<span class='input-error'>:message</span>") !!}
</div>