@extends('back.layouts.default')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                @include('back.partials.message')
                <div class="panel panel-default">
                    <div class="panel-heading">Pages <a class="btn btn-xs btn-success pull-right"  href="{{route('admin.pages.create')}}">Create New Page</a></div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <th>url</th>
                                <th class="hidden-xs">status</th>
                                <th>layout</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach($pages as $page)
                                    <tr data-id="{{$page->id}}">
                                        <td class="{{$page->active ? "text-primary":"text-danger"}}">{{$page->url}}</td>
                                        <td class="hidden-xs {{$page->active ? "text-primary":"text-danger"}}">{{$page->active ? 'Active' : 'Not Active'}}</td>
                                        <td>{{$page->layout->displayName}}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a type="button" class="btn btn-primary" href="{{url('admin/contents',array($page->id,$page->layout->type))}}">
                                                    <i class="fa fa-file-text-o"></i> content
                                                </a>
                                                <a type="button" class="btn btn-info" href="{{route('admin.pages.edit', $page->id)}}">
                                                    <i class="fa fa-pencil-square-o"></i> edit
                                                </a>
                                                <a type="button" class="btn btn-danger" data-id="{{$page->id}}" onclick="deleteEntry(this)">
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
                url: 'pages'
            });
        }
        $('.table').DataTable();
    </script>
@endsection