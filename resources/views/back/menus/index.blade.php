@extends('back.layouts.default')

@section('stylesheets')
    <style>

        ul.list-group ul.list-group{
            margin-top: 10px;
            margin-bottom: 0;
        }
        body.dragging, body.dragging * {
            cursor: move !important;
        }

        .dragged {
            position: absolute;
            opacity: 0.5;
            z-index: 2000;
        }

        ul.example li.placeholder {
            position: relative;
            /** More li styles **/
        }
        ul.example li.placeholder:before {
            position: absolute;
            /** Define arrowhead **/
        }

        .panel-default li  {
            padding: 5px;
            background: whitesmoke;
            margin-bottom:10px;
            border: 1px solid grey;
            border-radius: 0.5em;
        }
        .panel-default li:hover  {
           background-color: #d3d3d3;
        }
        .submenu{
            margin-left: 20px;
        }
        .panel-default li li{
            margin-top:10px;
            margin-bottom: 0;
        }

    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Menu @if(Auth::user()->hasRole(array('developer'))) <a class="btn btn-xs btn-success pull-right"  href="{{route('admin.menus.group.create')}}">Create New Menu Group</a>@endif</div>
                    <div class="panel-body">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            @foreach($menuGroups as $group)
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingOne">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#{{$group->id}}" aria-expanded="true" aria-controls="collapseOne">
                                                {{$group->display}}
                                            </a>
                                            <a class="btn btn-success btn-xs pull-right" href="{{route('admin.menus.item.create', $group->id)}}" style="color:white">Create Link Items</a>
                                        </h4>
                                    </div>
                                    <div id="{{$group->id}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                        <div class="panel-body" data-id="0">
                                            <ol class="list-unstyled sortableList" data-menuGroupId="{{$group->id}}"   data-parentId='0'>
                                                @foreach($group->items as $item)
                                                <li data-id="{{$item->id}}" data-name="{{$item->display}}" data-parentId="0" data-position="{{$item->order}}" class="">
                                                    <i class="fa fa-align-justify"></i>
                                                    {{$item->display}}
                                                    <div class="btn-group pull-right">
                                                        <a class="btn btn-xs btn-info" href="{{route('admin.menus.item.edit', $item->id)}}">edit</a>
                                                        <a class="btn btn-xs btn-danger" data-id="{{$item->id}}" href="#" onclick="deleteEntry(this)">delete</a>
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ol>
                                        </div>
                                        <div class="panel-footer">
                                            <button class="btn-success btn-block btn update-button" data-menu-group="menu1">Update Order</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function deleteEntry(target)
        {
            $(target).deleteItem({
                url:"/admin/menus/item",
                removableEl: 'li'
            })
        }
    </script>
@endsection