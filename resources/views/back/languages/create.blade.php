@extends('back.layouts.default')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form action="{{route('admin.languages.store')}}" role="form" method="POST">
                            {{csrf_field()}}
                            @include('back.languages.partials.form',array('submitButtonText'=>'Create'))
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection