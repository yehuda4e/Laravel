@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Timeline</h3>
			</div>
			<div class="panel-body">
				<div class="col-lg-6">
				@foreach ($statuses as $status)
				<div class="panel panel-default">
					<div class="panel-body">
				<div class="media">
				    <a class="pull-left">
				    	{!! $status->user->getAvatar('thumbnail', 'width:52px;padding:0px') !!}
				    </a>
				    <div class="media-body">
				        <strong>{!! $status->user->profile() !!}</strong> past status <span class="text-muted">{{ $status->created_at->diffForHumans() }}</span>
				        <p>{{ $status->content }}</p>
				        <ul class="list-inline">
				        @if (auth()->user()->hasLiked($status))
				            <li><a href="{{ url('status/'.$status->id.'/unlike') }}"><i class="fa fa-thumbs-o-up"></i> Unlike</a></li>
				        @else
				            <li><a href="{{ url('status/'.$status->id.'/like') }}"><i class="fa fa-thumbs-o-up"></i> Like</a></li>
				        @endif
				            <li><a href="#"><i class="fa fa-comment-o"></i> Replay</a></li>
				            <li style="float:right">{{ $status->likes()->count() }} {{ str_plural('Like', $status->likes()->count()) }}</li>
				            <li style="float:right">{{ $status->comments()->count() }} {{ str_plural('Comment', $status->comments()->count()) }}</li>
				        </ul>

						@foreach ($status->comments as $comment)
						
			            <a class="pull-left" style="margin-right: 5px;">
			                {!! $comment->user->getAvatar('thumbnail', 'width:44px;padding:0px') !!}
			            </a>
				        <div class="media">
				            <div class="panel panel-info">
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

				        <form role="form" action="{{ url('status/'.$status->id.'/comment') }}" method="POST">
				        	{{ csrf_field() }}
				            <div class="col-md-10 pull-right form-group{{ $errors->has('body-'.$status->id) ? ' has-error' : '' }}">
				                <textarea name="body-{{ $status->id }}" class="form-control" rows="2" placeholder="Reply to this status">{{ old('body') }}</textarea>
				                @if ($errors->has('body-'.$status->id))
				                	<span class="help-block">
				                		{{ $errors->first('body-'.$status->id) }}
				                	</span>
				                @endif
				            </div>
						    <a class="pull-left" style="padding-left: 10px">
						    	{!! auth()->user()->getAvatar('thumbnail', 'width:38px;padding:0px') !!}
						    </a>				            
				            <div class="form-group text-left col-md-offset-1" style="padding-left: 15px;">
				            	<button class="btn btn-default btn-sm">Reply</button>
				            </div>
				        </form>
				    </div>
				    </div>
				</div>
				</div>
				@endforeach
				{{ $statuses->links() }}
				</div>
			</div>
		</div>			
	</div>
</div>
@stop