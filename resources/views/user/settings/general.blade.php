@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-md-10">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">General Details</h3>
			</div>
			<div class="panel-body">
				<form method="POST" action="" role="form" class="form-horizontal">
					{{ csrf_field() }}
					{{ method_field('PATCH') }}
					<div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
						<label for="first_name" class="col-md-2 control-label">First Name</label>

						<div class="col-md-10">
							<input type="text" name="first_name" id="first_name" class="form-control" value="{{ old('first_name') ?? $user->first_name }}">

							@if ($errors->has('first_name'))
							<span class="help-block">
								<strong>{{ $errors->first('first_name') }}</strong>
							</span>
							@endif
						</div>
					</div>

					<div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
						<label for="last_name" class="col-md-2 control-label">Last Name</label>

						<div class="col-md-10">
							<input type="text" name="last_name" id="last_name" class="form-control" value="{{ old('last_name') ?? $user->last_name }}">

							@if ($errors->has('last_name'))
							<span class="help-block">
								<strong>{{ $errors->first('last_name') }}</strong>
							</span>
							@endif							
						</div>
					</div>

					<div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
						<label for="location" class="col-md-2 control-label">Location</label>

						<div class="col-md-10">
							<input type="text" name="location" id="location" class="form-control" value="{{ old('location') ?? $user->location }}">

							@if ($errors->has('location'))
							<span class="help-block">
								<strong>{{ $errors->first('location') }}</strong>
							</span>
							@endif							
						</div>
					</div>	

					<div class="form-group{{ $errors->has('sex') ? ' has-error' : '' }}">
						<label for="sex" class="col-md-2 control-label">Sex</label>

						<div class="col-md-10">
							<select name="sex" id="sex" class="form-control">
								<option value="none">none</option>
								<option value="male">male</option>
								<option value="female">female</option>
							</select>

							@if ($errors->has('sex'))
							<span class="help-block">
								<strong>{{ $errors->first('sex') }}</strong>
							</span>
							@endif							
						</div>
					</div>

					<div class="form-group{{ $errors->has('about') ? ' has-error' : '' }}">
						<label for="about" class="col-md-2 control-label">About</label>

						<div class="col-md-10">
							<textarea name="about" id="about" rows="2" class="form-control">{{ old('about') ?? $user->about }}</textarea>

							@if ($errors->has('about'))
							<span class="help-block">
								<strong>{{ $errors->first('about') }}</strong>
							</span>
							@endif							
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-12 text-center">
							
						<button type="submit" class="btn btn-info">Update</button>
						</div>
					</div>					

				</form>
			</div>
		</div>
	</div>
	@include('user.settings._menu')
</div>

@stop