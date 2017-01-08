@extends('layouts.app')

@section('js')
<script src="/js/ckeditor/ckeditor.js"></script>
<script>
CKEDITOR.replace( 'editor1' );
</script>
@stop

@section('content')
<ol class="breadcrumb">
  <li><a href="{{ url('category/'.$topic->forum->cat->id.'/'.urlencode($topic->forum->cat->name)) }}">{{ $topic->forum->cat->name }}</a></li>
  <li><a href="{{ url('forum/'.$topic->forum->id.'/'.urlencode($topic->forum->name)) }}">{{ $topic->forum->name }}</a></li>
  <li class="active">{{ $topic->subject }}</li>
</ol>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">{{ $topic->subject }}</h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-10">
						<div class="row" style="border-bottom: 2px solid #eee;margin-bottom: 10px;margin-top:-10px">
							<div class="col-md-12">
								{{ $topic->created_at->diffForHumans() }}
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								{!!  ($topic->edits->count()) ? $topic->edits()->lastEdit()->body : $topic->content !!}
								@if ($topic->edits->count())
								<p>
									<small><i>Last edit: {{ $topic->edits()->lastEdit()->created_at->diffForHumans() }} by {!! $topic->edits()->lastEdit()->user->profile() !!}</i></small>
								</p>
								@endif
							</div>
						</div>
						@if ($topic->user->signature)
						<div class="row">
							<div class="col-md-12">
								<hr style="width:80%;border-color:black">
								{{ $topic->user->signature}}
							</div>
						</div>
						@endif
					</div>
					<div class="col-md-2 text-center" style="border-left: 2px solid #eee;margin-top:-15px;padding-top: 10px">
						{!! $topic->user->getAvatar('img-thumbnail') !!}
						{!! $topic->user->profile() !!}<br>
						<small>{{ $topic->user->title }}</small><br>
						<strong>Sex:</strong> {{ $topic->user->sex }} <br>
						<strong>Joined:</strong> {{ $topic->user->created_at->diffForHumans() }}
					</div>
				</div>
			</div>
			<div class="panel-footer">
				<i class="fa fa-warning"></i>
				<i class="fa fa-quote-right"></i>
			</div>

			@foreach ($topic->comments as $comment)
			<div class="panel-body">
				<div class="row">
					<div class="col-md-10">
						<div class="row" style="border-bottom: 1px solid #eee;margin-bottom: 10px;margin-top:-10px">
							<div class="col-md-12">
								{{ $comment->created_at->diffForHumans() }}
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								{!! $comment->body !!}
							</div>
						</div>
						@if ($comment->user->signature)
						<div class="row">
							<div class="col-md-12">
								<hr style="width:80%;border-color:black">
								{{ $comment->user->signature}}
							</div>
						</div>
						@endif						
					</div>
					<div class="col-md-2 text-center" style="border-left: 1px solid #eee;margin-top:-15px;margin-bottom: -15px;padding-top: 10px">
						{!! $comment->user->getAvatar('img-thumbnail') !!}
						{!! $comment->user->profile() !!}<br>
						<small>{{ $comment->user->title }}</small><br>
						Sex: {{ $comment->user->sex }} <br>
						Joined: {{ $comment->user->created_at->diffForHumans() }}
					</div>
				</div>
			</div>
			<div class="panel-footer">
				<i class="fa fa-warning"></i>
				<i class="fa fa-quote-right"></i>
			</div>
			@endforeach

			<div class="panel-footer text-center">
			@if (Auth::guest())
				You need to <a href="{{ route('login') }}">log in</a> to comment.
			@elseif ($topic->lock)
				The topic is lock you can't comment.
			@else
				<form method="POST" action="/topic/{{ $topic->id }}/comment">
					{{ csrf_field() }}
					<textarea class="form-control" name="comment" id="comment" placeholder="enter a comment">{{ old('comment') }}</textarea>
					<button class="btn btn-primary">Comment</button>
				</form>
			@endif
			</div>	
		</div>

		@if (auth()->check() && auth()->user()->isAdmin())
		<!-- Moderator options -->
		<div class="panel panel-default">
			<div class="panel-heading"><strong>Moderator Options</strong></div>
			<div class="panel-body">
				<form action="{{ url('topic/'.$topic->id.'/change') }}" method="POST" class="form-horizontal">
					{{ csrf_field() }}
					<label for="options" class="control-label col-md-1">Options</label>
					<div class="col-md-3">
						<select name="options[]" id="options" class="form-control">
							<option value="close">Close</option>
							<option value="open">Open</option>
							<option value="pin">Pin the topic</option>
							<option value="unpin">Unpin the topic</option>
							<option value="delete">Delete this topic</option>
						</select>
					</div>
					<button class="btn btn-warning">Excute</button>
				</form>
			</div>	
		</div>	
		@endif		
	</div>
</div>
@stop