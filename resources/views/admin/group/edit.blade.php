@extends('admin.app')

@section('content')
{{ Session::set('header', 'Edit '.$group->name) }}

<div class="row">
	<div class="col-md-12">
		<form action="{{ route('group.update', $group) }}" method="POST" role="form" class="form-horizontal">
			{{ csrf_field() }}
			{{ method_field('PATCH') }}

			<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
				<label for="name" class="control-label col-md-1">Name</label>

				<div class="col-md-8">
					<input type="text" name="name" id="name" value="{{ old('name') ?? $group->name }}" class="form-control" required autofocus>

					@if ($errors->has('name'))
					<span class="help-block">
						{{ $errors->first('name')}}
					</span>
					@endif
				</div>
			</div>

			<div class="form-group{{ $errors->has('color') ? ' has-error' : '' }}">
				<label for="color" class="control-label col-md-1">Color</label>

				<div class="col-md-8">
					<input type="color" name="color" id="color" value="{{ old('color') ?? $group->color }}" class="form-control" required>

					@if ($errors->has('color'))
					<span class="help-block">
						{{ $errors->first('color')}}
					</span>
					@endif
				</div>
			</div>

			<h4 class="col-md-12">Permissions</h4>
			<div class="form-group">
				<label for="permissions" class="control-label col-md-1">Admin panel access</label>
			
				<div class="col-md-8">
					<label class="radio-inline">
					  <input type="radio" name="permissions[admin]" value="1" {{ ($permission['admin'] == true) ? 'checked' : '' }}> yes
					</label>
					<label class="radio-inline">
					  <input type="radio" name="permissions[admin]" value="0" {{ ($permission['admin'] == false) ? 'checked' : '' }}> no
					</label>		
				</div>
			</div>

			<div class="form-group">

				<label class="control-label col-md-1">Topics</label>

				<div class="col-md-8">
					<label for="create" class="control-label col-md-1">Create</label>
					<div class="col-md-2">
						<label class="radio-inline">
						  <input type="radio" name="permissions[topic][create]" value="1" {{ ($permission['topic']['create'] == true) ? 'checked' : '' }}> yes
						</label>
						<label class="radio-inline">
						  <input type="radio" name="permissions[topic][create]" value="0" {{ ($permission['topic']['create'] == false) ? 'checked' : '' }}> no
						</label>	
					</div>		

					<label for="edit" class="control-label col-md-1">Edit</label>	
					<div class="col-md-2">							
						<label class="radio-inline">
						  <input type="radio" name="permissions[topic][edit]" value="1" {{ ($permission['topic']['edit'] == true) ? 'checked' : '' }}> yes
						</label>
						<label class="radio-inline">
						  <input type="radio" name="permissions[topic][edit]" value="0" {{ ($permission['topic']['edit'] == false) ? 'checked' : '' }}> no
						</label>
					</div>		

					<label for="close" class="control-label col-md-1">Close</label>	
					<div class="col-md-2">							
						<label class="radio-inline">
						  <input type="radio" name="permissions[topic][edit]" value="1" {{ ($permission['topic']['edit'] == true) ? 'checked' : '' }}> yes
						</label>
						<label class="radio-inline">
						  <input type="radio" name="permissions[topic][edit]" value="0" {{ ($permission['topic']['edit'] == false) ? 'checked' : '' }}> no
						</label>
					</div>	

					<label for="delete" class="control-label col-md-1">Delete</label>	
					<div class="col-md-2">							
						<label class="radio-inline">
						  <input type="radio" name="permissions[topic][edit]" value="1" {{ ($permission['topic']['edit'] == true) ? 'checked' : '' }}> yes
						</label>
						<label class="radio-inline">
						  <input type="radio" name="permissions[topic][edit]" value="0" {{ ($permission['topic']['edit'] == false) ? 'checked' : '' }}> no
						</label>
					</div>														
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