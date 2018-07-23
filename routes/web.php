<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',['uses'=>'HomeController@index','as'=>'home']);
Route::get('/alert',function(){
	return redirect()->route('home')->with('info','Signed up!');
});

Route::get('/signup',['uses'=>'AuthController@getSignup','as'=>'auth.signup','middleware'=>['guest']]); 
Route::post('/signup',['uses'=>'AuthController@postSignup','middleware'=>['guest']]); 
//////////////////////
Route::get('/signin',['uses'=>'AuthController@getSignin','as'=>'auth.signin','middleware'=>['guest']]); 
Route::post('/signin',['uses'=>'AuthController@postSignin','middleware'=>['guest']]); 

Route::get('/signout',['uses'=>'AuthController@getSignout','as'=>'auth.signout']);
/**
* search
*/
Route::get('/search',['uses'=>'SearchController@getResults','as'=>'search.results']);
//userprofile
Route::get('/profile/{username}',['uses'=>'ProfileController@getProfile','as'=>'profile.index']);
Route::get('/profile/{id}/edit',['uses'=>'ProfileController@getEdit','as'=>'profile.edit','middleware'=>['auth']]);
Route::put('/profile/{id}',['uses'=>'ProfileController@postEdit','as'=>'profile.postEdit','middleware'=>['auth']]);
/**
* Friends
*/
Route::get('/friends',['uses'=>'FriendController@getIndex','as'=>'friends.index','middleware'=>'auth']);
Route::get('/friends/{username}',['uses'=>'FriendController@getAdd','as'=>'friends.add','middleware'=>'auth']);
Route::get('/friends/accept/{username}',['uses'=>'FriendController@getAccept','as'=>'friends.accept','middleware'=>'auth']);
Route::post('/status',[
	'uses'		=>	'StatusController@postStatus',
	'as'		=>	'status.post',
	'middleware'=>	['auth'],
	]);
Route::post('/status/reply/{statusId}',[
	'uses'		=>	'StatusController@postReply',
	'as'		=>	'status.reply',
	'middleware'=>	['auth'],
	]);
Route::get('/status/{statusId}/like',[
	'uses'		=>	'StatusController@getLike',
	'as'		=>	'status.like',
	'middleware'=>	['auth'],
	]);