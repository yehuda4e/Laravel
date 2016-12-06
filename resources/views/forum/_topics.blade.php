<div class="row">
	<div class="col-md-1 text-center"><i class="fa fa-2x fa-{{ ($topic->lock == true) ? 'lock' : 'envelope' }}"></i></div>
	<div class="col-md-5">
		<div class="row">
			{!! ($topic->pinned) ? '<i class="fa fa-bookmark"></i>' : '' !!} <a href="{{ url('topic/'.$topic->id.'/'.urlencode($topic->subject)) }}">{{ $topic->subject }}</a>
		</div>
		<div class="row">
				<small>by {!! $topic->user->profile() !!} at {{ $topic->created_at->diffForHumans() }}</small>
		</div>
	</div>
	<div class="col-md-2 text-center">
		<div class="row">
			<small>{{ $topic->comments->count() }} comments</small>
		</div>
		<div class="row">
				<small>{{ Redis::get("topic.$topic->id.views") ?? 0 }} views</small>
		</div>
	</div>
	<div class="col-md-4">by {!! $topic->lastReply()->user->profile() !!}<br>{{ $topic->created_at->diffForHumans() }}</div>
</div>