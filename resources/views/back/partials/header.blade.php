<header>
    <div class="container upper hidden-sm hidden-xs" style="height:100px; margin-top:15px">
        <div class="logo-container"
             style="background-color: white; height:75px; display: inline-block; width:110px; margin-left:15px">
            <a href="{{route("home")}}">
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
                @if(Auth::user()->hasRole(["administrator","developer"]))
                    <ul class="nav navbar-nav navbar-right">
                    <li><a href="/dashboar">Dashboard</a></li>
                    <li><a href="{{route("admin.partials.index")}}">Common Information</a></li>
                    <li><a href="{{route("admin.pages.index")}}">Pages</a></li>
                    <li><a href="{{route("admin.menus.index")}}">Menus</a></li>
                    <li><a href="{{route("admin.settings.index")}}">Settings</a></li>
                    <li><a href="{{route("admin.languages.index")}}">Languages</a></li>
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
                    @if(Auth::user()->hasRole('developer'))
                        <li><a href="{{route("dev.index")}}">Layouts</a></li>
                    @endif
                </ul>
                @endif
            </div>
        </div>
    </nav>
</header>