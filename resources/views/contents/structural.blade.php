@extends('back.layouts.default')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Pages <a class="btn btn-xs btn-success pull-right"  href="{{route('admin.contents.create',array($pageId,$layoutType))}}">Create New Content</a></div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                            <th>content id</th>
                            <th></th>
                            </thead>
                            <tbody>
                            @foreach($structural as $content)
                                <tr>
                                    <td>{{$content}}</td>
                                    {{--The following is the action apply to the record--}}
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a type="button" class="btn btn-info" href="{{route('admin.contents.edit', array($pageId, $layoutType, $content))}}">
                                                <i class="fa fa-pencil-square-o"></i> edit
                                            </a>
                                            <a type="button" class="btn btn-danger" page-id="{{$content}}" onclick="deleteEntry(this)">
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
        function deleteEntry(target)
        {
            var pageId = "{{$pageId}}";
            var layoutType = "{{$layoutType}}";
            console.log(pageId);
            $(target).deleteItem({
                pageId: pageId,
                layoutType: layoutType
            })
        }
    </script>
@endsection