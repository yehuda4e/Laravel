@extends('admin.app')

@section('content')
{{ Session::set('header', 'Create new user') }}

<div class="row">
	<div class="col-md-12">
		<form action="{{ route('user.store') }}" method="POST" role="form" class="form-horizontal">
			{{ csrf_field() }}
			<div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
				<label for="username" class="control-label col-md-1">Username</label>

				<div class="col-md-8">
					<input type="text" name="username" id="username" value="{{ old('username') }}" class="form-control" required autofocus>

					@if ($errors->has('username'))
					<span class="help-block">
						{{ $errors->first('username') }}
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

			<div class="form-group">
				<label for="password_confirmation" class="control-label col-md-1">Confirm password</label>

				<div class="col-md-8">
					<input type="password" name="password_confirmation" id="password_confirmation" value="{{ old('password_confirmation') }}" class="form-control" required>
				</div>
			</div>

			<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
				<label for="email" class="control-label col-md-1">email</label>

				<div class="col-md-8">
					<input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control" required>

					@if ($errors->has('email'))
					<span class="help-block">
						{{ $errors->first('email') }}
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