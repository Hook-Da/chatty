<?php

namespace Chatty\Http\Controllers;

use Illuminate\Http\Request;
use Chatty\User;
use Session;
use Chatty\Friend;
use Auth;

class ProfileController extends Controller
{
    public function getProfile($username){
        
    	$user = User::where('username',$username)->first();
    	if(!$user){
    		abort(404);
    	}
        $statuses = $user->statuses()->notReply()->get();
                
    	return view('profile.index')
        ->withUser($user)
        ->withStatuses($statuses)
        ->withFriendship(Auth::user()->isFriendsWith($user));
    }
    public function getEdit($id){
    	//dd($id);
    	return view('profile.edit')->withId(User::find($id));
    }
    public function postEdit(Request $request,$id){
    	$this->validate($request,[
    		'first_name'	=>'required|alpha|max:50',
    		'last_name'		=>'required|alpha|max:50',
    		'location'		=>'required|max:50']);
    	$user = User::find($id);
    	$user->first_name = $request->first_name;
    	$user->last_name 	= $request->last_name;
    	$user->location 	= $request->location;
    	$user->save();
    	Session::flash('info','Your setting has been updated');
    	return redirect()->back();
    }
}
