<!DOCTYPE html>
<html>
<head>
	<title>{{ config('app.name') }} Admin Panel</title>
	<link rel="stylesheet" type="text/css" href="/css/app.css">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{{ url('admin') }}">{{ config('app.name')}}</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    {!! Auth::user()->getAvatar('profile-cir') !!}
                    <span class="caret"></span>
                </a>

                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="{{ url('user/'.Auth::id().'/'.Auth::user()->username) }}"><i class="fa fa-user"></i> Profile</a>
                        <a href="{{ url('user/settings') }}"><i class="fa fa-cog"></i> Settings</a>
                        <a href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i> Logout</a>

                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </li>          
            <li><a href="#" target="_blank" style="margin-top:5px">Back to site</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li><a href="{{ route('group.index') }}"><i class="fa fa-users"></i> <strong>Groups</strong></a></li>
            <li><a href="{{ route('user.index') }}"><i class="fa fa-user"></i> <strong>Users</strong></a></li>
            <li><a href="{{ route('category.index') }}"><i class="fa fa-clone"></i> <strong>categories</strong></a></li>
            <li><a href="{{ route('article.index') }}"><i class="fa fa-file-text"></i> <strong>articles</strong></a></li>
            <li><a href="{{ route('forumcat.index') }}"><i class="fa fa-commenting-o"></i> <strong>Forum categories</strong></a></li>
            <li><a href="{{ route('forum.index') }}"><i class="fa fa-comments-o"></i> <strong>Forums</strong></a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">{{ Session::has('header') ? Session::get('header') : 'Dashboard' }}</h1>

			@yield('content')

        </div>
      </div>
    </div>
    <!-- Scripts -->
    <script src="/js/app.js"></script>
</body>
</html>