<fieldset>
    <legend> Basic Info</legend>
    {{-- Display Name Form Input--}}
    <div class="form-group">
        {{ Form::label("display","Display Name:") }}
        {{ Form::text("display",null,array("class"=>"form-control")) }}
        {{ $errors->first('display',"<span class='input-error'>:message</span>") }}
    </div>

    {{-- Role Code Form Input--}}
    <div class="form-group">
        {{ Form::label("code","Role Code:") }}
        {{ Form::text("code",null,array("class"=>"form-control")) }}
        {{ $errors->first('code',"<span class='input-error'>:message</span>") }}
    </div>
</fieldset>

<fieldset>
    <legend>Select Permissions</legend>
    <table class="table">
        <thead>
        <th>Select</th>
        <th>Display Role</th>
        <th class="hidden-xs">code</th>
        </thead>
        <tbody>
        @foreach($permissions as $permission)
            <tr data-id="{{$permission->id}}">
                <td>
                    <input type="checkbox" name="permission[]" value="{{$permission->id}}" @if(isset($role)) {{$role->can($permission->code) ? 'checked':''}} @endif />
                </td>
                <td class="">{{$permission->display}}</td>
                <td class="hidden-xs">{{$permission->code}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</fieldset>

{{ Form::submit($submitButtonText, array('class'=>'btn btn-success')) }}
<a href="{{route('admin.authentication.roles.index')}}" class="btn btn-info">back</a>