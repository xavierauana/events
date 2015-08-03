@extends('back.layouts.default')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Create New Permission</div>
                    <div class="panel-body">
                        {{ Form::open(array('route'=>array('admin.authentication.permissions.store'), "role"=>"form")) }}
                            @include('back.permissions.partials.form',array('submitButtonText'=>'Create New Permission'))
                            

                        {{ Form::close() }}


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
        }
    </script>
@endsection