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
                            @foreach($layouts as $layout)
                                <tr data-id="{{$layout->id}}">
                                    <td class="{{$layout->active ? "text-primary":"text-danger"}}">{{$layout->url}}</td>
                                    <td class="hidden-xs {{$layout->active ? "text-primary":"text-danger"}}">{{$layout->active ? 'Active' : 'Not Active'}}</td>
                                    <td>{{$layout->layout->displayName}}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a type="button" class="btn btn-primary" href="{{url('admin/contents',array($layout->id,$layout->layout->type))}}">
                                                <i class="fa fa-file-text-o"></i> content fields
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
        $('.table').DataTable();
    </script>
@endsection