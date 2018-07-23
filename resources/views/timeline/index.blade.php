@extends('templates.default')

@section('content')
<div class="row">
    <div class="col-md-6 col-md-offset-2 ">
	{!!Form::open(['route'=>['status.post']])!!}
	{{Form::textarea('comment',null,['class'=>'form-control ts5','rows'=>4,'cols'=>30,'placeholder'=>"What's new?",])}}
	{{Form::submit('Update status',['class'=>'btn btn-primary ts5'])}}
	{!!Form::close()!!}
	
</div></div>
<div class="row">
<div class="col-md-6" style="line-height: 14px;">
	<!-- Timeline statuses and replies -->
	@if (!$statuses->count())
		<p>There's nothing in your timeline yet.</p>
	@else
		@foreach($statuses as $status)
			<div class="media ts10">
		    <a class="pull-left" href="{{route('profile.index',['username'=>$status->user->username])}}">
		        <img class="media-object ts5" alt="{{$status->user->getNameOrUsername()}}" src="{{$status->user->getAvatarUrl()}}">
		    </a>
		    <div class="media-body ls5">
		        <h4 class="media-heading "><a href="{{route('profile.index',['username'=>$status->user->username])}}">{{$status->user->getNameOrUsername()}}</a></h4>
		        <p>{{$status->body}}</p>
		        <ul class="list-inline ">
		            <li class="list-inline-item">{{$status->created_at->diffForHumans()}}</li>
		            <li class="list-inline-item"><a href="{{route('status.like',['statusId'=>$status->id])}}">Like</a></li>
		            <li class="list-inline-item">10 likes</li>
		        </ul>
		 @foreach($status->replies as $reply)
		        <div class="media">
		            <a class="pull-left" href="{{route('profile.index',['username'=>$reply->user->username])}}">
		                <img class="media-object" alt="{{$reply->user->getNameOrUsername()}}" src="{{$reply->user->getAvatarUrl()}}">
		            </a>
		            <div class="media-body ls5">
		                <h5 class="media-heading"><a href="{{route('profile.index',['username'=>$reply->user->username])}}">{{$reply->user->getNameOrUsername()}}</a></h5>
		                <p>{{$reply->body}}</p>
		                <ul class="list-inline">
		                    <li class="list-inline-item">{{$reply->created_at->diffForHumans()}}</li>
		                    <li class="list-inline-item"><a href="{{route('status.like',['statusId'=>$reply->id])}}">Like</a></li>
		                    <li class="list-inline-item">4 likes</li>
		                </ul>
		            </div>
		        </div>
 			@endforeach
        <form role="form" action="{{route('status.reply',['statusId'=>$status->id])}}" method="post">
            <div class="form-group">
                <textarea name="reply-{{$status->id}}" class="form-control" rows="1" placeholder="Reply to this status"></textarea>
            </div>
            <input type="submit" value="Reply" class="btn btn-primary btn-sm">
            <input type="hidden" name="_token" value="{{Session::token()}}">
        </form>
    </div>
</div>
		@endforeach
		{!!$statuses->render()!!}
	@endif
</div>
</div>

@stop