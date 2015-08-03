@extends('back.layouts.default')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                @include('back.partials.message')
                <div class="panel panel-default">
                    <div class="panel-heading">System Settings @if(Auth::user()->is(array('dev')))<a class="btn btn-xs btn-success pull-right"  href="{{route('admin.settings.create')}}">Create New Settings</a>@endif</div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                            <th>Setting</th>
                            <th>Value</th>
                            <th></th>
                            </thead>
                            <tbody>
                            @foreach($settings as $setting)
                                <tr data-id="{{$setting->id}}">
                                    <td class="">{{$setting->display}}</td>
                                    <span style="display: none">{{$setting->code}}</span>
                                    <td class="">{{$setting->value}}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a type="button" class="btn btn-info" href="{{route('admin.settings.edit', $setting->id)}}">
                                                <i class="fa fa-pencil-square-o"></i> edit
                                            </a>
                                            @if(Auth::user()->is(array('dev')))
                                                <a type="button" class="btn btn-danger delete-button" data-id="{{$setting->id}}" onclick="deleteEntry(this)">
                                                    <i class="fa fa-times-circle-o"></i> delete
                                                </a>
                                            @endif
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
                url:"{{route('admin.authentication.roles.index')}}"
            })
        }
    </script>
@endsection