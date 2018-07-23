<?php

namespace Chatty\Http\Controllers;

use Illuminate\Http\Request;
use Chatty\User;
use Chatty\Status;
use Auth;

class StatusController extends Controller
{
    public function postStatus(Request $request){
    	$this->validate($request,[
    		'comment'	=>	'required|max:1000',
    	]);
    	Auth::user()->statuses()->create([
    		'body'	=>	$request->comment,
    	]);
    	return redirect()
    	->route('home')
    	->withInfo('Your status has been posted');
    }
    public function postReply(Request $request, $statusId){
    	$this->validate($request,[
    		"reply-{$statusId}" =>'required|max:1000',
    	],[
    		'required' => 'The reply body is required.'
    	]);
    	$status = Status::notReply()->find($statusId);
        //dd($status);
    	if(!$status){
    		return redirect('/');
    	}
    	if(!Auth::user()->isFriendsWith($status->user) && Auth::user()->id !== $status->user->id){
    		return redirect('/');
    	}
    	$reply = Status::create([
    		'body'=>$request->input("reply-{$statusId}"),
    	])->user()->associate(Auth::user());
        dd($reply);
    	$status->replies()->save($reply);
    	return redirect()->back();
    }
    public function getLike($statusId){
    	$status = Status::find($statusId);

    	if(!$status){
    		return redirect('/');
    	}
    	if(Auth::user()->hasLikedStatus($status)){
    		return redirect('/');
    	}
    	$like = $status->likes()->create([]);
    	Auth::user()->likes()->save($like);

    	return redirect('/');
    }
}
