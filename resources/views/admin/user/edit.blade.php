@extends('admin.app')

@section('content')
{{ Session::set('header', 'edit '. $user->username)}}
<div class="row">
	<div class="col-md-12">
		<form action="{{ route('user.update', $user) }}" method="POST" role="form" class="form-horizontal">
			{{ csrf_field() }}
			{{ method_field('PATCH') }}

			<div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
				<label for="username" class="control-label col-md-1">Username</label>

				<div class="col-md-8">
					<input type="text" name="username" id="username" value="{{ old('username') ?? $user->username }}" class="form-control" required>

					@if ($errors->has('username'))
					<span class="help-block">
						{{ $errors->first('username') }}
					</span>
					@endif
				</div>
			</div>

			<div class="form-group{{ $errors->has('group') ? ' has-error' : '' }}">
				<label for="group" class="control-label col-md-1">Group</label>

				<div class="col-md-8">
					<select name="group" id="group" class="form-control">
						@foreach ($groups as $group)
						<option value="{{ $group->id }}" {{ $group->id == $user->group_id ? 'selected' : '' }}>{{ $group->name }}</option>
						@endforeach
					</select>

					@if ($errors->has('group'))
					<span class="help-block">
						{{ $errors->first('group') }}
					</span>
					@endif
				</div>
			</div>			

			<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
				<label for="email" class="control-label col-md-1">Email</label>

				<div class="col-md-8">
					<input type="email" name="email" id="email" value="{{ old('email') ?? $user->email }}" class="form-control" required>

					@if ($errors->has('email'))
					<span class="help-block">
						{{ $errors->first('email') }}
					</span>
					@endif
				</div>
			</div>

			<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
				<label for="password" class="control-label col-md-1">Password</label>

				<div class="col-md-8">
					<input type="password" name="password" id="password" value="{{ old('password') }}" class="form-control" required>

					@if ($errors->has('password'))
					<span class="help-block">
						{{ $errors->first('password') }}
					</span>
					@endif
				</div>
			</div>

			<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
				<label for="title" class="control-label col-md-1">Title</label>

				<div class="col-md-8">
					<input type="text" name="title" id="title" value="{{ old('title') ?? $user->title }}" class="form-control" required>

					@if ($errors->has('title'))
					<span class="help-block">
						{{ $errors->first('title') }}
					</span>
					@endif
				</div>
			</div>


			<div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
				<label for="avatar" class="col-md-1 control-label">Avatar</label>

				<div class="col-md-8">
					<input type="text" name="avatar" id="avatar" class="form-control" value="{{ old('avatar') ?? $user->avatar }}">

					@if ($errors->has('avatar'))
					<span class="help-block">
						{{ $errors->first('avatar')}}
					</span>
					@endif
				</div>
			</div>

			<div class="form-group{{ $errors->has('cover') ? ' has-error' : '' }}">
				<label for="cover" class="col-md-1 control-label">Cover</label>

				<div class="col-md-8">
					<input type="text" name="cover" id="cover" class="form-control" value="{{ old('cover') ?? $user->cover }}">

					@if ($errors->has('cover'))
					<span class="help-block">
						{{ $errors->first('cover')}}
					</span>
					@endif
				</div>
			</div>					

			<div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
				<label for="first_name" class="col-md-1 control-label">First Name</label>

				<div class="col-md-8">
					<input type="text" name="first_name" id="first_name" class="form-control" value="{{ old('first_name') ?? $user->first_name }}">

					@if ($errors->has('first_name'))
					<span class="help-block">
						<strong>{{ $errors->first('first_name') }}</strong>
					</span>
					@endif
				</div>
			</div>

			<div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
				<label for="last_name" class="col-md-1 control-label">Last Name</label>

				<div class="col-md-8">
					<input type="text" name="last_name" id="last_name" class="form-control" value="{{ old('last_name') ?? $user->last_name }}">

					@if ($errors->has('last_name'))
					<span class="help-block">
						<strong>{{ $errors->first('last_name') }}</strong>
					</span>
					@endif							
				</div>
			</div>

			<div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
				<label for="location" class="col-md-1 control-label">Location</label>

				<div class="col-md-8">
					<input type="text" name="location" id="location" class="form-control" value="{{ old('location') ?? $user->location }}">

					@if ($errors->has('location'))
					<span class="help-block">
						<strong>{{ $errors->first('location') }}</strong>
					</span>
					@endif							
				</div>
			</div>	

			<div class="form-group{{ $errors->has('sex') ? ' has-error' : '' }}">
				<label for="sex" class="col-md-1 control-label">Sex</label>

				<div class="col-md-8">
					<select name="sex" id="sex" class="form-control">
						<option value="none" {{ $user->sex == "none" ? 'selected' : '' }}>none</option>
						<option value="male" {{ $user->sex == "male" ? 'selected' : '' }}>male</option>
						<option value="female" {{ $user->sex == "female" ? 'selected' : '' }}>female</option>
					</select>

					@if ($errors->has('sex'))
					<span class="help-block">
						<strong>{{ $errors->first('sex') }}</strong>
					</span>
					@endif							
				</div>
			</div>

			<div class="form-group{{ $errors->has('about') ? ' has-error' : '' }}">
				<label for="about" class="col-md-1 control-label">About</label>

				<div class="col-md-8">
					<textarea name="about" id="about" rows="2" class="form-control">{{ old('about') ?? $user->about }}</textarea>

					@if ($errors->has('about'))
					<span class="help-block">
						<strong>{{ $errors->first('about') }}</strong>
					</span>
					@endif							
				</div>
			</div>

			<div class="form-group">
				<label for="signature" class="col-md-1 control-label">Signature</label>

				<div class="col-md-8">
					<textarea name="signature" id="signature" cols="30" rows="10" class="form-control">{{ old('signature') ?? $user->signature }}</textarea>
				</div>
			</div>			

			<div class="form-group">
				<div class="col-md-9 text-center">
					
				<button type="submit" class="btn btn-info">Update</button>
				</div>
			</div>									
		</form>
	</div>
</div>
@stop