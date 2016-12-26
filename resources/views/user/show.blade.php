@extends('layouts.app')

@section('js')
<script>
$(function() {
	function unfriend(id) {
		$.ajax({
			url: "/user/{{ $user->username }}/cancel",
			type: 'GET',
			success: function(data) {
				$(id).html('<i class="fa fa-user-plus"></i> Add friend');
				$(id).attr('id', '');
			},
			error: function(data) {
				console.log('error '+data.info);
			}

		});
	}

	$('#cancel').hover(function() {
		$('#cancel').html('<i class="fa fa-user-times"></i> Cancel friend request');
	}, function() {
		$('#cancel').html('<i class="fa fa-user-plus"></i> Waiting to accept');
	}).click(function() {
		unfriend('#cancel');
	});	


	$('#unfriend').hover(function() {
		$('#unfriend').html('<i class="fa fa-user-times"></i> Unfriend me');
	}, function() {
		$('#unfriend').html('<i class="fa fa-user"></i> You friends');
	}).click(function() {
		unfriend('#unfriend');
	});
});
</script>
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
                        @if (Auth::user()->hasFriendRequestPending($user))
                        <li><a><button class="btn btn-nav-pro" title="Cancel friend request" id="cancel"><i class="fa fa-user-plus"></i> Waiting to accept</button></a></li>
                        @elseif (Auth::user()->hasFriendRequestReceived($user))
                        <li><a href="{{ url('user/'.$user->username.'/accept') }}"><button class="btn btn-nav-pro"><i class="fa fa-user-plus"></i> Accept your friend</button></a></li>
                        @elseif (Auth::user()->isFriendWith($user))
                        <li><a><button class="btn btn-nav-pro" id="unfriend"><i class="fa fa-user"></i> You friends</button></a></li>
                        @elseif (Auth::id() !== $user->id)
                        <li><a href="{{ url('user/add/'.$user->username) }}"><button class="btn btn-nav-pro"><i class="fa fa-user-plus"></i> Add friend</button></a></li>
                        @endif
                        <li><a><button class="btn btn-nav-pro"><i class="fa fa-envelope"></i> Send message</button></a></li>
                      </ul>
                    </div><!-- /.navbar-collapse -->
			</nav>
        </header><!--/#HEADER-->
	</div>
</div>
<div class="row">
	<div class="col-md-9">
	@if (Auth::id() === $user->id)
		<!-- Status form -->
		<form method="POST" action="{{ url('status') }}">
			{{ csrf_field() }}
			<div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
				<label for="status">Status</label>
				<textarea name="status" id="status" class="form-control" placeholder="Say something.."></textarea>
				@if ($errors->has('status'))
					<span class="help-block">
						{{ $errors->first('status') }}
					</span>
				@endif
			</div>
			<div class="form-group">
				<button class="btn btn-info btn-sm">Update Status</button>
			</div>
		</form>
		<br>
	@endif
		<div class="jumbotron" style="background-color: #fff">
			<div class="container">
			  <!-- Tab panes -->
			  <div class="tab-content">
			  	<!-- Timeline -->
			    <div role="tabpanel" class="tab-pane fade in active" id="timeline">
			    	<h2>{{ $user->username }}'s Activity</h2>
			    	@if ($user->statuses->count())
						@foreach ($user->statuses()->latest()->get() as $status)
						<div class="media">
						    <a class="pull-left">
						    	{!! $status->user->getAvatar('media-object', 'width:44px') !!}
						    </a>
						    <div class="media-body">
						        <h4 class="media-heading">{!! $status->user->profile() !!}</h4>
						        <p>{{ $status->content }}</p>
						        <ul class="list-inline">
						            <li>{{ $status->created_at->diffForHumans() }}</li>
						            <li><a href="#">Like</a></li>
						            <li>10 likes</li>
						        </ul>

								@foreach ($status->comments as $comment)
						        <div class="media">
						            <a class="pull-left">
						                {!! $comment->user->getAvatar('', 'width:44px') !!}
						            </a>
						            <div class="media-body">
						                <h5 class="media-heading">{!! $comment->user->profile() !!}</h5>
						                <p>{{ $comment->body }}</p>
						                <ul class="list-inline">
						                    <li>{{ $comment->created_at->diffForHumans() }}</li>
						                    <li><a href="#">Like</a></li>
						                    <li>4 likes</li>
						                </ul>
						            </div>
						        </div>
								@endforeach

						        <form role="form" action="{{ url('status/'.$status->id.'/comment') }}" method="POST">
						        	{{ csrf_field() }}
						            <div class="form-group{{ $errors->has('body-'.$status->id) ? ' has-error' : '' }}">
						                <textarea name="body-{{ $status->id }}" class="form-control" rows="2" placeholder="Reply to this status">{{ old('body') }}</textarea>
						                @if ($errors->has('body-'.$status->id))
						                	<span class="help-block">
						                		{{ $errors->first('body-'.$status->id) }}
						                	</span>
						                @endif
						            </div>
						            <input type="submit" value="Reply" class="btn btn-default btn-sm">
						        </form>
						    </div>
						</div>
						@endforeach			    	
			    	@endif
			    </div>
			    <!-- Friends -->
			    <div role="tabpanel" class="tab-pane fade" id="friends">
			    	<div class="col-md-12">
			    	@if ($user->friends()->count())
			    		<h2>{{ $user->username }}'s friends</h2>
			    		@foreach ($user->friends() as $friend)
			    			{!! $friend->profile($friend->getAvatar()) !!}
			    		@endforeach
			    	@else
			    		<p>{{ $user->username }} has no friends.</p>
			    	@endif
			    	</div>
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
		<!-- About -->
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
		<!-- Friends -->
		<div class="panel panel-default">
			<div class="panel-heading">
			   <h3 class="panel-title"><i class="fa fa-users"></i> <a href="#friends" aria-controls="friends" role="tab" data-toggle="tab">{{ $user->friends()->count() }} Friends</a></h3>
			</div>
			<div class="panel-body">
				<div class="col-md-12">
				@if ($user->friends()->count())
			  		@foreach ($user->friends()->take(10) as $friend)
						{!! $friend->profile($friend->getAvatar('', 'width:64px')) !!}
					@endforeach
				@else
					<p>No friends</p>
				@endif
				</div>			
			</div>
		</div>			
	</div>
</div>
@stop