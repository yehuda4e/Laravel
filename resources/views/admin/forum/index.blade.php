@extends('admin.app')

@section('content')

{{ Session::set('header', 'Forums') }}
<div class="row">
	<div class="col-md-12">
		<a href="{{ url('admin/forum/create') }}" class="btn btn-lg btn-primary" style="float:right">New Forum</a>
		<table class="table table-striped">
		<thead>
			<tr>
				<th style="width: 5%">#</th>
				<th style="width: 65%">Forum name</th>
				<th style="width: 30%">Actions</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($forums as $forum)
			<tr>
				<td>{{ $forum->id }}</td>
				<td>{{ $forum->name }}</td>
				<td>
					<form method="post" action="{{ url('admin/forum/'.$forum->id) }}">
						{{ csrf_field() }}
						{{ method_field('DELETE') }}
						<a href="{{ url('forum/'.$forum->id.'/'.$forum->name) }}" class="btn btn-sm btn-info" target="_blank"><i class="fa fa-eye"> View</i></a>
						<a href="{{ url('admin/forum/'.$forum->id.'/edit') }}" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="top" title="Edit {{ $forum->name }}">
						  <i class="fa fa-edit"> Edit</i>
						</a>
						<button type="submit" class="btn btn-sm btn-danger" onclick="return check()" data-toggle="tooltip" data-placement="top" title="Delete {{ $forum->name }}">
						  <i class="fa fa-trash-o"> Delete</i>
						</button>
					</form>
				</td>
			</tr>
			@endforeach
		</tbody>
		</table>
		{{ $forums->links()}}
	</div>
</div>
@stop