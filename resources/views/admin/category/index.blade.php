@extends('admin.app')

@section('content')
{{ Session::set('header', 'Categories') }}

<div class="row">
	<div class="col-md-9">
		<a href="{{ url('admin/category/create') }}" class="btn btn-lg btn-primary" style="float:right">New Category</a>
		<table class="table table-striped">
		<thead>
			<tr>
				<th style="width: 5%">#</th>
				<th style="width: 65%">categoryname</th>
				<th style="width: 30%">Actions</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($categories as $category)
			<tr>
				<td>{{ $category->id }}</td>
				<td>{{ $category->name }}</td>
				<td>
					<form method="post" action="{{ url('admin/category/'.$category->id) }}">
						{{ csrf_field() }}
						{{ method_field('DELETE') }}
						<a href="{{ url('article/cat/'.urlencode($category->name)) }}" class="btn btn-sm btn-info" target="_blank"><i class="fa fa-eye"> View</i></a>
						<a href="{{ url('admin/category/'.$category->id.'/edit') }}" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="top" title="Edit {{ $category->name }}">
						  <i class="fa fa-edit"> Edit</i>
						</a>
						<button type="submit" class="btn btn-sm btn-danger" onclick="return check()" data-toggle="tooltip" data-placement="top" title="Delete {{ $category->name }}">
						  <i class="fa fa-trash-o"> Delete</i>
						</button>
					</form>
				</td>
			</tr>
			@endforeach
		</tbody>
		</table>
		{{ $categories->links()}}
	</div>
</div>
@stop