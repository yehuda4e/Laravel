@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading"><h3 class="panel-title">{{ $forum->name }}</h3></div>
			@if ($forum->description)
			<div class="panel-footer">{{ $forum->description }}</div>
			@endif

			<div class="panel-body">
			@foreach ($forum->topics()->where('pinned', true)->latest('updated_at')->paginate() as $topic)
				@include('forum._topics')
			@endforeach		

			@foreach ($forum->topics()->where('pinned', false)->latest('updated_at')->paginate() as $topic)
				@include('forum._topics')
			@endforeach		
			</div>
			<div class="panel-footer">
				<div class="row">
					<div class="col-md-10">{{ $forum->topics()->paginate()->links() }}</div>
					@can('create-topic')
					<div class="col-md-2 text-right"><a href="{{ url('topic/'.$forum->id.'/create') }}" class="btn btn-primary">New Topic</a></div>
					@endcan
				</div>
			</div>
		</div>
	</div>
</div>
@stop