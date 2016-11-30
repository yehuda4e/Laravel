@extends('layouts.app')

@section('style')
    <style type="text/css">
    @import url(https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,400,700);

   
#header{
	border:1px solid #ddd;
	margin-bottom:20px;
}
		
.navbar-profile {
	border-radius:0;
	margin-bottom:0;
	border:none;
    font-family: 'Open Sans Condensed', sans-serif, sans-serif;
}
    
.navbar-brand-profile {
	width:160px;
	height:160px;
	float:left;
	padding:0;
	margin-top:-130px;
	overflow:hidden;
	border:3px solid #eee;
	margin-left:15px;
	background:#333;
	text-align:center;
	line-height:160px;
	color:#fff !important;
	font-size:2em;
    -webkit-transition:  all 0.3s ease-in-out;
  	-moz-transition: all 0.3s ease-in-out;
  	-o-transition:  all 0.3s ease-in-out;
  	transition: all 0.3s ease-in-out ;
}
	
	
.site-name{
	color: #fff;
	font-size: 2.4em;
	float: left;
	margin-top: -65px !important;
	margin-left: 15px;
    font-family: 'Open Sans Condensed', sans-serif, sans-serif;
}	

.site-description{
	color:#fff;
	font-size:1.3em;
	float:left;
	margin-top:-30px !important;
	margin-left:15px;
}
	
.main-menu{
	position:absolute;
	left:190px;
}
	
.slider{
	max-height:360px;
	overflow:hidden;
}
	
.cover {
	background-size: cover;
	background-position: top center;
	min-height: 320px;
}


@media (max-width: 768px) {
	.navbar-brand-profile{
	    max-width: 100px;
		max-height:100px;
		float:left;
		margin-top:-65px;
		margin-left:15px;
		-webkit-transition:  all 0.3s ease-in-out;
	  	-moz-transition: all 0.3s ease-in-out;
	  	-o-transition:  all 0.3s ease-in-out;
	  	transition: all 0.3s ease-in-out ;
	}
	  
	.navbar{
		border-radius:0;
		margin-bottom:0;
		border:none;
	}
		
	.main-menu{
		left:0;
		position:relative;
	}


}

@media (max-width: 490px) {
	.site-name{
		color:#fff;
		font-size:1.5em;
		float:left;
		line-height:20px;
		margin-top:-100px !important;
		margin-left:125px;
	}	
	.site-description{
		color:#fff;
		font-size:1.3em;
		float:left;
		margin-top:-80px !important;
		margin-left:125px;
	}
}

.btn-nav-pro {
	margin-left: -10px;
	margin-top: -5px;
	padding: 5px;
}

.navbar-nav-pro > li > a {
	line-height: 30px;
}

    </style>

@stop

@section('content')
   	<div class="row">
        <div class="col-md-12">
            <header id="header">
				<div class="slider">
				  	<div id="carousel-example-generic">
				  		<!-- Wrapper for slides -->
				  		<div class="cover" style="background: url({{ $user->cover }});background-repeat: no-repeat;background-size:cover"></div>
					</div>
				</div><!--slider-->
                <nav class="navbar navbar-profile navbar-default">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mainNav">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                          </button>
                          <a class="navbar-brand navbar-brand-profile" href="#">{!! $user->getAvatar('img-responsive') !!}</a>
		                  <span class="site-name"><b>{{ $user->username }}</b> {{ $user->title }} 

                          </span>
                          <span class="site-description" style="color:{{ $user->group->color }}">{{ $user->group->name }}</span>
                        </div>
                    
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="mainNav" >
                          <ul class="nav main-menu navbar-nav navbar-nav-pro" role="tablist">
                            <li role="presentation" class="active">
                            	<a href="#timeline" aria-controls="timeline" role="tab" data-toggle="tab"><i class="fa fa-home"></i> Timeline</a>
                            </li>
                            <li role="presentation">
                            	<a href="#topics" aria-controls="topics" role="tab" data-toggle="tab">Topics <span class="badge">{{ $user->topics->count() }}</span></a>
                            </li>
                            <li role="presentation">
                            	<a href="#comments" aria-controls="comments" role="tab" data-toggle="tab">Comments <span class="badge">{{ $user->comments->count() }}</span></a>
                            </li>
                          </ul>
                          
                           <ul class="nav  navbar-nav navbar-nav-pro navbar-right">
                           @if($user->facebook)
                            <li><a href="http://facebook.com/{{ $user->facebook }}"><i class="fa fa-facebook"></i></a></li>
                           @endif
                           @if($user->twitter)
                            <li><a href="http://twitter.com/{{ $user->twitter }}"><i class="fa fa-twitter"></i></a></li>
                           @endif
                           @if($user->google)
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                           @endif
                            <li><a><button class="btn btn-nav-pro"><i class="fa fa-envelope"></i> Send message</button></a></li>
                            <li><a><button class="btn btn-nav-pro"><i class="fa fa-user-plus"></i> Add friend</button></a></li>
                          </ul>
                        </div><!-- /.navbar-collapse -->
				</nav>
            </header><!--/#HEADER-->
		</div>
	</div>
	<div class="row">
		<div class="col-md-9">
		@if (Auth::id() === $user->id)
			<form>
				{{ csrf_field() }}
				<label for="status">Status</label>
				<textarea name="status" id="status" class="form-control" placeholder="Say something.."></textarea>
				<button class="btn btn-info btn-sm">Post</button>
			</form>
			<br>
		@endif
			<div class="jumbotron" style="background-color: #fff">
				<div class="container">
				  <!-- Tab panes -->
				  <div class="tab-content">
				  	<!-- Timeline -->
				    <div role="tabpanel" class="tab-pane fade in active" id="timeline">
				    	timeline
				    </div>
				    <!-- Topics -->
				    <div role="tabpanel" class="tab-pane fade" id="topics">
				    @foreach ($user->topics as $topic)
				    	<a href="">{{ $topic->subject }}</a>
				    @endforeach
				    </div>
				    <!-- Comments -->
				    <div role="tabpanel" class="tab-pane fade" id="comments">
				    @foreach ($user->comments()->latest()->get() as $comment)
				    	<div class="panel panel-info">
				    		<div class="panel-heading">
				    			<a>{{ $comment->commentable->subject }}</a>
				    			<span class="pull-right">{{ $comment->created_at->diffForHumans() }}</span>
				    		</div>
				    		<div class="panel-body">
				    			<a href="">{{ $comment->body }}</a>
				    		</div>
				    	</div>
				    @endforeach
				    </div>
				  </div>
				</div>
			</div>			
		</div>	
		<div class="col-md-3">
			<div class="panel panel-default">
			  <div class="panel-heading">
			    <h3 class="panel-title"><i class="fa fa-desktop"></i> About</h3>
			  </div>
				<ul class="list-group">
				@if ($user->name())
				  <li class="list-group-item"><i class="fa fa-child"></i> {{ $user->name() }}</li>
				@endif
				  <li class="list-group-item"><i class="fa fa-calendar-check-o"></i> {{ $user->created_at->toFormattedDateString() }}</li>
				@if ($user->birthday)
				  <li class="list-group-item">{{ $user->birthday }} <i class="fa fa-birthday-cake"></i></li>
				@endif
				@if ($user->about)
				  <li class="list-group-item">{{ $user->about }}</li>
				@endif
				</ul>
			</div>
			<div class="panel panel-default">
			  <div class="panel-heading">
			    <h3 class="panel-title"><i class="fa fa-users"></i> Friends</h3>
			  </div>
				<ul class="list-group">
				</ul>
			</div>			
		</div>
	</div>
@stop