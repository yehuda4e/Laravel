@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-md-10">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Avatar and Cover picture</h3>
			</div>
			<div class="panel-body">
				<form action="{{ url('user/settings/avatar') }}" role="form" method="POST" class="form-horizontal">
					{{ csrf_field() }}
					{{ method_field('PATCH') }}

					<div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
						<label for="avatar" class="col-md-2 control-label">Avatar</label>

						<div class="col-md-10">
							<input type="text" name="avatar" id="avatar" class="form-control" value="{{ old('avatar') ?? $user->avatar }}">

							@if ($errors->has('avatar'))
							<span class="help-block">
								{{ $errors->first('avatar')}}
							</span>
							@endif
						</div>
					</div>

					<div class="form-group{{ $errors->has('cover') ? ' has-error' : '' }}">
						<label for="cover" class="col-md-2 control-label">Cover</label>

						<div class="col-md-10">
							<input type="text" name="cover" id="cover" class="form-control" value="{{ old('cover') ?? $user->cover }}">

							@if ($errors->has('cover'))
							<span class="help-block">
								{{ $errors->first('cover')}}
							</span>
							@endif
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