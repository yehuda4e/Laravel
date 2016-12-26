@extends('layouts.app')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">404 Page not found.</h3>
	</div>
	<div class="panel-body">
		<p>Oops, the page could not be found.</p>
		<a href="{{ url('/') }}">Go home</a>
	</div>
</div>
@stop