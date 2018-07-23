@extends('templates.default')

@section('content')
<div class="row">
    <div class="col-md-8">
<h3>Your friends</h3>
		@if(!$friends->count())
		<p>You have no friends</p>
		@else
			@foreach($friends as $user)
				@include('user/partials/userblock')
			@endforeach
		@endif
</div>
	<div class="col-md-4">
		<h4>Friend requests</h4>
		@if(!$requests->count())
			<p>You have no friend requests.</p>
		@else
			@foreach($requests as $user)
				@include('user.partials.userblock')
			@endforeach
		@endif
	</div>
</div>


@stop