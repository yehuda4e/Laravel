@extends('admin.app')

@section('content')
{{ Session::set('header', 'articles') }}
<div class="row">
	<div class="col-md-9">
		<a href="{{ url('admin/article/create') }}" class="btn btn-lg btn-primary" style="float:right">New Article</a>
		<table class="table table-striped">
		<thead>
			<tr>
				<th style="width: 5%">#</th>
				<th style="width: 35%">article name</th>
				<th>By</th>
				<th>Created at</th>
				<th style="width: 30%">Actions</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($articles as $article)
			<tr>
				<td>{{ $article->id }}</td>
				<td>{{ $article->subject }}</td>
				<td>{!! $article->user->profile() !!}</td>
				<td>{{ $article->created_at->diffForHumans() }}</td>
				<td>
					<form method="POST" action="{{ url('admin/article/'.$article->id) }}">
						{{ csrf_field() }}
						{{ method_field('DELETE') }}
						<a href="{{ url(urlencode($article->slug)) }}" class="btn btn-sm btn-info" target="_blank"><i class="fa fa-eye"> View</i></a>
						<a href="{{ url('admin/article/'.$article->id.'/edit') }}" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="top" title="Edit {{ $article->name }}">
						  <i class="fa fa-edit"> Edit</i>
						</a>
						<button type="submit" class="btn btn-sm btn-danger" onclick="return check()" data-toggle="tooltip" data-placement="top" title="Delete {{ $article->name }}">
						  <i class="fa fa-trash-o"> Delete</i>
						</button>
					</form>
				</td>
			</tr>
			@endforeach
		</tbody>
		</table>
		{{ $articles->links()}}
	</div>
</div>
@stop