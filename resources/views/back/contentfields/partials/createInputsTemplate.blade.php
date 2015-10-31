<template type="template" name="fieldInputs">
    <tr>
        <td>
            {!! Form::text("display[]",null, ["class"=>"form-control", "required"]) !!}
        </td>
        <td>
            {!! Form::text("code[]",null, ["class"=>"form-control", "required"]) !!}
        </td>
        <td>
            {!! Form::select("type[]", getContentFieldTypes(), null, ["class"=>"form-control", "required", "onchange"=>"typeChange(this);"]) !!}
        </td>
        <td>
            {!! Form::select("required[]", [
                "Not Required",
                "Required"
            ],null, ["class"=>"form-control", "required"]) !!}
        </td>
        <td>
            {!! Form::text("placeholder[]",null, ["class"=>"form-control"]) !!}
        </td>
        <td>
            {!! Form::text("pattern[]",null, ["class"=>"form-control"]) !!}
        </td>
        <td>
            <button class="btn btn-danger btn-sm" onclick="removeField(this); return false">remove</button>
        </td>
    </tr>
</template>