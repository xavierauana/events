<!doctype html>
<html lang="zh-HK">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta')
    <title>@yield('title','Testing')</title>
    <link href="/front/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{elixir("back/css/back.css")}}">
    <link rel="stylesheet" href="{{elixir("back/css/app.css")}}">
    @yield('stylesheets')
    <style>
        .navbar-default {
            border: 0;
            background-color: #fdd204;
            border-radius: 0;
        }
        .navbar-default li a {
            color: #777777;
        }
        .navbar-default li:hover {
            color: #777777;
        }
        .navbar-default .navbar-toggle {
            border:0;
        }
        header ul a, footer ul a  {
            color: #777777;
        }
        #footer-social-links a{
            color: #fdd204;
        }
        #footer-social-links a:hover{
            color: yellow;
        }
        footer>.row div.col-xs-12:last-child{
            border-right: solid black 2px;
        }
    </style>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
@include('back.partials.header')
@yield('content')


        <!-- Scripts -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="/components/jquery/dist/jquery.min.js"><\/script>')</script>
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>


{{--<script src="//cdn.ckeditor.com/4.5.3/full-all/ckeditor.js"></script>--}}
{{--<script src="//cdn.ckeditor.com/4.5.3/full-all/adapters/jquery.js"></script>--}}
<script src="/js/ckeditor/ckeditor.js"></script>
<script src="{{elixir("back/js/back.js")}}"></script>
@yield('scripts')
</body>
</html>