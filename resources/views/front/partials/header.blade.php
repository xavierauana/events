<header>
    <div class="container upper hidden-sm hidden-xs" style="height:100px; margin-top:15px">
        <div class="logo-container"
             style="background-color: white; height:75px; display: inline-block; width:110px; margin-left:15px">
            <a href="{{route("home")}}">
                <img src="/front/imgs/logo.jpg" width="100%" alt="" />
            </a>
        </div>
        <ul class="list-inline pull-right" style="margin-right:15px ">
            @if(Auth::user())
                <li><a href="{{route("admin.profile")}}">{{Auth::user()->name}}</a></li>
            @else
                <li><a href="/auth/register">註冊</a></li>
                <li><a href="/auth/login">登錄</a></li>
            @endif
        </ul>
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
                    <li><a href="/about">關於我們</a></li>
                    <li><a href="/events">展覽</a></li>
                    <li><a href="/articles">專題報導</a></li>
                    <li><a href="/groups">個人或團體</a></li>
                    <li><a href="#">報料</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="padding:10px 15px">
                            <i class="fa fa-bars fa-2x"></i>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="/events?cat=dance">Dance</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>