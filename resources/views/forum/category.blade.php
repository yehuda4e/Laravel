@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">{{ $category->name }}</h3>
			</div>
			@foreach ($category->forums as $forum)
			<div class="panel-body">
				<div class="row">
					<div class="col-xs-2 col-md-1 text-right"><span class="fa fa-envelope fa-4x"></span></div>
					<div class="col-xs-10 col-md-7">
						<div class="row">
							<h4><a href="{{ url('forum/'.$forum->id.'/'.$forum->name) }}"><strong>{{ $forum->name }}</strong></a></h4>
						</div>
						<div class="row">
							<small>{{ $forum->description }}</small>
						</div>
					</div>
					<div class="hidden-xs col-md-2">
						<div class="row">
							{{ $forum->topics->count() }}
							<small>Topics</small>
						</div>
						<div class="row">
							{{ $forum->comments->count() }}
							<small>Replies</small>									
						</div>
					</div>
					<div class="hidden-xs col-md-2">
						<img src="https://www.gravatar.com/avatar/086ea1caf1063896c127d0d8cfaf0358?d=retro&s=160" alt="johann.braun" style="width: 40px;border-radius: 100%;float: left;margin-right: 3px">
							<a href="http://localhost/laravel/pro/public/topic/19/Garry+Farrell#8">Garry Farrell</a><br>
							By <a href="http://localhost/laravel/pro/public/user/35/johann.braun" style="color:black">johann.braun</a><br>
							<span class="text-muted">1 month ago</span>
					</div>						
				</div>
			</div>
			@endforeach
		</div>
	</div>
</div>
@stop