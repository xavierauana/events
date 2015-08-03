<!DOCTYPE html>
<html lang="@yield('lang','en')">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>A & A Creation</title>

    <link href="/back/css/app.css" rel="stylesheet">
    <link href="/back/css/anaback.css" rel="stylesheet">

    <!-- Fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    @yield('stylesheet')


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
        .input-error{
            color:red;
            font-style: italic;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ Auth::guest() ? "#" : route('dashboard')}}">CMS</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            @if(Auth::check())
                <ul class="nav navbar-nav">
                    <li><a href="{{route('dashboard')}}">Home</a></li>
                    <li><a href="{{route('admin.pages.index')}}">Pages</a></li>
                    <li><a href="{{route('admin.partials.index')}}">Common Information</a></li>
                    <li><a href="{{route('admin.menus.index')}}">Menus </a></li>
                    <li><a href="{{route('admin.languages.index')}}">Languages</a></li>
                    <li class="dropdown">
                        <a aria-expanded="false" role="button" aria-haspopup="true" data-toggle="dropdown" class="dropdown-toggle" href="#" id="drop2">
                            Authentication
                            <span class="caret"></span>
                        </a>
                        <ul aria-labelledby="drop2" role="menu" class="dropdown-menu">
                            <li role="presentation"><a href="{{route('admin.authentication.users.index')}}" tabindex="-1" role="menuitem">User</a></li>
                            <li role="presentation"><a href="{{route('admin.authentication.roles.index')}}" tabindex="-1" role="menuitem">Role</a></li>
                            <li role="presentation"><a href="{{route('admin.authentication.permissions.index')}}" tabindex="-1" role="menuitem">Permission</a></li>
                        </ul>
                    </li>
                    @if(Auth::user()->is(array('dev')))
                        <li><a href="{{route('layouts.index')}}">Layouts</a></li>
                    @endif


                </ul>
            @endif

            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li><a href="login">Login</a></li>
                    <li><a href="register">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{route('logout')}}">Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

@yield('content')

<!-- Scripts -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="/components/jquery/dist/jquery.min.js"><\/script>')</script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
<script>if(typeof($.fn.modal) === 'undefined'){document.write('<script src="/components/bootstrap/dist/js/bootstrap.min.js"><\/script>')}</script>

<script src="/components/ckeditor/ckeditor.js"></script>
<script src="/components/ckeditor/adapters/jquery.js"></script>
<script src="/back/js/testing.js"></script>
@yield('scripts')
</body>
</html>
