        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="{{ url('forum') }}">Forum</a></li>

                        <form action="/search" method="GET" class="navbar-form navbar-right">
                            <div class="form-group">
                                <input type="search" name="q" id="q" class="form-control" placeholder="Find Users...">
                                <button class="btn btn-primary">Search</button>
                            </div>
                        </form>
                    </ul>                    
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expended="false">
                                    <i class="fa fa-2x fa-envelope-o"></i>
                                </a> 

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        messages
                                    </li>
                                </ul>                               
                            </li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expended="false">
                                    <i class="fa fa-2x fa-bell-o"></i>
                                </a> 

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        notifications
                                    </li>
                                </ul>                               
                            </li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {!! Auth::user()->getAvatar('profile-cir') !!}
                                    <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('user/'.Auth::id().'/'.Auth::user()->username) }}"><i class="fa fa-user"></i> Profile</a>
                                        <a href="{{ url('user/settings') }}"><i class="fa fa-cog"></i> Settings</a>
                                        @if (auth()->user()->isAdmin())
                                        <a href="{{ url('admin') }}" target="_blank"><i class="fa fa-lock"></i> Admin Panel</a>
                                        @endif
                                        <a href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i> Logout</a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>

                        @endif
                    </ul>
                </div>
            </div>
        </nav>