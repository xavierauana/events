@extends('back.layouts.default')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                @if(count($errors)>0)
                    <ul class="list-unstyled">
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                @endif
                <div class="panel panel-default">
                    <div class="panel-heading">Create Content Fields for {{$template->display}} Template
                        <button class="btn btn-xs btn-primary pull-right" onclick="more();">more fields</button> </div>
                    <div class="panel-body">
                        {!!  Form::open(array("route"=>array('admin.contentfields.store', $template->id), "role"=>"form", "method"=>"POST")) !!}

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
    @include("back.contentfields.partials.createInputsTemplate")
@endsection

@section('scripts')
    <script>
        var template, tbody;
        template = document.querySelector("template");
        tbody = $("tbody");
        tbody.append(template.innerHTML);
        var more = function(){
            tbody.append(template.innerHTML);
        };
        var removeField = function(button){
            $removalPart = $(button).parents("tr");
            $removalPart.remove();
        }

    </script>
@endsection