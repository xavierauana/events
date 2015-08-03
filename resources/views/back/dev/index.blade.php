@extends('back.layouts.default')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Layout Actions</div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                            <th>Action</th>
                            <th></th>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Refresh All Content Tables</td>
                                <td>
                                    <a class="btn btn-danger" href="{{route('refreshAllLayoutsAndContents')}}">Go!</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Refresh All Cache</td>
                                <td>
                                    <a class="btn btn-danger" href="{{route('refreshAllLayoutsAndContents')}}">Go!</a>
                                </td>
                            </tr>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection