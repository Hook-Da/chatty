<?php

namespace Chatty\Http\Controllers;

use Illuminate\Http\Request;
use Chatty\User;
use Auth;

class FriendController extends Controller
{
	public function __construct(){
		$this->middleware('auth');
	}
    public function getIndex()
    {
    	$friends = Auth::user()->friends();
    	$requests = Auth::user()->friendRequests();
    	return view('friends.index')->withFriends($friends)->withRequests($requests);
    }
    public function getAdd($username){
    	$user = User::where('username',$username)->first();
    	if(!$user){
    		return redirect()
    		->route('home')
    		->withInfo('That user could not be found');
    	}
    	if(Auth::user()->id === $user->id){
    		return redirect()->back();
    	}
    	if(Auth::user()->hasFriendRequestPending($user) || $user->hasFriendRequestPending(Auth::user())){
    		return redirect()
    		->route('profile.index',['username'=>$user->username])
    		->withInfo('Friend request already pending');
    	}
    	if(Auth::user()->isFriendsWith($user)){
    		return redirect()
    		->route('profile.index',['username'=>$user->username])
    		->withInfo('You are already friends.');
    	}
    	Auth::user()->addFriend($user);
    	return redirect()
    	->route('profile.index',['username'=>$username])
    	->withInfo('Friend request send');
    }
    public function getAccept($username){
    	$user = User::where('username',$username)->first();
    	if(!$user){
    		return redirect()
    		->route('home')
    		->withInfo('That user could not be found');
    	}
    	if(!Auth::user()->hasFriendRequestReceived($user)){
    		return redirect()->route('home');
    	}
    	Auth::user()->acceptFriendRequest($user);

    	return redirect()
    	->route('profile.index',['username' => $username])
    	->withInfo('Friend request accepted');
    }
}
