@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-md-10">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Change Password</h3>
			</div>

			<div class="panel-body">
				<form action="{{ url('user/settings/password') }}" role="form" method="POST" class="form-horizontal">
					{{ csrf_field() }}
					{{ method_field('PATCH') }}

					<div class="form-group{{ $errors->has('old_password') ? ' has-error' : '' }}">
						<label for="old_password" class="col-md-2 control-label">Old Password</label>

						<div class="col-md-10">
							<input type="password" name="old_password" id="old_password" class="form-control">
						</div>

						@if ($errors->has('old_password'))
						<span class="help-block">
							{{ $errors->first('old_password')}}
						</span>
						@endif
					</div>

					<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
						<label for="password" class="col-md-2 control-label">New Password</label>

						<div class="col-md-10">
							<input type="password" name="password" id="password" class="form-control">
						</div>

						@if ($errors->has('password'))
						<span class="help-block">
							{{ $errors->first('password')}}
						</span>
						@endif						
					</div>

					<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
						<label for="password_confirmation" class="col-md-2 control-label">Confirm new password</label>

						<div class="col-md-10">
							<input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
						</div>
					</div>

					<div class="form-group text-center">
						<button type="submit" class="btn btn-info">Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	@include('user.settings._menu')
</div>
@stop