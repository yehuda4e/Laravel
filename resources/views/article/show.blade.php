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
				{{ $article->content }}
				<hr>
				<i class="fa fa-user"></i> {!! $article->user->profile() !!} 
				<i class="fa fa-clock-o"></i> {{ $article->created_at->diffForHumans() }} 
				<i class="fa fa-eye"></i> {{ Redis::get("article.$article->id.views") }} 
				<i class="fa fa-tags"></i> <span class="label label-default"><a href="">PHP</a></span> <span class="label label-default">SQL</span>
			</div>
		</div>

		<div class="panel panel-info" id="comments">
			<div class="panel-heading">comments</div>
			<ul class="list-group">
			@foreach ($article->comments()->latest()->get() as $comment)
				<li class="list-group-item">
					<div class="row">
						<div class="col-md-1">{!! $comment->user->getAvatar('profile-cir') !!}</div>
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

<!-- 
add tags
add error to input
make ajax to comments
 -->
@stop
