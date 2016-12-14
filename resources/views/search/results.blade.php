@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Results for "{{ Request::input('q') }}"</h3>
			</div>
			<div class="panel-body">
				@if(!$users->count())
					<p>No users found.</p>
				@else
					@foreach ($users as $user)
					<div class="col-md-4">
					    <div class="thumbnail">
					      {!! $user->getAvatar('img-circle') !!}
					      <div class="caption text-center" style="padding-bottom: 55px">
					        <h3 style="margin:0px;">{!! $user->profile() !!}</h3>
					        @if ($user->name())
					        <p style="margin-bottom: -25px">{{ $user->name() }}</p>
					        @endif
					      </div>
					    </div>	
					</div>	
					@endforeach
				@endif
			</div>
		</div>
	</div>
</div>
@stop