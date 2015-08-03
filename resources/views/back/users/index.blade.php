@extends('back.layouts.default')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                @include('back.partials.message')
                <div class="panel panel-default">
                    <div class="panel-heading">Users <a class="btn btn-xs btn-success pull-right"  href="{{route('admin.users.create')}}">Create New User</a><a href="/admin/users/csv" class="btn btn-xs btn-primary pull-right" style="margin-right:15px" >Import CSV</a></div>
                    <div class="panel-body">
                        <table class="table" id="myTable">
                            <thead>
                                <th>name</th>
                                <th class="hidden-xs">email</th>
                                <th>role</th>
                                <th class="hidden-xs">status</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr data-id="{{$user->id}}">
                                        <td class="
                                        <?php
                                        switch($user->status){
                                            case('active'): echo 'text-success'; break;
                                            case('pending'): echo 'text-warning'; break;
                                            default: echo 'text-danger'; break;
                                         }
                                        ?>
                                        ">{{$user->name}}</td>
                                        <td class="hidden-xs">{{$user->email}}</td>
                                        <td>
                                            @foreach($user->roles as $role)
                                                {{$role->display}}
                                            @endforeach
                                        </td>
                                        <td class="hidden-xs">
                                            @if($user->status == 'active')
                                                <span class="label label-success">{{$user->status}}</span>
                                            @elseif($user->status == 'pending')
                                                <span class="label label-warning">{{$user->status}}</span>
                                            @else
                                                <span class="label label-danger">{{$user->status}}</span>
                                            @endif

                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a type="button" class="btn btn-info" href="{{route('admin.users.edit', $user->id)}}">
                                                    <i class="fa fa-pencil-square-o"></i> edit
                                                </a>
                                                <a type="button" class="btn btn-danger delete-button" data-id="{{$user->id}}" onclick="deleteEntry(this)">
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
                url:"{{route('admin.authentication.users.index')}}"
            })
        };

        $('#myTable').DataTable();
    </script>
@endsection