@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-md-8 col-md-offset-1">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Results for: <strong>{{$tag}}</strong> tag</h3>
			</div>
			<div class="panel-body">
				<table class="table table-bordered table-responsive">
					<thead>
						<th>Subject</th>
						<th>By</th>
						<th>Views</th>
						<th>Created at</th>
					</thead>
					<tbody>
					@foreach ($articles as $article)
					<tr>
						<td><a href="{{ url(urlencode($article->slug)) }}">{{ $article->subject }}</a></td>
						<td>{!! $article->user->profile() !!}</td>
						<td>{{ Redis::get('article.'.$article->id.'.views') }}</td>
						<td>{{ $article->created_at->diffForHumans() }}</td>
					</tr>
					@endforeach
					</tbody>
				</table>
				{{ $articles->links() }}
			</div>
		</div>
	</div>
	@include('article._category')
</div>
@stop