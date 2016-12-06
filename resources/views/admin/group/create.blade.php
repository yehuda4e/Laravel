@extends('admin.app')

@section('content')
<div class="row">
	<div class="col-md-12">
		<form action="{{ route('group.store') }}" method="POST" role="form" class="form-horizontal">
			{{ csrf_field() }}

			<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
				<label for="name" class="control-label col-md-1">Name</label>

				<div class="col-md-8">
					<input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control" required autofocus>

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
					<input type="color" name="color" id="color" value="{{ old('color') }}" class="form-control" required autofocus>

					@if ($errors->has('color'))
					<span class="help-block">
						{{ $errors->first('color')}}
					</span>
					@endif
				</div>
			</div>			
		</form>
	</div>
</div>


@stop