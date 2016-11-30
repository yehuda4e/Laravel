@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-md-10">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Signature</h3>
			</div>
			<div class="panel-body">
				<form action="{{ url('user/settings/signature') }}" method="POST" role="form" class="form-horizontal">
					{{ csrf_field() }}
					{{ method_field('PATCH') }}
					<div class="form-group">
						<label for="signature" class="col-md-2 control-label">Signature</label>

						<div class="col-md-10">
							<textarea name="signature" id="signature" cols="30" rows="10" class="form-control">{{ old('signature') ?? $user->signature }}</textarea>
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