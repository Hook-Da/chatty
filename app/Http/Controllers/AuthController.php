<?php

namespace Chatty\Http\Controllers;

use Illuminate\Http\Request;
use Chatty\User;
use Session;
use Auth;

class AuthController extends Controller
{
	
    public function getSignup(){
    	return view('auth.signup',['except'=>'getSignout']);
    }
    public function postSignup(Request $request){
    	$this->validate($request,[	'email'		=>'required|unique:users|email|max:255',
    								'username'	=>'required|unique:users|alpha_dash|min:3|max:20',
    								'password'	=>'required|min:6']);
    	User::create([
    		'email' 	=> $request->email,
    		'username'	=> $request->username,
    		'password'	=> bcrypt($request->password),
    	]);
    	Session::flash('info','You are successfully registered');
    	return redirect('/');
    }
    public function getSignin(){
    	return view('auth.signin');
    }
    public function postSignin(Request $request){
    	$this->validate($request,[	'email' 	=> 'required',
    								'password'	=> 'required']);
    	if(Auth::attempt($request->only(['email','password']),$request->has('remember'))){
    		
    		Session::flash('info','You are successfully logged in' );
    		return redirect('/');
    	}
    	else{
    		Session::flash('info','Could not sign you in with those details.');
    		return redirect()->back();
    	}
    }
    public function getSignout(){
    	Auth::logout();
    	return redirect('/');
    }
}
