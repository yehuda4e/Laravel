@extends('admin.app')

@section('content')
{{ Session::set('header', 'Edit '.$forum->name.' forum')}}

<div class="row">
	<div class="col-md-12">
		<form action="{{ route('forum.update', $forum) }}" method="POST" class="form-horizontal">
			{{ csrf_field() }}
			{{ method_field('PATCH') }}

			<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
				<label for="name" class="control-label col-md-1">Name</label>

				<div class="col-md-8">
					<input type="text" name="name" id="name" class="form-control" value="{{ old('name') ?? $forum->name }}">

					@if ($errors->has('name'))
					<span class="help-block">
						{{ $errors->first('name') }}
					</span>
					@endif
				</div>
			</div>

			<div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
				<label for="category" class="control-label col-md-1">Category</label>

				<div class="col-md-8">
					<select name="category" id="category" class="form-control">
					@foreach ($categories as $category)
						<option value="{{ $category->id }}" {{ ($category->id == $forum->cat->id) ? 'selected' : '' }}>{{ $category->name }}</option>
					@endforeach
					</select>

					@if ($errors->has('category'))
					<span class="help-block">
						{{ $errors->first('category') }}
					</span>
					@endif					
				</div>
			</div>

			<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
				<label for="description" class="control-label col-md-1">Description</label>

				<div class="col-md-8">
					<textarea name="description" id="description" rows="2" class="form-control">{{ old('description') ?? $forum->description }}</textarea>

					@if ($errors->has('description'))
					<span class="help-block">
						{{ $errors->first('description') }}
					</span>
					@endif					
				</div>
			</div>

			<div class="form-group text-center">
				<div class="col-md-9">
					<button class="btn btn-info" type="submit">Update</button>
				</div>
			</div>
		</form>
	</div>
</div>
@stop