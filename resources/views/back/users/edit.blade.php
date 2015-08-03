@extends('back.layouts.default')

@section('stylesheets')
    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit - {{$user->name}}</div>
                    <div class="panel-body">
                        @include('back.users.partials.error')

                        {{ Form::model($user, array('route'=>array('admin.users.update', $user->id), "role"=>"form", 'method'=>'PATCH', 'class'=>'form-horizontal')) }}
                            @include('back.users.partials.form',array('submitButtonText'=>'Update User'))
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
    <script type="text/javascript">
        $('select').select2();
    </script>
@endsection
