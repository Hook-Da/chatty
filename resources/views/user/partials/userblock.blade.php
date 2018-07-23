<div class="media ts5">
	<a href="{{route('profile.index',$user->username)}}" class="pull-left">
		<img src="{{$user->getAvatarUrl()}}" alt="{{$user->getNameOrUsername()}}" class="media-object rs5">
	</a>
	<div class="media-body">
			<h4 class="media-heading"><a href="{{route('profile.index',$user->username)}}">{{$user->getNameOrUsername()}}</a></h4>
			@if($user->location)
				<p>{{$user->location}}</p>
			@endif
	</div>
</div>