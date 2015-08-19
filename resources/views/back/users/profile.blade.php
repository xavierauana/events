@extends("back.layouts.default")

@section("content")
    <main class="container">
        <h2>{{Auth::user()->name}}</h2>
        {!! Form::model(Auth::user(), ["route"=>["updateProfile"], 'method'=>"patch"]) !!}
            {{csrf_field()}}
            @include("back.users.partials.form",["profile"=>true, "submitButtonText"=>"Update", "user"=>Auth::user()])
        {!! Form::close() !!}
    </main>
@endsection