@extends('layouts.app')

@section('js')
<script>
$(function() {
	$('.toggle').on('click', function() {
		var cat = $(this).attr('data-cat');
		var icon = $(this).find('i');
		$('#cat'+cat).slideToggle(500);

		icon.toggleClass(function() {
			if (icon.hasClass('fa-minus')) {
				icon.removeClass('fa-minus');
				return 'fa-plus';
			} else {
				icon.removeClass('fa-plus');
				return 'fa-minus';				
			}
		});
	});
});
</script>
@stop

@section('content')
@foreach ($categories as $category)
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><a href="/category/{{ $category->id }}/{{ urlencode($category->name) }}">{{ $category->name }}</a></h3>
				<a href="#" class="toggle" data-cat="{{ $category->id }}" style="float:right;margin-top: -18px;"><i class="fa fa-minus"></i></a>
			</div>
			<div id="cat{{$category->id}}">
				@foreach ($category->forums as $forum)
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-2 col-md-1 text-right"><span class="fa fa-envelope fa-4x"></span></div>
						<div class="col-xs-10 col-md-7">
							<div class="row">
								<h4><a href="{{ url('forum/'.$forum->id.'/'.urlencode($forum->name)) }}"><strong>{{ $forum->name }}</strong></a></h4>
							</div>
							<div class="row">
								<small>{{ $forum->description }}</small>
							</div>
						</div>
						<div class="hidden-xs col-md-1 text-center">
							<div class="row">
								{{ $forum->topics->count() }}
								<small><strong>Topics</strong></small>
							</div>
							<div class="row">
								{{ $forum->comments->count() }}
								<small><strong>Replies</strong></small>									
							</div>
						</div>
						<div class="hidden-xs col-md-3">
							@if($forum->last())
								{!! $forum->last()->user->getAvatar('profile-last-com') !!}
								<a href="{{ url('topic/'.$forum->subjectOrComment()->id.'/'.urlencode($forum->subjectOrComment()->subject)) }}">{{ $forum->subjectOrComment()->subject }}</a><br>
								By {!! $forum->last()->user->profile() !!}<br>
								<span class="text-muted">{{ $forum->last()->created_at->diffForHumans() }}</span>
							@else
								---
							@endif					
						</div>						
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
</div>
@endforeach

@stop