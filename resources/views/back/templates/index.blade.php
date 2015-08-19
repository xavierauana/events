@extends('back.layouts.default')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                @include('back.partials.message')
                <div class="panel panel-default">
                    <div class="panel-heading">Templates
                        <form action="{{route("admin.templates.createAll")}}" method="POST">
                            {{csrf_field()}}
                            <input type="submit" value="Fetch files and create tempaltes" class="btn btn-primary btn-xs pull-right" style="margin-top:-20px">
                        </form>
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <th>Display</th>
                                <th>file</th>
                                <th>type</th>
                                <th></th>
                            </thead>
                            <tbody>
                            @foreach($templates as $template)
                                <tr data-id="{{$template->id}}">
                                    <td>
                                        {{$template->display}}
                                    </td>
                                    <td>
                                        {{$template->file}}
                                    </td>
                                    <td>
                                        {{$template->type}}
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a type="button" class="btn btn-primary" href="{{route('admin.contentfields.check',[$template->id])}}">
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