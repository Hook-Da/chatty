@extends('templates.default')

@section('content')
	<h3 class="ts40">Your serch for "{{ Request::input('query')}}"</h3>
	@if(!$users->count())
	<p>No results found</p>
	@else
	<div class="row">
		<div class="col-md-12">
		@foreach($users as $user)
			@include('user/partials/userblock')
		@endforeach
		</div>
	</div>
	@endif
@stop