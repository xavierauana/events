<header>
    <div class="container upper hidden-sm hidden-xs" style="height:100px; margin-top:15px">
        <div class="logo-container"
             style="background-color: white; height:75px; display: inline-block; width:110px; margin-left:15px">
            <a href="/">
                <img src="/front/imgs/logo.jpg" width="100%" alt="" />
            </a>
        </div>
    </div>
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse-nav">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="collapse-nav">
                <ul class="nav navbar-nav navbar-right">
                    @if(Auth::user()->hasRole(["administrator","developer"]))
                        <li><a href="/dashboar">Dashboard</a></li>
                        <li><a href="{{route("admin.partials.index")}}">Common Information</a></li>
                        @if(Auth::user()->canDo("page","show"))
                            <li><a href="{{route("admin.pages.index")}}">Pages</a></li>
                        @endif
                        @if(Auth::user()->canDo("menu", "show"))
                            <li><a href="{{route("admin.menus.index")}}">Menus</a></li>
                        @endif
                        @if(Auth::user()->canDo("setting", "show"))
                            <li><a href="{{route("admin.settings.index")}}">Settings</a></li>
                        @endif
                        @if(Auth::user()->canDo("language", "show"))
                            <li><a href="{{route("admin.languages.index")}}">Languages</a></li>
                        @endif
                        @if(Auth::user()->canDo("template","show"))
                            <li><a href="{{route("admin.templates.index")}}">Templates</a></li>
                        @endif
                        @if(Auth::user()->canDo("user", "show"))
                        <li class="dropdown">
                            <a aria-expanded="false" role="button" aria-haspopup="true" data-toggle="dropdown" class="dropdown-toggle" href="#" id="drop2">
                                Authentication
                                <span class="caret"></span>
                            </a>
                            <ul aria-labelledby="drop2" role="menu" class="dropdown-menu">
                                <li role="presentation"><a href="{{route('admin.users.index')}}" tabindex="-1" role="menuitem">User</a></li>
                                @if(Auth::user()->canDo("role","show"))
                                    <li role="presentation"><a href="{{route('admin.authentication.roles.index')}}" tabindex="-1" role="menuitem">Role</a></li>
                                @endif
                                @if(Auth::user()->canDo("permission","show"))
                                    <li role="presentation"><a href="{{route('admin.authentication.permissions.index')}}" tabindex="-1" role="menuitem">Permission</a></li>
                                @endif
                            </ul>
                        </li>
                        @endif
                    @endif
                    <li class="dropdown">
                        <a aria-expanded="false" role="button" aria-haspopup="true" data-toggle="dropdown" class="dropdown-toggle" href="#" id="drop2">
                            {{Auth::user()->name}}
                            <span class="caret"></span>
                        </a>
                        <ul aria-labelledby="drop2" role="menu" class="dropdown-menu">
                            <li role="presentation"><a href="{{route('admin.user.profile')}}" tabindex="-1" role="menuitem">My Profile</a></li>
                            <li role="separator" class="divider"></li>
                            <li role="presentation"><a href="{{url('/auth/logout')}}" tabindex="-1" role="menuitem">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>