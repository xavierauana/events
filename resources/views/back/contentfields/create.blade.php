<?php
$tables = DB::select('SHOW TABLES');

$layoutTableObjects = array_filter($tables, function($table){
    if(strpos($table->Tables_in_events, "_")){
        return str_split($table->Tables_in_events, strpos($table->Tables_in_events, "_"))[0] == 'layout'? true: false;
    }
});
$layoutTables = array_map(function($tableObject){
    return $tableObject->Tables_in_events;
}, $layoutTableObjects);

foreach($layoutTables as $layoutTable){
    $layoutTableField[$layoutTable] = $layoutTable;
}
?>
@extends('back.layouts.default')

@section('content')
    <div class="container-fluid" id="fields">
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
                            <th id="linkColumn" class="hidden">Table</th>
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
        };
        var thereIsLinkTableField = false;
        var checkIsThereAnyLink = function(){
            var temp = false;
            $.each($("select[name='type[]']"), function(index, select){
                if(select.value == 'link'){
                    temp = true;
                }
            });
            thereIsLinkTableField = temp;
            if(thereIsLinkTableField = false){
                $("#linkColumn").hidden();
            }
        }

        var showTableFields = function(el){
            $("#linkColumn").removeClass('hidden');
            $(el).parent("td").siblings("td.tableFields").removeC`lass("hidden");
        }

        var typeChange = function(el){
            if (el.value == 'link'){
                thereIsLinkTableField = true;
                showTableFields(el);
            }else{
                checkIsThereAnyLink();
            }
        }

    </script>
@endsection