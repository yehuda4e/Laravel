@extends('admin.app')

@section('content')
{{ Session::set('header', 'Groups') }}
<div class="row">
	<div class="col-md-9">
		<a href="{{ url('admin/group/create') }}" class="btn btn-lg btn-primary" style="float:right">New Group</a>
		<table class="table table-striped">
		<thead>
			<tr>
				<th style="width: 5%">#</th>
				<th style="width: 65%">Group name</th>
				<th style="width: 30%">Actions</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($groups as $group)
			<tr>
				<td>{{ $group->id }}</td>
				<td><span style="color:{{ $group->color }}">{{ $group->name }}</span></td>
				<td>
					<form method="POST" action="{{ url('admin/group/'.$group->id) }}">
						{{ csrf_field() }}
						{{ method_field('DELETE') }}
						<a href="{{ url('group/'.$group->id.'/'.$group->name) }}" class="btn btn-sm btn-info" target="_blank"><i class="fa fa-eye"> View</i></a>
						<a href="{{ url('admin/group/'.$group->id.'/edit') }}" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="top" title="Edit {{ $group->name }}">
						  <i class="fa fa-edit"> Edit</i>
						</a>
						<button type="submit" class="btn btn-sm btn-danger" onclick="return check()" data-toggle="tooltip" data-placement="top" title="Delete {{ $group->name }}">
						  <i class="fa fa-trash-o"> Delete</i>
						</button>
					</form>
				</td>
			</tr>
			@endforeach
		</tbody>
		</table>
		{{ $groups->links()}}
	</div>
</div>
@stop