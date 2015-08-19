<!doctype html>
<html lang="zh-HK">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta')
    <title>@yield('title','Testing')</title>
    <link href="/front/css/bootstrap.css" rel="stylesheet">
    <link href="{{elixir('front/css/app.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    @yield('stylesheets')
</head>
<body>
@include('front.partials.header')
@yield('content')
@include('front.partials.footer')


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="/front/js/front.js"></script>
<script src="/front/js/coffee.js"></script>

@yield('scripts')
</body>
</html>