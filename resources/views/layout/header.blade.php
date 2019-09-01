<header class="main-header">
    <nav class="navbar navbar-static-top" role="navigation">
        <a href="javascript:void(0)" >
            <span class="fa fa-bars"> </span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li><span class="hidden-xs">{{ Auth::user()->email }}</span></li>
                <li><a href="{{ route('logout') }}">Logout</a></li>
            </ul>
        </div>
    </nav>
    <hr>
</header>