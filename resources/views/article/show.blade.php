@extends('layouts.app')

@section('js')
<script>
$(document).ready(function() {
	$textarea = '<textarea name="comment" id="comment" cols="20" rows="5" class="form-control" autofocus placeholder="enter a comment">{{ old('comment') }}</textarea>';
	$('#comment').on('focus', function() {
		$('#comment').replaceWith($textarea);
		$('#comment').focus();
	});
});

</script>
@stop

@section('content')
<div class="row">
	<div class="col-md-8 col-md-offset-1">
		<div class="panel panel-default">
			<div class="panel-heading"><h3 class="panel-title">{{ $article->subject }}</h3></div>
			<div class="panel-body">
				{!! nl2br($article->content) !!}
				<hr>
				<i class="fa fa-user"></i> {!! $article->user->profile() !!} |
				<i class="fa fa-clock-o"></i> {{ $article->created_at->diffForHumans() }} |
				<i class="fa fa-eye"></i> {{ Redis::get("article.$article->id.views") }} |
				<i class="fa fa-tags"></i> 
				@if ($article->tags)
				@foreach(explode(',', $article->tags) as $tag)
				<span class="label label-default"><a href="{{ url('article/tag/'.trim($tag)) }}">{{ trim($tag) }}</a></span> 
				@endforeach
				@endif
			</div>
		</div>

		<div class="panel panel-info" id="comments">
			<div class="panel-heading">comments</div>
			<ul class="list-group">
			@foreach ($article->comments()->latest()->get() as $comment)
				<li class="list-group-item">
					<div class="row">
						<div class="col-md-1" style="padding-left: 25px;">{!! $comment->user->getAvatar('profile-cir') !!}</div>
						<div class="col-md-11">{{ $comment->body }}</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<small><em>{{ $comment->created_at->diffForHumans() }} by {!! $comment->user->profile() !!}</em></small>
						</div>
					</div>
				</li>
			@endforeach
			</ul>
			<div class="panel-footer text-center">
			@if (Auth::guest())
				<strong>You need to <a href="{{ route('login') }}">log in</a> to comment.</strong>
			@else
				<form method="POST" action="/article/{{ $article->id }}/comment">
					{{ csrf_field() }}
					<input type="text" name="comment" id="comment" class="form-control" placeholder="Enter a comment">
					<button class="btn btn-primary">Comment</button>
				</form>
			@endif
			</div>
		</div>
	</div>
	@include('article._category')
</div>
@stop
