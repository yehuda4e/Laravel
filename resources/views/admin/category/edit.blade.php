@extends('admin.app')

@section('content')
{{ Session::set('header', 'Edit '.$category->name) }}

<div class="row">
	<div class="col-md-12">
		<form action="{{ route('category.update', $category) }}" method="POST" role="form" class="form-horizontal">
			{{ csrf_field() }}
			{{ method_field('PATCH') }}
			<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
				<label for="name" class="control-label col-md-1">Name</label>

				<div class="col-md-8">
					<input type="text" name="name" id="name" value="{{ old('name') ?? $category->name }}" class="form-control" required autofocus>

					@if ($errors->has('name'))
					<span class="help-block">
						{{ $errors->first('name') }}
					</span>
					@endif
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-9 text-center">
					<button class="btn btn-info">Update</button>
				</div>
			</div>
		</form>
	</div>
</div>
@stop