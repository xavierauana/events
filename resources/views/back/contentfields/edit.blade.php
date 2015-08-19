@extends('back.layouts.default')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Template
                        <button class="btn btn-xs btn-primary pull-right" onclick="more();">more fields</button> </div>
                    <div class="panel-body">
                        {!!  Form::open(array("route"=>array('admin.contentfields.update', $template->id), "role"=>"form", "method"=>"PATCH")) !!}
                        <table class="table">
                            <thead>
                            <th>Display Field</th>
                            <th>Field Code</th>
                            <th>Content Type</th>
                            <th>Required?</th>
                            <th>Placeholder</th>
                            <th>Content Pattern</th>
                            <th></th>
                            </thead>
                            <tbody>
                            @foreach($template->contentfields as $field)
                            <tr>
                                <td>
                                    {!! Form::text("display[]",$field->display, ["class"=>"form-control", "required"]) !!}
                                </td>
                                <td>
                                    {!! Form::text("code[]",$field->code, ["class"=>"form-control", "required"]) !!}
                                </td>
                                <td>
                                    {!! Form::select("type[]", getContentFieldTypes(), $field->type, ["class"=>"form-control", "required"]) !!}
                                </td>
                                <td>
                                    {!! Form::select("required[]", [
                                        "Not Required",
                                        "Required"
                                    ],$field->required, ["class"=>"form-control", "required"]) !!}
                                </td>
                                <td>
                                    {!! Form::text("placeholder[]",$field->placeholder, ["class"=>"form-control"]) !!}
                                </td>
                                <td>
                                    {!! Form::text("pattern[]",$field->pattern, ["class"=>"form-control"]) !!}
                                </td>
                                    <input type="hidden" name="contentFieldId[]" value="{{$field->id}}">
                                <td>
                                    <button class="btn btn-danger btn-sm" onclick="removeField(this); return false">remove</button>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="7">
                                    <input type="submit" value="Create" class="btn btn-success btn-block">
                                    <a href="{{route("admin.templates.index")}}" class="btn btn-info btn-block">back</a>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                        {!!  Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('back.contentfields.partials.editInputsTemplate')
@endsection

@section('scripts')
    <script>
        var template, tbody;
        template = document.querySelector("template");
        tbody = $("tbody");
        var more = function(){
            tbody.append(template.innerHTML);
        };
        var removeField = function(button){
            $removalPart = $(button).parents("tr");
            $removalPart.remove();
        }
    </script>
@endsection