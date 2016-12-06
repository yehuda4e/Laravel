@extends('admin.app')

@section('content')
{{ Session::set('header', 'Users') }}
<div class="row">
	<div class="col-md-9">
		<a href="{{ url('admin/user/create') }}" class="btn btn-lg btn-primary" style="float:right">New User</a>
		<table class="table table-striped">
		<thead>
			<tr>
				<th style="width: 5%">#</th>
				<th style="width: 65%">Username</th>
				<th style="width: 30%">Actions</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($users as $user)
			<tr>
				<td>{{ $user->id }}</td>
				<td>{{ $user->username }}</td>
				<td>
					<form method="post" action="{{ url('admin/user/'.$user->id) }}">
						{{ csrf_field() }}
						{{ method_field('DELETE') }}
						<a href="{{ url('user/'.$user->id.'/'.$user->username) }}" class="btn btn-sm btn-info" target="_blank"><i class="fa fa-eye"> View</i></a>
						<a href="{{ url('admin/user/'.$user->id.'/edit') }}" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="top" title="Edit {{ $user->username }}">
						  <i class="fa fa-edit"> Edit</i>
						</a>
						<button type="submit" class="btn btn-sm btn-danger" onclick="return check()" data-toggle="tooltip" data-placement="top" title="Delete {{ $user->username }}">
						  <i class="fa fa-trash-o"> Delete</i>
						</button>
					</form>
				</td>
			</tr>
			@endforeach
		</tbody>
		</table>
		{{ $users->links()}}
	</div>
</div>
@stop