@extends('layouts.app')

@section('js')
<script>
$(function() {
	$('.comments').hide();

	

/*	$('.like').children('a').click(function() {
		var like = "<i class=\"fa fa-thumbs-o-up\"></i> Like";
		var unlike = "<i class=\"fa fa-thumbs-o-up\"></i> Unlike";
		var statusId = $('.like').children('a').attr('data-status');
		var url = () ? "/status/"+statusId+"/unlike" : "/status/"+statusId+"/like";
console.log(url);
		$.ajax({
			url: url,
			type: "GET",
			success: function(data) {
				$('.like').siblings('.likes').children().html(parseInt($('.likes').children().html())+1);
			},
			error: function(data) {
				return false;
			}
		});
	});*/
	
	$('.comments a').first().css('padding-top', '0px');

	$('.comment').click(function() {
		$('#comments'+$(this).attr('data-id')).slideToggle(500);
	}).hover(function() {
		$(this).css("cursor", "pointer");
	}, function() {
		$(this).css("cursor", "auto");
	});

	$('.replay').click(function() {
		$('#body-'+$(this).attr('data-id')).focus();
	}).hover(function() {
		$(this).css("cursor", "pointer");
	}, function() {
		$(this).css("cursor", "auto");
	});
});
</script>
@stop

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Timeline</h3>
			</div>
			<div class="panel-body">
				<div class="col-lg-7">
				@foreach ($statuses as $status)
				<div class="media">
				    <a class="pull-left">
				    	{!! $status->user->getAvatar('thumbnail', 'width:52px;padding:0px') !!}
				    </a>
				    <div class="media-body">
				        <strong>{!! $status->user->profile() !!}</strong> post status <span class="text-muted">{{ $status->created_at->diffForHumans() }}</span>
				        <p>{{ $status->content }}</p>
				        <ul class="list-inline">
				        @if (auth()->user()->hasLiked($status))
				            <li><a href="{{ url('status/'.$status->id.'/unlike') }}"><i class="fa fa-thumbs-o-up"></i> Unlike</a></li>
				        @else
				            <li><a href="{{ url('status/'.$status->id.'/like') }}"><i class="fa fa-thumbs-o-up"></i> Like</a></li>
				        @endif
				            <li><a class="replay" data-id="{{ $status->id }}"><i class="fa fa-comment-o"></i> Replay</a></li>
				            <li class="likes" style="float:right">
				            	<span>{{ $status->likes()->count() }}</span> {{ str_plural('Like', $status->likes()->count()) }}
				            </li>
				            <li style="float:right"><a class="comment" data-id="{{ $status->id }}">
				            	<span class="commentsCount">{{ $status->comments()->count() }}</span> {{ str_plural('Comment', $status->comments()->count()) }}</a>
				            </li>
				        </ul>

						<div class="comments" id="comments{{ $status->id}}">
						@foreach ($status->comments as $comment)
						
			            <a class="pull-left" style="margin-right: 5px;padding-top: 15px">
			                {!! $comment->user->getAvatar('thumbnail', 'width:44px;padding:0px') !!}
			            </a>
				        <div class="media">
				            <div class="panel panel-info" style="margin-bottom: 0px">
				                <div class="panel-heading" style="padding: 5px">
				                	<strong>{!! $comment->user->profile() !!}</strong> commented <span class="text-muted">{{ $comment->created_at->diffForHumans() }}</span>
				                </div>
					            <div class="panel-body" style="padding: 10px;padding-bottom: 0px">
					                <p>{{ $comment->body }}</p>
					            </div>
					            <div class="panel-footer" style="padding: 5px;">
					                <ul class="list-inline" style="margin: 0px">
							        @if (auth()->user()->hasLiked($comment))
							            <li><a href="{{ url('comment/'.$comment->id.'/unlike') }}"><i class="fa fa-thumbs-o-up"></i> Unlike</a></li>
							        @else
							            <li><a href="{{ url('comment/'.$comment->id.'/like') }}"><i class="fa fa-thumbs-o-up"></i> Like</a></li>
							        @endif					                
					                    <li style="float:right">{{ $comment->likes()->count() }} {{ str_plural('Like', $comment->likes()->count()) }}</li>
					                </ul>
					           	</div>
				        	</div>
				        </div>
						@endforeach
						</div>

				        <form role="form" action="{{ url('status/'.$status->id.'/comment') }}" method="POST" style="margin-top: 20px">
				        	{{ csrf_field() }}
				            <div class="col-md-11 pull-right form-group{{ $errors->has('body-'.$status->id) ? ' has-error' : '' }}" style="padding-left: 0px;">
				                <textarea name="body-{{ $status->id }}" id="body-{{ $status->id }}" class="form-control" rows="2" placeholder="Reply to this status" required>{{ old('body') }}</textarea>
				                @if ($errors->has('body-'.$status->id))
				                	<span class="help-block">
				                		{{ $errors->first('body-'.$status->id) }}
				                	</span>
				                @endif
				            </div>
						    <a class="pull-left" style="margin-left: 5px">
						    	{!! auth()->user()->getAvatar('thumbnail', 'width:38px;padding:0px') !!}
						    </a>				            
				            <div class="form-group text-right col-md-offset-1" style="padding-left: 50px;">
				            	<button class="btn btn-default btn-sm">Reply</button>
				            </div>
				        </form>
				    </div>
				    </div>
				    <hr>
				@endforeach
				{{ $statuses->links() }}
				</div>
				<div class="col-lg-5">
					<h1>Friend Requests</h1>
					<hr>
					@foreach (auth()->user()->friendRequests() as $request)
						<p>{!! $request->profile() !!} 
							<span class="pull-right">
								<a href="{{ url('user/'.$request->username.'/accept') }}" class="btn btn-sm btn-info"><i class="fa fa-user-plus"></i> Accept</a>
							</span>
						</p>
					@endforeach
				</div>
			</div>
		</div>			
	</div>
</div>
@stop