@extends('admin.app')

@section('content')
{{ Session::set('header', 'Create new article') }}
<div class="row">
	<div class="col-md-12">
		<form action="{{ route('article.store') }}" method="POST" role="form" class="form-horizontal">
			{{ csrf_field() }}

			<div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
				<label for="subject" class="control-label col-md-1">Subject</label>
				
				<div class="col-md-8">
					<input type="text" name="subject" id="subject" value="{{ old('subject') }}" class="form-control" required autofocus>

					@if ($errors->has('subject'))
					<span class="help-block">
						{{ $errors->first('subject') }}
					</span>
					@endif
				</div>
			</div>

			<div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
				<label for="category" class="control-label col-md-1">Category</label>
				
				<div class="col-md-8">
					<select name="category" id="category" class="form-control">
						@foreach ($categories as $category)
						<option value="{{ $category->id }}">{{ $category->name }}</option>
						@endforeach
					</select>

					@if ($errors->has('category'))
					<span class="help-block">
						{{ $errors->first('category') }}
					</span>
					@endif
				</div>
			</div>			

			<div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
				<label for="slug" class="control-label col-md-1">Slug</label>
				
				<div class="col-md-8">
					<input type="text" name="slug" id="slug" value="{{ old('slug') }}" class="form-control">
					<span class="help-block">*This is what be shown in the URL</span>

					@if ($errors->has('slug'))
					<span class="help-block">
						{{ $errors->first('slug') }}
					</span>
					@endif					
				</div>
			</div>

			<div class="form-group{{ $errors->has('tags') ? ' has-error' : '' }}">
				<label for="tags" class="control-label col-md-1">Tags</label>
				
				<div class="col-md-8">
					<input type="text" name="tags" id="tags" value="{{ old('tags') }}" class="form-control">
					<span class="help-block">*Seperate with camma.</span>

					@if ($errors->has('tags'))
					<span class="help-block">
						{{ $errors->first('tags') }}
					</span>
					@endif					
				</div>
			</div>

			<div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
				<label for="content" class="control-label col-md-1">Content</label>
				
				<div class="col-md-8">
					<textarea name="content" id="content" rows="10" class="form-control">{{ old('content') }}</textarea>

					@if ($errors->has('content'))
					<span class="help-block">
						{{ $errors->first('content') }}
					</span>
					@endif					
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-9 text-center">
					<button class="btn btn-info">Create</button>
				</div>
			</div>
		</form>
	</div>
</div>
@stop