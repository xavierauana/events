@extends('back.layouts.default')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                @include('back.partials.message')
                <div class="panel panel-default">
                    <div class="panel-heading">Permission <a class="btn btn-xs btn-success pull-right"  href="{{route('admin.authentication.permissions.create')}}">Create New Permission</a></div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <th>Display Permission</th>
                                <th>Permission Code</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach($permissions as $permission)
                                    <tr>
                                        <td>{{$permission->display}}</td>
                                        <td>{{$permission->code}}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a type="button" class="btn btn-info" href="{{route('admin.authentication.permissions.edit', $permission->id)}}">
                                                    <i class="fa fa-pencil-square-o"></i> edit
                                                </a>
                                                <a type="button" class="btn btn-danger delete-button" data-id="{{$permission->id}}" onclick="deleteEntry(this)">
                                                    <i class="fa fa-times-circle-o"></i> delete
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/back/js/deleteItem.js"></script>
    <script>
        var deleteEntry = function(target){
            $(target).deleteItem({
                url:"{{route('admin.authentication.permissions.index')}}"
            })
        }
    </script>
@endsection