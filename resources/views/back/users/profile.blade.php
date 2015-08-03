@extends("back.layouts.default")

@section("content")
    <main class="container">
        <h2>{{Auth::user()->name}}</h2>
    </main>
@endsection