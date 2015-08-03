@extends('back.layouts.default')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Languages
                        <a href="{{route('admin.languages.create')}}" class="btn btn-success btn-xs pull-right">Create New Language</a>
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                            <th class="text-center">languages</th>
                            <th class="hidden-xs text-center">code</th>
                            <th class="text-center">default</th>
                            <th class="hidden-xs text-center">active</th>
                            <th></th>
                            </thead>
                            <tbody>
                            @foreach($languages as $language)
                                <tr data-id="{{$language->id}}">
                                    <td class="text-center {{$language->active ? "text-primary":"text-danger"}}">{{$language->display}}</td>
                                    <td class="hidden-xs text-center {{$language->active ? "text-primary":"text-danger"}}">{{$language->code}}</td>
                                    <td class=" text-center {{$language->active ? "text-primary":"text-danger"}}">{{$language->default ? "default":" not "}}</td>
                                    <td class="hidden-xs text-center {{$language->active ? "text-primary":"text-danger"}}">@if($language->active)<i class="fa fa-check text-success"></i> @else <i class="fa fa-times text-danger"></i>@endif</td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a type="button" class="btn btn-info" href="{{route('admin.languages.edit', $language->id)}}">
                                                <i class="fa fa-pencil-square-o"></i> edit
                                            </a>
                                            <a type="button" class="btn btn-danger" data-id="{{$language->id}}" onclick="deleteEntry(this)">
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
    <script>
        function deleteEntry(target) {
            $(target).deleteItem({
                url: 'languages'
            });
        }
    </script>
@endsection